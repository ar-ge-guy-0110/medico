<?php
if((isset($_SESSION["image_path"])) and (isset($_SESSION["message_main"])) and (isset($_SESSION["message_comment"])) and (isset($_SESSION["message_routing"]))){
?>
<div class="container">
    <div class="card">
        <div class="box">
            <div class="content">
                <?php echo $_SESSION["image_path"]; ?>
                <h3><?php echo $_SESSION["message_main"]; ?></h3>
                <p><?php echo $_SESSION["message_comment"]; ?></p>
                <?php echo $_SESSION["message_routing"]; ?>
            </div>
        </div>
    </div>
</div>
<?php   
}else{
    header("Location:index.php");
}
?>