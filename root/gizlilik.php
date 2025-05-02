<!-- START ABOUT -->
<div class="abu-section" style="padding: 50px; display: inline-block;">
    <div class="abu-container">
        <div class="abu-title">
            <h1 class="abu-h1">Gizlilik Sözleşmesi</h1>
        </div>
        <div class="abu-content">
            <div class="abu-article" style="font-size: 18px;">
                <?php
                    $sorgu_m = $veritaConn -> prepare("SELECT gizlilikSozlesmesi FROM temelyazi");
                    $sorgu_m -> execute();
                    $met = $sorgu_m -> fetch(PDO::FETCH_ASSOC);
                    if($met){ echo $met["gizlilikSozlesmesi"]; }
                ?>
            </div>
        </div>
        <div class="abu-image-section">
            <img src="resimler/logo.png" class="abu-img">
        </div>
        <div class="abu-social-section">
            <a href="<?php echo $soslink_facebook; ?>" target="_blank" class="abu-a"><i class="fab fa-facebook-f abu-i"></i></a>
            <a href="<?php echo $soslink_twitter; ?>" target="_blank" class="abu-a"><i class="fab fa-twitter abu-i"></i></a>
            <a href="<?php echo $soslink_instagram; ?>" target="_blank" class="abu-a"><i class="fab fa-instagram abu-i"></i></a>
        </div>
    </div>
</div>
<!-- END ABOUT -->