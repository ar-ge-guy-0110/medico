<?php
    CheckUserSession(1);
    unset($_SESSION["anuser"]);
    session_destroy();
    header("Location:index.php");
    exit();
?>