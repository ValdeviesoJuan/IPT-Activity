-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 10:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `valdevieso_ratunil_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatecomictitle`
--

CREATE TABLE `alternatecomictitle` (
  `alternateTitleId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcementId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datePosted` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artistId` bigint(20) NOT NULL,
  `artistName` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `authorId` bigint(20) NOT NULL,
  `authorName` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comicartistid`
--

CREATE TABLE `comicartistid` (
  `comicArtistId` bigint(20) NOT NULL,
  `artistId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comicauthor`
--

CREATE TABLE `comicauthor` (
  `comicAuthorId` bigint(20) NOT NULL,
  `authorId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comicgenre`
--

CREATE TABLE `comicgenre` (
  `comicGenreId` bigint(20) NOT NULL,
  `genreId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comicrating`
--

CREATE TABLE `comicrating` (
  `ratingId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

CREATE TABLE `comics` (
  `comicId` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `publicationDate` date NOT NULL,
  `publicationStatus` varchar(50) NOT NULL,
  `contentRating` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comictheme`
--

CREATE TABLE `comictheme` (
  `comicThemeId` bigint(20) NOT NULL,
  `themeId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `followId` bigint(11) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genreId` bigint(20) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `themeId` bigint(20) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usercomicreview`
--

CREATE TABLE `usercomicreview` (
  `reviewId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL,
  `rating` double NOT NULL,
  `review` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userreportcomicreview`
--

CREATE TABLE `userreportcomicreview` (
  `reportId` bigint(20) NOT NULL,
  `reviewId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `reason` text NOT NULL,
  `reportStatus` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` bigint(20) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthday` date NOT NULL,
  `verification` int(11) NOT NULL DEFAULT 0,
  `profilePicture` longblob NOT NULL,
  `role` varchar(10) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `viewId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `viewedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatecomictitle`
--
ALTER TABLE `alternatecomictitle`
  ADD PRIMARY KEY (`alternateTitleId`),
  ADD KEY `comicId` (`comicId`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcementId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artistId`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authorId`);

--
-- Indexes for table `comicartistid`
--
ALTER TABLE `comicartistid`
  ADD PRIMARY KEY (`comicArtistId`),
  ADD KEY `artistId` (`artistId`),
  ADD KEY `comicId` (`comicId`);

--
-- Indexes for table `comicauthor`
--
ALTER TABLE `comicauthor`
  ADD PRIMARY KEY (`comicAuthorId`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `comicId` (`comicId`);

--
-- Indexes for table `comicgenre`
--
ALTER TABLE `comicgenre`
  ADD PRIMARY KEY (`comicGenreId`),
  ADD KEY `genreId` (`genreId`),
  ADD KEY `comicId` (`comicId`);

--
-- Indexes for table `comicrating`
--
ALTER TABLE `comicrating`
  ADD PRIMARY KEY (`ratingId`),
  ADD KEY `comicId` (`comicId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`comicId`);

--
-- Indexes for table `comictheme`
--
ALTER TABLE `comictheme`
  ADD PRIMARY KEY (`comicThemeId`),
  ADD KEY `themeId` (`themeId`),
  ADD KEY `comicId` (`comicId`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`followId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `comicId` (`comicId`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`themeId`);

--
-- Indexes for table `usercomicreview`
--
ALTER TABLE `usercomicreview`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `comicId` (`comicId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `userreportcomicreview`
--
ALTER TABLE `userreportcomicreview`
  ADD PRIMARY KEY (`reportId`),
  ADD KEY `reviewId` (`reviewId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`viewId`),
  ADD KEY `comicId` (`comicId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatecomictitle`
--
ALTER TABLE `alternatecomictitle`
  MODIFY `alternateTitleId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcementId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artistId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authorId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comicartistid`
--
ALTER TABLE `comicartistid`
  MODIFY `comicArtistId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comicauthor`
--
ALTER TABLE `comicauthor`
  MODIFY `comicAuthorId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comicgenre`
--
ALTER TABLE `comicgenre`
  MODIFY `comicGenreId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comicrating`
--
ALTER TABLE `comicrating`
  MODIFY `ratingId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `comicId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comictheme`
--
ALTER TABLE `comictheme`
  MODIFY `comicThemeId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `followId` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genreId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `themeId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usercomicreview`
--
ALTER TABLE `usercomicreview`
  MODIFY `reviewId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userreportcomicreview`
--
ALTER TABLE `userreportcomicreview`
  MODIFY `reportId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `viewId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatecomictitle`
--
ALTER TABLE `alternatecomictitle`
  ADD CONSTRAINT `alternatecomictitle_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `comicartistid`
--
ALTER TABLE `comicartistid`
  ADD CONSTRAINT `comicartistid_ibfk_1` FOREIGN KEY (`artistId`) REFERENCES `artists` (`artistId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comicartistid_ibfk_2` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comicauthor`
--
ALTER TABLE `comicauthor`
  ADD CONSTRAINT `comicauthor_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `authors` (`authorId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comicauthor_ibfk_2` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comicgenre`
--
ALTER TABLE `comicgenre`
  ADD CONSTRAINT `comicgenre_ibfk_1` FOREIGN KEY (`genreId`) REFERENCES `genres` (`genreId`),
  ADD CONSTRAINT `comicgenre_ibfk_2` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comicrating`
--
ALTER TABLE `comicrating`
  ADD CONSTRAINT `comicrating_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comicrating_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comictheme`
--
ALTER TABLE `comictheme`
  ADD CONSTRAINT `comictheme_ibfk_1` FOREIGN KEY (`themeId`) REFERENCES `themes` (`themeId`),
  ADD CONSTRAINT `comictheme_ibfk_2` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usercomicreview`
--
ALTER TABLE `usercomicreview`
  ADD CONSTRAINT `usercomicreview_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercomicreview_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userreportcomicreview`
--
ALTER TABLE `userreportcomicreview`
  ADD CONSTRAINT `userreportcomicreview_ibfk_1` FOREIGN KEY (`reviewId`) REFERENCES `usercomicreview` (`reviewId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userreportcomicreview_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `views_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
