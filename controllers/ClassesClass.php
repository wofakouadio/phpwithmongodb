<?php

class ClassesClass{

    // database
    use DatabaseClass;
    // csrf 
    // use csrfToken;
    // UUID Generator
    use IdGenerator;


    protected $id;
    protected $name;
    protected $status;
    protected $updated_at;
    protected $deleted_at;
    protected $response = [];

    public function NewClass($name){
        $this->id = $this->NewID();
        $this->name = $name;

        // initiate db connection
        $connection = $this->OpenConnection();

        // check if department already exists
        $sqlCheck = "SELECT `id`, `name` FROM `classes` WHERE `id` = :id OR `name` = :name LIMIT 1";
        $stmtCheck = $connection->prepare($sqlCheck);
        $stmtCheck->bindValue(":id", $this->id, PDO::PARAM_STR);
        $stmtCheck->bindValue(":name", $this->name, PDO::PARAM_STR);
        $stmtCheck->execute();

        if($stmtCheck->rowCount() > 0){
            $this->response = [
                'status' => 201,
                'msg' => 'The classes already exists'
            ];
        }else{
            
            try {
                $sqlIns = "INSERT INTO `classes` (`id`, `name`) VALUES(:id, :name)";
                $stmtIns = $connection->prepare($sqlIns);
                $stmtIns->bindValue(":id", $this->id, PDO::PARAM_STMT);
                $stmtIns->bindValue(":name",$name, PDO::PARAM_STMT);
                
                $stmtIns->execute();

                $this->response = [
                    'status' => 200,
                    'msg' => 'The class has been created successfully'
                ];

            } catch (\Exception $th) {
                $this->response = [
                    'status' => 201,
                    'msg' => 'Something went wrong. Error : ' . $th->getMessage()
                ];
            }
        }
        return json_encode($this->response);
        $connection = $this->CloseConnection();
    }

}