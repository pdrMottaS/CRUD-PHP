<?php
    function chave(){
        $randkey = base64_encode(openssl_random_pseudo_bytes(6));
        return $randkey;
    }
?>