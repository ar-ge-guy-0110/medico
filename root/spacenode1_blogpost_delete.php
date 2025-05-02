<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    if(isset($_GET["id"])){
        $incoming_id = SVE_BASIC_INPUT($_GET["id"], 3, false, true, true);
    }else{
        $incoming_id = "";
    }
    if($incoming_id == ""){
        $_SESSION["message_main"] = 'HATA!';
        $_SESSION["message_comment"] = 'ID GELMEDI.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    $sorgu_varolanResimAl = $veritaConn -> prepare("SELECT resim FROM blogyazi WHERE id = ? LIMIT 1");
    $sorgu_varolanResimAl ->  execute([$incoming_id]);
    $queryErrInfo = $sorgu_varolanResimAl -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Blog Paylaşımı Bilgisi Alınamadı. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $resim = $sorgu_varolanResimAl -> fetch(PDO::FETCH_ASSOC);
    unlink($resim["resim"]);
    $query_postSil = $veritaConn -> prepare("DELETE FROM blogyazi WHERE id = ?");
    $query_postSil -> execute([$incoming_id]);
    $queryErrInfo = $query_postSil -> errorInfo();
    if($queryErrInfo[0] != "00000"){
        $_SESSION["message_main"] = 'Hata!';
        $_SESSION["message_comment"] = 'Blog Paylaşımı Silinemedi. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }
    $_SESSION["message_main"] = 'Tebrikler.';
    $_SESSION["message_comment"] = 'Blog Paylaşımı Başarıyla Silindi!';
    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=21">Geri Dön</a>';
    $_SESSION["image_path"] = '<h2 style="color: rgba(102, 255, 0, 0.4);"><i class="fa-solid fa-circle-check"></i></h2>';
    header("Location:index.php?mdl=2");
    exit();
?>