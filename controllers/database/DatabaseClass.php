<?php

// require "../../constants/db_constants.php";

trait DatabaseClass{
    private $username = USERNAME;
    private $password = PASSWORD;
    private $dsn = DSN;
    private $db_connection = null;

    public function OpenConnection(){
        try {
            $this->db_connection = new PDO($this->dsn, $this->username, $this->password);
            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db_connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            // return [
            //     'status' => 200,
            //     'msg' => 'connection established successfully'
            // ];
        } catch (\Throwable $th) {
            //throw $th;
            return [
            'status' => 201,
                'msg' => 'connection failed. Error Message: ' . $th->getMessage()
            ];
        }

        return $this->db_connection;
    }

    public function CloseConnection(){
        return $this->db_connection;
    }

}
