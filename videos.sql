-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2025 at 08:16 PM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dailybytes`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `videoid` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(50) NOT NULL,
  `video_link` varchar(400) NOT NULL,
  `status` enum('pending','published') NOT NULL,
  `categoryid` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uploaded_by` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`videoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`videoid`, `title`, `description`, `video_link`, `status`, `categoryid`, `uploaded_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('60272a5a-acac-45f5-8012-1399cdcffb20', 'Mazan Jiya', 'Mazan Jiya na fama Da aiki', '<iframe width=\"483\" height=\"858\" src=\"https://www.youtube.com/embed/Yf-KaJusjLU\" title=\"African training hit different #bodybuilding #shredded #africanbodybuilders\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'pending', 'a2034f4a-7504-4b19-b523-81730f828eb0', '12345abcd54321', '2025-11-26 19:50:01.045649', NULL, NULL),
('bae23fba-596f-4f20-a534-993c94a20e5e', 'Terrorists Tell Kebbi Schoolgirls \'We Are Releasing You, Government Did Not Rescue You\'', 'Terrorists Tell Kebbi Schoolgirls \'We Are Releasin', '<iframe width=\"1312\" height=\"738\" src=\"https://www.youtube.com/embed/RSTc1SDc73M\" title=\"Terrorists Tell Kebbi Schoolgirls &#39;We Are Releasing You, Government Did Not Rescue You&#39;\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'pending', 'cf5e983b-3e96-4d99-803c-94b120cbae05', '12345abcd54321', '2025-11-26 19:51:29.342239', NULL, NULL),
('20728f94-9c78-463c-ab06-2cd898702ce8', 'All 24 Kebbi Schoolgirls Freed, Tinubu Elated, Says He Is Relieved', '', '<iframe width=\"483\" height=\"858\" src=\"https://www.youtube.com/embed/rNacMdATJ8Q\" title=\"Caught on Camera! Two Men Capture a Giant Snake 🐍😱\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'pending', 'cf5e983b-3e96-4d99-803c-94b120cbae05', '12345abcd54321', '2025-11-26 19:55:18.915650', NULL, NULL),
('327a042d-e3d3-4b04-b50f-1663f122e32b', 'Kwara State Terrorist strike again,abduct 11 people again', 'Kwara State Terrorist strike again,abduct 11 peopl', '<iframe width=\"1312\" height=\"738\" src=\"https://www.youtube.com/embed/k9kz47C4th8\" title=\"Kwara State Terrorist strike again,abduct 11 people again. #nigerianews #arisetvnews #arisetv\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'pending', '7a9dc80a-9d76-40d2-8868-37c72512d459', '12345abcd54321', '2025-11-26 19:56:35.720275', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
