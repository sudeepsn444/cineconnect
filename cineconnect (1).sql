-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 07:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cineconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `password_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `password_text`) VALUES
(1, 'Dev Ninja', 'admin@pictogram.com', 'c68710d3fe56fc88f7905cb15f06cf5c', '14271427');

-- --------------------------------------------------------

--
-- Table structure for table `block_list`
--

CREATE TABLE `block_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(83, 42, 26, 'Hey', '2023-03-03 17:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow_list`
--

INSERT INTO `follow_list` (`id`, `follower_id`, `user_id`) VALUES
(113, 31, 27),
(114, 31, 28),
(115, 31, 29),
(118, 26, 31),
(119, 26, 30),
(120, 26, 29),
(121, 26, 28),
(122, 26, 27),
(123, 31, 26);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(145, 42, 26),
(146, 41, 26);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `message`, `read_status`, `created_at`) VALUES
(110, 26, 31, 'hey', 1, '2023-03-03 17:44:28'),
(111, 31, 26, 'hello', 0, '2023-03-03 17:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_user_id` int(11) NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `post_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `to_user_id`, `message`, `created_at`, `from_user_id`, `read_status`, `post_id`) VALUES
(427, 27, 'started following you !', '2023-03-03 17:36:40', 26, 0, '0'),
(428, 28, 'started following you !', '2023-03-03 17:36:41', 26, 0, '0'),
(429, 29, 'started following you !', '2023-03-03 17:36:42', 26, 0, '0'),
(430, 30, 'started following you !', '2023-03-03 17:36:42', 26, 0, '0'),
(431, 31, 'started following you !', '2023-03-03 17:36:43', 26, 1, '0'),
(432, 26, 'started following you !', '2023-03-03 17:41:58', 31, 1, '0'),
(433, 27, 'started following you !', '2023-03-03 17:41:58', 31, 0, '0'),
(434, 28, 'started following you !', '2023-03-03 17:41:59', 31, 0, '0'),
(435, 29, 'started following you !', '2023-03-03 17:41:59', 31, 0, '0'),
(436, 31, 'blocked you', '2023-03-03 17:42:26', 26, 1, '0'),
(437, 31, 'Unblocked you !', '2023-03-03 17:42:27', 26, 1, '0'),
(438, 31, 'started following you !', '2023-03-03 17:42:30', 26, 1, '0'),
(439, 31, 'blocked you', '2023-03-03 17:42:33', 26, 1, '0'),
(440, 31, 'Unblocked you !', '2023-03-03 17:43:03', 26, 1, '0'),
(441, 31, 'started following you !', '2023-03-03 17:43:05', 26, 1, '0'),
(442, 31, 'Unfollowed you !', '2023-03-03 17:43:18', 26, 1, '0'),
(443, 30, 'Unfollowed you !', '2023-03-03 17:43:19', 26, 0, '0'),
(444, 29, 'Unfollowed you !', '2023-03-03 17:43:19', 26, 0, '0'),
(445, 28, 'Unfollowed you !', '2023-03-03 17:43:20', 26, 0, '0'),
(446, 27, 'Unfollowed you !', '2023-03-03 17:43:21', 26, 0, '0'),
(447, 31, 'started following you !', '2023-03-03 17:44:15', 26, 1, '0'),
(448, 30, 'started following you !', '2023-03-03 17:44:16', 26, 0, '0'),
(449, 29, 'started following you !', '2023-03-03 17:44:16', 26, 0, '0'),
(450, 28, 'started following you !', '2023-03-03 17:44:17', 26, 0, '0'),
(451, 27, 'started following you !', '2023-03-03 17:44:17', 26, 0, '0'),
(452, 26, 'started following you !', '2023-03-03 17:48:21', 31, 1, '0'),
(453, 31, 'liked your post !', '2023-03-03 17:49:10', 26, 0, '42'),
(454, 31, 'commented on your post', '2023-03-03 17:49:16', 26, 0, '42'),
(455, 31, 'liked your post !', '2023-03-03 17:49:26', 26, 0, '41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img` text NOT NULL,
  `post_text` text NOT NULL,
  `type` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img`, `post_text`, `type`, `created_at`) VALUES
(40, 31, '16778655111638039262wolf-g17d3951f3_1920.jpg', '', 'jpg', '2023-03-03 17:45:11'),
(41, 31, '1677865532video.mp4', 'this is a video', 'mp4', '2023-03-03 17:45:32'),
(42, 31, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '2023-03-03 17:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL COMMENT '1=male\r\n2=female\r\n3=others',
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL,
  `password` text NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `profession` int(11) NOT NULL COMMENT '1=director\r\n2=producer\r\n4=actor\r\n5=dancer\r\n6=editor\r\n7=singer\r\n8=writer\r\n',
  `about` varchar(500) NOT NULL,
  `experience` int(11) NOT NULL,
  `profile_pic` text NOT NULL DEFAULT 'default_profile.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ac_status` int(11) NOT NULL COMMENT '0=not verified\r\n1=active\r\n2=blocked\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `username`, `dateofbirth`, `password`, `phonenumber`, `profession`, `about`, `experience`, `profile_pic`, `created_at`, `updated_at`, `ac_status`) VALUES
(26, 'sudeep', 1, 'sudeepsn444@gmail.com', 'sam', '2002-09-19', '81dc9bdb52d04dc20036dbd8313ed055', '7411341606', 4, 'ha', 5, '167786542416752357761637829803profile.jpg', '2023-03-03 17:30:35', '2023-03-03 17:43:44', 1),
(27, 'John Smith', 1, 'john.smith@example.com', 'johnsmith', '1990-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567890', 4, 'Some information about John Smith', 5, 'default_profile.jpg', '2023-03-03 17:36:17', '2023-03-03 17:36:17', 1),
(28, 'Jane Doe', 2, 'jane.doe@example.com', 'janedoe', '1995-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567891', 5, 'Some information about Jane Doe', 4, 'default_profile.jpg', '2023-03-03 17:36:17', '2023-03-03 17:36:17', 1),
(29, 'Bob Johnson', 1, 'bob.johnson@example.com', 'bobjohnson', '1985-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567892', 6, 'Some information about Bob Johnson', 3, 'default_profile.jpg', '2023-03-03 17:36:17', '2023-03-03 17:36:17', 1),
(30, 'Alice Thompson', 2, 'alice.thompson@example.com', 'alicethompson', '1980-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567893', 7, 'Some information about Alice Thompson', 2, 'default_profile.jpg', '2023-03-03 17:36:17', '2023-03-03 17:36:17', 1),
(31, 'David Lee', 1, 'david.lee@example.com', 'director', '1992-01-01', '81dc9bdb52d04dc20036dbd8313ed055', '1234567894', 1, 'Some information about David Lee', 1, '16778655971675106004profile6.jpg', '2023-03-03 17:36:17', '2023-03-03 17:46:51', 1),
(32, 'Mary Brown', 2, 'mary.brown@example.com', 'marybrown', '1998-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567895', 7, 'Some information about Mary Brown', 2, 'default_profile.jpg', '2023-03-03 17:36:17', '2023-03-03 17:36:17', 1),
(33, 'Mark Wilson', 1, 'mark.wilson@example.com', 'markwilson', '1978-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567896', 4, 'Some information about Mark Wilson', 3, 'default_profile.jpg', '2023-03-03 17:36:17', '2023-03-03 17:36:17', 1),
(34, 'Michael Johnson', 1, 'michael.johnson@example.com', 'michaeljohnson', '1991-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567898', 5, 'Some information about Michael Johnson', 4, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(35, 'Emily Wilson', 2, 'emily.wilson@example.com', 'emilywilson', '1986-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567899', 4, 'Some information about Emily Wilson', 5, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(36, 'Ryan Davis', 1, 'ryan.davis@example.com', 'ryandavis', '1981-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567900', 6, 'Some information about Ryan Davis', 2, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(37, 'Olivia Brown', 2, 'olivia.brown@example.com', 'oliviabrown', '1983-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567901', 7, 'Some information about Olivia Brown', 3, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(38, 'Kevin Lee', 1, 'kevin.lee@example.com', 'kevinlee', '1984-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567902', 2, 'Some information about Kevin Lee', 1, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(39, 'Grace Thompson', 2, 'grace.thompson@example.com', 'gracethompson', '1987-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567903', 7, 'Some information about Grace Thompson', 2, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(40, 'Andrew Miller', 1, 'andrew.miller@example.com', 'andrewmiller', '1982-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567904', 4, 'Some information about Andrew Miller', 3, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(41, 'Isabella Johnson', 2, 'isabella.johnson@example.com', 'isabellajohnson', '1993-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567905', 6, 'Some information about Isabella Johnson', 4, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(42, 'Christopher Wilson', 1, 'christopher.wilson@example.com', 'christopherwilson', '1996-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567906', 5, 'Some information about Christopher Wilson', 5, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1),
(43, 'Victoria Davis', 2, 'victoria.davis@example.com', 'victoriadavis', '1990-01-01', '482c811da5d5b4bc6d497ffa98491e38', '1234567907', 7, 'Some information about Victoria Davis', 2, 'default_profile.jpg', '2023-03-03 17:39:43', '2023-03-03 17:39:43', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block_list`
--
ALTER TABLE `block_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block_list`
--
ALTER TABLE `block_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
