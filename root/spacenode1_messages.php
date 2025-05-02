<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
?>
<link href="frameworks/Swiper/swiper-bundle.min.css" rel="stylesheet">
<script type="text/javascript" src="frameworks/Swiper/swiper-bundle.min.js" language="javascript"></script>
<style>
    /*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
/*
.testoslider-section{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
*/
.testoslider-section{
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    /*background-color: #e3f2fd;*/
    background-color: #fff;
    font-size: 16px;
    background: linear-gradient(rgba(77, 221, 247, 0.9), rgba(174, 236, 247, 0.9)), url('../../../resimler/art2.png') top/ cover repeat;
}
.testoslider-testimonial{
    position: relative;
    max-width: 900px;
    width: 100%;
    padding: 50px 0;
    background-color: #fff;
    overflow: hidden;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}
.testoslider-testimonial .testoslider-image{
    height: 170px;
    width: 170px;
    object-fit: cover;
    border-radius: 50%;
}
.testoslider-testimonial .testoslider-slide{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    row-gap: 30px;
}
.testoslider-slide .testoslider-p{
    text-align: center;
    padding: 0 100px;
    font-size: 14px;
    font-weight: 400;
    color: #202020;
}
.testoslider-slide .testoslider-i{
    font-size: 30px;
    color: #33e6ff;
}
.testoslider-slide .testoslider-details{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.testoslider-details .testoslider-name{
    font-size: 14px;
    font-weight: 600;
    color: #101010;
}
.testoslider-details .testoslider-job{
    font-size: 12px;
    font-weight: 400;
    color: #101010;
}
.testoslider-swiper-button:after,
.testoslider-swiper-button:before{
    color: #33e6ff;
}
/*
.testoslider-swiper-button{
    height: 40px;
    width: 40px;
    border-radius: 50%;
    transform: translateY(30px);
    background-color: rgba(0, 0, 0, 0.1);
}
.testoslider-swiper-button:after,
.testoslider-swiper-button:before{
    font-size: 20px;
    color: #33e6ff;
}
*/
/*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
/*TestimonialSlider SECTION*/
</style>
<!-- START TESTOSLIDER -->
<section class="testoslider-section">
    <div class="testoslider-testimonial swiper">
        <div class="testoslider-content swiper-wrapper">
            <?php
                $sorgu_mesajlar = $veritaConn -> prepare("SELECT * FROM mesaj ORDER BY gonderimTarihi DESC");
                $sorgu_mesajlar -> execute();
                $queryErrInfo = $sorgu_mesajlar -> errorInfo();
                if($queryErrInfo[0] != "00000"){
                    $_SESSION["message_main"] = 'Hata!';
                    $_SESSION["message_comment"] = 'Mesajlar Alınamadı. İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
                    $_SESSION["message_routing"] = '<a href="index.php?mdl=6&mdlsp1=0">Ana Sayfa</a>';
                    $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
                    header("Location:index.php?mdl=2");
                    exit();
                }
                $mesajlar = $sorgu_mesajlar -> fetchAll(PDO::FETCH_ASSOC);
                $mesajSayisi = count($mesajlar);
                if($mesajSayisi > 0){
                    foreach($mesajlar as $mesaj){
                        $id = $mesaj["id"];
                        $isim = $mesaj["isim"];
                        $eposta = $mesaj["eposta"];
                        $mesajicerik = $mesaj["mesaj"];
                        $ipAdresi = $mesaj["ipAdresi"];
                        $gonderimTarihi = $mesaj["gonderimTarihi"];
            ?>
            <div class="testoslider-slide swiper-slide">
                <img src="resimler/user.png" alt="" class="testoslider-image">
                <p class="testoslider-p">
                    <?php echo $mesajicerik; ?>
                </p>
                <i class="ri-double-quotes-l testoslider-i"></i>
                <div class="testoslider-details">
                    <span class="testoslider-name"><?php echo "İsim: " . $isim . "<br /> E-Posta: " . $eposta; ?></span>
                    <span class="testoslider-name"><?php echo "Gönderim Tarihi:" . $gonderimTarihi; ?></span>
                    <span class="testoslider-name"><?php echo "IP Adresi:" . $ipAdresi; ?></span>
                </div>
                <a href="index.php?mdl=6&mdlsp1=4&id=<?php echo $id; ?>" class="canvasButton_Basic_2 delete">Sil</a>
            </div>
            <?php
                    }
                }else{
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hiç Mesajınız Yok";
                }
            ?>
        </div>
        <div class="swiper-button-next testoslider-swiper-button"></div>
        <div class="swiper-button-prev testoslider-swiper-button"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- END TESTOSLIDER -->
<script>
    //testoslider
    var swiper2 = new Swiper(".testoslider-testimonial", {
        slidesPerView: 1,
        grabCursor: true,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    //testoslider
</script>