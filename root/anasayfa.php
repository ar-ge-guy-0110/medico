<!--<header class="header bg-blue">
    <div class="header-inner text-white text-center">
        <div class="container grid">
            <div class="header-inner-left">
                <h1>Güvenli <br /> <span>Sağlık Hizmeti</span></h1>
                <p class="lead">Bazı Hizmetlerimiz</p>
                <p class="text text-md">
                    check up, evde yaşlı bakımı, evde sağlık, cerrahi işlemler, estetik işlemleri, laboratuar ve görüntüleme hizmetleri, doktor temini, hastane kadro alım satım ve kiralama, doğum paketleri
                </p>
                <div class="btn-group">
                    <a href="#" class="btn btn-white">Daha Fazla Bilgi Alın</a>
                    <a href="#" class="btn btn-light-blue">Bizimle İletişime Geçin</a>
                </div>
            </div>
            <div class="header-inner-right">
                <img src="resimler/refined2.png">
            </div>
        </div>
    </div>
</header>-->
<!-- START SLIDER -->
<section class="gs-slider-section">
    <div class="swiper gs-slider">
        <div class="swiper-wrapper gs-w">
            <?php
                if(!$boolHizmetYok){
                    foreach($hizmetler as $hizmet){
                        if($hizmet["slideDurum"] == 0)
                            continue;

            ?>
            <section class="swiper-slide gs-slide" style="background: url(<?php echo $hizmet["buyukResim"]; ?>) no-repeat;">
                <div class="gs-slide-content">
                    <div class="wrr">
                        <h3 class="gs-h3"><?php echo $hizmet["isim"]; ?></h3>
                        <p class="gs-p">
                            <?php echo $hizmet["kisaAciklama"]; ?>
                        </p>
                    </div>
                    <a href="index.php?mdl=0&mdl2=6&id=<?php echo $hizmet["id"]; ?>" class="gs-btn">Daha Fazla</a>
                </div>
            </section>
            <?php
                    }
                }
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- END SLIDER -->
<!-- START ABOUT -->
<div class="abu-section" id="about">
    <div class="abu-container">
        <div class="abu-title">
            <h1 class="abu-h1">Hakkımızda</h1>
        </div>
        <div class="abu-content">
            <div class="abu-article" style="font-size: 18px;">
                <?php
                    if($hakkimizdaYazi){ echo $hakkimizdaYazi["hakkimizda"]; }
                ?>
                <div class="abu-button">
                    <a href="index.php?mdl=0&mdl2=1" class="abu-a">Tamamını Oku</a>
                </div>
            </div>
        </div>
        <div class="abu-image-section">
            <img src="resimler/logo.png" alt="" class="abu-img">
        </div>
        <div class="abu-social-section">
            <a href="<?php echo $soslink_facebook; ?>" target="_blank" class="abu-a"><i class="fab fa-facebook-f abu-i"></i></a>
            <a href="<?php echo $soslink_twitter; ?>" target="_blank" class="abu-a"><i class="fab fa-twitter abu-i"></i></a>
            <a href="<?php echo $soslink_instagram; ?>" target="_blank" class="abu-a"><i class="fab fa-instagram abu-i"></i></a>
        </div>
    </div>
