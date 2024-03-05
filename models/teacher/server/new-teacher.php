<?php

    // session_start();
    require_once "../../../includes/TokenSession.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        if(isset(
            $_POST["_token"],
            $_POST["subject-name"],
            $_POST["subject-code"],
            $_POST["subject-description"],
            $_SESSION["token"]
            )
        ){

            $subject_name = filter_input(INPUT_POST,"subject-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $subject_code = filter_input(INPUT_POST, "subject-code", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $subject_description = filter_input(INPUT_POST, "subject-description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
                    require_once '../../../controllers/SubjectsClass.php';
            
                    $SubjectObject = new SubjectClass();
            
                    $NewSubject = $SubjectObject->NewSubject($subject_code, strtoupper($subject_name), $subject_description);
            
                    $response = json_decode($NewSubject);
                }
            }

        }

        echo json_encode($response);

    }