-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 11 Haz 2024, 08:59:11
-- Sunucu sürümü: 8.2.0
-- PHP Sürümü: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sinema`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bilet_satış`
--

DROP TABLE IF EXISTS `bilet_satış`;
CREATE TABLE IF NOT EXISTS `bilet_satış` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uye_id` int NOT NULL,
  `seans_id` int NOT NULL,
  `satis_saati` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `satis_tarihi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `koltuk` int NOT NULL,
  `fiyat` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filmler`
--

DROP TABLE IF EXISTS `filmler`;
CREATE TABLE IF NOT EXISTS `filmler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `film_adi` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `film_tur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `fim_sure` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `afis` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `salon_id` int NOT NULL,
  `aciklama` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `fiyat` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `filmler`
--

INSERT INTO `filmler` (`id`, `film_adi`, `film_tur`, `fim_sure`, `afis`, `salon_id`, `aciklama`, `fiyat`) VALUES
(1, 'Arabalar', 'Animasyon', '1s57dk', '578728.jpg-r_1920_1080-f_jpg-q_x-xxyxx.jpg', 1, 'Yönetmeni: John Lasseter\r\nDevam filmi: Arabalar 2\r\nArabalar, Pixar yapımı, dağıtımı Walt Disney tarafından gerçekleştirilen, 2006\'da yayımlanan Amerikan komedi-macera ve animasyon filmidir.', '70,00'),
(2, 'Harry Potter ve Felsefe Taşı', 'Fantastik', '2s32dk', '1br9qfyl5odiqet1h0k.jpg', 2, 'Yönetmen Chris Columbus | Senarist Steve Kloves\r\nOyuncular: Daniel Radcliffe, Rupert Grint, Emma Watson\r\nOrijinal adı Harry Potter and the Philosopher\'s Stone\r\n| 2s 32dk | Macera, Aile, Fantastik', '80,00'),
(3, 'Örümcek Adam ', 'Aksiyon', '2s1dk', 'Efemera_2020050718493811097312.jpg', 3, 'Yönetmen Sam Raimi | Senarist David Koepp, James Vanderbilt\r\nOyuncular: Tobey Maguire, Willem Dafoe, Kirsten Dunst\r\nOrijinal adı Spider-Man\r\n| 2s 1dk | Aksiyon, Fantastik', '80,00'),
(8, 'Ezel', 'dram', '1sa50dk', 'images', 4, 'bu filmin seansı titanik ile çakışmaması için saat 11:00 ve 18:00 da gösterilecektir\niyi seyirler', '50.00'),
(9, 'x', 'y', '1', '14575150_max', 4, '4', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeler`
--

