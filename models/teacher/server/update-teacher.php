<?php

    // session_start();

    require_once "../../../includes/TokenSession.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        if(isset(
            $_POST["subject-id"],
            $_POST["subject-name"],
            $_POST["subject-status"],
            $_POST["_token"],
            $_SESSION["token"],
            $_POST["subject-description"]
            )
        ){

            $subject_id = filter_input(INPUT_POST, "subject-id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $subject_name = filter_input(INPUT_POST, "subject-name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $subject_status = filter_input(INPUT_POST, "subject-status", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
            
                    $UpdateSubject = $SubjectObject->UpdateSubject($subject_id, strtoupper($subject_name), $subject_description, $subject_status);
            
                    $response = json_decode($UpdateSubject);
                }
            }
    
        }else{

            session_destroy();
            $response = [
                'status' => 400,
                'msg' => "Wrong request method"
            ];

        }

        echo json_encode($response);

    }