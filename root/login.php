<?php
    if(!isset($_SESSION["anuser"])){
        CheckUserSession(0);
    }else{
        header("Location:index.php");
    }
    $touken = CreateFormToken();
    $_SESSION["touken"] = $touken;
?>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Giriş</span></div>
        <form action="index.php?mdl=4" method="post">
            <input type="hidden" name="TT" value="<?php echo $touken; ?>">
            <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" maxLength="30" placeholder="Kullanıcı Adı" name="kAdi">
            </div>
            <div class="row">
                <i class="fas fa-lock"></i>
                <input type="password" maxLength="30" placeholder="Şifre" name="kSifre">
            </div>
            <div class="row button">
                <input type="submit" value="Giriş Yap">
            </div>
        </form>
    </div>
</div>