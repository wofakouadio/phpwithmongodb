<?php

    // session_start();

    require_once "../../../includes/TokenSession.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        if(isset(
            $_POST["id"],
            $_SESSION["tokenexpire"]
            )
        ){

            $subject_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            if(time() > $_SESSION["tokenexpire"]){
                session_destroy();
                $response = [
                    'status' => 400,
                    'msg' => "Token has expired. Hot reload to refresh the session"
                ];
            }else{
                require "../../../includes/init.php";
                require_once '../../../controllers/SubjectsClass.php';
        
                $SubjectObject = new SubjectClass();
        
                $SubjectData = $SubjectObject->SubjectData($subject_id);
        
                $response = json_decode($SubjectData);
            }
    
    
        }

        echo json_encode($response);

    }