<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    $sorgu_ayarlar = $veritaConn -> prepare("SELECT COUNT(id) FROM ayar");
    $sorgu_ayarlar -> execute();
    $foundedCount = $sorgu_ayarlar -> fetchColumn();
    if(($foundedCount < 1)){
        $sorgu_ayarlarSet = $veritaConn -> prepare("INSERT INTO ayar() VALUES()");
        $sorgu_ayarlarSet -> execute();
    }

    if(isset($_POST["site_adi"])){
        $site_adi = SVE_BASIC_INPUT_2($_POST["site_adi"], 50, true);
    }else{
        $site_adi= "";
    }
    if(isset($_POST["site_sirket_kisaAdi"])){
        $site_sirket_kisaAdi = SVE_BASIC_INPUT_2($_POST["site_sirket_kisaAdi"], 255, true);
    }else{
        $site_sirket_kisaAdi= "";
    }
    if(isset($_POST["site_title"])){
        $site_title = SVE_BASIC_INPUT_2($_POST["site_title"], 60, true);
    }else{
        $site_title= "";
    }
    if(isset($_POST["site_description"])){
        $site_description = SVE_BASIC_INPUT_2($_POST["site_description"], 150, true);
    }else{
        $site_description= "";
    }
    if(isset($_POST["site_keywords"])){
        $site_keywords = SVE_BASIC_INPUT_2($_POST["site_keywords"], 255, true);
    }else{
        $site_keywords= "";
    }
    if(isset($_POST["site_copyright_metni"])){
        $site_copyright_metni = SVE_BASIC_INPUT_2($_POST["site_copyright_metni"], 255, true);
    }else{
        $site_copyright_metni= "";
    }
    if(isset($_POST["site_logosu"])){
        $site_logosu = SVE_BASIC_INPUT_2($_POST["site_logosu"], 30, true);
    }else{
        $site_logosu= "";
    }
    if(isset($_POST["site_email_adresi"])){
        $site_email_adresi = SVE_BASIC_INPUT_2($_POST["site_email_adresi"], 50, true);
    }else{
        $site_email_adresi= "";
    }
    if(isset($_POST["site_email_sifresi"])){
        $site_email_sifresi = SVE_BASIC_INPUT_2($_POST["site_email_sifresi"], 50, true);
    }else{
        $site_email_sifresi= "";
    }
    if(isset($_POST["site_email_host_adresi"])){
        $site_email_host_adresi = SVE_BASIC_INPUT_2($_POST["site_email_host_adresi"], 255, true);
    }else{
        $site_email_host_adresi= "";
    }
    if(isset($_POST["site_linki"])){
        $site_linki = SVE_BASIC_INPUT_2($_POST["site_linki"], 255, true);
    }else{
        $site_linki= "";
    }
    if(isset($_POST["site_adres"])){
        $site_adres = SVE_BASIC_INPUT_2($_POST["site_adres"], 400, true);
    }else{
        $site_adres= "";
    }
    if(isset($_POST["site_telefon"])){
        $site_telefon = SVE_BASIC_INPUT_2($_POST["site_telefon"], 20, true);
    }else{
        $site_telefon= "";
    }
    if(isset($_POST["site_calisma_zamanlari"])){
        $site_calisma_zamanlari = SVE_BASIC_INPUT_2($_POST["site_calisma_zamanlari"], 100, true);
    }else{
        $site_calisma_zamanlari= "";
    }
    if(isset($_POST["whatsapp_link"])){
        $whatsapp_link = SVE_BASIC_INPUT_2($_POST["whatsapp_link"], 400, true);
    }else{
        $whatsapp_link= "";
    }
    if(isset($_POST["gmaps_link"])){
        $gmaps_link = SVE_BASIC_INPUT_2($_POST["gmaps_link"], 1000, true);
    }else{
        $gmaps_link= "";
    }
    if(isset($_POST["Sosyal_Link_Facebook"])){
        $Sosyal_Link_Facebook = SVE_BASIC_INPUT_2($_POST["Sosyal_Link_Facebook"], 255, true);
    }else{
        $Sosyal_Link_Facebook= "";
    }
    if(isset($_POST["Sosyal_Link_Twitter"])){
        $Sosyal_Link_Twitter = SVE_BASIC_INPUT_2($_POST["Sosyal_Link_Twitter"], 255, true);
    }else{
        $Sosyal_Link_Twitter= "";
    }
    if(isset($_POST["Sosyal_Link_LinkedIn"])){
        $Sosyal_Link_LinkedIn = SVE_BASIC_INPUT_2($_POST["Sosyal_Link_LinkedIn"], 255, true);
    }else{
        $Sosyal_Link_LinkedIn= "";
    }
    if(isset($_POST["Sosyal_Link_Pinterest"])){
        $Sosyal_Link_Pinterest = SVE_BASIC_INPUT_2($_POST["Sosyal_Link_Pinterest"], 255, true);
    }else{
        $Sosyal_Link_Pinterest= "";
    }
    if(isset($_POST["Sosyal_Link_Instagram"])){
        $Sosyal_Link_Instagram = SVE_BASIC_INPUT_2($_POST["Sosyal_Link_Instagram"], 255, true);
    }else{
        $Sosyal_Link_Instagram= "";
    }
    if(isset($_POST["Sosyal_Link_YouTube"])){
        $Sosyal_Link_YouTube = SVE_BASIC_INPUT_2($_POST["Sosyal_Link_YouTube"], 255, true);
    }else{
        $Sosyal_Link_YouTube= "";
    }
    /*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    die();

    $arroy = [$site_adi, $site_sirket_kisaAdi, $site_title, $site_description, $site_keywords, $site_copyright_metni, $site_logosu, $site_email_adresi, $site_email_sifresi, $site_email_host_adresi, $site_linki, $site_adres, $site_telefon, $site_calisma_zamanlari, $whatsapp_link, $gmaps_link, $Sosyal_Link_Facebook, $Sosyal_Link_Twitter, $Sosyal_Link_LinkedIn, $Sosyal_Link_Pinterest, $Sosyal_Link_Instagram, $Sosyal_Link_YouTube];
    echo "<pre>";
    print_r($arroy);
    echo "</pre>";
    die();
    */


    if(($site_adi == "") or ($site_sirket_kisaAdi == "") or ($site_title == "") or ($site_description == "") or ($site_keywords == "") or ($site_copyright_metni == "") or ($site_logosu == "") or ($site_email_adresi == "") or ($site_email_sifresi == "") or ($site_email_host_adresi == "") or ($site_linki == "") or ($site_adres == "") or ($site_telefon == "") or ($site_calisma_zamanlari == "") or ($whatsapp_link == "") or ($gmaps_link == "") or ($Sosyal_Link_Facebook == "") or ($Sosyal_Link_Twitter == "") or ($Sosyal_Link_LinkedIn == "") or ($Sosyal_Link_Pinterest == "") or ($Sosyal_Link_Instagram == "") or ($Sosyal_Link_YouTube == "")){
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Lütfen bütün alanları doğru ve eksiksiz bir şekilde doldurunuz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=27">Metinler Sayfası</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    $sorgu_ayarGuncelle = $veritaConn -> prepare("UPDATE ayar SET site_adi = ?, site_sirket_kisaAdi = ?, site_title = ?, site_description = ?, site_keywords = ?, site_copyright_metni = ?, site_logosu = ?, site_email_adresi = ?, site_email_sifresi = ?, site_email_host_adresi = ?, site_linki = ?, site_adres = ?, site_telefon = ?, site_calisma_zamanlari = ?, whatsapp_link = ?, gmaps_link = ?, Sosyal_Link_Facebook = ?, Sosyal_Link_Twitter = ?, Sosyal_Link_LinkedIn = ?, Sosyal_Link_Pinterest = ?, Sosyal_Link_Instagram = ?, Sosyal_Link_YouTube = ? WHERE id = 1 LIMIT 1");
    $sorgu_ayarGuncelle -> execute([$site_adi, $site_sirket_kisaAdi, $site_title, $site_description, $site_keywords, $site_copyright_metni, $site_logosu, $site_email_adresi, $site_email_sifresi, $site_email_host_adresi, $site_linki, $site_adres, $site_telefon, $site_calisma_zamanlari, $whatsapp_link, $gmaps_link, $Sosyal_Link_Facebook, $Sosyal_Link_Twitter, $Sosyal_Link_LinkedIn, $Sosyal_Link_Pinterest, $Sosyal_Link_Instagram, $Sosyal_Link_YouTube]);
    $queryErrInfo = $sorgu_ayarGuncelle -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Ayarlar Güncellenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=27">Geri Dön</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Ayarlar Güncellendi!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=27">Geri Dön</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>