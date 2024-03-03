<?php

class SubjectClass{
    // database
    use DatabaseClass;
    // UUID Generator
    use IdGenerator;


    protected $id;
    protected $code;
    protected $name;
    protected $description;
    protected $status;
    protected $updated_at;
    protected $deleted_at;
    protected $response = [];

    // method to create new subject
    public function NewSubject($code, $name, $description = ""){
        $this->name = $name;
        $this->code = $code;
        $this->id = $this->NewID();
        $this->description = $description;

        // initiate db connection
        $connection = $this->OpenConnection();

        // check if department already exists
        $sqlCheck = "SELECT `code`, `id`, `name` FROM `subjects` WHERE `id` = :id OR `name` = :name LIMIT 1";
        $stmtCheck = $connection->prepare($sqlCheck);
        $stmtCheck->bindValue(":id", $this->id, PDO::PARAM_STR);
        $stmtCheck->bindValue(":name", $this->name, PDO::PARAM_STR);
        $stmtCheck->execute();

        if($stmtCheck->rowCount() > 0){
            $this->response = [
                'status' => 201,
                'msg' => 'The subject already exists'
            ];
        }else{
            
            try {
                $sqlIns = "INSERT INTO `subjects` (`id`, `code`, `name`, `description`) VALUES(:id, :code, :name, :description)";
                $stmtIns = $connection->prepare($sqlIns);
                $stmtIns->bindValue(":id", $this->id, PDO::PARAM_STMT);
                $stmtIns->bindValue(":code", $code, PDO::PARAM_INT);
                $stmtIns->bindValue(":name",$name, PDO::PARAM_STMT);
                $stmtIns->bindValue(":description",$description, PDO::PARAM_STMT);
                
                $stmtIns->execute();

                $this->response = [
                    'status' => 200,
                    'msg' => 'The subject has been created successfully'
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

    // method to get subject data
    public function SubjectData($id){
        $this->id = $id;

        // initiate db connection
        $connection = $this->OpenConnection();

        // check if department already exists
        $sqlFetch = "SELECT `id`, `code`, `name`, `description`, `status` FROM `subjects` WHERE `id` = :id LIMIT 1";
        $stmtFetch = $connection->prepare($sqlFetch);
        $stmtFetch->bindValue(":id", $this->id, PDO::PARAM_STR);
        $stmtFetch->execute();

        if($stmtFetch->rowCount() == 0){
            $this->response = [
                'status' => 201,
                'msg' => 'The subject does not exist'
            ];
        }else{

            $SubjectData = $stmtFetch->fetch(PDO::FETCH_OBJ);

            $this->response = [
                'status' => 200,
                'msg' => 'Data found',
                'data' => [
                    'id' => $id,
                    'code' => $SubjectData->code,
                    'name' => $SubjectData->name,
                    'description' => $SubjectData->description,
                    'status' => $SubjectData->status
                ]
            ];
            
        }
        return json_encode($this->response);
        $connection = $this->CloseConnection();
    }

    // method to update subject data
    public function UpdateSubject($id, $name, $description, $status){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->updated_at = date('Y-m-d H:i:s');

        $connection = $this->OpenConnection();

        // update subject based on id
        try {
            $sqlUpd = "UPDATE `subjects` SET `name` = :name , `description` = :description, `status` = :status, `updated_at` = :updated_at WHERE `id` = :id";
            $stmtUpd = $connection->prepare($sqlUpd);
            $stmtUpd->bindValue(":id", $id, PDO::PARAM_STMT);
            $stmtUpd->bindValue(":name",$name, PDO::PARAM_STMT);
            $stmtUpd->bindValue(":description", $description, PDO::PARAM_STMT);
            $stmtUpd->bindValue(":status", $status, PDO::PARAM_INT);
            $stmtUpd->bindValue(":updated_at", $this->updated_at, PDO::PARAM_STMT);
            
            $stmtUpd->execute();

            $this->response = [
                'status' => 200,
                'msg' => 'The subject has been updated successfully'
            ];

        } catch (\Exception $th) {
            $this->response = [
                'status' => 201,
                'msg' => 'Something went wrong. Error : ' . $th->getMessage()
            ];
        }
        return json_encode($this->response);
        $connection = $this->CloseConnection();
    }

    // method to delete data by adding timestamp
    public function SoftDeleteSubjectData($id){
        $this->id = $id;
        $this->deleted_at = date('Y-m-d H:i:s');

        // initiate db connection
        $connection = $this->OpenConnection();

        try {
            $sqlUpd = "UPDATE `subjects` SET `deleted_at` = :deleted_at WHERE `id` = :id";
            $stmtUpd = $connection->prepare($sqlUpd);
            $stmtUpd->bindValue(":id", $id, PDO::PARAM_STMT);
            $stmtUpd->bindValue(":deleted_at", $this->deleted_at, PDO::PARAM_STMT);
            
            $stmtUpd->execute();

            $this->response = [
                'status' => 200,
                'msg' => 'The subject has been deleted successfully'
            ];

        } catch (\Exception $th) {
            $this->response = [
                'status' => 201,
                'msg' => 'Something went wrong. Error : ' . $th->getMessage()
            ];
        }
        return json_encode($this->response);
        $connection = $this->CloseConnection();
    }

    // method to delete data completely from the db
    public function DeleteSubjectData($id){
        $this->id = $id;

        // initiate db connection
        $connection = $this->OpenConnection();

        try {
            $sqlUpd = "DELETE FROM `subjects` WHERE `id` = :id";
            $stmtUpd = $connection->prepare($sqlUpd);
            $stmtUpd->bindValue(":id", $id, PDO::PARAM_STMT);
            
            $stmtUpd->execute();

            $this->response = [
                'status' => 200,
                'msg' => 'The subject has been deleted successfully'
            ];

        } catch (\Exception $th) {
            $this->response = [
                'status' => 201,
                'msg' => 'Something went wrong. Error : ' . $th->getMessage()
            ];
        }
        return json_encode($this->response);
        $connection = $this->CloseConnection();
    }
}