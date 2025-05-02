<?php
    CheckUserSession(0);
    //Degisken Kontrolleri
    if(isset($_POST['TT'])){
        $touken = SVE_BASIC_INPUT($_POST['TT'], 32);
    }else{
        $touken = "";
    }
    if($touken != $_SESSION['touken']){
        header("Location:index.php"); //soae 1 = yönetici ana sayfası (base)
        exit();
    }
    if(isset($_POST["kAdi"])){
        $incoming_userName = SVE_BASIC_INPUT($_POST["kAdi"], 30);
    }else{
        $incoming_userName = "";
    }
    if(isset($_POST["kSifre"])){
        $incoming_userPassword = SVE_BASIC_INPUT($_POST["kSifre"], 30);
    }else{
        $incoming_userPassword = "";
    }
    //
    //ISLEM
    if(($incoming_userName != "") and ($incoming_userPassword != "")){
        $md5pass = md5($incoming_userPassword);

        $query_user_control = $veritaConn -> prepare("SELECT uye.uye_kullaniciAdi, uye.uye_sifre, uye.uye_durum FROM uye WHERE uye.uye_kullaniciAdi = ? AND uye.uye_sifre = ? AND uye.uye_durum = ?");
        $query_user_control -> execute([$incoming_userName, $md5pass, 1]);
        $userCount = $query_user_control -> rowCount();
        $anuser = $query_user_control -> fetch(PDO::FETCH_ASSOC);

        if($userCount > 0){
            if($anuser["uye_durum"] == 1){
                $_SESSION["anuser"] = $incoming_userName;
                if($_SESSION["anuser"] == $incoming_userName){
                    //LOG IN
                    header("Location:index.php?mdl=5");
                    exit();
                }else{
                    $_SESSION["message_main"] = 'Hata!';
                    $_SESSION["message_comment"] = 'Üye Girişi Yapılamadı. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
                    $_SESSION["message_routing"] = '<a href="index.php?mdl=3">Ana Sayfa</a>';
                    $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
                    header("Location:index.php?mdl=2");
                    exit();
                }
            }else{
                $_SESSION["message_main"] = 'Dikkat!';
                $_SESSION["message_comment"] = 'Üyeliğinizin Onayı Yok. Sistem Yöneticisine Başvurunuz.';
                $_SESSION["message_routing"] = '<a href="index.php?mdl=3">Ana Sayfa</a>';
                $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
                header("Location:index.php?mdl=2");
                exit();
            }
        }else{
            $_SESSION["message_main"] = 'Dikkat!';
            $_SESSION["message_comment"] = 'Üye giriş formu dahilinde yazmış olduğunuz bilgiler ile eşleşen herhangi bir kayıt bulunamadı.';
            $_SESSION["message_routing"] = '<a href="index.php?mdl=3">Ana Sayfa</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
            header("Location:index.php?mdl=2");
            exit();
        }
    }else{
        $_SESSION["message_main"] = 'Dikkat!';
        $_SESSION["message_comment"] = 'Üye giriş formu dahilinde lütfen gerekli alanları doldurarak tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=3">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    //
?>