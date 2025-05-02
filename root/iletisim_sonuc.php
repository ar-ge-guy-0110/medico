<?php
    if(isset($_POST['TT'])){
        $touken = SVE_BASIC_INPUT($_POST['TT'], 32);
    }else{
        $touken = "";
    }
    if($touken != $_SESSION['touken']){
        header("Location:index.php"); //soae 1 = yönetici ana sayfası (base)
        exit();
    }
    if(isset($_POST["name"])){
        $gelen_isim = SVE_BASIC_INPUT($_POST["name"], 30);
    }else{
        $gelen_isim = "";
    }
    if(isset($_POST["email"])){
        $gelen_eposta = SVE_BASIC_INPUT($_POST["email"], 50);
    }else{
        $gelen_eposta = "";
    }
    if(isset($_POST["info"])){
        $gelen_mesaj = SVE_BASIC_INPUT($_POST["info"], 400);
    }else{
        $gelen_mesaj = "";
    }

    //--exstra kontroller
    if(($touken == "") or ($gelen_isim == "") or ($gelen_eposta == "") or ($gelen_mesaj == "")){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen tüm alanları doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    //--

    $sorgu_mesajGonder = $veritaConn -> prepare("INSERT INTO mesaj(isim, eposta, mesaj, ipAdresi, gonderimTarihi) VALUES(?, ?, ?, ?, ?) LIMIT 1");
    $sorgu_mesajGonder -> execute([$gelen_isim, $gelen_eposta, $gelen_mesaj, $ip_adresi, $tarihSaatMYSQL]);
    $queryErrInfo = $sorgu_mesajGonder -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Mesaj Gönderilemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Mesajınız Başarıyla Gönderildi.';
    $_SESSION["message_routing"] = '<a href="index.php">Ana Sayfa</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>