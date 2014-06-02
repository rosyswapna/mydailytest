-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2013 at 11:13 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.6-1ubuntu1.4

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `password`, `emailid`, `registrationdate`, `lastlogin`, `image`, `securityquestion_id`, `answer`, `created`, `updated`, `record_user_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, '2013-10-08 18:44:39', NULL, NULL, NULL, '2013-04-22 00:00:00', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contenttypes`
--

CREATE TABLE IF NOT EXISTS `contenttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contenttypes`
--

INSERT INTO `contenttypes` (`id`, `name`, `description`) VALUES
(1, 'HTML', 'Html Editor'),
(2, 'TEXT', 'No Html Editor');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `credit_plans`
--

INSERT INTO `credit_plans` (`id`, `name`, `amount`, `credit`, `credit_plan_status_id`) VALUES
(1, 'silver', 100, 100, 1),
(2, 'gold', 200, 225, 1),
(3, 'platinum', 500, 600, 1),
(4, 'frequent user', 1000, 1200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `credit_plan_statuses`
--

CREATE TABLE IF NOT EXISTS `credit_plan_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `credit_plan_statuses`
--

INSERT INTO `credit_plan_statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `credit_types`
--

CREATE TABLE IF NOT EXISTS `credit_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `credit_types`
--

INSERT INTO `credit_types` (`id`, `name`) VALUES
(1, 'Payment'),
(2, 'Test'),
(3, 'Offer'),
(4, 'Report');

-- --------------------------------------------------------

--
-- Table structure for table `difficulty_levels`
--

CREATE TABLE IF NOT EXISTS `difficulty_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `difficulty_levels`
--

INSERT INTO `difficulty_levels` (`id`, `name`) VALUES
(1, 'Easy'),
(2, 'Medium'),
(3, 'Hard');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `organization_id`) VALUES
(1, 'LDC', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `publish`) VALUES
(1, 'English', 1),
(2, 'Hindi', 1),
(3, 'Malayalam', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organization_statuses`
--

CREATE TABLE IF NOT EXISTS `organization_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organization_types`
--

CREATE TABLE IF NOT EXISTS `organization_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `cc_avanue_transaction_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_plan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE IF NOT EXISTS `payment_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `name`) VALUES
(1, 'Payment Pending'),
(2, 'Paid'),
(3, 'Payment Failed'),
(4, 'Payment Cancelled'),
(5, 'Refund Pending'),
(6, 'Refund Failed'),
(7, 'Refund Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE IF NOT EXISTS `payment_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for online,0 for offline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `online`) VALUES
(1, 'iPayy', 1),
(2, 'CCAvanue', -1),
(3, 'Cheque', 0),
(4, 'Cash', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=709 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answers`, `answer_keys`, `question_import_id`, `option_images`, `question_status_id`, `organization_id`, `question_type_id`, `share`, `question_group_id`, `import_slno`) VALUES
(1, 'ഐക്യരാഷ്ട്രസഭയിൽ ഏറ്റവും അവസാനമായി അംഗമായ രാജ്യം ഏത്?', 1, 1, 1, 1, 1, NULL, ' കൊാസോവാ*മോണ്ടിനെഗ്രോ*ഈസ്റ്റ് ടിമൂർ*സൗത്ത് സുഡാൻ', ' സൗത്ത് സുഡാൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(2, 'താഴെ പറയുന്നവയിൽ സ്‌കാന്റിനേവിയൻ രാജ്യം അല്ലാത്തത് ഏത്?', 1, 1, 1, 1, 1, NULL, 'സ്‌പെയിൻ*സ്വീഡൻ*നോർവ്വെ*ഡെൻമാർക്ക്', ' സ്‌പെയിൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(3, 'ഫെയ്‌സ്ബുക്ക് എന്ന ഇന്റർനെറ്റ് കൂട്ടായ്മയുടെ സ്ഥാപകൻ ആര്?', 1, 1, 1, 1, 1, NULL, 'ജൂലിയൻ അസാൻഞ്ജ്*ബിൽഗേറ്റ്‌സ്*മാർക്ക് സക്കർബർഗ്*സബീർഭാട്ടിയ', ' മാർക്ക് സക്കർബർഗ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(4, 'ദേശീയവിജ്ഞാന കമ്മീഷൻ ചെയർമാൻ ആര്?', 1, 1, 1, 1, 1, NULL, ' സാം പിത്രോഡ*എം.എസ്.സ്വാമിനാഥൻ*എം.സ് അലുവാലിയ*കെ.ജി.ബാലകൃഷ്ണൻ', ' സാംപിത്രോഡ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(5, 'സമീപകാലത്തെ ഇന്ത്യാക്കാരുടേതടക്കമുള്ള നിക്ഷേപത്തിന്റെ ഇടപാട് രഹസ്യം വെളിപ്പെടുത്തിയ ബാങ്ക് ഏത്?', 1, 1, 1, 1, 1, NULL, 'ലക്‌സംബർഗ്*ബഹാമാസ്*ചാനൽ ഐലന്റ്*ലിച്ചൻ സ്റ്റെയിൻ', ' ലിച്ചൻ സ്റ്റെയിൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(6, 'നെല്ലുല്ലപാദനത്തിൽ ലോകത്ത് ഒന്നാം സ്ഥാനത്ത് നില്ക്കുന്ന രാജ്യം ഏത്?', 1, 1, 1, 1, 1, NULL, ' ഇൻഡ്യ*ചൈന*യു.എസ്.എ*ബ്രസീൽ', ' ചൈന', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(7, 'നേപ്പാളിലെ ഇപ്പോഴത്തെ പ്രധാനമന്ത്രി ആര്?', 1, 1, 1, 1, 1, NULL, ' ത്ചലാം നാഥ് ഖനാൽ*മാധവ് കുമാർ നേപ്പാൾ*പ്രചണ്ഡ*ജി.ബി.കൊയ് രാള ', ' ത്ചലാം നാഥ് ഖനാൽ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(8, 'ഗൂർണിക്ക എന്ന പ്രശസ്തമായ ചിത്രം വരച്ചതാര്?', 1, 1, 1, 1, 1, NULL, 'ലിയനാർഡോ ഡാവിഞ്ചി*രാജരവിവർമ്മ* എം.എഫ്.ഹുസൈൻ*പാബ്ലോ പിക്കാസോ', ' പാബ്ലോ പിക്കാസോ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(9, 'സമരം തന്നെ ജീവിതം ആരുടെ ആത്മകഥയാണ്?', 1, 1, 1, 1, 1, NULL, 'ഇ.എം.എസ്*ഇ.കെ.നായനാർ*എ.കെ.ഗോപാലൻ*വി.എസ് അച്യുതാനന്ദൻ', ' വി.എസ് അച്യുതാനന്ദൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(10, 'അരിപ്പ പക്ഷി സങ്കേതം കേരളത്തിലെ ഏതു ജില്ലയിലാണ്?', 1, 1, 1, 1, 1, NULL, ' തിരുവനന്തപുരം*കൊല്ലം*പാലക്കാട്*മലപ്പുറം', ' തിരുവനന്തപുരം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(11, 'ശ്രീനാരയണധർമ്മപരിപാലനയോഗം സ്ഥാപിതമായ വർഷം ഏത്?', 1, 1, 1, 1, 1, NULL, '1901*1902*1903*1904', ' 1903', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(12, 'കുറുവ ദ്വീപ് ഏത് നദിയിലാണ്', 1, 1, 1, 1, 1, NULL, 'പമ്പാനദി*പാമ്പാർ*ഭവാനി*കബിനി', ' കബിനി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(13, 'ഗാൽവനൈസേഷൻ ചെയ്യാൻ ഉപയോഗിക്കുന്ന ലേഹം ഏത്', 1, 1, 1, 1, 1, NULL, 'സിങ്ക്*ലെഡ്*ടിൻ*ചെമ്പ്', ' സിങ്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(14, 'കടലിന്റെ ആഴം അളക്കുന്നതിന് ഉപയോഗിക്കുന്ന ഉപകരണം ഏത്', 1, 1, 1, 1, 1, NULL, 'സോണോമീറ്റർ*എക്കോസൗണ്ടർ*അൾട്ടീമീറ്റർ*ഹൈേേഡ്രാഫോൺ', ' എക്കോസൗണ്ടർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(15, 'കാഴ്ചയെ കുറിച്ചുള്ള ബോധം ഉളവാക്കുന്ന തലച്ചോറിന്റെ ഭാഗം ഏത്?', 1, 1, 1, 1, 1, NULL, 'സെറിബല്ലം*സെറിബ്രം*മെഡുല ഒബ്ലോഗേറ്റ*കോർണിയ', ' സെറിബ്രം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(16, 'മുട്ടത്തോട് നിർമ്മിച്ചിരിക്കുന്ന വസ്തു ഏത്?', 1, 1, 1, 1, 1, NULL, 'കാൽസ്യം കാർബണേറ്റ്*കാൽസ്യ ഫോസ്‌േേഫറ്റ്*കാൽസ്യം ബൈകാർബണേറ്റ്*കാൽസ്യം സൾഫേറ്റ്', ' കാൽസ്യം കാർബണേറ്റ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(17, 'കേന്ദ്ര വനം പരിസ്ഥിതി മന്ത്രാലയം നിലവിൽ വന്ന വർഷം ഏത്?', 1, 1, 1, 1, 1, NULL, '1983*1984*1985*1986', ' 1985', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(18, 'ഇന്ത്യയിൽ ആദ്യമായി എയിഡ്‌സ് രോഗം റിപ്പോർട്ട് ചെയ്ത നഗരം ഏത്?', 1, 1, 1, 1, 1, NULL, 'ചെന്നൈ*കൊൽക്കത്ത*മുബൈ*ന്യൂഡൽഹി', ' ചെന്നൈ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(19, 'ഇന്ത്യയിലെ ആദ്യത്തെ ടെസ്റ്റ് ട്യൂബ് ശിശു ആര്?', 1, 1, 1, 1, 1, NULL, 'സെയിൻ ഹോഷ്മി*സുഭാഷ്*ചേതൻ*ദുർഗ', ' ദുർഗ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(20, 'താഴെ പറയുന്നവയിൽ കമ്പ്യൂട്ടർ ഓപ്പറേറ്റിംഗ് സിസ്റ്റം അല്ലാത്തത് ഏത്?', 1, 1, 1, 1, 1, NULL, 'ആൻഡ്രോയ്ഡ്*ഉബുണ്ടു*ലിനക്‌സ്*വിൻഡോസ്', ' ആൻഡ്രോയ്ഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(21, 'എന്താണ് ഡാർട്ട് സിസ്റ്റം?', 1, 1, 1, 1, 1, NULL, ' സുനാമി മുന്നറിപ്പ് സംവിധാനം*ഭൂകമ്പ മുന്നറിയിപ്പ് സംവിധാനം*അഗ്നി പർവ്വത സ്‌ഫോടന മുന്നറിയിപ്പ് സംവിധാനം*ഇതൊന്നുമല്ല', ' സുനാമി മുന്നറിയിപ്പ് സംവിധാനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(22, 'ഇൻഡ്യയിലെ ആദ്യത്‌തെ ബയോസ്ഫിയർ റിസരവ് എേത്?', 1, 1, 1, 1, 1, NULL, 'നന്ദാദേവി*സുന്ദർബൻ*ഗൾഫ് ഓഫ് മന്നാർ*നീലഗിരി', 'നീലഗിരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(23, 'ഏറ്രവും വിസ്തീർണ്ണം കുറഞ്ഞ സ്‌കാൻഡിനേവിയൻ രാജ്യം ഏത് ?', 1, 1, 1, 1, 1, NULL, 'റുമോനിയ*സ്വീഡൻ*ഫിൻനാൽഡ്*ഡെൻമാർക്ക്', ' ഡെൻമാർക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(24, 'ആൽപ്‌സ് പർവ്വതത്തിന്റെ വടക്കേ ചരിവിലൂടെ വീശുന്ന ഉഷ്ണകാറ്റാണ് ?', 1, 1, 1, 1, 1, NULL, 'നോർവെസ്റ്റർ*ഫൊൻ*ശിലാവർ*ബോറ', ' ഫൊൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(25, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 1, 1, 1, 1, NULL, ' കാവേരി*പെരിയാര്‍*നിള*പമ്പ', 'കാവേരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(26, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 1, 1, 1, 1, NULL, ' സൃഷ്ടി*സ്ഥിതി*സമയം*സംഹാരം', 'സമയം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(27, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 1, 1, 1, 1, NULL, ' കവിത*പുസ്തകം*നോവല്‍*ലേഖനം', 'പുസ്തകം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(28, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 1, 1, 1, 1, NULL, ' ശ്രീനാഥ്*വഡേക്കര്‍*ഗവാസ്‌കര്‍*ഡാല്‍മിയ', 'ഡാല്‍മിയ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(29, 'പൂരിപ്പിക്കുക - കൊളംബോ:ശ്രീലങ്ക:: മനില :------', 1, 1, 1, 1, 1, NULL, 'ഇന്തോനേഷ്യ*തായ് വാന്‍*ഫിലിപ്പീന്‍സ്*മ്യാന്‍മാര്‍', 'ഫിലിപ്പീന്‍സ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(30, 'അര്‍ജുന:സ്‌പോര്‍ട്‌സ് : ഓസ്‌കാര്‍ :--------', 1, 1, 1, 1, 1, NULL, 'സാഹിത്യം*സിനിമ*നാടകം*സാമൂഹ്യപ്രവര്‍ത്തനം', 'സിനിമ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(31, 'റേസിങ്:റോഡ്  :  സ്‌കേറ്റിങ്:---------', 1, 1, 1, 1, 1, NULL, 'മരുഭൂമി*ഐസ്*വെള്ളം*ആകാശം', 'ഐസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(32, 'നെഫ്രോളജി:വൃക്ക  :  ഹെമറ്റോളജി:-------', 1, 1, 1, 1, 1, NULL, 'രക്തം*ഹൃദയം*മജ്ജ*ത്വക്ക്', 'രക്തം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(33, 'കോഡുപയോഗിച്ച് DUBAI യെ BSZYG എന്നെഴുതിയാല്‍ FARMER നെ എങ്ങനെ മാറ്റിയെഴുതും?', 1, 1, 1, 1, 1, NULL, 'ZGFPY*ZGFYP*ZGYFP*YGZFP', 'ZGFYP', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(34, 'കോഡുപയോഗിച്ച് PUNJABനെ OTMIZA എന്നെഴുതിയാല്‍ FARMERനെ എങ്ങനെ മാറ്റിയെഴുതും?', 1, 1, 1, 1, 1, NULL, 'EZQDLQ*EZQLDQ*EZDQLQ*EQZLDQ', 'EZQLDQ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(35, 'നിഘണ്ടുവിലെ ക്രമത്തില്‍ വരുന്ന നാലാമത്തെ വാക്ക് ഏത്?', 1, 1, 1, 1, 1, NULL, 'pours*porks*ports*posts', 'pours', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(36, 'താഴെ കൊടുത്തവയില്‍ ഒന്നൊഴിച്ച് ബാക്കി fratricides ന്റെ ആവര്‍ത്തനമാണ്. വാക്ക് കണ്ടുപിടിക്കുക?', 1, 1, 1, 1, 1, NULL, 'fratricides*fratricides*fratricides*fratricides*fratricidies', 'fratricidies', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(37, 'രാമു രാജുവിനേക്കാള്‍ വലുതും ബാബുവിനേക്കാള്‍ ചെറുതുമാണ്. ബാബു മനുവിനേക്കാള്‍ ചെറുതും. ആരാണ് ഏറ്റവും വലുത്?', 1, 1, 1, 1, 1, NULL, 'മനു*രാജു*രാമു*ബാബു', 'മനു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(38, '2;2;4;6;10;........', 1, 1, 1, 1, 1, NULL, '26*12*16*20', '16', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(39, 'D-3; F-4; H-6;J-9;.........', 1, 1, 1, 1, 1, NULL, 'K-13*K-11*L-11*L-13', 'L-13', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(40, '108ന്റെ 12.5% =----ന്റെ 50%', 1, 1, 1, 1, 1, NULL, '54*216*13.5*27', '27', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(41, '18 പേര്‍ 28 ദിവസം കൊണ്ട് ചെയ്തുതീര്‍ക്കുന്ന ജോലി 24 ദിവസംകൊണ്ട് ചെയ്തുതീര്‍ക്കാന്‍ എത്ര പേര്‍ വേണം?', 1, 1, 1, 1, 1, NULL, '22*20*24*21', '21', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(42, '4കുട്ടികള്‍ക്ക് ശരാശരി 7 വയസ്സ്. അഞ്ചാമത് ഒരു കൂട്ടികൂടി ചേര്‍ന്നാല്‍ ശരാശരി 6 വയസ്സ്. അഞ്ചാമന്റെ വയസ്സ് എത്ര?', 1, 1, 1, 1, 1, NULL, '2*4*3*5', '2', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(43, 'ഗായത്രീമന്ത്രം ഏതു വേദത്തിലാണ്?', 1, 1, 1, 1, 1, NULL, 'യജുര്‍വേദം*ഋഗ്വേദം*സാമവേദം*അഥര്‍വവേദം', 'ഋഗ്വേദം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(44, 'പോര്‍ച്ചുഗീസ് അധീനതയില്‍ നിന്നും ഗോവയെ വിമോചിപ്പിച്ച വര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1961*1963*1964*1965', '1961', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(45, 'അംബേദ്കറുടെ സമാധിസ്ഥലം ഏതുപേരിലറിയപ്പെടുന്നു?', 1, 1, 1, 1, 1, NULL, 'രാജ്ഘട്ട്*വിജയ്ഘട്ട്*വീര്‍ഭൂമി*ചൈത്രഭൂമി', 'ചൈത്രഭൂമി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(46, 'സിലിക്കണ്‍വാലി ഓഫ് ഇന്ത്യ എന്നറിയപ്പെടുന്ന പട്ടണം?', 1, 1, 1, 1, 1, NULL, 'ഡല്‍ഹി*ഹൈദരാബാദ്*ചെന്നൈ*ബാംഗ്ലൂര്‍', 'ബാംഗ്ലൂര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(47, 'ബന്ദിപ്പൂര്‍ നാഷണല്‍ പാര്‍ക്ക് ഏതു സംസ്ഥാനത്തിലാണ്?', 1, 1, 1, 1, 1, NULL, 'മധ്യപ്രദേശ്*ഗോവ*കര്‍ണാടകം*ആന്ധ്രാപ്രദേശ്', 'കര്‍ണാടകം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(48, 'ബംഗാള്‍ വിഭജനം റദ്ദുചെയ്ത ഇന്ത്യന്‍ വൈസ്രോയി ആരായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'ലിട്ടണ്‍പ്രഭു*ഹാര്‍ഡിഞ്ജ്പ്രഭു*റിപ്പണ്‍പ്രഭു*കഴ്‌സണ്‍പ്രഭു', 'ഹാര്‍ഡിഞ്ജ്പ്രഭു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(49, 'ഇന്ത്യയില്‍ തദ്ദേശസ്വയംഭരണത്തിന്റെ പിതാവ് എന്നറിയപ്പെടുന്ന വൈസ്രോയി ആര്?', 1, 1, 1, 1, 1, NULL, 'മായോപ്രഭു*ഡഫറിന്‍പ്രഭു*മിന്റോപ്രഭു*റിപ്പണ്‍പ്രഭു', 'റിപ്പണ്‍പ്രഭു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(50, 'ഇന്ത്യയില്‍ നിന്നും കൂടുതലായി ഇരുമ്പയിര് കയറ്റുമതി ചെയ്യുന്നതാര്?', 1, 1, 1, 1, 1, NULL, 'മര്‍മഗോവ*വിശാഖപട്ടണം*ഹാല്‍ഡിയ*ചെന്നൈ', 'മര്‍മഗോവ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(51, 'ഇന്ത്യന്‍ എക്‌സ്പ്രസിന്റെ എഡിറ്ററായിരുന്ന യൂണിയന്‍ മന്ത്രി ആര്?', 1, 1, 1, 1, 1, NULL, 'ജുവൈല്‍ഓറം*അര്‍ജുന്‍ സേഥി*റീത്താവര്‍മ*അരുണ്‍ഷൂരി', 'അരുണ്‍ഷൂരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(52, 'ഗുല്‍മാര്‍ഗ് സുഖവാസകേന്ദ്രം ഏത് ഇന്ത്യന്‍ സംസ്ഥാനത്താണ് സ്ഥിതിചെയ്യുന്നത്?', 1, 1, 1, 1, 1, NULL, 'ഉത്തരാഞ്ചല്‍*പശ്ചിമബംഗാള്‍*ജമ്മുകാശ്മീര്‍*ഹിമാചല്‍പ്രദേശ്', 'ജമ്മുകാശ്മീര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(53, 'ഇന്ത്യയിലെ ഏറ്റവും വലിയ തടാകം ഏത്?', 1, 1, 1, 1, 1, NULL, 'വൂളാര്‍*ചില്‍ക്ക*പുലിക്കാട്ട്*വേമ്പനാട്ട്', 'ചില്‍ക്ക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(54, 'പഹാരി ഭാഷ ഏതു സംസ്ഥാനത്താണ് സംസാരിക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'പഞ്ചാബ്*ഹിമാചല്‍പ്രദേശ്*ഹരിയാന*പശ്ചിമബംഗാള്‍', 'ഹിമാചല്‍പ്രദേശ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(55, '1773ല്‍ കല്‍ക്കത്തയില്‍ സുപ്രീംകോടതി സ്ഥാപിച്ച ഗവര്‍ണര്‍ ജനറല്‍ ആരായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'കോണ്‍വാലീസ്*വില്യംബെന്റിക്*വാറന്‍ഹേസ്റ്റിങ്‌സ്*വെല്ലസ്ലി', 'വാറന്‍ഹേസ്റ്റിങ്‌സ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(56, 'അഷ്ടപ്രധാന്‍ ഏതു ഭരണാധികാരിയുടെ മന്ത്രിസഭയായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'കൃഷ്ണദേവരായര്‍*ചന്ദ്രഗുപ്തവിക്രമാദിത്യന്‍*ഹര്‍ഷവര്‍ധനന്‍*ഛത്രപതിശിവജി', 'ഛത്രപതിശിവജി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(57, 'നളന്ദ സര്‍വകലാശാല സ്ഥാപിച്ച ഭരണാധികാരി ആരായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'കുമാരഗുപ്തന്‍*അശോകന്‍*ചന്ദ്രഗുപ്തന്‍1*ഹര്‍ഷവര്‍ധനന്‍', 'കുമാരഗുപ്തന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(58, 'ദക്ഷിണകൈലാസം എന്നറിയപ്പെടുന്ന ക്ഷേത്രമേത്?', 1, 1, 1, 1, 1, NULL, 'കൂടല്‍മാണിക്യക്ഷേത്രം*ശുചീന്ദ്രക്ഷേത്രം*വടക്കുംനാഥക്ഷേത്രം*ഏറ്റുമാനൂര്‍ക്ഷേത്രം', 'വടക്കുംനാഥക്ഷേത്രം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(59, 'ഐക്യരാഷ്ട്രസഭയുടെ സിവിലിയന്‍ പോലീസ് ഉപദേഷ്ടാവായി നിയമിക്കപ്പെട്ട ആദ്യത്തെ ഇന്ത്യന്‍ വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'ജൂലിയസ് റിബരിയോ*കിരണ്‍ബേദി*കെ.പി.എസ്.ഗില്‍*ജെ.എം.കുറേഷി', 'കിരണ്‍ബേദി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(60, 'ഗദ്ദാര്‍പാര്‍ട്ടിയുടെ സ്ഥാപകനേതാവ്?', 1, 1, 1, 1, 1, NULL, 'ശ്യാം ജി.കൃഷ്ണവര്‍മ*ഹര്‍ദയാല്‍*വി.ഡി.സവാര്‍ക്കര്‍*മാഡം കാമ', 'ഹര്‍ദയാല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(61, 'ഔദ്യോഗിക പദവിയിലിരിക്കെ വിദേശത്തുവച്ച് ദിവംഗതനായ ഇന്ത്യന്‍ പ്രധാനമന്ത്രി?', 1, 1, 1, 1, 1, NULL, 'ലാല്‍ബഹാദൂര്‍ശാസ്ത്രി*രാജീവ്ഗാന്ധി*ചരണ്‍സിംഗ്*മൊരാര്‍ജിദേശായി', 'ലാല്‍ബഹാദൂര്‍ശാസ്ത്രി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(62, 'മറാത്ത മാക്യവല്ലി എന്ന് വിശേഷിപ്പിക്കപ്പെട്ടിരുന്നത് ആരെ?', 1, 1, 1, 1, 1, NULL, 'പേഷ്വാ ബാജിറാവു*ബാലാജി വിശ്വനാഥ്*പേഷ്വാ രഘുനാഥറാവു*നാനാഫെഡ് നാവിസ്', 'ബാലാജി വിശ്വനാഥ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(63, 'സ്റ്റീല്‍ എന്ന ലോഹസങ്കരത്തില്‍ അടങ്ങിയത്?', 1, 1, 1, 1, 1, NULL, 'ചെമ്പ് ഈയം*ഇരുമ്പ് കാര്‍ബണ്‍*ചെമ്പ് ക്രോമിയം നിക്കല്‍*ഇരുമ്പ് ചെമ്പ്', 'ഇരുമ്പ് കാര്‍ബണ്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(64, 'ജലത്തിന്റെ pH മൂല്യം എത്ര?', 1, 1, 1, 1, 1, NULL, '7.4*4.7*7*8', '7', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(65, 'മണ്ണിനെക്കുറിച്ചുള്ള പഠനശാഖയാണ്?', 1, 1, 1, 1, 1, NULL, 'പെഡോളജി*എക്കോളജി*ഫാത്തോളജി*എന്റമോളജി', 'പെഡോളജി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(66, 'സില്‍വര്‍ റവല്യൂഷന്‍ ഏതുമായി ബന്ധപ്പെടുന്നു?', 1, 1, 1, 1, 1, NULL, 'ക്ഷീരോല്പാദനം*മുട്ട ഉല്പാദനം*മത്സ്യഉത്പാദനം*പച്ചക്കറി ഉല്പാദനം', 'മുട്ട ഉല്പാദനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(67, 'ദേശീയ മാതൃസുരക്ഷാദിനം എന്നാണ്?', 1, 1, 1, 1, 1, NULL, 'ജൂണ്‍5*ഡിസംബര്‍5*ഏപ്രില്‍1*ഏപ്രില്‍11', 'ഡിസംബര്‍5', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(68, 'ഇന്റര്‍നെറ്റിന്റെ പിതാവ് എന്നറിയപ്പെടുന്നത് ആര്?', 1, 1, 1, 1, 1, NULL, 'ചാള്‍സ്ബാബേജ്*ജെയിംസ്ഹാരിസണ്‍*വിന്റണ്‍സര്‍ഫ്*ജോണ്‍.എല്‍.ബേര്‍ഡ്', 'വിന്റണ്‍സര്‍ഫ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(69, 'ലോക ഭക്ഷ്യദിനം എന്ന്?', 1, 1, 1, 1, 1, NULL, 'ഒക്ടോബര്‍ 16*ഒക്ടോബര്‍24*ജനുവരി 16*ഡിസംബര്‍ 16', 'ഒക്ടോബര്‍16', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(70, 'കമ്പ്യൂട്ടറില്‍ വിവരങ്ങള്‍ ശേഖരിച്ച് വെക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'മെമ്മറി*സ്‌ക്രീന്‍*പ്രിന്റര്‍*മൗസ്', 'മെമ്മറി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(71, 'മണ്ണെണ്ണയില്‍ സൂക്ഷിക്കുന്ന ഒരു മൂലകം?', 1, 1, 1, 1, 1, NULL, 'ഫോസ്ഫറസ്*ഗാലിയം*ബേറിയം*സോഡിയം', 'സോഡിയം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(72, 'പ്രാണികളെപ്പറ്റി പഠിക്കുന്ന ശാസ്ത്രശാഖ ഏത്?', 1, 1, 1, 1, 1, NULL, 'എത്ത്‌നോളജി*എന്‍ഡോമോളജി*എത്തോളജി*എറ്റിമോളജി', 'എന്‍ഡോമോളജി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(73, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ഏറ്റവും പഴക്കം ചെന്ന ഇന്ത്യന്‍ സര്‍വകലാശാല?', 1, 1, 1, 1, 1, NULL, 'കേരള സര്‍വകലാശാല*ഡല്‍ഹി സര്‍വകലാശാല*മഹാത്മാഗാന്ധി സര്‍വകലാശാല*കല്‍ക്കത്താ സര്‍വകലാശാല', 'കല്‍ക്കത്താസര്‍വകലാശാല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(74, 'ടണല്‍ ഓഫ് ടൈം ആരുടെ ആത്മകഥയാണ്?', 1, 1, 1, 1, 1, NULL, 'ആശാപൂര്‍ണാദേവി*കെ.ആര്‍.നാരായണന്‍*ആര്‍.കെ.ലക്ഷ്മണ്‍*ആര്‍.കെ.നാരായണന്‍', 'ആര്‍.കെ.ലക്ഷ്മണ്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(75, 'ലോകാരോഗ്യസംഘടനയുടെ ആസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ജനീവ*പാരീസ്*ന്യൂയോര്‍ക്ക്*വാഷിങ്ടണ്‍', 'ജനീവ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(76, 'ഏറ്റവും ഒടുവില്‍ രൂപം കൊണ്ട ഇന്ത്യന്‍ സംസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ഗോവ*ജാര്‍ഖണ്ഡ്*ഉത്തരാഞ്ചല്‍*ഛത്തീസ്ഗഢ്', 'ജാര്‍ഖണ്ഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(77, 'പഞ്ചായത്ത് ഏത് രാജ്യത്തിന്റെ പാര്‍ലമെന്റാണ്?', 1, 1, 1, 1, 1, NULL, 'ഭൂട്ടാന്‍*ബര്‍മ*നേപ്പാള്‍*മലേഷ്യ', 'നേപ്പാള്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(78, 'മാല്‍ഗുഡി ഡെയ്‌സ് ഏത് പ്രശസ്ത സാഹിത്യകാരന്റെ കൃതിയാണ്?', 1, 1, 1, 1, 1, NULL, 'പ്രേംചന്ദ്*ആര്‍.കെ.നാരായണന്‍*ആര്‍.കെ.ലക്ഷ്മണന്‍*എസ്.കെ.പൊറ്റക്കാട്', 'ആര്‍.കെ.നാരായണന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(79, 'ഇന്ത്യയില്‍ ആദ്യമായി സ്വകാര്യവല്‍ക്കരിക്കപ്പെട്ട ഷിയോനാഘ് പുഴ ഏതു സംസ്ഥാനത്താണ്?', 1, 1, 1, 1, 1, NULL, 'ഛത്തീസ്ഗഢ്*ഉത്തരാഞ്ചല്‍*ഉത്തര്‍പ്രദേശ്*ജാര്‍ഖണ്ഡ്', 'ഛത്തീസ്ഗഢ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(80, 'ഏറ്റവും വലിയ ദേശീയഗാനം ഏത് രാജ്യത്തിന്റേതാണ്?', 1, 1, 1, 1, 1, NULL, 'അമേരിക്ക*ഇന്ത്യ*ഫ്രാന്‍സ്*ഗ്രീസ്', 'ഗ്രീസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(81, '2006ലെ ലോകകപ്പ് ഫുട്‌ബോള്‍ എവിടെവെച്ചു നടക്കും?', 1, 1, 1, 1, 1, NULL, 'യു.എസ്.എ.*ജര്‍മനി*ഫ്രാന്‍സ്*ഇറ്റലി', 'ജര്‍മനി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(82, 'ഹൃദയസ്മിതം ആരുടെ കൃതിയാണ്?', 1, 1, 1, 1, 1, NULL, 'ചങ്ങമ്പുഴ കൃഷ്ണപിള്ള*വൈലോപ്പിള്ളി*ഇടപ്പള്ളി രാഘവന്‍പിള്ള*സുഗതകുമാരി', 'ഇടപ്പള്ളി രാഘവന്‍പിള്ള', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(83, 'വാട്ടര്‍സ്‌കോട്ട് ഓഫ് കേരള എന്നറിയപ്പെടുന്നതാര്?', 1, 1, 1, 1, 1, NULL, 'സി.വി.രാമന്‍പിള്ള*എസ്.കെ.പൊറ്റക്കാട്*ചെമ്മനംചാക്കോ*സി.വി.ശ്രീരാമന്‍', 'സി.വി.രാമന്‍പിള്ള', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(84, 'കേരളത്തില്‍ ഏറ്റവും കൂടുതല്‍ മരച്ചീനി ഉല്പാദിപ്പിക്കുന്ന ജില്ല?', 1, 1, 1, 1, 1, NULL, 'കാസര്‍ഗോഡ്*തിരുവനന്തപുരം*ആലപ്പുഴ*പാലക്കാട്', 'തിരുവനന്തപുരം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(85, 'മാലി എന്ന തൂലികാനാമത്തില്‍ അറിയപ്പെടുന്നതാര്?', 1, 1, 1, 1, 1, NULL, 'മാധവന്‍ നായര്‍ വി.*രാമകൃഷ്ണന്‍*സച്ചിദാനന്ദന്‍*ശ്രീധരമേനോന്‍', 'മാധവന്‍നായര്‍ വി.', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(86, 'വാസ്‌കോഡിഗാമ കോഴിക്കോട് വന്നിറങ്ങിയ കപ്പലിന്റെ പേര്?', 1, 1, 1, 1, 1, NULL, 'സാന്റാമറിയ*പിന്റ്*സാന്‍ഗബ്രിയേല്‍*നീന', 'സാന്‍ഗബ്രിയേല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(87, 'കുന്നല കോനാതിരി എന്നറിയപ്പെട്ടിരുന്ന കേരളീയ രാജാവ്?', 1, 1, 1, 1, 1, NULL, 'കോലത്തിരി*കൊച്ചിരാജാവ്*വള്ളുവ കോനാതിരി*സാമൂതിരി', 'സാമൂതിരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(88, 'കേരളത്തില്‍ സര്‍ക്കസ് കലയുടെ പിതാവ് എന്നറിയപ്പെടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'കീലേരി കുഞ്ഞിക്കണ്ണന്‍*ഇട്ടി അച്ചുതന്‍*മാധവമേനോന്‍*പൂമുള്ളി നീലകണ്ഠന്‍', 'കീലേരി കുഞ്ഞിക്കണ്ണന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(89, 'ചവിട്ടുനാടകം ഏത് വിഭാഗം ജനങ്ങള്‍ക്കിടയില്‍ പ്രചാരത്തിലുണ്ടായിരുന്ന കലാരൂപമായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'ഹിന്ദുക്കള്‍*ക്രിസ്ത്യാനികള്‍*ജൂതന്മാര്‍*മുസ്ലീങ്ങള്‍', 'ക്രിസ്ത്യാനികള്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(90, '1809ല്‍ കുണ്ടറ വിളംബരം പുറപ്പെടുവിച്ചതാര്?', 1, 1, 1, 1, 1, NULL, 'മാര്‍ത്താണ്ഡവര്‍മ*പാലിയത്തച്ചന്‍*വേലുത്തമ്പിദളവ*ധര്‍മരാജാവ്', 'വേലുത്തമ്പിദളവ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(91, 'ലോകപ്രശസ്ത ശാസ്ത്രജ്ഞനായ ഡോ.എം.എസ്.സ്വാമിനാഥന്റെ ജന്മസ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'മണ്ണുത്തി*ഒറ്റപ്പാലം*മാങ്കൊമ്പ്*വര്‍ക്കല', 'മാങ്കൊമ്പ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(92, 'വിലാസിനി എന്നത് ആരുടെ തൂലികാനാമമാണ്?', 1, 1, 1, 1, 1, NULL, 'എം.ആര്‍.നായര്‍*പി.വി.അയ്യപ്പന്‍*പി.എസ്.കുട്ടികൃഷ്ണന്‍*എം.കെ.മേനോന്‍', 'എം.കെ.മേനോന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(93, 'This is the matter --------I am proud.', 1, 1, 1, 1, 1, NULL, 'which*that*who*of which', 'of which', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(94, 'I found your diary after you ------- the house.', 1, 1, 1, 1, 1, NULL, 'left*had left*were leaving*would leave', 'had left', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(95, 'Sydney Cartoon proposed to Lucio but she ------- the offer of marriage.', 1, 1, 1, 1, 1, NULL, 'turned down*turned off*turned on*turned out', 'turned down', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(96, 'He is married-----------', 1, 1, 1, 1, 1, NULL, 'with my sister*my sister*to my sister*none of the above', 'to my sister', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(97, 'The moon as well as the stars........', 1, 1, 1, 1, 1, NULL, 'give lifht at night*do give light at night*gave light at night*gives light at night', 'gives light at night', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(98, 'If he had applied for the post...........', 1, 1, 1, 1, 1, NULL, 'he get it*he will get it*he will have got it*he would have got it', 'he would have got it', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(99, 'The opposite of the world ACQUITTED is ...................', 1, 1, 1, 1, 1, NULL, 'entrusted*convicted*freed*burned', 'convicted', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(100, 'The opposite of the world SYNTHETIC is..........', 1, 1, 1, 1, 1, NULL, 'natural*affable*plastic*cosmetic', 'natural', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(101, 'Two men and a women were killed in a ............... between a car and a jeep.', 1, 1, 1, 1, 1, NULL, 'strike*thrust*collision*collusion', 'collision', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(102, 'Choose the apt word showing the meaning of the capitalised word in the sentence. Ernakulam is a very POPULOUS city in Kerala.', 1, 1, 1, 1, 1, NULL, 'luxurious*liked by the people*highly fashionable*thickly inhabited', 'thickly inhabited', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(103, 'The book you rae looking........ is here.', 1, 1, 1, 1, 1, NULL, 'for*at*out*about', 'for', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(104, 'Her spectacles would not rest on the .................. of her nose.', 1, 1, 1, 1, 1, NULL, 'bridge*tip*top*arch', 'bridge', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(105, 'The government aims .................... rehabilitating the affected victims in the calamity.', 1, 1, 1, 1, 1, NULL, 'to*for*about*at', 'at', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(106, 'Bosewell''s Life of Johnson is considered to be the greatest ................ ever written.', 1, 1, 1, 1, 1, NULL, 'novel*biography*autobiography*fiction', 'biography', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(107, 'I saw him in Madras two months...............', 1, 1, 1, 1, 1, NULL, 'before*since*ago*for', 'ago', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(108, 'Hardly had he reached the station.............. the train arrived.', 1, 1, 1, 1, 1, NULL, 'than*until*when*as', 'when', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(109, 'The meaning of fascimile:', 1, 1, 1, 1, 1, NULL, 'model*nostrum*exact copy*fake', 'exact copy', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(110, 'Judicious means:', 1, 1, 1, 1, 1, NULL, 'wise*diplimatic*watchful*legal', 'wise', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(111, 'The murder of an important person for political reasons:', 1, 1, 1, 1, 1, NULL, 'regicide*homicide*patricide*assassination', 'assassination', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(112, 'Find out the wrongly spelt word:', 1, 1, 1, 1, 1, NULL, 'bulldozer*brochure*privilage*separate', 'privilage', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(113, 'ശരിയായ പദം തിരഞ്ഞെടുത്തെഴുതുക:', 1, 1, 1, 1, 1, NULL, 'അഥിതി*അതിധി*അതിഥി*അധിദി', 'അതിഥി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(114, '2001ലെ വയലാര്‍ പുരസ്‌കാരം ലഭിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'എം.വി.ദേവന്‍*ടി.പത്മനാഭന്‍*സുകുമാര്‍ അഴീക്കോട്*ഒ.എന്‍.വി.കുറുപ്പ്', 'ടി.പത്മനാഭന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(115, 'ആഷാമേനോന്‍ എന്ന തൂലികാമത്തിനുടമ?', 1, 1, 1, 1, 1, NULL, 'കെ.ശ്രീകുമാര്‍*എന്‍.നാരായണപ്പിള്ള*അയ്യപ്പന്‍പിള്ള*പി.സച്ചിദാനന്ദന്‍', 'കെ.ശ്രീകുമാര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(116, 'ശരിയായ വാചകം ഏത്?', 1, 1, 1, 1, 1, NULL, 'ബസ്സില്‍ പുകവലിക്കുകയോ കൈയും തലയും പുറത്തിടുകയും ചെയ്യരുത്*ബസ്സില്‍ പുകവലിക്കുകയും കൈയും തലയും പുറത്തിടുകയോ ചെയ്യരുത്*ബസ്സില്‍ പുകവലിക്കുകയോ കൈയോ തലയോ പുറത്തിടുകയും ചെയ്യരുത്*ബസ്സില്‍ പുകവലിക്കുകയും കൈയും തലയും പുറത്തിടുകയും ചെയ്യരുത്', 'ബസ്സില്‍ പുകവലിക്കുകയും കൈയും തലയും പുറത്തിടുകയും ചെയ്യരുത്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(117, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ആഗമസന്ധിയല്ലാത്തത്?', 1, 1, 1, 1, 1, NULL, 'പുളിങ്കുരു*പൂത്തട്ടം*പൂവമ്പ്*കരിമ്പുലി', 'പൂത്തട്ടം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(118, 'താഴെ പറയുന്നവയില്‍ സകര്‍മകക്രിയ അല്ലാത്തത്?', 1, 1, 1, 1, 1, NULL, 'ഉണ്ണുക*കുടിക്കുക*കുളിക്കുക*അടിക്കുക', 'കുളിക്കുക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(119, 'താഴെ കൊടുത്തിരിക്കുന്ന വാക്കുകളില്‍ കൃത്തിന് ഉദാഹരണം?', 1, 1, 1, 1, 1, NULL, 'ബുദ്ധിമാന്‍*മൃദുത്വം*വൈയാകരണന്‍*ദര്‍ശനം', 'ദര്‍ശനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(120, 'ശരിയായ തര്‍ജമ എഴുതുക. World is under the fear of nuclear weapon.', 1, 1, 1, 1, 1, NULL, 'ലോകം ആണവായുധ ഭീഷണിയില്‍ ഞെരുങ്ങുന്നു*ലോകം ആണവായുധത്തിന്റെ ഭീതിയിലാണ്*ലോകം ആണവായുധത്തിന്റെ പിടിയിലമരുന്നു*ലോകം ആണവായുധത്തെ നോക്കി വിറകൊള്ളുന്നു', 'ലോകം ആണവായുധത്തിന്റെ ഭീതിയിലാണ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(121, 'ശരിയായ തര്‍ജമ എഴുതുക: Barking dogs seldom bites.', 1, 1, 1, 1, 1, NULL, 'കുരയ്ക്കുന്ന പട്ടി കടിക്കാറില്ല*പട്ടി കുരച്ചിട്ടേ കടിക്കാറുള്ളൂ*കുരയ്ക്കുന്ന പട്ടി അപൂര്‍വമായേ കടിക്കാറുള്ളൂ*പട്ടി കുരച്ചുകൊണ്ട് കടിക്കാറുണ്ട്', 'കുരയ്ക്കുന്ന പട്ടി കടിക്കാറില്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(122, 'ശരിയായ തര്‍ജമ എഴുതുക: You had better consult a doctor', 1, 1, 1, 1, 1, NULL, 'ഡോക്ടറെ കാണുന്നതാണ് കൂടുതല്‍ അഭികാമ്യം*ഡോക്ടറെ കാണുന്നത് ഗുണപ്രദമാണ്*ഡോക്ടറെ കണ്ടാല്‍ സ്ഥിതിമാറും*ഡോക്ടറെ കണ്ടാല്‍ അസുഖം ഭേദമാകും', 'ഡോക്ടറെ കാണുന്നതാണ് കൂടുതല്‍ അഭികാമ്യം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(123, 'ഒരു കന്നുകാലിച്ചന്തയില്‍ കന്നുകാലികളും വില്പനക്കാരായി എത്തിയവരും ഉണ്ട്. ചന്തയില്‍ ആകെ 128 തലകളും 420 കാലുകളും ഒരാള്‍ എണ്ണിത്തിട്ടപ്പെടുത്തിയെങ്കില്‍ അവിടെ എത്ര പശുക്കള്‍ എത്ര മനുഷ്യര്‍?', 1, 1, 1, 1, 1, NULL, '81-47*80-48*90-38*82-46', '82-46', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(124, 'വ്യത്യസ്ത നിറങ്ങളിലുള്ള മൂന്ന് പാവാട; നാല് ബ്ലൗസ്; മൂന്ന് ദാവണി എന്നിവ ഒരു ജൗളിക്കടയില്‍ നിന്നും വാങ്ങി. പച്ച നിറത്തിലുള്ള പാവാടയും അതേ നിറത്തിലുള്ള ബ്ലൗസും മാത്രം തീരെ ചേര്‍ച്ചയില്ലാത്തതുകൊണ്ട് അവള്‍ക്ക് ഉപയോഗിക്കാന്‍ കഴിഞ്ഞില്ല. ആകെ എത്രതരത്തില്‍ ഇവ ഉപയോഗിച്ച് അവള്‍ക്ക് അണിയാം?', 1, 1, 1, 1, 1, NULL, '36*34*33*35', '33', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(125, 'ഒരു 100 മീറ്റര്‍ ഓട്ടമത്സരത്തില്‍ രാമന്‍ 100 മീറ്റര്‍ പിന്നിട്ടപ്പോള്‍ കൃഷ്ണന് 90 മീറ്റര്‍ പിന്നിടാനേ കഴിഞ്ഞുള്ളൂ. രണ്ടാമതൊരു 100 മീറ്റര്‍ മത്സരത്തില്‍ രാമന്‍ കൃഷ്ണനേക്കാള്‍ 100 മീറ്റര്‍ പിന്നില്‍ നിന്നും തുടങ്ങി. ഈ മത്സരത്തില്‍ ആര് ജയിക്കും?', 1, 1, 1, 1, 1, NULL, 'രാമന്‍*കൃഷ്ണന്‍*രണ്ടുപേരും ഒരുമിച്ച്*രണ്ടുപേരും ജയിക്കില്ല', 'രാമന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(126, 'ആയിഷയുടെ വയസ്സ് രാജന്റെ വയസ്സിന്റെ മൂന്നിരട്ടിയാണ്. എന്നാല്‍ രാജന്റെ വയസ്സ് ദിലീപിന്റെ വയസ്സിന്റെ എട്ട് ഇരട്ടിയോട് 2 ചേര്‍ത്താല്‍ ലഭിക്കും. ദിലീപിന്റെ വയസ്സ് 2 ആണെങ്കില്‍ ആയിഷയുടെ വയസ്സെത്ര?', 1, 1, 1, 1, 1, NULL, '50*54*48*46', '52', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(127, 'രണ്ടു സംഖ്യകളുടെ തുക 10. അവയുടെ ഗുണനഫലം 20. എങ്കില്‍ സംഖ്യകളുടെ വ്യൂല്‍ക്രമങ്ങളുടെ (Reciprocals) തുക കാണുക.?', 1, 1, 1, 1, 1, NULL, '2*1/3*3*1/2', '1/2', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(128, 'നിശ്ചിത ചുറ്റളവുള്ള ചതുരങ്ങളില്‍ ഏറ്റവും കൂടുതല്‍ വിസ്തീര്‍ണം ഏതിനാണ്?', 1, 1, 1, 1, 1, NULL, 'ദീര്‍ഘചതുരം*ലംബകം*സമചതുരം*സമപാര്‍ശ്വലംബകം', 'സമചതുരം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(129, 'താഴെ കൊടുത്തിരിക്കുന്ന സംഖ്യാശ്രേണിയിലെ അടുത്തസംഖ്യ ഏത്?', 1, 1, 1, 1, 1, NULL, '1;8;27;------;64*47*62*57', '64', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(130, '583 എന്ന സംഖ്യയെ 293 ആയി ബന്ധപ്പെടുത്താമെങ്കില്‍ 488നെ ഏതിനോട് ചേര്‍ക്കാം?', 1, 1, 1, 1, 1, NULL, '581*487*291*388', '388', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(131, 'ഒരു സംഖ്യയുടെ 30%=5 എങ്കില്‍ സംഖ്യയേത്?', 1, 1, 1, 1, 1, NULL, '16*16.67*16.69*15.42', '16.67', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(132, 'ഒരാള്‍ വടക്കുദിശയിലേക്ക് 2കി.മീ. നടന്നതിനുശേഷം വലതുവശം തിരിഞ്ഞ് 2 കിമീഉം വീണ്ടും വലതുവശം തിരിഞ്ഞ് 3 കി.മീ.യും നടക്കുന്നുവെങ്കില്‍ അദ്ദേഹത്തിന്റെ ഇപ്പോഴത്തെ ദിശ ഏത്?', 1, 1, 1, 1, 1, NULL, 'വടക്ക്*തെക്ക്*കിഴക്ക്*പടിഞ്ഞാറ്', 'തെക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(133, 'പൂരിപ്പിച്ച് എഴുതുക: BDAC: FHEG: : NPMO:?', 1, 1, 1, 1, 1, NULL, 'QTRS*RQTS*TRQS*RTQS', 'RTQS', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(134, 'ഒരു സ്ഥാപനത്തിലെ 20% ജീവനക്കാര്‍ 2 കാര്‍ മാത്രം ഉള്ളവരാണ്. ബാക്കിയുള്ളവരുടെ 40% ത്തിന് 3 കാര്‍ ഉണ്ട്. ശേഷിക്കുന്ന ജീവനക്കാര്‍ ഒരു കാര്‍ മാത്രം ഉള്ളവരും ആണ്. എങ്കില്‍ താഴെപറയുന്ന പ്രസ്താവനകളില്‍ ഏറ്റവും ഉചിതമായത് ഏത്?', 1, 1, 1, 1, 1, NULL, 'ആകെ ജീവനക്കാരുടെ 20%ന് മാത്രം 3 കാറുകള്‍ ഉണ്ട്*ആകെ ജീവനക്കാരുടെ 48%മാത്രം ഒരു കാറിന്റെ ഉടമകളാണ്*ആകെ ജീവനക്കാരുടെ 60% ന് 2 കാറെങ്കിലും ഉണ്ട്*മുകളില്‍ പറഞ്ഞവയൊന്നും ശരിയല്ല', 'ആകെ ജീവനക്കാരുടെ 48% മാത്രം ഒരു കാറിന്റെ ഉടമകളാണ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(135, '1984 വര്‍ഷത്തില്‍ ജനുവരി ഫെബ്രുവരി മാര്‍ച്ച് എന്നീ മാസങ്ങളിലെ ആകെ ദിവസങ്ങള്‍ എത്ര?', 1, 1, 1, 1, 1, NULL, '90*93*92*91', '91', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(136, 'രണ്ടു സംഖ്യകളുടെ വ്യത്യാസം തുക ഗുണനഫലം എന്നിവയുടെ അംശബന്ധം (Ratio) 1:7:24 ആണെങ്കില്‍ സംഖ്യകളുടെ ഗുണനഫലം എന്ത്?', 1, 1, 1, 1, 1, NULL, '6*12*48*24', '48', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL);
INSERT INTO `questions` (`id`, `question`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answers`, `answer_keys`, `question_import_id`, `option_images`, `question_status_id`, `organization_id`, `question_type_id`, `share`, `question_group_id`, `import_slno`) VALUES
(137, 'ഒരു ക്ലോക്കിലെ സമയം 4 മണിയാണ് ഒരു കണ്ണാടിയില്‍ അതിന്റെ പ്രതിബിംബം കാണിക്കുന്ന സമയം ഏത്?', 1, 1, 1, 1, 1, NULL, '7 മണി*4മണി*8മണി*10മണി', '8മണി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(138, 'ഇപ്പോള്‍ കൃഷ്ണന് 4 വയസ്സും മിനിക്ക് 6 വയസ്സും ഉണ്ട്. ഇരുവരുടേയും വയസ്സിന്റെ തുക 24 ആകുവാന്‍ അവര്‍ എത്രവര്‍ഷം കാത്തിരിക്കണം?', 1, 1, 1, 1, 1, NULL, '7*10*6*5', '7', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(139, 'REGULATION എന്ന വാക്ക് 1 2 3 4 5 6 7 8 9 10 എന്ന കോഡ് ഉപയോഗിച്ച് എഴുതാമെങ്കില്‍ RULE എന്ന വാക്ക് എങ്ങിനെ എഴുതാം?', 1, 1, 1, 1, 1, NULL, '1452*5142*4254*4251', '1452', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(140, 'താഴെപ്പറയുന്ന സംഖ്യകളുടെ കൂട്ടത്തില്‍ ചേരാത്തത് ഏത്?   24;27;31;33;36', 1, 1, 1, 1, 1, NULL, '24*33*31*36', '31', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(141, 'താഴെ കൊടുത്തിട്ടുള്ള സംഖ്യകളുടെ തുക കാണുക?21.7;13.21;15.721;3.815;9.813;0.184;0.126;0.091', 1, 1, 1, 1, 1, NULL, '65.58*64.66*65.38*65.28', '64.66', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(142, 'നോബല്‍ സമ്മാന ജേതാവായ റഷ്യന്‍ കവി?', 1, 1, 1, 1, 1, NULL, 'റെനേ കാസ്റ്റലോവ്*ചെക്കോവ്*അലക്‌സാണ്ടര്‍ പുഷ്‌കിന്‍*ജോസഫ് ബ്രോഡ്‌സ്‌കി', 'ജോസഫ് ബ്രോഡ്‌സ്‌കി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(143, 'ഏതു യൂണിവേഴ്‌സിറ്റിയിലാണ് കൃത്രിമ പോളിയോ വൈറസ് ആദ്യമായി സംയോജിപ്പിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'ന്യൂയോര്‍ക്ക്*ജോണ്‍ ഹോപ്കിന്‍സ്*ഓക്‌സ്‌ഫോര്‍ഡ്*കേംബ്രിഡ്ജ്', 'ന്യൂയോര്‍ക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(144, 'നോബല്‍ സമ്മാന ജേതാവായ അമര്‍ത്യാസെന്നിന്റെ ചിന്തകളെ സ്വാധീനിച്ച സംഭവം?', 1, 1, 1, 1, 1, NULL, 'മീററ്റ് കലാപം*ബംഗാള്‍ ക്ഷാമം*ഇന്ത്യാ-പാക്ക് വിഭജനം*ഇവയൊന്നുമല്ല', 'ബംഗാള്‍ക്ഷാമം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(145, 'താഴെ പറയുന്നവയില്‍ ചാര്‍ളി ചാപ്ലിന്‍ ചിത്രമല്ലാത്തത്?', 1, 1, 1, 1, 1, NULL, 'ദി കിഡ്*മോഡേണ്‍ ടൈംസ്*ബ്ലാക്‌മെയില്‍*ദി സര്‍ക്കസ്', 'ബ്ലാക്ക്‌മെയില്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(146, 'സത്യജിത്‌റായിയുടെ പഥേര്‍ പാഞ്ചാലിയിലെ മുഖ്യവിഷയം?', 1, 1, 1, 1, 1, NULL, 'വര്‍ഗീയത*അധിനിവേശം*ദാരിദ്ര്യം*സ്വവര്‍ഗരതി', 'ദാരിദ്ര്യം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(147, 'മലയാളത്തിലെ ആദ്യ ശബ്ദചലച്ചിത്രം?', 1, 1, 1, 1, 1, NULL, 'വിഗതകുമാരന്‍*കുമ്മാട്ടി*ബാലന്‍*ഇവയൊന്നുമല്ല', 'ബാലന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(148, 'അഖിലേന്ത്യാ ട്രേഡ് യൂണിയന്‍ കോണ്‍ഗ്രസ്സിന്റെ ആദ്യസമ്മേളനം നടന്നത് എവിടെവെച്ചാണ്?', 1, 1, 1, 1, 1, NULL, 'കല്‍ക്കട്ട*മദ്രാസ്*ബോംബെ*അഹമ്മദാബാദ്', 'ബോംബെ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(149, 'ലബനന്റെ തലസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'നെയ്‌റോബി*ബെയ്‌റൂട്ട്*വിക്ടോറിയ*കെയ്‌റോ', 'ബെയ്‌റൂട്ട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(150, 'ഈശ്വരന്‍ ഹിന്ദുവല്ല; ഇസ്ലാമല്ല; ക്രിസ്ത്യാനിയല്ല ഇന്ദ്രനും ചന്ദ്രനുമല്ല.... എന്നു തുടങ്ങുന്ന പ്രസിദ്ധമായ ഗാനത്തിന്റെ രചയിതാവ്?', 1, 1, 1, 1, 1, NULL, 'പി.ഭാസ്‌കരന്‍*ബിച്ചുതിരുമല*ഒ.എന്‍.വി.*വയലാര്‍', 'വയലാര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(151, 'ഇന്ത്യയുടെ ഔഷധ വ്യവസായരംഗത്ത് കുതിച്ചുചാട്ടം ഉണ്ടാക്കിയ നിയമം?', 1, 1, 1, 1, 1, NULL, 'ഡി.പി.സി.ഒ.*പേറ്റന്റ് ആക്ട്*ഡി.ഒ.സി.എസ്സ്*ഇവയൊന്നുമല്ല', 'പേറ്റന്റ്ആക്ട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(152, 'അന്തകന്‍ വിത്തിന്റെ പ്രാധാന്യം?', 1, 1, 1, 1, 1, NULL, 'പ്രത്യുല്പാദനശേഷിയില്ല*വളത്തിന്റെ ആവശ്യമില്ല*കളകളെ നശിപ്പിക്കുന്നു*ഇവയൊന്നുമല്ല', 'പ്രത്യുല്പാദനശേഷിയില്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(153, 'ബസുമതിക്കുമേല്‍ പേറ്റന്റ് നേടിയ ബഹുരാഷ്ട്രകമ്പനി:', 1, 1, 1, 1, 1, NULL, 'ഡെല്‍റ്റ ആന്റ് പൈന്‍ലാന്റ്*ഡ്യൂപോണ്ട്*മോണ്‍സാന്റോ*ഇവയൊന്നുമല്ല', 'ഇവയൊന്നുമല്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(154, 'സിക്കിമിന്റെ തലസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ഗാങ്‌ടോക്ക്*സിംല*കൊഹിമ*ഇവയൊന്നുമല്ല', 'ഗാങ്‌ടോക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(155, 'സത്യാഗ്രഹം ബലവാന്മാരുടെ ഉപകരണമാണ് - ഇതുപറഞ്ഞതാര്?', 1, 1, 1, 1, 1, NULL, 'ജവഹര്‍ലാല്‍നെഹ്രു*ഇ.എം.എസ്*വിനോബാഭാവെ*മഹാത്മാഗാന്ധി', 'മഹാത്മാഗാന്ധി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(156, 'മീററ്റ് കലാപത്തില്‍ മരണശിക്ഷയ്ക്ക് വിധിക്കപ്പെട്ടതാര്?', 1, 1, 1, 1, 1, NULL, 'മുസാഫിര്‍ അഹമ്മദ്*അജയ്‌ഘോഷ്*ബാലഗംഗാധര തിലകന്‍*ഇവരൊന്നുമല്ല', 'ഇവരൊന്നുമല്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(157, 'മാപ്പിള ലഹളയുടെ താല്‍ക്കാലിക വിജയത്തിനുശേഷം ഭരണാധിപനായി അവരോധിക്കപ്പെട്ടതാര്?', 1, 1, 1, 1, 1, NULL, 'മുഹമ്മദാലിജിന്ന*അലി മുസലിയാര്‍*എ.എ.റഹിം*ഇവരാരുമല്ല', 'അലിമുസലിയാര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(158, 'റൗലറ്റ് ആക്ട് പാസാക്കിയ വര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1907*1917*1919*1921', '1919', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(159, 'കോണ്‍ഗ്രസ്സിലെ മിതവാദികളുടെ നേതാവ് (1905-1908)?', 1, 1, 1, 1, 1, NULL, 'ഗോപാലകൃഷ്ണഗോഖലെ*ബാലഗംഗാധരതിലകന്‍*ആഗാഖാന്‍*മുഹമ്മദാലിജിന്ന', 'ഗോപാലകൃഷ്ണഗോഖലെ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(160, 'ചാര്‍വാക മതത്തിന്റെ ഉപജ്ഞാതാവ്?', 1, 1, 1, 1, 1, NULL, 'അശോകന്‍*കപിലന്‍*ചാണക്യന്‍*ബൃഹസ്പതി', 'ബൃഹസ്പതി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(161, 'എവറസ്റ്റ് സ്ഥിതിചെയ്യുന്ന രാജ്യം?', 1, 1, 1, 1, 1, NULL, 'നേപ്പാള്‍*സിക്കിം*ഭൂട്ടാന്‍*ഇന്ത്യ', 'നേപ്പാള്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(162, 'പഞ്ചശീലതത്വത്തില്‍ നെഹ്രുവിനോടൊപ്പം ഒപ്പുവെച്ച ചൈനീസ് നേതാവ്?', 1, 1, 1, 1, 1, NULL, 'ലീപെങ്*ജിയാങ് സെമിന്‍*ചൗ എന്‍ലായ്*മാവോ സേതുങ്', 'ചൗഎന്‍ലായ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(163, 'സോഷ്യലിസത്തിലധിഷ്ഠിതമായ സാമൂഹ്യവ്യവസ്ഥിതി അംഗീകരിച്ച ആവടി കോണ്‍ഗ്രസ് സമ്മേളനം നടന്ന വര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1955*1956*1957*1958', '1955', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(164, 'ക്ഷേമരാഷ്ട്ര സങ്കല്പം ഉപേക്ഷിച്ച് സ്വകാര്യവല്‍ക്കരണത്തിന് തുടക്കമിട്ട ബ്രിട്ടീഷ് പ്രധാനമന്ത്രി?', 1, 1, 1, 1, 1, NULL, 'ജോണ്‍മേജര്‍*മാര്‍ഗരറ്റ്താച്ചര്‍*ടോണി ബ്ലെയര്‍*വിന്‍സ്റ്റണ്‍ ചര്‍ച്ചില്‍', 'മാര്‍ഗരറ്റ് താച്ചര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(165, 'ഗാന്ധിജിയുടെ വധത്തോടുകൂടി നിരോധിക്കപ്പെട്ട സംഘടന ഏത്?', 1, 1, 1, 1, 1, NULL, 'ജമാഅത്തെ ഇസ്ലാമി*ശിവസേന*ഇന്ത്യന്‍ കമ്യൂണിസ്റ്റ്പാര്‍ട്ടി*ആര്‍.എസ്.എസ്.', 'ആര്‍.എസ്.എസ്.', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(166, 'ഗുരുവായൂര്‍ സത്യാഗ്രഹത്തിന്റെ വോളണ്ടിയര്‍ ക്യാപ്റ്റന്‍?', 1, 1, 1, 1, 1, NULL, 'കെ.കേളപ്പന്‍*എ.കെ.ഗോപാലന്‍*പി.കൃഷ്ണപിള്ള*ടി.കെ.മാധവന്‍', 'എ.കെ.ഗോപാലന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(167, 'ജീവിതാന്ത്യത്തില്‍ ശ്രീനാരായണഗുരു ധരിച്ചിരുന്ന വസ്ത്രം?', 1, 1, 1, 1, 1, NULL, 'മഞ്ഞവസ്ത്രം*മേല്‍മുണ്ടുംഷാളും*ഖദര്‍വസ്ത്രം*ഇവയൊന്നുമല്ല', 'ഇവയൊന്നുമല്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(168, 'കോണ്‍ഗ്രസ് അധ്യക്ഷ സ്ഥാനത്തേക്ക് ആദ്യമായി മത്സരം നടന്നത് ഏതു സമ്മേളനത്തിലാണ്?', 1, 1, 1, 1, 1, NULL, '51-ാംസമ്മേളനം*52-ാംസമ്മേളനം*53-ാംസമ്മേളനം*54-ാംസമ്മേളനം', '54-ാംസമ്മേളനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(169, 'താഴെപ്പറയുന്നവയില്‍ വിക്രം സേത്തിന്റെ കൃതി ഏത്?', 1, 1, 1, 1, 1, NULL, 'മിഡ്‌നൈറ്റ്‌സ് ചില്‍ഡ്രന്‍*ഗോഡ് ഓഫ് സ്‌മോള്‍ തിങ്‌സ്*ദി ഇന്റര്‍പ്രട്ടേഷന്‍ ഓഫ്ഡ്രീംസ്*എ സ്യൂട്ടബിള്‍ ബോയ്', 'എ സ്യൂട്ടബിള്‍ ബോയ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(170, 'ഭൂദാനയജ്ഞം തുടങ്ങിയ വര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1950*1951*1952*1953', '1951', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(171, 'എക്‌സ്‌റേയ്‌സ് കണ്ടുപിടിച്ചതാര്?', 1, 1, 1, 1, 1, NULL, 'റോണ്‍ജന്‍*റുഥര്‍ഫോര്‍ഡ്*മാഡംക്യൂറി - പിയറിക്യൂറി*ചാഡ്വിക്', 'റോണ്‍ജന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(172, 'സൈബര്‍ സ്‌പേസ് എന്ന പേര് ആദ്യമായി ഉപയോഗിച്ച വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'വില്യം ഗിബ്‌സണ്‍*ടോംലിന്‍സണ്‍*സ്‌പെന്‍സര്‍*ഇവരാരുമല്ല', 'വില്യംഗിബ്‌സണ്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(173, 'കിഴക്കിന്റെ വെനീസ് എന്ന്‌റിയപ്പെടുന്ന പട്ടണം?', 1, 1, 1, 1, 1, NULL, 'കൊച്ചി*കുലശേഖരപുരം*തിരൂര്‍*ആലപ്പുഴ', 'ആലപ്പുഴ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(174, 'ഭക്ഷ്യയോഗ്യമായ കൂണ്‍ ഏത്?', 1, 1, 1, 1, 1, NULL, 'അഗാരിക്കസ്*അമാനിറ്റ*റസൂല*ഗണ്‍ഫഌന്റ്', 'അഗാരിക്കസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(175, 'രണ്ടാം ലോകമഹായുദ്ധത്തിന്റെ തുടക്കത്തില്‍ ഏതു രാജ്യത്തെയാണ് ഹിറ്റ്‌ലര്‍ ആദ്യം ആക്രമിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'അമേരിക്ക*പോളണ്ട്*റഷ്യ*ബ്രിട്ടണ്‍', 'പോളണ്ട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(176, 'ഏറ്റവും തണുപ്പേറിയ സ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'അറ്റക്കാമ*ലാസ*വോസ്‌റ്റോക്ക്*ലാപസ്', 'വോസ്‌റ്റോക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(177, 'താഴെപറയുന്നവരില്‍ ജ്ഞാനപീഠ പുരസ്‌കാരം ലഭിച്ചിട്ടില്ലാത്ത വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'തകഴി ശിവശങ്കരപ്പിള്ള*വൈക്കം മുഹമ്മദ്ബഷീര്‍*എം.ടി.വാസുദേവന്‍ നായര്‍*എസ്.കെ.പൊറ്റക്കാട്', 'വൈക്കം മുഹമ്മദ്ബഷീര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(178, 'ഇന്‍സുലിന്‍ ഉല്പാദിപ്പിക്കുന്ന ഗ്രന്ഥി?', 1, 1, 1, 1, 1, NULL, 'കരള്‍*തൈറോയ്ഡ്*പാന്‍ക്രിയാസ്*ഉമിനീര്‍ഗ്രന്ഥി', 'പാന്‍ക്രിയാസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(179, 'സീസ്‌മോഗ്രാഫിന്റെ ഉപയോഗമെന്ത്?', 1, 1, 1, 1, 1, NULL, 'ജനസംഖ്യ വളര്‍ച്ചാനിരക്ക് അറിയാന്‍*ഭാരം അളക്കുന്നതിന്*അഗ്നിപര്‍വതസ്‌ഫോടനം മുന്‍കൂട്ടി അറിയുന്നതിന്*ഭൂചലനങ്ങള്‍ നിരീക്ഷിക്കുന്നതിന്', 'ഭൂചലനങ്ങള്‍ നിരീക്ഷിക്കുന്നതിന്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(180, 'കേരളം മലയാളികളുടെ മാതൃഭൂമിയുടെ കര്‍ത്താവ്?', 1, 1, 1, 1, 1, NULL, 'വള്ളത്തോള്‍*കേശവദേവ്*സുകുമാര്‍ അഴീക്കോട്*ഇ.എം.എസ്', 'ഇ.എം.എസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(181, 'സ്വതന്ത്ര ഇന്ത്യയിലെ ആദ്യത്തെ ആഭ്യന്തരമന്ത്രി?', 1, 1, 1, 1, 1, NULL, 'സര്‍ദാര്‍വല്ലഭായിപട്ടേല്‍*ജവഹര്‍ലാല്‍ നെഹ്രു*വി.കെ.കൃഷ്ണമേനോന്‍*ഇവരാരുമല്ല', 'സര്‍ദാര്‍വല്ലഭായിപട്ടേല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(182, 'യൂണിയന്‍ കാര്‍ബൈഡ് കമ്പനിയുടെ ഇപ്പോഴത്തെ ഉടമസ്ഥര്‍?', 1, 1, 1, 1, 1, NULL, 'ഡൗ.കെമിക്കല്‍സ്*ഹിന്ദുസ്ഥാന്‍ ലിവര്‍*ടാറ്റാ*ഇവരാരുമല്ല', 'ഡൗ കെമിക്കല്‍സ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(183, 'വാസ്‌കോഡഗാമ കാപ്പാട് തീരത്തെത്തിയവര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1857*1706*1855*1498', '1498', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(184, 'ഇന്ത്യയില്‍ സതി സമ്പ്രദായം നിര്‍ത്തലാക്കിയത്?', 1, 1, 1, 1, 1, NULL, 'മൗണ്ട്ബാറ്റണ്‍പ്രഭു*ബെന്റിക്്്രപഭു*സൈമണ്‍ കമ്മീഷന്‍*അശോകചക്രവര്‍ത്തി', 'ബെന്റിക്പ്രഭു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(185, 'സിന്ധുനദീതട സംസ്‌കാരം ഒരു------നാഗരിക സംസ്‌കാരമായിരുന്നു', 1, 1, 1, 1, 1, NULL, 'ശിലായുഗം*നവീനശിലായുഗം*താമ്രയുഗം*ഇരുമ്പയുഗം', 'താമ്രയുഗം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(186, 'കോണ്‍ഗ്രസ്-സോഷ്യലിസ്റ്റ് പാര്‍ട്ടി രൂപീകരണവുമായി ബന്ധമില്ലാത്ത വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'ജയപ്രകാശ് നാരായണ്‍*ആചാര്യ നരേന്ദ്രദേവ്*ജവഹര്‍ലാല്‍നെഹ്രു*അശോക്‌മേത്ത', 'ജവഹര്‍ലാല്‍നെഹ്രു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(187, 'ഗോവര്‍ധനന്റെ യാത്രകള്‍ ആരെഴുതിയതാണ്?', 1, 1, 1, 1, 1, NULL, 'ആനന്ദ്*എം.മുകുന്ദന്‍*ഒ.വി.വിജയന്‍*തകഴിശിവശങ്കരപ്പിള്ള', 'ആനന്ദ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(188, 'എലിപ്പനിയുണ്ടാക്കുന്ന രോഗാണു?', 1, 1, 1, 1, 1, NULL, 'ടൈഫോയ്ഡ് ബാസില*ഇന്‍ഫഌവന്‍സ വൈറസ്*ലൈപ്‌റ്റോസ്‌പൈറ ഇക്ടറോ ഹെമറാജിക്ക*ഇവയൊന്നുമല്ല', 'ലൈപ്‌റ്റോസ്‌പൈറ ഇക്ടറോ ഹെമറാജിക്ക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(189, 'ലോക പത്രസ്വാതന്ത്ര്യദിനം?', 1, 1, 1, 1, 1, NULL, 'ഏപ്രില്‍7*മെയ്3*ജൂണ്‍5*നവംബര്‍14', 'മെയ്3', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(190, 'താഴെപ്പറയുന്നവയില്‍ എയ്ഡ്‌സ് രോഗം പകരുന്ന രീതി?', 1, 1, 1, 1, 1, NULL, 'ഒരേപാത്രത്തില്‍ ഭക്ഷണംകഴിക്കുക*ഹസ്തദാനം*ആലിംഗനം*ഇവയൊന്നുമല്ല', 'ഇവയൊന്നുമല്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(191, 'FIFAയുടെ ജനറല്‍ സെക്രട്ടറി?', 1, 1, 1, 1, 1, NULL, 'സ്‌റ്റെപ് ബ്ലാറ്റര്‍*ഉര്‍സ്‌ലിന്‍സി*കിച്ച്‌നറേ*ഹ്യൂഗോ ചാവേസ്', 'സ്‌റ്റെപ് ബ്ലാറ്റര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(192, 'Philanthropist is one:', 1, 1, 1, 1, 1, NULL, 'who hates everybody*who loves mankind*who walks along the street*who collect stamps', 'who loves mankind', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(193, 'Replace the capitalised words by a suitable single word: He has A LARGE COLLECTION OF BOOKS at home.', 1, 1, 1, 1, 1, NULL, 'bookshop*museum*curios*library', 'library', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(194, 'Choose the word nearest in meaning of the capitalised words - He has BURNT HIS FINGERS by attacking a constable:', 1, 1, 1, 1, 1, NULL, 'had a burn injury*got himself into trouble*had a bone fracture*none of the above', ' got himself into trouble', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(195, 'Choose the word nearest in meaning of the capitalised words -The celebrated painter''s works have been SOLD FOR A SONG:', 1, 1, 1, 1, 1, NULL, 'at a very high price*at a very low price*in exchange of a song*along with a free song', 'at a very low price', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(196, 'You are placed under suspension until-------orders.', 1, 1, 1, 1, 1, NULL, 'farther*future*further*next', 'further', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(197, 'I want to meet the artist------- has painted this picture.', 1, 1, 1, 1, 1, NULL, 'which*that*who*whom', 'who', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(198, 'They opposed the motion--------was proposed by the rival group.', 1, 1, 1, 1, 1, NULL, 'who*which*where*when', 'which', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(199, '--------she had many misfortunes; she is always cheerful.', 1, 1, 1, 1, 1, NULL, 'if*in spite of*although*always', 'although', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(200, 'An unmarried women is called:', 1, 1, 1, 1, 1, NULL, 'bachelor*spinster*widow*widower', 'spinster', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(201, 'Replace the capitalised words by a suitable single word: He got a loan sanctioned by GREASING THE PALM of the officer concerned.', 1, 1, 1, 1, 1, NULL, 'flattering*bribing*threatening*massaging', 'bribing', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(202, 'Things haven''t changed-------- over the past few years.', 1, 1, 1, 1, 1, NULL, 'much*more*many*few', 'much', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(203, 'Bibliophile means:', 1, 1, 1, 1, 1, NULL, ' one who loves Bible*one who loves books*a person of strong opinion*one who can be believed', 'one who loves books', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(204, 'Honest is ------best policy:', 1, 1, 1, 1, 1, NULL, 'the*a*not*never', 'the', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(205, 'She did not smile-----I apologized', 1, 1, 1, 1, 1, NULL, 'still*until*yet*for', 'until', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(206, 'We resumed the game ------ it stopped raining', 1, 1, 1, 1, 1, NULL, ' while*where*as soon as*immediately', 'as soon as', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(207, 'An animal able to live both in land and water is called:', 1, 1, 1, 1, 1, NULL, 'amphibian*aristocrat*amateur*architect', 'amphibian', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(208, 'Which of these words means a form of art?', 1, 1, 1, 1, 1, NULL, 'college*collage*colleague*coolage', 'collage', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(209, 'A man whose wife is dead is called:', 1, 1, 1, 1, 1, NULL, 'widow*bachelor*widower*celibate', 'widower', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(210, 'The opposite of optimistic is:', 1, 1, 1, 1, 1, NULL, 'obedient*pessimistic*mystic*orderly', 'pessimistic', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(211, 'There are------animals in the zoo', 1, 1, 1, 1, 1, NULL, 'much*maximum*several*more', 'several', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(212, 'സംബന്ധികാ തത്പരുഷന് ഉദാഹരണം അല്ലാത്തത്?', 1, 1, 1, 1, 1, NULL, 'ശരീരാധ്വാനം*ശരീരപ്രകൃതി*ശരീരസൗന്ദര്യം*ശരീരകാന്തി', 'ശരീരാധ്വാനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(213, 'താഴെ പറയുന്നവയില്‍ വിധായകപ്രകാരത്തിന് ഉദാഹരണം?', 1, 1, 1, 1, 1, NULL, 'പറയുന്നു*പറയട്ടെ*പറയണം*പറയാം', 'പറയണം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(214, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ആദേശസന്ധിക്ക് ഉദാഹരണം?', 1, 1, 1, 1, 1, NULL, 'കണ്ടില്ല*നെന്മണി*ചാവുന്നു*മയില്‍പ്പീലി', 'നെന്മണി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(215, 'ശരിയായപദം തെരഞ്ഞെടുത്തെഴുതുക', 1, 1, 1, 1, 1, NULL, 'നിഖണ്ഡു*നിഖണ്ടു*നിഘണ്ഡു*നിഖണ്ടു', 'നിഘണ്ടു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(216, '2002ലെ വള്ളത്തോള്‍ അവാര്‍ഡുലഭിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'എം.ലീലാവതി*കെ.പി.അപ്പന്‍*സച്ചിദാനന്ദന്‍*സാറാജോസഫ്', 'എം.ലീലാവതി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(217, 'കോവിലന്‍ എന്ന തൂലികാനാമത്തിനുടമ?', 1, 1, 1, 1, 1, NULL, 'എം.ആര്‍.നായര്‍*എം.കെ.മേനോന്‍*വി.മാധവന്‍നായര്‍*പി.വി.അയ്യപ്പന്‍', 'പി.വി.അയ്യപ്പന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(218, 'ശരിയായതര്‍ജമ എഴുതുക - Fruit of the forbidden tree given mortal taste:', 1, 1, 1, 1, 1, NULL, 'വിലക്കപ്പെട്ട കനിയുടെ സ്വാദ് അമൂല്യമാണ്*സ്വാദുള്ള കനികള്‍ വിലക്കപ്പെട്ടവയാണ്*അമൂല്യമായ കനികള്‍ സ്വാദുള്ളവയാണ്*വിലക്കപ്പെട്ട കനിയുടെ സ്വാദ് നശ്വരമാണ്', 'വിലക്കപ്പെട്ട കനിയുടെ സ്വാദ് നശ്വരമാണ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(219, 'ശരിയായതര്‍ജമ എഴുതുക - I have been having fever for the lat two dsay:', 1, 1, 1, 1, 1, NULL, 'എനിക്ക് കഴിഞ്ഞ രണ്ടുദിവസമായി പനിയാണ്*എനിക്ക് പനി തുടങ്ങിയാല്‍ രണ്ടുദിവസം നീണ്ടുനില്‍ക്കും*എനിക്ക് രണ്ടുദിവസം കൂടി പനി തുടരും*ഞാന്‍ പനിമൂലം രണ്ടുദിവസം കിടന്നു', 'എനിക്ക് കഴിഞ്ഞ രണ്ടുദിവസമായി പനിയാണ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(220, 'ശരിയായതര്‍ജമ എഴുതുക - I got a message from an alien friend.', 1, 1, 1, 1, 1, NULL, 'വിദേശ സുഹൃത്ത് എനിക്കൊരു സന്ദേശം തന്നു*എനിക്ക് വിദേശ സുഹൃത്തില്‍ നിന്ന് ഒരു സന്ദേശം ലഭിച്ചു*എനിക്ക് കിട്ടിയ സന്ദേശം വിദേശ സുഹൃത്തിന്റേതായിരുന്നു*വിദേശസുഹൃത്തിന്റെ ഒരു സന്ദേശമാണ് എനിക്ക് കിട്ടിയത്', 'എനിക്ക് വിദേശ സുഹൃത്തില്‍ നിന്ന് ഒരു സന്ദേശം ലഭിച്ചു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(221, 'ശരിയായ വാചകം ഏത്?', 1, 1, 1, 1, 1, NULL, 'വെള്ളപ്പൊക്കം രാജ്യത്ത് അരാജകത്വവും പട്ടിണിയോ ഉണ്ടാക്കുന്നു*അരി ആട്ടിയും നെല്ലു കുത്തിയും കൊടുക്കപ്പെടും*ഹര്‍ത്താല്‍ ജനജീവിതം ദുസ്സഹമാക്കുന്നു*പട്ടി ഉണ്ടോയെന്ന്  നോക്കിയിട്ട് വീട്ടില്‍ പ്രവേശിക്കുക', 'ഹര്‍ത്താല്‍ ജനജീവിതം ദുസ്സഹമാക്കുന്നു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(222, 'FE-5; HG-7; JI-9;----------', 1, 1, 1, 1, 1, NULL, 'KL-11*LK-10*LK-11*KM-11', 'LK-11', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(223, '264ന്റെ 12.5% = -------ന്റെ 50%', 1, 1, 1, 1, 1, NULL, '33*16.5*66*132', '66', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(224, '15 പേര്‍ 24 ദിവസം കൊണ്ട് ചെയ്തു തീര്‍ക്കുന്ന ജോലി 18 ദിവസം കൊണ്ട് തീര്‍ക്കാന്‍ എത്രപേര്‍ വേണം?', 1, 1, 1, 1, 1, NULL, '20*22*24*21', '20', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(225, '4 പേരുടെ ശരാശരി വയസ്സ് 24. അഞ്ചാമത് ഒരാള്‍ കൂടി ചേര്‍ന്നാല്‍ ശരാശരി വയസ്സ് 25. അഞ്ചാമന്റെ വയസ്സെത്ര?', 1, 1, 1, 1, 1, NULL, '26*27*28*29', '29', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(226, 'കോഡുപയോഗിച്ച് KOREA യെ LPSFB എന്നെഴുതിയാല്‍ CHINA യെ എങ്ങനെ മാറ്റിയെഴുതാം?', 1, 1, 1, 1, 1, NULL, 'DIJOB*DIJBO*DIBJO*DJIBO', 'DIOB', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(227, 'നിഘണ്ടുവിലെ ക്രമത്തില്‍ വരുന്ന നാലാമത്തെ വാക്ക് ഏത്?', 1, 1, 1, 1, 1, NULL, 'fired*first*films*finds', 'first', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(228, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ഒന്നൊഴിച്ച് ബാക്കിയെല്ലാം INDEPENDENCE ന്‍റെ ആവര്‍ത്തനമാണ്. വാക്ക് ഏത്?', 1, 1, 1, 1, 1, NULL, 'INDEPENDENCE*INDEPENDENCE*INDEPENDENCE*INDEPENEDNCE', 'INDEPENEDCNE', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(229, 'രവിയുടെ വയസ്സിന്റെ മൂന്നിരട്ടി അച്ഛന്റെ വയസ്സ്. ഇവര്‍ തമ്മിലുള്ള വയസ്സ് വ്യത്യാസം 20. എങ്കില്‍ രവിക്കെത്ര വയസ്സ്?', 1, 1, 1, 1, 1, NULL, '10*12*20*15', '10', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(230, '100;23;95;25;90;--------------', 1, 1, 1, 1, 1, NULL, '85*29*80*27', '21', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(231, 'പൂരിപ്പിക്കുക -  ഓസ്‌കാര്‍:സിനിമ   ::  ബുക്കര്‍:---------', 1, 1, 1, 1, 1, NULL, 'നാടകം*സാഹിത്യം*സാമൂഹ്യപ്രവര്‍ത്തനം*സ്‌പോര്‍ട്‌സ്', 'സാഹിത്യം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(232, 'പൂരിപ്പിക്കുക - കാര്‍ഡിയോളജി:ഹൃദയം  ::   ഓഫ്താല്‍മോളജി:--------', 1, 1, 1, 1, 1, NULL, 'കരള്‍*രക്തം*കണ്ണ്*വൃക്ക', 'കണ്ണ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(233, 'പൂരിപ്പിക്കുക - റേസിംഗ്:റോഡ്   ::  യാട്ടിംഗ്:------', 1, 1, 1, 1, 1, NULL, 'വെള്ളം*ഐസ്*മരുഭൂമി*ആകാശം', 'വെള്ളം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(234, 'പൂരിപ്പിക്കുക - പാരീസ്:ഫ്രാന്‍സ്   ::  കെയ്‌റോ:------', 1, 1, 1, 1, 1, NULL, ' ഇറാഖ്*ഈജിപ്ത്*സിറിയ*ലിബിയ', 'ഈജിപ്ത്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(235, 'കോഡുപയോഗിച്ച് KUWAIT നെ ISUYGR എന്നെഴുതിയാല്‍ MADRAS നെ എങ്ങനെ മാറ്റിയെഴുതാം?', 1, 1, 1, 1, 1, NULL, 'KYBYPQ*KYBPYQ*KYBPQY*KYBQPY', 'KYBPYQ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(236, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 1, 1, 1, 1, NULL, 'ബാംഗ്ലൂര്‍*ഇറ്റാനഗര്‍*മധുര*പാറ്റ്‌ന', 'മധുര', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(237, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 1, 1, 1, 1, NULL, 'അരബിന്ദോ*നെഹ്രു*കൃഷ്ണമേനോന്‍*വല്ലഭായ്പട്ടേല്‍', 'അരബിന്ദോ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(238, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 1, 1, 1, 1, NULL, 'LKN*RQT*VUW*CBE', 'VUW', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(239, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 1, 1, 1, 1, NULL, 'ഏലം*ബദാം*ജീരകം*ഗ്രാമ്പൂ', 'ബദാം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(240, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 1, 1, 1, 1, NULL, 'വത്സമ്മ*സുനിതാറാണി*ബീനമോള്‍*മല്ലേശ്വരി', 'മല്ലേശ്വരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(241, 'ഒളിംപിക് അത്‌ലറ്റിക് ഈവന്റില്‍ സെമിഫൈനലിലെത്തിയ പ്രഥമ ഇന്ത്യന്‍വനിത:', 1, 1, 1, 1, 1, NULL, 'പി.ടി.ഉഷ*കമല്‍ജിത്സന്ധു*ഷൈനി വിത്സന്‍*എം.ഡി.വത്സമ്മ', 'ഷൈനിവിത്സന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(242, '2004ലെ സമ്മര്‍ ഒളിംപിക്‌സ് ഏതു നഗരത്തില്‍ വച്ചാണ് നടക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'ഏതന്‍സ്*ടോക്കിയോ*ന്യൂഡ്ല്‍ഹി*റോം', 'ഏതന്‍സ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(243, 'മാഗ്‌സസെ അവാര്‍ഡ് ലഭിച്ച ആദ്യത്തെ ഇന്ത്യാക്കാരന്‍?', 1, 1, 1, 1, 1, NULL, 'പണ്ഡിറ്റ് രവിശങ്കര്‍*ലതാമങ്കേഷ്‌കര്‍*ഉസ്താദ് അല്ലാ രഖ*ആചാര്യ വിനോബ ഭാവേ', 'ആചാര്യവിനോബാ ഭാവേ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(244, 'ഇന്ത്യയുടെ ആദ്യത്തെ ഉപപ്രധാനമന്ത്രി?', 1, 1, 1, 1, 1, NULL, 'മൊറാര്‍ജി ദേശായി*വല്ലഭായിപട്ടേല്‍*ജഗ്ജീവന്‍ റാം*എല്‍.കെ.അദ്വാനി', 'വല്ലഭായിപട്ടേല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(245, 'കേരളത്തിന്റെ ഔദ്യോഗിക പക്ഷി ഏതാണ്?', 1, 1, 1, 1, 1, NULL, 'വേഴാമ്പല്‍*തത്ത*മൈന*മയില്‍', 'വേഴാമ്പല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(246, 'കേരളത്തിലെ ഏറ്റവും ചെറിയ താലൂക്ക്?', 1, 1, 1, 1, 1, NULL, ' കോതമംഗലം*കാര്‍ത്തികപ്പള്ളി*കൊച്ചി*കുന്നത്തൂര്‍', 'കുന്നത്തൂര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(247, 'തിരുവിതാംകൂറിലെ അവസാനത്തെ രാജാവ് ആരായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'സ്വാതിതിരുനാള്‍*ചിത്തിരതിരുനാള്‍ ബാലരാമവര്‍മ*ശ്രീ മൂലം തിരുനാള്‍*റാണി ഗൗരി ലക്ഷ്മീബായി', 'ചിത്തിര തിരുനാള്‍ ബാലരാമവര്‍മ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(248, 'കേരളത്തില്‍ ഏറ്റവും അവസാനം രൂപീകൃതമായ ജില്ല?', 1, 1, 1, 1, 1, NULL, 'വയനാട്*ഇടുക്കി*പത്തനംതിട്ട*കാസര്‍ഗോഡ്', 'കാസര്‍ഗോഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(249, 'നന്തനാര്‍ എന്ന സാഹിത്യകാരന്റെ യഥാര്‍ഥപേര്?', 1, 1, 1, 1, 1, NULL, 'പി.സി.ഗോപാലന്‍*പി.വി.അയ്യപ്പന്‍*പി.സച്ചിദാനന്ദന്‍*പി.സി.കു്ട്ടികൃഷ്ണന്‍', 'പി.സി.ഗോപാലന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(250, 'അലാഹയുടെ പെണ്‍മക്കള്‍ എന്ന കൃതിയാണ് 2002ലെ സാഹിത്യ അക്കാദമി അവാര്‍ഡ് നേടിയത്. ആരുടെ കൃതിയാണിത്?', 1, 1, 1, 1, 1, NULL, 'എം.മുകുന്ദന്‍*കാക്കനാടന്‍*സാറാ ജോസഫ്*എന്‍.എസ്.മാധവന്‍', 'സാറാജോസഫ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(251, 'പ്രാചീന കാലത്ത് ബലിത എന്ന പേരില്‍ അറിയപ്പെട്ടിരുന്ന സ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'തിരുനാവായ*വര്‍ക്കല*തിരുവല്ലം*രാമേശ്വരം', 'വര്‍ക്കല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(252, 'ആധുനിക തിരുവിതാംകൂറിന്റെ സ്ഥാപകന്‍ ആര്?', 1, 1, 1, 1, 1, NULL, 'സ്വാതിതിരുനാള്‍*മാര്‍ത്താണ്ഡവര്‍മ*രാജാ കേശവദാസന്‍*സര്‍ സി.പി.രാമസ്വാമിഅയ്യര്‍', 'മാര്‍ത്താണ്ഡവര്‍മ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(253, 'കേരള സാഹിത്യഅക്കാദമിയുടെ ആദ്യത്തെ പ്രസിഡന്റ്?', 1, 1, 1, 1, 1, NULL, 'കെ.പി. കേശവമേനോന്‍*ജി.ശങ്കരക്കുറുപ്പ്*തകഴി ശിവശങ്കരപ്പിള്ള*സര്‍ദാര്‍ കെ.എം.പണിക്കര്‍', 'സര്‍ദാര്‍ കെ.എം.പണിക്കര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(254, 'ഗുരുവായൂര്‍ സത്യഗ്രഹം നടന്നത് ഏതുവര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1931*1932*1936*1921', '1931', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(255, 'ലോകത്തിലെ ഏറ്റവും നീളംകൂടിയ ഡാം?', 1, 1, 1, 1, 1, NULL, 'നാഗാര്‍ജുനാസാഗര്‍*ബീസ്*ഭക്ര*ഹിരാക്കുഡ്', 'ഹിരാക്കുഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(256, 'കൊങ്കണ്‍ റെയില്‍വേ താഴെ പറയുന്നവയില്‍ ഒരു സംസ്ഥാനത്തില്‍കൂടി കടന്നു പോകുന്നില്ല; ഏതാണത്?', 1, 1, 1, 1, 1, NULL, 'കര്‍ണാടക*മഹാരാഷ്ട്ര*ആന്ധ്രാപ്രദേശ്*ഗോവ', 'ആന്ധ്രാപ്രദേശ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(257, 'ഒരു കുട്ടിയുടെ പിതൃത്വം ആരിലെന്നു തെളിയിക്കുവാന്‍ താഴെ പറയുന്ന ഏതു ടെസ്റ്റാണ് നടത്തുക?', 1, 1, 1, 1, 1, NULL, 'ഡി.എന്‍.എ.ടെസ്റ്റ്*പ്രോട്ടീന്‍ അനാലിസിസ്*ക്രോമസോം കൗണ്ടിങ്ങ്*സെമന്‍ടെസ്റ്റ്', 'ഡി.എന്‍.എ.ടെസ്റ്റ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(258, 'വെള്ളം ശുദ്ധീകരിക്കുവാന്‍ താഴെ പറയുന്നവയില്‍ ഏതാണ് ഉപയോഗിക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'അമോണിയ*ക്ലോറിന്‍*കാര്‍ബണ്‍ഡൈഓക്‌സൈഡ്*ബ്രോമിന്‍', 'ക്ലോറിന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(259, 'ചന്ദനമരങ്ങള്‍ ഏറ്റവും കൂടുതലുള്ള ഇന്ത്യന്‍ സംസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'തമിഴ്‌നാട്*ആന്ധ്രാപ്രദേശ്*കര്‍ണാടക*മധ്യപ്രദേശ്', 'കര്‍ണാടക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(260, 'സാര്‍സ് എന്നാല്‍ എന്ത്?', 1, 1, 1, 1, 1, NULL, 'സിവിയര്‍ അക്യൂട്ട് റസ്പിറേറ്ററി സിസ്റ്റം*സിസ്റ്റമിക് അക്യൂട്ട് റീനല്‍ സിന്‍ഡ്രോം*സോളിറ്ററി അക്യൂട്ട് റസ്പിറേറ്ററി സിസ്റ്റം*സിവിയര്‍ അക്യൂട്ട് റസ്പിറേറ്ററി സിന്‍ഡ്രോം', 'സിവിയര്‍ അക്യൂട്ട് റസ്പിറേറ്ററി സിന്‍ഡ്രോം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(261, 'ഏഷ്യന്‍ ഡവലപ്‌മെന്റ് ബാങ്കിന്റെ ഹെഡ്ക്വാര്‍ട്ടേഴ്‌സ് എവിടെ സ്ഥിതിചെയ്യുന്നു?', 1, 1, 1, 1, 1, NULL, 'വാഷിങ്ടണ്‍*മനില*സിംഗപ്പൂര്‍*ലണ്ടന്‍', 'മനില', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(262, 'ഇന്ത്യയില്‍ ഏറ്റവും കൂടുതല്‍ മഴ ലഭിക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'വിന്റര്‍ സീസണ്‍*തെക്കുപടിഞ്ഞാറന്‍ മണ്‍സൂണ്‍*വടക്കുകിഴക്കന്‍ മണ്‍സൂണ്‍*സമ്മര്‍സീസണ്‍', 'തെക്കുപടിഞ്ഞാറന്‍ മണ്‍സൂണ്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(263, 'ഭൗമദിനം (എര്‍ത്ത് ഡേ) ആചരിക്കുന്നത് ഏതു ദിവസമാണ്?', 1, 1, 1, 1, 1, NULL, 'മാര്‍ച്ച് 22*ഏപ്രില്‍ 22*ജൂണ്‍ 2*സെപ്തംബര്‍ 5', 'ഏപ്രില്‍ 22', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(264, 'ഒരു മനുഷ്യന്റെ സാധാരണ ശരീരോഷ്മാവ്?', 1, 1, 1, 1, 1, NULL, '98.4F*98.6F*98.8F*98.2F', '98.4F', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(265, 'കേട്ട ഗാനം മധുരം കേള്‍ക്കാത്ത ഗാനം മധുരതരം (ഹേര്‍ഡ് മെലഡീസ് ആര്‍ സ്വീറ്റ് ബട്ട് ദോസ് അണ്‍ഹേര്‍ഡ് മെലഡീസ് ആര്‍ സ്വീറ്റര്‍) ഇതിന്റെ രചയിതാവ് ആര?', 1, 1, 1, 1, 1, NULL, 'ഷേക്‌സ്പിയര്‍*രവീന്ദ്രനാഥടാഗോര്‍*കമലാദാസ്*ജോണ്‍കീറ്റ്‌സ്', 'ജോണ്‍കീറ്റ്‌സ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(266, 'Idosl എന്ന പുസ്തകത്തിന്റെ രചയിതാവ് ആരാണ്?', 1, 1, 1, 1, 1, NULL, 'സുനില്‍ ഗവാസ്‌കര്‍*വിജയ് അമൃതരാജ്*പ്രകാശ് പദുക്കോണ്‍*എം.എ.കെ.പട്ടൗഡി', 'സുനില്‍ ഗവാസ്‌കര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(267, 'ഫെഡറേഷന്‍ ഓഫ് ഇന്ത്യന്‍ ചേംബര്‍ ഓഫ് കോമേഴ്‌സ് (ഫിക്കി) 1927ല്‍ സ്ഥാപിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'ടാറ്റയും ബിര്‍ളയും*സിംഘാനിയയും ടാറ്റയും*ടാറ്റയും താക്കൂര്‍ദാസും*ബിര്‍ളയും താക്കൂര്‍ദാസും', 'ബിര്‍ളയും താക്കൂര്‍ദാസും', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(268, 'ഗേറ്റ്‌വേ ഓഫ് ഇന്ത്യ പണികഴിക്കാനുള്ള കാരണം?', 1, 1, 1, 1, 1, NULL, 'കിങ് ജോര്‍ജ് അഞ്ചാമന്റെയും ക്യൂന്‍മേരിയുടെയും ഇന്ത്യാ സന്ദര്‍ശനം*രക്തസാക്ഷികളെ സ്മരിക്കാന്‍*റാണിലക്ഷ്മിഭായിയെ അനുസ്മരിക്കാന്‍*വിദേശരാജ്യങ്ങളും ഇന്ത്യയുമായി കച്ചവടബന്ധം സ്ഥാപിച്ചതിനെ സ്മരിക്കാന്‍', 'കിങ് ജോര്‍ജ് അഞ്ചാമന്റെയും ക്യൂന്‍മേരിയുടെയും ഇന്ത്യാ സന്ദര്‍ശനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(269, 'മൂന്നു വട്ടമേശ സമ്മേളനങ്ങളിലും പങ്കെടുത്തത് ആര്?', 1, 1, 1, 1, 1, NULL, 'ബി.ആര്‍.അംബേദ്കര്‍*എം.എം.മാളവ്യ*വല്ലഭായി പട്ടേല്‍*മഹാത്മാഗാന്ധി', 'ബി.ആര്‍.അംബേദ്കര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(270, 'അലക്‌സാണ്ടര്‍ ഇന്ത്യയെ ആക്രമിച്ചത്?', 1, 1, 1, 1, 1, NULL, '327 ബി.സി.*298 ബി.സി.*302 ബി.സി.*303 ബി.സി.', '327 ബി.സി.', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL);
INSERT INTO `questions` (`id`, `question`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answers`, `answer_keys`, `question_import_id`, `option_images`, `question_status_id`, `organization_id`, `question_type_id`, `share`, `question_group_id`, `import_slno`) VALUES
(271, 'ഇന്ത്യന്‍ സംസ്ഥാനങ്ങളിലെ പ്രഥമ വനിതാ മുഖ്യമന്ത്രി?', 1, 1, 1, 1, 1, NULL, 'ഷീലാദീക്ഷിത്*സുചേതാ കൃപലാനി*മായാവതി*ജയലളിത', 'സുചേതാ കൃപലാനി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(272, 'കാര്‍ഷിക ആദായനികുതി ഏര്‍പ്പെടുത്തിയ ആദ്യത്തെ ഇന്ത്യന്‍ സംസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'പഞ്ചാബ്*മഹാരാഷ്ട്ര*ബീഹാര്‍*ആന്ധ്രാപ്രദേശ്', 'പഞ്ചാബ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(273, 'ഇന്ത്യന്‍ സംസ്ഥാനങ്ങളില്‍ ഗവര്‍ണറായി നിയമിക്കപ്പെടാനുള്ള പ്രായപരിധി?', 1, 1, 1, 1, 1, NULL, '65 വയസ്സ്*62 വയസ്സ്*35 വയസ്സ്*70 വയസ്സ്', '35വയസ്സ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(274, 'ഇന്ത്യയിലെ ചാര്‍ളി ചാപഌന്‍ എന്നറിയപ്പെടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'ഋഷികപൂര്‍*ഷാരൂഖ്ഖാന്‍*അമിതാഭ്ബച്ചന്‍*രാജ്കപൂര്‍', 'രാജ്കപൂര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(275, 'ഒരു ദേശീയ പാര്‍ട്ടിയായി അംഗീകരിക്കുവാന്‍ ഒരു പാര്‍ട്ടിക്ക് ലഭിക്കേണ്ട വോട്ട്?', 1, 1, 1, 1, 1, NULL, '15 ശതമാനം വോട്ട് രണ്ട് സംസ്ഥാനങ്ങളില്‍*നാലുശതമാനം വോട്ട് നാലോ അതിലധികമോ സംസ്ഥാനങ്ങളില്‍*25ശതമാനം വോട്ട് ഏതെങ്കിലും ഒരു സംസ്ഥാനത്തില്‍*ഇതൊന്നുമല്ല', 'ഇതൊന്നുമല്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(276, 'രാജിവെക്കണമെന്നു തീരുമാനിക്കുന്ന ഒരു ലോക്‌സഭാ സ്പീക്കര്‍ തന്റെ രാജിക്കത്ത്?', 1, 1, 1, 1, 1, NULL, 'ലോക്‌സഭാ ഡെ.സ്പീക്കര്‍ക്കു നല്‍കണം*രാഷ്ട്രപതിക്കു നല്‍കണം*ഉപരാഷ്ട്രപതിക്കു നല്‍കണം*പ്രധാനമന്ത്രിക്കു നല്‍കണം', 'ലോക്‌സഭാ ഡെ.സ്പീക്കര്‍ക്കു നല്‍കണം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(277, 'വലിയ തോതില്‍ മോണോസൈറ്റ് കാണുന്നത് താഴെപറയുന്ന ഏതു സംസ്ഥാനത്തിലാണ്?', 1, 1, 1, 1, 1, NULL, 'തമിഴ്‌നാട്*കര്‍ണാടക*കേരളം*ബിഹാര്‍', 'കേരളം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(278, 'മത്സ്യോല്പാദനത്തില്‍ ലോകത്ത് ഒന്നാംസ്ഥാനത്തു നില്‍ക്കുന്ന രാജ്യം?', 1, 1, 1, 1, 1, NULL, 'റഷ്യ*നോര്‍വേ*ഇന്ത്യ*ജപ്പാന്‍', 'ജപ്പാന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(279, 'നാട്ടുരാജ്യങ്ങളെ ഏകീകരിച്ച് ഇന്ത്യന്‍ യൂണിയന്‍ സ്ഥാപിക്കുവാന്‍ മുഖ്യപങ്ക് വഹിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'മഹാത്മാഗാന്ധി*സര്‍ദാര്‍ വല്ലഭായി പട്ടേല്‍*ജവഹര്‍ലാല്‍ നെഹ്രു*ലോകമാന്യ തിലകന്‍', 'സര്‍ദാര്‍ വല്ലഭായി പട്ടേല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(280, 'ഇന്ത്യയില്‍ ആദ്യമായി രൂപ ഉപയോഗത്തില്‍ കൊണ്ടുവന്നത്?', 1, 1, 1, 1, 1, NULL, 'ഷേര്‍ഷാ*അശോകന്‍*അക്ബര്‍*ജഹാംഗീര്‍', 'ഷേര്‍ഷാ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(281, 'ഇന്ത്യാചരിത്രത്തിലെ ഒരു വഴിത്തിരിവായ ഈ യുദ്ധമാണ് മുഗള്‍ സാമ്രാജ്യം സ്ഥാപിക്കാന്‍ വഴിയൊരുക്കിയത്?', 1, 1, 1, 1, 1, NULL, 'കലിംഗയുദ്ധം*പ്ലാസിയുദ്ധം*ഒന്നാം പാനിപ്പട്ട് യുദ്ധം*മൂന്നാം പാനിപ്പട്ട് യുദ്ധം', 'ഒന്നാം പാനിപ്പട്ട് യുദ്ധം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(282, 'ഇന്ത്യന്‍ നാഷണല്‍ കോണ്‍ഗ്രസിന്റെ പ്രഥമ വനിതാ പ്രസിഡന്റ്?', 1, 1, 1, 1, 1, NULL, 'ആനിബസന്റ്*വിജയലക്ഷ്മിപണ്ഡിറ്റ്*ഇന്ദിരാഗാന്ധി*സരോജിനിനായിഡു', 'ആനിബസന്റ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(283, 'ഇന്റര്‍നാഷണല്‍ ഒളിമ്പിക് കമ്മിറ്റിയുടെ ഗോള്‍ഡ് മെഡല്‍ ഓഫ് ഒളിമ്പിക് ഓര്‍ഡര്‍ ലഭിച്ച പ്രഥമ വനിത?', 1, 1, 1, 1, 1, NULL, 'ഇന്ദിരാഗാന്ധി*പി.ടി.ഉഷ*വിജയലക്ഷ്മിപണ്ഡിറ്റ്*ഷൈനിവിത്സണ്‍', 'ഇന്ദിരാഗാന്ധി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(284, 'ഈ ബ്രിട്ടീഷ് മിഷണറിയെ ഇന്ത്യാക്കാര്‍ സ്‌നേഹപൂര്‍വം ദീനബന്ധു എന്നുവിളിച്ചു', 1, 1, 1, 1, 1, NULL, 'ആനിബസന്റ്*സി.എഫ്.ആന്‍ഡ്രൂസ്*സര്‍ വില്യം ജോണ്‍സ്*ജോണ്‍ ഹിഗ്ഗിന്‍സ്', 'സി.എഫ്.ആന്‍ഡ്രൂസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(285, 'നൈറ്റിംഗേല്‍ ഓഫ് ഇന്ത്യ എന്നറിയപ്പെടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'ലതാമങ്കേഷ്‌കര്‍*സരോജിനിനായിഡു*എം.എസ്.സുബ്ബലക്ഷ്മി*വിജയലക്ഷ്മിപണ്ഡിറ്റ്', 'സരോജിനിനായിഡു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(286, 'ബെയര്‍ഫൂട്ട് പെയിന്റര്‍ എന്നറിയപ്പെടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'പിക്കാസോ*ആര്‍.കെ.ലക്ഷ്മണന്‍*രാജാരവിവര്‍മ*എം.എഫ്.ഹുസൈന്‍', 'എം.എഫ്.ഹുസൈന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(287, 'ഇന്ത്യയിലാദ്യമായി മുസ്ലീം ആക്രമണം തുടങ്ങിയതാര്?', 1, 1, 1, 1, 1, NULL, 'ബാബര്‍*നാദിര്‍ഷാ*മുഹമ്മദ് ഗസ്‌നി*മുഹമ്മദ് ഗോറി', 'മുഹമ്മദ് ഗസ്‌നി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(288, 'ഇന്ത്യയുടെ ദേശീയഗാനമായ ജനഗണമന ആദ്യമായി ആലപിക്കപ്പെട്ടത് എവിടെ?', 1, 1, 1, 1, 1, NULL, 'ഡല്‍ഹി*കല്‍ക്കത്ത*പാട്യാല*ലാഹോര്‍', 'കല്‍ക്കത്ത', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(289, 'ഇന്ത്യയില്‍ റെയില്‍വേ സംവിധാനം നിലവില്‍ വന്ന വര്‍ഷത്തിലെ ഇന്ത്യയുടെ ഗവര്‍ണര്‍ ജനറല്‍ ആരായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'റിപ്പണ്‍*ഹാര്‍ഡിങ്*കഴ്‌സണ്‍*ഡല്‍ഹൗസി', 'ഡല്‍ഹൗസി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(290, 'ചൗരിചൗര സംഭവത്തിന്റെ ഫലമായി പെട്ടെന്നു നിര്‍ത്തിവെക്കേണ്ടിവന്ന് പ്രക്ഷോഭം?', 1, 1, 1, 1, 1, NULL, 'ഹോംറൂള്‍ പ്രസ്ഥാനം*വഹാബി പ്രസ്ഥാനം*നിസ്സഹകരണപ്രസ്ഥാനം*ഡിസ്ഒബീഡിയന്‍സ് പ്രസ്ഥാനം', 'നിസ്സഹകരണപ്രസ്ഥാനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(291, 'I am not older than you---------', 1, 1, 1, 1, 1, NULL, 'aren''t I*amn''t I*weren''t I*am I', 'amI', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(292, 'The idiom tooth and nail means', 1, 1, 1, 1, 1, NULL, 'without weapon*with all the power*with the available weapon*without courage', 'with all the power', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(293, 'He was angry-------- he listened to me', 1, 1, 1, 1, 1, NULL, 'though*despite*neverthless*beause', 'neverthless', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(294, 'He talked as if he---------rich', 1, 1, 1, 1, 1, NULL, 'is*was*had been*might have been', 'was', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(295, 'Exhort means', 1, 1, 1, 1, 1, NULL, 'advise strongly*accuse*indict*warm', 'advise strongly', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(296, 'The committee has to find an ------ date for the meeting', 1, 1, 1, 1, 1, NULL, 'alternate*alternative*alternatively*alternation', 'alternative', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(297, 'Sam is very clever ------ cooking', 1, 1, 1, 1, 1, NULL, 'in*at*with*on', 'at', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(298, 'The phrase ''in cold blood'' means', 1, 1, 1, 1, 1, NULL, 'indifferently*cruely*thoughtlessly*deliberately', 'cruely', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(299, 'Children can usually ------ their parents', 1, 1, 1, 1, 1, NULL, 'get over*get through*get on*get round', 'get round', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(300, 'The opposite of vociferous is', 1, 1, 1, 1, 1, NULL, 'faint*clamour*noisy*rumpus', 'faint', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(301, 'If the workmen had not been tired; they --------- the work', 1, 1, 1, 1, 1, NULL, 'would have completed*would complete*will complete*will have completed', 'would have completed', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(302, 'Hardly --------- see the picture', 1, 1, 1, 1, 1, NULL, 'I can*I could*can I*can''t I', 'I could', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(303, 'We are quite used to --------- in queues', 1, 1, 1, 1, 1, NULL, 'wait*waiting*waited*have waited', 'waiting', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(304, 'Stubborn means', 1, 1, 1, 1, 1, NULL, 'shameless*fearless*courageous*obstinate', 'obstinate', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(305, 'The study of the origin and history of words', 1, 1, 1, 1, 1, NULL, 'Etymology*Entomology*Phonology*Phonetics', 'Etymology', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(306, 'Much water has ---------- under the London bridge', 1, 1, 1, 1, 1, NULL, 'frown*flowed*flew*followed', 'flown', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(307, 'Sheela has two brothers. She does not like -------- of them', 1, 1, 1, 1, 1, NULL, 'neither*any*either*none', 'either', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(308, 'A person who sacrifices his life for a cause', 1, 1, 1, 1, 1, NULL, 'patriot*martyr*revolutionary*soldier', 'martyr', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(309, 'Some rules are very rigid: others are-----------', 1, 1, 1, 1, 1, NULL, 'unrigid*hard and fast*loose*flexible', 'flexible', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(310, 'The door bell ------- for the last ten minutes', 1, 1, 1, 1, 1, NULL, 'was ringing*is ringing*has been ringing*had been ringing', 'has been ringing', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(311, 'ശരിയായ തര്‍ജമ ഏത്?  The boat gradually gathered way:', 1, 1, 1, 1, 1, NULL, 'ബോട്ട് ക്രമേണ വഴിമാറിപ്പോയി*ക്രമേണ ബോ്ട്ട് നേരായ വഴിയിലെത്തി*ബോട്ട് നേരായ വഴിയിലൂടെ പോയി*ബോട്ടിന് ക്രമേണ വേഗത കൂടി', 'ബോട്ടിന് ക്രമേണ വേഗത കൂടി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(312, 'ശരിയായ തര്‍ജമ ഏത്?  The police ran down the criminal:', 1, 1, 1, 1, 1, NULL, 'പോലീസ് കുറ്റവാളിയെ തുരത്തിയോടിച്ചു*പോലീസ് കുറ്റവാളിയെ ഓടിച്ചു പിടിച്ചു*പോലീസ് കുറ്റവാളിയെ താഴേയ്ക്ക് ഓടിച്ചു*കുറ്റവാളി പോലീസിന്റെ കയ്യില്‍ നിന്ന് ഓടി രക്ഷപ്പെട്ടു', 'പോലീസ് കുറ്റവാളിയെ താഴേയ്ക്ക് ഓടിച്ചു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(313, 'ശരിയായ തര്‍ജമ ഏത്?  Finally he fell in with my plan:', 1, 1, 1, 1, 1, NULL, 'ഒടുവില്‍ എന്റെ പദ്ധതിയില്‍ അവന്‍ വീണുപോയി*ഒടുവില്‍ എ്‌ന്റെ പദ്ധതിയോട് അവന്‍ വിയോജിച്ചു*ഒടുവില്‍ അവന്‍ എന്റെ പദ്ധതിയോട് യോജിച്ചു*ഒടുവില്‍ എന്റെ പദ്ധതി അവന്‍ ഉപേക്ഷിച്ചു ', 'ഒടുവില്‍ അവന്‍ എന്റെ പദ്ധതിയോട് യോജിച്ചു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(314, 'കര്‍മധാരായ സമാസം അല്ലാത്ത പദമേത്?', 1, 1, 1, 1, 1, NULL, 'തോള്‍വള*പീതാംബരം*കൊന്നത്തെങ്ങ്*നീലാകാശം', 'തോള്‍വള', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(315, 'വ്യാകരണപരമായി വേറിട്ടു നില്‍ക്കുന്ന പദമേത്?', 1, 1, 1, 1, 1, NULL, 'വേപ്പ്*ഉപ്പ്*പരിപ്പ്*നടപ്പ്', 'നടപ്പ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(316, 'ശരിയായ വാക്യമേത്?', 1, 1, 1, 1, 1, NULL, 'പരീക്ഷ കഠിമായതാണ് കുട്ടികള്‍ തോല്‍ക്കാന്‍ കാരണം*ഓരോ പഞ്ചായത്ത് തോറും ഓരോ ആശുപത്രി ആവശ്യമാണ്*അഴിമതി തീര്‍ച്ചയായും തുടച്ചു നീക്കുകതന്നെ വേണം*പരീക്ഷ കഠിനമായതുകൊണ്ടാണ് കുട്ടികള്‍ തോല്ക്കാന്‍ കാരണം', 'പരീക്ഷ കഠിമായതാണ് കുട്ടികള്‍ തോല്‍ക്കാന്‍ കാരണം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(317, 'വെള്ളം കുടിച്ചു - ഇതില്‍ വെള്ളം എന്ന പദം ഏത് വിഭക്തിയില്‍?', 1, 1, 1, 1, 1, NULL, 'നിര്‍ദ്ദേശിക*പ്രതിഗ്രാഹിക*സംബന്ധിക*ഉദ്ദേശിക', 'പ്രതിഗ്രാഹിക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(318, 'ശരിയായ രൂപമേത്?', 1, 1, 1, 1, 1, NULL, 'വൃച്ഛികം*വൃച്ഛിഗം*വൃശ്ചികം*വൃശ്ചിഗം', 'വൃച്ഛികം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(319, 'താഴെ കൊടുത്തിട്ടുള്ള പ്രയോഗത്തിന്റെ അര്‍ഥമെന്ത്?ശ്ലോകത്തില്‍ കഴിക്കുക', 1, 1, 1, 1, 1, NULL, 'ശ്ലോകം ചൊല്ലുക*പതുക്കെ ചെയ്യുക*ഏറെച്ചുരുക്കുക*പരത്തിപ്പറയുക', 'ഏറെച്ചുരുക്കുക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(320, 'അവന്‍ എന്നതിലെ സന്ധി:', 1, 1, 1, 1, 1, NULL, 'ആദേശം*ലോപം*ദ്വിത്വം*ആഗമം', 'ആഗമം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(321, 'വിജ്ഞാനത്തിന് വായന എന്നപോലെയാണ് ആരോഗ്യത്തിന്?', 1, 1, 1, 1, 1, NULL, 'വ്യായാമം*ആഹാരം*ശീലം*ശരീരം', 'വ്യായാമം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(322, 'പുസ്തകത്തിന് ഗ്രന്ഥകാരനെന്ന പോലെയാണ് പ്രതിമയ്ക്ക്?', 1, 1, 1, 1, 1, NULL, 'മോഡല്‍*ശില്പി*മാര്‍ബിള്‍*ശില', 'ശില്പി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(323, 'താഴെ തന്നിട്ടുള്ള ശ്രേണിയില്‍ ചില അക്ഷരങ്ങള്‍ വിട്ടിരിക്കുന്നു. വിട്ടിട്ടുള്ള അക്ഷരങ്ങള്‍ ക്രമത്തില്‍ എഴുതിയിട്ടുള്ളത് ഏതെന്ന് കണ്ടെത്തുക a-aa-ab-aa-a-a', 1, 1, 1, 1, 1, NULL, 'aabba*abbaa*ababa*babab', 'babab', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(324, 'രോഗത്തിന് രോഗശമനം എന്ന പോലെയാണ് പ്രശ്‌നത്തിന്?', 1, 1, 1, 1, 1, NULL, 'വിശകലനംചെയ്യല്‍*അനുഭവിക്കല്‍*അവഗണിക്കല്‍*പരിഹരിക്കല്‍', 'പരിഹരിക്കല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(325, 'താഴെ തന്നിരിക്കുന്ന നാലു വാക്കുകളില്‍ മൂന്നെണ്ണം തമ്മില്‍ ഒരു സാദൃശ്യം ഉണ്ട്. സാദൃശ്യമില്ലാത്തത് കണ്ടുപിടിക്കുക?', 1, 1, 1, 1, 1, NULL, 'ആന*മുയല്‍*ആട്*പൂച്ച', 'പൂച്ച', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(326, 'പ്രഭയ്ക്ക് 90 മീറ്റര്‍ 2 മിനിട്ടുകൊണ്ട് നടക്കാന്‍ സാധിക്കുമെങ്കില്‍ 225 മീറ്റര്‍ നടക്കാന്‍ എത്ര സമയമെടുക്കും?', 1, 1, 1, 1, 1, NULL, '3.5മിനിട്ട്*4.5മിനിട്ട്*5മിനിട്ട്*7.5മിനിട്ട്', '5മിനിട്ട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(327, 'ഒരു കോഡനുസരിച്ച് GOAT എന്ന് എഴുതിയിരിക്കുന്നത് CKWP എന്നാണ്. ഇതേ കോഡുപയോഗിച്ച് എഴുതിയ DWNA താഴെ തന്നിട്ടുള്ളവയില്‍ ഏതിനെ സൂചിപ്പിക്കുന്നു?', 1, 1, 1, 1, 1, NULL, 'BEAR*DEER*HARE*MARE', 'HARE', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(328, 'ഈ ചോദ്യത്തിലെ സംഖ്യകള്‍ ഒരു പ്രത്യേക രീതിയില്‍ ക്രമീകരിച്ചിരിക്കുന്നു. നിരയില്‍ വിട്ടുപോയ സംഖ്യ ഏതെന്ന് കണ്ടുപിടിക്കുക 12;21;33;23;32;-----?', 1, 1, 1, 1, 1, NULL, '46*55*65*75', '55', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(329, 'സിംല കുളുവിനേക്കാളും തണുപ്പുള്ളതും; ശ്രീനഗര്‍ ഷില്ലോംഗിനേക്കാളും തണുപ്പുള്ളതും; നൈനിറ്റാള്‍ സിംലയെക്കാളും തണുപ്പുള്ളതും പക്ഷേ ഷില്ലോംഗിനേക്കാളും ചൂടുള്ളതുമാണെങ്കില്‍ ഏറ്റവും ചൂടുള്ള സ്ഥലമേത്?', 1, 1, 1, 1, 1, NULL, 'സിംല*നൈനിറ്റാള്‍*കുളു*ഷില്ലോംഗ്', 'കുളു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(330, 'താഴെ കൊടുത്തിരിക്കുന്ന ഖണ്ഡിക വായിച്ച് അതിനെ അടിസ്ഥാനപ്പെടുത്തി ചോദിച്ചിട്ടുള്ള ചോദ്യത്തിന് ഉത്തരം കാണുക? ഒരു ചോദ്യക്കടലാസില്‍ 12 ചോദ്യങ്ങളാണുള്ളത്. ഇതില്‍ ആറെണ്ണത്തിന്റെ ഉത്തരം എഴുതണം.ആറു ചോദ്യങ്ങള്‍ക്ക് ഓരോ ചോയ്‌സും ഉണ്ട്. ഓരോ ചോദ്യത്തിന് നാലു ഭാഗങ്ങളുണ്ട്. അതില്‍ മൂന്നെണ്ണത്തിന് ഉത്തരം എഴുതണം. ഇതില്‍ എത്രഭാഗങ്ങള്‍ക്ക് ഉത്തരമെഴുതണം?', 1, 1, 1, 1, 1, NULL, '6*12*15*18', '18', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(331, 'താഴെകാണുന്ന അക്ഷരശ്രേണിയില്‍ വിട്ടുപോയ അക്ഷരക്കൂട്ടം ഏതെന്നു കണ്ടുപിടിക്കുക:    ------;fmt; kry; pwd; ubi', 1, 1, 1, 1, 1, NULL, 'aho*ago*afo*ako', 'aho', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(332, 'സമയമെന്തായി എന്ന ചോദ്യത്തിന് ഒരാള്‍ മറുപടി നല്‍കി;ദിവസത്തില്‍ പിന്നിട്ട സമയത്തിന്റെ ഏഴിലൊന്നും അവശേഷിക്കുന്ന സമയവും തുല്യം. സമയമെന്തായിരിക്കും?', 1, 1, 1, 1, 1, NULL, '3pm*9pm*4pm*9am', '9pm', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(333, 'Aയുടെ പ്രായം Bയുടെ ഇരട്ടിയാണ്. 8 കൊല്ലം മുമ്പ് Aയുടെ പ്രായം Bയുടെ മൂന്നുമടങ്ങായിരുന്നെങ്കില്‍ Aയുടെ പ്രായം എന്ത്?', 1, 1, 1, 1, 1, NULL, '32*16*9*8', '32', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(334, 'HOTEL എന്നത് 60 ആയും CAR എന്നത് 22 ആയും കോഡ് ചെയ്താല്‍ SCOOTER എന്നതിന് എന്തെഴുതും?', 1, 1, 1, 1, 1, NULL, '33*44*81*95', '95', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(335, '1+2=31; 2+3=51; 3+4=71 ആയാല്‍ 4+5=-------?', 1, 1, 1, 1, 1, NULL, '81*91*61*51', '91', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(336, 'താഴെ നാല് അക്ഷരക്കൂട്ടങ്ങള്‍ കൊടുത്തിട്ടുണ്ട്. ഇവയില്‍ ഒരെണ്ണം മറ്റു മൂന്നില്‍ നിന്ന് ചില കാര്യങ്ങളില്‍ വ്യത്യസ്തമായിരിക്കും. അത് ഏതെന്ന് കണ്ടുപിടിക്കുക?', 1, 1, 1, 1, 1, NULL, 'IMQU*BFJN*JNRV*GKOR', 'GKOR', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(337, 'മഹേഷ് A എന്ന സ്ഥലത്തു നിന്നു പുറപ്പെട്ട് 1 കി.്മീ. തെക്കോട്ട്ു നടന്നിട്ട് ഇടത്തോട്ട് തിരിഞ്ഞ് 1 കി.മീ. കൂടി നടക്കുന്നു. പിന്നീട് വീണ്ടും ഇടത്തോട്ടു തിരിഞ്ഞ് 1 കി.മീ. കൂടി നടക്കുന്നു. എങ്കില്‍ ഏതു ദിശയിലേക്കാണ് അയാള്‍ ഇപ്പോള്‍ പോകുന്നത്?', 1, 1, 1, 1, 1, NULL, 'വടക്ക്*കിഴക്ക്*തെക്ക്*പടിഞ്ഞാറ്', 'വടക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(338, '50 ഉദ്യോഗാര്‍ഥികള്‍ക്കുവേണ്ടി പബ്ലിക് സര്‍വീസ് കമ്മീഷന്‍ നടത്തിയ പരീക്ഷയില്‍ ഒരാള്‍ക്ക് ഇരുപതാമത്തെ റാങ്കുകിട്ടി എങ്കില്‍ താഴെനിന്നും അയാളുടെ റാങ്കെത്ര?', 1, 1, 1, 1, 1, NULL, '29*30*31*32', '31', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(339, 'ഇന്ത്യയില്‍ മുസ്ലീം ഭരണം സ്ഥാപിക്കുന്നതിനു മുമ്പ് ഭരിച്ചുകൊണ്ടിരുന്ന അവസാന ഹിന്ദുരാജാവ്?', 1, 1, 1, 1, 1, NULL, 'കനിഷ്‌കന്‍*ചന്ദ്രഗുപ്തന്‍*റാണി ലക്ഷ്മിബായി*പൃഥ്വിരാജ് ചൗഹാന്‍', 'പൃഥ്വിരാജ് ചൗഹാന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(340, 'ഇന്ത്യക്ക് സ്വാതന്ത്ര്യം ലഭിച്ച സമയത്ത് ഇന്ത്യന്‍ നാഷണല്‍ കോണ്‍ഗ്രസ് പ്രസിഡന്റ് ആരായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'ജെ.ബി.കൃപലാനി*സര്‍ദാര്‍ വല്ലഭായ് പട്ടേല്‍*ജവഹര്‍ലാല്‍ നെഹ്രു*മഹാത്മാഗാന്ധി', 'ജെ.ബി.കൃപലാനി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(341, 'സ്വപ്‌നവാസവദത്ത; ദൂതവാക്യ എന്നിവയുടെ കര്‍ത്താവ്?', 1, 1, 1, 1, 1, NULL, 'കാളിദാസന്‍*ഭാസന്‍*വ്യാസന്‍*ബാണഭട്ടന്‍', 'ഭാസന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(342, 'ലോകത്ത് ഏറ്റവും കൂടുതല്‍ മുസ്ലീം ജനസംഖ്യയുള്ള രാജ്യം?', 1, 1, 1, 1, 1, NULL, 'ഇന്തോനേഷ്യ*പാകിസ്ഥാന്‍*ബംഗ്ലാദേശ്*അഫ്ഘാനിസ്ഥാന്‍', 'ഇന്തോനേഷ്യ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(343, 'ആഗ്രാ പട്ടണത്തിന്റെ നിര്‍മാതാവ് ആര്?', 1, 1, 1, 1, 1, NULL, 'അല്ലാവുദ്ദീന്‍ ഖില്‍ജി*മുഹമ്മദ് ബിന്‍ തുഗ്ലക്ക്*സിക്കന്ദര്‍ ലോദി*ഫിറൂസ് തുഗ്ലക്ക്', 'സിക്കന്ദര്‍ലോദി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(344, 'ഇന്ത്യയിലെ ഒന്നാമത്രെ വൈസ്രോയി?', 1, 1, 1, 1, 1, NULL, 'ലോര്‍ഡ് മൗണ്ട് ബാറ്റണ്‍*ലോര്‍ഡ് മെക്കാളെ*ലോര്‍ഡ് വെല്ലിംഗ്ടണ്‍*ലോര്‍ഡ് കാനിംഗ്', 'ലോര്‍ഡ് കാനിംഗ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(345, 'ഏറ്റവും അവസാനം സ്വതന്ത്രഇന്ത്യയുമായി കൂട്ടിച്ചേര്‍ക്കപ്പെട്ട വിദേശ കോളനി?', 1, 1, 1, 1, 1, NULL, 'മാഹി*ഗോവ*പോണ്ടിച്ചേരി*ആന്‍ഡമാന്‍-നിക്കോബാര്‍', 'ഗോവ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(346, 'ക്വിറ്റ്ഇന്ത്യാ പ്രക്ഷോഭം ആരംഭിച്ചത് ------ന്റെ പരാജയത്തിനു ശേഷമായിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'ക്യാബിനറ്റ് മിഷന്‍*ക്രിപ്‌സ്മിഷന്‍*സിംലാ കോണ്‍ഫറന്‍സ്*ദണ്ഡിമാര്‍ച്ച്', 'ക്രിപ്‌സ്മിഷന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(347, 'ഇന്ത്യയും പാക്കിസ്ഥാനുമായി അഷ്‌കെന്റ് കരാര്‍ ഒപ്പിട്ടത് ഏതു വര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1964*1965*1966*1967', '1966', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(348, 'ശ്രീശങ്കരനാല്‍ സ്ഥാപിക്കപ്പെടാത്ത സന്യാസിമഠം ഏത്?', 1, 1, 1, 1, 1, NULL, 'ബദരീനാഥ്*കാലടി*ജഗന്നാഥപുരി*ദ്വാരക', 'കാലടി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(349, '''ജയ് ജവാന്‍ ജയ് കിസാന്‍'' എന്ന മുദ്രാവാക്യം ആദ്യമായി ഉയര്‍ത്തിയത് ആര്?', 1, 1, 1, 1, 1, NULL, 'ലാല്‍ ബഹാദൂര്‍ ശാസ്ത്രി*ഇന്ദിരാഗാന്ധി*ജവഹര്‍ലാല്‍നെഹ്രു*ജഗ്ജീവന്‍ റാം', 'ലാല്‍ബഹാദൂര്‍ശാസ്ത്രി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(350, 'ബൈസൈക്കിള്‍ ആദ്യമായി ഇന്ത്യയില്‍ വന്ന വര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1905*1880*1910*1890', '1890', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(351, 'ഏറ്റവും കുറഞ്ഞ പ്രായത്തില്‍ ഇന്ത്യയുടെ രാഷ്ട്രപതി ആയ വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'വി.വി.ഗിരി*കെ.ആര്‍.നാരായണന്‍*നീലം സഞ്ജീവറെഡ്ഡി*ഡോ.എസ്.രാധാകൃഷ്ണന്‍', 'നീലംസഞ്ജീവറെഡ്ഡി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(352, 'ദേശീയ രാഷ്ട്രീയത്തിലേക്കുള്ള മഹാത്മാഗാന്ധിയുടെ പ്രവേശനം താഴെ കൊടുക്കുന്നവയില്‍ ഏതില്‍ക്കൂടി ആയിരുന്നു?', 1, 1, 1, 1, 1, NULL, 'നിസ്സഹകരണപ്രസ്ഥാനം*റൗലറ്റ് സത്യാഗ്രഹം*ചമ്പാരന്‍ പ്രസ്ഥാനം*ദണ്ഡിമാര്‍ച്ച്', 'റൗലറ്റ് സത്യാഗ്രഹം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(353, '''താജ്മഹല്‍'' ഏതു നദീതീരത്ത് സ്ഥിതിചെയ്യുന്നു?', 1, 1, 1, 1, 1, NULL, 'സിന്ധു*യമുന*കാവേരി*ഗംഗ', 'യമുന', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(354, 'ഇന്ത്യയിലെ 14 ബാങ്കുകള്‍ ആദ്യമായി ദേശസാല്‍ക്കരിച്ചത്?', 1, 1, 1, 1, 1, NULL, '1969*1965*1967*1971', '1969', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(355, 'ഗിന്നസ് ബുക്ക് ഓഫ് വേള്‍ഡ് റെക്കോര്‍ഡ്‌സ് പ്രകാരം ലോകത്തിലെ ഏറ്റവും വലിയ തൊഴില്‍ ദായകന്‍?', 1, 1, 1, 1, 1, NULL, 'ഇന്ത്യന്‍ റെയില്‍വേ*ബില്‍ഗേറ്റ്‌സ്*റിലയന്‍സ്*ആരാംകോ', 'ഇന്ത്യന്‍ റെയില്‍വേ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(356, '്മൗലികാവകാശങ്ങള്‍ ഭരണഘടനയില്‍ ഉള്‍പ്പെടുത്താനുള്ള തീരുമാനം ഇന്ത്യ സ്വീകരിച്ചത് ഏതു രാജ്യത്തെ അനുകരിച്ചാണ്?', 1, 1, 1, 1, 1, NULL, 'ഫ്രാന്‍സിന്റെ ഭരണഘടന*ബ്രിട്ടന്റെ ഭരണഘടന*ജര്‍മനിയുടെ ഭരണഘടന*അമേരിക്കന്‍ ഭരണഘടന', 'അമേരിക്കന്‍ഭരണഘടന', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(357, 'ഒരാള്‍ക്ക് ഒന്നില്‍ കൂടുതല്‍ സംസ്ഥാനങ്ങളുടെ ഗവര്‍ണര്‍ പദം അലങ്കരിക്കാമോ?', 1, 1, 1, 1, 1, NULL, 'ഇല്ല*ആറുമാസത്തേക്ക്മാത്രം*സാധിക്കും*മൂന്നുമാസത്തേക്ക് മാത്രം', 'ആറുമാസത്തേക്ക് മാത്രം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(358, 'മനുഷ്യശരീരത്തില്‍ ഏറ്റവും കൂടുതല്‍ ഉള്ള മൂലകം?', 1, 1, 1, 1, 1, NULL, 'അയണ്‍*ഓക്‌സിജന്‍*നൈട്രജന്‍*ഹൈഡ്രജന്‍', 'ഓക്‌സിജന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(359, 'സാധാരണ ടൂത്ത്‌പേസ്റ്റില്‍ താഴെപറയുന്ന ഏതു രാസപദാര്‍ഥമാണ് ഉപയോഗിക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'കാത്സ്യം ഫ്‌ളൂറൈഡ്*കാത്സ്യം ഓക്‌സൈഡ്*കാത്സ്യം കാര്‍ബണേറ്റ്*കാത്സ്യം ക്ലോറൈഡ്', 'കാത്സ്യം കാര്‍ബണേറ്റ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(360, 'ലോക ജനദിനം (വേള്‍ഡ് വാട്ടര്‍ ഡേ) ആയി ആചരിക്കുന്ന ദിവസം?', 1, 1, 1, 1, 1, NULL, 'ഏപ്രില്‍ 22*സെപ്തംബര്‍ 5*മാര്‍ച്ച് 22*സെപ്തംബര്‍ 10', 'മാര്‍ച്ച് 22', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(361, '''ജാവ''എന്നാല്‍ എന്ത്?', 1, 1, 1, 1, 1, NULL, 'ഒരു പുതിയ ബ്രാന്‍ഡ് കോഫി*ഒരു കമ്പ്യൂട്ടര്‍ ലാംഗ്വേജ്*ഒരു പുതിയ ബ്രാന്‍ഡ് തേയില*ഒരു സൂപ്പര്‍ കമ്പ്യൂട്ടര്‍', 'ഒരു കമ്പ്യൂട്ടര്‍ ലാംഗ്വേജ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(362, 'ഭൂമിയുടെ ഉള്ളില്‍ (കോര്‍) ഉള്ള ഏകദേശ ചൂട്?', 1, 1, 1, 1, 1, NULL, '1000C*2000C*1200C*2600C', '2600C', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(363, 'ഇന്ത്യയുടെ വിസ്തീര്‍ണം മില്യണ്‍ ചതുരശ്ര കിലോമീറ്ററില്‍?', 1, 1, 1, 1, 1, NULL, '3.8*3.3*3.28*2.8', '3.28', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(364, 'താഴെ പറയുന്നവയില്‍ ഏതാണ് റോക്ക് കോട്ടണ്‍ എന്നറിയപ്പെടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'പരുത്തി*മൈക്ക*ഇല്‍മനൈറ്റ്*ആസ്ബസ്റ്റോസ്', 'ആസ്ബസ്‌റ്റോസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(365, 'ഇന്ത്യയില്‍ ഒരു പുതിയ സംസ്ഥാനം രൂപീകരിക്കണമെങ്കില്‍?', 1, 1, 1, 1, 1, NULL, 'പാര്‍ലമെന്റില്‍ മൂന്നില്‍ രണ്ട് ഭൂരിപക്ഷം*ഭൂരിപക്ഷം സംസ്ഥാനങ്ങള്‍ ആവശ്യപ്പെട്ടാല്‍*രാഷ്ട്രപതിയുടെ തീരുമാനമനുസരിച്ച്*പാര്‍ലമെന്റില്‍ കേവലഭൂരിപക്ഷം ഉണ്ടെങ്കില്‍', 'പാര്‍ലമെന്റില്‍ കേവലഭൂരിപക്ഷം ഉണ്ടെങ്കില്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(366, 'ഫാന്റം; മാന്‍ഡ്രേക്ക് എന്ന മാന്ത്രികന്‍ എന്നിവയുടെ സ്രഷ്ടാവ്?', 1, 1, 1, 1, 1, NULL, 'ലീഫാര്‍ക്ക്*ഹാങ് കെച്ചാം*അബു എബ്രഹാം*വാള്‍ട്ട് ഡിസ്‌നി', 'ലീഫാര്‍ക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(367, 'ചന്ദ്രന്‍ ഭൂമിയെ വലംവെയ്ക്കാന്‍ എടുക്കുന്നസമയം?', 1, 1, 1, 1, 1, NULL, '28 ദിവസം*27 ദിവസം*26 ദിവസം*28 ദിവസത്തില്‍ സ്വല്പം കുറവ്', '28ദിവസത്തില്‍ സ്വല്പം കുറവ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(368, 'ബി.സി.ജി. എടുക്കുന്നത് താഴെ പറയുന്നതില്‍ ഏതിനെ പ്രതിരോധിക്കാനാണ്?', 1, 1, 1, 1, 1, NULL, 'ട്യൂബര്‍കൂലോസിസ്*ക്യാന്‍സര്‍*ബെറിബെറി*ഹൈഡ്രോഫോബിയ', 'ട്യൂബര്‍കൂലോസിസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(369, 'ഇന്ത്യയുടെ ഏറ്റവും വലിയ കൊമേഴ്‌സ്യല്‍ ബാങ്ക് ഏതാണ്?', 1, 1, 1, 1, 1, NULL, 'ഇന്ത്യന്‍ബാങ്ക്*സ്‌റ്റേറ്റ് ബാങ്ക് ഓഫ് ഇന്ത്യ*കാനറാ ബാങ്ക്*ബാങ്ക് ഓഫ് ബറോഡ', 'സ്‌റ്റേറ്റ് ബാങ്ക് ഓഫ് ഇന്ത്യ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(370, 'ഒരു കിലോവാട്ട് 1000 വാട്ട്‌സ് ആണ്. എന്നാല്‍ ഒരു മെഗാ വാട്ട് -------വാട്ട്‌സ് ആണ്?', 1, 1, 1, 1, 1, NULL, '10000*100000*10000000*1000000', '1000000', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(371, 'ഹാന്‍സെന്‍സ് രോഗം എന്നറിയപ്പെടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'കുഷ്ഠം*ക്ഷയം*ഗോയിറ്റര്‍*ക്യാന്‍സര്‍', 'കുഷ്ഠം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(372, 'കിങ് ഓഫ് ഷാഡോസ് എന്നറിയപ്പെടുന്ന ലോക പ്രശസ്ത കലാകാരന്‍?', 1, 1, 1, 1, 1, NULL, 'വാന്‍ഗോഗ്*ഗോഗിന്‍*റംബ്രാന്‍ഡ്*പിക്കാസ്സോ', 'റംബ്രാന്‍ഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(373, 'ഫഌഗ് (Flag)കളെപ്പറ്റിയുള്ള പഠനത്തിനെ ഏത് സൂചിപ്പിക്കുന്നു?', 1, 1, 1, 1, 1, NULL, 'പാലിയന്റോളജി*ഫ്‌ളാഗോളജി*ലിതോളജി*വെക്‌സില്ലോളജി', 'വെക്‌സില്ലോളജി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(374, 'ദൂരദര്‍ശന്റെ ചിഹ്നത്തില്‍ ആലേഖനം ചെയ്തിരിക്കുന്നത് എന്താണ്?', 1, 1, 1, 1, 1, NULL, 'സത്യമേവ ജയതേ*സത്യം ധര്‍മം നീതി*സത്യം ശിവം സുന്ദരം*സത്യം വിജ്ഞാന്‍ പ്രസാരണ്‍', 'സത്യം ശിവം സുന്ദരം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(375, 'സൗരയൂഥത്തിലെ അഞ്ചാമത്തെ വലിയ ഗ്രഹം?', 1, 1, 1, 1, 1, NULL, 'ബുധന്‍*ഭൂമി*യുറാനസ്*വീനസ്', 'ഭൂമി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(376, 'ഇന്ത്യയിലെ ആദ്യത്തെ 70എം.എം. ഫീച്ചര്‍ സിനിമ ഏതാണ്?', 1, 1, 1, 1, 1, NULL, 'ഷോലെ*ഝാന്‍സി കി റാണി*ലവ് ഇന്‍ ടോക്കിയോ*എറൗണ്ട് ദി വേള്‍ഡ്', 'എറൗണ്ട് ദി വേള്‍ഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(377, 'കേരളത്തിന്റെ ഔദ്യോഗിക പുഷ്പം?', 1, 1, 1, 1, 1, NULL, 'കണിക്കൊന്ന*താമര*മുല്ലപ്പൂ*ചെമ്പകം', 'കണിക്കൊന്ന', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(378, 'ഏഷ്യന്‍ ഗെയിംസില്‍ സ്വര്‍ണമെഡല്‍ നേടിയ ആദ്യത്തെ ഇന്ത്യന്‍ വനിത ആരാണ്?', 1, 1, 1, 1, 1, NULL, 'പി.ടി.ഉഷ*ഷൈനി വില്‍സണ്‍*എം.ഡി.വത്സമ്മ*കമല്‍ജിത് സന്ധു', 'കമല്‍ജിത് സന്ധു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(379, 'ഇന്ത്യന്‍ ക്രിക്കറ്റ് കണ്‍ട്രോള്‍ ബോര്‍ഡിന്റെ ഇപ്പോഴത്തെ സെക്രട്ടറി ആരാണ്?', 1, 1, 1, 1, 1, NULL, 'സുനില്‍ ഗവാസ്‌കര്‍*സഞ്ജയ് ജഗ്ഡാലേ*ഡാല്‍മിയ*എസ്.കെ.നായര്‍', 'സഞ്ജയ് ജഗ്ഡാലേ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(380, 'വെനീസ് ഓഫ് ദി ഈസ്റ്റ് എന്നറിയപ്പെടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'ആലപ്പുഴ*കൊച്ചി*കോഴിക്കോട്*ബേപ്പൂര്‍', 'ആലപ്പുഴ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(381, 'ഏറ്റവും പഴക്കം ചെന്ന ജുതപ്പള്ളി സ്ഥിതിചെയ്യുന്ന സ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'ഗോവ*മട്ടാഞ്ചേരി*പോണ്ടിച്ചേരി*മാഹി', 'മട്ടാഞ്ചേരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(382, '2002-ലെ വയലാര്‍ അവാര്‍ഡ് ആര്‍ക്കു ലഭിച്ചു?', 1, 1, 1, 1, 1, NULL, 'റ്റി.പത്മനാഭന്‍*കോവിലന്‍*അയ്യപ്പപ്പണിക്കര്‍*എം.വി.ദേവന്‍', 'അയ്യപ്പപ്പണിക്കര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(383, 'ടെസ്റ്റ് ക്രിക്കറ്റില്‍ സെഞ്ച്വറി നേടിയ ആദ്യ ഇന്ത്യാക്കാരന്‍ ആരാണ്?', 1, 1, 1, 1, 1, NULL, 'ലാലാ അമര്‍നാഥ്*മൊഹീന്ദര്‍ അമര്‍നാഥ്*സുനില്‍ ഗവാസ്‌കര്‍*മന്‍സൂര്‍ അലിഖാന്‍ പട്ടൗഡി', 'ലാലാഅമര്‍നാഥ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(384, 'പുന്നപ്ര-വയലാര്‍ സമരം നടന്നത് ഏതുവര്‍ഷം?', 1, 1, 1, 1, 1, NULL, '1945*1946*1948*1947', '1946', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(385, 'കേരളത്തിലെ ഏറ്റവും കുറവ് ജനസംഖ്യയുള്ള താലൂക്ക്?', 1, 1, 1, 1, 1, NULL, 'കൊച്ചി*കോതമംഗലം*അമ്പലപ്പുഴ*ഇതൊന്നുമല്ല', 'ഇതൊന്നുമല്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(386, 'കേരളത്തിലെ ആദ്യത്തെ ജലവൈദ്യുതപദ്ധതി ഏതാണ്?', 1, 1, 1, 1, 1, NULL, 'ഇടുക്കി*പെരിങ്ങല്‍ക്കുത്ത്*ശബരിഗിരി*പള്ളിവാസല്‍', 'പള്ളിവാസല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(387, 'കേരളത്തിലെ ആദ്യത്തെ ഗവര്‍ണര്‍?', 1, 1, 1, 1, 1, NULL, 'ബി.രാമകൃഷ്ണറാവു*സര്‍ദാര്‍ കെ.എം.പണിക്കര്‍*ഭഗവാന്‍ സഹായി*പനമ്പിള്ളി ഗോവിന്ദമേനോന്‍', 'ബി.രാമകൃഷ്ണറാവു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(388, '2001ല്‍ മികച്ച നടനുള്ള ദേശീയ ചലച്ചിത്ര അവാര്‍ഡ് നേടിയ നടന്‍ ആരാണ്?', 1, 1, 1, 1, 1, NULL, 'മോഹന്‍ലാല്‍*മമ്മൂട്ടി*മുരളി*പ്രേംജി', 'മുരളി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(389, 'I say my prayers ---------I sleep?', 1, 1, 1, 1, 1, NULL, 'while*after*when*before', 'before', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(390, 'The higher you climb a Himalayan peak; ____you feel?', 1, 1, 1, 1, 1, NULL, 'the most cold*the colder*colder*more cold', 'thecolder', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(391, 'The workers were full of APPLAUSE for the new policy of the management?', 1, 1, 1, 1, 1, NULL, 'approval*adulation*praise*eulogy', 'praise', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(392, 'Sonu is an INVETERATE liar?', 1, 1, 1, 1, 1, NULL, 'effective*habitual*frequent*familiar', 'habitual', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(393, 'I watch televion_______I have nothing to do?', 1, 1, 1, 1, 1, NULL, 'when*where*then*now', 'when', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(394, 'The opposite of ''Ascend''is?', 1, 1, 1, 1, 1, NULL, 'detract*retreat*derange*descend', 'descent', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(395, 'Nocturnal related to?', 1, 1, 1, 1, 1, NULL, 'night time*day time*evening*afternoon', 'night time', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(396, 'He is the best speaker_______is available?', 1, 1, 1, 1, 1, NULL, 'which*that*whom*what', 'that', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(397, 'I would hurry up; if I______you?', 1, 1, 1, 1, 1, NULL, 'where*was*is*am', 'were', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(398, 'Replace the capitalised words with a suitable wingle word.''The doctor said that the would on the patient''s head was ONE THAT WOULD CAUSE DEATH?', 1, 1, 1, 1, 1, NULL, 'serious*chronic*dangerous*fatal', 'fatal', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(399, 'One word for a collection of ships?', 1, 1, 1, 1, 1, NULL, 'pack*cluster*fleet*group', 'fleet', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(400, 'Choose the worlds nearest in meaning of the capiralised words - Our college is WITHIN A STONE''S THROW from here?', 1, 1, 1, 1, 1, NULL, 'very far off*at a very short distance*two and ahalf miles away*none of the above', 'at a very short distance', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(401, 'Choose the worlds nearest in meaning of the capiralised words - He TOOK TO HEART the deathof his siter?', 1, 1, 1, 1, 1, NULL, 'was unmoved by*was ignored about*learned about*was deeply affected by', 'was deeply affected by', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL);
INSERT INTO `questions` (`id`, `question`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answers`, `answer_keys`, `question_import_id`, `option_images`, `question_status_id`, `organization_id`, `question_type_id`, `share`, `question_group_id`, `import_slno`) VALUES
(402, 'I feel ______ about what happened?', 1, 1, 1, 1, 1, NULL, 'worse*bad*worst*none of the above', 'bad', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(403, 'What is a person called when he is recovering from an illness?', 1, 1, 1, 1, 1, NULL, 'ignoramus*convalescent*epidemic*arrogant', 'convalescent', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(404, 'Fratricide is?', 1, 1, 1, 1, 1, NULL, 'killing of human being*killing of father*killing of mother*killing of brother or sister', 'killing of brother or sister', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(405, 'Wool-gathering means?', 1, 1, 1, 1, 1, NULL, 'to gather wool from sheep*day-dreaming*nightmare*none of these', 'day-dreaming', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(406, 'Epilogue is?', 1, 1, 1, 1, 1, NULL, 'introductory part of a literary work*story line of literary work*concluding part of a literary work*synopsis of a literary work', 'concluding part of a literary work', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(407, 'Horticulturist is one?', 1, 1, 1, 1, 1, NULL, 'who pretends to be good*who is very cultured*who grows flowers and fruits*none of the above', 'who grows flowers and fruits', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(408, 'Pedestrian is?', 1, 1, 1, 1, 1, NULL, 'one who makes speeches*one who is devoted to a party*one who walks along the street*one who loves mankind', 'one who walks alone the street', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(409, 'ശരിയായ രൂപം ഏത്?', 1, 1, 1, 1, 1, NULL, 'പാഠകം*പാഢകം*പാഢഗം*പാടഗം', 'പാഠകം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(410, '''ഉ'' എന്ന പ്രത്യയം ഏത് വിഭക്തിയുടേതാണ്?', 1, 1, 1, 1, 1, NULL, 'ആധാരികയുടെ*നിര്‍ദേശികയുടെ*ഉദ്ദേശികയുടെ*പ്രതിഗ്രാഹികയുടെ', 'ഉദ്ദേശികയുടെ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(411, '''ചാട്ടം''എന്ന പദം ഏതു വിഭാഗത്തില്‍ പെടുന്നു?', 1, 1, 1, 1, 1, NULL, 'ഗുണനാദം*ക്രിയാനാമം*മേയനാമം*സര്‍വനാമം', 'ക്രിയാനാമം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(412, '''ഈരേഴ്'' എന്ന പദത്തില്‍ ഉള്‍ച്ചേര്‍ന്നിരിക്കുന്ന ഭേദകം ഏതു വിഭാഗത്തില്‍പ്പെടുന്നു?', 1, 1, 1, 1, 1, NULL, 'സാംഖ്യം*ശുദ്ധം*പാരിമാണിക്കം*വിഭാവകം', 'സാംഖ്യം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(413, 'ആഗമസന്ധിക്കുള്ള ഉദാഹരണം തെരഞ്ഞെടുക്കുക?', 1, 1, 1, 1, 1, NULL, 'കടല്‍+കാറ്റ്=കടല്‍ക്കാറ്റ്*തീ+കനല്‍=തീക്കനല്‍*പോ+ഉന്നു=പോവുന്നു*അല്ല+എന്ന്=അല്ലെന്ന്', 'പോ+ഉന്നു=പോവുന്നു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(414, 'തെറ്റായവാക്യം ഏത്?', 1, 1, 1, 1, 1, NULL, 'ഉദ്ഭൂദ്ധമായ പൗരസഞ്ചയമാണ് ജനാധിപത്യ വ്യവസ്ഥിതിയുടെ അടിസ്ഥാനം*ജനാധിപത്യവും പണാധിപത്യവും തമ്മിലുള്ള അന്തരം തിരിച്ചറിയാതിരിക്കരുത്*വിരാമചിഹ്നം വാക്യസമാപ്തിയെ കുറിക്കുന്നു*ആദ്യം ചോദ്യവും പിന്നീട് ഉത്തരം എന്നതാണല്ലോ ക്രമം', 'ആദ്യം ചോദ്യവും പിന്നീട് ഉത്തരം എന്നതാണല്ലോ ക്രമം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(415, 'ശരിയായ വാക്യം എത്?', 1, 1, 1, 1, 1, NULL, 'എല്ലാം ആലോചിച്ചശേഷം അനന്തരം ഒരു തീരുമാനത്തില്‍ എത്തുക*കാറ്റാടി മരത്തിന്റെ ജന്മദേശം ആസ്‌ത്രേലിയയാണ്*ലബ്ധപ്രതിഷ്ഠ നേടി ഒരു ചിത്രകാരനാണ് അദ്ദേഹം*ഈ ചെടിയുടെ പഴം മറ്റു ചെടികളെപ്പോലെയല്ല', 'കാറ്റാടി മരത്തിന്റെ ജന്മദേശം ആസ്‌ത്രേലിയയാണ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(416, 'He decided to have a go at film making. തര്‍ജമ തെരഞ്ഞെടുക്കുക?', 1, 1, 1, 1, 1, NULL, 'ചലച്ചിത്ര നിര്‍മാണരംഗം വിട്ടുപോകാന്‍ അയാള്‍ തീരുമാനിച്ചു*ചലച്ചിത്ര നിര്‍മാണം പുനരാരംഭിക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു*ഒരു ചലച്ചിത്രം നിര്‍മ്മിക്കുന്നതെങ്ങനെ എന്നു മനസ്സിലാക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു*ചലച്ചിത്ര നിര്‍മാണത്തില്‍ ഒരു കൈ നോക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു', ' ചലച്ചിത്ര നിര്‍മാണത്തില്‍ ഒരു കൈ നോക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(417, 'They gave in after fierce resistence. തര്‍ജമ തെരഞ്ഞെടുക്കുക?', 1, 1, 1, 1, 1, NULL, 'കടുത്ത ചെറുത്തുനില്പിനുശേഷം അവര്‍ കടന്നുകളഞ്ഞു*കടുത്ത ചെറുത്തുനില്പുണ്ടായിട്ടും അവര്‍ മുന്നേറി*കടുത്ത ചെറുത്തുനില്‍പിനു ശേഷം അവര്‍ കീഴടങ്ങി*കടുത്ത ചെറുത്തുനില്പിനേയും അവര്‍ അതിജീവിച്ചു', 'കടുത്ത ചെറുത്തുനില്പിനു ശേഷം അവര്‍ കീഴടങ്ങി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(418, 'When we reach there; they will be sleeping? തര്‍ജമ തെരഞ്ഞെടുക്കുക?', 1, 1, 1, 1, 1, NULL, 'നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങും*നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങിയേക്കുമോ?*നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങുമോ?*നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങുകയായിരിക്കും', ' നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങുകയായിരിക്കും', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(419, 'താഴെക്കാണുന്ന അക്ഷരശ്രേണിയില്‍ വിട്ടുപോയ അക്ഷരക്കൂട്ടം ഏതെന്ന് കണ്ടുപിടിക്കുക. cm;hr;mw;------;wg', 1, 1, 1, 1, 1, NULL, 'rk*rm*rb*rg', 'rb', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(420, 'ഈ ചോദ്യത്തിലെ സംഖ്യകള്‍ ഒരു പ്രത്യേക രീതിയില്‍ ക്രമീകരിച്ചിരിക്കുന്നു. നിരയില്‍ വിട്ടുപോയ സംഖ്യ കണ്ടുപിടിക്കുക: 3;5;10;12;24;26;-----', 1, 1, 1, 1, 1, NULL, '32*52*72*92', '52', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(421, 'താഴെ തന്നിട്ടുള്ള ശ്രേണിയില്‍ ചില അക്ഷരങ്ങള്‍വിട്ടിരിക്കുന്നു. വിട്ടിട്ടുള്ള അക്ഷരങ്ങള്‍ ക്രമത്തില്‍ എഴുതിയിട്ടുള്ളത് ഏതെന്ന് കണ്ടുപിടിക്കുക. a-caa-bc-aa-bbbccc-aaab', 1, 1, 1, 1, 1, NULL, 'bbcaa*abcac*baacc*ccbcc', 'bbcaa', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(422, 'ഒരു കോഡനുസരിച്ച് AWAKEനെ ZVZID എന്ന് എഴുതിയാല്‍ അതേ കോഡനുസരിച്ച് FRIENDനെ എങ്ങനെ എഴുതാം?', 1, 1, 1, 1, 1, NULL, 'EQHMDE*UOHDME*EQHDMC*UQHDMF', 'EQHDMC', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(423, 'ഒരു ക്യൂബിന്റെ ഓരോ വശത്തിനും ഓരോ നിറമാണ്. ക്യൂബിന്റെ മുകള്‍വശം ചുവപ്പാണ്. നീലയ്ക്കും പച്ചയ്ക്കും ഇടക്കാണു കറുപ്പുനിറം. നീലയുടേയും പച്ചയുടേയും ഇടയ്ക്കാണു വെള്ളനിറം. മഞ്ഞനിറം ചുവപ്പിന്റെയും കറുപ്പിന്റെയും ഇടയ്ക്കായാല്‍ മഞ്ഞനിറത്തിന് എതിരെയുള്ള നിറം?', 1, 1, 1, 1, 1, NULL, 'പച്ച*നീല*ചുവപ്പ്*വെള്ള', 'വെള്ള', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(424, 'ഒരാള്‍ കിഴക്കോട്ട് 1.കി.മീ. നടന്ന് വലത്തോട്ട് തിരിഞ്ഞ് വീണ്ടും 1 കി.മീ. നടന്ന് ഇടത്തോട്ട് തിരിഞ്ഞ് 2 കി.മീ. നടന്ന് വീണ്ടും ഇടത്തോട്ട് തിരിഞ്ഞ് 5 കി.മീ. സഞ്ചരിക്കുന്നു. തുടങ്ങിയസ്ഥലത്തുനിന്നും എത്ര ദൂരത്തിലായിരിക്കും അയാള്‍?', 1, 1, 1, 1, 1, NULL, '3കി.മീ.*5കിമീ.*6കിമീ*8കിമീ', '5കിമീ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(425, 'A;B;C;D;---Z എന്ന അക്ഷരക്രമത്തില്‍ ഏതക്ഷരമാണ് Jയുടെ ഇടതുള്ള മൂന്നാമത്തെ അക്ഷരത്തിന്റെ വലതുള്ള പതിനഞ്ചാമതായി വരുന്നത്?', 1, 1, 1, 1, 1, NULL, 'S*T*U*V', 'V', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(426, 'സൂര്യന് അതിന്റെ ഗ്രഹങ്ങള്‍ എന്നപോലെ ന്യൂക്ലിയസിന്------', 1, 1, 1, 1, 1, NULL, 'ആറ്റം*ഇലക്ട്രോണ്‍*ന്യൂട്രോണ്‍*പ്രോട്ടോണ്‍', 'ഇലക്ട്രോണ്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(427, 'ഒരാള്‍ അയാളുടെ മകനോടു പറയുന്നു; എനിക്ക് നിന്റെ വയസ്സുള്ളപ്പോള്‍ നിനക്കെന്തുപ്രായമുണ്ടായിരുന്നോ അതിന്റെ ഇരട്ടി വയസ്സുണ്ടെനിക്കിപ്പോള്‍. അവര്‍ രണ്ടുപേരുടെയും വയസ്സിന്റെ തുക 112 ആയാല്‍; മകന്റെ വയസ്സ്?', 1, 1, 1, 1, 1, NULL, '40*42*44*48', '48', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(428, 'ഒരു ദമ്പതിക്ക് അഞ്ചു കല്യാണമായ പുത്രന്മാര്‍ ഉണ്ട്. ഓരോ പുത്രനും നാലുകുട്ടികള്‍ വീതമുണ്ട്. ആ കുടുംബത്തിലെ ആകെ അംഗങ്ങളുടെ എണ്ണം?', 1, 1, 1, 1, 1, NULL, '20*25*32*30', '32', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(429, 'കാഴ്ച കണ്ണിനെന്നപോലെയാണ് സ്പര്‍ശത്തിന്-----', 1, 1, 1, 1, 1, NULL, 'ത്വക്ക്*വിരല്‍*സമ്പര്‍ക്കം*ദര്‍ശനം', 'ത്വക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(430, 'സ്വര്‍ണത്തിന് ഖനി എന്നപോലെയാണ് വെള്ളത്തിന്------', 1, 1, 1, 1, 1, NULL, 'ആറ്*കുളം*ടാപ്പ്*കിണര്‍', 'കിണര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(431, 'ആദ്യത്തെ രണ്ടു വാക്കുകള്‍ തമ്മിലുള്ള ബന്ധം ശ്രദ്ധിക്കുക. അതുപോലെ മൂന്നാമത്തെ വാക്കുമായി ബന്ധമുള്ള വാക്ക് കണ്ടുപിടിക്കുക: ചിട്ട:പട്ടാളം: : സ്‌നേഹം:------', 1, 1, 1, 1, 1, NULL, 'കുടുംബം*പ്രേമം*ഫിലിം*പോലീസ്', 'കുടുംബം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(432, 'താഴെ തന്നിരിക്കുന്ന നാലു വാക്കുകളില്‍ മൂന്നെണ്ണം തമ്മില്‍ ഒരു സാദൃശ്യം ഉണ്ട്. സാദൃശ്യമില്ലാത്തതു കണ്ടുപിടിക്കുക', 1, 1, 1, 1, 1, NULL, 'കേരളം*തമിഴ്‌നാട്*കര്‍ണാടക*ന്യൂഡല്‍ഹി', 'ന്യൂഡല്‍ഹി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(433, 'രാജുവും മോഹനും ക്രിക്കറ്റും ടെന്നീസും കളിക്കും; മോഹനും പ്രദീപും ടെന്നീസും ഫുട്‌ബോളും കളിക്കും; പ്രദീപും കുമാറും ഫുട്‌ബോളും ഹോക്കിയും കളിക്കും; രാജുവും കുമാറും ഹോക്കിയും ക്രിക്കറ്റും കളിക്കും. എന്നാല്‍ ക്രിക്കറ്റ്; ടെന്നീസ്; ഫുട്‌ബോള്‍ ഇവ മൂന്നും കളിക്കുന്ന കളിക്കാരന്‍?', 1, 1, 1, 1, 1, NULL, 'മോഹന്‍*രാജു*പ്രദീപ്*കുമാര്‍', 'മോഹന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(434, '3x2=46; 3x1=26; 2x5=104 ആയാല്‍ 7x2=------', 1, 1, 1, 1, 1, NULL, '28*50*54*98', '54', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(435, 'ഒരു ക്ലാസ്സിലെ നാലുകുട്ടികള്‍ ഒരു ബഞ്ചില്‍ ഇരിക്കുന്നു. സുനില്‍; മാത്യുവിന്റെ ഇടതുവശത്തും റഹിമിന്റെ വലതുവശത്തുമാണ്. അനിലിന്റെ ഇടത്തുവശത്താണ് റഹിം. ആരാണ് ഏറ്റവും ഇടത്തുവശത്തിരിക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'റഹിം*സുനില്‍*മാത്യു*അനില്‍', 'റഹിം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(436, 'താഴെ നാല് അക്ഷരങ്ങള്‍ കൊടുത്തിട്ടുണ്ട്. ഇവയിലൊരെണ്ണം മറ്റു മൂന്നില്‍ നിന്നും ചില കാര്യങ്ങളില്‍ വ്യത്യസ്തമായിരിക്കും. അതേതെന്ന് കണ്ടുപിടിക്കുക?', 1, 1, 1, 1, 1, NULL, 'AEIO*UOAE*EIOU*IOUA', 'UOAE', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(437, 'ഒരു സംഖ്യയുടെ 20% നോട് 20 കൂട്ടിയാല്‍ ആ സംഖ്യ കിട്ടും. സംഖ്യയേത്?', 1, 1, 1, 1, 1, NULL, '20*25*30*40', '25', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(438, 'ബേക്കല്‍ കോട്ട സ്ഥിതിചെയ്യുന്ന ജില്ല?', 1, 1, 1, 1, 1, NULL, 'കാസര്‍കോഡ്*കണ്ണൂര്‍*കോഴിക്കോട്*വയനാട്', 'കാസര്‍കോഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(439, 'അഷ്ടാംഗഹൃദയം എന്ന ഗ്രന്ഥത്തിന്റെ രചയിതാവ്?', 1, 1, 1, 1, 1, NULL, 'വാഗ്ഭടന്‍*കാളിദാസന്‍*അഗസ്ത്യമുനി*ബാണന്‍', 'വാഗ്ഭടന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(440, 'അലിഗാര്‍ മുസ്ലീം സര്‍വകലാശാല സ്ഥാപിച്ച വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'മൗലാനാ അബ്ദുള്‍കലാം ആസാദ്*ജിന്ന സാഹിബ്*സര്‍ സയ്യദ് അഹമ്മദ്ഖാന്‍*ജവഹര്‍ലാല്‍നെഹ്‌റു', 'സര്‍സയ്യദ് അഹമ്മദ്ഖാന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(441, 'പാട്ടബാക്കി എന്ന നാടകത്തിന്റെ രചയിതാവ്?', 1, 1, 1, 1, 1, NULL, 'എന്‍.എന്‍പിള്ള*കെ.ദാമോദരന്‍*എം.ടി.വാസുദേവന്‍നായര്‍*പി.കൃഷ്ണപിള്ള', 'കെ.ദാമോദരന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(442, 'അമിതമദ്യപാനം മൂലം പ്രവര്‍ത്തനക്ഷമമല്ലാതാകുന്ന അവയവം?', 1, 1, 1, 1, 1, NULL, 'ശ്വാസകോശം*വൃക്ക*കരള്‍*ഹൃദയം', 'കരള്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(443, 'അസ്ഥികളുടെ വളര്‍ച്ചയ്ക്ക് ആവശ്യമായ വിറ്റാമിന്‍?', 1, 1, 1, 1, 1, NULL, 'വിറ്റാമിന്‍A*വിറ്റാമിന്‍D*വിറ്റാമിന്‍C*വിറ്റാമിന്‍B', 'വിറ്റാമിന്‍D', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(444, 'ഉത്തരായനരേഖ കടന്നുപോകുന്ന ഇന്ത്യന്‍ സംസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ഗുജറാത്ത്*മധ്യപ്രദേശ്*ആന്ധ്രാപ്രദേശ്*ചോദ്യംവ്യക്തമല്ല', 'ചോദ്യംവ്യക്തമല്ല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(445, 'കേന്ദ്രഭരണപ്രദേശം?', 1, 1, 1, 1, 1, NULL, 'ഡല്‍ഹി*ഗോവ*സിക്കിം*ലക്ഷദ്വീപ്', 'ലക്ഷദ്വീപ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(446, 'എം.ജി.സര്‍വകലാശാലയുടെ ചാന്‍സലര്‍?', 1, 1, 1, 1, 1, NULL, 'ഡോ.സിറിയക് തോമസ്*ഡോ.ഇക്ബാല്‍*നിഖില്‍ കുമാര്‍ *സിക്കന്തര്‍ഭക്ത്', 'നിഖില്‍ കുമാര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(447, 'വെനീസ് ഫിലിം ഫെസ്റ്റിവലില്‍ ഏറ്റവും നല്ല ചിത്രത്തിനുള്ള ഗോള്‍ഡന്‍ ലയണ്‍ അവാര്‍ഡി നേടിയ മണ്‍സൂണ്‍ വെഡ്ഡിംഗ് എന്ന ചിത്രത്തിന്റെ സംവിധായിക?', 1, 1, 1, 1, 1, NULL, 'ദീപാ മേത്ത*മീരാനായര്‍*ശബാന ആസ്മി*ഹേമമാലിനി', 'മീരാനായര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(448, 'നെഹ്രു സാക്ഷരതാ അവാര്‍ഡ് നേടിയ ആദ്യവനിത?', 1, 1, 1, 1, 1, NULL, 'മദര്‍തെരേസ*മേധാ പട്കര്‍*റൊമീല ഥാപ്പര്‍*സരോജിനി നായിഡു', 'മദര്‍തെരേസ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(449, 'വീര്‍ഭൂമി ബന്ധപ്പെട്ടിരിക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'ഇന്ദിരാഗാന്ധി*ജവഹര്‍ലാല്‍നെഹ്‌റു*രാജീവ്ഗാന്ധി*ലാല്‍ബഹദൂര്‍ശാസ്ത്രി', 'രാജീവ്ഗാന്ധി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(450, 'ഗംഗൈ കൊണ്ട ചോളന്‍ എന്ന പേര് സ്വീകരിച്ച രാജാവ്?', 1, 1, 1, 1, 1, NULL, 'കരികാല ചോളന്‍*രാജേന്ദ്ര ചോളന്‍*രാജരാജചോളന്‍*രാജാധിരാജചോളന്‍', 'രാജേന്ദ്രചോളന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(451, 'സിന്ധുനദീതടസംസ്‌കാരം വ്യാപിച്ചിരുന്ന ഒരു സ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'ഭുവനേശ്വര്‍*അയോധ്യ*ഝാര്‍വകണ്ഡ്*ലോത്തല്‍', 'ലോത്തല്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(452, 'തിയോസഫിക്കല്‍ സൊസൈറ്റിയുടെ സ്ഥാപനവുമായി ബന്ധപ്പെട്ട വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'ആനിബസന്റ്*സ്വാമി വിവേകാനന്ദന്‍*മാഡം ബ്ലാവട്‌സ്‌കി*ദയാനന്ദസരസ്വതി', 'മാഡം ബ്ലാവട്‌സ്‌കി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(453, 'ഭൂമിയുടെ ഏകദേശ ശരാശരി താപനില?', 1, 1, 1, 1, 1, NULL, '12ഡിഗ്രി സെല്‍ഷ്യസ്*75 ഡിഗ്രിസെല്‍ഷ്യസ്*90ഡിഗ്രിസെല്‍ഷ്യസ്*16ഡിഗ്രിസെല്‍ഷ്യസ്', '16ഡിഗ്രിസെല്‍ഷ്യസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(454, 'ലോകത്ത് രണ്ടാമതായി ആറ്റംബോംബ് വര്‍ഷിക്കപ്പെട്ടസ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'ഹിരോഷിമ*ടോക്കിയോ*നാഗസാക്കി*മനില', 'നാഗസാക്കി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(455, 'ലോക പരിസ്ഥിതി ദിനം?', 1, 1, 1, 1, 1, NULL, 'ജൂണ്‍5*ജൂലൈ15*ആഗസ്റ്റ്8*സെപ്തംബര്‍5', 'ജൂണ്‍5', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(456, 'മനുഷ്യന്റെ അസ്ഥികൂടത്തില്‍ ആകെ അസ്ഥികളുടെ എണ്ണം?', 1, 1, 1, 1, 1, NULL, '306*216*316*206', '206', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(457, 'ഇന്ത്യയില്‍ കടല്‍മാര്‍ഗം വന്ന ആദ്യത്തെ വിദേശികള്‍?', 1, 1, 1, 1, 1, NULL, 'അറബികള്‍*പോര്‍ച്ചുഗീസുകാര്‍*ഡച്ചുകാര്‍*ചൈനക്കാര്‍', 'പോര്‍ച്ചുഗീസുകാര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(458, 'ഹൈന്ദവ ധര്‍മോദ്ധാരകന്‍ എന്ന പേര് സ്വീകരിച്ച ഭരണാധികാരി?', 1, 1, 1, 1, 1, NULL, 'ഷാജി ബോണ്‍സ്ലേ*ഛത്രപതിശിവജി*റാണാ സംഗ*അക്ബര്‍', 'ഛത്രപതിശിവജി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(459, 'ചേരിചേരാ രാജ്യങ്ങളുടെ ആദ്യ സമ്മേളനം നടന്നസ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'ബെല്‍ഗ്രേഡ്*കെയ്‌റോ*ന്യൂഡല്‍ഹി*ജക്കാര്‍ത്ത', 'ബെല്‍ഗ്രേഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(460, 'ഏറ്റവും കൂടുതല്‍ പ്രകാശമാനമായ ഗ്രഹം?', 1, 1, 1, 1, 1, NULL, 'ബുധന്‍*ശുക്രന്‍*ശനി*ഭൂമി', 'ശുക്രന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(461, 'പാഴ്‌സികളുടെ പുണ്യഗ്രന്ഥം?', 1, 1, 1, 1, 1, NULL, 'ഹോളിഖുര്‍ആന്‍*ആദിഗ്രന്ഥം*ഗ്രന്ഥസാഹിബ്*സെന്റ്അവസ്റ്റ', 'സെന്റ്അവസ്റ്റ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(462, 'മനുഷ്യശരീരത്തിലെ വെള്ളത്തിന്റെ അളവ്?', 1, 1, 1, 1, 1, NULL, '50 ലിറ്റര്‍*75 ലിറ്റര്‍*20 ലിറ്റര്‍*40 ലിറ്റര്‍', '40 ലിറ്റര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(463, 'ഇന്ത്യന്‍ നെപ്പോളിയന്‍ എന്നറിയപ്പെടുന്ന ഭരണാധികാരി?', 1, 1, 1, 1, 1, NULL, 'ചന്ദ്രഗുപ്തന്‍*സമുദ്രഗുപ്തന്‍*അശോകന്‍*വീരപാണ്ഡ്യകട്ടബൊമ്മന്‍', 'സമുദ്രഗുപ്തന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(464, 'ജീവജാലങ്ങള്‍ ഉണ്ടായിരിക്കാന്‍ സാധ്യതയുണ്ടെന്ന് കരുതപ്പെടുന്ന ഗ്രഹം?', 1, 1, 1, 1, 1, NULL, 'വ്യാഴം*ശുക്രന്‍*ചൊവ്വ*ശനി', 'ചൊവ്വ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(465, 'എ.ഡി.1741ല്‍ മാര്‍ത്താണ്ഡവര്‍മ കുളച്ചല്‍ യുദ്ധത്തില്‍ തോല്‍പിച്ച വിദേശികള്‍?', 1, 1, 1, 1, 1, NULL, 'ഡച്ചുകാര്‍*ഫ്രഞ്ചുകാര്‍*ഇംഗ്ലീഷുകാര്‍*പോര്‍ച്ചുഗീസുകാര്‍', 'ഡച്ചുകാര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(466, 'എ.ഡി.750നും 1000നും ഇടയില്‍ വടക്കേ ഇന്ത്യയിലെ പാല സാമ്രാജ്യം നിലനിന്നിരുന്ന ഇന്നത്തെ സംസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ബീഹാര്‍*ഒറീസ*പശ്ചിമബംഗാള്‍*ഉത്തര്‍പ്രദേശ്', 'പശ്ചിമബംഗാള്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(467, 'ലോകത്തിലെ ഏറ്റവും ചെറിയ രാജ്യമായ നൗറുദ്വീപ് സ്ഥിതിചെയ്യുന്ന സമുദ്രം?', 1, 1, 1, 1, 1, NULL, 'അറ്റ്‌ലാന്റിക് സമുദ്രം*ശാന്തസമുദ്രം*ഇന്ത്യന്‍ മഹാസമുദ്രം*ആര്‍ട്ടിക് സമുദ്രം', 'ശാന്തസമുദ്രം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(468, 'ആദ്യത്തെ ഏഷ്യന്‍ ഗെയിംസ് നടന്ന രാജ്യം?', 1, 1, 1, 1, 1, NULL, 'ചൈന*ശ്രീലങ്ക*ബംഗ്ലാദേശ്*ഇന്ത്യ', 'ഇന്ത്യ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(469, 'ട്രാന്‍സ്‌ഫോമറിന്റെ ഉപയോഗം?', 1, 1, 1, 1, 1, NULL, 'കൂടിയ വോള്‍ട്ടേജ് കുറഞ്ഞ വോള്‍ട്ടേജാക്കാന്‍*DCയെ ACആക്കി മാറ്റാന്‍*കുറഞ്ഞ വോള്‍ട്ടേജ് കൂടിയ വോള്‍ട്ടേജാക്കാന്‍*യാന്ത്രികോര്‍ജം വൈദ്യുതോര്‍ജമാക്കി മാറ്റാന്‍', 'കുറഞ്ഞ വോള്‍ട്ടേജ് കൂടിയ വോള്‍ട്ടേജാക്കാന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(470, 'സഹ്യാദ്രി എന്നറിയപ്പെടുന്ന പര്‍വതനിരകള്‍?', 1, 1, 1, 1, 1, NULL, 'ഹിമാലയം*പൂര്‍വഘട്ടം*പശ്ചിമഘട്ടം*വിന്ധ്യ-സാത്പുര', 'പശ്ചിമഘട്ടം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(471, '6 മുതല്‍ 14 വയസ്സുവരെയുള്ള കുട്ടികള്‍ക്ക് സൗജന്യവും നിര്‍ബന്ധിതവുമായ വിദ്യാഭ്യാസം ഉറപ്പാക്കുന്നതിനുള്ള ഭരണഘടനാ ഭേദഗതി?', 1, 1, 1, 1, 1, NULL, '75-ാം ഭേദഗതി*93-ാം ഭേദഗതി*81-ാംഭേദഗതി*45-ാംഭേദഗതി', '93-ാംഭേദഗതി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(472, 'കേരളത്തിലെ വനഗവേഷണ കേന്ദ്രം?', 1, 1, 1, 1, 1, NULL, 'തേക്കടി*പീച്ചി*ഷോളയാര്‍*മലയാറ്റൂര്‍', 'പീച്ചി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(473, 'കേന്ദ്രഭരണ പ്രദേശത്തിലെ മുഖ്യഭരണാധികാരി?', 1, 1, 1, 1, 1, NULL, 'ലഫ്റ്റനന്റ് ഗവര്‍ണര്‍*ഡെപ്യൂട്ടി ഗവര്‍ണര്‍*ഗവര്‍ണര്‍*രാഷ്ട്രപതി', 'ലഫ്റ്റനന്റ് ഗവര്‍ണര്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(474, 'ഇന്ത്യയിലെ ഏറ്റവും വലിയ തുറമുഖം?', 1, 1, 1, 1, 1, NULL, 'മുംബൈ*കൊച്ചി*കൊല്‍ക്കത്ത*ചെന്നൈ', 'മുംബൈ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(475, 'ആയുര്‍വേദത്തെക്കുറിച്ച് പ്രതിപാദിച്ചിട്ടുള്ള വേദം?', 1, 1, 1, 1, 1, NULL, 'ഋഗ്വേദം*യജുര്‍വേദം*അഥര്‍വവേദം*സാമവേദം', 'അഥര്‍വവേദം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(476, 'ജീവിതപ്പാത എന്ന ഗ്രന്ഥത്തിന്റെ കര്‍ത്താവ്?', 1, 1, 1, 1, 1, NULL, 'തിക്കൊടിയന്‍*ഒ.വി.വിജയന്‍*എം.കെ.സാനു*ചെറുകാട്', 'ചെറുകാട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(477, 'ശ്രീനാരായണഗുരു ശിവപ്രതിഷ്ഠ നടത്തിയസ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'ചെമ്പഴന്തി*വര്‍ക്കല*കാലടി*അരുവിപ്പുറം', 'അരുവിപ്പുറം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(478, 'അശോകന്‍ ജനിച്ച രാജവംശം?', 1, 1, 1, 1, 1, NULL, 'മൗര്യരാജവംശം*ഗുപ്തരാജവംശം*ഹൂണരാജവംശം*ചേരരാജവംശം', 'മൗര്യരാജവംശം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(479, 'കേരളപാണിനി എന്നറിയപ്പെട്ടിരുന്ന സാഹിത്യകാരന്‍?', 1, 1, 1, 1, 1, NULL, 'കൊടുങ്ങല്ലൂര്‍ കുഞ്ഞിക്കുട്ടന്‍ തമ്പുരാന്‍*ഉള്ളൂര്‍ എസ്.പരമേശ്വരഅയ്യര്‍*എ.ആര്‍.രാജരാജവര്‍മ*വള്ളത്തോള്‍ നാരായണമേനോന്‍', 'എ.ആര്‍.രാജരാജവര്‍മ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(480, 'മണിനാദം എന്ന കവിതയുടെ രചയിതാവ്?', 1, 1, 1, 1, 1, NULL, 'വൈലോപ്പിള്ളി*ഇടപ്പള്ളി*ചങ്ങമ്പുഴ*പാലാ', 'ഇടപ്പള്ളി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(481, 'മഹാഭാരതത്തിലെ പര്‍വങ്ങള്‍?', 1, 1, 1, 1, 1, NULL, 'പത്ത്*പതിനാല്*ഇരുപത്തൊന്ന്*പതിനെട്ട്', 'പതിനെട്ട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(482, '100 മീറ്റര്‍ ഓട്ടത്തിന്റെ ചാമ്പ്യന്‍ മോണ്ട് ഗോമറിയുടെ ജന്മനാട്?', 1, 1, 1, 1, 1, NULL, 'അമേരിക്ക*ആസ്ത്രിയ*കെനിയ*ഐവറികോസ്റ്റ്', 'അമേരിക്ക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(483, 'പാര്‍ലമെന്റിലേക്ക് തെരഞ്ഞെടുക്കപ്പെടുന്നതിനു മുമ്പ് പ്രധാനമന്ത്രിയായ വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'ലാല്‍ബഹദൂര്‍ശാസ്ത്രി*പി.വി.നരസിംഹറാവു*ഐ.കെ.ഗുജ്‌റാള്‍*എച്ച്.ഡി.ദേവഗൗഡ', 'എച്ച്.ഡി.ദേവഗൗഡ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(484, 'ത്രിരത്‌നങ്ങള്‍ ബന്ധപ്പെട്ടിരിക്കുന്ന മതം?', 1, 1, 1, 1, 1, NULL, 'ഹിന്ദുമതം*ബുദ്ധമതം*ജൈനമതം*സിക്കുമതം', 'ജൈനമതം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(485, 'ഉള്ളില്‍ കഴിക്കാനുള്ള പോളിയോ വാക്‌സിന്‍ (Oral Polio Vaccine) കണ്ടുപിടിച്ച വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'ആല്‍ബര്‍ട്ട് സാബിന്‍*ലൂയി പാസ്റ്റര്‍*ജോനാസ് സാല്‍ക്*അലക്‌സാണ്ടര്‍ ഫ്‌ലെമിംഗ്', 'ആല്‍ബര്‍ട്ട് സാബിന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(486, 'He has been working here ----- 1990', 1, 1, 1, 1, 1, NULL, 'from*since*till*before', 'since', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(487, '---------by his friends; he joined the match', 1, 1, 1, 1, 1, NULL, 'having encouraged*being encouraged*encouraging*encouraged', 'encouraged', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(488, 'If you had telephoned; I------to your house', 1, 1, 1, 1, 1, NULL, 'would have come*would come*shall come*will come', 'would have come', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(489, 'Frogs--------', 1, 1, 1, 1, 1, NULL, 'growl*grunt*squeak*croak', 'croak', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(490, 'Gracious means?', 1, 1, 1, 1, 1, NULL, 'reasonable*strong and firm*famous*kind;polite and generous', 'kind;polite and generous', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(491, 'A person who helps others; especially through charitable works or donations of money is called a ------------', 1, 1, 1, 1, 1, NULL, 'proletarian*philanthropist*puritan*totalitarian', 'philanthropist', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(492, 'A person who pays too much respect to social position and wealth or who despises people of a lower social position is called a-------', 1, 1, 1, 1, 1, NULL, 'sceptic*sadist*sorcercer*snob', 'snob', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(493, 'The young one of a lion is called?', 1, 1, 1, 1, 1, NULL, 'cub*calf*kid*cold', 'cub', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(494, 'The sun ------------ when I got up', 1, 1, 1, 1, 1, NULL, 'rose*had risen*is rising*would rise', 'had risen', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(495, 'He is still ill; but -------- better than he was', 1, 1, 1, 1, 1, NULL, 'much*more*very*too', 'much', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(496, 'Sita usually ------ till midnight', 1, 1, 1, 1, 1, NULL, 'read*reads*reading*has read', 'reads', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(497, 'This car --------- to my brother', 1, 1, 1, 1, 1, NULL, 'belongs*is belonged*has belong*do not belong', 'belongs', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(498, 'His aunt ------ to see us a few days ago', 1, 1, 1, 1, 1, NULL, 'has come*had come*would come*came', 'came', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(499, 'It is difficult to -------- a conversation with all this noise around us', 1, 1, 1, 1, 1, NULL, 'carryon*carryout*carry off*carry away', 'carry on', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(500, 'By this time tomorrow; I-------- the job', 1, 1, 1, 1, 1, NULL, 'will finish*shall finish*will have finished*willbe finishing', 'will have finished', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(501, 'Mohan hasn''t answered one of the pepers satisfactorily; -----he hopes to pass in the first division', 1, 1, 1, 1, 1, NULL, 'In any case*Consequently*Neverthless*On the other hand', 'Neverthless', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(502, 'Hari''s house is bigger than-------', 1, 1, 1, 1, 1, NULL, 'my*their*our*yours', 'yours', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(503, 'Poets often draw their-------from nature', 1, 1, 1, 1, 1, NULL, 'feelings*imagination*inspiration*investigation', 'inspiration', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(504, '--------the rain stopped; the play had to be suspended', 1, 1, 1, 1, 1, NULL, 'while*when*as*until', 'until', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(505, 'The opposite of praise is:', 1, 1, 1, 1, 1, NULL, 'rude*vice*blame*stale', 'blame', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(506, 'ശരിയായ പദം തെരഞ്ഞെടുത്തെഴുതുക', 1, 1, 1, 1, 1, NULL, 'പീഢനം*പീഠനം*പീഡനം*പീടനം', 'പീഡനം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(507, 'ശരിയായ വാചകം എത്?', 1, 1, 1, 1, 1, NULL, 'ബസ്സിനുള്ളില്‍ പുകവലിക്കുകയും കൈയോ തലയോ പുറത്തിടുകയോ ചെയ്യരുത്*ഇവിടെ കുട്ടികള്‍ക്കാവശ്യമായ എല്ലാ സാധനങ്ങളും വില്‍ക്കപ്പെടുന്നു*വേറെ ഗത്യന്തരമില്ലാതെ അയാള്‍ രാജിവച്ചു*എല്ലാ ഒന്നാം തീയതിയും അമ്പലത്തില്‍ പ്രത്യേകപൂജയുണ്ട്', 'എല്ലാ ഒന്നാംതീയതിയും അമ്പലത്തില്‍ പ്രത്യേക പൂജയുണ്ട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(508, 'ശരിയായ തര്‍ജമ എഴുതുക. I was one among the rank holders', 1, 1, 1, 1, 1, NULL, 'ഞാന്‍ റാങ്കു ജേതാക്കളില്‍ ഒരാളാണ്*ഞാന്‍ റാങ്കു ജേതാക്കളുടെ ഒപ്പമുണ്ട്*ഞാന്‍ റാങ്കു ജേതാക്കളില്‍ ഒരാളായിരുന്നു*റാങ്കുജേതാക്കള്‍ എന്റെ കൂടെയുണ്ട്', 'ഞാന്‍ റാങ്കു ജേതാക്കളില്‍ ഒരാളായിരുന്നു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(509, 'Money is the root of all evils', 1, 1, 1, 1, 1, NULL, 'സകല ദോഷത്തിന്റെയും ഹേതു ധനമായിരിക്കും*ധനം ദോഷത്തിലേക്കു നയിക്കുന്നു*ധനമില്ലെങ്കില്‍ ദോഷവുമില്ല*സകല ദോഷത്തിന്റെയും ഉറവിടം ധനമാണ്', 'സകല ദോഷത്തിന്റെയും ഉറവിടം ധനമാണ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(510, 'Suresh; today you must join with us for lunch', 1, 1, 1, 1, 1, NULL, 'സുരേഷ് ഇന്ന് ഉച്ചയൂണിന് ഞങ്ങളോടൊപ്പം കൂടും*സുരേഷ്; ഇന്ന് ഉച്ചഊണ് ഞങ്ങളോടൊപ്പം നീ കഴിക്കണം*സുരേഷും; നിങ്ങളും ഇന്ന് ഞങ്ങളോടൊപ്പം ഉച്ചയൂണു കഴിക്കണം*ഇന്ന് സുരേഷ് ഞങ്ങളോടൊപ്പം ഉച്ചയൂണിനുണ്ടാകും', 'സുരേഷ്; ഇന്ന് ഉച്ചഊണ് ഞങ്ങളോടൊപ്പം നീ കഴിക്കണം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(511, 'നന്തനാര്‍ എന്ന തൂലികാനാമത്തില്‍ എഴുതുന്നത്?', 1, 1, 1, 1, 1, NULL, 'പി.സി.ഗോപാലന്‍*പി.സി.കുട്ടികൃഷ്ണന്‍*അച്യുതന്‍ നമ്പൂതിരി*കെ.കൃഷ്ണന്‍ നായര്‍', 'പി.സി.ഗോപാലന്‍', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(512, 'മുന്‍വിനയെച്ചത്തിന് ഉദാഹരണം ഏത്?', 1, 1, 1, 1, 1, NULL, 'പോയിക്കണ്ടു*പോകെ കണ്ടു*പോകവെ കണ്ടു*പോയാല്‍ കാണാം', 'പോയിക്കണ്ടു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(513, 'താഴെപറയുന്ന വാക്കുകളില്‍ ആദേശസന്ധിക്ക് ഉദാഹരണമല്ലാത്തത്?', 1, 1, 1, 1, 1, NULL, 'വെണ്ണീറ്*കണ്ണീര്*വിണ്ണാറ്*എണ്ണൂറ്', 'വിണ്ണാറ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(514, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ കേവലക്രിയ ഏത്?', 1, 1, 1, 1, 1, NULL, 'എരിക്കുക*പായിക്കുക*ഓടിക്കുക*ഭരിക്കുക', 'ഭരിക്കുക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(515, '2002-ലെ എഴുത്തച്ഛന്‍ പുരസ്‌കാരം ലഭിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'എം.മുകുന്ദന്‍*കമലാസുരയ്യ*പെരുമ്പടവം ശ്രീധരന്‍*എം.ടി.വാസുദേവന്‍നായര്‍', 'കമലാസുരയ്യ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(516, 'പണ്ഡിറ്റ് രാം നാരായൺ ഏത് സംഗീത ഉപകരണവുമായി ബന്ധപ്പെട്ടിരിക്കുന്നു?', 1, 1, 1, 1, 1, NULL, ' സിത്താർ*സരോദ്*സാരംഗി*വയലിൻ', 'സാരംഗി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(517, 'ചന്ദ്രയാൻ II ഏത് രാജ്യത്തിന്റ സഹകരണത്തോടെയാണ് പൂർത്തിയാക്കാൻ ഇന്ത്യ ലക്ഷ്യമിടുന്നത്?', 1, 1, 1, 1, 1, NULL, 'അമേരിക്ക*ചൈന*ഫ്രാൻസ്*റഷ്യ', ' റഷ്യ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(518, 'ചാരനിറത്തിലുള്ള പുസ്തകം ഏത് രാജ്യത്തിന്റെ ഔദ്യോഗിക രേഖയാണ്?', 1, 1, 1, 1, 1, NULL, 'ഇന്ത്യ*റഷ്യ*ബെൽജിയം*ജർമ്മനി', 'ബെൽജിയം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(519, 'ISRO സ്ഥാപിക്കപ്പെട്ട വർഷം?', 1, 1, 1, 1, 1, NULL, '1978*1979*1968*1969', '1969', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(520, '''ഗുലാംഗിരി'' എന്ന കൃതിയുടെ കർത്താവ്?', 1, 1, 1, 1, 1, NULL, 'അരുന്ധതി റോയ്*ജ്യോതിബാഫുലെ*മേധാപട്കർ*ബഹുഗുണ', ' ജ്യോതിബാഫുലെ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(521, 'വിംസി എന്നറിയപ്പെട്ട പത്രപ്രവർത്തകന്റെ യഥാർത്ഥ പേര്?', 1, 1, 1, 1, 1, NULL, 'സി.വി. ബാലകൃഷ്ണൻ*വി.എം. ബാലചന്ദ്രൻ*എം.ജെ. അക്ബർ*കുൽദീപ് നയ്യാർ', 'വി.എം. ബാലചന്ദ്രൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(522, '2010 ലെ ഓസ്‌ട്രേലിയൻ ഓപ്പൺ നേടിയ പുരുഷതാരം?', 1, 1, 1, 1, 1, NULL, 'റോജർ ഫെഡറൽ*ലിയാൻഡർ പെയ്‌സ്*ഡെൽ പെട്രോ*റാഫേൽ നദാൽ', 'റോജർ ഫെഡറൽ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(523, 'സാക്ഷരതയിൽ ഏറ്റവും പിന്നിൽ നിൽക്കുന്ന ഇന്ത്യൻ സംസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ഹിമാചൽ പ്രദേശ്*മധ്യപ്രദേശ്*അരുണാചൽ പ്രദേശ്*ബീഹാർ', ' ബീഹാർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(524, '2011 ൽ ജനകീയ രോഷത്തെത്തുടർന്ന് സ്ഥാനമൊഴിയേണ്ടി വന്ന ഈജിപ്തിലെ ഭരണാധികാരി?', 1, 1, 1, 1, 1, NULL, 'യാസർ അരാഫത്ത്*ഗദ്ദാഫി*ഹൊസ്‌നി മുബാറക്ക്*അബ്ദൽ നാസർ', 'ഹൊസ്‌നി മുബാറക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(525, 'ആദ്യമായി  വാറ്റ് നടപ്പിലാക്കിയ രാജ്യം?', 1, 1, 1, 1, 1, NULL, 'ഇന്ത്യ*അമേരിക്ക*ഫ്രാൻസ്*റഷ്യ', 'ഫ്രാൻസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(526, 'അട്ടപാടിയിൽ കൂടി ഒഴുകുന്ന നദി?', 1, 1, 1, 1, 1, NULL, 'പാമ്പാർ*കബനി*കുന്തി*ശിരുവാണി', 'ശിരുവാണി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(527, 'കേരളത്തിലാദ്യമായി വോട്ടിങ് യന്ത്രമുപയോഗിച്ച് തിരഞ്ഞെടുപ്പ് നടന്ന സ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'നോർത്ത് പറവൂർ*തിരുവനന്തപുരം വെസ്റ്റ്*കാസർഗോഡ്*ആറ്റിങ്ങൽ', 'നോർത്ത് പറവൂർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(528, 'ആലപ്പുഴ നഗരം സ്ഥാപിച്ചതാര്?', 1, 1, 1, 1, 1, NULL, ' രാജ രവിവർമ്മ*രാജാ കേശവദാസ്*രാമരാജ ബഹദൂർ*രാജാ മാർത്താണ്ഡവർമ്മ', 'രാജാ കേശവദാസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(529, 'കേരളത്തിലെ ചവിട്ടുനാടകം ഏത് രാജ്യത്തിന്റെ സംഭാവനയാണ്?', 1, 1, 1, 1, 1, NULL, 'പോർച്ചുഗൽ*ബ്രിട്ടൺ*ഫ്രാൻസ്*നെതർലാന്റ്', 'പോർച്ചുഗൽ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL);
INSERT INTO `questions` (`id`, `question`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answers`, `answer_keys`, `question_import_id`, `option_images`, `question_status_id`, `organization_id`, `question_type_id`, `share`, `question_group_id`, `import_slno`) VALUES
(530, 'സി.വി. കുഞ്ഞുരാമൻ ഏതു ദിനപത്രവുമായി ബന്ധപ്പെട്ട വ്യക്തിയാണ്?', 1, 1, 1, 1, 1, NULL, 'മലയാള മനോരമ*മാതൃഭുമി*മാധ്യമം*കേരള കൗമുദി', 'കേരള കൗമുദി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(531, 'ഇന്ത്യയിലെ ഓറഞ്ച് സിറ്റി എന്നറിയപ്പെടുന്ന നഗരം?', 1, 1, 1, 1, 1, NULL, ' ബോംബെ*ജയ്പൂർ*ഔറംഗബാദ്*നാഗ്പൂർ', 'നാഗ്പൂർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(532, 'ഇന്ത്യയിലെ ചുവന്ന നദി എന്നറിയപ്പെടുന്ന നദി?', 1, 1, 1, 1, 1, NULL, ' ഗംഗ*ബ്രഹ്മപുത്ര*ഗോദാവരി*യമുന', 'ബ്രഹ്മപുത്ര', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(533, 'പ്രസിദ്ധമായ രാജ്മഹൽ കുന്നുകൾ ഏത് സംസ്ഥാനത്തിൽ സ്ഥിതി ചെയ്യുന്നു?', 1, 1, 1, 1, 1, NULL, 'ബംഗാൾ*ജാർഖണ്ഡ്*ഒറീസ്സ*അസം', 'ജാർഖണ്ഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(534, 'അഹമ്മദാബാദ് നഗരം ഏതു വ്യവസായവുമായി ബന്ധപ്പെട്ടിരിക്കുന്നു?', 1, 1, 1, 1, 1, NULL, 'ഉരുക്ക്*ചണം*പഞ്ചസാര*തുണി', 'തുണി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(535, 'ഇന്ത്യയിലെ ആദ്യത്തെ ടെലിഗ്രാഫ് സമ്പ്രദായം ഏതു നഗരങ്ങളെ തമ്മിൽ ബന്ധിപ്പിച്ചു?', 1, 1, 1, 1, 1, NULL, 'ആഗ്ര-കൽക്കട്ട*കൽക്കട്ട-ഡൽഹി*കൽക്കട്ട-ഡയമണ്ട് ഹാർബർ*ഡൽഹി-ആഗ്ര', 'കൽക്കട്ട- ഡയമണ്ട് ഹാർബർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(536, 'ഓറൽ പോളിയോ വാക്‌സിൻ ആദ്യമായി കണ്ടെത്തിയതാര്?', 1, 1, 1, 1, 1, NULL, 'ജോണാസ് സാക്ക്*ഫഌമിങ്*ആൽബർട്ട് സാബിൻ*ലൂയി പാസ്ചർ', ' ആൽബർട്ട് സാബിൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(537, 'ഒരു ഒന്നാം വർഗ ഉത്തോലകത്തിനുദാഹരം?', 1, 1, 1, 1, 1, NULL, 'ചവണ*കത്രിക*നാരങ്ങാഞെക്കി*പാക്കുവെട്ടി', 'കത്രിക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(538, 'കാറ്റ് വഴി വിത്ത് വിതരണം നടത്തുന്ന ഒരു സസ്യം?', 1, 1, 1, 1, 1, NULL, 'തെങ്ങ്*കുരുമുളക്*ഇത്തിൾ*മുരിങ്ങ', ' മുരിങ്ങ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(539, 'ബ്രാസ് ഏതൊക്കെ ലോഹങ്ങളുടെ സങ്കരമാണ്?', 1, 1, 1, 1, 1, NULL, 'ചെമ്പ് -  ഇരുമ്പ്*ചെമ്പ് - സിങ്ക്*ചെമ്പ് - ടിൻ*ചെമ്പ് - അലുമിനിയം', 'ചെമ്പ് - സിങ്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(540, 'ഹരിതകമുള്ള ജന്തുവേത്?', 1, 1, 1, 1, 1, NULL, ' പാരമീസിയം*ഹൈഡ്ര*യുഗ്ലീന*അമീബ', 'യുഗ്ലീന', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(541, 'ആന്റിജൻ ഇല്ലാത്ത രക്തഗ്രൂപ്പ്?', 1, 1, 1, 1, 1, NULL, 'A ഗ്രൂപ്പ്*B ഗ്രൂപ്പ്* AB ഗ്രൂപ്പ്*O ഗ്രൂപ്പ്', 'O ഗ്രൂപ്പ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(542, 'ഇലകളിൽ നിർമ്മിക്കുന്ന ആഹാരം സസ്യത്തിന്റെ വിവിധ ഭാഗങ്ങളിൽ എത്തിക്കുന്ന കലയേത്?', 1, 1, 1, 1, 1, NULL, 'ഫ്‌ളോയം*പ്രോട്ടോപ്ലാസം*മൈറ്റോകോൺട്രിയ*സൈലം', 'ഫ്‌ളോയം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(543, 'ശരീരത്തിൽ രക്തത്തിന്റെ നിർമ്മാണത്തിനാവശ്യമായ ജീവകം?', 1, 1, 1, 1, 1, NULL, 'ടോക്കോഫിറോൾ*ഹീമോഗ്ലോബിൻ*ഫോളിക്കാസിഡ്*ഫില്ലോക്വിനോൺ', 'ഫോളിക്കാസിഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(544, 'സയനൈഡ് പ്രക്രിയയിലുടെ ശുദ്ധീകരിക്കുന്ന ലോഹം?', 1, 1, 1, 1, 1, NULL, 'സ്വർണം*വെള്ളി*പ്ലാറ്റിനം*സിങ്ക്', 'സ്വർണ്ണം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(545, 'ഡോട്ട്‌സ് എന്നത് ഏതു രോഗത്തിനുള്ള ചികിത്സാരീതിയാണ്?', 1, 1, 1, 1, 1, NULL, 'കുഷ്ഠം*ക്ഷയം*എയ്ഡ്‌സ്*കാൻസർ', 'ക്ഷയം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(546, 'അക്ബറിന്റെ ധനകാര്യമന്ത്രിയായിരുന്ന വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'രാജാ വീർബൽ*രാജാ മാൻസിംഗ്*രാജാ തോഡർമാൾ*രാജാ പ്രതാപ് സിംഗ്', ' രാജാ തോഡർമാൾ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(547, 'ഇറ്റലിയിലെ ഫാസിസ്റ്റ് പ്രസ്ഥാനത്തിന്റെ നേതാവ്?', 1, 1, 1, 1, 1, NULL, 'ഹിറ്റ്‌ലർ*അലക്‌സാണ്ടർ*ബിസ്മാർക്ക്*മുസ്സോളിനി', 'മുസ്സോളിനി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(548, 'ഇന്ത്യയിലെ ഒന്നാം സ്വാതന്ത്ര്യസമരം ഔദ്യോഗികമായി പൊട്ടിപ്പുറപ്പെട്ട സ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'ഡൽഹി*മീററ്റ്*പാനിപ്പത്ത്*ബോംബെ', 'മീററ്റ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(549, 'വിക്ടോറിയ രാജ്ഞിയുടെ വിളംബരവുമായി ബന്ധപ്പെട്ട ആക്ട് ഏത്?', 1, 1, 1, 1, 1, NULL, '1773ലെ ആക്ട്*1757ലെ ആക്ട്*1857ലെ ആക്ട്*1858ലെ ആക്ട്', '1858 ലെ ആക്ട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(550, 'ദത്തവകാശ നിരോധന നയം നടപ്പാക്കിയതാര്?', 1, 1, 1, 1, 1, NULL, 'വെല്ലസ്സി*ഡൽഹൗസി*റിപ്പൺ*കഴ്‌സൺ', 'ഡൽഹൗസി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(551, 'ബ്രിട്ടീഷ് ഇന്ത്യയിലെ ആദ്യത്തെ വൈസ്രോയി?', 1, 1, 1, 1, 1, NULL, 'ലിട്ടൺ*കോൺവാലീസ്*കാനിങ്*വേവൽ', 'കാനിങ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(552, 'ബർദ്ദോളി സത്യാഗ്രഹം നടന്ന വർഷം?', 1, 1, 1, 1, 1, NULL, '1928*1929*1930*1931', '1928', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(553, 'ഗാന്ധിയൻ സമരവുമായി ബന്ധപ്പെട്ട ചമ്പാരൻ ഏതു സംസ്ഥാനത്ത് സ്ഥിതി ചെയ്യുന്നു?', 1, 1, 1, 1, 1, NULL, 'ബംഗാൾ*ആസാം*ഗുജറാത്ത്*ബീഹാർ', 'ബീഹാർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(554, 'ഏകദൈവ വിശ്വാസികൾക്കൊരു സമ്മാനം എന്ന ഗ്രന്ഥം ആരുടെ രചനയാണ്?', 1, 1, 1, 1, 1, NULL, 'എം.ഡി. വാസു ഭട്ടതിരി*വി.ടി.ഭട്ടതിരി*രാജാറാം മോഹൻ റോയ്*ആനി ബസന്റ്', 'രാജാറാം മോഹൻ റോയ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(555, 'താഷ്‌കന്റ് കരാറിൽ ഒപ്പിട്ട ഇന്ത്യൻ പ്രധാനമന്ത്രി?', 1, 1, 1, 1, 1, NULL, ' ഇന്ദിരാഗാന്ധി*ലാൽ ബഹദുർ ശാസ്ത്രി*ജവഹർലാൽ നെഹ്‌റു*ചരൺസിങ്', 'ലാൽ ബഹദുർ ശാസ്ത്രി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(556, 'ഗരീബി ഹഠാവോ എന്ന മുദ്രാവാക്യം ഏത് പഞ്ചവത്സരപദ്ധതിയുമായി ബന്ധപ്പെട്ടതാണ്?', 1, 1, 1, 1, 1, NULL, '2-ാം പദ്ധതി*3-ാം പദ്ധതി*4-ാം പദ്ധതി*5-ാം പദ്ധതി', '5-ാം പദ്ധതി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(557, 'ഇന്ത്യയിലെ ആദ്യത്തെ ഇൻഷുറൻസ് കമ്പനി?', 1, 1, 1, 1, 1, NULL, 'ബോംബെ ഇൻഷുറൻസ് കമ്പനി*കൽക്കട്ട ഇൻഷുറൻസ് കമ്പനി* ഡൽഹി ഇൻഷുറൻസ് കമ്പനി*ഓറിയന്റൽ ഇൻഷുറൻസ് കമ്പനി', 'ഓറിയന്റൽ ഇൻഷുറനൻസ് കമ്പനി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(558, 'ഇന്ത്യയിലെ ഏറ്റവും വലിയ പൊതുമേഖലാ ബാങ്ക്?', 1, 1, 1, 1, 1, NULL, 'SBT*UTI*SBI*ICICI', 'SBI', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(559, 'ദേശീയ അന്ധതാ നിവാരണ പദ്ധതി ആരംഭിച്ച് വർഷം?', 1, 1, 1, 1, 1, NULL, ' 1974*1975*1976*1977', '1976', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(560, 'ഭരണഘടനയുടെ ആർട്ടിക്കിൾ 24 പ്രകാരം നിരോധിക്കപ്പെട്ടത്?', 1, 1, 1, 1, 1, NULL, 'ബാലവേല*ശൈശവ വിവാഹം*സ്ത്രീധനം*സ്ത്രീപീഢനം', 'ബാലവേല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(561, 'താഴെ കൊടുത്തിരിക്കുന്നവരിൽ മനുഷ്യാവകാശ പ്രവർത്തനവുമായി ബന്ധപ്പെട്ട വ്യക്തി?', 1, 1, 1, 1, 1, NULL, 'ബിമൽ ജലാൻ*ബീഗം ഹസ്രത്ത് മഹൽ*അരുന്ധതി റോയ്*ഗുൽസാരിലാൽ നന്ദ', 'അരുന്ധതി റോയ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(562, 'ലോക വനിതാ ദിനം?', 1, 1, 1, 1, 1, NULL, 'മാർച്ച് 7*മാർച്ച് 8*ജൂലായ് 7*ജൂലായ് 8', 'മാർച്ച് 8', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(563, 'ദേശീയ മനുഷ്യാവകാശ കമ്മീഷൻ ചെയർമാൻ?', 1, 1, 1, 1, 1, NULL, 'കെ.ജി. അടിയോടി*കെ.ജി. ബാലകൃഷ്ണൻ*ഹമീദ് അൻസാരി*കപിൽ സിബർ', 'കെ.ജി. ബാലകൃഷ്ണൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(564, 'അവൾ ഏതു സർവനാമ വിഭാഗത്തിൽപ്പെടുന്നു?', 1, 1, 1, 1, 1, NULL, 'ഉത്തമപുരുഷൻ*മധ്യമപുരുഷൻ*പ്രഥമ പുരുഷൻ*ഇതൊന്നുമല്ല', ' പ്രഥമപുരുഷൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(565, 'ആയിരത്താണ്ട് സന്ധിയേത്?', 1, 1, 1, 1, 1, NULL, 'ലോപം*ദ്വിത്വം*ആഗമം*ആദേശം', 'ആദേശം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(566, 'ശരിയായ വാ്ക്യമേത്?', 1, 1, 1, 1, 1, NULL, 'പ്രായാധിക്യമുള്ള മഹാവ്യക്തികളെ നാം ബഹുമാനിച്ചേ പറ്റൂ*പ്രായാധിക്യം ചെന്ന മഹാവ്യക്തികളെ നാം തീർച്ചയായും ബഹുമാനിച്ചേ പറ്റൂ*പ്രായാധിക്യം ചെന്ന മഹത് വ്യക്തികളെ നാം തീർച്ചയായും ബഹുമാനിച്ചേ പറ്റൂ*പ്രായാധിക്യം ചെന്ന മഹാവ്യക്തികളെ നാം ബഹുമാനിച്ചേ പറ്റൂ', 'പ്രായാധിക്യമുള്ള മഹാവ്യക്തിക്കളെ നാം ബഹുമാനിച്ചേ പറ്റൂ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(567, 'ശരിയായ പദമേത്?', 1, 1, 1, 1, 1, NULL, 'അന്തഛിദ്രം*അന്തച്ഛിദ്രം*അന്തശ്ചിദ്രം*അന്തശ്ഛിദ്രം', 'അന്തച്ഛിദ്രം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(568, 'കാറ്റ് എന്ന പദത്തിന്റെ പര്യായമല്ലാത്തതേത്?', 1, 1, 1, 1, 1, NULL, 'അനിലൻ*അനലൻ*പവനൻ*പവമാൻ', 'അനലൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(569, 'ആടുജീവിതം രചയിതാവാര്?', 1, 1, 1, 1, 1, NULL, 'സക്കറിയ*ആനന്ദ്*മേതിൽ രാധാകൃഷ്ണൻ*ബെന്യാമിൻ', 'ബെന്യാമിൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(570, 'കോവിലൻ എന്ന തൂലികാ നാമത്തിൽ അറിയപ്പെടുന്നതാര്?', 1, 1, 1, 1, 1, NULL, 'എ.അയ്യപ്പൻ*വി.വി.അയ്യപ്പൻ*അയ്യപ്പൻ പിള്ള*എ.അച്യൂതൻ', 'വി.വി.അയ്യപ്പൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(571, 'പ്രഥമ എഴുത്തച്ഛൻ പുരസ്‌കാരം ലഭിച്ചത് ആർക്ക്?', 1, 1, 1, 1, 1, NULL, 'ബാലാമണിയമ്മ*വള്ളത്തോൾ*ഇളംകുളം കുഞ്ഞൻപിള്ള*ശൂരനാട് കുഞ്ഞൻപിള്ള', 'ശൂരനാട് കുഞ്ഞൻപിള്ള', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(572, 'ശരിയായ പരിഭാഷയേത്?', 1, 1, 1, 1, 1, NULL, 'Necessity can make even the timid brave ആവശ്യം വന്നാൽ ഒന്നിനും കൊള്ളാത്തവനും ധീരനാകും*ഒന്നിനും കൊള്ളാത്തവനും ആവശ്യം വന്നാൽ ധീരനാകും*ധീരനല്ലാത്തവനും ആവശ്യം വന്നാൽ ധീരനാകും*ആവശ്യം വന്നാൽ ധീരനും ഒന്നിനും കൊള്ളാത്തവനാകും', 'ധീരനല്ലാത്തവനും ആവശ്യം വന്നാൽ ധീരനാകും', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(573, '''It is better to die like a lion than to live like as ass'' സമാനമായ പഴഞ്ചൊല്ലേത്?', 1, 1, 1, 1, 1, NULL, 'ഒരു സിംഹമായി ജീവിക്കുന്നതാണ് ഒരു കഴുതയായി ജീവിക്കുന്നതിലും നല്ലത്*ഒരു സിംഹം മരിക്കു്ന്നതിനേക്കാൾ നല്ലത് ഒരു കഴുത മരിക്കുന്നതാണ്*ഒരു സിംഹമായി മരിക്കുന്നതാണ് ഒരു കഴുതയായി ജീവിക്കുന്നതിലും നല്ലത്*ഒരു സിംഹം മരിക്കുന്നതിനേക്കാൾ വേഗത്തിൽ ഒരു കഴുത മരിക്കുന്നു', 'ഒരു സിംഹമായി മരിക്കു്ന്നതാണ് ഒരു കഴുതയായി ജീവിക്കു്ന്നതിലും നല്ലത്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(574, 'ഒരു ക്ലാസിലെ 40 കുട്ടികളുടെ ശരാശരി വയസ്സ് 10 ആണ്. ടീച്ചറുടെ വയസ്സുകൂടി കൂട്ടിയാൽ ശരാശരി വയസ്സ് 11 ആകും. ടീച്ചറുടെ വയസ്സ് എത്ര?', 1, 1, 1, 1, 1, NULL, '40*51*42*44', '51', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(575, '50000 രൂപ 8% വാർഷിക നിരക്കിൽ ഒരു ബാങ്കിൽ നിക്ഷേപിക്കുന്നു. രണ്ടു വർഷത്തേക്കു കിട്ടുന്ന കൂട്ടുപലിശ എത്ര?', 1, 1, 1, 1, 1, NULL, '4000*4320*8320*320', '8320', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(576, 'അച്ഛന്റെയും മകന്റെയും ഇപ്പോഴത്തെ വയസ്സിന്റെ അനുപാതം 6:1 ആണ്. അഞ്ച് വർഷം കഴിഞ്ഞ് അവരുടെ വയസ്സിന്റെ അനുപാതം 7:2 ആകും മകന്റെ ഇപ്പോഴത്തെ വയസ്സ് എത്ര?', 1, 1, 1, 1, 1, NULL, '4*5*6*10', '5', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(577, 'സജിൻ 800മീറ്റർ നീളമുള്ള ഒരു പാലം 8മിനിട്ടുകൊണ്ട് നടന്നു.എന്നാൽ സജിന്റെ വേഗം കി.മീ/മണിക്കൂറിൽ എത്ര?', 1, 1, 1, 1, 1, NULL, '6*6.2*7.6*8', '6', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(578, 'ഒരു സംഖ്യയുടെ75%ത്തോട് 75 കൂട്ടിയാൽ അതേ സംഖ്യ കിട്ടുന്നു. സംഖ്യ ഏത്?', 1, 1, 1, 1, 1, NULL, '750*250*150*300', '300', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(579, 'പ്രവീൺ 20000 രൂപയ്ക്കു വാങ്ങിയ ബൈക്ക് 25000 രൂപയ്ക്ക് വിറ്റു.ലാഭശതമാനം ഏത്ര?', 1, 1, 1, 1, 1, NULL, '15*20*25*30', '25', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(580, 'ഒരു സമചതുരത്തിന്റെ വികർണത്തിന്റെ നീളം 50സെ.മീ. ആയാൽ അതിന്റെ വിസ്തീർണ്ണം?', 1, 1, 1, 1, 1, NULL, '1250cm2*2500cm2*1768cm2*884cm2', '1250cm2', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(581, 'തുടർച്ചയായ രണ്ട് ഇരട്ട സംഖ്യകളുടെ വർഗങ്ങളുടെ വ്യത്യാസം 132 ആണ്. സംഖ്യകൾ ഏവ?', 1, 1, 1, 1, 1, NULL, '28;30*30;32*34;36*32;34', '32;34', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(582, '13;17;19;23;?', 1, 1, 1, 1, 1, NULL, '27*29*28*26', '29', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(583, 'ഒരു ടൂത്ത് പേസ്റ്റിൽ 25% കൂടുതൽ എന്ന് എഴുതിയിരിക്കുന്നു.എത്ര ശതമാനം കിഴിവിന് തുല്യമാണ് ഇത്?', 1, 1, 1, 1, 1, NULL, '30*25*20*15', '20', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(584, 'കോഡ് ഭാഷയിൽ 24 എന്നാൽ CAT എങ്കിൽ MAT ന്റെ കോഡ് എന്തായിരിക്കും?', 1, 1, 1, 1, 1, NULL, '34*35*36*37', '34', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(585, 'A യുടെ മകനാണ് E. Bയുടെ മകനാണ്D;E;Cയെ വിവാഹം കഴിച്ചു.B യുടെ മകളാണ് C എന്നാൽ E യുടെ ആരാണ് D?', 1, 1, 1, 1, 1, NULL, 'സഹോദരൻ*ഭാര്യാസഹോദരൻ*അമ്മാവൻ*ഭാര്യാപിതാവ്', 'ഭാര്യാസഹോദരൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(586, 'മാർച്ച് 14 ഞായർ ആയ വർഷം നവംബർ 8 ഏത് ആഴ്ച ആയിരിക്കും?', 1, 1, 1, 1, 1, NULL, 'ഞായർ*തിങ്കൾ*ചൊവ്വ*ശനി', 'തിങ്കൾ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(587, 'ENAL എന്ന വാക്കിലെ അക്ഷരങ്ങൾ ഉപയോഗിച്ച് അർത്ഥവത്തായ എത്ര വാക്കുകൾ ഉണ്ടാക്കാം. ഒരക്ഷരം ഒരു പ്രാവശ്യം മാത്രമേ ഉപയോഗിക്കാൻ പാടുള്ളൂ', 1, 1, 1, 1, 1, NULL, '4*3*2*1', '3', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(588, 'വിട്ടുപോയ സ്ഥലം പൂരിപ്പിക്കുക - മകൻ;ഭർത്താവ്;  ............. ;ഭർതൃപിതാവ്;അപ്പൂപ്പൻ', 1, 1, 1, 1, 1, NULL, 'ഭാര്യ*അമ്മ*യുവാവ്*പിതാവ്', 'പിതാവ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(589, 'February യെ Yearubrf എന്നു മാറ്റി എഴുതുമ്പോൾ November നെ എങ്ങനെ എഴുതാം?', 1, 1, 1, 1, 1, NULL, 'Rebmevon*Robemven*Robmevfn*Rebemvon', 'Robemven', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(590, 'ഒരാൾ തെക്കോട്ട് 3 കി.മീ. നടന്നു. വലത്തോട്ട് തിരിഞ്ഞ് 1 കി.മീ നടന്നു. തുടർന്ന് വലത്ത്; ഇടത്ത്; വലത്ത്; ഇടത്ത്; വലത്ത് എന്നിങ്ങനെ ഓരോ കി.മീ. വീതം നടന്നു. അവസാനം അയാൾ പുറപ്പെട്ടിടത്തു നിന്നും എത്ര അകലെ എത്തി?', 1, 1, 1, 1, 1, NULL, '4 കിമീ.*3 കി.മീ*10 കി.മീ*7 കിമീ', '4 കിമീ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(591, 'വ്യത്യസ്ഥമായത് ഏത്?', 1, 1, 1, 1, 1, NULL, '2/5*40%*0.4*0.44', '0.44', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(592, 'A;B;C;D എന്നിവർ ചീട്ടുകളിക്കുകയാണ്. A യും B യും ഒരു ടീം ആണ്. D വടക്ക് ദിശയിലേക്ക് നോക്കിയിരിക്കുന്നു. എങ്കിൽ തെക്കു ദിശയിലേക്ക് നോക്കിയിരിക്കുന്നത് ആര്?', 1, 1, 1, 1, 1, NULL, 'A*B*C*D*', 'C', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(593, 'Let me have a look.....?', 1, 1, 1, 1, 1, NULL, 'do you*will you*have you*haven''t you*', 'will you', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(594, 'Would you mind......?', 1, 1, 1, 1, 1, NULL, 'opening the window*open the window*opened the window*to open the window', 'opening the window', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(595, 'The teacher asked the students........?', 1, 1, 1, 1, 1, NULL, 'who are absent today*who were absent today*who are absent that day*who were absent that day', 'who were absent that day', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(596, 'Rajesh..........the bank in 1990?', 1, 1, 1, 1, 1, NULL, 'has joined*have joined*is joined*joined', 'joined', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(597, 'Have you got an electric banket...........your bed?', 1, 1, 1, 1, 1, NULL, 'in*at*on*for', 'on', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(598, 'He decided to fight for justice.......?', 1, 1, 1, 1, 1, NULL, 'in all costs*at all costs*to all costs*from all costs', 'at all costs', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(599, 'There is a policeman standing...........?', 1, 1, 1, 1, 1, NULL, 'at the corner*in the corner*on the corner*above the corner', 'at the corner', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(600, 'If I have the money........a car?', 1, 1, 1, 1, 1, NULL, 'I would buy*I will buy*I would have bought*bought', 'I will buy', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(601, 'I always.........my revision notes just before I got into an examination?', 1, 1, 1, 1, 1, NULL, 'go in*go at*go over*go on', 'go over', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(602, 'The belief that God is everything and everything is God..........?', 1, 1, 1, 1, 1, NULL, 'Pantheism*Atheism*Monotheism*Polytheism', 'Pantheism', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(603, 'The word nearest in meaning to ''Futile''.........?', 1, 1, 1, 1, 1, NULL, 'Fruitful*Profitable*Angry*Vain', 'Vain', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(604, 'The Correctly spelt word is........?', 1, 1, 1, 1, 1, NULL, 'emberrassmetn*embarassment*embarrassment*emberassment', 'embarrassment', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(605, 'The antonym of ''Barbarous'' is ........?', 1, 1, 1, 1, 1, NULL, 'Savage*Civilized*Rule*Harsh', 'Civilized', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(606, '''Go to the dogs'' means?', 1, 1, 1, 1, 1, NULL, 'be ruined*search*go after the dogs*run fast', 'be ruined', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(607, 'A feet of 20.........?', 1, 1, 1, 1, 1, NULL, 'stars*ants*cattles*ships', 'ships', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(608, 'Snakes.........?', 1, 1, 1, 1, 1, NULL, 'Hoot*Hiss*Squeak*Grunt', 'Hiss', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(609, '..........his popularity; he didn''t win the election?', 1, 1, 1, 1, 1, NULL, 'Though*Although*Inspite of*Despite of', 'Inspite of', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(610, 'Copper is ...........useful metal?', 1, 1, 1, 1, 1, NULL, 'an*the*that*a', 'a', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(611, 'Teaching is a ............profession?', 1, 1, 1, 1, 1, NULL, 'respectable*respective*respectful*respectfully', 'respectable', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(612, 'You had better...........?', 1, 1, 1, 1, 1, NULL, 'locked the door*locking the door*lock the door*to lock the door', 'lock the door', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(613, '‌വിവരാവകാശ നിയമം പാസ്സാക്കുവാൻ കാരണമായ പ്രസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ഷെത്കാരി സംഘടന*ഭാരതീയ കിസാൻ യൂണിയൻ*മസ്ദൂർ കിസാൻ ശക്തി സംഘതൻ*നർമ്മദാ ബചാവോ ആന്ദോളൻ', 'മസ്ദൂർ കിസാൻ ശക്തി സംഘതൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(614, 'അഞ്ചാം ഉൽപാദന ഘടകമായി കണക്കാക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'പണം*ബാങ്ക്*അധ്വാനം*മൂലധനം', 'ബാങ്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(615, '2010-ലെ സമാധാനത്തിനുളള നോബൽ സമ്മാനം ലഭിച്ചതാർക്ക്?', 1, 1, 1, 1, 1, NULL, 'ബരാക് ഒബാമ*ആങ്‌സാൻ സുകി*ഷെയ്ഖ് ഹസീന ബീഗം*ലിയോ സിയാബോ', 'ലിയോ സിയാബോ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(616, 'ഇന്ത്യയിൽ ഏറ്റവുമധികം കപ്പലണ്ടി ഉൽപാദിപ്പിക്കുന്ന സംസ്ഥാനം?', 1, 1, 1, 1, 1, NULL, 'ആന്ധ്രപ്രദേശ്*കർണാടക*ഗുജറാത്ത്*തമിഴ്‌നാട്', 'ഗുജറാത്ത്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(617, 'ഇന്ത്യയിലെ ഏറ്റവും വലിയ വിൻഡ് എനർജി ഫാം എവിടെ?', 1, 1, 1, 1, 1, NULL, 'കാസർഗോഡ്*കന്യാകുമാരി*ഹൈദരാബാദ്*ജയ്പൂർ', 'കന്യാകുമാരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(618, 'ഇൻഡ്യൻ നാഷണൽ ആർമി (INA) രൂപീകരിച്ചതാര്?', 1, 1, 1, 1, 1, NULL, 'സുഭാഷ് ചന്ദ്രബോസ്*താരകനാഥാ ദാസ്*റാഷ് ബിഹാരി ബോസ്*ക്യാപ്റ്റൻ ലക്ഷമി മോഹൻ', 'റാഷ് ബിഹാരി ബോസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(619, 'താഴെ പറയുന്നവയിൽ തുളച്ചു കയറാനുളള കഴിവ് ഏറ്റവും കൂടുതൽ ഏത് രശ്മിക്കാണ്?', 1, 1, 1, 1, 1, NULL, 'ഗാമാ രശ്മികൾ*ബീറ്റാ രശ്മികൾ*ആൽഫാ രശ്മികൾ*എക്‌സ്‌റേസ്', 'ഗാമാ രശ്മികൾ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(620, 'പക്ഷികളുടെ മുട്ടയെപ്പറ്റി പഠിക്കുന്ന ശാസ്ത്രശാഖയേത്?', 1, 1, 1, 1, 1, NULL, 'സുവോളജി*ഓവളോജി*ഫിനോളജി*ജിയോളജി', 'ഓവലോളജി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(621, 'ചന്ദ്ര എന്ന ഉപഗ്രഹം ആരുടെ സ്മരണ നിലനിർത്തുന്നതിനാണ് അമേരിക്ക വിക്ഷേപിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'ജഗദീഷ് ചന്ദ്രബോസ്*ബങ്കിം ചന്ദ്രചാറ്റർജി*ഹേം ചന്ദ്രദാസ്*ഡോ.എസ്.ചന്ദ്രശേഖരൻ', 'ഡോ.എസ്.ചന്ദ്രശേഖരൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(622, 'ദേശീയ ഉപഭോക്തൃ ദിനം?', 1, 1, 1, 1, 1, NULL, 'ഡിസംബർ 7*മാർച്ച് 10*മാർച്ച് 15*ഡിസംബർ 24', 'ഡിസംബർ 2', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(623, '2014 ലെ കോമൺവെൽ്ത്ത് ഗെയിംസ് നടക്കുന്നതെവിടെ?', 1, 1, 1, 1, 1, NULL, 'ഗ്ലാസ്‌കോ*ലണ്ടൻ*സിഡ്‌നി*ന്യൂഡൽഹി', 'ഗ്ലാസ്‌കോ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(624, 'കുത്തബ് മീനാർ ആരുടെ സ്മരണ നിലനിർത്തുന്നതിനായാണ് പണി കഴിപ്പിച്ചത്?', 1, 1, 1, 1, 1, NULL, 'കുത്തബ്ദ്ദീൻ ഐബക്*കുത്തബ്ദീൻ ഭക്തിയാർ കാകി*ഇൽത്തുമിഷ്*ബാബാ ഫരീദ്-ഉദ്-ദീൻ', 'കുത്തബ്ദീൻ ഭക്തിയാർ കാകി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(625, 'ലോകത്തിലെ ഏറ്റവും ചെറിയ സ്വാതന്ത്ര്യ റിപ്പബഌക്?', 1, 1, 1, 1, 1, NULL, 'വത്തിക്കാൻ സിറ്റി*ബ്രൂണോ*നൗറു*ഡൊമിനിക്ക', 'നൗറു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(626, 'ജൈവ കൃഷിയുടെ ഉപജ്ഞാതാവ്?', 1, 1, 1, 1, 1, NULL, 'ആൽബർട്ട് സ്റ്റുവർട്ട്*എം.എസ്.സ്വാമിനാഥൻ*സർ ആൽബർട്ട് ഹോവാർഡ്*ഫുക്കുവോക്ക', ' സർ ആൽബർട്ട് ഹോവാർഡ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(627, 'സുമംഗല എന്ന തൂലികാനാമത്തിൽ പ്രസിദ്ധയായ മലയാള എഴുത്തുകാരി?', 1, 1, 1, 1, 1, NULL, 'ലളിതാംബിക അന്തർജനം*ലീല നമ്പൂതിരിപ്പാട്*ഡോ.ലീലാവതി*മാധവിക്കുട്ടി', 'ലീല നമ്പൂതിരിപ്പാട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(628, 'ആദ്യ സാർക്ക് (SAARC) സമ്മേളനം നടന്നതെവിടെ?', 1, 1, 1, 1, 1, NULL, ' കാഠ്മണ്ഡു*ഇസ്ലാമാബാദ്*കൊളംബോ*ഡാക്ക', 'ഡാക്ക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(629, 'ഇന്ത്യൻ ഭരണഘടയിൽ എത്ര വകുപ്പാണ് തെരഞ്ഞെടുപ്പ് കമ്മീഷനെക്കുറിച്ച് പ്രതിപാദിക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, '325*316*324*327', '324', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(630, 'സ്വാതന്ത്ര്യത്തിലേയ്ക്കുളള ദീർഘയാത്ര ആരുടെ ആത്മകഥയാണ്?', 1, 1, 1, 1, 1, NULL, 'ആങ്‌സാൻ സുകി*നെൽസൺ മഡേല*സർദാർ വല്ലഭായി പട്ടേൽ*സുഭാഷ് ചന്ദ്രബോസ്', 'നെൽസൺ മഡേല', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(631, 'ATM ന്റെ പൂർണ്ണരൂപം?', 1, 1, 1, 1, 1, NULL, 'എനിടൈംമണി*ഓട്ടോമാറ്റിക്ക് ട്രാൻഫോം മെഷീൻ*ഓതറൈസ്ഡ് ടെല്ലർ മെഷീൻ*ഓട്ടോമേറ്റഡ് ടെല്ലർ മെഷീൻ', 'ഓട്ടോമേറ്റഡ് ടെല്ലർ മെഷീൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(632, 'ആദ്യത്തെ യൂത്ത് ഒളിമ്പിക്‌സ് നടന്നതെവിടെ?', 1, 1, 1, 1, 1, NULL, 'സിംഗപ്പൂർ*എതൻസ്*സിയോൾ*മെൽബൺ', 'സിംഗപ്പൂർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(633, 'ഒറ്റയ്ക്കു ലോകം ചുറ്റിയ ആദ്യ ഇന്ത്യക്കാരൻ?', 1, 1, 1, 1, 1, NULL, 'രാകേഷ് ശർമ*കമാൻഡർ ദിലീപ് ദോണ്‌ഡെ*മെഗല്ലൻ*കമാൻഡർ ദീപക് സിങ്', 'കമാൻഡർ ദിലീപ് ദോണ്‌ഡെ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(634, 'പച്ചക്കറികൾ അധിക സമയം വെളളത്തിലിട്ടു വച്ചാൽ നഷ്ടപ്പെടുന്ന വിറ്റാമിൻ ഏത്?', 1, 1, 1, 1, 1, NULL, 'വിറ്റാമിൻ സി*വിറ്റാമിൻ കെ*വിറ്റാമിൻ എ*വിറ്റാമിൻ ഡി', 'വിറ്റാമിൻ സി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(635, 'റിസർവ് ബാങ്ക് ഓഫ് ഇന്ത്യ നോട്ട് നിർമ്മാണം ആരംഭിച്ച വർഷം?', 1, 1, 1, 1, 1, NULL, '1935*1947*1956*1938', '1938', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(636, 'ഇന്ത്യയിലെ ആദ്യത്തെ ബാങ്ക്?', 1, 1, 1, 1, 1, NULL, 'ബാങ്ക് ഓഫ് ഹിന്ദുസ്ഥാൻ*നെടുങ്ങാടി ബാങ്ക്*ബാങ്ക് ഓഫ് ബംഗാൾ*സ്റ്റേറ്റ് ബാങ്ക് ഓഫ് ഇന്ത്യ', 'ബാങ്ക് ഓഫ് ഹിന്ദുസ്ഥാൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(637, 'UGC ആരംഭിച്ചത് ഏതു വിദ്യാഭ്യാസ കമ്മീഷന്റെ ശുപാർശപ്രകാരം?', 1, 1, 1, 1, 1, NULL, 'മുതലിയാർ കമ്മീഷൻ*ഹണ്ടർ കമ്മീഷൻ*കോത്താരി കമ്മീഷൻ*ഡോ.രാധാകൃഷ്ണൻ കമ്മീഷൻ', 'ഡോ.രാധാകൃഷ്ണൻ കമ്മീഷൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(638, 'ഇന്ത്യ വികസിപ്പിച്ചെടുത്ത പൈലറ്റില്ലാത്ത ചെറു വിമാനം?', 1, 1, 1, 1, 1, NULL, 'പൃഥ്വി*നേത്ര*അഗ്നി*തൃശൂൽ', 'നേത്ര', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(639, 'ഈജിപ്തിൽ നിന്നും സ്ഥാനഭ്രഷ്ടനാക്കപ്പെട്ട പ്രസിഡന്റ്?', 1, 1, 1, 1, 1, NULL, 'ഹോസ്‌നി മുബാറക്*ഷെയ്ക് മുബാറക്*ഗദ്ദാഫി*സദ്ദാം ഹുസൈൻ', 'ഹോസ്‌നി മുബാറക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(640, 'ഭൗമ ദിനം?', 1, 1, 1, 1, 1, NULL, 'ഏപ്രിൽ 22*മാർച്ച് 15*മെയ് 24*സെപ്തംബർ 8', 'ഏപ്രിൽ 22', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(641, 'പരോക്ഷ നികുതിയിൽപെടാത്തത് ഏവ?', 1, 1, 1, 1, 1, NULL, 'കസ്റ്റംസ് തീരുവ*വരുമാന നികുതി*വിൽപ്പന നികുതി*സേവന നികുതി', 'വരുമാന നികുതി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(642, 'വിക്രമാംഗ ദേവ ചരിതം എഴുതിയതാര്?', 1, 1, 1, 1, 1, NULL, 'കൽഹനൻ*ദണ്ഡിൻ*ഭാരവി*ബിൽഹനൻ', 'ബിൽഹനൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(643, 'ആധുനിക ബഹിരാകാശ നിരീക്ഷണത്തിന്റെ പിതാവ്?', 1, 1, 1, 1, 1, NULL, 'കോപ്പർ നിക്കസ്*എ.പി.ജെ.അബ്ദുൽ കലാം*ഗലീലിയോ ഗലീലി*ഐസക് ന്യൂട്ടൻ', 'കോപ്പർ നിക്കസ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(644, 'അധികാര വികേന്ദ്രീകരണം നടപ്പിലാക്കുന്നതിൽ കേരളം കണ്ടെത്തിയ മാർഗം?', 1, 1, 1, 1, 1, NULL, 'പഞ്ചായത്തീ രാജ്*ജനശ്രീ മിഷൻ*മൈക്രോ ഫിനാൻസ്*ജനകീയാസൂത്രണം', 'ജനകീയാസൂത്രണം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(645, 'മാനവവികസന സുചിക രൂപപ്പെടുത്തിയതാര്?', 1, 1, 1, 1, 1, NULL, 'മെഹബൂബ്-ഉൾ-ഹഖ്*സിയാ-ഉൾ-ഹഖ്*കെൻ സരോ - വിവാ*ആഡം സ്മിത്ത്', ' മെഹബൂബ്-ഉൾ-ഹഖ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(646, 'ഐക്യരാഷ്ടസഭയുടെ ആദ്യത്തെ ഏഷ്യക്കാരനായ സെക്രട്ടറി ജനറൽ?', 1, 1, 1, 1, 1, NULL, 'ബാൻ കി മൂൺ*യു.താന്റ്*പെരസ് ഡി-ക്യൂലർ*കോഫി - അന്നൻ', 'യു.താന്റ്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(647, 'തക്കാളി ലോകത്തിലാദ്യമായി കൃഷി ചെയ്ത സ്ഥലം?', 1, 1, 1, 1, 1, NULL, 'ഇന്ത്യ*ആഫ്രിക്ക*തെക്കെ അമേരിക്ക*അറേബ്യ', 'തെക്കെ അമേരിക്ക', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(648, 'താഴെ കൊടുത്തിരിക്കുന്ന ജില്ലകളിൽ 1949 ൽ രൂപീകൃതമാകാത്ത ജില്ല?', 1, 1, 1, 1, 1, NULL, 'തിരുവനന്തപുരം*കൊല്ലം*പാലക്കാട്*കോട്ടയം', 'പാലക്കാട്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(649, 'എനർജി കൺസർവേഷൻ ആക്ട് ഇന്ത്യയിൽ നിലവിൽ വന്നതെന്ന്?', 1, 1, 1, 1, 1, NULL, '2003 ഏപ്രിൽ*2002 ഡിസംബർ*2003 ജൂൺ*2002 മാർച്ച്', '2002 മാർച്ച്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(650, 'ഹെപ്പറ്റൈറ്റിസ് ശരീരത്തിന്റെ ഏതു ഭാഗത്തെ ബാധിക്കുന്ന അസുഖമാണ്?', 1, 1, 1, 1, 1, NULL, 'കരൾ*ശ്വാസകോശം*വയർ*ഹൃദയം', 'കരൾ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(651, 'കേരളത്തിലെ ആദ്യത്തെ വ്യവഹാരരഹിത പഞ്ചായത്ത്?', 1, 1, 1, 1, 1, NULL, 'പറവൂർ*വരവൂർ*വഴിത്തല*ചെല്ലാനം', 'വരവൂർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(652, 'ഇന്ത്യയും ചൈനയും പഞ്ചശീല തത്വങ്ങളിൽ ഒപ്പുവെച്ച വർഷം?', 1, 1, 1, 1, 1, NULL, '1955*1954*1952*1962', '1954', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(653, 'ചന്ദ്രയാൻ ചന്ദ്രപഥത്തിൽ എത്തിയതെന്ന്?', 1, 1, 1, 1, 1, NULL, '2008 നവംബർ 10*2008 നവംബർ 16*2008 നവംബർ 8*2008 നവംബർ 20', '2008 നവംബർ 8', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(654, 'സൈനികസഹായ വ്യവസ്ഥ നടപ്പിലാക്കിയ ബ്രിട്ടീഷ് ഗവർണർ ജനറൽ?', 1, 1, 1, 1, 1, NULL, 'റോബർട്ട് ക്ലൈവ്*ഡൽഹൗസി*കോൺവാലീസ്*വെല്ലസ്ലി', 'വെല്ലസ്ലി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(655, 'ഹിരാകുഡ് നദീതട പദ്ധതി ഏതു നദിയുമായി ബന്ധപ്പെട്ടിരിക്കുന്നു?', 1, 1, 1, 1, 1, NULL, 'മഹാനദി*ദാമോദർ*സത്‌ലജ്*നർമദ', 'മഹാനദി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(656, 'സ്വാതന്ത്ര ഇന്ത്യയുടെ ആദ്യത്തെ ഗവർണർ ജനറൽ?', 1, 1, 1, 1, 1, NULL, 'രാജഗോപാലാചാരി*കാനിംഗ്പ്രഭു*മൗണ്ട് ബാറ്റൻ പ്രഭു*നെഹ്‌റു', 'മൗണ്ട് ബാറ്റൻ പ്രഭു', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(657, 'പുതുതായി രൂപം കൊളളുന്ന എക്കൽ മണ്ണ് അറിയപ്പെടുന്നത് ഏതു പേരിൽ?', 1, 1, 1, 1, 1, NULL, 'ഭംഗർ*ഖാദർ*റിഗർ*ലാറ്ററൈറ്റ്', 'ഖാദർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(658, 'ഇന്ത്യയിലെ ആദ്യത്തെ ചണമിൽ സ്ഥാപിക്കപ്പെട്ടതെവിടെ?', 1, 1, 1, 1, 1, NULL, 'റിഷ്‌റ*ഹൗറ*മുംബൈ*ഗ്വാളിയാർ', 'റിഷ്‌റ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(659, 'വേനൽക്കാലത്ത് പശ്ചിമബംഗാളിൽ വീശുന്ന വരണ്ട കാറ്റ് ഏത്?', 1, 1, 1, 1, 1, NULL, 'മാംഗോ ഷവേഴ്‌സ്*ചെറി ബ്ലോസംസ്*കാൽ ബൈശാഖി*ലു', 'കാൽ ബൈശാഖി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(660, 'കേന്ദ്ര മന്ത്രിസഭയിലെ ആദ്യ മലയാളി?', 1, 1, 1, 1, 1, NULL, 'വി.കെ.കൃഷ്ണമേനോൻ*ലക്ഷമി എൻ.മേനോൻ*എം.എം.തോമസ്*ഡോ.ജോൺ മത്തായി', 'ഡോ.ജോൺ മത്തായി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(661, 'ഈയത്തിന്റെ അയിര് ഏതു പേരിലറിയപ്പെടുന്നു?', 1, 1, 1, 1, 1, NULL, 'ഗലീന*ബോക്‌സൈറ്റ്*സിഡറൈറ്റ്*ലീമൊണൈറ്റ്', 'ഗലീന', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(662, 'ഇത്തറവാടിത്ത ഘോഷണത്തെപ്പോലെ വൃത്തികെട്ടിട്ടില്ല മറ്റൊന്നുമുഴിയിൽ - ആരുടെ വരികൾ?', 1, 1, 1, 1, 1, NULL, 'എൻ.വി.കൃഷ്ണവാര്യർ*അക്കിത്തം*ഇടശ്ശേരി*വൈലോപ്പിളളി', 'ഇടശ്ശേരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(663, 'തിക്കോടിയൻ എന്ന തൂലികാനാമത്തിൽ അറിയപ്പെടുന്ന സാഹിത്യകാരൻ ആര്?', 1, 1, 1, 1, 1, NULL, 'പി.വി.അയ്യപ്പൻ*പി.കുഞ്ഞിരാമൻ നായർ*പി.സി.കുട്ടിക്കൃഷ്ണൻ*പി.കുഞ്ഞനന്തൻ നായർ', 'പി.കുഞ്ഞനന്തൻ നായർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(664, '2010-ലെ വളളത്തോൾ പുരസ്‌കാരം ലഭിച്ച കവി?', 1, 1, 1, 1, 1, NULL, 'ഒ.എൻ.വി.കുറുപ്പ്*വിഷ്ണു നാരായണൻ നമ്പൂതിരി*സുഗതകുമാരി*അക്കിത്തം അച്യുതൻ നമ്പൂതിരി', 'വിഷ്ണു നാരായണൻ നമ്പൂതിരി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(665, '''A long tongue has a short hand'' - സമാനമായ പഴഞ്ചൊല്ലേത്?', 1, 1, 1, 1, 1, NULL, 'വലിയ നാവും ചെറിയ കയ്യും*ഏറെ പറയുന്നവൻ ഒന്നും ചെയ്യില്ല*വായ ചക്കര കൈ കൊക്കര*വാചകം വലുത് പ്രവൃത്തി ചെറുത്', 'വായ ചക്കര കൈ കൊക്കര', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(666, '''He was see off by his friends in aerodrome'' - ന്റെ ശരിയായ വിവർത്തനമേത്?', 1, 1, 1, 1, 1, NULL, 'വിമാനത്താവളത്തിൽ സുഹൃത്തുക്കൾ അദ്ദേഹത്തെ യാത്രയാക്കി*അദ്ദേഹം വിമാനത്താവളത്തിൽ അദ്ദേഹത്തിന്റെ സുഹൃത്തുക്കളാൽ കാണപ്പെട്ടു*വിമാനത്താവളത്തിൽ അദ്ദേഹത്തിന്റെ സുഹൃത്തുക്കളാൽ അകലേക്കു കാണപ്പെട്ടു*വിമാനത്താവളത്തിൽ അദ്ദേഹം സുഹൃത്തുക്കൾക്കൊപ്പം കാണപ്പെട്ടു', 'വിമാനത്താവളത്തിൽ സുഹൃത്തുക്കൾ അദ്ദേഹത്തെ യാത്രയാക്കി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(667, 'രാവണൻ എന്ന രാക്ഷസൻ - അടിവരയിട്ട പദം ഏതു ശബ്ദവിഭാഗത്തിൽപെടുന്നു?', 1, 1, 1, 1, 1, NULL, 'വാചകം*വിഭക്തി*വചനം*ദ്യോതകം', 'ദ്യോതകം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(668, 'മാതാപിതാക്കൾ - സമാസം ഏത്?', 1, 1, 1, 1, 1, NULL, 'ദ്വന്ദ്വ സമാസം*ബഹുവീഹി*തൽപുരുഷൻ*ദിഗു സമാസം', 'ദ്വന്ദ്വ സമാസം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL);
INSERT INTO `questions` (`id`, `question`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answers`, `answer_keys`, `question_import_id`, `option_images`, `question_status_id`, `organization_id`, `question_type_id`, `share`, `question_group_id`, `import_slno`) VALUES
(669, 'ശരിയല്ലാത്ത പ്രയോഗമേത്?', 1, 1, 1, 1, 1, NULL, 'ചരമ വാർത്തയറിയിക്കാൻ അവൻ ഓരോ വീടും കയറിയിറങ്ങി*ചരമവാർത്തയറിയിക്കാൻ അവൻ വീടുതോറും കയറിയിറങ്ങി*ചരമവാർത്തയറിയിക്കാൻ അവൻ ഓരോ വീടുതോറും കയറിയിറങ്ങി*ചരമവാർത്തയറിയിക്കാൻ അവൻ എല്ലാ വീടും കയറിയിറങ്ങി', 'ചരമവാർത്തയറിയിക്കാൻ അവൻ ഓരോ വീടുതോറും കയറിയിറങ്ങി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(670, 'ശരിയായ പദമേത്?യാദൃച്ഛികം*യാദൃശ്ചികം*യാദൃച്ചീകം', 1, 1, 1, 1, 1, NULL, 'യാദൃശ്ശികം', 'യാദൃച്ഛികം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(671, 'താമര എന്ന പദത്തിന്റെ പര്യായം ഏത്?', 1, 1, 1, 1, 1, NULL, 'അംബരം*അംബുജം*അംശുകം*അംബുകം', 'അംബുജം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(672, 'ഒരു പുരയിടത്തിന് 70 മീറ്റർ നീളവും 45 മീറ്റർ വീതിയുമുണ്ട്. ഈ പുരയിടത്തിന്റെ മധ്യഭാഗത്തുകൂടി പരസ്പരം ലംബമായി 5 മീറ്റർ വീതിയുളള രണ്ടു റോഡുകൾ കടന്നു പോകുന്നു. ഒരു ചതുരശ്ര മീറ്ററിന് 105 രൂപ നിരക്കിൽ ഈ റോഡുകൾ നിർമ്മിക്കാൻ എത്ര രൂപ ചെലവാകും?', 1, 1, 1, 1, 1, NULL, '55000 രൂപ*57750 രൂപ*50000 രൂപ*43750 രൂപ', '57750 രൂപ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(673, 'A യുടെ വരുമാനം B യുടെ വരുമാനത്തേക്കാൾ 150 ശതമാനം കൂടുതൽ ആണെങ്കിൽ B യുടെ വരുമാനം A യുടെ വരുമാനത്തേക്കാൾ എത്ര ശതമാനം കുറവാണ്?', 1, 1, 1, 1, 1, NULL, '60%*40%*80%*150%', '60%', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(674, 'ഒരു വാഹനം 2.4 ലിറ്റർ പെട്രോൾ കൊണ്ട് 43.2 കി.മീ ദൂരം സഞ്ചരിക്കുന്നു. എങ്കിൽ ആ വാഹനത്തിന് 1 ലിറ്റർ പെട്രോൾ കൊണ്ട് എത്രദുരം സഞ്ചരിക്കാൻ കഴിയും?', 1, 1, 1, 1, 1, NULL, '17.9 കി.മീ*28 കി.മീ*18 കി.മീ*18.78 കി.മീ', '18 കി.മീ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(675, 'ഇൻഡ്യയുടെ ആദ്യത്തെ റിപ്പബഌക് ദിനമായി ആഘോഷിച്ച 1950 ജനുവരി 26 ഏതു ദിവസമാണ്?', 1, 1, 1, 1, 1, NULL, 'വെളളിയാഴ്ച*ശനിയാഴ്ച*ഞായറാഴ്ച*വ്യാഴാഴ്ച', 'വ്യാഴാഴ്ച', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(676, 'a;b;c;d;e;f;g;h;i;j എന്നീ അക്ഷരങ്ങൾ യഥാക്രമം 0;1;2;3;4;5;6;7;8;9 എന്നീ വിലകൾ ആരോപിച്ചാൽ (ha x c - fa) -- ef ന്റെ വില എന്തായിരിക്കും?', 1, 1, 1, 1, 1, NULL, '17*9*2*0', '2', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(677, 'CAT എന്ന വാക്ക് ഒരു പ്രത്യേക കോഡ് ഉപയോഗിച്ച് 24 എന്ന് എഴുതാമെങ്കിൽ BAT എന്ന വാക്കിന്റെ കോഡ് എത്ര?', 1, 1, 1, 1, 1, NULL, '27*23*36*28', '23', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(678, 'ഒറ്റയാനെ കണ്ടെത്തുക?', 1, 1, 1, 1, 1, NULL, 'കത്തി;കാടാലി;വാൾ;അമ്പ്?', 'അമ്പ്*കോടാലി*കത്തി*വാൾ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(679, 'പൂരിപ്പിക്കുക 1;3;4;8;15;27;.....?', 1, 1, 1, 1, 1, NULL, '43*50*56*42', '50', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(680, 'ശരിയായ പദം ഏത്?    ചെരുപ്പ് കുത്തി:ലെതർ :: കാർപ്പെന്റർ:', 1, 1, 1, 1, 1, NULL, 'കസേര*ഫർണിച്ചർ*ചുറ്റിക*തടി', 'തടി', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(681, '5 മുതൽ 85 വരെയുളള എണ്ണൽ സംഖ്യകളിൽ 5 കൊണ്ട് നിശ്ശേഷം ഹരിക്കാൻ കഴിയുന്ന സംഖ്യകളെ അവരോഹണക്രമത്തിൽ എഴുതിയിരിക്കുന്നു. എങ്കിൽ താഴെ നിന്നും 11-ാമത്തെ സ്ഥാനത്ത് വരുന്ന സംഖ്യ ഏത്?', 1, 1, 1, 1, 1, NULL, '70*65*75*55', '55', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(682, 'ഹരി അവന്റെ വീട്ടിൽ നിന്നും 15 കി.മീ.വടക്കോട്ട് സഞ്ചരിച്ച ശേഷം പടിഞ്ഞാറോട്ട് തിരിഞ്ഞ് 10 കി.മീ.സഞ്ചരിച്ചു. പിന്നീട് തെക്കോട്ട് തിരഞ്ഞ് 5 കി.മീ.ഉം അതിനുശേഷം കിഴക്കോട്ട് തിരിഞ്ഞ് വീണ്ടും 10 കി.മീ ഉം.സഞ്ചരിച്ചു. ഇപ്പോൾ ഹരി അവന്റെ വീട്ടിൽ നിന്നും ഏതു ദിശയിലാണ് നിൽക്കുന്നത്?', 1, 1, 1, 1, 1, NULL, 'വടക്ക്*തെക്ക്*കിഴക്ക്*പടിഞ്ഞാറ്-തെക്ക്', 'വടക്ക്', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(683, 'ഒരാൾ 5000 രൂപ 3 3/4% വാർഷിക പലിശ നിരക്കിൽ ഒരു ബാങ്കിൽ നിക്ഷേപിക്കുന്നു. മാസത്തിനുശേഷം അയാൾ നിക്ഷേപിച്ച തുകയിൽ നിന്നും 3000 രൂപയും ഒരു വർഷത്തിനുശേഷം ബാക്കി വരുന്ന തുകയും പിൻവലിക്കുന്നു. എങ്കിൽ അയാൾക്ക് പലിശയിനത്തിൽ ലഭിക്കുന്ന തുക എത്ര?', 1, 1, 1, 1, 1, NULL, '141.75 രൂപ*131.25 രൂപ*150 രൂപ*171.50 രൂപ', '131.25 രൂപ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(684, 'ട്രെയിനിൽ അടുത്തിരുന്ന് യാത്ര ചെയ്ത രാഹുലിനെ; സീത വിഷ്ണുവിനു പരിചയപ്പെടുത്തിയത് ഇങ്ങനെയാണ്: ''ഇവൻ എന്റെ ഭർത്താവിന്റെ ഭാര്യയുടെ മകന്റെ സഹോദരനാണ്'' എന്നാൽ രാഹുലിന് സീതയോടുളള ബന്ധം എന്ത?', 1, 1, 1, 1, 1, NULL, 'ഭർത്താവ്*കസിൻ*അനന്തിരവൻ*മകൻ', 'മകൻ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(685, 'തുടർച്ചയായ 4 ദിവസങ്ങളിൽ സഹീർ യഥാക്രമം 4 മണിക്കൂർ; 7  മണിക്കൂർ;3 മണിക്കൂർ;2 മണിക്കൂർ വീതം പഠിക്കുന്നു. എങ്കിൽ അവൻ ഒരു ദിവസം ശരാശരി എത്ര മണിക്കൂർ പഠിക്കുന്നു?', 1, 1, 1, 1, 1, NULL, '4 മണിക്കൂർ*2 മണിക്കൂർ*3 മണിക്കൂർ', '4 മണിക്കൂർ', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(686, '16 പേർക്ക് ഒരു ദിവസം 7 മണിക്കൂർ വച്ച് 48 ദിവസം കൊണ്ട് ഒരു പൂന്തോട്ടം നിർമ്മിക്കാൻ സാധിക്കുന്നു. അങ്ങനെയാണെങ്കിൽ 14 പേർക്ക് ഒരു ദിവസം 12 മണിക്കൂർ വച്ച് പൂന്തോട്ടം നിർമ്മാണം പൂർത്തിയാക്കാൻ എത്ര ദിവസം വേണ്ടി വരും?', 1, 1, 1, 1, 1, NULL, '30 ദിവസം*15 ദിവസം*32 ദിവസം*16 ദിവസം', '32 ദിവസം', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(687, 'ഒരു ഡസൻ ബുക്കിന് 375 രൂപ നിരക്കിൽ', 1, 1, 1, 1, 1, NULL, ' ഗോപാൽ 20 ഡസൻ ബുക്കുകൾ വാങ്ങി. ഒരു ബുക്കിന് 33 രൂപ നിരക്കിൽ വിൽക്കുകയാണെങ്കിൽ അയാൾക്കു കിട്ടുന്ന ലാഭശതമാനം എത്ര?', '5.6%*8%*14%*2%', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(688, '''x'' ന്റെ വില കാണുക   0.4:1.4::1.4: x?', 1, 1, 1, 1, 1, NULL, '0.4*1.96*6.2*4.9', '4.9', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(689, 'Where there ia a will.......?', 1, 1, 1, 1, 1, NULL, 'people help*one can*there a way*there is way', 'there is a way', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(690, 'The thief.......by the back door?', 1, 1, 1, 1, 1, NULL, 'got up*got at*got away*gets up', 'got away', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(691, 'Which of the words ios wrongly spelt?', 1, 1, 1, 1, 1, NULL, 'Magnificient*Rheumatism*Bureau*Perseverance*', 'Magnificient', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(692, '''Dog'' is to ''Puppy'' as ''Goat'' is to?', 1, 1, 1, 1, 1, NULL, 'Lamb*Kid*Kitten*Pub', 'Lamb', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(693, 'Opposite of the word ''encouraged'' is?', 1, 1, 1, 1, 1, NULL, 'couraged*incouraged*discouraged*of couraged', 'discouraged', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(694, '''Chembra Hills'' is one of .......beautiful places in Kerala?', 1, 1, 1, 1, 1, NULL, 'more*the more*much*the most', 'the most', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(695, 'Ramu..........nothing at all?', 1, 1, 1, 1, 1, NULL, 'is doing*is not doing*didnot do*do not do', 'is doing', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(696, 'Let''s go for a walk', 1, 1, 1, 1, 1, NULL, '..............?shall we*can we*should* we*let we', 'shall we', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(697, 'These are............best collection of books; I have.', 1, 1, 1, 1, 1, NULL, 'a*an*the*a few', 'the', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(698, 'My brother is going.......?', 1, 1, 1, 1, 1, NULL, 'aboard*abroad*foreign country*foreign', 'abroad', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(699, 'He told me that he...........visit UK next year?', 1, 1, 1, 1, 1, NULL, 'will*can*may*would', 'would', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(700, '''to make able'' means?', 1, 1, 1, 1, 1, NULL, 'ability*disable*capactiy*enable', 'enable', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(701, 'His ''Eagerness to know'' is superb', 1, 1, 1, 1, 1, NULL, 'curiosity*ability*fortitude*mirth', 'curiosity', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(702, '.........is a good exercise?', 1, 1, 1, 1, 1, NULL, 'Walk*Walking*Walked*Walker', 'Walking', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(703, 'It is pleasant......children playing?', 1, 1, 1, 1, 1, NULL, 'is watching*watched*to watch*watch', 'to watch', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(704, 'Will you wait...........I complete this work?', 1, 1, 1, 1, 1, NULL, 'still*till*when*where', 'till', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(705, '''Recreation'' is similar to?', 1, 1, 1, 1, 1, NULL, 'amusement*encouragement*happiness*enthusiasm', 'amusement', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(706, 'My friend.......when he heared the news?', 1, 1, 1, 1, 1, NULL, 'astonished*were astonished*was astonished*astonishment', 'was astonished', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(707, 'Sheela is not............as her sister?', 1, 1, 1, 1, 1, NULL, 'taller*taller than*tallest*as tall', 'as tall', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL),
(708, 'Twenty rupees.........not a large sum?', 1, 1, 1, 1, 1, NULL, 'are*is*will*shall', 'is', NULL, NULL, NULL, 1, NULL, 1, 0, NULL, NULL);

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
  PRIMARY KEY (`id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `question_import_id` (`question_group_import_id`),
  KEY `question_status_id` (`question_group_status_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `language_id` (`language_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_statuses`
--

CREATE TABLE IF NOT EXISTS `question_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `question_statuses`
--

INSERT INTO `question_statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE IF NOT EXISTS `question_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`id`, `name`, `description`) VALUES
(1, 'Single Answer', NULL),
(2, 'Multiple Answers', NULL);

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
  PRIMARY KEY (`id`),
  KEY `quiz_type_id` (`quiz_type_id`),
  KEY `quiz_status_id` (`quiz_status_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `quiz_type_id`, `total_time`, `quiz_status_id`, `question_ids`, `credit`, `organization_id`, `negative_marks`) VALUES
(1, 'Demo Quiz', 2, '00:05:00', 0, '1,2,3,4,5,6,7,8,9,10', 0, 0, 0);

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
  `mark` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `language_id` (`language_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_statuses`
--

CREATE TABLE IF NOT EXISTS `quiz_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quiz_statuses`
--

INSERT INTO `quiz_statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_types`
--

CREATE TABLE IF NOT EXISTS `quiz_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quiz_types`
--

INSERT INTO `quiz_types` (`id`, `name`) VALUES
(1, 'Real Quiz'),
(2, 'Demo Quiz');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `organization_id`) VALUES
(1, 'WORLD', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `organization_id`) VALUES
(1, 'GK', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `question_import_id` (`question_group_import_id`),
  KEY `question_status_id` (`question_group_status_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `language_id` (`language_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_statuses`
--

CREATE TABLE IF NOT EXISTS `test_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `test_statuses`
--

INSERT INTO `test_statuses` (`id`, `name`) VALUES
(1, 'Test Started'),
(2, 'Test Finished'),
(3, 'Test Paused'),
(4, 'Test Cancelled');

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
  PRIMARY KEY (`id`),
  KEY `user_status_id` (`user_status_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `address`, `occupation`, `user_status_id`, `organization_id`, `registration_date`, `activation_token`, `password_token`) VALUES
(1, 'tester@acube.co', 'e10adc3949ba59abbe56e057f20f883e', 'Tester', 'Acube', 'tester@acube.co', '', 'tester@acube.co', 'tester@acube.co', 1, NULL, '0000-00-00 00:00:00', NULL, NULL);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE IF NOT EXISTS `user_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`, `description`) VALUES
(1, 'Active', 'Active'),
(2, 'Waiting Email Activation', 'Email activation required'),
(3, 'Suspended', 'Suspended'),
(4, 'Disabled', 'Disabled'),
(5, 'Imported', 'Imported From CSV'),
(6, 'Mobile registration', 'Mobile registration Using sms');

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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `test_status_id` (`test_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `user_test_id` (`user_test_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
