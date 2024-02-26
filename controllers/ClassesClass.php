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

    // method to create new class room
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

    // method to fetch class room data
    public function ClassData($id){
        $this->id = $id;

        // initiate db connection
        $connection = $this->OpenConnection();

        // check if department already exists
        $sqlFetch = "SELECT `id`, `name`, `status` FROM `classes` WHERE `id` = :id LIMIT 1";
        $stmtFetch = $connection->prepare($sqlFetch);
        $stmtFetch->bindValue(":id", $this->id, PDO::PARAM_STR);
        $stmtFetch->execute();

        if($stmtFetch->rowCount() == 0){
            $this->response = [
                'status' => 201,
                'msg' => 'The class does not exist'
            ];
        }else{

            $ClassData = $stmtFetch->fetch(PDO::FETCH_OBJ);

            $this->response = [
                'status' => 200,
                'msg' => 'Data found',
                'data' => [
                    'id' => $id,
                    'name' => $ClassData->name,
                    'status' => $ClassData->status
                ]
            ];
            
        }
        return json_encode($this->response);
        $connection = $this->CloseConnection();
    }

    // method to update class room data
    public function UpdateClass($id, $name, $status){
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->updated_at = date('Y-m-d H:i:s');

        // initiate db connection
        $connection = $this->OpenConnection();

        // update department based on id
        try {
            $sqlUpd = "UPDATE `classes` SET `name` = :name , `status` = :status, `updated_at` = :updated_at WHERE `id` = :id";
            $stmtUpd = $connection->prepare($sqlUpd);
            $stmtUpd->bindValue(":id", $id, PDO::PARAM_STMT);
            $stmtUpd->bindValue(":name",$name, PDO::PARAM_STMT);
            $stmtUpd->bindValue(":status", $status, PDO::PARAM_INT);
            $stmtUpd->bindValue(":updated_at", $this->updated_at, PDO::PARAM_STMT);
            
            $stmtUpd->execute();

            $this->response = [
                'status' => 200,
                'msg' => 'The class has been updated successfully'
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
    public function SoftDeleteClassData($id){
        $this->id = $id;
        $this->deleted_at = date('Y-m-d H:i:s');

        // initiate db connection
        $connection = $this->OpenConnection();

        try {
            $sqlUpd = "UPDATE `classes` SET `deleted_at` = :deleted_at WHERE `id` = :id";
            $stmtUpd = $connection->prepare($sqlUpd);
            $stmtUpd->bindValue(":id", $id, PDO::PARAM_STMT);
            $stmtUpd->bindValue(":deleted_at", $this->deleted_at, PDO::PARAM_STMT);
            
            $stmtUpd->execute();

            $this->response = [
                'status' => 200,
                'msg' => 'The class has been deleted successfully'
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
    public function DeleteClassData($id){
        $this->id = $id;

        // initiate db connection
        $connection = $this->OpenConnection();

        try {
            $sqlUpd = "DELETE FROM `classes` WHERE `id` = :id";
            $stmtUpd = $connection->prepare($sqlUpd);
            $stmtUpd->bindValue(":id", $id, PDO::PARAM_STMT);
            
            $stmtUpd->execute();

            $this->response = [
                'status' => 200,
                'msg' => 'The class has been deleted successfully'
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