-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2015 at 04:41 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `naxxserian`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `about_id` int(10) NOT NULL AUTO_INCREMENT,
  `about_history` text NOT NULL,
  `about_mission` text NOT NULL,
  `about_vision` text NOT NULL,
  `uploaded_by` int(8) NOT NULL,
  PRIMARY KEY (`about_id`),
  KEY `uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `member_id` int(8) NOT NULL,
  `date` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`),
  KEY `project_id` (`project_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `file_id` int(10) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `header` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'if status==1, download is active, elseif status==0, download is dormant',
  `upload_date` varchar(40) NOT NULL,
  `uploaded_by` int(8) NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `loan_id` int(10) NOT NULL AUTO_INCREMENT,
  `loanee_id_number` int(8) NOT NULL,
  `guarantor_id_number` int(8) NOT NULL,
  `amount` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `application_date` datetime NOT NULL,
  `loan_status` int(1) NOT NULL DEFAULT '0' COMMENT '0==not_paid, 1==paid',
  `loan_verification` int(1) NOT NULL DEFAULT '0' COMMENT '0==pending, 1== confirmed',
  `repayment_period` int(3) NOT NULL COMMENT 'The number of months taken to fully repay the laon',
  PRIMARY KEY (`loan_id`),
  KEY `guarantor_id_number` (`guarantor_id_number`),
  KEY `loanee_id_number` (`loanee_id_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`loan_id`, `loanee_id_number`, `guarantor_id_number`, `amount`, `balance`, `application_date`, `loan_status`, `loan_verification`, `repayment_period`) VALUES
