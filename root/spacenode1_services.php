<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    function HizmetSatirlari($databaseObject, $pagingPageValue){
        //
        $sorgu_hizmetler = $databaseObject -> prepare("SELECT COUNT(id) FROM hizmet");
        $sorgu_hizmetler -> execute();
        $hizmetSayisi = $sorgu_hizmetler -> fetchColumn();

        //tablo sayfalama
        $sf_value = $pagingPageValue;
        $sf_butonSayisi = 2;
        $sf_kayitSayisi = 8;
        $sf_sayfalamayaBaslanacakKayitSayisi = ($sf_value * $sf_kayitSayisi) - $sf_kayitSayisi;
        $sf_totalPageCount = ceil($hizmetSayisi / $sf_kayitSayisi);
        $sf_link = "mdl=6&mdlsp1=5";
        $sf = "mdl=6";

        if($hizmetSayisi > 0){
            $sorgu_hizmetler = $databaseObject -> prepare("SELECT id, isim, metin, kisaAciklama, buyukResim, kucukResim, slideDurum, galeriDurum FROM hizmet ORDER BY hizmet.id ASC LIMIT $sf_sayfalamayaBaslanacakKayitSayisi, $sf_kayitSayisi");
            $sorgu_hizmetler -> execute();
            $hizmetler = $sorgu_hizmetler -> fetchAll(PDO::FETCH_ASSOC);
            foreach($hizmetler as $hizmet){
                $slideDurumIkonu = '';
                $galeriDurumIkonu = '';
                if($hizmet["slideDurum"] == 1){ $slideDurumIkonu = 'EVET'; }else{ $slideDurumIkonu = 'HAYIR'; }
                if($hizmet["galeriDurum"] == 1){ $galeriDurumIkonu = 'EVET'; }else{ $galeriDurumIkonu = 'HAYIR'; }
                echo "
                    <tr>
                        <td>" . $hizmet["isim"] . "</td>
                        <td>" . $hizmet["metin"] . "</td>
                        <td>" . $hizmet["kisaAciklama"] . "</td>
                        <td><img src='" . $hizmet["buyukResim"] . "' width='200px' height='200px'></td>
                        <td><img src='" . $hizmet["kucukResim"] . "' width='200px' height='200px'></td>
                        <td>" . $slideDurumIkonu . "</td>
                        <td>" . $galeriDurumIkonu . "</td>
                        <td>
                            <a href=\"index.php?mdl=6&mdlsp1=10&id=" . $hizmet["id"] . "\" class=\"canvasButton_Basic_2 delete\">Sil</a>
                            <a href=\"index.php?mdl=6&mdlsp1=8&id=" . $hizmet["id"] . "\" class=\"canvasButton_Basic_2 update\">Güncelle</a>
                        </td>
                    </tr>
                ";
            }
            if($sf_totalPageCount > 1){
                ?>
                <tr>
                    <td align="center" colspan="9">
                        <div class="pagingContainer">
                            <div class="pagingContainerTextArea">
                                Toplam <?php echo $sf_totalPageCount; ?> sayfada, <?php echo $hizmetSayisi; ?> adet kayıt bulunmaktadır.
                            </div>
                            <div class="pagingContainerTextAreaForNumbers">
                                <?php
                                    if($sf_totalPageCount > 1){
                                        if($sf_value > 1){
                                            echo "<span class='pagePassive'><a href='index.php?" . $sf_link . "&SF=1'><<</a></span>";
                                            
                                            $sf_decreasedValue = $sf_value - 1;
                                            echo "<span class='pagePassive'><a href='index.php?" . $sf_link ."&SF=" . $sf_decreasedValue . "'><</a></span>";
                                        }
                                        for($sf_indexValue = ($sf_value - $sf_butonSayisi); $sf_indexValue <= ($sf_value + $sf_butonSayisi); $sf_indexValue++){
                                            if(($sf_indexValue > 0) and ($sf_indexValue <= $sf_totalPageCount)){
                                                if($sf_value == $sf_indexValue){
                                                    echo "<span class='pageActive'>" . $sf_indexValue . "</span>";
                                                }else{
                                                    echo "<span class='pagePassive'><a href='index.php?" . $sf_link ."&SF=" . $sf_indexValue . "'>" . $sf_indexValue . "</a></span>";
                                                }
                                            }
                                        }
                                        if($sf_value != $sf_totalPageCount){
                                            $sf_increasedValue = $sf_value + 1;
                                            echo "<span class='pagePassive'><a href='index.php?". $sf . "&" . $sf_link ."&SF=" . $sf_increasedValue . "'>></a></span>";
                                            
                                            echo "<span class='pagePassive'><a href='index.php?" . $sf_link ."&SF=" . $sf_totalPageCount . "'>>></a></span>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
        }else{
            echo "Burada Hiç Kayıt Yok...";
        }
    }
?>
<div class="canvasWrapper">
    <h1>Hizmetlerimiz</h1>
    <table class="canvasTable_Basic">
        <thead>
            <tr>
                <th>Hizmet İsmi</th>
                <th>Açıklama</th>
                <th>Kısa Açıklama</th>
                <th>Büyük Resim</th>
                <th>Küçük Resim</th>
                <th>Ana Slaytta Yer Alır</th>
                <th>Galeride Yer Alır</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7">&nbsp;</td>
                <td>
                    <a href="index.php?mdl=6&mdlsp1=6" class="canvasButton_Basic_2 add">Hizmet Ekle</a>
                </td>
            </tr>
            <?php
                HizmetSatirlari($veritaConn, $sf_value);
            ?>
        </tbody>
    </table>
</div>