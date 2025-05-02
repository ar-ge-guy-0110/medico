<?php
    $touken = CreateFormToken();
    $_SESSION["touken"] = $touken;

    $boolHizmetYok = false;
    $sorgu_hizmetler = $veritaConn -> prepare("SELECT * FROM hizmet ORDER BY id ASC");
    $sorgu_hizmetler -> execute();
    $hizmetler = $sorgu_hizmetler -> fetchAll(PDO::FETCH_ASSOC);
    if(!$hizmetler)
        $boolHizmetYok = true;
?>
<button id="goTopButton"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
<a href="<?php echo $whatsapp_link ?>" target="_blank" id="goWPButton"><img src="resimler/whatsapp.svg" width="48px" height="48px"></a>
<link href="frameworks/Swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="frameworks/OwlCarousel/owl.carousel.min.css" rel="stylesheet">
<script type="text/javascript" src="frameworks/Swiper/swiper-bundle.min.js" language="javascript"></script>
<script type="text/javascript" src="frameworks/OwlCarousel/owl.carousel.min.js" language="javascript"></script>
<header class="bs-header">
    <div class="bs-container">
        <div class="bs-header-main">
            <div class="bs-logo">
                <a href="index.php" class="bs-anchor bs-logo-text"><span><img class="myimg" src="<?php echo $site_logosu; ?>" width="55px"  height="65px" alt="Logo"></span><?php echo $site_title; ?></a>
            </div>
            <div class="bs-open-nav-menu">
                <span></span>
            </div>
            <div class="bs-menu-overlay"></div>
            <nav class="bs-nav-menu">
                <div class="bs-close-nav-menu">
                    <img src="resimler/close-line.svg" alt="Close">
                </div>
                <ul class="bs-menu">
                    <li class="bs-menu-item">
                        <a href="index.php" class="bs-anchor">Ana Sayfa</a>
                    </li>
                    <li class="bs-menu-item bs-has-children">
                        <a class="bs-anchor" data-toggle="bs-sub-menu">Hakkımızda <i class="ri-arrow-down-s-line bs-nav-arrow"></i></a>
                        <ul class="bs-sub-menu">
                            <li class="bs-menu-item">
                                <a href="index.php?mdl=0&mdl2=1" class="bs-anchor">Bizi Tanıyın</a>
                                <a href="index.php?mdl=0&mdl2=2" class="bs-anchor">Misyon, Vizyon</a>
                                <a href="index.php?mdl=0&mdl2=3" class="bs-anchor">Değerlerimiz</a>
                                <a href="index.php?mdl=0&mdl2=4" class="bs-anchor">Kurumsal Amaç ve Hedeflerimiz</a>
                                <a href="index.php?mdl=0&mdl2=5" class="bs-anchor">Gizlilik Sözleşmesi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="bs-menu-item bs-has-children">
                        <a class="bs-anchor" data-toggle="bs-sub-menu">Hizmetlerimiz <i class="ri-arrow-down-s-line bs-nav-arrow"></i></a>
                        <ul class="bs-sub-menu">
                            <li class="bs-menu-item">
                                <?php
                                    if(!$boolHizmetYok){
                                        foreach($hizmetler as $hizmet){
                                            echo '<a href="index.php?mdl=0&mdl2=6&id=' . $hizmet["id"] . '" class="bs-anchor">' . $hizmet["isim"] . '</a>';
                                        }
                                    }
                                ?>
                            </li>
                        </ul>
                    </li>
                    <li class="bs-menu-item">
                        <a href="index.php#blog" class="bs-anchor">Blog</a>
                    </li>
                    <li class="bs-menu-item">
                        <a href="#contact" class="bs-anchor">İletişim</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="bs-div-line"></div>
