<?php

    // session start
    session_start();

    // include "config.php";

    if(!isset($_SESSION['token']) && !isset($_SESSION["tokenexpire"])){
        // require "../../../includes/csrfToken.php";
        // $NewTokenObject = new csrfToken();

        // function GenerateNewToken(){
        //     return bin2hex(random_bytes(32));
        // }
    
        // function ExpirationTokenTime(){
        //     return time() + 1800;    // 30 minutes
        // }

        // $_SESSION["token"] = GenerateNewToken();
        // $_SESSION["tokenexpire"] = ExpirationTokenTime();
        $_SESSION["token"] = bin2hex(random_bytes(32));
        $_SESSION["tokenexpire"] = time() + 1800;
    }