</div>
<!-- END ABOUT -->
<!-- START SERVICES -->
<section class="elecard-section" id="serv">
    <div class="elecard-container">
        <div class="elecard-row">
            <?php
                foreach($hizmetler as $hizmet){
                    if($hizmet["galeriDurum"] == 0)
                        continue;
            ?>
            <div class="elecard-image">
                <img src="<?php echo $hizmet["kucukResim"]; ?>" alt="" class="elecard-img" width="480px" height="360px">
                <div class="elecard-details">
                    <h2 class="elecard-h2"><?php echo $hizmet["isim"]; ?></h2>
                    <p class="elecard-p"><?php echo $hizmet["kisaAciklama"]; ?></p>
                </div>
                <div class="elecard-more">
                    <a href="index.php?mdl=0&mdl2=6&id=<?php echo $hizmet["id"]; ?>" class="elecard-read-more">Daha <span class="elecard-span">Fazla</span></a>
                    <div class="elecard-icon-links">
                        <a href="#" class="elecard-a"><i class="fas fa-eye elecard-i"></i></a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<!-- END SERVICES -->
<div style="padding: 0; margin: 0; height: 0; width: 100%;"></div>
<!-- START COUNTY -->
<?php
    $sorgu_hizmetsayi = $veritaConn -> prepare("SELECT * FROM hizmetsayi");
    $sorgu_hizmetsayi -> execute();
    $hizmetsayilari = $sorgu_hizmetsayi -> fetch(PDO::FETCH_ASSOC);
?>
<section class="county-section">
    <div class="county-wrapper">
        <div class="county-container">
            <i class="ri-emotion-laugh-line county-i"></i>
            <span class="county-num" data-val="<?php if($hizmetsayilari){ echo $hizmetsayilari["mutluHastaYakini"]; } ?>">000</span>
            <span class="county-text">Mutlu Hasta Yakını</span>
        </div>
        <div class="county-container">
            <i class="ri-medal-line county-i"></i>
            <span class="county-num" data-val="<?php if($hizmetsayilari){ echo $hizmetsayilari["saglikIslemi"]; } ?>">000</span>
            <span class="county-text">Sağlık İşlemi</span>
        </div>
        <div class="county-container">
            <i class="ri-empathize-line county-i"></i>
            <span class="county-num" data-val="<?php if($hizmetsayilari){ echo $hizmetsayilari["hasta"]; } ?>">000</span>
            <span class="county-text">Hasta</span>
        </div>
        <div class="county-container">
            <i class="ri-team-line county-i"></i>
            <span class="county-num" data-val="<?php if($hizmetsayilari){ echo $hizmetsayilari["calisan"]; } ?>">000</span>
            <span class="county-text">Çalışan</span>
        </div>
    </div>
</section>
<!-- START COUNTY -->
<!-- START TESTOSLIDER -->
<section class="testoslider-section" id="testimonial">
    <div class="testoslider-testimonial swiper">
        <div class="testoslider-content swiper-wrapper">
            <?php
                $sorgu_hastayorumlar = $veritaConn -> prepare("SELECT metin, isim, gorev, resimYolu FROM hastayorum");
                $sorgu_hastayorumlar -> execute();
                $hastayorumlari = $sorgu_hastayorumlar -> fetchAll(PDO::FETCH_ASSOC);
                if($hastayorumlari){

                    foreach($hastayorumlari as $hastayorum){
            ?>
            <div class="testoslider-slide swiper-slide">
                <img src="<?php echo $hastayorum["resimYolu"]; ?>" alt="" class="testoslider-image">
                <p class="testoslider-p">
                    <?php echo $hastayorum["metin"]; ?>
                </p>
                <i class="ri-double-quotes-l testoslider-i"></i>
                <div class="testoslider-details">
                    <span class="testoslider-name"><?php echo $hastayorum["isim"]; ?></span>
                    <span class="testoslider-job"><?php echo $hastayorum["gorev"]; ?></span>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="swiper-button-next testoslider-swiper-button"></div>
        <div class="swiper-button-prev testoslider-swiper-button"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- END TESTOSLIDER -->
<!-- START BLOGGOSLIDER -->
<section class="bloggoslider-section" id="blog">
    <div class="bloggoslider-container owl-carousel">
        <?php
                //<div class="bloggoslider-date"><i class="fas fa-calendar-alt bloggoslider-i"></i> 14 Aralık, 2022</div>
                $sorgu_postlar = $veritaConn -> prepare("SELECT id, baslik, kisametin, resim FROM blogyazi");
                $sorgu_postlar -> execute();
                $blogpostlari = $sorgu_postlar -> fetchAll(PDO::FETCH_ASSOC);
                if($blogpostlari){
                    foreach($blogpostlari as $blogpost){
        ?>
        <div class="bloggoslider-post">
            <div class="bloggoslider-image">
                <img src="<?php echo $blogpost["resim"]; ?>" alt="" class="bloggoslider-img">
            </div>
            <div class="bloggoslider-content">
                <br/>
                <a href="index.php?mdl=0&mdl2=7&id=<?php echo $blogpost["id"]; ?>" class="bloggoslider-title"><?php echo $blogpost["baslik"]; ?></a>
                <p class="bloggoslider-p">
                    <?php echo $blogpost["kisametin"]; ?>
                </p>
                <a href="index.php?mdl=0&mdl2=7&id=<?php echo $blogpost["id"]; ?>" class="bloggoslider-link">Tamamını Oku</a>
            </div>
        </div>
        <?php
                    }
                }
        ?>
    </div>
</section>
<!-- END BLOGGOSLIDER -->