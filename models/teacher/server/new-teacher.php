<?php

    // session_start();
    require_once "../../../includes/TokenSession.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        if(isset(
            $_POST["_token"],
            $_POST["teacher-staff-id"],
            $_POST["teacher-firstname"],
            $_POST["teacher-surname"],
            $_POST["teacher-dob"],
            $_POST["teacher-pob"],
            $_POST["teacher-hometown"],
            $_POST["teacher-gender"],
            $_POST["teacher-address"],
            $_POST["teacher-email"],
            $_POST["teacher-contact"],
            $_POST["teacher-department"],
            $_SESSION["token"],
            $_FILES["teacher-profile"],
            $_FILES["teacher-id-profile"]
            )
        ){

            $teacher_staff_id = filter_input(INPUT_POST,"teacher-staff-id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_firstname = filter_input(INPUT_POST,"teacher-firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_surname = filter_input(INPUT_POST,"teacher-surname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_dob = filter_input(INPUT_POST,"teacher-dob", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_pob = filter_input(INPUT_POST,"teacher-pob", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_hometown = filter_input(INPUT_POST,"teacher-hometown", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_gender = filter_input(INPUT_POST,"teacher-gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_address = filter_input(INPUT_POST,"teacher-address", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_email = filter_input(INPUT_POST,"teacher-email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_contact = filter_input(INPUT_POST,"teacher-contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $teacher_department = filter_input(INPUT_POST,"teacher-department", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $formToken = filter_input(INPUT_POST, "_token", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $response = [];

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
                    require "../../../includes/ImageCompression.php";
                    require_once '../../../controllers/TeachersClass.php';
                    
                    // image process metadata
                    $initial = "teacher";
                    $ProfileName = $_FILES["teacher-profile"]["name"];
                    $ProfileTemp = $_FILES["teacher-profile"]["tmp_name"];
                    $ProfileDestination = "../../../storage/profiles/";
                    $ProfileDefault = "profile.jpg";
                    $IdName = $_FILES["teacher-id-profile"]["name"];
                    $IdTemp = $_FILES["teacher-id-profile"]["tmp_name"];
                    $IdDestination = "../../../storage/ids/";
                    $IdDefault = "no-img-avatar.png";
                    
                    // instantiate Image Processing class
                    $ImgProc = new ImageProcessing();

                    // instantiate Teachers class
                    $TeacherObject = new TeacherClass;
            
                    // check if profile file is uploaded
                    if(isset($ProfileName) && !empty($ProfileName)){
                        $imgUpload = $ImgProc->ImageUpload($initial, $ProfileName, $ProfileTemp, $ProfileDestination);

                        $DecodeResponse = json_decode($imgUpload);

                        if($DecodeResponse->status === 201){
                            $response = $DecodeResponse;
                        }else{
                            $ProfileToUpload = $DecodeResponse->imageFile;
                        }

                    }else{
                        $ProfileToUpload = $ProfileDefault;
                    }

                    // check if id file is uploaded
                    if(isset($IdName) && !empty( $IdName )){
                        $imgUpload = $ImgProc->ImageUpload($initial, $IdName, $IdTemp, $IdDestination);

                        $DecodeResponse = json_decode($imgUpload);

                        if($DecodeResponse->status === 201){
                            $response = $DecodeResponse;
                        }else{
                            $IdToUpload = $DecodeResponse->imageFile;
                        }

                    }else{
                        $IdToUpload = $IdDefault;
                    }
                }

                // call the new teacher method
                $NewTeacher = $TeacherObject->NewTeacher($teacher_staff_id, $teacher_firstname, $teacher_surname, $teacher_dob, $teacher_pob, $teacher_email, $teacher_hometown, $teacher_gender, $teacher_address, $teacher_contact, $ProfileToUpload, $IdToUpload, $teacher_department);

                $response = json_decode($NewTeacher);

                // $response = [
                //     'profile' => $ProfileToUpload,
                //     'id' => $IdToUpload
                // ];
                
            }
            // echo json_encode($response);
        }
        echo json_encode($response);
    }