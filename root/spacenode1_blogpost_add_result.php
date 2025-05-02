<?php
    //session ve seviye kontrol
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
    //1. bosmu dolumu ona bak sonra etkisizlestir
    if(isset($_POST["baslik"])){
        $baslik = SVE_BASIC_INPUT_2($_POST["baslik"], 100, true);
    }else{
        $baslik= "";
    }
    if(isset($_POST["metin"])){
        $metin = SVE_BASIC_INPUT_2($_POST["metin"], 65535, true);
    }else{
        $metin = "";
    }
    if(isset($_POST["kisametin"])){
        $kisametin = SVE_BASIC_INPUT_2($_POST["kisametin"], 400, true);
    }else{
        $kisametin= "";
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
    if(($baslik == "") or ($metin == "") or ($kisametin == "") or !$resimUygun){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen bütün alanları doğru ve eksiksiz bir şekilde doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    //islemler: dosya islemleri
    $allowedTypes = ['image/png'     => 'png', 'image/jpeg'    => 'jpg'];
    $resimyeri = $siteKokDizin . "/resimler";
    //$kucukResim, $resimyeri, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=6", "index.php?mdl=2", "Geri Dön"
    $resimDizini = FileUpload($resim, $resimyeri, $siteKokDizin, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=21", "index.php?mdl=2", "Geri Dön");
    $resimDizini = $resimDizini["fileDirectoryFromRoot"];

    //işlemler: veritabanı işlemleri
    $sorgu_postEkle = $veritaConn -> prepare("INSERT INTO blogyazi(baslik, metin, kisametin, resim) VALUES(?, ?, ?, ?)");
    $sorgu_postEkle -> execute([$baslik, $metin, $kisametin, $resimDizini]);
    $queryErrInfo = $sorgu_postEkle -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Blog Paylaşımı Eklenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Blog Paylaşımı Başarıyla Oluşturuldu!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>