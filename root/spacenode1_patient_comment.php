<?php
    CheckUserSession(1);
    CheckUserLevel($user_permissionLevel, 1, $veritaConn);

    function YorumSatirlari($databaseObject, $pagingPageValue){
        //
        $sorgu_yorumlar = $databaseObject -> prepare("SELECT COUNT(id) FROM hastayorum");
        $sorgu_yorumlar -> execute();
        $yorumSayisi = $sorgu_yorumlar -> fetchColumn();

        //tablo sayfalama
        $sf_value = $pagingPageValue;
        $sf_butonSayisi = 2;
        $sf_kayitSayisi = 8;
        $sf_sayfalamayaBaslanacakKayitSayisi = ($sf_value * $sf_kayitSayisi) - $sf_kayitSayisi;
        $sf_totalPageCount = ceil($yorumSayisi / $sf_kayitSayisi);
        $sf_link = "mdl=6&mdlsp1=15";
        $sf = "mdl=6";

        if($yorumSayisi > 0){
            $sorgu_yorumlar = $databaseObject -> prepare("SELECT * FROM hastayorum ORDER BY id ASC LIMIT $sf_sayfalamayaBaslanacakKayitSayisi, $sf_kayitSayisi");
            $sorgu_yorumlar -> execute();
            $yorumlar = $sorgu_yorumlar -> fetchAll(PDO::FETCH_ASSOC);
            foreach($yorumlar as $yorum){
                echo "
                    <tr>
                        <td>" . $yorum["metin"] . "</td>
                        <td>" . $yorum["isim"] . "</td>
                        <td>" . $yorum["gorev"] . "</td>
                        <td><img src='" . $yorum["resimYolu"] . "' width='200px' height='200px'></td>
                        <td>
                            <a href=\"index.php?mdl=6&mdlsp1=20&id=" . $yorum["id"] . "\" class=\"canvasButton_Basic_2 delete\">Sil</a>
                            <a href=\"index.php?mdl=6&mdlsp1=18&id=" . $yorum["id"] . "\" class=\"canvasButton_Basic_2 update\">Güncelle</a>
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
                                Toplam <?php echo $sf_totalPageCount; ?> sayfada, <?php echo $yorumSayisi; ?> adet kayıt bulunmaktadır.
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
    <h1>Hasta Yorumları</h1>
    <table class="canvasTable_Basic">
        <thead>
            <tr>
                <th>Yorum</th>
                <th>Hasta İsmi</th>
                <th>Hasta Görevi</th>
                <th>Resim</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">&nbsp;</td>
                <td>
                    <a href="index.php?mdl=6&mdlsp1=16" class="canvasButton_Basic_2 add">Yorum Ekle</a>
                </td>
            </tr>
            <?php
                YorumSatirlari($veritaConn, $sf_value);
            ?>
        </tbody>
    </table>
</div>