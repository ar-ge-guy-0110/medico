<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
?>
<div class="canvasCredContainer"><!-- Body -->
    <div class="canvasCredForm"><!-- Container -->
        <form action="index.php?mdl=6&mdlsp1=2" method="post">
            <span class="canvasCredFormTitle">Hesap Bilgilerini Güncelle</span>
            <div class="canvasCredFormInputField">
                <input type="text" placeholder="Hesap Adınız" name="kAdi" value="<?php echo $user_username; ?>" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="canvasCredFormInputField">
                <input type="password" class="password" placeholder="Şifreniz" name="kSifre" required>
                <i class="fas fa-lock shIcon"></i>
                <i class="fa fa-eye-slash showHidePw" aria-hidden="true"></i>
            </div>
            <div class="canvasCredFormInputField">
                <input type="password" class="password" placeholder="Şifre Tekrarı" name="kSifreTekrar" required>
                <i class="fas fa-lock shIcon"></i>
                <i class="fa fa-eye-slash showHidePw" aria-hidden="true"></i>
            </div>
            <div class="canvasCredFormInputField">
                <input type="text" placeholder="Tam İsminiz" name="kTamIsim" value="<?php echo $user_fullName; ?>" required>
                <i class="fas fa-address-card"></i>
            </div>
            <div class="canvasCredFormInputField">
                <input type="text" placeholder="Telefon Numaranız" maxlength="11" name="kTelNo" value="<?php echo $user_phoneNumber; ?>" required>
                <i class="fas fa-phone"></i>
            </div>
            <div class="canvasCredFormInputField button">
                <input type="submit" value="Güncelle">
            </div>
        </form>
    </div>
</div>
<script src="frameworks/itservices/js/sp1Creds.js"></script>