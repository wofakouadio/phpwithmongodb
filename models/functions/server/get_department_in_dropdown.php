<?php

    // session_start();
    // require_once "../../../includes/TokenSession.php";

    // if($_SERVER["REQUEST_METHOD"] === "GET"){

    //     if(time() > $_SESSION["tokenexpire"]){
    //         session_destroy();
            // $response = [
            //     'status' => 400,
            //     'msg' => "Token has expired. Hot reload to refresh the session"
            // ];
        //     exit();
        // }else{
        //     if($_SESSION["token"] ==! $formToken){
        //         session_destroy();
                // $response = [
                //     'status' => 400,
                //     'msg' => "Token mismatch. Reload to regenerate new token"
                // ];
                // exit();
    
            // }else{
                require "../../../includes/init.php";
                require_once '../../../controllers/DepartmentsClass.php';
        
                $DepartmentObject = new DepartmentsClass();
        
                echo $DepartmentObject->DepartmentsInDropdown();
                // $response = $Department;
            // }
        // }

     
        // echo $response;

    // }