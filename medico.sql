-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 May 2025, 21:59:38
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `medico`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `site_adi` varchar(50) NOT NULL,
  `site_sirket_kisaAdi` varchar(255) NOT NULL,
  `site_title` varchar(60) NOT NULL,
  `site_description` varchar(150) NOT NULL,
  `site_keywords` varchar(255) NOT NULL,
  `site_copyright_metni` varchar(255) NOT NULL,
  `site_logosu` varchar(30) NOT NULL,
  `site_email_adresi` varchar(50) NOT NULL,
  `site_email_sifresi` varchar(50) NOT NULL,
  `site_email_host_adresi` varchar(255) NOT NULL,
  `site_linki` varchar(255) NOT NULL,
  `site_adres` varchar(400) NOT NULL,
  `site_telefon` varchar(20) NOT NULL,
  `site_calisma_zamanlari` varchar(100) NOT NULL,
  `whatsapp_link` varchar(400) NOT NULL,
  `gmaps_link` varchar(1000) NOT NULL,
  `Sosyal_Link_Facebook` varchar(255) NOT NULL,
  `Sosyal_Link_Twitter` varchar(255) NOT NULL,
  `Sosyal_Link_LinkedIn` varchar(255) NOT NULL,
  `Sosyal_Link_Pinterest` varchar(255) NOT NULL,
  `Sosyal_Link_Instagram` varchar(255) NOT NULL,
  `Sosyal_Link_YouTube` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`id`, `site_adi`, `site_sirket_kisaAdi`, `site_title`, `site_description`, `site_keywords`, `site_copyright_metni`, `site_logosu`, `site_email_adresi`, `site_email_sifresi`, `site_email_host_adresi`, `site_linki`, `site_adres`, `site_telefon`, `site_calisma_zamanlari`, `whatsapp_link`, `gmaps_link`, `Sosyal_Link_Facebook`, `Sosyal_Link_Twitter`, `Sosyal_Link_LinkedIn`, `Sosyal_Link_Pinterest`, `Sosyal_Link_Instagram`, `Sosyal_Link_YouTube`) VALUES
(1, 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example', 'example');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birim`
--

CREATE TABLE `birim` (
  `id` int(10) UNSIGNED NOT NULL,
  `birim_ad` varchar(255) NOT NULL,
  `birim_sayfa` varchar(255) NOT NULL,
  `birim_seviye` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `birim`
--

INSERT INTO `birim` (`id`, `birim_ad`, `birim_sayfa`, `birim_seviye`) VALUES
(1, 'Yönetici', 'index.php?mdl=6', 255),
(2, 'Bilgi İşlem Sorumlusu', 'spacenode2.php', 10),
(3, 'Bilgi İşlem Personeli', 'spacenode3.php', 9),
(4, 'Çalışan', 'spacenode4.php', 1),
(5, 'Kısıtlı', 'index.php?mdl=7', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogyazi`
--

CREATE TABLE `blogyazi` (
  `id` int(11) UNSIGNED NOT NULL,
  `baslik` varchar(100) NOT NULL,
  `metin` text NOT NULL,
  `kisametin` varchar(400) NOT NULL,
  `resim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hastayorum`
--

CREATE TABLE `hastayorum` (
  `id` int(11) UNSIGNED NOT NULL,
  `metin` varchar(400) NOT NULL,
  `isim` varchar(50) NOT NULL,
  `gorev` varchar(50) NOT NULL,
  `resimYolu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmet`
--

CREATE TABLE `hizmet` (
  `id` int(11) UNSIGNED NOT NULL,
  `isim` varchar(100) NOT NULL,
  `metin` text NOT NULL,
  `kisaAciklama` varchar(400) NOT NULL,
  `buyukResim` varchar(100) NOT NULL,
  `kucukResim` varchar(100) NOT NULL,
  `slideDurum` tinyint(1) UNSIGNED NOT NULL,
  `galeriDurum` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmetsayi`
--

CREATE TABLE `hizmetsayi` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `mutluHastaYakini` int(10) UNSIGNED NOT NULL,
  `saglikIslemi` int(10) UNSIGNED NOT NULL,
  `hasta` int(10) UNSIGNED NOT NULL,
  `calisan` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `hizmetsayi`
--

INSERT INTO `hizmetsayi` (`id`, `mutluHastaYakini`, `saglikIslemi`, `hasta`, `calisan`) VALUES
(1, 432, 387, 278, 20);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `id` int(11) UNSIGNED NOT NULL,
  `isim` varchar(50) NOT NULL,
  `eposta` varchar(70) NOT NULL,
  `mesaj` varchar(400) NOT NULL,
  `ipAdresi` varchar(15) NOT NULL,
  `gonderimTarihi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `temelyazi`
--

CREATE TABLE `temelyazi` (
  `id` int(11) UNSIGNED NOT NULL,
  `hakkimizda` text NOT NULL,
  `misyon` text NOT NULL,
  `vizyon` text NOT NULL,
  `degerlerimiz` text NOT NULL,
  `kurumsalAmacVeHedefler` text NOT NULL,
  `gizlilikSozlesmesi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye`
--

CREATE TABLE `uye` (
  `id` int(10) UNSIGNED NOT NULL,
  `uye_kullaniciAdi` varchar(255) NOT NULL,
  `uye_email` varchar(255) NOT NULL,
  `uye_sifre` varchar(100) NOT NULL,
  `uye_tamisim` varchar(100) NOT NULL,
  `uye_telno` varchar(11) NOT NULL,
  `uye_durum` tinyint(1) NOT NULL,
  `uye_birim` tinyint(3) UNSIGNED NOT NULL,
  `uye_kayit_tarihi` int(10) NOT NULL,
  `uye_kayit_ip_adresi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `uye`
--

INSERT INTO `uye` (`id`, `uye_kullaniciAdi`, `uye_email`, `uye_sifre`, `uye_tamisim`, `uye_telno`, `uye_durum`, `uye_birim`, `uye_kayit_tarihi`, `uye_kayit_ip_adresi`) VALUES
(1, 'admin', 'mail@example.com', 'c4ca4238a0b923820dcc509a6f75849b', 'admin', 'admintel', 1, 1, 1651357941, '::1'),
(2, 'adomin', 'adagweeh', 'c4ca4238a0b923820dcc509a6f75849b', 'eheheh', 'wregeheh', 0, 5, 1651357941, '::1'),
(3, 'sgherh', 'rehehe', 'ethrtjrj', 'ehe', 'hrjr', 0, 5, 1651820335, '::1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `birim`
--
ALTER TABLE `birim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `blogyazi`
--
ALTER TABLE `blogyazi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hastayorum`
--
ALTER TABLE `hastayorum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hizmet`
--
ALTER TABLE `hizmet`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hizmetsayi`
--
ALTER TABLE `hizmetsayi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `temelyazi`
--
ALTER TABLE `temelyazi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uye`
--
ALTER TABLE `uye`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayar`
--
ALTER TABLE `ayar`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `birim`
--
ALTER TABLE `birim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `blogyazi`
--
ALTER TABLE `blogyazi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hastayorum`
--
ALTER TABLE `hastayorum`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hizmet`
--
ALTER TABLE `hizmet`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hizmetsayi`
--
ALTER TABLE `hizmetsayi`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `temelyazi`
--
ALTER TABLE `temelyazi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `uye`
--
ALTER TABLE `uye`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
