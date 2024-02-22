<?php 
    // base url global variable
    if(!defined("BASE_URL"))
        define("BASE_URL", "https://phpwithmongodb.dev");

    // $pageName = basename($_SERVER["PHP_SELF"]);

    function GenerateNewToken(){
        return bin2hex(random_bytes(32));
    }

    function ExpirationTokenTime(){
        return time() + 1800;    // 30 minutes
    }