<?php
    require("ayarlar/funcs_creds.php");
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    if(isset($_POST["kAdi"])){
        $incoming_username = SVE_BASIC_INPUT($_POST["kAdi"], 30);
    }else{
        $incoming_username = "";
    }
    if(isset($_POST["kSifre"])){
        $incoming_password = SVE_BASIC_INPUT($_POST["kSifre"], 30);
    }else{
        $incoming_password = "";
    }
    if(isset($_POST["kSifreTekrar"])){
        $incoming_passwordRe = SVE_BASIC_INPUT($_POST["kSifreTekrar"], 30);
    }else{
        $incoming_passwordRe = "";
    }
    if(isset($_POST["kTamIsim"])){
        $incoming_fullname = SVE_BASIC_INPUT($_POST["kTamIsim"], 30);
    }else{
        $incoming_fullname = "";
    }
    if(isset($_POST["kTelNo"])){
        $incoming_phoneNumber = SVE_BASIC_INPUT($_POST["kTelNo"], 11);
    }else{
        $incoming_phoneNumber = "";
    }

    UpdateCredentials($incoming_username, $incoming_password, $incoming_passwordRe, $incoming_fullname, $incoming_phoneNumber, $veritaConn, $user_id, $user_username, $user_phoneNumber);
?>