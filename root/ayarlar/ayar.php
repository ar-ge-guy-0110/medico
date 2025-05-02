<?php
    //VERITABANI BAGLANTISI
    try{
        $db_config = parse_ini_file('../creek.ini');
        $veritaConn_String1 = 'mysql:host=' . $db_config['servername'] . ';dbname=' . $db_config['database'] . ';charset=UTF8;';
        $veritaConn_String2 = $db_config['username'];
        $veritaConn_String3 = $db_config['password'];
        $veritaConn = new PDO($veritaConn_String1, $veritaConn_String2, $veritaConn_String3);
    }catch(PDOException $hata){
        //echo "Bağlantı Hatası: <br />" . $hata->getMessage();
        die();
    }
    //

    //ANA SITE BILGILERI
    $sorgu_ayarlar = $veritaConn->prepare("SELECT * FROM ayar LIMIT 1");
    $sorgu_ayarlar-> execute();
    $ayarSayisi = $sorgu_ayarlar -> rowCount();
    $ayar = $sorgu_ayarlar -> fetch(PDO::FETCH_ASSOC);
    
    if($ayarSayisi > 0){
        $site_adi = $ayar["site_adi"];
        $site_title = $ayar["site_title"];
        $site_sirket_kisaAdi = $ayar["site_sirket_kisaAdi"];
        $site_description = $ayar["site_description"];
        $site_keywords = $ayar["site_keywords"];
        $site_copyright_metni = $ayar["site_copyright_metni"];
        $site_logosu = $ayar["site_logosu"];
        $site_email_adresi = $ayar["site_email_adresi"];
        $site_email_sifresi = $ayar["site_email_sifresi"];
        $site_email_host_adresi = $ayar["site_email_host_adresi"];
        $site_adres = $ayar["site_adres"];
        $site_linki = $ayar["site_linki"];
        $site_telefon = $ayar["site_telefon"];
        $site_calisma_zamanlari = $ayar["site_calisma_zamanlari"];
        $whatsapp_link = $ayar["whatsapp_link"];
        $gmaps_link = $ayar["gmaps_link"];
        $soslink_facebook = $ayar["Sosyal_Link_Facebook"];
        $soslink_twitter = $ayar["Sosyal_Link_Twitter"];
        $soslink_linkedin = $ayar["Sosyal_Link_LinkedIn"];
        $soslink_pinterest = $ayar["Sosyal_Link_Pinterest"];
        $soslink_instagram = $ayar["Sosyal_Link_Instagram"];
        $soslink_youtube = $ayar["Sosyal_Link_YouTube"];
    }else{
        //echo "Site Ayarları Sorgusu Hatası!";
        die();
    }

    $sorgu_hakkimizda = $veritaConn -> prepare("SELECT hakkimizda FROM temelyazi WHERE id = 1 LIMIT 1");
    $sorgu_hakkimizda -> execute();
    $hakkimizdaYazi = $sorgu_hakkimizda -> fetch(PDO::FETCH_ASSOC);
    //

    //OTURUMDAKI KULLANICI SORGUSU
    if(isset($_SESSION["anuser"])){
        $query_user = $veritaConn -> prepare("SELECT uye.id, uye.uye_birim, uye.uye_tamisim, uye.uye_kullaniciAdi, uye.uye_sifre, uye.uye_telno, uye.uye_durum, birim.birim_ad, birim.birim_sayfa, birim.birim_seviye FROM uye JOIN birim ON uye.uye_birim = birim.id WHERE uye.uye_kullaniciAdi = ? LIMIT 1");
        $query_user -> execute([$_SESSION["anuser"]]);
        $userCount = $query_user -> rowCount();
        $anuser = $query_user -> fetch(PDO::FETCH_ASSOC);
        if($userCount > 0){
            $user_id = $anuser["id"];
            $user_permissionId = $anuser["uye_birim"];
            $user_username = $anuser["uye_kullaniciAdi"];
            $user_password = $anuser["uye_sifre"];
            $user_fullName = $anuser["uye_kullaniciAdi"];
            $user_phoneNumber = $anuser["uye_telno"];
            $user_state = $anuser["uye_durum"];
            $user_permissionName = $anuser["birim_ad"];
            $user_page = $anuser["birim_sayfa"];
            $user_permissionLevel = $anuser["birim_seviye"];
        }
    }
    //
?>