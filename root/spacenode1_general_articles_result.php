<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    $sorgu_temelMetinler = $veritaConn -> prepare("SELECT COUNT(id) FROM temelyazi");
    $sorgu_temelMetinler -> execute();
    $foundedCount = $sorgu_temelMetinler -> fetchColumn();
    if(($foundedCount < 1)){
        $sorgu_metinlerSet = $veritaConn -> prepare("INSERT INTO temelyazi() VALUES()");
        $sorgu_metinlerSet -> execute();
    }

    if(isset($_POST["hakkimizda"])){
        $gelen_hakkimizda = SVE_BASIC_INPUT_2($_POST["hakkimizda"], 65535, true);
    }else{
        $gelen_hakkimizda= "";
    }
    if(isset($_POST["misyon"])){
        $gelen_misyon = SVE_BASIC_INPUT_2($_POST["misyon"], 65535, true);
    }else{
        $gelen_misyon= "";
    }
    if(isset($_POST["vizyon"])){
        $gelen_vizyon = SVE_BASIC_INPUT_2($_POST["vizyon"], 65535, true);
    }else{
        $gelen_vizyon= "";
    }
    if(isset($_POST["degerlerimiz"])){
        $gelen_degerlerimiz = SVE_BASIC_INPUT_2($_POST["degerlerimiz"], 65535, true);
    }else{
        $gelen_degerlerimiz= "";
    }
    if(isset($_POST["kavh"])){
        $gelen_kavh = SVE_BASIC_INPUT_2($_POST["kavh"], 65535, true);
    }else{
        $gelen_kavh= "";
    }
    if(isset($_POST["gizlilik"])){
        $gelen_gizlilik = SVE_BASIC_INPUT_2($_POST["gizlilik"], 65535, true);
    }else{
        $gelen_gizlilik= "";
    }

    if(($gelen_hakkimizda == "") or ($gelen_misyon == "") or ($gelen_vizyon == "") or ($gelen_degerlerimiz == "") or ($gelen_kavh == "") or ($gelen_gizlilik == "")){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen bütün alanları doğru ve eksiksiz bir şekilde doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=11">Metinler Sayfası</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    $sorgu_temelMetinleriGuncelle = $veritaConn -> prepare("UPDATE temelyazi SET hakkimizda = ?, misyon = ?, vizyon = ?, degerlerimiz = ?, kurumsalAmacVeHedefler = ?, gizlilikSozlesmesi = ? WHERE id = 1 LIMIT 1");
    $sorgu_temelMetinleriGuncelle -> execute([$gelen_hakkimizda, $gelen_misyon, $gelen_vizyon, $gelen_degerlerimiz, $gelen_kavh, $gelen_gizlilik]);
    $queryErrInfo = $sorgu_temelMetinleriGuncelle -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Yazılar Güncellenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=11">Metinler Sayfası</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Metinler Güncellendi!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=11">Metinler Sayfası</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>