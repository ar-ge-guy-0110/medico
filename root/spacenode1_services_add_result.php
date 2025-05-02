<?php
    //session ve seviye kontrol
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
    //1. bosmu dolumu ona bak sonra etkisizlestir
    if(isset($_POST["isim"])){
        $gelen_isim = SVE_BASIC_INPUT_2($_POST["isim"], 100, true);
    }else{
        $gelen_isim = "";
    }
    if(isset($_POST["metin"])){
        $gelen_metin = SVE_BASIC_INPUT_2($_POST["metin"], 65535, true);
    }else{
        $gelen_metin= "";
    }
    if(isset($_POST["kisaAciklama"])){
        $gelen_kisaAciklama = SVE_BASIC_INPUT_2($_POST["kisaAciklama"], 400, true);
    }else{
        $gelen_kisaAciklama = "";
    }
    //file1
    $boolBuyukResimUygun = false;
    if(isset($_FILES["buyukResim"])){
        $buyukResim = $_FILES["buyukResim"];
        $buyukResim['name'] = SVE_BASIC_INPUT($buyukResim['name'], 50);
        $buyukResim['type'] = SVE_BASIC_INPUT($buyukResim['type'], 10);
        $buyukResim['size'] = SVE_BASIC_INPUT($buyukResim['size'], 100, false, true, true);
        $buyukResim['tmp_name'] = SVE_BASIC_INPUT($buyukResim['tmp_name'], 50);
        $buyukResim['error'] = SVE_BASIC_INPUT($buyukResim['error'], 1, false, true, true);
        $buyukResim['full_path'] = "";
        if(($buyukResim['name'] != "") and ($buyukResim['type'] != "") and ($buyukResim['size'] > "") and ($buyukResim['tmp_name'] != "") and ($buyukResim['error'] == 0)){
            $boolBuyukResimUygun = true;
        }
    }else{
        $buyukResim = "";
    }
    //
    //file2
    $boolKucukResimUygun = false;
    if(isset($_FILES["kucukResim"])){
        $kucukResim = $_FILES["kucukResim"];
        $kucukResim['name'] = SVE_BASIC_INPUT($kucukResim['name'], 50);
        $kucukResim['type'] = SVE_BASIC_INPUT($kucukResim['type'], 10);
        $kucukResim['size'] = SVE_BASIC_INPUT($kucukResim['size'], 100, false, true, true);
        $kucukResim['tmp_name'] = SVE_BASIC_INPUT($kucukResim['tmp_name'], 50);
        $kucukResim['error'] = SVE_BASIC_INPUT($kucukResim['error'], 1, false, true, true);
        $kucukResim['full_path'] = "";
        if(($kucukResim['name'] != "") and ($kucukResim['type'] != "") and ($kucukResim['size'] > 0) and ($kucukResim['tmp_name'] != "") and ($kucukResim['error'] == 0)){
            $boolKucukResimUygun = true;
        }
    }else{
        $kucukResim = "";
    }
    //
    if(isset($_POST["slideDurum"])){
        $gelen_slideDurum = SVE_BASIC_INPUT($_POST["slideDurum"], 1, false, true, true);
    }else{
        $gelen_slideDurum = 0;
    }
    if(isset($_POST["galeriDurum"])){
        $gelen_galeriDurum = SVE_BASIC_INPUT($_POST["galeriDurum"], 1, false, true, true);
    }else{
        $gelen_galeriDurum = 0;
    }

    //2. zorunlu alanlar for veritabanı girisi
    if(($gelen_isim == "") or ($gelen_metin == "") or ($gelen_kisaAciklama == "") or !$boolBuyukResimUygun or !$boolKucukResimUygun){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen bütün alanları doğru ve eksiksiz bir şekilde doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=6">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    //islemler: dosya islemleri
    $allowedTypes = ['image/png'     => 'png', 'image/jpeg'    => 'jpg'];
    $resimyeri = $siteKokDizin . "/resimler";
    //$kucukResim, $resimyeri, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=6", "index.php?mdl=2", "Geri Dön"
    $buyukResimDizini = FileUpload($buyukResim, $resimyeri, $siteKokDizin, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=6", "index.php?mdl=2", "Geri Dön");
    $buyukResimDizini = $buyukResimDizini["fileDirectoryFromRoot"];
    $kucukResimDizini = FileUpload($kucukResim, $resimyeri, $siteKokDizin, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=6", "index.php?mdl=2", "Geri Dön");
    $kucukResimDizini = $kucukResimDizini["fileDirectoryFromRoot"];

    //işlemler: veritabanı işlemleri
    $sorgu_hizmetEkle = $veritaConn -> prepare("INSERT INTO hizmet(isim, metin, kisaAciklama, buyukResim, kucukResim, slideDurum, galeriDurum) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $sorgu_hizmetEkle -> execute([$gelen_isim, $gelen_metin, $gelen_kisaAciklama, $buyukResimDizini, $kucukResimDizini, $gelen_slideDurum, $gelen_galeriDurum]);
    $queryErrInfo = $sorgu_hizmetEkle -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Hizmet Eklenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=6">Hizmetler Sayfası</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Hizmet Başarıyla Oluşturuldu!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=6">Hizmetler Sayfası</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>