-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2018 at 12:30 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `content`, `user_id`, `question_id`, `date`) VALUES
(1, 'Try using PHP GET method. Like- url/path?$variable= $value', 3, 1, '2018-08-03 00:30:02'),
(4, 'So the answer is &quot;..mm&quot;', 2, 4, '2018-08-03 11:08:39'),
(5, 'You can try few tutorials from youtube ', 3, 6, '2018-08-04 12:08:27'),
(7, 'yeap use get', 2, 1, '2018-08-04 12:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Programming'),
(2, 'Web Design'),
(3, 'Graphics Design'),
(4, 'Networking'),
(5, 'Web Development'),
(6, 'Robotics');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `title` varchar(150) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `content` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `tags` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `title`, `content`, `date`, `user_id`, `tags`, `category_id`) VALUES
(1, 'How to send data through URL?', 'I\'m stuck with a page where I need to send information from one page to other through URL. How to do so?', '2018-08-03 00:14:50', 1, '', 2),
(2, 'What\'s wrong with my code?', 'scanf(\"%F %f\", a, b);\r\nOutput: error code:9018', '2018-01-06 06:33:38', 4, '', 1),
(3, 'My question ', 'nothing', '2018-08-03 11:08:17', 1, 'fcafc', 4),
(4, 'My question ', '..mm', '2018-08-03 11:08:39', 1, '', 1),
(5, 'My question ', '...', '2018-08-03 11:08:58', 1, '', 2),
(6, 'How to make a line follower?', 'Hey, I have a a few servos and a development board. How can i make a line following Robot?', '2018-08-03 11:08:30', 2, 'linefollwer', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `date` date NOT NULL,
  `password` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `date`, `password`) VALUES
(1, 'Raisul', '2018-07-10', '1'),
(2, 'Sakib', '2018-08-01', '2'),
(3, 'Sabuj', '2018-08-02', '3'),
(4, 'Rakib', '2018-07-09', '4'),
(5, 'Foysal', '2018-07-26', '5'),
(6, 'fpo', '2018-08-08', '8713'),
(7, 'Raisul Kibria', '2018-08-03', 'asd'),
(8, 'Faa', '2018-08-03', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
