<?php

    // session_start();

    require_once "../../../includes/TokenSession.php";

    if(isset($_POST["class-id"]) && isset($_POST["_token"]) && isset($_SESSION["token"]) && isset($_POST["soft-delete"])){

        $class_id = filter_input(INPUT_POST, "class-id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $soft_delete = filter_input(INPUT_POST, "soft-delete", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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

                // if(isset($_POST["soft-delete"]) &&  $_POST["soft_delete"] === "1"){
                if(isset($soft_delete) &&  $soft_delete === "1"){

                    $DeleteClass = $ClassObject->DeleteClassData($class_id);

                }
                else{

                    $DeleteClass = $ClassObject->SoftDeleteClassData($class_id);

                }

                $response = json_decode($DeleteClass);
            }
        }

        echo json_encode($response);

    }