-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2026 at 09:00 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qr_menu`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_restoran_dashboard` (IN `p_restoran_id` INT)   BEGIN

    SELECT
        r.id AS restoran_id,
        r.name AS restoran_adi,

        (SELECT COUNT(*) 
         FROM kategoriler 
         WHERE restoran_id = r.id) AS toplam_kategori,

        (SELECT COUNT(*) 
         FROM urunler 
         WHERE restoran_id = r.id) AS toplam_urun,

        (SELECT ROUND(
            AVG((menu_rating + service_rating + venue_rating) / 3),
            2
        )
         FROM geri_bildirim
         WHERE restoran_id = r.id) AS ortalama_puan,

        (SELECT COUNT(*)
         FROM geri_bildirim
         WHERE restoran_id = r.id
           AND created_at >= CURDATE() - INTERVAL 7 DAY
        ) AS haftalik_geri_bildirim,

        (SELECT COUNT(*)
         FROM qr_logs
         WHERE restoran_id = r.id
           AND visit_date = CURDATE()
        ) AS bugun_qr

    FROM restoranlar r
    WHERE r.id = p_restoran_id
    LIMIT 1;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int UNSIGNED NOT NULL,
  `restoran_id` int UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_path` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_url` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mime_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fiyat_logs`
--

CREATE TABLE `fiyat_logs` (
  `urunID` int UNSIGNED NOT NULL,
  `eskiFiyat` decimal(10,2) NOT NULL,
  `yeniFiyat` decimal(10,2) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `geri_bildirim`
--

CREATE TABLE `geri_bildirim` (
  `id` int UNSIGNED NOT NULL,
  `restoran_id` int UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `menu_rating` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `service_rating` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `venue_rating` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int UNSIGNED NOT NULL,
  `restoran_id` int UNSIGNED NOT NULL,
  `image_id` int UNSIGNED DEFAULT NULL,
  `kategori_adi` varchar(255) NOT NULL,
  `durum` enum('aktif','pasif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qr_logs`
--

CREATE TABLE `qr_logs` (
  `id` int NOT NULL,
  `restoran_id` int UNSIGNED NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `device_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `visit_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restoranlar`
--

CREATE TABLE `restoranlar` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sehir` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ilce` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gunler` json NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slogan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `urunler`
--

CREATE TABLE `urunler` (
  `id` int UNSIGNED NOT NULL,
  `restoran_id` int UNSIGNED NOT NULL,
  `productCategoryId` int UNSIGNED NOT NULL,
  `prodctImageId` int UNSIGNED DEFAULT NULL,
  `productName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prodctPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `prodctStatus` enum('aktif','pasif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `prodctDescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `urunler`
--
DELIMITER $$
CREATE TRIGGER `fiyat_logs` AFTER UPDATE ON `urunler` FOR EACH ROW INSERT INTO fiyat_logs (urunID,eskiFiyat,yeniFiyat) VALUES (NEW.id,OLD.prodctPrice,NEW.prodctPrice)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_restoran_dashboard`
-- (See below for the actual view)
--
CREATE TABLE `view_restoran_dashboard` (
`restoran_id` int unsigned
,`restoran_adi` varchar(255)
,`toplam_kategori` bigint
,`toplam_urun` bigint
,`ortalama_puan` decimal(8,2)
,`toplam_qr` bigint
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restoran_id` (`restoran_id`);

--
-- Indexes for table `fiyat_logs`
--
ALTER TABLE `fiyat_logs`
  ADD PRIMARY KEY (`urunID`);

--
-- Indexes for table `geri_bildirim`
--
ALTER TABLE `geri_bildirim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_restoran_geri_bildirim` (`restoran_id`);

--
-- Indexes for table `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restoranlar` (`restoran_id`),
  ADD KEY `attachments` (`image_id`);

--
-- Indexes for table `qr_logs`
--
ALTER TABLE `qr_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_qr_logs_restoran` (`restoran_id`),
  ADD KEY `idx_qr_logs_visit_date` (`visit_date`);

--
-- Indexes for table `restoranlar`
--
ALTER TABLE `restoranlar`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_urunler_kategoriler` (`productCategoryId`),
  ADD KEY `fk_urunler_restoranlar` (`restoran_id`),
  ADD KEY `fk_urunler_attachments` (`prodctImageId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `geri_bildirim`
--
ALTER TABLE `geri_bildirim`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qr_logs`
--
ALTER TABLE `qr_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restoranlar`
--
ALTER TABLE `restoranlar`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Structure for view `view_restoran_dashboard`
--
DROP TABLE IF EXISTS `view_restoran_dashboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_restoran_dashboard`  AS SELECT `r`.`id` AS `restoran_id`, `r`.`name` AS `restoran_adi`, count(distinct `k`.`id`) AS `toplam_kategori`, count(distinct `u`.`id`) AS `toplam_urun`, round(avg((((`g`.`menu_rating` + `g`.`service_rating`) + `g`.`venue_rating`) / 3)),2) AS `ortalama_puan`, count(distinct `q`.`id`) AS `toplam_qr` FROM ((((`restoranlar` `r` left join `kategoriler` `k` on((`k`.`restoran_id` = `r`.`id`))) left join `urunler` `u` on((`u`.`restoran_id` = `r`.`id`))) left join `geri_bildirim` `g` on((`g`.`restoran_id` = `r`.`id`))) left join `qr_logs` `q` on((`q`.`restoran_id` = `r`.`id`))) GROUP BY `r`.`id` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `fk_attachments_restoran` FOREIGN KEY (`restoran_id`) REFERENCES `restoranlar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fiyat_logs`
--
ALTER TABLE `fiyat_logs`
  ADD CONSTRAINT `fk_fiyat_logs_urun` FOREIGN KEY (`urunID`) REFERENCES `urunler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `geri_bildirim`
--
ALTER TABLE `geri_bildirim`
  ADD CONSTRAINT `fk_restoran_geri_bildirim` FOREIGN KEY (`restoran_id`) REFERENCES `restoranlar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD CONSTRAINT `attachments` FOREIGN KEY (`image_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `restoranlar` FOREIGN KEY (`restoran_id`) REFERENCES `restoranlar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qr_logs`
--
ALTER TABLE `qr_logs`
  ADD CONSTRAINT `fk_qr_logs_restoran` FOREIGN KEY (`restoran_id`) REFERENCES `restoranlar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `fk_urunler_attachments` FOREIGN KEY (`prodctImageId`) REFERENCES `attachments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_urunler_kategoriler` FOREIGN KEY (`productCategoryId`) REFERENCES `kategoriler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_urunler_restoranlar` FOREIGN KEY (`restoran_id`) REFERENCES `restoranlar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
