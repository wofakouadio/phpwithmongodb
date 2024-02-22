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

        public function NewDepartment($name, $description = ""){
            $this->id = $this->NewID();
            $this->name = $name;
            $this->description = $description;

            // initiate db connection
            $connection = $this->OpenConnection();

            // check if department already exists
            $sqlCheck = "SELECT `id`, `name` FROM `departments` WHERE `id` = :id LIMIT 1";
            $stmtCheck = $connection->prepare($sqlCheck);
            $stmtCheck->bindValue(":id", $this->id, PDO::PARAM_STR);
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
                    $stmtIns->bindValue(":name", ucfirst($name), PDO::PARAM_STMT);
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
    }