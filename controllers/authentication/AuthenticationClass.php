<?php

class AuthenticationClass{

    use DatabaseClass;

    protected $connection;

    public function DatabaseConnection(){
        return $this->connection = "";
    }

}