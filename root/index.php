<?php
    session_start(); ob_start();
    require_once("ayarlar/ayar.php");
    require_once("ayarlar/fonksiyonlar.php");
    require_once("ayarlar/site_sayfalari.php");
    if(isset($_REQUEST["mdl"])){
        $module_value = SVE_BASIC_INPUT(SayiliIcerikleriFiltrele($_REQUEST["mdl"]), 2, false, true, true);
    }else{
        $module_value = 0;
    }
?>
<!doctype html>
<html lang="tr-TR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <meta http-equiv="Content-Language" content="tr">
        <meta charset="utf8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robots" content="index, follow">
        <meta name="googlebot" content="index, follow">
        <title><?php echo DonusumleriGeriDondur($site_title); ?></title>
        <link type="image/svg" rel="icon" href="<?php echo DonusumleriGeriDondur($site_logosu); ?>">
        <meta name="description" content="<?php echo DonusumleriGeriDondur($site_description); ?>">
        <meta name="keywords" content="<?php echo DonusumleriGeriDondur($site_keywords); ?>">
        <script type="text/javascript" src="frameworks/JQuery/jquery-3.6.0.min.js" language="javascript"></script>
        <link href="frameworks/fontAwesome/css/all.css" rel="stylesheet">
        <link href="frameworks/RemixIcon/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="frameworks/medico/css/normalize.css">
        <link type="text/css" rel="stylesheet" href="<?php if(isset($csscode[$module_value])){ echo $csscode[$module_value]; } ?>">
        <script type="text/javascript" src="frameworks/medico/js/fonksiyonlar.js" language="javascript"></script>
    </head>
    <body>
        <?php
            if((!$module_value) or ($module_value == "") or ($module_value == 0) or ($module_value > $lastcode)){
                include($pagecode[0]);
            }else{
                include($pagecode[$module_value]);
            }
        ?>
    </body>
</html>
<?php
    $veritaConn = null;
    ob_end_flush();
?>