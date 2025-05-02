<?php
    $ip_adresi = $_SERVER["REMOTE_ADDR"];
    $zamanDamgasi = time();
    $tarihSaat = date("d.m.Y H:i:s", $zamanDamgasi);
    $tarihSaatMYSQL = date("Y.m.d H:i:s", $zamanDamgasi);
    $siteKokDizin = $_SERVER["DOCUMENT_ROOT"] ."/medico/root"; // /resimler/deneme.jpg yani substr($fullpath, 0, count($siteKokDizin));

    function RakamlarHaricTumKarakterleriSil($deger){
        $islem = preg_replace("/[^0-9]/", "", $deger); //preg_replace(1=buraya yazdığımız şeylere uyanları, 2=buraya yazılanla değiştir, 3=buraya yazilan stringdekini)
        return $islem;
    }

    function DonusumleriGeriDondur($deger){
        $geriDondur = htmlspecialchars_decode($deger, ENT_QUOTES);
        return $geriDondur;
    }

    function SayiliIcerikleriFiltrele($deger){
        $boslukSil = trim($deger);
        $taglariTemizle = strip_tags($boslukSil);
        $etkisizlestir = htmlspecialchars($taglariTemizle, ENT_QUOTES);
        $temizle = RakamlarHaricTumKarakterleriSil($etkisizlestir);
        return $temizle;
    }

    function CheckUserSession($deger){
        // eger 1 ise kullanici giris yapmis halde olmalıdır, 0 ise kullanici giris yapmamis olmalidir.
        if($deger == 1){
            if(isset($_SESSION["anuser"])){
                return true;
            }else{
                header("Location:index.php");
            }
        }else if($deger == 0){
            if(!isset($_SESSION["anuser"])){

            }else{
                header("Location:index.php");
            }
        }
    }

    function IndexRouter(){
        if(isset($_SESSION["anuser"])){
            header("Location:index.php");
        }else{

        }
    }

    function CheckUserLevel($user_level, $requiredLevelId, $dbConnection){
        CheckUserSession(1);
        //Fetch unit's level with it's id
        $query_fetchUnitLevel = $dbConnection -> prepare("SELECT birim_seviye FROM birim WHERE id = ?");
        $query_fetchUnitLevel -> execute([$requiredLevelId]);
        $qRowCount = $query_fetchUnitLevel -> rowCount();
        if($qRowCount > 0){
            $unitLevel = $query_fetchUnitLevel -> fetch(PDO::FETCH_ASSOC);
            $unitLevel = $unitLevel["birim_seviye"];
            if($user_level >= $unitLevel){

            }else{
                header("Location:index.php");
            }
        }else{
            header("Location:index.php");
        }
    }

    function Guvenlik($deger){
        $boslukSil = trim($deger);
        $taglariTemizle = strip_tags($boslukSil);
        $etkisizlestir = htmlspecialchars($taglariTemizle, ENT_QUOTES);
        return $etkisizlestir;
    }

    function TimeStampToDateTime($timestam){
        $tarihSaat = date("d.m.Y H:i:s", $timestam);
        return $tarihSaat;
    }

    function SVE_BASIC_INPUT($value, $maxLength = 1,$mustStringsLower = false , $mustNumeric = false, $onlyInteger = false){
        $value = trim($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value, ENT_QUOTES);

        if($mustStringsLower){
            $value = strtolower($value);
            //$value = preg_replace('/[^az]/','', $value);
        }
        //strlen
        //For getting a substring of UTF-8 characters, I highly recommend mb_substr echo mb_substr($utf8string,0,5,'UTF-8');
        $value = substr($value, 0, $maxLength);

        if($mustNumeric){
            preg_replace("![][xX]([A-Fa-f0–9]{1,3})!","", $value);
            $numericValidate = is_numeric($value);
            if(!$numericValidate)
                $value = "";
            if($onlyInteger){
                if(!preg_match("/^([0-9]+)$/", $value)){
                    $value = "";
                }
            }else{
                if(!preg_match("/^(([0-9]+)|([0-9]+\.[0-9]+))$/", $value)){
                    $value = "";
                }
            }
        }
        if(strlen($value) > $maxLength){
            $value = "";
        }
        return $value;
    }
    function CreateFormToken(){
        $token = md5(uniqid() . rand(777, 1309));
        return $token;
    }

    function SVE_BASIC_INPUT_2($value, $maxLength = 1, $noStripHtmlTags = false,$mustStringsLower = false , $mustNumeric = false, $onlyInteger = false){
        $value = trim($value);
        if($noStripHtmlTags){
            $value = strip_tags($value, ['br', 'p', 'b', 'span', 'iframe']);
        }else{
            $value = strip_tags($value);
            $value = htmlspecialchars($value, ENT_QUOTES);
        }

        if($mustStringsLower){
            $value = strtolower($value);
            //$value = preg_replace('/[^az]/','', $value);
        }
        //strlen
        //For getting a substring of UTF-8 characters, I highly recommend mb_substr echo mb_substr($utf8string,0,5,'UTF-8');
        $value = substr($value, 0, $maxLength);

        if($mustNumeric){
            preg_replace("![][xX]([A-Fa-f0–9]{1,3})!","", $value);
            $numericValidate = is_numeric($value);
            if(!$numericValidate)
                $value = "";
            if($onlyInteger){
                if(!preg_match("/^([0-9]+)$/", $value)){
                    $value = "";
                }
            }else{
                if(!preg_match("/^(([0-9]+)|([0-9]+\.[0-9]+))$/", $value)){
                    $value = "";
                }
            }
        }
        if(strlen($value) > $maxLength){
            $value = "";
        }
        return $value;
    }
    
    function FileUpload($filesGlobal, $uploadLocationFullPath, $rootLocation, $maxFileSize = 3145728, $allowedTypes = ['image/png'     => 'png', 'image/jpeg'    => 'jpg'], $directionLink, $messageViewerLink, $directionName){
        //Dosya varmı yokmu
        if(!isset($filesGlobal) or $filesGlobal["size"] == 0){
            $_SESSION["message_main"] = 'Dikkat!';
            $_SESSION["message_comment"] = 'Lütfen ekleyeceğiniz departmanın resmini yükleyiniz.';
            $_SESSION["message_routing"] = '<a href="' . $directionLink . '">' . $directionName . '</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
            $headerString = "Location:" . $messageViewerLink;
            header($headerString);
        }else{
            //dosya bilgileri çek
            $filepath = $filesGlobal['tmp_name'];
            $fileSize = filesize($filepath);
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($fileinfo, $filepath);

            //dosyanın boyutu 0 mı
            if($fileSize === 0){
                $_SESSION["message_main"] = 'Dikkat!';
                $_SESSION["message_comment"] = 'Yüklediğiniz dosya boş.';
                $_SESSION["message_routing"] = '<a href="' . $directionLink . '.php">' . $directionName . '</a>';
                $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
                $headerString = "Location:" . $messageViewerLink;
                header($headerString);
                exit();
            }else{
                //dosyanın boyutu x mb den büyükmü (boyut sınırı)
                // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
                if($fileSize > $maxFileSize){
                    $_SESSION["message_main"] = 'Dikkat!';
                    $_SESSION["message_comment"] = 'Yüklediğiniz dosya ' . floor(($maxFileSize / 1000000)) . 'MB\' den küçük olmalıdır.';
                    $_SESSION["message_routing"] = '<a href="' . $directionLink . '">' . $directionName . '</a>';
                    $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
                    $headerString = "Location:" . $messageViewerLink;
                    header($headerString);
                    exit();
                }else{
                    //dosyanın türlerini buraya yaz ve kontrol et
                    /*
                    $allowedTypes = [
                        'image/png'     => 'png',
                        'image/jpeg'    => 'jpg'
                    ];
                    */
                    if(!in_array($filetype, array_keys($allowedTypes))){
                        $_SESSION["message_main"] = 'Dikkat!';
                        $_SESSION["message_comment"] = 'Yüklediğiniz dosya png veya jpg dosyası olmalıdır.';
                        $_SESSION["message_routing"] = '<a href="' . $directionLink . '.php">' . $directionName . '</a>';
                        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
                        $headerString = "Location:" . $messageViewerLink;
                        header($headerString);
                        exit();
                    }else{
                        //random isim yap ve nereye kopyalanacağı falan son rutuslar
                        while (true) {
                            $fileName = uniqid('SResim', true);
                            if (!file_exists(sys_get_temp_dir() . $fileName)) break;
                        }
                        $extension = $allowedTypes[$filetype];
                        $targetDirectory = $uploadLocationFullPath;
                        $newFilePath = $targetDirectory . "/" . $fileName . "." . $extension;

                        if(!copy($filepath, $newFilePath)){
                            $_SESSION["message_main"] = 'Hata!';
                            $_SESSION["message_comment"] = 'Bir hata oluştu...';
                            $_SESSION["message_routing"] = '<a href="' . $directionLink . '">' . $directionName . '</a>';
                            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
                            $headerString = "Location:" . $messageViewerLink;
                            header($headerString);
                            exit();
                        }else{
                            unlink($filepath); // delete the temp file
                            $fileDirectoryFromRoot = substr($newFilePath, strlen($rootLocation) + 1, strlen($newFilePath));
                            return ['isFinished' => true, 'fileDirectoryFromRoot' => $fileDirectoryFromRoot];
                        }
                    }
                }
            }
        }
    }

    function FileUploadForUpdate($filesGlobal, $uploadLocationFullPath, $rootLocation, $oldFileLocation, $locationForSaveACopy, $maxFileSize = 3145728, $allowedTypes = ['image/png'     => 'png', 'image/jpeg'    => 'jpg'], $directionLink, $messageViewerLink, $directionName){
        //Dosya varmı yokmu
        if(!isset($filesGlobal) or $filesGlobal["size"] == 0){
            $_SESSION["message_main"] = 'Dikkat!';
            $_SESSION["message_comment"] = 'Lütfen ekleyeceğiniz departmanın resmini yükleyiniz.';
            $_SESSION["message_routing"] = '<a href="' . $directionLink . '">' . $directionName . '</a>';
            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
            $headerString = "Location:" . $messageViewerLink;
            header($headerString);
        }else{
            //dosya bilgileri çek
            $filepath = $filesGlobal['tmp_name'];
            $fileSize = filesize($filepath);
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($fileinfo, $filepath);

            //dosyanın boyutu 0 mı
            if($fileSize === 0){
                $_SESSION["message_main"] = 'Dikkat!';
                $_SESSION["message_comment"] = 'Yüklediğiniz dosya boş.';
                $_SESSION["message_routing"] = '<a href="' . $directionLink . '.php">' . $directionName . '</a>';
                $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
                $headerString = "Location:" . $messageViewerLink;
                header($headerString);
                exit();
            }else{
                //dosyanın boyutu x mb den büyükmü (boyut sınırı)
                // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
                if($fileSize > $maxFileSize){
                    $_SESSION["message_main"] = 'Dikkat!';
                    $_SESSION["message_comment"] = 'Yüklediğiniz dosya ' . floor(($maxFileSize / 1000000)) . 'MB\' den küçük olmalıdır.';
                    $_SESSION["message_routing"] = '<a href="' . $directionLink . '">' . $directionName . '</a>';
                    $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
                    $headerString = "Location:" . $messageViewerLink;
                    header($headerString);
                    exit();
                }else{
                    //dosyanın türlerini buraya yaz ve kontrol et
                    /*
                    $allowedTypes = [
                        'image/png'     => 'png',
                        'image/jpeg'    => 'jpg'
                    ];
                    */
                    if(!in_array($filetype, array_keys($allowedTypes))){
                        $_SESSION["message_main"] = 'Dikkat!';
                        $_SESSION["message_comment"] = 'Yüklediğiniz dosya png veya jpg dosyası olmalıdır.';
                        $_SESSION["message_routing"] = '<a href="' . $directionLink . '.php">' . $directionName . '</a>';
                        $_SESSION["image_path"] = '<h2 style="color: rgba(255, 157, 0, 0.6);"><i class="fa-solid fa-triangle-exclamation"></i></h2>';
                        $headerString = "Location:" . $messageViewerLink;
                        header($headerString);
                        exit();
                    }else{
                        //random isim yap ve nereye kopyalanacağı falan son rutuslar
                        while (true) {
                            $fileName = uniqid('SResim', true);
                            if (!file_exists(sys_get_temp_dir() . $fileName)) break;
                        }
                        $extension = $allowedTypes[$filetype];
                        $targetDirectory = $uploadLocationFullPath;
                        $newFilePath = $targetDirectory . "/" . $fileName . "." . $extension;

                        if(!copy($filepath, $newFilePath)){
                            $_SESSION["message_main"] = 'Hata!';
                            $_SESSION["message_comment"] = 'Bir hata oluştu...';
                            $_SESSION["message_routing"] = '<a href="' . $directionLink . '">' . $directionName . '</a>';
                            $_SESSION["image_path"] = '<h2 style="color: rgba(255, 0, 0, 0.4);"><i class="fa-solid fa-circle-xmark"></i></h2>';
                            $headerString = "Location:" . $messageViewerLink;
                            header($headerString);
                            exit();
                        }else{
                            unlink($filepath); // delete the temp file
                            $fileDirectoryFromRoot = substr($newFilePath, strlen($rootLocation) + 1, strlen($newFilePath));
                            //copy
                            while (true) {
                                $fileName2 = uniqid('SResim', true);
                                if (!file_exists(sys_get_temp_dir() . $fileName2)) break;
                            }
                            $oldFileExtension = substr($oldFileLocation, strrpos($oldFileLocation, "."), strlen($oldFileLocation));
                            $targetDirectory2 = $locationForSaveACopy;
                            $newFilePath2 = $targetDirectory2 . "/" . $fileName2 . "." . $oldFileExtension;
                            //eski dosyanin tam yeri
                            $oldFileFullLocation = $rootLocation . "/" . $oldFileLocation;
                            copy($oldFileFullLocation, $newFilePath2);
                            unlink($oldFileLocation);
                            //unlink old
                            return ['isFinished' => true, 'fileDirectoryFromRoot' => $fileDirectoryFromRoot];
                        }
                    }
                }
            }
        }
    }
?>