DROP TABLE IF EXISTS `odemeler`;
CREATE TABLE IF NOT EXISTS `odemeler` (
  `kart_numarasi` int NOT NULL,
  `son_kullanma_tarihi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `cvv` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `odemeler`
--

INSERT INTO `odemeler` (`kart_numarasi`, `son_kullanma_tarihi`, `cvv`) VALUES
(0, '', 0),
(0, '', 0),
(0, '', 0),
(0, '', 0),
(0, '', 0),
(0, '', 0),
(2147483647, '2029-02-04', 789),
(2147483647, '2029-05-08', 753),
(2147483647, '2029-06-12', 159),
(1333655555, '09/25', 555),
(1333655555, '09/25', 555),
(123456789, '23/26', 123),
(147963258, '03/30', 159),
(147963258, '03/30', 159),
(147963258, '03/30', 159),
(2147483647, '7526543', 752691),
(2147483647, '01/25', 771),
(1111111111, '11/11', 111),
(159753258, '95147963', 57),
(123123123, '01/32', 951),
(321321321, '11/12', 654),
(789789789, '08/28', 987),
(741741741, '12/35', 741),
(2147483647, '05/91', 905),
(2147483647, '05/91', 905),
(963963963, '2051', 227),
(963963963, '2051', 227),
(2147483647, '2500', 167),
(2147483647, '2500', 167),
(2147483647, '2600', 265),
(515198, '1519198', 1918),
(981891, '981', 981),
(2147483647, '3333', 333),
(2147483647, '3333', 333),
(2147483647, '3333', 333),
(444444444, '4444', 444),
(2147483647, '5555', 5555),
(2147483647, '5555', 5555),
(2147483647, '777', 777),
(78888888, '8888888', 8888),
(151818181, '2228', 355),
(2147483647, '9988', 111),
(123321258, '2069', 913),
(2147483647, '2051', 651),
(2147483647, '2051', 651),
(2147483647, '04/26', 162),
(8498484, '2050', 555),
(2147483647, '2026', 777),
(1599816523, '12/30', 805),
(1599816523, '12/30', 805),
(2147483647, '12/2035', 48),
(2147483647, '11/2036', 268),
(1234532532, '10/25', 123),
(1253263543, '09/37', 918),
(1253263543, '09/37', 918),
(2147483647, '09/25', 154),
(2147483647, '09/25', 154),
(1928377463, '10/2030', 632),
(1910505050, '629', 988),
(1910505050, '629', 988),
(1910505050, '629', 988),
(15975616, '11/2024', 138),
(190503504, '5156006', 5165),
(2147483647, '1905', 190505),
(2147483647, '09/25', 51905),
(1418165981, '12/45', 949),
(2147483647, '09/29', 516),
(2147483647, '6515', 777),
(1333655555, '2051', 455),
(1333655555, '2051', 455),
(3165, '416646', 464),
(123456789, '10/39', 293),
(987456321, '11/24', 952),
(987456321, '11/24', 952),
(2147483647, '84984', 848),
(2147483647, '15151', 1515),
(165444444, '4', 4),
(6516577, '09/45', 447),
(111111111, '11/51', 1111),
(851941984, '555', 55555),
(44, '4', 4),
(1, '9', 5),
(1333655555, '23/26', 444),
(2147483647, '08/31', 312),
(1333655555, '03/30', 111),
(2147483647, '05/91', 111),
(1333655555, '05/91', 111),
(2147483647, '06/36', 357),
(165486846, '561684465', 225),
(2147483647, '519818', 44),
(1231321, '321321231', 231324),
(2, '3', 4),
(3, '3', 4),
(2147483647, '259', 258),
(1333655555, '23/26', 452),
(1333655555, '23/26', 3333),
(2147483647, '515', 1515151),
(1333655555, '2051', 111),
(1333655555, '2051', 555),
(1333655555, '05/91', 256);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rezervasyonlar`
--

DROP TABLE IF EXISTS `rezervasyonlar`;
CREATE TABLE IF NOT EXISTS `rezervasyonlar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `film_id` int DEFAULT NULL,
  `uye_id` varchar(50) COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `seans_saati` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `koltuk_no` int DEFAULT NULL,
  `bilet_kimlik` varchar(50) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `film_id` (`film_id`),
  KEY `uye_id` (`uye_id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `rezervasyonlar`
--

INSERT INTO `rezervasyonlar` (`id`, `film_id`, `uye_id`, `seans_saati`, `koltuk_no`, `bilet_kimlik`) VALUES
(48, 1, '1', '23:00', 20, '165057'),
(46, 4, '1', '23:00', 50, ''),
(51, 1, '1', '11:00', 10, '519441'),
(54, 1, '1', '18:00', 7, '323922'),
(55, 1, '1', '18:00', 7, '309297'),
(64, 4, '1', '23:00', 49, '285735'),
(66, 4, '1', '23:00', 23, '010519'),
(67, 4, '1', '11.00', 30, '12214'),
(68, 4, '1', '20:00', 23, '385693'),
(69, 4, '1', '20:00', 48, '494925'),
(70, 4, '1', '20:00', 48, '313279'),
(71, 4, '1', '20:00', 9, '990090'),
(72, 3, '1', '11:00', 8, '796686'),
(73, 3, '1', '11:00', 8, '181623'),
(74, 4, '1', '23:00', 8, '532588'),
(75, 4, '1', '23:00', 8, '204040'),
(76, 4, '1', '20:00', 48, '418767'),
(77, 4, '1', '20:00', 8, '224292'),
(81, 4, '1', '20:00', 1, '10600'),
(84, 1, '1', '11:00', 10, '13402'),
(85, 1, '1', '11:00', 9, '11699'),
(88, 1, 'Abuzer Aydın', '11:00', 1, '10626'),
(89, 2, '1', '20:00', 1, '798548'),
(90, 2, '1', '20:00', 2, '112854'),
(91, 4, 'Tunç Çindaş', '23:00', 3, '12924'),
(92, 1, 'deneme', '20:00', 1, '14777'),
(94, 4, '1', '23:00', 20, '662223'),
(95, 8, 'Deneme', '20:00', 24, '10392'),
(96, 1, 'Deniz Kara', '20:00', 18, '10536'),
(101, 1, 'berfffin ', '20:00', 15, '14146'),
(102, 1, '1', '20:00', 8, '169119'),
(105, 4, '1', '20:00', 27, '984316'),
(104, 4, 'Dilan Yıldızım', '20:00', 26, '10599'),
(111, 3, '1', '18:00', 4, '635097');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `salon`
--

DROP TABLE IF EXISTS `salon`;
CREATE TABLE IF NOT EXISTS `salon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salon_adi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `salon_kapasite` int NOT NULL,
  `koltuk_sayisi` int NOT NULL,
  `filmID` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `salon`
--

INSERT INTO `salon` (`id`, `salon_adi`, `salon_kapasite`, `koltuk_sayisi`, `filmID`) VALUES
(1, 'Salon1', 20, 20, 0),
(2, 'Salon2', 30, 30, 0),
(3, 'Salon3', 40, 40, 0),
(4, 'Salon4', 50, 50, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seans`
--

DROP TABLE IF EXISTS `seans`;
CREATE TABLE IF NOT EXISTS `seans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `seans_saati` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `film_id` int NOT NULL,
  `salon_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `seans`
--

INSERT INTO `seans` (`id`, `seans_saati`, `film_id`, `salon_id`) VALUES
(1, '11.00', 1, 1),
(3, '18.00', 2, 2),
(4, '20.00', 3, 3),
(5, '23.00', 4, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tarih`
--

DROP TABLE IF EXISTS `tarih`;
CREATE TABLE IF NOT EXISTS `tarih` (
  `tarih_id` int NOT NULL AUTO_INCREMENT,
  `tarih` date NOT NULL,
  PRIMARY KEY (`tarih_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `tarih`
--

INSERT INTO `tarih` (`tarih_id`, `tarih`) VALUES
(1, '2024-04-15'),
(2, '2024-04-16'),
(3, '2024-04-17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

DROP TABLE IF EXISTS `uyeler`;
CREATE TABLE IF NOT EXISTS `uyeler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uye_adi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `uye_soyadi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `uye_mail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `uye_sifre` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `uye_adi`, `uye_soyadi`, `uye_mail`, `uye_sifre`) VALUES
(1, 'Deniz', 'Yılmaz', 'denizyılmaz@gmail.com', 'deniz.123'),
(2, 'ayşe', 'kılıç', 'ayşekılıç@gmail.com', 'ayse.78'),
(3, 'ahmet', 'kıran', 'ahmetkıran@gmail.com', 'ahmet.46'),
(4, 'mehmet', 'çelik', 'mehmetçelik@gmail.com', 'mehmet.456'),
(5, 'mustafa', 'yıldırım', 'mustafayıldırım@gmail.com', 'musti.123'),
(6, 'ela', 'nur', 'elanur@gmail.com', 'ela.22'),
(7, 'sena', 'köz', 'senaközgmail.com', 'sena.66'),
(8, 'derin', 'çiçekçi', 'derninçiçekçi@gmail.com', 'derin.12'),
(9, 'mertenes', 'saray', 'mertens@gmail.com', 'enes.19'),
(10, 'rana', 'kaplan', 'ranakalpan@gmail.com', 'rana.46'),
(11, 'eren', 'yolmaz', 'erenyolmaz@gmail.com', 'eren.753'),
(12, 'ali', 'akyol', 'aliakyol@gmail.com', 'ali.ali23'),
(13, 'suna', 'turgut', 'sunaturgut@gmail.com', 'suna.789'),
(14, 'begüm', 'zoroğlu', 'begümzoroğlu@gmail.com', 'begüm.429'),
(15, 'ismail', 'algöz', 'ismailalgöz@gmail.com', 'iso.1597'),
(16, 'mauro', 'icardi', 'm99@gmail.com', '$2y$10$DcV'),
(17, 'dilara', 'yılmaz', 'dila19@gmail.com', '$2y$10$3il'),
(18, 'berkin', 'özer', 'berkis@gmail.com', '$2y$10$wdx'),
(19, 'leyla', 'kapıcı', 'leylamecnun@gmail.com', 'leyla789'),
(20, 'meral', 'kacak', 'meralo@gmail.com', '$2y$10$8HQ'),
(30, 'cansu', 'gök', 'cansgk@gmail.com', ''),
(31, 'bahar', 'çiçek', 'bahar@gmail.com', 'baharcm'),
(32, 'rasim', 'peynir', 'rasmpynr@gmail.com', '$2y$10$8wc'),
(33, 'lokman', 'hekim', 'lokman@gmail.com', 'lokmanhk'),
(35, 'utku', 'özer', 'utkuu.ozerr@gmail.com', '202923'),
(34, 'melahat', 'özer', 'melahateozer@gmail.com', 'meşahat123'),
(28, 'ayşem', 'kız', 'ayse@gmail.com', '$2y$10$nsX'),
(29, 'polat', 'alemdar', 'polat@gmail.com', ''),
(36, 'meloş', 'özer', 'melosozer@gmail.com', 'meloş123'),
(37, 'Abidin', 'sarıyayla', 'sariyayla@gmail.com', 'yayla123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
