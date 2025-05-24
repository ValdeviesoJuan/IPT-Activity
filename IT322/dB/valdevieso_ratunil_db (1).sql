-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 12:39 PM
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
  `userId` bigint(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datePosted` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcementId`, `userId`, `title`, `message`, `datePosted`, `updatedAt`) VALUES
(1, NULL, 'New Arrival of ComicZone Website', 'Hello Guys welcome to my channel', '2025-03-22 10:07:04', '2025-03-22 10:07:04'),
(2, NULL, 'Whata?', 'asidhahcac', '2025-03-22 10:08:01', '2025-03-22 10:08:01'),
(3, NULL, 'Announce', 'Message', '2025-03-22 10:09:27', '2025-03-22 10:09:27'),
(4, NULL, 'Title', 'Announcement Message', '2025-03-22 10:10:56', '2025-03-22 10:10:56'),
(5, NULL, 'Test', 'asdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2025-03-22 10:30:12', '2025-03-22 10:30:12');

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

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artistId`, `artistName`, `createdAt`, `updatedAt`) VALUES
(1, 'Juan Carlos', '2025-03-22 10:25:37', '2025-03-22 10:25:37'),
(2, 'Onitsuka', '2025-05-24 10:16:06', '2025-05-24 10:16:06'),
(3, 'Kurazy', '2025-05-24 10:24:12', '2025-05-24 10:24:12');

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

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`authorId`, `authorName`, `createdAt`, `updatedAt`) VALUES
(1, 'Juan Carlos', '2025-03-22 10:25:37', '2025-03-22 10:25:37'),
(2, 'Onitsuka', '2025-05-24 10:16:06', '2025-05-24 10:16:06'),
(3, 'Kurazy', '2025-05-24 10:24:12', '2025-05-24 10:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapterId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL,
  `chapterNumber` double NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comicartist`
--

