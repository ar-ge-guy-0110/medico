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
        $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=5">Ana Sayfa</a>';
        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
        header("Location:index.php?mdl=2");
        exit();
    }

    $sorgu_hizmetGetir = $veritaConn -> prepare("SELECT * FROM hizmet WHERE id = ? LIMIT 1");
    $sorgu_hizmetGetir -> execute([$gelen_id]);
    $hizmet = $sorgu_hizmetGetir -> fetch(PDO::FETCH_ASSOC);
?>
<style>
.form-element .form-control{
    width: 100%;
    background-color: #fff;
    border: none;
    outline: 0;
    padding: 1rem  1.6rem;
    margin-bottom: 1.6rem;
    color: #202020;
}
.form-element .form-control::placeholder{
    color: #303030;
}
.form-element textarea{
    resize: none;
    min-height: 500px;
}
.form-element span{
    display: inline-block;
    padding: 20px 0px;
}
form{
    background: #DCDCDC;
    padding: 40px;
    height: 100%;
    width: 100%;
    overflow-y: scroll;
}
.cont{
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    overflow-y: scroll;
}
.fm-btn {
    display: inline-block;
    margin-top: 1rem;
    padding: 1rem 3rem;
    font-size: 1.8rem;
    color: var(--dark-gray);
    cursor: pointer;
    text-transform: capitalize;
    border-radius: 3rem;
    background-color: var(--light-color);
    font-weight: 500;
    transition: all 0.3s ease;
}
.fm-btn:hover{
    background-color: #333;
    color: #fff;
}
.check{
    width: 30px;
    height: 30px;
}
.form-element span label{
    bottom: 7px;
    position: relative;
}
</style>
<div class="cont">
<form action="index.php?mdl=6&mdlsp1=9&id=<?php echo $hizmet["id"]; ?>" method="post" enctype="multipart/form-data">
    <div class="form-element">
        <input type="text" maxlength="100" name="isim" class="form-control" value="<?php echo htmlspecialchars($hizmet["isim"]); ?>" placeholder="İsim">
    </div>
    <div class="form-element">
        <textarea rows="5" name="metin" maxlength="65535" placeholder="Metin" class="form-control"><?php echo htmlspecialchars($hizmet["metin"]); ?></textarea>
    </div>
    <div class="form-element">
        <textarea rows="2" name="kisaAciklama" maxlength="400" placeholder="Kısa Açıklama" class="form-control"><?php echo htmlspecialchars($hizmet["kisaAciklama"]); ?></textarea>
    </div>
    <div class="form-element">
        <span>Büyük Resim<input type="file" name="buyukResim"></span>
        <img src="<?php echo $hizmet["buyukResim"]; ?>" width="200px" height="200px">
    </div>
    <div class="form-element">
        <span>Küçük Resim<input type="file" name="kucukResim"></span>
        <img src="<?php echo $hizmet["kucukResim"]; ?>" width="200px" height="200px">
    </div>
    <div class="form-element">
        <span>
            <input type="checkbox" class="check" name="slideDurum" value="1" <?php if($hizmet["slideDurum"] == 1){ echo "checked"; } ?>>
            <label for="vehicle1"> Ana Slaytta Yer Alsın </label><br>
        </span>
    </div>
    <div class="form-element">
        <span>
            <input type="checkbox" class="check" name="galeriDurum" value="1" <?php if($hizmet["galeriDurum"] == 1){ echo "checked"; } ?>>
            <label for="vehicle1"> Galeride Yer Alsın </label><br>
        </span>
    </div>
    <button type="submit" class="fm-btn">
        <i class="fas fa-arrow-right"></i>Kaydet
    </button>
</form>
</div>