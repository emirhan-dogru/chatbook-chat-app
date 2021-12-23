-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Kas 2021, 12:00:01
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `chatbook`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `friend_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `message` text COLLATE utf8_turkish_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `isReaded` tinyint(4) NOT NULL DEFAULT 0,
  `isActive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `chats`
--

INSERT INTO `chats` (`id`, `user_id`, `friend_id`, `message`, `createdAt`, `isReaded`, `isActive`) VALUES
(107, '4a0fd6727730db5de20df550bf03356d62a74c60', 'bd66ee1ca48bc4d47bacae5c03bd7f0a9b2ee452', 'Hello', '2021-03-24 15:08:35', 1, 1),
(108, 'bd66ee1ca48bc4d47bacae5c03bd7f0a9b2ee452', '4a0fd6727730db5de20df550bf03356d62a74c60', 'hello!', '2021-03-24 15:09:11', 1, 1),
(109, 'bd66ee1ca48bc4d47bacae5c03bd7f0a9b2ee452', '4a0fd6727730db5de20df550bf03356d62a74c60', 'how are you', '2021-03-24 15:09:15', 1, 1),
(110, '4a0fd6727730db5de20df550bf03356d62a74c60', 'bd66ee1ca48bc4d47bacae5c03bd7f0a9b2ee452', 'thanks :)', '2021-03-24 15:09:21', 1, 1),
(111, '11876295ba1f6de559d2856df9055f90b02772c3', '4a0fd6727730db5de20df550bf03356d62a74c60', 'sadsadsa', '2021-09-07 16:53:41', 1, 1),
(112, '11876295ba1f6de559d2856df9055f90b02772c3', '4a0fd6727730db5de20df550bf03356d62a74c60', 'sadad', '2021-09-09 17:24:04', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `friend_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `chatActive` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `isActive`, `chatActive`) VALUES
(31, '4a0fd6727730db5de20df550bf03356d62a74c60', 'bd66ee1ca48bc4d47bacae5c03bd7f0a9b2ee452', 1, 1),
(32, 'bd66ee1ca48bc4d47bacae5c03bd7f0a9b2ee452', '4a0fd6727730db5de20df550bf03356d62a74c60', 1, 1),
(34, '4a0fd6727730db5de20df550bf03356d62a74c60', '71e1d38e2e1d2ec9e04634ed41dac3bd703e47a7', 1, 0),
(35, '71e1d38e2e1d2ec9e04634ed41dac3bd703e47a7', '4a0fd6727730db5de20df550bf03356d62a74c60', 1, 0),
(38, '11876295ba1f6de559d2856df9055f90b02772c3', '4a0fd6727730db5de20df550bf03356d62a74c60', 1, 1),
(39, '4a0fd6727730db5de20df550bf03356d62a74c60', '11876295ba1f6de559d2856df9055f90b02772c3', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `bio` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `lastOnline` datetime NOT NULL,
  `isPhone` tinyint(4) NOT NULL,
  `isMail` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `phone`, `user_name`, `full_name`, `bio`, `img_url`, `email`, `password`, `isActive`, `lastOnline`, `isPhone`, `isMail`, `createdAt`) VALUES
('11876295ba1f6de559d2856df9055f90b02772c3', '1234567890', '', 'Mario Dendy', '', NULL, 'root@gmail.com', '25d55ad283aa400af464c76d713c07ad', 0, '2021-09-18 19:56:21', 1, 0, '2021-03-23 18:45:33'),
('4a0fd6727730db5de20df550bf03356d62a74c60', '5849321053', '', 'Emirhan Dogru', '', NULL, 'emirhan-dogru@hotmail.com', '25d55ad283aa400af464c76d713c07ad', 1, '2021-11-12 14:00:01', 1, 0, '2021-03-23 12:12:58'),
('71e1d38e2e1d2ec9e04634ed41dac3bd703e47a7', '5354265478', NULL, 'John Doe', NULL, NULL, 'johndoe@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, '2021-03-24 14:26:54', 1, 0, '2021-03-23 12:42:53'),
('bd66ee1ca48bc4d47bacae5c03bd7f0a9b2ee452', '5437541954', NULL, 'All eyn', NULL, NULL, 'allyn@gmail.com', '25d55ad283aa400af464c76d713c07ad', 0, '2021-03-24 15:09:25', 1, 0, '2021-03-23 13:09:48');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Tablo için AUTO_INCREMENT değeri `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
