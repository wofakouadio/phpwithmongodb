<?php

    // session_start();

    require_once "../../../includes/TokenSession.php";

    if(isset($_POST["department-name"]) && isset($_POST["department-description"]) && isset($_POST["_token"]) && isset($_SESSION["token"])){

        $department_name = filter_input(INPUT_POST, "department-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $department_description = filter_input(INPUT_POST, "department-description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $formToken = filter_input(INPUT_POST, "_token", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(time() > $_SESSION["tokenexpire"]){
            session_destroy();
            $response = [
                'status' => 400,
                'msg' => "Token has expired. Hot reload to refresh the session"
            ];
        }else{
            if($_SESSION["token"] ==! $formToken){
                session_destroy();
                $response = [
                    'status' => 400,
                    'msg' => "Token mismatch. Reload to regenerate new token"
                ];
    
            }else{
                require "../../../includes/init.php";
                require_once '../../../includes/IdGenerator.php';
                require_once '../../../controllers/DepartmentsClass.php';
        
                $DepartmentObject = new DepartmentsClass();
        
                $NewDepartment = $DepartmentObject->NewDepartment(strtoupper($department_name), $department_description);
        
                $response = json_decode($NewDepartment);
            }
        }

        echo json_encode($response);

    }