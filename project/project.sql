-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 30 May 2024, 16:42:18
-- Sunucu sürümü: 8.0.36-2ubuntu3
-- PHP Sürümü: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adminCookies`
--

CREATE TABLE `adminCookies` (
  `id` int UNSIGNED NOT NULL,
  `userid` int UNSIGNED NOT NULL,
  `cookieValue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `adminCookies`
--

INSERT INTO `adminCookies` (`id`, `userid`, `cookieValue`) VALUES
(1, 1, '0a48a5b75d8425122983fe141e2a36c1f99a601566ebb976e7f805129fd52262'),
(2, 2, '8c3206b73eb5ebe223b9ee735389351d95ee02f89879a2e6e89274ed009fa970');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'sorrence', 'f331e747e973bb2008727c3a7776fc5e382bf40367c7a7a6ccea7891c5eb03cb'),
(2, 'karim', '2df4f01039af8c1346aebc6c2834636b03791ed0c3ceffbc6d4a9479f748c1f0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bankCards`
--

CREATE TABLE `bankCards` (
  `id` int UNSIGNED NOT NULL,
  `cardNumber` varchar(255) NOT NULL,
  `expiration` varchar(255) NOT NULL,
  `cvv` int NOT NULL,
  `ownerId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `bankCards`
--

INSERT INTO `bankCards` (`id`, `cardNumber`, `expiration`, `cvv`, `ownerId`) VALUES
(6, '4242 1241 1234 4242 ', '04/47', 911, 2),
(7, '1231 1231 1231 1321 ', '02/27', 231, 2),
(9, '1233 4362 3315 5464 ', '04/47', 231, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `busCards`
--

CREATE TABLE `busCards` (
  `id` int UNSIGNED NOT NULL,
  `ownerId` int UNSIGNED DEFAULT NULL,
  `money` int DEFAULT NULL,
  `cardSerialNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `busCards`
--

INSERT INTO `busCards` (`id`, `ownerId`, `money`, `cardSerialNumber`) VALUES
(3, 2, 4242, 'fcey6s96'),
(4, 2, 900, 'dvrw1vnh'),
(5, NULL, 4644, 'asju13cj'),
(6, 2, 100, 'vdadega2'),
(7, 2, 666, 'fdsf2415');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `busses`
--

CREATE TABLE `busses` (
  `id` int UNSIGNED NOT NULL,
  `busName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `line` json DEFAULT NULL COMMENT 'Durakların id''lerini liste içinde alan bir json veri satırı',
  `price` int DEFAULT NULL COMMENT 'Otobüs ücretlendirme kısmı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `busses`
--

INSERT INTO `busses` (`id`, `busName`, `line`, `price`) VALUES
(26, '5A', '[\"2\", \"5\", \"1\"]', 12),
(28, '11A', '[\"2\", \"5\"]', 8),
(29, '7A', '[\"1\", \"5\"]', 2),
(30, 'test', '[\"1\", \"8\", \"1\"]', 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `drivers`
--

CREATE TABLE `drivers` (
  `id` int UNSIGNED NOT NULL,
  `tckn` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `salary` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `driver_bus_map`
--

CREATE TABLE `driver_bus_map` (
  `id` int UNSIGNED NOT NULL,
  `driverId` int UNSIGNED NOT NULL,
  `busId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stops`
--

CREATE TABLE `stops` (
  `id` int UNSIGNED NOT NULL,
  `stopName` varchar(255) NOT NULL COMMENT 'Otobüs durağının adı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `stops`
--

INSERT INTO `stops` (`id`, `stopName`) VALUES
(1, 'Merkez'),
(2, 'Kuzey Kampüs'),
(5, 'Buhara'),
(8, 'Saat Kulesi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `transactions`
--

CREATE TABLE `transactions` (
  `id` int UNSIGNED NOT NULL,
  `busCardId` int UNSIGNED DEFAULT NULL,
  `busId` int UNSIGNED DEFAULT NULL,
  `transactionValue` varchar(255) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `bankCardId` int UNSIGNED DEFAULT NULL,
  `userId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `transactions`
--

INSERT INTO `transactions` (`id`, `busCardId`, `busId`, `transactionValue`, `time`, `bankCardId`, `userId`) VALUES
(1, 4, NULL, '+100', '2024-05-26 18:06:21', 6, 2),
(2, 5, NULL, '+200', '2024-05-26 20:32:25', NULL, 2),
(3, 6, NULL, '+100', '2024-05-30 06:25:02', 6, 2),
(4, 4, NULL, '+100', '2024-05-30 07:30:18', 9, 2),
(5, 7, NULL, '+666', '2024-05-30 08:28:15', 7, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `userCookies`
--

CREATE TABLE `userCookies` (
  `id` int UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `cookieValue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `userCookies`
--

INSERT INTO `userCookies` (`id`, `userId`, `cookieValue`) VALUES
(1, 2, '37b48793b245ddf250a7f024f6cb4fb29c7e8d85be8fa47340d58252f421623a'),
(3, 5, '0bb1121faeeb5aae2b414554399b3058d688554461552421014e1b897338431b');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `mail`, `password`) VALUES
(2, 'Berat Can', 'Yağız', 'sorrence@test.com', 'f331e747e973bb2008727c3a7776fc5e382bf40367c7a7a6ccea7891c5eb03cb'),
(5, 'karim', 'bayram', 'karim@test.com', '2df4f01039af8c1346aebc6c2834636b03791ed0c3ceffbc6d4a9479f748c1f0');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adminCookies`
--
ALTER TABLE `adminCookies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminCookies-admins` (`userid`);

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bankCards`
--
ALTER TABLE `bankCards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner-userid` (`ownerId`);

--
-- Tablo için indeksler `busCards`
--
ALTER TABLE `busCards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerId` (`ownerId`);

--
-- Tablo için indeksler `busses`
--
ALTER TABLE `busses`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `driver_bus_map`
--
ALTER TABLE `driver_bus_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver-map` (`driverId`),
  ADD KEY `bus-map` (`busId`);

--
-- Tablo için indeksler `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactionBusses` (`busId`),
  ADD KEY `transactions_userId` (`userId`),
  ADD KEY `transactions_bankCard` (`bankCardId`),
  ADD KEY `transactions_busCard` (`busCardId`);

--
-- Tablo için indeksler `userCookies`
--
ALTER TABLE `userCookies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userCookies_relation_1` (`userId`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adminCookies`
--
ALTER TABLE `adminCookies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `bankCards`
--
ALTER TABLE `bankCards`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `busCards`
--
ALTER TABLE `busCards`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `busses`
--
ALTER TABLE `busses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `driver_bus_map`
--
ALTER TABLE `driver_bus_map`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `stops`
--
ALTER TABLE `stops`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `userCookies`
--
ALTER TABLE `userCookies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `adminCookies`
--
ALTER TABLE `adminCookies`
  ADD CONSTRAINT `adminCookies-admins` FOREIGN KEY (`userid`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `bankCards`
--
ALTER TABLE `bankCards`
  ADD CONSTRAINT `owner-userid` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `busCards`
--
ALTER TABLE `busCards`
  ADD CONSTRAINT `ownerId` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `driver_bus_map`
--
ALTER TABLE `driver_bus_map`
  ADD CONSTRAINT `bus-map` FOREIGN KEY (`busId`) REFERENCES `busses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driver-map` FOREIGN KEY (`driverId`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactionBusses` FOREIGN KEY (`busId`) REFERENCES `busses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_bankCard` FOREIGN KEY (`bankCardId`) REFERENCES `bankCards` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_busCard` FOREIGN KEY (`busCardId`) REFERENCES `busCards` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `userCookies`
--
ALTER TABLE `userCookies`
  ADD CONSTRAINT `userCookies_relation_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
