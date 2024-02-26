<?php

    // session_start();

    require_once "../../../includes/TokenSession.php";

    if(isset($_POST["class-id"]) && isset($_POST["class-name"]) && isset($_POST["class-status"]) && isset($_POST["_token"]) && isset($_SESSION["token"])){

        $class_id = filter_input(INPUT_POST, "class-id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $class_name = filter_input(INPUT_POST, "class-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $class_status = filter_input(INPUT_POST, "class-status", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
                require_once '../../../controllers/ClassesClass.php';
        
                $ClassObject = new ClassesClass();
        
                $UpdateClass = $ClassObject->UpdateClass($class_id, strtoupper($class_name), $class_status);
        
                $response = json_decode($UpdateClass);
            }
        }

        echo json_encode($response);

    }