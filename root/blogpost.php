<?php
    if(isset($_GET["id"])){
        $incoming_id = SVE_BASIC_INPUT($_GET["id"], 3, false, true, true);
    }else{
        $incoming_id = "";
    }
    if($incoming_id == ""){
        header("Location:index.php");
        exit();
    }
    $sorgu_blogpost = $veritaConn -> prepare("SELECT baslik, metin, resim FROM blogyazi WHERE id = ?");
    $sorgu_blogpost -> execute([$incoming_id]);
    $blogpost = $sorgu_blogpost -> fetch(PDO::FETCH_ASSOC);
?>
<!-- START ABOUT -->
<div class="arctic-section" style="padding: 50px; display: inline-block;">
    <div class="arctic-container">
        <div class="arctic-image-section">
            <img src="<?php if($blogpost){ echo $blogpost["resim"]; } ?>" class="arctic-img">
        </div>
        <div class="arctic-title">
            <h1 class="arctic-h1"><?php if($blogpost){ echo $blogpost["baslik"]; } ?></h1>
        </div>
        <div class="arctic-content">
            <div class="arctic-article" style="font-size: 18px;">
                <?php if($blogpost){ echo $blogpost["metin"]; } ?>
            </div>
        </div>
    </div>
</div>
<!-- END ABOUT -->