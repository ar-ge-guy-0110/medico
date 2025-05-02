<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
    $sorgu_ayar = $veritaConn -> prepare("SELECT * FROM ayar WHERE id = 1 LIMIT 1");
    $sorgu_ayar -> execute();
    $ayarlar = $sorgu_ayar -> fetch(PDO::FETCH_ASSOC);
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
<form action="index.php?mdl=6&mdlsp1=28" method="post">
    <div class="form-element">
        <input type="text" maxlength="50" name="site_adi" class="form-control" placeholder="Site Adı" value="<?php if($ayarlar){ echo $ayarlar["site_adi"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="site_sirket_kisaAdi" class="form-control" placeholder="Şirket Kısa Adı" value="<?php if($ayarlar){ echo $ayarlar["site_sirket_kisaAdi"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="60" name="site_title" class="form-control" placeholder="Site Title" value="<?php if($ayarlar){ echo $ayarlar["site_title"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="150" name="site_description" class="form-control" placeholder="Site Açıklaması" value="<?php if($ayarlar){ echo $ayarlar["site_description"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="site_keywords" class="form-control" placeholder="Site Anahtar Kelimeler" value="<?php if($ayarlar){ echo $ayarlar["site_keywords"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="site_copyright_metni" class="form-control" placeholder="Site Copyright Metni" value="<?php if($ayarlar){ echo $ayarlar["site_copyright_metni"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="30" name="site_logosu" class="form-control" placeholder="Site Logosu" value="<?php if($ayarlar){ echo $ayarlar["site_logosu"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="50" name="site_email_adresi" class="form-control" placeholder="Site Eposta Adresi" value="<?php if($ayarlar){ echo $ayarlar["site_email_adresi"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="50" name="site_email_sifresi" class="form-control" placeholder="Site Eposta Şifresi" value="<?php if($ayarlar){ echo $ayarlar["site_email_sifresi"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="site_email_host_adresi" class="form-control" placeholder="Site Eposta Host Adresi" value="<?php if($ayarlar){ echo $ayarlar["site_email_host_adresi"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="site_linki" class="form-control" placeholder="Site Linki" value="<?php if($ayarlar){ echo $ayarlar["site_linki"]; } ?>" required>
    </div>
    <div class="form-element">
        <textarea rows="5" name="site_adres" maxlength="400" placeholder="Site Adresi" class="form-control" required><?php if($ayarlar){ echo $ayarlar["site_adres"]; } ?></textarea>
    </div>
    <div class="form-element">
        <input type="text" maxlength="20" name="site_telefon" class="form-control" placeholder="Site Telefon No" value="<?php if($ayarlar){ echo $ayarlar["site_telefon"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="100" name="site_calisma_zamanlari" class="form-control" placeholder="Site Çalışma Zamanları" value="<?php if($ayarlar){ echo $ayarlar["site_calisma_zamanlari"]; } ?>" required>
    </div>
    <div class="form-element">
        <textarea rows="5" name="whatsapp_link" maxlength="400" placeholder="Whatsapp Linki" class="form-control" required><?php if($ayarlar){ echo $ayarlar["whatsapp_link"]; } ?></textarea>
    </div>
    <div class="form-element">
        <textarea rows="5" name="gmaps_link" maxlength="1000" placeholder="Google Maps Linki" class="form-control" required><?php if($ayarlar){ echo $ayarlar["gmaps_link"]; } ?></textarea>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="Sosyal_Link_Facebook" class="form-control" placeholder="Facebook Linki" value="<?php if($ayarlar){ echo $ayarlar["Sosyal_Link_Facebook"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="Sosyal_Link_Twitter" class="form-control" placeholder="Twitter Linki" value="<?php if($ayarlar){ echo $ayarlar["Sosyal_Link_Twitter"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="Sosyal_Link_LinkedIn" class="form-control" placeholder="LinkedIn Linki" value="<?php if($ayarlar){ echo $ayarlar["Sosyal_Link_LinkedIn"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="Sosyal_Link_Pinterest" class="form-control" placeholder="Pinterest Linki" value="<?php if($ayarlar){ echo $ayarlar["Sosyal_Link_Pinterest"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="Sosyal_Link_Instagram" class="form-control" placeholder="Instagram Linki" value="<?php if($ayarlar){ echo $ayarlar["Sosyal_Link_Instagram"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="255" name="Sosyal_Link_YouTube" class="form-control" placeholder="YouTube Linki" value="<?php if($ayarlar){ echo $ayarlar["Sosyal_Link_YouTube"]; } ?>" required>
    </div>
    <button type="submit" class="fm-btn">
        <i class="fas fa-arrow-right"></i>Kaydet
    </button>
</form>
</div>