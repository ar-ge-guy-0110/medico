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
    $sorgu_hizmet = $veritaConn -> prepare("SELECT isim, metin, buyukResim FROM hizmet WHERE id = ?");
    $sorgu_hizmet -> execute([$incoming_id]);
    $hizmet = $sorgu_hizmet -> fetch(PDO::FETCH_ASSOC);
?>
<!-- START ABOUT -->
<div class="arctic-section" style="padding: 50px; display: inline-block;">
    <div class="arctic-container">
        <div class="arctic-image-section">
            <img src="<?php if($hizmet){ echo $hizmet["buyukResim"]; } ?>" class="arctic-img">
        </div>
        <div class="arctic-title">
            <h1 class="arctic-h1"><?php if($hizmet){ echo $hizmet["isim"]; } ?></h1>
        </div>
        <div class="arctic-content">
            <div class="arctic-article" style="font-size: 18px;">
                <?php if($hizmet){ echo $hizmet["metin"]; } ?>
            </div>
        </div>
    </div>
</div>
<!-- END ABOUT -->