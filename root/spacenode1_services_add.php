<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
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
<form action="index.php?mdl=6&mdlsp1=7" method="post" enctype="multipart/form-data">
    <div class="form-element">
        <input type="text" maxlength="100" name="isim" class="form-control" placeholder="İsim" required>
    </div>
    <div class="form-element">
        <textarea rows="5" name="metin" maxlength="65535" placeholder="Metin" class="form-control" required></textarea>
    </div>
    <div class="form-element">
        <textarea rows="2" name="kisaAciklama" maxlength="400" placeholder="Kısa Açıklama" class="form-control" required></textarea>
    </div>
    <div class="form-element">
        <span>Büyük Resim<input type="file" name="buyukResim" required></span>
    </div>
    <div class="form-element">
        <span>Küçük Resim<input type="file" name="kucukResim" required></span>
    </div>
    <div class="form-element">
        <span>
            <input type="checkbox" class="check" name="slideDurum" value="1">
            <label for="vehicle1"> Ana Slaytta Yer Alsın </label><br>
        </span>
    </div>
    <div class="form-element">
        <span>
            <input type="checkbox" class="check" name="galeriDurum" value="1">
            <label for="vehicle1"> Galeride Yer Alsın </label><br>
        </span>
    </div>
    <button type="submit" class="fm-btn">
        <i class="fas fa-arrow-right"></i>Kaydet
    </button>
</form>
</div>