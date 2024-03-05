<?php

class TeacherClass{
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

}