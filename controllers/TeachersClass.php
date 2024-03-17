<?php

class TeacherClass{
    // database
    use DatabaseClass;
    // UUID Generator
    use IdGenerator;


    protected $id;
    protected $staff_id = "";
    protected $firstname;
    protected $surname;
    protected $dob;
    protected $pob;
    protected $email;
    protected $hometown;
    protected $gender;
    protected $address;
    protected $contact;
    protected $profile;
    protected $id_profile;
    protected $department;
    protected $status;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;
    protected $response = [];

    public function NewTeacher($staff_id, $firstname, $surname, $dob, $pob, $email, $hometown, $gender, $address, $contact, $profile, $id_profile, $department){

        $this->id = $this->NewID();
        $this->staff_id = $staff_id;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->dob = $dob;
        $this->pob = $pob;
        $this->hometown = $hometown;
        $this->gender = $gender;
        $this->email = $email;
        $this->address = $address;
        $this->contact = $contact;
        $this->profile = $profile;
        $this->id_profile = $id_profile;
        $this->department = $department;

        // initiate db connection
        $connection = $this->OpenConnection();

        // check if teacher exists
        $chkSql = "SELECT `firstname`, `surname`, `email` FROM `teachers` WHERE `id` = :id LIMIT 1";
        $stmtSql = $connection->prepare($chkSql);
        $stmtSql->bindValue(":id", $this->id, PDO::PARAM_STR);
        $stmtSql->execute();

        if($stmtSql->rowCount() > 0){
            $this->response = [
                'status' => 201,
                'msg' => 'Teacher already exists'
            ];
        }else{
            try {
                $sqlIns = "INSERT INTO `teachers`(`id`, `staff_id`, `firstname`, `surname`, `dob`, `pob`, `email`, `hometown`, `gender`, `address`, `contact`, `profile`, `id_profile`, `department`) VALUES(:id, :staff_id, :firstname, :surname, :dob, :pob, :email, :hometown, :gender, :address, :contact, :profile, :id_profile, :department)";
                $stmtIns = $connection->prepare($sqlIns);
                $stmtIns->bindValue(":id", $this->id, PDO::PARAM_STR);
                $stmtIns->bindValue(":staff_id", $staff_id, PDO::PARAM_STR);
                $stmtIns->bindValue(":firstname", $firstname, PDO::PARAM_STR);
                $stmtIns->bindValue(":surname", $surname, PDO::PARAM_STR);
                $stmtIns->bindValue(":dob", $dob, PDO::PARAM_STR);
                $stmtIns->bindValue(":pob", $pob, PDO::PARAM_STR);
                $stmtIns->bindValue(":email", $email, PDO::PARAM_STR);
                $stmtIns->bindValue(":hometown", $hometown, PDO::PARAM_STR);
                $stmtIns->bindValue(":gender", $gender, PDO::PARAM_STR);
                $stmtIns->bindValue(":address", $address, PDO::PARAM_STR);
                $stmtIns->bindValue(":contact", $contact, PDO::PARAM_STR);
                $stmtIns->bindValue(":profile", $profile, PDO::PARAM_STR);
                $stmtIns->bindValue(":id_profile", $id_profile, PDO::PARAM_STR);
                $stmtIns->bindValue(":department", $department, PDO::PARAM_STR);
                $stmtIns->execute();

                $this->response = [
                    'status' => 200,
                    'msg' => 'New Teacher added successfully'
                ];

            } catch (\Exception $th) {
                $this->response = [
                    'status' => 201,
                    'msg' => 'New Teacher submission failed. Error : ' . $th->getMessage()
                ];
            }
        }
        return json_encode($this->response);
        $connection = $this->CloseConnection();
    }

}