</header>
<main class="main">
<?php
    if(isset($_REQUEST["mdl2"])){
        $module_value2 = SVE_BASIC_INPUT(SayiliIcerikleriFiltrele($_REQUEST["mdl2"]), 2, false, true, true);
    }else{
        $module_value2 = 0;
    }
    if((!$module_value2) or ($module_value2 == "") or ($module_value2 == 0) or ($module_value2 > $lastcode2)){
        include($pagecode2[0]);
    }else{
        include($pagecode2[$module_value2]);
    }
?>
    <!-- START CONTACT -->
    <section id="contact" class="contact py" id="contact">
        <div class="container grid">
            <div class="contact-left">
                <?php echo $gmaps_link; ?>
            </div>
            <div class="contact-right text-white2 text-center bg-black">
                <div class="contact-head">
                    <h3 class="lead">Bizimle İletişime Geçin</h3>
                    <p class="text text-md">Mesajlarınızı Buradan da İletebilirsiniz.</p>
                </div>
                <form action="index.php?mdl=1" method="post">
                    <input type="hidden" name="TT" value="<?php echo $touken; ?>">
                    <div class="form-element">
                        <input type="text" maxlength="30" name="name" class="form-control" placeholder="İsminiz" required>
                    </div>
                    <div class="form-element">
                        <input type="email" maxlength="50" name="email" class="form-control" placeholder="E-Posta Adresiniz" required>
                    </div>
                    <div class="form-element">
                        <textarea rows="5" maxlength="400" name="info" placeholder="Mesajınız" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="fm-btn">
                        <i class="fas fa-arrow-right"></i>Mesajı Gönder
                    </button>
                </form>
            </div>
        </div>
    </section>
    <!-- END CONTACT -->
    <!-- START FOOTER -->
    <footer id="footer" class="footer text-center">
        <div class="container">
            <div class="footer-inner text-white2 py grid">
                <div class="footer-item">
                    <h3 class="footer-head">Hakkımızda</h3>
                    <div class="icon">
                        <img class="main-img" src="resimler/logo.png">
                    </div>
                    <p class="text text-md">
                        <?php echo $site_sirket_kisaAdi; ?> <br /> 
                        <?php echo $site_copyright_metni; ?>
                    </p>
                    <address>
                        <?php echo $site_adres; ?>
                    </address>
                </div>
                <div class="footer-item">
                    <h3 class="footer-head">Etiketler</h3>
                    <ul class="tags-list flex">
                        <?php
                            foreach($hizmetler as $hizmet){
                        ?>
                        <li><?php echo Guvenlik($hizmet["isim"]); ?></li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
                
                <div class="footer-item">
                    <h3 class="footer-head">Linkler</h3>
                    <ul>
                        <li><a href="index.php#about" class="text-white2">Hakkımızda</a></li>
                        <li><a href="index.php#serv" class="text-white2">Hizmetlerimiz</a></li>
                        <li><a href="index.php?mdl=0&mdl2=5" class="text-white2">Gizlilik Sözleşmesi</a></li>
                        <li><a href="index.php#blog" class="text-white2">Blog</a></li>
                        <li><a href="index.php#testimonial" class="text-white2">Hastalarımızın Yorumları</a></li>
                        <li><a href="index.php#contact" class="text-white2">İletişim</a></li>
                    </ul>
                </div>
                <div class="footer-item">
                    <h3 class="footer-head">Randevu Al</h3>
                    <p class="text text-md">
                        Randevu Almak İçin Bizimle İletişime Geçin
                    </p>
                    <ul class="appointment-info">
                        <?php echo $site_calisma_zamanlari; ?>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span><?php echo $site_email_adresi; ?></span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span><?php echo $site_telefon; ?></span>
                        </li>
                    </ul>
                </div>
                <div class="footer-links">
                    <ul class="flex">
                        <li><a href="<?php echo $soslink_facebook; ?>" class="text-white2 flex"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="<?php echo $soslink_twitter; ?>" class="text-white2 flex"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="<?php echo $soslink_linkedin; ?>" class="text-white2 flex"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->
</main>
<script src="frameworks/medico/js/medico.js"></script>