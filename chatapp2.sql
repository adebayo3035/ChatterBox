-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2023 at 03:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_id` int(255) NOT NULL,
  `creator_id` int(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_description` varchar(255) NOT NULL,
  `group_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_id`, `creator_id`, `group_name`, `group_description`, `group_image`) VALUES
(4, 1575614066, 1447734020, 'Football Banter', 'A football description group.', '1693775082—Pngtree—arabic islamic ramadan kareem mandala_2335978.jpg'),
(5, 1460559682, 1447734020, 'Football Bants', 'A football banter Group', '1693775247ustaz 1.png'),
(6, 1393462651, 1447734020, 'Free Programming Class', 'A Programming learning platform for newbies', '1693775986logo.jpg'),
(7, 1682950613, 1447734020, 'Road Walk', 'Training Update Group', '1693776521header_image.png'),
(8, 412965417, 1447734020, 'BBNAIJA', 'BBNAIJA UPDATE GROUP', '1693777431header_image2.png'),
(9, 958013644, 1447734020, 'man utd update', 'Update about manchester united', '1693777526login.png'),
(10, 377792879, 1447734020, 'English Premier League update', 'Update about English Football biggest league', '1693777580login.png'),
(11, 876551673, 1447734020, 'Wedding Update', 'Update about friend and family wedding', '1693777722company-3.jpg'),
(12, 961099849, 1447734020, 'Movie Update', 'Update about new movies', '1693777796company-1.jpg'),
(13, 124518567, 1447734020, 'Gbedu Jamz', 'Music Sharing platform', '1693952336netflix.png'),
(14, 526023653, 903758180, 'TECH ACADEMY', 'FREE PROGRAMMING TECH CLASS', '1694468562dstv.png');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `user_id`, `role`) VALUES
(1, 1575614066, 1447734020, 'Super Admin'),
(2, 1460559682, 1447734020, 'Super Admin'),
(3, 1393462651, 1447734020, 'Super Admin'),
(4, 1682950613, 1447734020, 'Super Admin'),
(5, 412965417, 1447734020, 'Super Admin'),
(6, 958013644, 1447734020, 'Super Admin'),
(7, 377792879, 1447734020, 'Super Admin'),
(8, 876551673, 1447734020, 'Super Admin'),
(9, 961099849, 1447734020, 'Super Admin'),
(10, 124518567, 1447734020, 'Super Admin'),
(11, 526023653, 903758180, 'Super Admin'),
(12, 1575614066, 583796763, 'Member'),
(13, 1460559682, 903758180, 'Member'),
(14, 1460559682, 583796763, 'Group Admin');

-- --------------------------------------------------------

--
-- Table structure for table `group_messages`
--

CREATE TABLE `group_messages` (
  `msg_id` int(11) NOT NULL,
  `group_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_messages`
--

INSERT INTO `group_messages` (`msg_id`, `group_id`, `user_id`, `message`) VALUES
(1, 526023653, 903758180, 'Hello Tech Academies'),
(2, 1460559682, 903758180, 'Hello football lovers'),
(3, 1460559682, 1447734020, 'Hello Omowunmi how are you doing'),
(4, 1575614066, 1447734020, 'Yo! Boss what\'s up, how are you doing?');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 1447734020, 583796763, 'Yo bro! watsup. My name is Wale'),
(2, 583796763, 1447734020, 'OG! hOW YOU DEY NOW'),
(3, 1447734020, 583796763, 'I dey alright boss, how that side now'),
(4, 583796763, 1447734020, '🤣 '),
(5, 583796763, 1447734020, 'Yo bro, watsup'),
(6, 1447734020, 583796763, 'I\'m good man, how are you doing'),
(7, 583796763, 1447734020, 'I\'m fine my brother'),
(8, 903758180, 1447734020, 'hello boss');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(1, 1447734020, 'Abdul-Rahmon', 'Adebayo', 'adebayoabdulrahmon@gmail.com', '268a304cbfb271fe0117e5f680d35d14', '1693738927Adebayo Abdul-Rahmon Abisoye Passport.jpg', 'Active now'),
(2, 583796763, 'Babawale', 'Olaoluwa', 'babawaleolaoluwa@gmail.com', '268a304cbfb271fe0117e5f680d35d14', '1693739110IMG_0635.jpg', 'Active now'),
(3, 903758180, 'Omowunmi', 'Adetayo', 'omowunmitayo@gmail.com', '268a304cbfb271fe0117e5f680d35d14', '1693739513IMG_20230424_124219_567.jpg', 'Active now');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_messages`
--
ALTER TABLE `group_messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `group_messages`
--
ALTER TABLE `group_messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