(3, 27414209, 28414209, 7500, 8250, '2015-04-07 12:11:53', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `id_number` int(8) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
  `photo` varchar(300) NOT NULL DEFAULT 'naxxserian.default.photo.naxxserian.png',
  `registration_date` datetime NOT NULL,
  `category` varchar(20) NOT NULL DEFAULT 'member',
  `type` varchar(10) NOT NULL DEFAULT 'member',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'if status=1(member is active), 0(no longer a member),2(pending to be a member)',
  `loan_status` varchar(30) NOT NULL DEFAULT 'dormant' COMMENT 'dormant==has no loan pending, active==has a loan pending',
  PRIMARY KEY (`id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='naxserian members table';

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`first_name`, `middle_name`, `surname`, `id_number`, `email_address`, `phone_number`, `password`, `photo`, `registration_date`, `category`, `type`, `status`, `loan_status`) VALUES
('dominic', 'kimani', 'ruriga', 26414209, 'dominic.ruriga@ymail.com', '0722222222', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'naxxserian.default.photo.naxxserian.png', '2015-04-04 06:00:00', 'member', 'member', 1, 'dormant'),
('denis', 'mburu', 'karanja', 27414209, 'dee.caranja@gmail.com', '0725332343', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '7f2832cc0cb8623775f76c403501aebb9406d9e1.jpg', '2015-03-26 12:28:00', 'member', 'member', 1, 'dormant'),
('kenneth', 'muturi', 'kamande', 28414209, 'camande@ymail.com', '0721175890', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'naxxserian.default.photo.naxxserian.png', '2015-03-26 00:00:00', 'member', 'member', 1, 'dormant'),
('manasseh', 'mwangi', 'muhia', 29414209, 'nassehma@gmail.com', '0725116661', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'naxxserian.default.photo.naxxserian.png', '2015-04-08 09:00:00', 'member', 'member', 1, 'dormant');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_contribution`
--

CREATE TABLE IF NOT EXISTS `monthly_contribution` (
  `mc_auto_id` int(10) NOT NULL AUTO_INCREMENT,
  `fine_type` smallint(1) NOT NULL COMMENT '0==no fine imposed,1==monthly_contribution lateness,2==meeting arrival lateness',
  `id_number` int(8) NOT NULL,
  `amount` int(10) NOT NULL,
  `date_paid` varchar(20) NOT NULL,
  `month` varchar(10) NOT NULL,
  `deposit_type` varchar(255) NOT NULL,
  `contribution_purpose` smallint(1) NOT NULL COMMENT '1==monthly_contribution, 2==welfare,3==fine',
  `added_by` int(8) NOT NULL,
  PRIMARY KEY (`mc_auto_id`),
  KEY `id_number` (`id_number`),
  KEY `added_by` (`added_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table_to_hold_monthly_contibutions of members' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `outsider_messages`
--

CREATE TABLE IF NOT EXISTS `outsider_messages` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `recipient` int(8) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `recipient` (`recipient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash`
--

CREATE TABLE IF NOT EXISTS `petty_cash` (
  `pt_auto_id` int(10) NOT NULL AUTO_INCREMENT,
  `petty_cash_type` varchar(30) NOT NULL,
  `member_id_number` int(10) NOT NULL,
  `ammount` int(10) NOT NULL,
  PRIMARY KEY (`pt_auto_id`),
  KEY `member_id_number` (`member_id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(10) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ongoing' COMMENT 'status==ongoing, pending, finished',
  `added_by` int(8) NOT NULL,
  `date_added` varchar(30) NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `added_by` (`added_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE IF NOT EXISTS `research` (
  `research_id` int(10) NOT NULL AUTO_INCREMENT,
  `research_title` varchar(255) NOT NULL,
  `research_body` text NOT NULL,
  `file_name` text NOT NULL,
  `date` varchar(30) NOT NULL,
  `researcher` int(8) NOT NULL,
  PRIMARY KEY (`research_id`),
  KEY `researcher` (`researcher`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_comments`
--

CREATE TABLE IF NOT EXISTS `research_comments` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `research_id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `comment_by` int(8) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_by` (`comment_by`),
  KEY `research_id` (`research_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temp_loan`
--

CREATE TABLE IF NOT EXISTS `temp_loan` (
  `loan_id` int(10) NOT NULL AUTO_INCREMENT,
  `loanee` int(8) NOT NULL,
  `guarantor` int(8) NOT NULL,
  `amount` int(10) NOT NULL,
  `date_applied` varchar(30) NOT NULL,
  `repayment_date` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending' COMMENT 'pending==guarantor hasn''t verified, verified== guarantor has verified the details, failed==guarantor has denied the request',
  PRIMARY KEY (`loan_id`),
  KEY `loanee` (`loanee`),
  KEY `guarantor` (`guarantor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `website_visitors`
--

CREATE TABLE IF NOT EXISTS `website_visitors` (
  `auto_id` int(100) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `id_number` int(8) NOT NULL DEFAULT '0',
  `browser` varchar(255) NOT NULL DEFAULT 'web browser',
  `platform` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`auto_id`),
  KEY `id_number` (`id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='website visitors' AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about`
--
ALTER TABLE `about`
  ADD CONSTRAINT `about_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`guarantor_id_number`) REFERENCES `members` (`id_number`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`loanee_id_number`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `monthly_contribution`
--
ALTER TABLE `monthly_contribution`
  ADD CONSTRAINT `monthly_contribution_ibfk_1` FOREIGN KEY (`id_number`) REFERENCES `members` (`id_number`),
  ADD CONSTRAINT `monthly_contribution_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `outsider_messages`
--
ALTER TABLE `outsider_messages`
  ADD CONSTRAINT `outsider_messages_ibfk_1` FOREIGN KEY (`recipient`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `petty_cash`
--
ALTER TABLE `petty_cash`
  ADD CONSTRAINT `petty_cash_ibfk_1` FOREIGN KEY (`member_id_number`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `research_ibfk_1` FOREIGN KEY (`researcher`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `research_comments`
--
ALTER TABLE `research_comments`
  ADD CONSTRAINT `research_comments_ibfk_1` FOREIGN KEY (`comment_by`) REFERENCES `members` (`id_number`),
  ADD CONSTRAINT `research_comments_ibfk_2` FOREIGN KEY (`research_id`) REFERENCES `research` (`research_id`);

--
-- Constraints for table `temp_loan`
--
ALTER TABLE `temp_loan`
  ADD CONSTRAINT `temp_loan_ibfk_1` FOREIGN KEY (`loanee`) REFERENCES `members` (`id_number`),
  ADD CONSTRAINT `temp_loan_ibfk_2` FOREIGN KEY (`guarantor`) REFERENCES `members` (`id_number`);

--
-- Constraints for table `website_visitors`
--
ALTER TABLE `website_visitors`
  ADD CONSTRAINT `website_visitors_ibfk_1` FOREIGN KEY (`id_number`) REFERENCES `members` (`id_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
