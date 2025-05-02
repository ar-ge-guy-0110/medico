<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
    $sorgu_hizmetsayi = $veritaConn -> prepare("SELECT * FROM hizmetsayi");
    $sorgu_hizmetsayi -> execute();
    $hizmetsayilari = $sorgu_hizmetsayi -> fetch(PDO::FETCH_ASSOC);
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
<form action="index.php?mdl=6&mdlsp1=14" method="post">
    <div class="form-element">
        <input type="text" maxlength="9" name="mutluHastaYakini" class="form-control" placeholder="Mutlu Hasta Yakını Sayısı" value="<?php if($hizmetsayilari){ echo $hizmetsayilari["mutluHastaYakini"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="9" name="saglikIslemi" class="form-control" placeholder="Sağlık İşlemi Sayısı" value="<?php if($hizmetsayilari){ echo $hizmetsayilari["saglikIslemi"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="9" name="hasta" class="form-control" placeholder="Hasta Sayısı" value="<?php if($hizmetsayilari){ echo $hizmetsayilari["hasta"]; } ?>" required>
    </div>
    <div class="form-element">
        <input type="text" maxlength="9" name="calisan" class="form-control" placeholder="Çalışan Sayısı" value="<?php if($hizmetsayilari){ echo $hizmetsayilari["calisan"]; } ?>" required>
    </div>
    <button type="submit" class="fm-btn">
        <i class="fas fa-arrow-right"></i>Kaydet
    </button>
</form>
</div>