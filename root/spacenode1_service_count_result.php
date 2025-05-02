<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    $sorgu_hizmetSayilari = $veritaConn -> prepare("SELECT COUNT(id) FROM hizmetsayi");
    $sorgu_hizmetSayilari -> execute();
    $foundedCount = $sorgu_hizmetSayilari -> fetchColumn();
    if(($foundedCount < 1)){
        $sorgu_sayilarSet = $veritaConn -> prepare("INSERT INTO hizmetsayi() VALUES()");
        $sorgu_sayilarSet -> execute();
    }

    if(isset($_POST["mutluHastaYakini"])){
        $mutluHastaYakini = SVE_BASIC_INPUT($_POST["mutluHastaYakini"], 9, false, true, true);
    }else{
        $mutluHastaYakini = "";
    }
    if(isset($_POST["saglikIslemi"])){
        $saglikIslemi = SVE_BASIC_INPUT($_POST["saglikIslemi"], 9, false, true, true);
    }else{
        $saglikIslemi = "";
    }
    if(isset($_POST["hasta"])){
        $hasta = SVE_BASIC_INPUT($_POST["hasta"], 9, false, true, true);
    }else{
        $hasta = "";
    }
    if(isset($_POST["calisan"])){
        $calisan = SVE_BASIC_INPUT($_POST["calisan"], 9, false, true, true);
    }else{
        $calisan = "";
    }

    if(($mutluHastaYakini == "") or ($saglikIslemi == "") or ($hasta == "") or ($calisan == "")){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen bütün alanları doğru ve eksiksiz bir şekilde doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=13">Hizmet Sayıları Sayfası</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    $sorgu_hizmetSayilariGuncelle = $veritaConn -> prepare("UPDATE hizmetsayi SET mutluHastaYakini = ?, saglikIslemi = ?, hasta = ?, calisan = ? WHERE id = 1 LIMIT 1");
    $sorgu_hizmetSayilariGuncelle -> execute([$mutluHastaYakini, $saglikIslemi, $hasta, $calisan]);
    $queryErrInfo = $sorgu_hizmetSayilariGuncelle -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Hizmet Sayıları Güncellenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=13">Metinler Sayfası</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Hizmet Sayıları Güncellendi!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=13">Metinler Sayfası</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>