CREATE TABLE `comicartist` (
  `comicArtistId` bigint(20) NOT NULL,
  `artistId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comicartist`
--

INSERT INTO `comicartist` (`comicArtistId`, `artistId`, `comicId`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `comicauthor`
--

CREATE TABLE `comicauthor` (
  `comicAuthorId` bigint(20) NOT NULL,
  `authorId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comicauthor`
--

INSERT INTO `comicauthor` (`comicAuthorId`, `authorId`, `comicId`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `comicgenre`
--

CREATE TABLE `comicgenre` (
  `comicGenreId` bigint(20) NOT NULL,
  `genreId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comicgenre`
--

INSERT INTO `comicgenre` (`comicGenreId`, `genreId`, `comicId`) VALUES
(1, 4, 1),
(2, 18, 1),
(3, 1, 2),
(4, 2, 2),
(5, 4, 3);

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
  `views` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comics`
--

INSERT INTO `comics` (`comicId`, `title`, `synopsis`, `url`, `cover`, `publicationDate`, `publicationStatus`, `contentRating`, `views`, `createdAt`, `updatedAt`) VALUES
(1, 'That Time I got Reincarnated as a Beauty', 'it was that Time I got reincarnated as a beauty at the city of Everdale', 'https://mangadex.org/', 'uploads/67de902123c74-Long Hair Evelyn.jpg', '2025-03-02', 'Ongoing', 'Safe', 103, '2025-03-22 10:25:37', '2025-05-24 10:30:24'),
(2, 'Oni Girl', 'In a quiet mountain village shrouded in legend, 16-year-old Aiko discovers a shocking truth — she is half-oni, the child of a human mother and a powerful demon father. Branded as cursed and feared by those around her, Aiko struggles to suppress her growing powers and find her place in a world that rejects her.\r\n\r\nWhen ancient seals begin to break and monstrous oni rise to threaten humanity, Aiko becomes an unwilling key in a centuries-old war. Torn between two worlds, she must decide: will she embrace the monstrous side she fears, or forge her own path to protect both humans and oni alike?\r\n\r\nAs allies and enemies blur, Oni Girl is a coming-of-age tale of identity, redemption, and the power of choosing who you become — not what you were born as.', '', 'uploads/68319c660c079-Robotic Oni Mask Girl.jpg', '2024-02-02', 'Ongoing', 'Suggestive', 0, '2025-05-24 10:16:06', '2025-05-24 10:16:06'),
(3, 'Bunny Girl Toki', 'In a world where animal spirits once protected the balance of nature, the bonds between humans and the spirit realm have begun to fray. Enter Toki — an energetic, snack-loving high school girl who, after a freak accident during a lunar eclipse, awakens to find she has been fused with the essence of the long-forgotten Moon Rabbit spirit.\r\n\r\nNow with enhanced agility, uncanny hearing, and the mysterious ability to leap between dimensions, Toki is recruited by the hidden agency Spirit Guard to stop rogue spirits — corrupted echoes of forgotten gods — from invading the human world. But between homework, crushes, and battling giant shadow beasts, being a magical bunny girl isn\'t all it\'s cracked up to be.\r\n\r\nArmed with a bo staff that shifts with the moon\'s phase and an attitude as bouncy as her new ears, Toki hops between chaos and comedy in this action-packed magical girl adventure. But as she learns more about the Moon Rabbit’s ancient past, Toki begins to question: is she the spirit’s chosen hero — or its vessel for something much darker?', '', 'uploads/68319e4c1ab97-Toki Bunny.jpg', '2022-02-16', 'Hiatus', 'Suggestive', 0, '2025-05-24 10:24:12', '2025-05-24 10:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `comictheme`
--

CREATE TABLE `comictheme` (
  `comicThemeId` bigint(20) NOT NULL,
  `themeId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comictheme`
--

INSERT INTO `comictheme` (`comicThemeId`, `themeId`, `comicId`) VALUES
(1, 25, 1),
(2, 25, 1),
(3, 5, 2),
(4, 6, 2),
(5, 15, 2),
(6, 16, 2),
(7, 18, 2),
(8, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genreId` bigint(20) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genreId`, `genre`, `createdAt`) VALUES
(1, 'Action', '2025-03-22 09:37:38'),
(2, 'Adventure', '2025-03-22 09:37:38'),
(3, 'Boys\' Love', '2025-03-22 09:37:38'),
(4, 'Comedy', '2025-03-22 09:37:38'),
(5, 'Crime', '2025-03-22 09:37:38'),
(6, 'Drama', '2025-03-22 09:37:38'),
(7, 'Fantasy', '2025-03-22 09:37:38'),
(8, 'Girls\' Love', '2025-03-22 09:37:38'),
(9, 'Historical', '2025-03-22 09:37:38'),
(10, 'Horror', '2025-03-22 09:37:38'),
(11, 'Isekai', '2025-03-22 09:37:38'),
(12, 'Magical Girls', '2025-03-22 09:37:38'),
(13, 'Mecha', '2025-03-22 09:37:38'),
(14, 'Medical', '2025-03-22 09:37:38'),
(15, 'Mystery', '2025-03-22 09:37:38'),
(16, 'Philosophical', '2025-03-22 09:37:38'),
(17, 'Psychological', '2025-03-22 09:37:38'),
(18, 'Romance', '2025-03-22 09:37:38'),
(19, 'Sci-Fi', '2025-03-22 09:37:38'),
(20, 'Slice of Life', '2025-03-22 09:37:38'),
(21, 'Sports', '2025-03-22 09:37:38'),
(22, 'Superhero', '2025-03-22 09:37:38'),
(23, 'Thriller', '2025-03-22 09:37:38'),
(24, 'Tragedy', '2025-03-22 09:37:38'),
(25, 'Wuxia', '2025-03-22 09:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `comicId` bigint(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `themeId` bigint(20) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`themeId`, `theme`, `createdAt`) VALUES
(1, 'Aliens', '2025-03-22 09:37:38'),
(2, 'Animals', '2025-03-22 09:37:38'),
(3, 'Cooking', '2025-03-22 09:37:38'),
(4, 'Crossdressing', '2025-03-22 09:37:38'),
(5, 'Delinquents', '2025-03-22 09:37:38'),
(6, 'Demons', '2025-03-22 09:37:38'),
(7, 'Genderswap', '2025-03-22 09:37:38'),
(8, 'Ghosts', '2025-03-22 09:37:38'),
(9, 'Gyaru', '2025-03-22 09:37:38'),
(10, 'Harem', '2025-03-22 09:37:38'),
(11, 'Incest', '2025-03-22 09:37:38'),
(12, 'Loli', '2025-03-22 09:37:38'),
(13, 'Mafia', '2025-03-22 09:37:38'),
(14, 'Magic', '2025-03-22 09:37:38'),
(15, 'Martial Arts', '2025-03-22 09:37:38'),
(16, 'Military', '2025-03-22 09:37:38'),
(17, 'Monster Girls', '2025-03-22 09:37:38'),
(18, 'Monsters', '2025-03-22 09:37:38'),
(19, 'Music', '2025-03-22 09:37:38'),
(20, 'Ninja', '2025-03-22 09:37:38'),
(21, 'Office Workers', '2025-03-22 09:37:38'),
(22, 'Police', '2025-03-22 09:37:38'),
(23, 'Post-Apocalyptic', '2025-03-22 09:37:38'),
(24, 'Reincarnation', '2025-03-22 09:37:38'),
(25, 'Reverse Harem', '2025-03-22 09:37:38'),
(26, 'Samurai', '2025-03-22 09:37:38'),
(27, 'School Life', '2025-03-22 09:37:38'),
(28, 'Shota', '2025-03-22 09:37:38'),
(29, 'Supernatural', '2025-03-22 09:37:38'),
(30, 'Survival', '2025-03-22 09:37:38'),
(31, 'Time Travel', '2025-03-22 09:37:38'),
(32, 'Traditional Games', '2025-03-22 09:37:38'),
(33, 'Vampires', '2025-03-22 09:37:38'),
(34, 'Video Games', '2025-03-22 09:37:38'),
(35, 'Villainess', '2025-03-22 09:37:38'),
(36, 'Virtual Reality', '2025-03-22 09:37:38'),
(37, 'Zombies', '2025-03-22 09:37:38');

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
-- Table structure for table `userlibrary`
--

CREATE TABLE `userlibrary` (
  `libraryId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `comicId` bigint(20) NOT NULL,
  `readStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlibrary`
--

INSERT INTO `userlibrary` (`libraryId`, `userId`, `comicId`, `readStatus`) VALUES
(7, 1, 1, 'On Hold');

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
  `profilePicture` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `birthday`, `verification`, `profilePicture`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'Juan Carlos', 'Valdevieso', 'valdeviesojuan2@gmail.com', 'password123', '7675445645', 'Male', '2025-03-24', 0, '../../assets/profileImages/user_1_68306de817ecd.jpg', 'User', '2025-03-22 09:37:56', '2025-05-23 12:45:28'),
(2, 'Josiah', 'Ratunil', 'ratunil.josiah30@gmail.com', 'password123', '678678', 'Male', '2025-03-02', 0, '', 'Admin', '2025-03-22 09:38:28', '2025-03-22 09:38:28');

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

-- --------------------------------------------------------

--
-- Table structure for table `volumechapters`
--

CREATE TABLE `volumechapters` (
  `chapterId` bigint(20) NOT NULL,
  `volumeId` bigint(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `volumes`
--

CREATE TABLE `volumes` (
  `volumeId` bigint(20) NOT NULL,
  `volumeNumber` double NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapterId`),
  ADD KEY `comicId` (`comicId`);

--
-- Indexes for table `comicartist`
--
ALTER TABLE `comicartist`
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
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comicId` (`comicId`),
  ADD KEY `userId` (`userId`);

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
-- Indexes for table `userlibrary`
--
ALTER TABLE `userlibrary`
  ADD PRIMARY KEY (`libraryId`),
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
-- Indexes for table `volumechapters`
--
ALTER TABLE `volumechapters`
  ADD KEY `chapterId` (`chapterId`),
  ADD KEY `volumeId` (`volumeId`);

--
-- Indexes for table `volumes`
--
ALTER TABLE `volumes`
  ADD PRIMARY KEY (`volumeId`);

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
  MODIFY `announcementId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artistId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authorId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapterId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comicartist`
--
ALTER TABLE `comicartist`
  MODIFY `comicArtistId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comicauthor`
--
ALTER TABLE `comicauthor`
  MODIFY `comicAuthorId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comicgenre`
--
ALTER TABLE `comicgenre`
  MODIFY `comicGenreId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comicrating`
--
ALTER TABLE `comicrating`
  MODIFY `ratingId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `comicId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comictheme`
--
ALTER TABLE `comictheme`
  MODIFY `comicThemeId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genreId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `themeId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `usercomicreview`
--
ALTER TABLE `usercomicreview`
  MODIFY `reviewId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlibrary`
--
ALTER TABLE `userlibrary`
  MODIFY `libraryId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userreportcomicreview`
--
ALTER TABLE `userreportcomicreview`
  MODIFY `reportId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `viewId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volumes`
--
ALTER TABLE `volumes`
  MODIFY `volumeId` bigint(20) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comicartist`
--
ALTER TABLE `comicartist`
  ADD CONSTRAINT `comicartist_ibfk_1` FOREIGN KEY (`artistId`) REFERENCES `artists` (`artistId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comicartist_ibfk_2` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `usercomicreview`
--
ALTER TABLE `usercomicreview`
  ADD CONSTRAINT `usercomicreview_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercomicreview_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userlibrary`
--
ALTER TABLE `userlibrary`
  ADD CONSTRAINT `userlibrary_ibfk_1` FOREIGN KEY (`comicId`) REFERENCES `comics` (`comicId`),
  ADD CONSTRAINT `userlibrary_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

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

--
-- Constraints for table `volumechapters`
--
ALTER TABLE `volumechapters`
  ADD CONSTRAINT `volumechapters_ibfk_1` FOREIGN KEY (`chapterId`) REFERENCES `chapters` (`chapterId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volumechapters_ibfk_2` FOREIGN KEY (`volumeId`) REFERENCES `volumes` (`volumeId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
