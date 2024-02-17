<?php

    trait csrfToken{

        public function GenerateNewToken(){
            return bin2hex(random_bytes(32));
        }

        public function ExpirationTokenTime(){
            // 30 minutes
            return time() + 1800;
        }
    }