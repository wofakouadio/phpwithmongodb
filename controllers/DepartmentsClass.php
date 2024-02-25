<?php

    class DepartmentsClass{

        // database
        use DatabaseClass;
        // csrf 
        // use csrfToken;
        // UUID Generator
        use IdGenerator;

        public $csrf_error = "";
        protected $token;
        protected $expiredToken;
        protected $id;
        protected $name;
        protected $description = "";
        protected $status;
        protected $updated_at;
        protected $deleted_at;
        protected $response = [];

        // method to store new department
        public function NewDepartment($name, $description = ""){
            $this->id = $this->NewID();
            $this->name = $name;
            $this->description = $description;

            // initiate db connection
            $connection = $this->OpenConnection();

            // check if department already exists
            $sqlCheck = "SELECT `id`, `name` FROM `departments` WHERE `id` = :id OR `name` = :name LIMIT 1";
            $stmtCheck = $connection->prepare($sqlCheck);
            $stmtCheck->bindValue(":id", $this->id, PDO::PARAM_STR);
            $stmtCheck->bindValue(":name", $this->name, PDO::PARAM_STR);
            $stmtCheck->execute();

            if($stmtCheck->rowCount() > 0){
                $this->response = [
                    'status' => 201,
                    'msg' => 'The department already exists'
                ];
            }else{
                
                try {
                    $sqlIns = "INSERT INTO `departments` (`id`, `name`, `description`) VALUES(:id, :name, :description)";
                    $stmtIns = $connection->prepare($sqlIns);
                    $stmtIns->bindValue(":id", $this->id, PDO::PARAM_STMT);
                    $stmtIns->bindValue(":name",$name, PDO::PARAM_STMT);
                    $stmtIns->bindValue(":description", $description, PDO::PARAM_STMT);
                    
                    $stmtIns->execute();

                    $this->response = [
                        'status' => 200,
                        'msg' => 'The department has been created successfully'
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

        // method to fetch department based on department id
        public function DepartmentData($id){
            $this->id = $id;

            // initiate db connection
            $connection = $this->OpenConnection();

            // check if department already exists
            $sqlFetch = "SELECT `id`, `name`, `description`, `status` FROM `departments` WHERE `id` = :id LIMIT 1";
            $stmtFetch = $connection->prepare($sqlFetch);
            $stmtFetch->bindValue(":id", $this->id, PDO::PARAM_STR);
            $stmtFetch->execute();

            if($stmtFetch->rowCount() == 0){
                $this->response = [
                    'status' => 201,
                    'msg' => 'The department does not exist'
                ];
            }else{

                $DepartmentData = $stmtFetch->fetch(PDO::FETCH_OBJ);

                $this->response = [
                    'status' => 200,
                    'msg' => 'Data found',
                    'data' => [
                        'id' => $id,
                        'name' => $DepartmentData->name,
                        'description' => $DepartmentData->description,
                        'status' => $DepartmentData->status
                    ]
                ];
                
                
            }
            return json_encode($this->response);
            $connection = $this->CloseConnection();
        }

        // method to update department
        public function UpdateDepartment($id, $name, $description, $status){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->status = $status;
            $this->updated_at = date('Y-m-d H:i:s');

            // initiate db connection
            $connection = $this->OpenConnection();

            // update department based on id
            try {
                $sqlUpd = "UPDATE `departments` SET `name` = :name , `description` = :description, `status` = :status, `updated_at` = :updated_at WHERE `id` = :id";
                $stmtUpd = $connection->prepare($sqlUpd);
                $stmtUpd->bindValue(":id", $id, PDO::PARAM_STMT);
                $stmtUpd->bindValue(":name",$name, PDO::PARAM_STMT);
                $stmtUpd->bindValue(":description", $description, PDO::PARAM_STMT);
                $stmtUpd->bindValue(":status", $status, PDO::PARAM_INT);
                $stmtUpd->bindValue(":updated_at", $this->updated_at, PDO::PARAM_STMT);
                
                $stmtUpd->execute();

                $this->response = [
                    'status' => 200,
                    'msg' => 'The department has been updated successfully'
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