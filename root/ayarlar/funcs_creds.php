<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    function UpdateCredentials($username, $password, $passwordRe, $fullname, $phoneNumber, $databaseObject, $loggedUserId, $loggedUserName, $loggedUserPhoneNumber){
        //1--değişkenler doğru olmalı, güvenli olmalı ve boş olmamalı
        if(!(($username != "") and ($password != "") and ($passwordRe != "") and ($fullname != "") and ($phoneNumber != "") and ($databaseObject != "") and ($loggedUserId != "") and ($loggedUserName != "") and ($loggedUserPhoneNumber != ""))){
            $_SESSION["message_main"] = 'Dikkat!';
            $_SESSION["message_comment"] = 'Lütfen tüm alanları doldurunuz.';
            $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=1">Hesap Sayfası</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
            header("Location:index.php?mdl=2");
            exit();
        }
        //--
        //2--şifreler uyuşmalı
        if(!($password == $passwordRe)){
            $_SESSION["message_main"] = 'Dikkat!';
            $_SESSION["message_comment"] = 'Yazmış olduğunuz şifreler eşleşmemektedir.';
            $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=1">Hesap Sayfası</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
            header("Location:index.php?mdl=2");
            exit();
        }
        //--
        //3--kullanıcı adı eşsiz olmalı (kendi adı olursa güncellesin)
        $query_compareUsername = $databaseObject -> prepare("SELECT COUNT(uye_kullaniciAdi) FROM uye WHERE uye_kullaniciAdi = ? AND uye_kullaniciAdi != ?;");
        $query_compareUsername -> execute([$username, $loggedUserName]);
        $foundedCount = $query_compareUsername -> fetchColumn();
        if($foundedCount > 0){
            $_SESSION["message_main"] = 'Dikkat!';
            $_SESSION["message_comment"] = 'Kullanıcı İsmi başka bir üye tarafından kullanılmaktadır. Lütfen farklı bilgiler girerek tekrar deneyiniz.';
            $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=1">Ana Sayfa</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
            header("Location:index.php?mdl=2");
            exit();
        }
        //--
        //4--telefon numarası eşsiz olmalı (kendi telefonu olursa güncellesin)
        $query_comparePhoneNumber = $databaseObject -> prepare("SELECT COUNT(uye_telno) FROM uye WHERE uye_telno = ? AND uye_telno != ?;");
        $query_comparePhoneNumber -> execute([$phoneNumber, $loggedUserPhoneNumber]);
        $foundedCount = $query_comparePhoneNumber -> fetchColumn();
        if($foundedCount > 0){
            $_SESSION["message_main"] = 'Dikkat!';
            $_SESSION["message_comment"] = 'Telefon Numarası başka bir üye tarafından kullanılmaktadır. Lütfen farklı bilgiler girerek tekrar deneyiniz.';
            $_SESSION["message_routing"] = '<a href="index.php?mdl=5&mdlsp1=1">Ana Sayfa</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
            header("Location:index.php?mdl=2");
            exit();
        }
        //--
        //--GET THE JOB DONE
        $md5pass = md5($password);
        $query_updateCreds = $databaseObject -> prepare("UPDATE uye SET uye.uye_kullaniciAdi = ?, uye.uye_sifre = ?, uye.uye_tamisim = ?, uye.uye_telno = ? WHERE id = ?");
        $query_updateCreds -> execute([$username, $md5pass, $fullname, $phoneNumber, $loggedUserId]);
        $queryErrInfo = $query_updateCreds -> errorInfo();
        if(!($queryErrInfo[0] == "00000")){
            $_SESSION["message_main"] = 'Hata!';
            $_SESSION["message_comment"] = 'Hesabınız güncellenemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
            $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=1">Ana Sayfa</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
            header("Location:index.php?mdl=2");
            exit();
        }
        $_SESSION["message_main"] = 'Tebrikler.';
        $_SESSION["message_comment"] = 'Hesabınız Güncellendi.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=7">Yeniden Giriş Yap</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
        //
    }
?>