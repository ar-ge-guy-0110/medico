<?php
    //session ve seviye kontrol
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
    //1. bosmu dolumu ona bak sonra etkisizlestir
    if(isset($_GET["id"])){
        $gelen_id = SVE_BASIC_INPUT($_GET["id"], 3, false, true, true);
    }else{
        $gelen_id = "";
    }
    if($gelen_id == ""){
        $_SESSION["message_main"] = 'HATA!';
        $_SESSION["message_comment"] = 'ID GELMEDI.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
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
    $sorgu_varolanResimAl = $veritaConn -> prepare("SELECT resim FROM blogyazi WHERE id = ? LIMIT 1");
    $sorgu_varolanResimAl ->  execute([$gelen_id]);
    $queryErrInfo = $sorgu_varolanResimAl -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Blog Paylaşımı Bilgisi Alınamadı. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $sorguresimfetch = $sorgu_varolanResimAl -> fetch(PDO::FETCH_ASSOC);
   
    if(isset($sorguresimfetch["resim"])){
        $varolan_resim = SVE_BASIC_INPUT($sorguresimfetch["resim"], 100);
    }else{
        $varolan_resim = "";
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

    //2. zorunlu alanlar for veritabanı girisi
    if(($baslik == "") or ($metin == "") or ($kisametin == "")){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen bütün alanları doğru ve eksiksiz bir şekilde doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    //islemler: dosya islemleri
    /*
    $allowedTypes = ['image/png'     => 'png', 'image/jpeg'    => 'jpg'];
    $resimyeri = $siteKokDizin . "/resimler";
    $buyukResimDizini = FileUpload($buyukResim, $resimyeri, $siteKokDizin, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=6", "index.php?mdl=2", "Geri Dön");
    $buyukResimDizini = $buyukResimDizini["fileDirectoryFromRoot"];
    $kucukResimDizini = FileUpload($kucukResim, $resimyeri, $siteKokDizin, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=6", "index.php?mdl=2", "Geri Dön");
    $kucukResimDizini = $kucukResimDizini["fileDirectoryFromRoot"];
    */
    $allowedTypes = ['image/png'     => 'png', 'image/jpeg'    => 'jpg'];
    $resimyeri = $siteKokDizin . "/resimler";
    $backupResimYeri = $siteKokDizin . "/resimage";
    $varolan_buyukResim_fullPath = $siteKokDizin . "/" . $varolan_buyukResim;

    if($resimUygun){
        $resimDizini = FileUploadForUpdate($resim, $resimyeri, $siteKokDizin, $varolan_resim, $backupResimYeri, 3145728, $allowedTypes, "index.php?mdl=6&mdlsp1=21", "index.php?mdl=2", "Geri Dön");
        $resimDizini = $resimDizini["fileDirectoryFromRoot"];
    }

    //işlemler: veritabanı işlemleri
    $string_sorgu_bas = "UPDATE blogyazi SET ";
    $string_sorgu_orta = "baslik = ?, metin = ?, kisametin = ?";
    $string_sorgu_son = " WHERE";
    $string_sorgu_hepsi = "";
    $array_executable = array($baslik, $metin, $kisametin);
    //UPDATE hizmet SET isim = ?, metin = ?, kisaAciklama = ?, slideDurum = ?, galeriDurum = ? WHERE, buyukResim = ?, kucukResim = ? WHERE
    if($resimUygun){
        if(strlen($string_sorgu_orta) > 0){
            $string_sorgu_orta .= ", ";
        }
        $string_sorgu_orta .= "resim = ?";
        $array_executable[count($array_executable)] = $resimDizini;
    }
    //According to What?
    $string_sorgu_son .= " id = ?";
    $array_executable[count($array_executable)] = $gelen_id;
    $string_sorgu_hepsi = $string_sorgu_bas . $string_sorgu_orta . $string_sorgu_son;
    $sorgu_postGuncelle = $veritaConn -> prepare($string_sorgu_hepsi);
    $sorgu_postGuncelle -> execute($array_executable);
    $queryErrInfo = $sorgu_postGuncelle -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Blog Paylaşımı Güncellenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Blog Paylaşımı Başarıyla Güncellendi!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>