<?php
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);
    //Admin Page
    if(isset($_REQUEST["mdlsp1"])){
        $modulesp1_value = SayiliIcerikleriFiltrele($_REQUEST["mdlsp1"]);
    }else{
        $modulesp1_value = 0;
    }

    if(isset($_REQUEST["SF"])){
        $sf_value = SayiliIcerikleriFiltrele($_REQUEST["SF"]);
    }else{
        $sf_value = 1;
    }
    //Admin Page Page Codes
    $pagecodesp1[0] = "spacenode1_main.php";
    $pagecodesp1[1] = "spacenode1_creds.php";
    $pagecodesp1[2] = "spacenode1_creds_result.php";
    $pagecodesp1[3] = "spacenode1_messages.php";
    $pagecodesp1[4] = "spacenode1_messages_delete.php";
    $pagecodesp1[5] = "spacenode1_services.php";
    $pagecodesp1[6] = "spacenode1_services_add.php";
    $pagecodesp1[7] = "spacenode1_services_add_result.php";
    $pagecodesp1[8] = "spacenode1_services_update.php";
    $pagecodesp1[9] = "spacenode1_services_update_result.php";
    $pagecodesp1[10] = "spacenode1_services_delete.php";
    $pagecodesp1[11] = "spacenode1_general_articles.php";
    $pagecodesp1[12] = "spacenode1_general_articles_result.php";
    $pagecodesp1[13] = "spacenode1_service_count.php";
    $pagecodesp1[14] = "spacenode1_service_count_result.php";
    $pagecodesp1[15] = "spacenode1_patient_comment.php";
    $pagecodesp1[16] = "spacenode1_patient_comment_add.php";
    $pagecodesp1[17] = "spacenode1_patient_comment_add_result.php";
    $pagecodesp1[18] = "spacenode1_patient_comment_update.php";
    $pagecodesp1[19] = "spacenode1_patient_comment_update_result.php";
    $pagecodesp1[20] = "spacenode1_patient_comment_delete.php";
    $pagecodesp1[21] = "spacenode1_blogpost.php";
    $pagecodesp1[22] = "spacenode1_blogpost_add.php";
    $pagecodesp1[23] = "spacenode1_blogpost_add_result.php";
    $pagecodesp1[24] = "spacenode1_blogpost_update.php";
    $pagecodesp1[25] = "spacenode1_blogpost_update_result.php";
    $pagecodesp1[26] = "spacenode1_blogpost_delete.php";
    $pagecodesp1[27] = "spacenode1_siteop.php";
    $pagecodesp1[28] = "spacenode1_siteop_result.php";
    $lastcodesp1 = count($pagecodesp1) - 1;
?>
<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <a href="index.php?mdl=6&mdlsp1=0"><img src="resimler/logo.png"></a>
            <div class="logo_name"><?php echo $site_sirket_kisaAdi; ?></div>
        </div>
        <i class="fa-solid fa-bars" id="btn"></i>
    </div>
    <ul class="nav_list">
        <!--<li>
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search...">
            <span class="tooltip">Search</span>
        </li>-->
        <li>
            <a href="index.php?mdl=6&mdlsp1=1">
                <i class="fa fa-user-secret" aria-hidden="true"></i>
                <span class="links_name">Yönetici Hesabı</span>
            </a>
            <span class="tooltip">Yönetici Hesabı</span>
        </li>
        <li>
            <a href="index.php?mdl=6&mdlsp1=3">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span class="links_name">Mesajlar</span>
            </a>
            <span class="tooltip">Mesajlar</span>
        </li>
        <li>
            <a href="index.php?mdl=6&mdlsp1=5">
                <i class="fa fa-heartbeat" aria-hidden="true"></i>
                <span class="links_name">Hizmetler</span>
            </a>
            <span class="tooltip">Hizmetler</span>
        </li>
        <li>
            <a href="index.php?mdl=6&mdlsp1=11">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                <span class="links_name">Temel Metinler</span>
            </a>
            <span class="tooltip">Temel Metinler</span>
        </li>
        <li>
            <a href="index.php?mdl=6&mdlsp1=13">
                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                <span class="links_name">Hizmet Sayıları</span>
            </a>
            <span class="tooltip">Hizmet Sayıları</span>
        </li>
        <li>
            <a href="index.php?mdl=6&mdlsp1=15">
                <i class="fa fa-address-book" aria-hidden="true"></i>
                <span class="links_name">Hasta Yorumları</span>
            </a>
            <span class="tooltip">Hasta Yorumları</span>
        </li>
        <li>
            <a href="index.php?mdl=6&mdlsp1=21">
                <i class="fa fa-globe" aria-hidden="true"></i>
                <span class="links_name">Blog Paylaşımları</span>
            </a>
            <span class="tooltip">Blog Paylaşımları</span>
        </li>
        <li>
            <a href="index.php?mdl=6&mdlsp1=27">
                <i class="fa fa-cogs" aria-hidden="true"></i>
                <span class="links_name">Site Ayarları</span>
            </a>
            <span class="tooltip">Site Ayarları</span>
        </li>
    </ul>
    <div class="profile_content">
        <div class="profile">
            <div class="profile_details">
                <!--<img src="profile.jpg" alt="">-->
                <div class="name_job">
                    <div class="name"><?php echo $user_fullName; ?></div>
                    <div class="job"><?php echo $user_permissionName; ?></div>
                </div>
            </div>
            <div class="linky">
                <a href="index.php?mdl=7">
                    <i class="fa-solid fa-right-from-bracket" id="log_out"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Canvas -->
<section class="canvas">
    <?php
        if((!$modulesp1_value) or ($modulesp1_value == "") or ($modulesp1_value == 0) or ($modulesp1_value > $lastcodesp1)){
            include($pagecodesp1[0]);
            //include(IncludeRoot($pagecode[0]));
        }else{
            include($pagecodesp1[$modulesp1_value]);
            //include(IncludeRoot($pagecode[$module_value]));
        }
    ?>
</section>
<script>
    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");
    let searchBtn = document.querySelector(".fa-magnifying-glass");

    btn.onclick = function() {
        sidebar.classList.toggle("active");
    }
    searchBtn.onclick = function() {
        sidebar.classList.toggle("active");
    }
</script>