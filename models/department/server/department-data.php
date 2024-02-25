<?php

    // session_start();

    require_once "../../../includes/TokenSession.php";

    if(isset($_POST["id"]) && isset($_SESSION["tokenexpire"])){

        $department_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(time() > $_SESSION["tokenexpire"]){
            session_destroy();
            $response = [
                'status' => 400,
                'msg' => "Token has expired. Hot reload to refresh the session"
            ];
        }else{
            require "../../../includes/init.php";
            require_once '../../../includes/IdGenerator.php';
            require_once '../../../controllers/DepartmentsClass.php';
    
            $DepartmentObject = new DepartmentsClass();
    
            $DepartmentData = $DepartmentObject->DepartmentData($department_id);
    
            $response = json_decode($DepartmentData);
        }

        echo json_encode($response);

    }