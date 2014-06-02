-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2013 at 09:46 AM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_daily_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailid` text COLLATE utf8_unicode_ci,
  `registrationdate` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `securityquestion_id` int(11) DEFAULT NULL,
  `answer` text COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `record_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `securityquestion_id` (`securityquestion_id`),
  KEY `record_user_id` (`record_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `agent_status_id` int(11) DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agent_status_id` (`agent_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent_statuses`
--

CREATE TABLE IF NOT EXISTS `agent_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_statuses`
--

CREATE TABLE IF NOT EXISTS `bill_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL,
  `contenttype_id` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `language_id` (`language_id`),
  KEY `contenttype_id` (`contenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contenttypes`
--

CREATE TABLE IF NOT EXISTS `contenttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_plans`
--

CREATE TABLE IF NOT EXISTS `credit_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `credit_plan_status_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `default_plan` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_plan_statuses`
--

CREATE TABLE IF NOT EXISTS `credit_plan_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_types`
--

CREATE TABLE IF NOT EXISTS `credit_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demo_tests`
--

CREATE TABLE IF NOT EXISTS `demo_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `test_status_id` int(11) DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `resumed_time` timestamp NULL DEFAULT NULL,
  `used_time` time DEFAULT NULL,
  `total_time` time DEFAULT NULL,
  `activity` timestamp NULL DEFAULT NULL,
  `page_number` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `test_status_id` (`test_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demo_test_details`
--

CREATE TABLE IF NOT EXISTS `demo_test_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demo_test_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `flag` tinyint(1) DEFAULT NULL,
  `user_keys` text COLLATE utf8_unicode_ci,
  `answer_keys` text COLLATE utf8_unicode_ci,
  `slno` int(11) DEFAULT NULL,
  `quiz_detail_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demo_test_id` (`demo_test_id`),
  KEY `question_id` (`question_id`),
  KEY `quiz_detail_id` (`quiz_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `difficulty_levels`
--

CREATE TABLE IF NOT EXISTS `difficulty_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `web_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_status_id` int(11) DEFAULT NULL,
  `organization_type_id` int(11) DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username_auto_increment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_status_id` (`organization_status_id`),
  KEY `organization_type_id` (`organization_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_credits`
--

CREATE TABLE IF NOT EXISTS `organization_credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `credit_type_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `credit_plan_id` int(11) DEFAULT NULL,
  `offer_note` text COLLATE utf8_unicode_ci COMMENT 'if credit type 3(offer) ,add note',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_statuses`
--

CREATE TABLE IF NOT EXISTS `organization_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_types`
--

CREATE TABLE IF NOT EXISTS `organization_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `payment_status_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `ipayy_transaction_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ipayy_request_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_avanue_transaction_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_plan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE IF NOT EXISTS `payment_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE IF NOT EXISTS `payment_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for online,0 for offline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_unicode_ci,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8_unicode_ci,
  `answers` text COLLATE utf8_unicode_ci,
  `answer_keys` text COLLATE utf8_unicode_ci,
  `question_import_id` int(11) DEFAULT NULL,
  `option_images` text COLLATE utf8_unicode_ci,
  `question_status_id` int(11) NOT NULL DEFAULT '2',
  `organization_id` int(11) DEFAULT NULL,
  `question_type_id` int(11) NOT NULL,
  `share` tinyint(1) DEFAULT '0',
  `question_group_id` int(11) DEFAULT NULL,
  `import_slno` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `question_group_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `question_import_id` (`question_import_id`),
  KEY `question_status_id` (`question_status_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `language_id` (`language_id`),
  KEY `question_type_id` (`question_type_id`),
  KEY `question_group_id` (`question_group_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_groups`
--

CREATE TABLE IF NOT EXISTS `question_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passage` text COLLATE utf8_unicode_ci,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_group_import_id` int(11) DEFAULT NULL,
  `question_group_status_id` int(11) NOT NULL DEFAULT '2' COMMENT 'Use question_statuses as master\n',
  `organization_id` int(11) DEFAULT NULL,
  `question_group_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `import_slno` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `question_import_id` (`question_group_import_id`),
  KEY `question_status_id` (`question_group_status_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `language_id` (`language_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_group_imports`
--

CREATE TABLE IF NOT EXISTS `question_group_imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `csv_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_zipped_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `organization_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_imports`
--

CREATE TABLE IF NOT EXISTS `question_imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `csv_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_zipped_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `organization_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_statuses`
--

CREATE TABLE IF NOT EXISTS `question_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE IF NOT EXISTS `question_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quiz_type_id` int(11) DEFAULT NULL,
  `total_time` time DEFAULT NULL,
  `quiz_status_id` int(11) NOT NULL DEFAULT '1',
  `question_ids` text COLLATE utf8_unicode_ci,
  `credit` double DEFAULT '0',
  `organization_id` int(11) DEFAULT NULL,
  `negative_marks` tinyint(4) NOT NULL DEFAULT '0',
  `exam_id` int(11) DEFAULT NULL,
  `cutoff` float DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `special_demo` tinyint(1) NOT NULL DEFAULT '0',
  `period_from` date DEFAULT NULL,
  `period_to` date DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `question_group_ids` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `quiz_type_id` (`quiz_type_id`),
  KEY `quiz_status_id` (`quiz_status_id`),
  KEY `organization_id` (`organization_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_details`
--

CREATE TABLE IF NOT EXISTS `quiz_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `question_group` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'If Question Group = True Apply Rule on table question_groups\n',
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `question_ids` text COLLATE utf8_unicode_ci,
  `number_of_questions` smallint(6) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `total_mark` float DEFAULT NULL,
  `negative_mark` float DEFAULT NULL,
  `wrong_answer_count` smallint(6) DEFAULT NULL COMMENT 'for negative mark',
  `cutoff` float DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `number_of_question_groups` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `language_id` (`language_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_statuses`
--

CREATE TABLE IF NOT EXISTS `quiz_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_types`
--

CREATE TABLE IF NOT EXISTS `quiz_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result_statuses`
--

CREATE TABLE IF NOT EXISTS `result_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_questions`
--

CREATE TABLE IF NOT EXISTS `temp_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_unicode_ci,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8_unicode_ci,
  `answers` text COLLATE utf8_unicode_ci,
  `answer_keys` text COLLATE utf8_unicode_ci,
  `question_import_id` int(11) DEFAULT NULL,
  `option_images` text COLLATE utf8_unicode_ci,
  `question_status_id` int(11) NOT NULL DEFAULT '2',
  `organization_id` int(11) DEFAULT NULL,
  `question_type_id` int(11) NOT NULL,
  `share` tinyint(1) DEFAULT '0',
  `question_group_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `question_import_id` (`question_import_id`),
  KEY `question_status_id` (`question_status_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `language_id` (`language_id`),
  KEY `organization_id` (`organization_id`),
  KEY `question_type_id` (`question_type_id`),
  KEY `question_group_id` (`question_group_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_question_groups`
--

CREATE TABLE IF NOT EXISTS `temp_question_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passage` text COLLATE utf8_unicode_ci,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_group_import_id` int(11) DEFAULT NULL,
  `question_group_status_id` int(11) NOT NULL DEFAULT '2' COMMENT 'Use question_statuses as master\n',
  `organization_id` int(11) DEFAULT NULL,
  `question_group_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `question_import_id` (`question_group_import_id`),
  KEY `question_status_id` (`question_group_status_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `language_id` (`language_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_statuses`
--

CREATE TABLE IF NOT EXISTS `test_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_status_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exam_ids` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `user_status_id` (`user_status_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_credits`
--

CREATE TABLE IF NOT EXISTS `user_credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `credit_type_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_test_id` int(11) DEFAULT NULL,
  `user_report_id` int(11) DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `credit_plan_id` int(11) DEFAULT NULL,
  `offer_note` text COLLATE utf8_unicode_ci COMMENT 'if credit type 3(offer) ,add note',
  `organization_credit_id` int(11) DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_question_reportings`
--

CREATE TABLE IF NOT EXISTS `user_question_reportings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`question_id`,`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE IF NOT EXISTS `user_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_testimonials`
--

CREATE TABLE IF NOT EXISTS `user_testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `testimonial` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tests`
--

CREATE TABLE IF NOT EXISTS `user_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `test_status_id` int(11) DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `resumed_time` timestamp NULL DEFAULT NULL,
  `used_time` time DEFAULT NULL,
  `total_time` time DEFAULT NULL,
  `activity` timestamp NULL DEFAULT NULL,
  `page_number` smallint(6) DEFAULT NULL,
  `cutoff` float DEFAULT NULL,
  `user_mark` float DEFAULT NULL,
  `result_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `test_status_id` (`test_status_id`),
  KEY `result_status_id` (`result_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_test_details`
--

CREATE TABLE IF NOT EXISTS `user_test_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_test_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `flag` tinyint(1) DEFAULT NULL,
  `user_keys` text COLLATE utf8_unicode_ci,
  `answer_keys` text COLLATE utf8_unicode_ci,
  `slno` int(11) DEFAULT NULL,
  `quiz_detail_id` int(11) DEFAULT NULL,
  `question_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_test_id` (`user_test_id`),
  KEY `question_id` (`question_id`),
  KEY `quiz_detail_id` (`quiz_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_test_report_subject_wise`
--

CREATE TABLE IF NOT EXISTS `user_test_report_subject_wise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_test_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `number_of_questions` smallint(6) DEFAULT NULL,
  `user_mark` float DEFAULT NULL,
  `attempted` float DEFAULT NULL,
  `correct_answers` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `subject_id` (`subject_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_test_rules`
--

CREATE TABLE IF NOT EXISTS `user_test_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_test_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `quiz_detail_id` int(11) DEFAULT NULL,
  `question_group` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'If Question Group = True Apply Rule on table question_groups\n',
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `question_ids` text COLLATE utf8_unicode_ci,
  `number_of_questions` smallint(6) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `total_mark` float DEFAULT NULL,
  `negative_mark` float DEFAULT NULL,
  `wrong_answer_count` smallint(6) DEFAULT NULL COMMENT 'for negative mark',
  `cutoff` float DEFAULT NULL,
  `user_mark` float DEFAULT NULL,
  `result_status_id` int(11) DEFAULT NULL,
  `attempted` float DEFAULT NULL,
  `correct_answers` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `language_id` (`language_id`),
  KEY `exam_id` (`exam_id`),
  KEY `result_status_id` (`result_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commision` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '2',
  `agent_id` int(11) DEFAULT NULL,
  `voucher_type_id` int(11) DEFAULT NULL,
  `voucher_bill_id` int(11) DEFAULT NULL,
  `voucher_bill_item_id` int(11) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `voucher` (`voucher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_bills`
--

CREATE TABLE IF NOT EXISTS `voucher_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `bill_status_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci,
  `phone` text COLLATE utf8_unicode_ci,
  `amount` double NOT NULL,
  `commision` double NOT NULL,
  `discount` double DEFAULT NULL,
  `tax` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_bill_items`
--

CREATE TABLE IF NOT EXISTS `voucher_bill_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_bill_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `credit` double NOT NULL,
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `commision` double NOT NULL,
  `discount` double DEFAULT NULL,
  `voucher_bill_item_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_bill_item_statuses`
--

CREATE TABLE IF NOT EXISTS `voucher_bill_item_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_types`
--

CREATE TABLE IF NOT EXISTS `voucher_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
