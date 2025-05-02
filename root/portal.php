<?php
    CheckUserSession(1);
    //Page Query OLD
    if(isset($user_page)){
        $headstr = "Location:" . $user_page;
        header($headstr);
        exit();
    }else{
        header("Location:index.php");
        exit();
    }
    
?>