<?php
    //session ve seviye kontrol
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
    //1. bosmu dolumu ona bak sonra etkisizlestir
    if(isset($_POST["metin"])){
        $metin = SVE_BASIC_INPUT_2($_POST["metin"], 400, true);
    }else{
        $metin = "";
    }
    if(isset($_POST["isim"])){
        $isim = SVE_BASIC_INPUT_2($_POST["isim"], 50, true);
    }else{
        $isim= "";
    }
    if(isset($_POST["gorev"])){
        $gorev = SVE_BASIC_INPUT_2($_POST["gorev"], 50, true);
    }else{
        $gorev = "";
    }
    //file1
    $resimUygun = false;
    if(isset($_FILES["resim"])){
        $resim = $_FILES["resim"];
        $resim['name'] = SVE_BASIC_INPUT($resim['name'], 50);
        $resim['type'] = SVE_BASIC_INPUT($resim['type'], 10);
        $resim['size'] = SVE_BASIC_INPUT($resim['size'], 100, false, true, true);
        $resim['tmp_name'] = SVE_BASIC_INPUT($resim['tmp_name'], 50);
        $resim['error'] = SVE_BASIC_INPUT($resim['error'], 1, false, true, true);
        $resim['full_path'] = "";
        if(($resim['name'] != "") and ($resim['type'] != "") and ($resim['size'] > "") and ($resim['tmp_name'] != "") and ($resim['error'] == 0)){
            $resimUygun = true;
        }
    }else{
        $resim = "";
    }
    //

    //2. zorunlu alanlar for veritabanı girisi
    if(($metin == "") or ($isim == "") or ($gorev == "") or !$resimUygun){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen bütün alanları doğru ve eksiksiz bir şekilde doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=15">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    //islemler: dosya islemleri
    $allowedTypes = ['image/png'     => 'png', 'image/jpeg'    => 'jpg'];
    $resimyeri = $siteKokDizin . "/resimler";
    //$kucukResim, $resimyeri, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=6", "index.php?mdl=2", "Geri Dön"
    $resimDizini = FileUpload($resim, $resimyeri, $siteKokDizin, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=15", "index.php?mdl=2", "Geri Dön");
    $resimDizini = $resimDizini["fileDirectoryFromRoot"];

    //işlemler: veritabanı işlemleri
    $sorgu_yorumEkle = $veritaConn -> prepare("INSERT INTO hastayorum(metin, isim, gorev, resimYolu) VALUES(?, ?, ?, ?)");
    $sorgu_yorumEkle -> execute([$metin, $isim, $gorev, $resimDizini]);
    $queryErrInfo = $sorgu_yorumEkle -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Hasta Yorumu Eklenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=15">Hizmetler Sayfası</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Hasta Yorumu Başarıyla Oluşturuldu!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=15">Geri Dön</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>