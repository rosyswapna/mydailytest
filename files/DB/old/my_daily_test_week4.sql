-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2013 at 02:27 PM
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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, '2013-09-19 10:22:06', NULL, NULL, NULL, '2013-04-22 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `answer_keys`
--

CREATE TABLE IF NOT EXISTS `answer_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `answer_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `answer_option_id` (`answer_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answer_options`
--

CREATE TABLE IF NOT EXISTS `answer_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `option` text COLLATE utf8_unicode_ci,
  `image` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(2, 'Hindi', 0),
(3, 'Malayalam', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `organization_statuses`
--

INSERT INTO `organization_statuses` (`id`, `name`, `description`) VALUES
(1, 'Active', 'Active'),
(2, 'Waiting Email Activation', 'Email activation required'),
(3, 'Suspended', 'Suspended'),
(4, 'Disabled', 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `organization_types`
--

CREATE TABLE IF NOT EXISTS `organization_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `organization_types`
--

INSERT INTO `organization_types` (`id`, `name`, `description`) VALUES
(1, 'PO', 'Profitable Organization'),
(2, 'NPO', 'Nonprofit Organization');

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
(2, 'CCAvanue', 1),
(3, 'Cheque', 0),
(4, 'Cash', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_unicode_ci,
  `set_id` int(11) DEFAULT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8_unicode_ci,
  `answer` text COLLATE utf8_unicode_ci,
  `question_import_id` int(11) DEFAULT NULL,
  `question_status_id` int(11) NOT NULL DEFAULT '2',
  `organization_id` int(11) DEFAULT NULL,
  `share` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `difficulty_level_id` (`difficulty_level_id`),
  KEY `question_import_id` (`question_import_id`),
  KEY `question_status_id` (`question_status_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `language_id` (`language_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=419 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `set_id`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answer`, `question_import_id`, `question_status_id`, `organization_id`, `share`) VALUES
(1, 'ഐക്യരാഷ്ട്രസഭയിൽ ഏറ്റവും അവസാനമായി അംഗമായ രാജ്യം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, ' കൊാസോവാ*മോണ്ടിനെഗ്രോ*ഈസ്റ്റ് ടിമൂർ*സൗത്ത് സുഡാൻ', ' സൗത്ത് സുഡാൻ', NULL, 1, NULL, 0),
(2, 'താഴെ പറയുന്നവയിൽ സ്‌കാന്റിനേവിയൻ രാജ്യം അല്ലാത്തത് ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'സ്‌പെയിൻ*സ്വീഡൻ*നോർവ്വെ*ഡെൻമാർക്ക്', ' സ്‌പെയിൻ', NULL, 1, NULL, 0),
(3, 'ഫെയ്‌സ്ബുക്ക് എന്ന ഇന്റർനെറ്റ് കൂട്ടായ്മയുടെ സ്ഥാപകൻ ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'ജൂലിയൻ അസാൻഞ്ജ്*ബിൽഗേറ്റ്‌സ്*മാർക്ക് സക്കർബർഗ്*സബീർഭാട്ടിയ', ' മാർക്ക് സക്കർബർഗ്', NULL, 1, NULL, 0),
(4, 'ദേശീയവിജ്ഞാന കമ്മീഷൻ ചെയർമാൻ ആര്?', 1, 0, 1, 1, 1, 1, NULL, ' സാം പിത്രോഡ*എം.എസ്.സ്വാമിനാഥൻ*എം.സ് അലുവാലിയ*കെ.ജി.ബാലകൃഷ്ണൻ', ' സാംപിത്രോഡ', NULL, 1, NULL, 0),
(5, 'സമീപകാലത്തെ ഇന്ത്യാക്കാരുടേതടക്കമുള്ള നിക്ഷേപത്തിന്റെ ഇടപാട് രഹസ്യം വെളിപ്പെടുത്തിയ ബാങ്ക് ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ലക്‌സംബർഗ്*ബഹാമാസ്*ചാനൽ ഐലന്റ്*ലിച്ചൻ സ്റ്റെയിൻ', ' ലിച്ചൻ സ്റ്റെയിൻ', NULL, 1, NULL, 0),
(6, 'നെല്ലുല്ലപാദനത്തിൽ ലോകത്ത് ഒന്നാം സ്ഥാനത്ത് നില്ക്കുന്ന രാജ്യം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, ' ഇൻഡ്യ*ചൈന*യു.എസ്.എ*ബ്രസീൽ', ' ചൈന', NULL, 1, NULL, 0),
(7, 'നേപ്പാളിലെ ഇപ്പോഴത്തെ പ്രധാനമന്ത്രി ആര്?', 1, 0, 1, 1, 1, 1, NULL, ' ത്ചലാം നാഥ് ഖനാൽ*മാധവ് കുമാർ നേപ്പാൾ*പ്രചണ്ഡ*ജി.ബി.കൊയ് രാള ', ' ത്ചലാം നാഥ് ഖനാൽ', NULL, 1, NULL, 0),
(8, 'ഗൂർണിക്ക എന്ന പ്രശസ്തമായ ചിത്രം വരച്ചതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'ലിയനാർഡോ ഡാവിഞ്ചി*രാജരവിവർമ്മ* എം.എഫ്.ഹുസൈൻ*പാബ്ലോ പിക്കാസോ', ' പാബ്ലോ പിക്കാസോ', NULL, 1, NULL, 0),
(9, 'സമരം തന്നെ ജീവിതം ആരുടെ ആത്മകഥയാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ഇ.എം.എസ്*ഇ.കെ.നായനാർ*എ.കെ.ഗോപാലൻ*വി.എസ് അച്യുതാനന്ദൻ', ' വി.എസ് അച്യുതാനന്ദൻ', NULL, 1, NULL, 0),
(10, 'അരിപ്പ പക്ഷി സങ്കേതം കേരളത്തിലെ ഏതു ജില്ലയിലാണ്?', 1, 0, 1, 1, 1, 1, NULL, ' തിരുവനന്തപുരം*കൊല്ലം*പാലക്കാട്*മലപ്പുറം', ' തിരുവനന്തപുരം', NULL, 1, NULL, 0),
(11, 'ശ്രീനാരയണധർമ്മപരിപാലനയോഗം സ്ഥാപിതമായ വർഷം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, '1901*1902*1903*1904', ' 1903', NULL, 1, NULL, 0),
(12, 'കുറുവ ദ്വീപ് ഏത് നദിയിലാണ്', 1, 0, 1, 1, 1, 1, NULL, 'പമ്പാനദി*പാമ്പാർ*ഭവാനി*കബിനി', ' കബിനി', NULL, 1, NULL, 0),
(13, 'ഗാൽവനൈസേഷൻ ചെയ്യാൻ ഉപയോഗിക്കുന്ന ലേഹം ഏത്', 1, 0, 1, 1, 1, 1, NULL, 'സിങ്ക്*ലെഡ്*ടിൻ*ചെമ്പ്', ' സിങ്ക്', NULL, 1, NULL, 0),
(14, 'കടലിന്റെ ആഴം അളക്കുന്നതിന് ഉപയോഗിക്കുന്ന ഉപകരണം ഏത്', 1, 0, 1, 1, 1, 1, NULL, 'സോണോമീറ്റർ*എക്കോസൗണ്ടർ*അൾട്ടീമീറ്റർ*ഹൈേേഡ്രാഫോൺ', ' എക്കോസൗണ്ടർ', NULL, 1, NULL, 0),
(15, 'കാഴ്ചയെ കുറിച്ചുള്ള ബോധം ഉളവാക്കുന്ന തലച്ചോറിന്റെ ഭാഗം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'സെറിബല്ലം*സെറിബ്രം*മെഡുല ഒബ്ലോഗേറ്റ*കോർണിയ', ' സെറിബ്രം', NULL, 1, NULL, 0),
(16, 'മുട്ടത്തോട് നിർമ്മിച്ചിരിക്കുന്ന വസ്തു ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'കാൽസ്യം കാർബണേറ്റ്*കാൽസ്യ ഫോസ്‌േേഫറ്റ്*കാൽസ്യം ബൈകാർബണേറ്റ്*കാൽസ്യം സൾഫേറ്റ്', ' കാൽസ്യം കാർബണേറ്റ്', NULL, 1, NULL, 0),
(17, 'കേന്ദ്ര വനം പരിസ്ഥിതി മന്ത്രാലയം നിലവിൽ വന്ന വർഷം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, '1983*1984*1985*1986', ' 1985', NULL, 1, NULL, 0),
(18, 'ഇന്ത്യയിൽ ആദ്യമായി എയിഡ്‌സ് രോഗം റിപ്പോർട്ട് ചെയ്ത നഗരം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ചെന്നൈ*കൊൽക്കത്ത*മുബൈ*ന്യൂഡൽഹി', ' ചെന്നൈ', NULL, 1, NULL, 0),
(19, 'ഇന്ത്യയിലെ ആദ്യത്തെ ടെസ്റ്റ് ട്യൂബ് ശിശു ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'സെയിൻ ഹോഷ്മി*സുഭാഷ്*ചേതൻ*ദുർഗ', ' ദുർഗ', NULL, 1, NULL, 0),
(20, 'താഴെ പറയുന്നവയിൽ കമ്പ്യൂട്ടർ ഓപ്പറേറ്റിംഗ് സിസ്റ്റം അല്ലാത്തത് ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ആൻഡ്രോയ്ഡ്*ഉബുണ്ടു*ലിനക്‌സ്*വിൻഡോസ്', ' ആൻഡ്രോയ്ഡ്', NULL, 1, NULL, 0),
(21, 'എന്താണ് ഡാർട്ട് സിസ്റ്റം?', 1, 0, 1, 1, 1, 1, NULL, ' സുനാമി മുന്നറിപ്പ് സംവിധാനം*ഭൂകമ്പ മുന്നറിയിപ്പ് സംവിധാനം*അഗ്നി പർവ്വത സ്‌ഫോടന മുന്നറിയിപ്പ് സംവിധാനം*ഇതൊന്നുമല്ല', ' സുനാമി മുന്നറിയിപ്പ് സംവിധാനം', NULL, 1, NULL, 0),
(22, 'ഇൻഡ്യയിലെ ആദ്യത്‌തെ ബയോസ്ഫിയർ റിസരവ് എേത്?', 1, 0, 1, 1, 1, 1, NULL, 'നന്ദാദേവി*സുന്ദർബൻ*ഗൾഫ് ഓഫ് മന്നാർ*നീലഗിരി', 'നീലഗിരി', NULL, 1, NULL, 0),
(23, 'ഏറ്രവും വിസ്തീർണ്ണം കുറഞ്ഞ സ്‌കാൻഡിനേവിയൻ രാജ്യം ഏത് ?', 1, 0, 1, 1, 1, 1, NULL, 'റുമോനിയ*സ്വീഡൻ*ഫിൻനാൽഡ്*ഡെൻമാർക്ക്', ' ഡെൻമാർക്ക്', NULL, 1, NULL, 0),
(24, 'ആൽപ്‌സ് പർവ്വതത്തിന്റെ വടക്കേ ചരിവിലൂടെ വീശുന്ന ഉഷ്ണകാറ്റാണ് ?', 1, 0, 1, 1, 1, 1, NULL, 'നോർവെസ്റ്റർ*ഫൊൻ*ശിലാവർ*ബോറ', ' ഫൊൻ', NULL, 1, NULL, 0),
(25, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 0, 1, 1, 1, 1, NULL, ' കാവേരി*പെരിയാര്‍*നിള*പമ്പ', 'കാവേരി', NULL, 1, NULL, 0),
(26, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 0, 1, 1, 1, 1, NULL, ' സൃഷ്ടി*സ്ഥിതി*സമയം*സംഹാരം', 'സമയം', NULL, 1, NULL, 0),
(27, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 0, 1, 1, 1, 1, NULL, ' കവിത*പുസ്തകം*നോവല്‍*ലേഖനം', 'പുസ്തകം', NULL, 1, NULL, 0),
(28, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക', 1, 0, 1, 1, 1, 1, NULL, ' ശ്രീനാഥ്*വഡേക്കര്‍*ഗവാസ്‌കര്‍*ഡാല്‍മിയ', 'ഡാല്‍മിയ', NULL, 1, NULL, 0),
(29, 'പൂരിപ്പിക്കുക - കൊളംബോ:ശ്രീലങ്ക:: മനില :------', 1, 0, 1, 1, 1, 1, NULL, 'ഇന്തോനേഷ്യ*തായ് വാന്‍*ഫിലിപ്പീന്‍സ്*മ്യാന്‍മാര്‍', 'ഫിലിപ്പീന്‍സ്', NULL, 1, NULL, 0),
(30, 'അര്‍ജുന:സ്‌പോര്‍ട്‌സ് : ഓസ്‌കാര്‍ :--------', 1, 0, 1, 1, 1, 1, NULL, 'സാഹിത്യം*സിനിമ*നാടകം*സാമൂഹ്യപ്രവര്‍ത്തനം', 'സിനിമ', NULL, 1, NULL, 0),
(31, 'റേസിങ്:റോഡ്  :  സ്‌കേറ്റിങ്:---------', 1, 0, 1, 1, 1, 1, NULL, 'മരുഭൂമി*ഐസ്*വെള്ളം*ആകാശം', 'ഐസ്', NULL, 1, NULL, 0),
(32, 'നെഫ്രോളജി:വൃക്ക  :  ഹെമറ്റോളജി:-------', 1, 0, 1, 1, 1, 1, NULL, 'രക്തം*ഹൃദയം*മജ്ജ*ത്വക്ക്', 'രക്തം', NULL, 1, NULL, 0),
(33, 'കോഡുപയോഗിച്ച് DUBAI യെ BSZYG എന്നെഴുതിയാല്‍ FARMER നെ എങ്ങനെ മാറ്റിയെഴുതും?', 1, 0, 1, 1, 1, 1, NULL, 'ZGFPY*ZGFYP*ZGYFP*YGZFP', 'ZGFYP', NULL, 1, NULL, 0),
(34, 'കോഡുപയോഗിച്ച് PUNJABനെ OTMIZA എന്നെഴുതിയാല്‍ FARMERനെ എങ്ങനെ മാറ്റിയെഴുതും?', 1, 0, 1, 1, 1, 1, NULL, 'EZQDLQ*EZQLDQ*EZDQLQ*EQZLDQ', 'EZQLDQ', NULL, 1, NULL, 0),
(35, 'നിഘണ്ടുവിലെ ക്രമത്തില്‍ വരുന്ന നാലാമത്തെ വാക്ക് ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'pours*porks*ports*posts', 'pours', NULL, 1, NULL, 0),
(36, 'താഴെ കൊടുത്തവയില്‍ ഒന്നൊഴിച്ച് ബാക്കി fratricides ന്റെ ആവര്‍ത്തനമാണ്. വാക്ക് കണ്ടുപിടിക്കുക?', 1, 0, 1, 1, 1, 1, NULL, 'fratricides*fratricides*fratricides*fratricides*fratricidies', 'fratricidies', NULL, 1, NULL, 0),
(37, 'രാമു രാജുവിനേക്കാള്‍ വലുതും ബാബുവിനേക്കാള്‍ ചെറുതുമാണ്. ബാബു മനുവിനേക്കാള്‍ ചെറുതും. ആരാണ് ഏറ്റവും വലുത്?', 1, 0, 1, 1, 1, 1, NULL, 'മനു*രാജു*രാമു*ബാബു', 'മനു', NULL, 1, NULL, 0),
(38, '2;2;4;6;10;........', 1, 0, 1, 1, 1, 1, NULL, '26*12*16*20', '16', NULL, 1, NULL, 0),
(39, 'D-3; F-4; H-6;J-9;.........', 1, 0, 1, 1, 1, 1, NULL, 'K-13*K-11*L-11*L-13', 'L-13', NULL, 1, NULL, 0),
(40, '108ന്റെ 12.5% =----ന്റെ 50%', 1, 0, 1, 1, 1, 1, NULL, '54*216*13.5*27', '27', NULL, 1, NULL, 0),
(41, '18 പേര്‍ 28 ദിവസം കൊണ്ട് ചെയ്തുതീര്‍ക്കുന്ന ജോലി 24 ദിവസംകൊണ്ട് ചെയ്തുതീര്‍ക്കാന്‍ എത്ര പേര്‍ വേണം?', 1, 0, 1, 1, 1, 1, NULL, '22*20*24*21', '21', NULL, 1, NULL, 0),
(42, '4കുട്ടികള്‍ക്ക് ശരാശരി 7 വയസ്സ്. അഞ്ചാമത് ഒരു കൂട്ടികൂടി ചേര്‍ന്നാല്‍ ശരാശരി 6 വയസ്സ്. അഞ്ചാമന്റെ വയസ്സ് എത്ര?', 1, 0, 1, 1, 1, 1, NULL, '2*4*3*5', '2', NULL, 1, NULL, 0),
(43, 'ഗായത്രീമന്ത്രം ഏതു വേദത്തിലാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'യജുര്‍വേദം*ഋഗ്വേദം*സാമവേദം*അഥര്‍വവേദം', 'ഋഗ്വേദം', NULL, 1, NULL, 0),
(44, 'പോര്‍ച്ചുഗീസ് അധീനതയില്‍ നിന്നും ഗോവയെ വിമോചിപ്പിച്ച വര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1961*1963*1964*1965', '1961', NULL, 1, NULL, 0),
(45, 'അംബേദ്കറുടെ സമാധിസ്ഥലം ഏതുപേരിലറിയപ്പെടുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'രാജ്ഘട്ട്*വിജയ്ഘട്ട്*വീര്‍ഭൂമി*ചൈത്രഭൂമി', 'ചൈത്രഭൂമി', NULL, 1, NULL, 0),
(46, 'സിലിക്കണ്‍വാലി ഓഫ് ഇന്ത്യ എന്നറിയപ്പെടുന്ന പട്ടണം?', 1, 0, 1, 1, 1, 1, NULL, 'ഡല്‍ഹി*ഹൈദരാബാദ്*ചെന്നൈ*ബാംഗ്ലൂര്‍', 'ബാംഗ്ലൂര്‍', NULL, 1, NULL, 0),
(47, 'ബന്ദിപ്പൂര്‍ നാഷണല്‍ പാര്‍ക്ക് ഏതു സംസ്ഥാനത്തിലാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'മധ്യപ്രദേശ്*ഗോവ*കര്‍ണാടകം*ആന്ധ്രാപ്രദേശ്', 'കര്‍ണാടകം', NULL, 1, NULL, 0),
(48, 'ബംഗാള്‍ വിഭജനം റദ്ദുചെയ്ത ഇന്ത്യന്‍ വൈസ്രോയി ആരായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'ലിട്ടണ്‍പ്രഭു*ഹാര്‍ഡിഞ്ജ്പ്രഭു*റിപ്പണ്‍പ്രഭു*കഴ്‌സണ്‍പ്രഭു', 'ഹാര്‍ഡിഞ്ജ്പ്രഭു', NULL, 1, NULL, 0),
(49, 'ഇന്ത്യയില്‍ തദ്ദേശസ്വയംഭരണത്തിന്റെ പിതാവ് എന്നറിയപ്പെടുന്ന വൈസ്രോയി ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'മായോപ്രഭു*ഡഫറിന്‍പ്രഭു*മിന്റോപ്രഭു*റിപ്പണ്‍പ്രഭു', 'റിപ്പണ്‍പ്രഭു', NULL, 1, NULL, 0),
(50, 'ഇന്ത്യയില്‍ നിന്നും കൂടുതലായി ഇരുമ്പയിര് കയറ്റുമതി ചെയ്യുന്നതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'മര്‍മഗോവ*വിശാഖപട്ടണം*ഹാല്‍ഡിയ*ചെന്നൈ', 'മര്‍മഗോവ', NULL, 1, NULL, 0),
(51, 'ഇന്ത്യന്‍ എക്‌സ്പ്രസിന്റെ എഡിറ്ററായിരുന്ന യൂണിയന്‍ മന്ത്രി ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'ജുവൈല്‍ഓറം*അര്‍ജുന്‍ സേഥി*റീത്താവര്‍മ*അരുണ്‍ഷൂരി', 'അരുണ്‍ഷൂരി', NULL, 1, NULL, 0),
(52, 'ഗുല്‍മാര്‍ഗ് സുഖവാസകേന്ദ്രം ഏത് ഇന്ത്യന്‍ സംസ്ഥാനത്താണ് സ്ഥിതിചെയ്യുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'ഉത്തരാഞ്ചല്‍*പശ്ചിമബംഗാള്‍*ജമ്മുകാശ്മീര്‍*ഹിമാചല്‍പ്രദേശ്', 'ജമ്മുകാശ്മീര്‍', NULL, 1, NULL, 0),
(53, 'ഇന്ത്യയിലെ ഏറ്റവും വലിയ തടാകം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'വൂളാര്‍*ചില്‍ക്ക*പുലിക്കാട്ട്*വേമ്പനാട്ട്', 'ചില്‍ക്ക', NULL, 1, NULL, 0),
(54, 'പഹാരി ഭാഷ ഏതു സംസ്ഥാനത്താണ് സംസാരിക്കുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'പഞ്ചാബ്*ഹിമാചല്‍പ്രദേശ്*ഹരിയാന*പശ്ചിമബംഗാള്‍', 'ഹിമാചല്‍പ്രദേശ്', NULL, 1, NULL, 0),
(55, '1773ല്‍ കല്‍ക്കത്തയില്‍ സുപ്രീംകോടതി സ്ഥാപിച്ച ഗവര്‍ണര്‍ ജനറല്‍ ആരായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'കോണ്‍വാലീസ്*വില്യംബെന്റിക്*വാറന്‍ഹേസ്റ്റിങ്‌സ്*വെല്ലസ്ലി', 'വാറന്‍ഹേസ്റ്റിങ്‌സ്', NULL, 1, NULL, 0),
(56, 'അഷ്ടപ്രധാന്‍ ഏതു ഭരണാധികാരിയുടെ മന്ത്രിസഭയായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'കൃഷ്ണദേവരായര്‍*ചന്ദ്രഗുപ്തവിക്രമാദിത്യന്‍*ഹര്‍ഷവര്‍ധനന്‍*ഛത്രപതിശിവജി', 'ഛത്രപതിശിവജി', NULL, 1, NULL, 0),
(57, 'നളന്ദ സര്‍വകലാശാല സ്ഥാപിച്ച ഭരണാധികാരി ആരായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'കുമാരഗുപ്തന്‍*അശോകന്‍*ചന്ദ്രഗുപ്തന്‍1*ഹര്‍ഷവര്‍ധനന്‍', 'കുമാരഗുപ്തന്‍', NULL, 1, NULL, 0),
(58, 'ദക്ഷിണകൈലാസം എന്നറിയപ്പെടുന്ന ക്ഷേത്രമേത്?', 1, 0, 1, 1, 1, 1, NULL, 'കൂടല്‍മാണിക്യക്ഷേത്രം*ശുചീന്ദ്രക്ഷേത്രം*വടക്കുംനാഥക്ഷേത്രം*ഏറ്റുമാനൂര്‍ക്ഷേത്രം', 'വടക്കുംനാഥക്ഷേത്രം', NULL, 1, NULL, 0),
(59, 'ഐക്യരാഷ്ട്രസഭയുടെ സിവിലിയന്‍ പോലീസ് ഉപദേഷ്ടാവായി നിയമിക്കപ്പെട്ട ആദ്യത്തെ ഇന്ത്യന്‍ വ്യക്തി?', 1, 0, 1, 1, 1, 1, NULL, 'ജൂലിയസ് റിബരിയോ*കിരണ്‍ബേദി*കെ.പി.എസ്.ഗില്‍*ജെ.എം.കുറേഷി', 'കിരണ്‍ബേദി', NULL, 1, NULL, 0),
(60, 'ഗദ്ദാര്‍പാര്‍ട്ടിയുടെ സ്ഥാപകനേതാവ്?', 1, 0, 1, 1, 1, 1, NULL, 'ശ്യാം ജി.കൃഷ്ണവര്‍മ*ഹര്‍ദയാല്‍*വി.ഡി.സവാര്‍ക്കര്‍*മാഡം കാമ', 'ഹര്‍ദയാല്‍', NULL, 1, NULL, 0),
(61, 'ഔദ്യോഗിക പദവിയിലിരിക്കെ വിദേശത്തുവച്ച് ദിവംഗതനായ ഇന്ത്യന്‍ പ്രധാനമന്ത്രി?', 1, 0, 1, 1, 1, 1, NULL, 'ലാല്‍ബഹാദൂര്‍ശാസ്ത്രി*രാജീവ്ഗാന്ധി*ചരണ്‍സിംഗ്*മൊരാര്‍ജിദേശായി', 'ലാല്‍ബഹാദൂര്‍ശാസ്ത്രി', NULL, 1, NULL, 0),
(62, 'മറാത്ത മാക്യവല്ലി എന്ന് വിശേഷിപ്പിക്കപ്പെട്ടിരുന്നത് ആരെ?', 1, 0, 1, 1, 1, 1, NULL, 'പേഷ്വാ ബാജിറാവു*ബാലാജി വിശ്വനാഥ്*പേഷ്വാ രഘുനാഥറാവു*നാനാഫെഡ് നാവിസ്', 'ബാലാജി വിശ്വനാഥ്', NULL, 1, NULL, 0),
(63, 'സ്റ്റീല്‍ എന്ന ലോഹസങ്കരത്തില്‍ അടങ്ങിയത്?', 1, 0, 1, 1, 1, 1, NULL, 'ചെമ്പ് ഈയം*ഇരുമ്പ് കാര്‍ബണ്‍*ചെമ്പ് ക്രോമിയം നിക്കല്‍*ഇരുമ്പ് ചെമ്പ്', 'ഇരുമ്പ് കാര്‍ബണ്‍', NULL, 1, NULL, 0),
(64, 'ജലത്തിന്റെ pH മൂല്യം എത്ര?', 1, 0, 1, 1, 1, 1, NULL, '7.4*4.7*7*8', '7', NULL, 1, NULL, 0),
(65, 'മണ്ണിനെക്കുറിച്ചുള്ള പഠനശാഖയാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'പെഡോളജി*എക്കോളജി*ഫാത്തോളജി*എന്റമോളജി', 'പെഡോളജി', NULL, 1, NULL, 0),
(66, 'സില്‍വര്‍ റവല്യൂഷന്‍ ഏതുമായി ബന്ധപ്പെടുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'ക്ഷീരോല്പാദനം*മുട്ട ഉല്പാദനം*മത്സ്യഉത്പാദനം*പച്ചക്കറി ഉല്പാദനം', 'മുട്ട ഉല്പാദനം', NULL, 1, NULL, 0),
(67, 'ദേശീയ മാതൃസുരക്ഷാദിനം എന്നാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ജൂണ്‍5*ഡിസംബര്‍5*ഏപ്രില്‍1*ഏപ്രില്‍11', 'ഡിസംബര്‍5', NULL, 1, NULL, 0),
(68, 'ഇന്റര്‍നെറ്റിന്റെ പിതാവ് എന്നറിയപ്പെടുന്നത് ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'ചാള്‍സ്ബാബേജ്*ജെയിംസ്ഹാരിസണ്‍*വിന്റണ്‍സര്‍ഫ്*ജോണ്‍.എല്‍.ബേര്‍ഡ്', 'വിന്റണ്‍സര്‍ഫ്', NULL, 1, NULL, 0),
(69, 'ലോക ഭക്ഷ്യദിനം എന്ന്?', 1, 0, 1, 1, 1, 1, NULL, 'ഒക്ടോബര്‍ 16*ഒക്ടോബര്‍24*ജനുവരി 16*ഡിസംബര്‍ 16', 'ഒക്ടോബര്‍16', NULL, 1, NULL, 0),
(70, 'കമ്പ്യൂട്ടറില്‍ വിവരങ്ങള്‍ ശേഖരിച്ച് വെക്കുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'മെമ്മറി*സ്‌ക്രീന്‍*പ്രിന്റര്‍*മൗസ്', 'മെമ്മറി', NULL, 1, NULL, 0),
(71, 'മണ്ണെണ്ണയില്‍ സൂക്ഷിക്കുന്ന ഒരു മൂലകം?', 1, 0, 1, 1, 1, 1, NULL, 'ഫോസ്ഫറസ്*ഗാലിയം*ബേറിയം*സോഡിയം', 'സോഡിയം', NULL, 1, NULL, 0),
(72, 'പ്രാണികളെപ്പറ്റി പഠിക്കുന്ന ശാസ്ത്രശാഖ ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'എത്ത്‌നോളജി*എന്‍ഡോമോളജി*എത്തോളജി*എറ്റിമോളജി', 'എന്‍ഡോമോളജി', NULL, 1, NULL, 0),
(73, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ഏറ്റവും പഴക്കം ചെന്ന ഇന്ത്യന്‍ സര്‍വകലാശാല?', 1, 0, 1, 1, 1, 1, NULL, 'കേരള സര്‍വകലാശാല*ഡല്‍ഹി സര്‍വകലാശാല*മഹാത്മാഗാന്ധി സര്‍വകലാശാല*കല്‍ക്കത്താ സര്‍വകലാശാല', 'കല്‍ക്കത്താസര്‍വകലാശാല', NULL, 1, NULL, 0),
(74, 'ടണല്‍ ഓഫ് ടൈം ആരുടെ ആത്മകഥയാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ആശാപൂര്‍ണാദേവി*കെ.ആര്‍.നാരായണന്‍*ആര്‍.കെ.ലക്ഷ്മണ്‍*ആര്‍.കെ.നാരായണന്‍', 'ആര്‍.കെ.ലക്ഷ്മണ്‍', NULL, 1, NULL, 0),
(75, 'ലോകാരോഗ്യസംഘടനയുടെ ആസ്ഥാനം?', 1, 0, 1, 1, 1, 1, NULL, 'ജനീവ*പാരീസ്*ന്യൂയോര്‍ക്ക്*വാഷിങ്ടണ്‍', 'ജനീവ', NULL, 1, NULL, 0),
(76, 'ഏറ്റവും ഒടുവില്‍ രൂപം കൊണ്ട ഇന്ത്യന്‍ സംസ്ഥാനം?', 1, 0, 1, 1, 1, 1, NULL, 'ഗോവ*ജാര്‍ഖണ്ഡ്*ഉത്തരാഞ്ചല്‍*ഛത്തീസ്ഗഢ്', 'ജാര്‍ഖണ്ഡ്', NULL, 1, NULL, 0),
(77, 'പഞ്ചായത്ത് ഏത് രാജ്യത്തിന്റെ പാര്‍ലമെന്റാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ഭൂട്ടാന്‍*ബര്‍മ*നേപ്പാള്‍*മലേഷ്യ', 'നേപ്പാള്‍', NULL, 1, NULL, 0),
(78, 'മാല്‍ഗുഡി ഡെയ്‌സ് ഏത് പ്രശസ്ത സാഹിത്യകാരന്റെ കൃതിയാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'പ്രേംചന്ദ്*ആര്‍.കെ.നാരായണന്‍*ആര്‍.കെ.ലക്ഷ്മണന്‍*എസ്.കെ.പൊറ്റക്കാട്', 'ആര്‍.കെ.നാരായണന്‍', NULL, 1, NULL, 0),
(79, 'ഇന്ത്യയില്‍ ആദ്യമായി സ്വകാര്യവല്‍ക്കരിക്കപ്പെട്ട ഷിയോനാഘ് പുഴ ഏതു സംസ്ഥാനത്താണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ഛത്തീസ്ഗഢ്*ഉത്തരാഞ്ചല്‍*ഉത്തര്‍പ്രദേശ്*ജാര്‍ഖണ്ഡ്', 'ഛത്തീസ്ഗഢ്', NULL, 1, NULL, 0),
(80, 'ഏറ്റവും വലിയ ദേശീയഗാനം ഏത് രാജ്യത്തിന്റേതാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'അമേരിക്ക*ഇന്ത്യ*ഫ്രാന്‍സ്*ഗ്രീസ്', 'ഗ്രീസ്', NULL, 1, NULL, 0),
(81, '2006ലെ ലോകകപ്പ് ഫുട്‌ബോള്‍ എവിടെവെച്ചു നടക്കും?', 1, 0, 1, 1, 1, 1, NULL, 'യു.എസ്.എ.*ജര്‍മനി*ഫ്രാന്‍സ്*ഇറ്റലി', 'ജര്‍മനി', NULL, 1, NULL, 0),
(82, 'ഹൃദയസ്മിതം ആരുടെ കൃതിയാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ചങ്ങമ്പുഴ കൃഷ്ണപിള്ള*വൈലോപ്പിള്ളി*ഇടപ്പള്ളി രാഘവന്‍പിള്ള*സുഗതകുമാരി', 'ഇടപ്പള്ളി രാഘവന്‍പിള്ള', NULL, 1, NULL, 0),
(83, 'വാട്ടര്‍സ്‌കോട്ട് ഓഫ് കേരള എന്നറിയപ്പെടുന്നതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'സി.വി.രാമന്‍പിള്ള*എസ്.കെ.പൊറ്റക്കാട്*ചെമ്മനംചാക്കോ*സി.വി.ശ്രീരാമന്‍', 'സി.വി.രാമന്‍പിള്ള', NULL, 1, NULL, 0),
(84, 'കേരളത്തില്‍ ഏറ്റവും കൂടുതല്‍ മരച്ചീനി ഉല്പാദിപ്പിക്കുന്ന ജില്ല?', 1, 0, 1, 1, 1, 1, NULL, 'കാസര്‍ഗോഡ്*തിരുവനന്തപുരം*ആലപ്പുഴ*പാലക്കാട്', 'തിരുവനന്തപുരം', NULL, 1, NULL, 0),
(85, 'മാലി എന്ന തൂലികാനാമത്തില്‍ അറിയപ്പെടുന്നതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'മാധവന്‍ നായര്‍ വി.*രാമകൃഷ്ണന്‍*സച്ചിദാനന്ദന്‍*ശ്രീധരമേനോന്‍', 'മാധവന്‍നായര്‍ വി.', NULL, 1, NULL, 0),
(86, 'വാസ്‌കോഡിഗാമ കോഴിക്കോട് വന്നിറങ്ങിയ കപ്പലിന്റെ പേര്?', 1, 0, 1, 1, 1, 1, NULL, 'സാന്റാമറിയ*പിന്റ്*സാന്‍ഗബ്രിയേല്‍*നീന', 'സാന്‍ഗബ്രിയേല്‍', NULL, 1, NULL, 0),
(87, 'കുന്നല കോനാതിരി എന്നറിയപ്പെട്ടിരുന്ന കേരളീയ രാജാവ്?', 1, 0, 1, 1, 1, 1, NULL, 'കോലത്തിരി*കൊച്ചിരാജാവ്*വള്ളുവ കോനാതിരി*സാമൂതിരി', 'സാമൂതിരി', NULL, 1, NULL, 0),
(88, 'കേരളത്തില്‍ സര്‍ക്കസ് കലയുടെ പിതാവ് എന്നറിയപ്പെടുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'കീലേരി കുഞ്ഞിക്കണ്ണന്‍*ഇട്ടി അച്ചുതന്‍*മാധവമേനോന്‍*പൂമുള്ളി നീലകണ്ഠന്‍', 'കീലേരി കുഞ്ഞിക്കണ്ണന്‍', NULL, 1, NULL, 0),
(89, 'ചവിട്ടുനാടകം ഏത് വിഭാഗം ജനങ്ങള്‍ക്കിടയില്‍ പ്രചാരത്തിലുണ്ടായിരുന്ന കലാരൂപമായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'ഹിന്ദുക്കള്‍*ക്രിസ്ത്യാനികള്‍*ജൂതന്മാര്‍*മുസ്ലീങ്ങള്‍', 'ക്രിസ്ത്യാനികള്‍', NULL, 1, NULL, 0),
(90, '1809ല്‍ കുണ്ടറ വിളംബരം പുറപ്പെടുവിച്ചതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'മാര്‍ത്താണ്ഡവര്‍മ*പാലിയത്തച്ചന്‍*വേലുത്തമ്പിദളവ*ധര്‍മരാജാവ്', 'വേലുത്തമ്പിദളവ', NULL, 1, NULL, 0),
(91, 'ലോകപ്രശസ്ത ശാസ്ത്രജ്ഞനായ ഡോ.എം.എസ്.സ്വാമിനാഥന്റെ ജന്മസ്ഥലം?', 1, 0, 1, 1, 1, 1, NULL, 'മണ്ണുത്തി*ഒറ്റപ്പാലം*മാങ്കൊമ്പ്*വര്‍ക്കല', 'മാങ്കൊമ്പ്', NULL, 1, NULL, 0),
(92, 'വിലാസിനി എന്നത് ആരുടെ തൂലികാനാമമാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'എം.ആര്‍.നായര്‍*പി.വി.അയ്യപ്പന്‍*പി.എസ്.കുട്ടികൃഷ്ണന്‍*എം.കെ.മേനോന്‍', 'എം.കെ.മേനോന്‍', NULL, 1, NULL, 0),
(93, 'This is the matter --------I am proud.', 1, 0, 1, 1, 1, 1, NULL, 'which*that*who*of which', 'of which', NULL, 1, NULL, 0),
(94, 'I found your diary after you ------- the house.', 1, 0, 1, 1, 1, 1, NULL, 'left*had left*were leaving*would leave', 'had left', NULL, 1, NULL, 0),
(95, 'Sydney Cartoon proposed to Lucio but she ------- the offer of marriage.', 1, 0, 1, 1, 1, 1, NULL, 'turned down*turned off*turned on*turned out', 'turned down', NULL, 1, NULL, 0),
(96, 'He is married-----------', 1, 0, 1, 1, 1, 1, NULL, 'with my sister*my sister*to my sister*none of the above', 'to my sister', NULL, 1, NULL, 0),
(97, 'The moon as well as the stars........', 1, 0, 1, 1, 1, 1, NULL, 'give lifht at night*do give light at night*gave light at night*gives light at night', 'gives light at night', NULL, 1, NULL, 0),
(98, 'If he had applied for the post...........', 1, 0, 1, 1, 1, 1, NULL, 'he get it*he will get it*he will have got it*he would have got it', 'he would have got it', NULL, 1, NULL, 0),
(99, 'The opposite of the world ACQUITTED is ...................', 1, 0, 1, 1, 1, 1, NULL, 'entrusted*convicted*freed*burned', 'convicted', NULL, 1, NULL, 0),
(100, 'The opposite of the world SYNTHETIC is..........', 1, 0, 1, 1, 1, 1, NULL, 'natural*affable*plastic*cosmetic', 'natural', NULL, 1, NULL, 0),
(101, 'Two men and a women were killed in a ............... between a car and a jeep.', 1, 0, 1, 1, 1, 1, NULL, 'strike*thrust*collision*collusion', 'collision', NULL, 1, NULL, 0),
(102, 'Choose the apt word showing the meaning of the capitalised word in the sentence. Ernakulam is a very POPULOUS city in Kerala.', 1, 0, 1, 1, 1, 1, NULL, 'luxurious*liked by the people*highly fashionable*thickly inhabited', 'thickly inhabited', NULL, 1, NULL, 0),
(103, 'The book you rae looking........ is here.', 1, 0, 1, 1, 1, 1, NULL, 'for*at*out*about', 'for', NULL, 1, NULL, 0),
(104, 'Her spectacles would not rest on the .................. of her nose.', 1, 0, 1, 1, 1, 1, NULL, 'bridge*tip*top*arch', 'bridge', NULL, 1, NULL, 0),
(105, 'The government aims .................... rehabilitating the affected victims in the calamity.', 1, 0, 1, 1, 1, 1, NULL, 'to*for*about*at', 'at', NULL, 1, NULL, 0),
(106, 'Bosewell''s Life of Johnson is considered to be the greatest ................ ever written.', 1, 0, 1, 1, 1, 1, NULL, 'novel*biography*autobiography*fiction', 'biography', NULL, 1, NULL, 0),
(107, 'I saw him in Madras two months...............', 1, 0, 1, 1, 1, 1, NULL, 'before*since*ago*for', 'ago', NULL, 1, NULL, 0),
(108, 'Hardly had he reached the station.............. the train arrived.', 1, 0, 1, 1, 1, 1, NULL, 'than*until*when*as', 'when', NULL, 1, NULL, 0),
(109, 'The meaning of fascimile:', 1, 0, 1, 1, 1, 1, NULL, 'model*nostrum*exact copy*fake', 'exact copy', NULL, 1, NULL, 0),
(110, 'Judicious means:', 1, 0, 1, 1, 1, 1, NULL, 'wise*diplimatic*watchful*legal', 'wise', NULL, 1, NULL, 0),
(111, 'The murder of an important person for political reasons:', 1, 0, 1, 1, 1, 1, NULL, 'regicide*homicide*patricide*assassination', 'assassination', NULL, 1, NULL, 0),
(112, 'Find out the wrongly spelt word:', 1, 0, 1, 1, 1, 1, NULL, 'bulldozer*brochure*privilage*separate', 'privilage', NULL, 1, NULL, 0),
(113, 'ശരിയായ പദം തിരഞ്ഞെടുത്തെഴുതുക:', 1, 0, 1, 1, 1, 1, NULL, 'അഥിതി*അതിധി*അതിഥി*അധിദി', 'അതിഥി', NULL, 1, NULL, 0),
(114, '2001ലെ വയലാര്‍ പുരസ്‌കാരം ലഭിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, 'എം.വി.ദേവന്‍*ടി.പത്മനാഭന്‍*സുകുമാര്‍ അഴീക്കോട്*ഒ.എന്‍.വി.കുറുപ്പ്', 'ടി.പത്മനാഭന്‍', NULL, 1, NULL, 0),
(115, 'ആഷാമേനോന്‍ എന്ന തൂലികാമത്തിനുടമ?', 1, 0, 1, 1, 1, 1, NULL, 'കെ.ശ്രീകുമാര്‍*എന്‍.നാരായണപ്പിള്ള*അയ്യപ്പന്‍പിള്ള*പി.സച്ചിദാനന്ദന്‍', 'കെ.ശ്രീകുമാര്‍', NULL, 1, NULL, 0),
(116, 'ശരിയായ വാചകം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ബസ്സില്‍ പുകവലിക്കുകയോ കൈയും തലയും പുറത്തിടുകയും ചെയ്യരുത്*ബസ്സില്‍ പുകവലിക്കുകയും കൈയും തലയും പുറത്തിടുകയോ ചെയ്യരുത്*ബസ്സില്‍ പുകവലിക്കുകയോ കൈയോ തലയോ പുറത്തിടുകയും ചെയ്യരുത്*ബസ്സില്‍ പുകവലിക്കുകയും കൈയും തലയും പുറത്തിടുകയും ചെയ്യരുത്', 'ബസ്സില്‍ പുകവലിക്കുകയും കൈയും തലയും പുറത്തിടുകയും ചെയ്യരുത്', NULL, 1, NULL, 0),
(117, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ആഗമസന്ധിയല്ലാത്തത്?', 1, 0, 1, 1, 1, 1, NULL, 'പുളിങ്കുരു*പൂത്തട്ടം*പൂവമ്പ്*കരിമ്പുലി', 'പൂത്തട്ടം', NULL, 1, NULL, 0),
(118, 'താഴെ പറയുന്നവയില്‍ സകര്‍മകക്രിയ അല്ലാത്തത്?', 1, 0, 1, 1, 1, 1, NULL, 'ഉണ്ണുക*കുടിക്കുക*കുളിക്കുക*അടിക്കുക', 'കുളിക്കുക', NULL, 1, NULL, 0),
(119, 'താഴെ കൊടുത്തിരിക്കുന്ന വാക്കുകളില്‍ കൃത്തിന് ഉദാഹരണം?', 1, 0, 1, 1, 1, 1, NULL, 'ബുദ്ധിമാന്‍*മൃദുത്വം*വൈയാകരണന്‍*ദര്‍ശനം', 'ദര്‍ശനം', NULL, 1, NULL, 0),
(120, 'ശരിയായ തര്‍ജമ എഴുതുക. World is under the fear of nuclear weapon.', 1, 0, 1, 1, 1, 1, NULL, 'ലോകം ആണവായുധ ഭീഷണിയില്‍ ഞെരുങ്ങുന്നു*ലോകം ആണവായുധത്തിന്റെ ഭീതിയിലാണ്*ലോകം ആണവായുധത്തിന്റെ പിടിയിലമരുന്നു*ലോകം ആണവായുധത്തെ നോക്കി വിറകൊള്ളുന്നു', 'ലോകം ആണവായുധത്തിന്റെ ഭീതിയിലാണ്', NULL, 1, NULL, 0),
(121, 'ശരിയായ തര്‍ജമ എഴുതുക: Barking dogs seldom bites.', 1, 0, 1, 1, 1, 1, NULL, 'കുരയ്ക്കുന്ന പട്ടി കടിക്കാറില്ല*പട്ടി കുരച്ചിട്ടേ കടിക്കാറുള്ളൂ*കുരയ്ക്കുന്ന പട്ടി അപൂര്‍വമായേ കടിക്കാറുള്ളൂ*പട്ടി കുരച്ചുകൊണ്ട് കടിക്കാറുണ്ട്', 'കുരയ്ക്കുന്ന പട്ടി കടിക്കാറില്ല', NULL, 1, NULL, 0),
(122, 'ശരിയായ തര്‍ജമ എഴുതുക: You had better consult a doctor', 1, 0, 1, 1, 1, 1, NULL, 'ഡോക്ടറെ കാണുന്നതാണ് കൂടുതല്‍ അഭികാമ്യം*ഡോക്ടറെ കാണുന്നത് ഗുണപ്രദമാണ്*ഡോക്ടറെ കണ്ടാല്‍ സ്ഥിതിമാറും*ഡോക്ടറെ കണ്ടാല്‍ അസുഖം ഭേദമാകും', 'ഡോക്ടറെ കാണുന്നതാണ് കൂടുതല്‍ അഭികാമ്യം', NULL, 1, NULL, 0),
(123, 'ഒരു കന്നുകാലിച്ചന്തയില്‍ കന്നുകാലികളും വില്പനക്കാരായി എത്തിയവരും ഉണ്ട്. ചന്തയില്‍ ആകെ 128 തലകളും 420 കാലുകളും ഒരാള്‍ എണ്ണിത്തിട്ടപ്പെടുത്തിയെങ്കില്‍ അവിടെ എത്ര പശുക്കള്‍ എത്ര മനുഷ്യര്‍?', 1, 0, 1, 1, 1, 1, NULL, '81-47*80-48*90-38*82-46', '82-46', NULL, 1, NULL, 0),
(124, 'വ്യത്യസ്ത നിറങ്ങളിലുള്ള മൂന്ന് പാവാട; നാല് ബ്ലൗസ്; മൂന്ന് ദാവണി എന്നിവ ഒരു ജൗളിക്കടയില്‍ നിന്നും വാങ്ങി. പച്ച നിറത്തിലുള്ള പാവാടയും അതേ നിറത്തിലുള്ള ബ്ലൗസും മാത്രം തീരെ ചേര്‍ച്ചയില്ലാത്തതുകൊണ്ട് അവള്‍ക്ക് ഉപയോഗിക്കാന്‍ കഴിഞ്ഞില്ല. ആകെ എത്രതരത്തില്‍ ഇവ ഉപയോഗിച്ച് അവള്‍ക്ക് അണിയാം?', 1, 0, 1, 1, 1, 1, NULL, '36*34*33*35', '33', NULL, 1, NULL, 0),
(125, 'ഒരു 100 മീറ്റര്‍ ഓട്ടമത്സരത്തില്‍ രാമന്‍ 100 മീറ്റര്‍ പിന്നിട്ടപ്പോള്‍ കൃഷ്ണന് 90 മീറ്റര്‍ പിന്നിടാനേ കഴിഞ്ഞുള്ളൂ. രണ്ടാമതൊരു 100 മീറ്റര്‍ മത്സരത്തില്‍ രാമന്‍ കൃഷ്ണനേക്കാള്‍ 100 മീറ്റര്‍ പിന്നില്‍ നിന്നും തുടങ്ങി. ഈ മത്സരത്തില്‍ ആര് ജയിക്കും?', 1, 0, 1, 1, 1, 1, NULL, 'രാമന്‍*കൃഷ്ണന്‍*രണ്ടുപേരും ഒരുമിച്ച്*രണ്ടുപേരും ജയിക്കില്ല', 'രാമന്‍', NULL, 1, NULL, 0),
(126, 'ആയിഷയുടെ വയസ്സ് രാജന്റെ വയസ്സിന്റെ മൂന്നിരട്ടിയാണ്. എന്നാല്‍ രാജന്റെ വയസ്സ് ദിലീപിന്റെ വയസ്സിന്റെ എട്ട് ഇരട്ടിയോട് 2 ചേര്‍ത്താല്‍ ലഭിക്കും. ദിലീപിന്റെ വയസ്സ് 2 ആണെങ്കില്‍ ആയിഷയുടെ വയസ്സെത്ര?', 1, 0, 1, 1, 1, 1, NULL, '50*54*48*46', '52', NULL, 1, NULL, 0),
(127, 'രണ്ടു സംഖ്യകളുടെ തുക 10. അവയുടെ ഗുണനഫലം 20. എങ്കില്‍ സംഖ്യകളുടെ വ്യൂല്‍ക്രമങ്ങളുടെ (Reciprocals) തുക കാണുക.?', 1, 0, 1, 1, 1, 1, NULL, '2*1/3*3*1/2', '1/2', NULL, 1, NULL, 0),
(128, 'നിശ്ചിത ചുറ്റളവുള്ള ചതുരങ്ങളില്‍ ഏറ്റവും കൂടുതല്‍ വിസ്തീര്‍ണം ഏതിനാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ദീര്‍ഘചതുരം*ലംബകം*സമചതുരം*സമപാര്‍ശ്വലംബകം', 'സമചതുരം', NULL, 1, NULL, 0),
(129, 'താഴെ കൊടുത്തിരിക്കുന്ന സംഖ്യാശ്രേണിയിലെ അടുത്തസംഖ്യ ഏത്?', 1, 0, 1, 1, 1, 1, NULL, '1;8;27;------;64*47*62*57', '64', NULL, 1, NULL, 0),
(130, '583 എന്ന സംഖ്യയെ 293 ആയി ബന്ധപ്പെടുത്താമെങ്കില്‍ 488നെ ഏതിനോട് ചേര്‍ക്കാം?', 1, 0, 1, 1, 1, 1, NULL, '581*487*291*388', '388', NULL, 1, NULL, 0),
(131, 'ഒരു സംഖ്യയുടെ 30%=5 എങ്കില്‍ സംഖ്യയേത്?', 1, 0, 1, 1, 1, 1, NULL, '16*16.67*16.69*15.42', '16.67', NULL, 1, NULL, 0),
(132, 'ഒരാള്‍ വടക്കുദിശയിലേക്ക് 2കി.മീ. നടന്നതിനുശേഷം വലതുവശം തിരിഞ്ഞ് 2 കിമീഉം വീണ്ടും വലതുവശം തിരിഞ്ഞ് 3 കി.മീ.യും നടക്കുന്നുവെങ്കില്‍ അദ്ദേഹത്തിന്റെ ഇപ്പോഴത്തെ ദിശ ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'വടക്ക്*തെക്ക്*കിഴക്ക്*പടിഞ്ഞാറ്', 'തെക്ക്', NULL, 1, NULL, 0),
(133, 'പൂരിപ്പിച്ച് എഴുതുക: BDAC: FHEG: : NPMO:?', 1, 0, 1, 1, 1, 1, NULL, 'QTRS*RQTS*TRQS*RTQS', 'RTQS', NULL, 1, NULL, 0),
(134, 'ഒരു സ്ഥാപനത്തിലെ 20% ജീവനക്കാര്‍ 2 കാര്‍ മാത്രം ഉള്ളവരാണ്. ബാക്കിയുള്ളവരുടെ 40% ത്തിന് 3 കാര്‍ ഉണ്ട്. ശേഷിക്കുന്ന ജീവനക്കാര്‍ ഒരു കാര്‍ മാത്രം ഉള്ളവരും ആണ്. എങ്കില്‍ താഴെപറയുന്ന പ്രസ്താവനകളില്‍ ഏറ്റവും ഉചിതമായത് ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ആകെ ജീവനക്കാരുടെ 20%ന് മാത്രം 3 കാറുകള്‍ ഉണ്ട്*ആകെ ജീവനക്കാരുടെ 48%മാത്രം ഒരു കാറിന്റെ ഉടമകളാണ്*ആകെ ജീവനക്കാരുടെ 60% ന് 2 കാറെങ്കിലും ഉണ്ട്*മുകളില്‍ പറഞ്ഞവയൊന്നും ശരിയല്ല', 'ആകെ ജീവനക്കാരുടെ 48% മാത്രം ഒരു കാറിന്റെ ഉടമകളാണ്', NULL, 1, NULL, 0),
(135, '1984 വര്‍ഷത്തില്‍ ജനുവരി ഫെബ്രുവരി മാര്‍ച്ച് എന്നീ മാസങ്ങളിലെ ആകെ ദിവസങ്ങള്‍ എത്ര?', 1, 0, 1, 1, 1, 1, NULL, '90*93*92*91', '91', NULL, 1, NULL, 0),
(136, 'രണ്ടു സംഖ്യകളുടെ വ്യത്യാസം തുക ഗുണനഫലം എന്നിവയുടെ അംശബന്ധം (Ratio) 1:7:24 ആണെങ്കില്‍ സംഖ്യകളുടെ ഗുണനഫലം എന്ത്?', 1, 0, 1, 1, 1, 1, NULL, '6*12*48*24', '48', NULL, 1, NULL, 0),
(137, 'ഒരു ക്ലോക്കിലെ സമയം 4 മണിയാണ് ഒരു കണ്ണാടിയില്‍ അതിന്റെ പ്രതിബിംബം കാണിക്കുന്ന സമയം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, '7 മണി*4മണി*8മണി*10മണി', '8മണി', NULL, 1, NULL, 0),
(138, 'ഇപ്പോള്‍ കൃഷ്ണന് 4 വയസ്സും മിനിക്ക് 6 വയസ്സും ഉണ്ട്. ഇരുവരുടേയും വയസ്സിന്റെ തുക 24 ആകുവാന്‍ അവര്‍ എത്രവര്‍ഷം കാത്തിരിക്കണം?', 1, 0, 1, 1, 1, 1, NULL, '7*10*6*5', '7', NULL, 1, NULL, 0),
(139, 'REGULATION എന്ന വാക്ക് 1 2 3 4 5 6 7 8 9 10 എന്ന കോഡ് ഉപയോഗിച്ച് എഴുതാമെങ്കില്‍ RULE എന്ന വാക്ക് എങ്ങിനെ എഴുതാം?', 1, 0, 1, 1, 1, 1, NULL, '1452*5142*4254*4251', '1452', NULL, 1, NULL, 0),
(140, 'താഴെപ്പറയുന്ന സംഖ്യകളുടെ കൂട്ടത്തില്‍ ചേരാത്തത് ഏത്?   24;27;31;33;36', 1, 0, 1, 1, 1, 1, NULL, '24*33*31*36', '31', NULL, 1, NULL, 0),
(141, 'താഴെ കൊടുത്തിട്ടുള്ള സംഖ്യകളുടെ തുക കാണുക?21.7;13.21;15.721;3.815;9.813;0.184;0.126;0.091', 1, 0, 1, 1, 1, 1, NULL, '65.58*64.66*65.38*65.28', '64.66', NULL, 1, NULL, 0),
(142, 'നോബല്‍ സമ്മാന ജേതാവായ റഷ്യന്‍ കവി?', 1, 0, 1, 1, 1, 1, NULL, 'റെനേ കാസ്റ്റലോവ്*ചെക്കോവ്*അലക്‌സാണ്ടര്‍ പുഷ്‌കിന്‍*ജോസഫ് ബ്രോഡ്‌സ്‌കി', 'ജോസഫ് ബ്രോഡ്‌സ്‌കി', NULL, 1, NULL, 0),
(143, 'ഏതു യൂണിവേഴ്‌സിറ്റിയിലാണ് കൃത്രിമ പോളിയോ വൈറസ് ആദ്യമായി സംയോജിപ്പിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, 'ന്യൂയോര്‍ക്ക്*ജോണ്‍ ഹോപ്കിന്‍സ്*ഓക്‌സ്‌ഫോര്‍ഡ്*കേംബ്രിഡ്ജ്', 'ന്യൂയോര്‍ക്ക്', NULL, 1, NULL, 0),
(144, 'നോബല്‍ സമ്മാന ജേതാവായ അമര്‍ത്യാസെന്നിന്റെ ചിന്തകളെ സ്വാധീനിച്ച സംഭവം?', 1, 0, 1, 1, 1, 1, NULL, 'മീററ്റ് കലാപം*ബംഗാള്‍ ക്ഷാമം*ഇന്ത്യാ-പാക്ക് വിഭജനം*ഇവയൊന്നുമല്ല', 'ബംഗാള്‍ക്ഷാമം', NULL, 1, NULL, 0),
(145, 'താഴെ പറയുന്നവയില്‍ ചാര്‍ളി ചാപ്ലിന്‍ ചിത്രമല്ലാത്തത്?', 1, 0, 1, 1, 1, 1, NULL, 'ദി കിഡ്*മോഡേണ്‍ ടൈംസ്*ബ്ലാക്‌മെയില്‍*ദി സര്‍ക്കസ്', 'ബ്ലാക്ക്‌മെയില്‍', NULL, 1, NULL, 0);
INSERT INTO `questions` (`id`, `question`, `set_id`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answer`, `question_import_id`, `question_status_id`, `organization_id`, `share`) VALUES
(146, 'സത്യജിത്‌റായിയുടെ പഥേര്‍ പാഞ്ചാലിയിലെ മുഖ്യവിഷയം?', 1, 0, 1, 1, 1, 1, NULL, 'വര്‍ഗീയത*അധിനിവേശം*ദാരിദ്ര്യം*സ്വവര്‍ഗരതി', 'ദാരിദ്ര്യം', NULL, 1, NULL, 0),
(147, 'മലയാളത്തിലെ ആദ്യ ശബ്ദചലച്ചിത്രം?', 1, 0, 1, 1, 1, 1, NULL, 'വിഗതകുമാരന്‍*കുമ്മാട്ടി*ബാലന്‍*ഇവയൊന്നുമല്ല', 'ബാലന്‍', NULL, 1, NULL, 0),
(148, 'അഖിലേന്ത്യാ ട്രേഡ് യൂണിയന്‍ കോണ്‍ഗ്രസ്സിന്റെ ആദ്യസമ്മേളനം നടന്നത് എവിടെവെച്ചാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'കല്‍ക്കട്ട*മദ്രാസ്*ബോംബെ*അഹമ്മദാബാദ്', 'ബോംബെ', NULL, 1, NULL, 0),
(149, 'ലബനന്റെ തലസ്ഥാനം?', 1, 0, 1, 1, 1, 1, NULL, 'നെയ്‌റോബി*ബെയ്‌റൂട്ട്*വിക്ടോറിയ*കെയ്‌റോ', 'ബെയ്‌റൂട്ട്', NULL, 1, NULL, 0),
(150, 'ഈശ്വരന്‍ ഹിന്ദുവല്ല; ഇസ്ലാമല്ല; ക്രിസ്ത്യാനിയല്ല ഇന്ദ്രനും ചന്ദ്രനുമല്ല.... എന്നു തുടങ്ങുന്ന പ്രസിദ്ധമായ ഗാനത്തിന്റെ രചയിതാവ്?', 1, 0, 1, 1, 1, 1, NULL, 'പി.ഭാസ്‌കരന്‍*ബിച്ചുതിരുമല*ഒ.എന്‍.വി.*വയലാര്‍', 'വയലാര്‍', NULL, 1, NULL, 0),
(151, 'ഇന്ത്യയുടെ ഔഷധ വ്യവസായരംഗത്ത് കുതിച്ചുചാട്ടം ഉണ്ടാക്കിയ നിയമം?', 1, 0, 1, 1, 1, 1, NULL, 'ഡി.പി.സി.ഒ.*പേറ്റന്റ് ആക്ട്*ഡി.ഒ.സി.എസ്സ്*ഇവയൊന്നുമല്ല', 'പേറ്റന്റ്ആക്ട്', NULL, 1, NULL, 0),
(152, 'അന്തകന്‍ വിത്തിന്റെ പ്രാധാന്യം?', 1, 0, 1, 1, 1, 1, NULL, 'പ്രത്യുല്പാദനശേഷിയില്ല*വളത്തിന്റെ ആവശ്യമില്ല*കളകളെ നശിപ്പിക്കുന്നു*ഇവയൊന്നുമല്ല', 'പ്രത്യുല്പാദനശേഷിയില്ല', NULL, 1, NULL, 0),
(153, 'ബസുമതിക്കുമേല്‍ പേറ്റന്റ് നേടിയ ബഹുരാഷ്ട്രകമ്പനി:', 1, 0, 1, 1, 1, 1, NULL, 'ഡെല്‍റ്റ ആന്റ് പൈന്‍ലാന്റ്*ഡ്യൂപോണ്ട്*മോണ്‍സാന്റോ*ഇവയൊന്നുമല്ല', 'ഇവയൊന്നുമല്ല', NULL, 1, NULL, 0),
(154, 'സിക്കിമിന്റെ തലസ്ഥാനം?', 1, 0, 1, 1, 1, 1, NULL, 'ഗാങ്‌ടോക്ക്*സിംല*കൊഹിമ*ഇവയൊന്നുമല്ല', 'ഗാങ്‌ടോക്ക്', NULL, 1, NULL, 0),
(155, 'സത്യാഗ്രഹം ബലവാന്മാരുടെ ഉപകരണമാണ് - ഇതുപറഞ്ഞതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'ജവഹര്‍ലാല്‍നെഹ്രു*ഇ.എം.എസ്*വിനോബാഭാവെ*മഹാത്മാഗാന്ധി', 'മഹാത്മാഗാന്ധി', NULL, 1, NULL, 0),
(156, 'മീററ്റ് കലാപത്തില്‍ മരണശിക്ഷയ്ക്ക് വിധിക്കപ്പെട്ടതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'മുസാഫിര്‍ അഹമ്മദ്*അജയ്‌ഘോഷ്*ബാലഗംഗാധര തിലകന്‍*ഇവരൊന്നുമല്ല', 'ഇവരൊന്നുമല്ല', NULL, 1, NULL, 0),
(157, 'മാപ്പിള ലഹളയുടെ താല്‍ക്കാലിക വിജയത്തിനുശേഷം ഭരണാധിപനായി അവരോധിക്കപ്പെട്ടതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'മുഹമ്മദാലിജിന്ന*അലി മുസലിയാര്‍*എ.എ.റഹിം*ഇവരാരുമല്ല', 'അലിമുസലിയാര്‍', NULL, 1, NULL, 0),
(158, 'റൗലറ്റ് ആക്ട് പാസാക്കിയ വര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1907*1917*1919*1921', '1919', NULL, 1, NULL, 0),
(159, 'കോണ്‍ഗ്രസ്സിലെ മിതവാദികളുടെ നേതാവ് (1905-1908)?', 1, 0, 1, 1, 1, 1, NULL, 'ഗോപാലകൃഷ്ണഗോഖലെ*ബാലഗംഗാധരതിലകന്‍*ആഗാഖാന്‍*മുഹമ്മദാലിജിന്ന', 'ഗോപാലകൃഷ്ണഗോഖലെ', NULL, 1, NULL, 0),
(160, 'ചാര്‍വാക മതത്തിന്റെ ഉപജ്ഞാതാവ്?', 1, 0, 1, 1, 1, 1, NULL, 'അശോകന്‍*കപിലന്‍*ചാണക്യന്‍*ബൃഹസ്പതി', 'ബൃഹസ്പതി', NULL, 1, NULL, 0),
(161, 'എവറസ്റ്റ് സ്ഥിതിചെയ്യുന്ന രാജ്യം?', 1, 0, 1, 1, 1, 1, NULL, 'നേപ്പാള്‍*സിക്കിം*ഭൂട്ടാന്‍*ഇന്ത്യ', 'നേപ്പാള്‍', NULL, 1, NULL, 0),
(162, 'പഞ്ചശീലതത്വത്തില്‍ നെഹ്രുവിനോടൊപ്പം ഒപ്പുവെച്ച ചൈനീസ് നേതാവ്?', 1, 0, 1, 1, 1, 1, NULL, 'ലീപെങ്*ജിയാങ് സെമിന്‍*ചൗ എന്‍ലായ്*മാവോ സേതുങ്', 'ചൗഎന്‍ലായ്', NULL, 1, NULL, 0),
(163, 'സോഷ്യലിസത്തിലധിഷ്ഠിതമായ സാമൂഹ്യവ്യവസ്ഥിതി അംഗീകരിച്ച ആവടി കോണ്‍ഗ്രസ് സമ്മേളനം നടന്ന വര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1955*1956*1957*1958', '1955', NULL, 1, NULL, 0),
(164, 'ക്ഷേമരാഷ്ട്ര സങ്കല്പം ഉപേക്ഷിച്ച് സ്വകാര്യവല്‍ക്കരണത്തിന് തുടക്കമിട്ട ബ്രിട്ടീഷ് പ്രധാനമന്ത്രി?', 1, 0, 1, 1, 1, 1, NULL, 'ജോണ്‍മേജര്‍*മാര്‍ഗരറ്റ്താച്ചര്‍*ടോണി ബ്ലെയര്‍*വിന്‍സ്റ്റണ്‍ ചര്‍ച്ചില്‍', 'മാര്‍ഗരറ്റ് താച്ചര്‍', NULL, 1, NULL, 0),
(165, 'ഗാന്ധിജിയുടെ വധത്തോടുകൂടി നിരോധിക്കപ്പെട്ട സംഘടന ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ജമാഅത്തെ ഇസ്ലാമി*ശിവസേന*ഇന്ത്യന്‍ കമ്യൂണിസ്റ്റ്പാര്‍ട്ടി*ആര്‍.എസ്.എസ്.', 'ആര്‍.എസ്.എസ്.', NULL, 1, NULL, 0),
(166, 'ഗുരുവായൂര്‍ സത്യാഗ്രഹത്തിന്റെ വോളണ്ടിയര്‍ ക്യാപ്റ്റന്‍?', 1, 0, 1, 1, 1, 1, NULL, 'കെ.കേളപ്പന്‍*എ.കെ.ഗോപാലന്‍*പി.കൃഷ്ണപിള്ള*ടി.കെ.മാധവന്‍', 'എ.കെ.ഗോപാലന്‍', NULL, 1, NULL, 0),
(167, 'ജീവിതാന്ത്യത്തില്‍ ശ്രീനാരായണഗുരു ധരിച്ചിരുന്ന വസ്ത്രം?', 1, 0, 1, 1, 1, 1, NULL, 'മഞ്ഞവസ്ത്രം*മേല്‍മുണ്ടുംഷാളും*ഖദര്‍വസ്ത്രം*ഇവയൊന്നുമല്ല', 'ഇവയൊന്നുമല്ല', NULL, 1, NULL, 0),
(168, 'കോണ്‍ഗ്രസ് അധ്യക്ഷ സ്ഥാനത്തേക്ക് ആദ്യമായി മത്സരം നടന്നത് ഏതു സമ്മേളനത്തിലാണ്?', 1, 0, 1, 1, 1, 1, NULL, '51-ാംസമ്മേളനം*52-ാംസമ്മേളനം*53-ാംസമ്മേളനം*54-ാംസമ്മേളനം', '54-ാംസമ്മേളനം', NULL, 1, NULL, 0),
(169, 'താഴെപ്പറയുന്നവയില്‍ വിക്രം സേത്തിന്റെ കൃതി ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'മിഡ്‌നൈറ്റ്‌സ് ചില്‍ഡ്രന്‍*ഗോഡ് ഓഫ് സ്‌മോള്‍ തിങ്‌സ്*ദി ഇന്റര്‍പ്രട്ടേഷന്‍ ഓഫ്ഡ്രീംസ്*എ സ്യൂട്ടബിള്‍ ബോയ്', 'എ സ്യൂട്ടബിള്‍ ബോയ്', NULL, 1, NULL, 0),
(170, 'ഭൂദാനയജ്ഞം തുടങ്ങിയ വര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1950*1951*1952*1953', '1951', NULL, 1, NULL, 0),
(171, 'എക്‌സ്‌റേയ്‌സ് കണ്ടുപിടിച്ചതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'റോണ്‍ജന്‍*റുഥര്‍ഫോര്‍ഡ്*മാഡംക്യൂറി - പിയറിക്യൂറി*ചാഡ്വിക്', 'റോണ്‍ജന്‍', NULL, 1, NULL, 0),
(172, 'സൈബര്‍ സ്‌പേസ് എന്ന പേര് ആദ്യമായി ഉപയോഗിച്ച വ്യക്തി?', 1, 0, 1, 1, 1, 1, NULL, 'വില്യം ഗിബ്‌സണ്‍*ടോംലിന്‍സണ്‍*സ്‌പെന്‍സര്‍*ഇവരാരുമല്ല', 'വില്യംഗിബ്‌സണ്‍', NULL, 1, NULL, 0),
(173, 'കിഴക്കിന്റെ വെനീസ് എന്ന്‌റിയപ്പെടുന്ന പട്ടണം?', 1, 0, 1, 1, 1, 1, NULL, 'കൊച്ചി*കുലശേഖരപുരം*തിരൂര്‍*ആലപ്പുഴ', 'ആലപ്പുഴ', NULL, 1, NULL, 0),
(174, 'ഭക്ഷ്യയോഗ്യമായ കൂണ്‍ ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'അഗാരിക്കസ്*അമാനിറ്റ*റസൂല*ഗണ്‍ഫഌന്റ്', 'അഗാരിക്കസ്', NULL, 1, NULL, 0),
(175, 'രണ്ടാം ലോകമഹായുദ്ധത്തിന്റെ തുടക്കത്തില്‍ ഏതു രാജ്യത്തെയാണ് ഹിറ്റ്‌ലര്‍ ആദ്യം ആക്രമിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, 'അമേരിക്ക*പോളണ്ട്*റഷ്യ*ബ്രിട്ടണ്‍', 'പോളണ്ട്', NULL, 1, NULL, 0),
(176, 'ഏറ്റവും തണുപ്പേറിയ സ്ഥലം?', 1, 0, 1, 1, 1, 1, NULL, 'അറ്റക്കാമ*ലാസ*വോസ്‌റ്റോക്ക്*ലാപസ്', 'വോസ്‌റ്റോക്ക്', NULL, 1, NULL, 0),
(177, 'താഴെപറയുന്നവരില്‍ ജ്ഞാനപീഠ പുരസ്‌കാരം ലഭിച്ചിട്ടില്ലാത്ത വ്യക്തി?', 1, 0, 1, 1, 1, 1, NULL, 'തകഴി ശിവശങ്കരപ്പിള്ള*വൈക്കം മുഹമ്മദ്ബഷീര്‍*എം.ടി.വാസുദേവന്‍ നായര്‍*എസ്.കെ.പൊറ്റക്കാട്', 'വൈക്കം മുഹമ്മദ്ബഷീര്‍', NULL, 1, NULL, 0),
(178, 'ഇന്‍സുലിന്‍ ഉല്പാദിപ്പിക്കുന്ന ഗ്രന്ഥി?', 1, 0, 1, 1, 1, 1, NULL, 'കരള്‍*തൈറോയ്ഡ്*പാന്‍ക്രിയാസ്*ഉമിനീര്‍ഗ്രന്ഥി', 'പാന്‍ക്രിയാസ്', NULL, 1, NULL, 0),
(179, 'സീസ്‌മോഗ്രാഫിന്റെ ഉപയോഗമെന്ത്?', 1, 0, 1, 1, 1, 1, NULL, 'ജനസംഖ്യ വളര്‍ച്ചാനിരക്ക് അറിയാന്‍*ഭാരം അളക്കുന്നതിന്*അഗ്നിപര്‍വതസ്‌ഫോടനം മുന്‍കൂട്ടി അറിയുന്നതിന്*ഭൂചലനങ്ങള്‍ നിരീക്ഷിക്കുന്നതിന്', 'ഭൂചലനങ്ങള്‍ നിരീക്ഷിക്കുന്നതിന്', NULL, 1, NULL, 0),
(180, 'കേരളം മലയാളികളുടെ മാതൃഭൂമിയുടെ കര്‍ത്താവ്?', 1, 0, 1, 1, 1, 1, NULL, 'വള്ളത്തോള്‍*കേശവദേവ്*സുകുമാര്‍ അഴീക്കോട്*ഇ.എം.എസ്', 'ഇ.എം.എസ്', NULL, 1, NULL, 0),
(181, 'സ്വതന്ത്ര ഇന്ത്യയിലെ ആദ്യത്തെ ആഭ്യന്തരമന്ത്രി?', 1, 0, 1, 1, 1, 1, NULL, 'സര്‍ദാര്‍വല്ലഭായിപട്ടേല്‍*ജവഹര്‍ലാല്‍ നെഹ്രു*വി.കെ.കൃഷ്ണമേനോന്‍*ഇവരാരുമല്ല', 'സര്‍ദാര്‍വല്ലഭായിപട്ടേല്‍', NULL, 1, NULL, 0),
(182, 'യൂണിയന്‍ കാര്‍ബൈഡ് കമ്പനിയുടെ ഇപ്പോഴത്തെ ഉടമസ്ഥര്‍?', 1, 0, 1, 1, 1, 1, NULL, 'ഡൗ.കെമിക്കല്‍സ്*ഹിന്ദുസ്ഥാന്‍ ലിവര്‍*ടാറ്റാ*ഇവരാരുമല്ല', 'ഡൗ കെമിക്കല്‍സ്', NULL, 1, NULL, 0),
(183, 'വാസ്‌കോഡഗാമ കാപ്പാട് തീരത്തെത്തിയവര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1857*1706*1855*1498', '1498', NULL, 1, NULL, 0),
(184, 'ഇന്ത്യയില്‍ സതി സമ്പ്രദായം നിര്‍ത്തലാക്കിയത്?', 1, 0, 1, 1, 1, 1, NULL, 'മൗണ്ട്ബാറ്റണ്‍പ്രഭു*ബെന്റിക്്്രപഭു*സൈമണ്‍ കമ്മീഷന്‍*അശോകചക്രവര്‍ത്തി', 'ബെന്റിക്പ്രഭു', NULL, 1, NULL, 0),
(185, 'സിന്ധുനദീതട സംസ്‌കാരം ഒരു------നാഗരിക സംസ്‌കാരമായിരുന്നു', 1, 0, 1, 1, 1, 1, NULL, 'ശിലായുഗം*നവീനശിലായുഗം*താമ്രയുഗം*ഇരുമ്പയുഗം', 'താമ്രയുഗം', NULL, 1, NULL, 0),
(186, 'കോണ്‍ഗ്രസ്-സോഷ്യലിസ്റ്റ് പാര്‍ട്ടി രൂപീകരണവുമായി ബന്ധമില്ലാത്ത വ്യക്തി?', 1, 0, 1, 1, 1, 1, NULL, 'ജയപ്രകാശ് നാരായണ്‍*ആചാര്യ നരേന്ദ്രദേവ്*ജവഹര്‍ലാല്‍നെഹ്രു*അശോക്‌മേത്ത', 'ജവഹര്‍ലാല്‍നെഹ്രു', NULL, 1, NULL, 0),
(187, 'ഗോവര്‍ധനന്റെ യാത്രകള്‍ ആരെഴുതിയതാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ആനന്ദ്*എം.മുകുന്ദന്‍*ഒ.വി.വിജയന്‍*തകഴിശിവശങ്കരപ്പിള്ള', 'ആനന്ദ്', NULL, 1, NULL, 0),
(188, 'എലിപ്പനിയുണ്ടാക്കുന്ന രോഗാണു?', 1, 0, 1, 1, 1, 1, NULL, 'ടൈഫോയ്ഡ് ബാസില*ഇന്‍ഫഌവന്‍സ വൈറസ്*ലൈപ്‌റ്റോസ്‌പൈറ ഇക്ടറോ ഹെമറാജിക്ക*ഇവയൊന്നുമല്ല', 'ലൈപ്‌റ്റോസ്‌പൈറ ഇക്ടറോ ഹെമറാജിക്ക', NULL, 1, NULL, 0),
(189, 'ലോക പത്രസ്വാതന്ത്ര്യദിനം?', 1, 0, 1, 1, 1, 1, NULL, 'ഏപ്രില്‍7*മെയ്3*ജൂണ്‍5*നവംബര്‍14', 'മെയ്3', NULL, 1, NULL, 0),
(190, 'താഴെപ്പറയുന്നവയില്‍ എയ്ഡ്‌സ് രോഗം പകരുന്ന രീതി?', 1, 0, 1, 1, 1, 1, NULL, 'ഒരേപാത്രത്തില്‍ ഭക്ഷണംകഴിക്കുക*ഹസ്തദാനം*ആലിംഗനം*ഇവയൊന്നുമല്ല', 'ഇവയൊന്നുമല്ല', NULL, 1, NULL, 0),
(191, 'FIFAയുടെ ജനറല്‍ സെക്രട്ടറി?', 1, 0, 1, 1, 1, 1, NULL, 'സ്‌റ്റെപ് ബ്ലാറ്റര്‍*ഉര്‍സ്‌ലിന്‍സി*കിച്ച്‌നറേ*ഹ്യൂഗോ ചാവേസ്', 'സ്‌റ്റെപ് ബ്ലാറ്റര്‍', NULL, 1, NULL, 0),
(192, 'Philanthropist is one:', 1, 0, 1, 1, 1, 1, NULL, 'who hates everybody*who loves mankind*who walks along the street*who collect stamps', 'who loves mankind', NULL, 1, NULL, 0),
(193, 'Replace the capitalised words by a suitable single word: He has A LARGE COLLECTION OF BOOKS at home.', 1, 0, 1, 1, 1, 1, NULL, 'bookshop*museum*curios*library', 'library', NULL, 1, NULL, 0),
(194, 'Choose the word nearest in meaning of the capitalised words - He has BURNT HIS FINGERS by attacking a constable:', 1, 0, 1, 1, 1, 1, NULL, 'had a burn injury*got himself into trouble*had a bone fracture*none of the above', ' got himself into trouble', NULL, 1, NULL, 0),
(195, 'Choose the word nearest in meaning of the capitalised words -The celebrated painter''s works have been SOLD FOR A SONG:', 1, 0, 1, 1, 1, 1, NULL, 'at a very high price*at a very low price*in exchange of a song*along with a free song', 'at a very low price', NULL, 1, NULL, 0),
(196, 'You are placed under suspension until-------orders.', 1, 0, 1, 1, 1, 1, NULL, 'farther*future*further*next', 'further', NULL, 1, NULL, 0),
(197, 'I want to meet the artist------- has painted this picture.', 1, 0, 1, 1, 1, 1, NULL, 'which*that*who*whom', 'who', NULL, 1, NULL, 0),
(198, 'They opposed the motion--------was proposed by the rival group.', 1, 0, 1, 1, 1, 1, NULL, 'who*which*where*when', 'which', NULL, 1, NULL, 0),
(199, '--------she had many misfortunes; she is always cheerful.', 1, 0, 1, 1, 1, 1, NULL, 'if*in spite of*although*always', 'although', NULL, 1, NULL, 0),
(200, 'An unmarried women is called:', 1, 0, 1, 1, 1, 1, NULL, 'bachelor*spinster*widow*widower', 'spinster', NULL, 1, NULL, 0),
(201, 'Replace the capitalised words by a suitable single word: He got a loan sanctioned by GREASING THE PALM of the officer concerned.', 1, 0, 1, 1, 1, 1, NULL, 'flattering*bribing*threatening*massaging', 'bribing', NULL, 1, NULL, 0),
(202, 'Things haven''t changed-------- over the past few years.', 1, 0, 1, 1, 1, 1, NULL, 'much*more*many*few', 'much', NULL, 1, NULL, 0),
(203, 'Bibliophile means:', 1, 0, 1, 1, 1, 1, NULL, ' one who loves Bible*one who loves books*a person of strong opinion*one who can be believed', 'one who loves books', NULL, 1, NULL, 0),
(204, 'Honest is ------best policy:', 1, 0, 1, 1, 1, 1, NULL, 'the*a*not*never', 'the', NULL, 1, NULL, 0),
(205, 'She did not smile-----I apologized', 1, 0, 1, 1, 1, 1, NULL, 'still*until*yet*for', 'until', NULL, 1, NULL, 0),
(206, 'We resumed the game ------ it stopped raining', 1, 0, 1, 1, 1, 1, NULL, ' while*where*as soon as*immediately', 'as soon as', NULL, 1, NULL, 0),
(207, 'An animal able to live both in land and water is called:', 1, 0, 1, 1, 1, 1, NULL, 'amphibian*aristocrat*amateur*architect', 'amphibian', NULL, 1, NULL, 0),
(208, 'Which of these words means a form of art?', 1, 0, 1, 1, 1, 1, NULL, 'college*collage*colleague*coolage', 'collage', NULL, 1, NULL, 0),
(209, 'A man whose wife is dead is called:', 1, 0, 1, 1, 1, 1, NULL, 'widow*bachelor*widower*celibate', 'widower', NULL, 1, NULL, 0),
(210, 'The opposite of optimistic is:', 1, 0, 1, 1, 1, 1, NULL, 'obedient*pessimistic*mystic*orderly', 'pessimistic', NULL, 1, NULL, 0),
(211, 'There are------animals in the zoo', 1, 0, 1, 1, 1, 1, NULL, 'much*maximum*several*more', 'several', NULL, 1, NULL, 0),
(212, 'സംബന്ധികാ തത്പരുഷന് ഉദാഹരണം അല്ലാത്തത്?', 1, 0, 1, 1, 1, 1, NULL, 'ശരീരാധ്വാനം*ശരീരപ്രകൃതി*ശരീരസൗന്ദര്യം*ശരീരകാന്തി', 'ശരീരാധ്വാനം', NULL, 1, NULL, 0),
(213, 'താഴെ പറയുന്നവയില്‍ വിധായകപ്രകാരത്തിന് ഉദാഹരണം?', 1, 0, 1, 1, 1, 1, NULL, 'പറയുന്നു*പറയട്ടെ*പറയണം*പറയാം', 'പറയണം', NULL, 1, NULL, 0),
(214, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ആദേശസന്ധിക്ക് ഉദാഹരണം?', 1, 0, 1, 1, 1, 1, NULL, 'കണ്ടില്ല*നെന്മണി*ചാവുന്നു*മയില്‍പ്പീലി', 'നെന്മണി', NULL, 1, NULL, 0),
(215, 'ശരിയായപദം തെരഞ്ഞെടുത്തെഴുതുക', 1, 0, 1, 1, 1, 1, NULL, 'നിഖണ്ഡു*നിഖണ്ടു*നിഘണ്ഡു*നിഖണ്ടു', 'നിഘണ്ടു', NULL, 1, NULL, 0),
(216, '2002ലെ വള്ളത്തോള്‍ അവാര്‍ഡുലഭിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, 'എം.ലീലാവതി*കെ.പി.അപ്പന്‍*സച്ചിദാനന്ദന്‍*സാറാജോസഫ്', 'എം.ലീലാവതി', NULL, 1, NULL, 0),
(217, 'കോവിലന്‍ എന്ന തൂലികാനാമത്തിനുടമ?', 1, 0, 1, 1, 1, 1, NULL, 'എം.ആര്‍.നായര്‍*എം.കെ.മേനോന്‍*വി.മാധവന്‍നായര്‍*പി.വി.അയ്യപ്പന്‍', 'പി.വി.അയ്യപ്പന്‍', NULL, 1, NULL, 0),
(218, 'ശരിയായതര്‍ജമ എഴുതുക - Fruit of the forbidden tree given mortal taste:', 1, 0, 1, 1, 1, 1, NULL, 'വിലക്കപ്പെട്ട കനിയുടെ സ്വാദ് അമൂല്യമാണ്*സ്വാദുള്ള കനികള്‍ വിലക്കപ്പെട്ടവയാണ്*അമൂല്യമായ കനികള്‍ സ്വാദുള്ളവയാണ്*വിലക്കപ്പെട്ട കനിയുടെ സ്വാദ് നശ്വരമാണ്', 'വിലക്കപ്പെട്ട കനിയുടെ സ്വാദ് നശ്വരമാണ്', NULL, 1, NULL, 0),
(219, 'ശരിയായതര്‍ജമ എഴുതുക - I have been having fever for the lat two dsay:', 1, 0, 1, 1, 1, 1, NULL, 'എനിക്ക് കഴിഞ്ഞ രണ്ടുദിവസമായി പനിയാണ്*എനിക്ക് പനി തുടങ്ങിയാല്‍ രണ്ടുദിവസം നീണ്ടുനില്‍ക്കും*എനിക്ക് രണ്ടുദിവസം കൂടി പനി തുടരും*ഞാന്‍ പനിമൂലം രണ്ടുദിവസം കിടന്നു', 'എനിക്ക് കഴിഞ്ഞ രണ്ടുദിവസമായി പനിയാണ്', NULL, 1, NULL, 0),
(220, 'ശരിയായതര്‍ജമ എഴുതുക - I got a message from an alien friend.', 1, 0, 1, 1, 1, 1, NULL, 'വിദേശ സുഹൃത്ത് എനിക്കൊരു സന്ദേശം തന്നു*എനിക്ക് വിദേശ സുഹൃത്തില്‍ നിന്ന് ഒരു സന്ദേശം ലഭിച്ചു*എനിക്ക് കിട്ടിയ സന്ദേശം വിദേശ സുഹൃത്തിന്റേതായിരുന്നു*വിദേശസുഹൃത്തിന്റെ ഒരു സന്ദേശമാണ് എനിക്ക് കിട്ടിയത്', 'എനിക്ക് വിദേശ സുഹൃത്തില്‍ നിന്ന് ഒരു സന്ദേശം ലഭിച്ചു', NULL, 1, NULL, 0),
(221, 'ശരിയായ വാചകം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'വെള്ളപ്പൊക്കം രാജ്യത്ത് അരാജകത്വവും പട്ടിണിയോ ഉണ്ടാക്കുന്നു*അരി ആട്ടിയും നെല്ലു കുത്തിയും കൊടുക്കപ്പെടും*ഹര്‍ത്താല്‍ ജനജീവിതം ദുസ്സഹമാക്കുന്നു*പട്ടി ഉണ്ടോയെന്ന്  നോക്കിയിട്ട് വീട്ടില്‍ പ്രവേശിക്കുക', 'ഹര്‍ത്താല്‍ ജനജീവിതം ദുസ്സഹമാക്കുന്നു', NULL, 1, NULL, 0),
(222, 'FE-5; HG-7; JI-9;----------', 1, 0, 1, 1, 1, 1, NULL, 'KL-11*LK-10*LK-11*KM-11', 'LK-11', NULL, 1, NULL, 0),
(223, '264ന്റെ 12.5% = -------ന്റെ 50%', 1, 0, 1, 1, 1, 1, NULL, '33*16.5*66*132', '66', NULL, 1, NULL, 0),
(224, '15 പേര്‍ 24 ദിവസം കൊണ്ട് ചെയ്തു തീര്‍ക്കുന്ന ജോലി 18 ദിവസം കൊണ്ട് തീര്‍ക്കാന്‍ എത്രപേര്‍ വേണം?', 1, 0, 1, 1, 1, 1, NULL, '20*22*24*21', '20', NULL, 1, NULL, 0),
(225, '4 പേരുടെ ശരാശരി വയസ്സ് 24. അഞ്ചാമത് ഒരാള്‍ കൂടി ചേര്‍ന്നാല്‍ ശരാശരി വയസ്സ് 25. അഞ്ചാമന്റെ വയസ്സെത്ര?', 1, 0, 1, 1, 1, 1, NULL, '26*27*28*29', '29', NULL, 1, NULL, 0),
(226, 'കോഡുപയോഗിച്ച് KOREA യെ LPSFB എന്നെഴുതിയാല്‍ CHINA യെ എങ്ങനെ മാറ്റിയെഴുതാം?', 1, 0, 1, 1, 1, 1, NULL, 'DIJOB*DIJBO*DIBJO*DJIBO', 'DIOB', NULL, 1, NULL, 0),
(227, 'നിഘണ്ടുവിലെ ക്രമത്തില്‍ വരുന്ന നാലാമത്തെ വാക്ക് ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'fired*first*films*finds', 'first', NULL, 1, NULL, 0),
(228, 'താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ ഒന്നൊഴിച്ച് ബാക്കിയെല്ലാം INDEPENDENCE ന്‍റെ ആവര്‍ത്തനമാണ്. വാക്ക് ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'INDEPENDENCE*INDEPENDENCE*INDEPENDENCE*INDEPENEDNCE', 'INDEPENEDCNE', NULL, 1, NULL, 0),
(229, 'രവിയുടെ വയസ്സിന്റെ മൂന്നിരട്ടി അച്ഛന്റെ വയസ്സ്. ഇവര്‍ തമ്മിലുള്ള വയസ്സ് വ്യത്യാസം 20. എങ്കില്‍ രവിക്കെത്ര വയസ്സ്?', 1, 0, 1, 1, 1, 1, NULL, '10*12*20*15', '10', NULL, 1, NULL, 0),
(230, '100;23;95;25;90;--------------', 1, 0, 1, 1, 1, 1, NULL, '85*29*80*27', '21', NULL, 1, NULL, 0),
(231, 'പൂരിപ്പിക്കുക -  ഓസ്‌കാര്‍:സിനിമ   ::  ബുക്കര്‍:---------', 1, 0, 1, 1, 1, 1, NULL, 'നാടകം*സാഹിത്യം*സാമൂഹ്യപ്രവര്‍ത്തനം*സ്‌പോര്‍ട്‌സ്', 'സാഹിത്യം', NULL, 1, NULL, 0),
(232, 'പൂരിപ്പിക്കുക - കാര്‍ഡിയോളജി:ഹൃദയം  ::   ഓഫ്താല്‍മോളജി:--------', 1, 0, 1, 1, 1, 1, NULL, 'കരള്‍*രക്തം*കണ്ണ്*വൃക്ക', 'കണ്ണ്', NULL, 1, NULL, 0),
(233, 'പൂരിപ്പിക്കുക - റേസിംഗ്:റോഡ്   ::  യാട്ടിംഗ്:------', 1, 0, 1, 1, 1, 1, NULL, 'വെള്ളം*ഐസ്*മരുഭൂമി*ആകാശം', 'വെള്ളം', NULL, 1, NULL, 0),
(234, 'പൂരിപ്പിക്കുക - പാരീസ്:ഫ്രാന്‍സ്   ::  കെയ്‌റോ:------', 1, 0, 1, 1, 1, 1, NULL, ' ഇറാഖ്*ഈജിപ്ത്*സിറിയ*ലിബിയ', 'ഈജിപ്ത്', NULL, 1, NULL, 0),
(235, 'കോഡുപയോഗിച്ച് KUWAIT നെ ISUYGR എന്നെഴുതിയാല്‍ MADRAS നെ എങ്ങനെ മാറ്റിയെഴുതാം?', 1, 0, 1, 1, 1, 1, NULL, 'KYBYPQ*KYBPYQ*KYBPQY*KYBQPY', 'KYBPYQ', NULL, 1, NULL, 0),
(236, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 0, 1, 1, 1, 1, NULL, 'ബാംഗ്ലൂര്‍*ഇറ്റാനഗര്‍*മധുര*പാറ്റ്‌ന', 'മധുര', NULL, 1, NULL, 0),
(237, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 0, 1, 1, 1, 1, NULL, 'അരബിന്ദോ*നെഹ്രു*കൃഷ്ണമേനോന്‍*വല്ലഭായ്പട്ടേല്‍', 'അരബിന്ദോ', NULL, 1, NULL, 0),
(238, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 0, 1, 1, 1, 1, NULL, 'LKN*RQT*VUW*CBE', 'VUW', NULL, 1, NULL, 0),
(239, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 0, 1, 1, 1, 1, NULL, 'ഏലം*ബദാം*ജീരകം*ഗ്രാമ്പൂ', 'ബദാം', NULL, 1, NULL, 0),
(240, 'ഒറ്റയാനെ തെരഞ്ഞെടുക്കുക :', 1, 0, 1, 1, 1, 1, NULL, 'വത്സമ്മ*സുനിതാറാണി*ബീനമോള്‍*മല്ലേശ്വരി', 'മല്ലേശ്വരി', NULL, 1, NULL, 0),
(241, 'ഒളിംപിക് അത്‌ലറ്റിക് ഈവന്റില്‍ സെമിഫൈനലിലെത്തിയ പ്രഥമ ഇന്ത്യന്‍വനിത:', 1, 0, 1, 1, 1, 1, NULL, 'പി.ടി.ഉഷ*കമല്‍ജിത്സന്ധു*ഷൈനി വിത്സന്‍*എം.ഡി.വത്സമ്മ', 'ഷൈനിവിത്സന്‍', NULL, 1, NULL, 0),
(242, '2004ലെ സമ്മര്‍ ഒളിംപിക്‌സ് ഏതു നഗരത്തില്‍ വച്ചാണ് നടക്കുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'ഏതന്‍സ്*ടോക്കിയോ*ന്യൂഡ്ല്‍ഹി*റോം', 'ഏതന്‍സ്', NULL, 1, NULL, 0),
(243, 'മാഗ്‌സസെ അവാര്‍ഡ് ലഭിച്ച ആദ്യത്തെ ഇന്ത്യാക്കാരന്‍?', 1, 0, 1, 1, 1, 1, NULL, 'പണ്ഡിറ്റ് രവിശങ്കര്‍*ലതാമങ്കേഷ്‌കര്‍*ഉസ്താദ് അല്ലാ രഖ*ആചാര്യ വിനോബ ഭാവേ', 'ആചാര്യവിനോബാ ഭാവേ', NULL, 1, NULL, 0),
(244, 'ഇന്ത്യയുടെ ആദ്യത്തെ ഉപപ്രധാനമന്ത്രി?', 1, 0, 1, 1, 1, 1, NULL, 'മൊറാര്‍ജി ദേശായി*വല്ലഭായിപട്ടേല്‍*ജഗ്ജീവന്‍ റാം*എല്‍.കെ.അദ്വാനി', 'വല്ലഭായിപട്ടേല്‍', NULL, 1, NULL, 0),
(245, 'കേരളത്തിന്റെ ഔദ്യോഗിക പക്ഷി ഏതാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'വേഴാമ്പല്‍*തത്ത*മൈന*മയില്‍', 'വേഴാമ്പല്‍', NULL, 1, NULL, 0),
(246, 'കേരളത്തിലെ ഏറ്റവും ചെറിയ താലൂക്ക്?', 1, 0, 1, 1, 1, 1, NULL, ' കോതമംഗലം*കാര്‍ത്തികപ്പള്ളി*കൊച്ചി*കുന്നത്തൂര്‍', 'കുന്നത്തൂര്‍', NULL, 1, NULL, 0),
(247, 'തിരുവിതാംകൂറിലെ അവസാനത്തെ രാജാവ് ആരായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'സ്വാതിതിരുനാള്‍*ചിത്തിരതിരുനാള്‍ ബാലരാമവര്‍മ*ശ്രീ മൂലം തിരുനാള്‍*റാണി ഗൗരി ലക്ഷ്മീബായി', 'ചിത്തിര തിരുനാള്‍ ബാലരാമവര്‍മ', NULL, 1, NULL, 0),
(248, 'കേരളത്തില്‍ ഏറ്റവും അവസാനം രൂപീകൃതമായ ജില്ല?', 1, 0, 1, 1, 1, 1, NULL, 'വയനാട്*ഇടുക്കി*പത്തനംതിട്ട*കാസര്‍ഗോഡ്', 'കാസര്‍ഗോഡ്', NULL, 1, NULL, 0),
(249, 'നന്തനാര്‍ എന്ന സാഹിത്യകാരന്റെ യഥാര്‍ഥപേര്?', 1, 0, 1, 1, 1, 1, NULL, 'പി.സി.ഗോപാലന്‍*പി.വി.അയ്യപ്പന്‍*പി.സച്ചിദാനന്ദന്‍*പി.സി.കു്ട്ടികൃഷ്ണന്‍', 'പി.സി.ഗോപാലന്‍', NULL, 1, NULL, 0),
(250, 'അലാഹയുടെ പെണ്‍മക്കള്‍ എന്ന കൃതിയാണ് 2002ലെ സാഹിത്യ അക്കാദമി അവാര്‍ഡ് നേടിയത്. ആരുടെ കൃതിയാണിത്?', 1, 0, 1, 1, 1, 1, NULL, 'എം.മുകുന്ദന്‍*കാക്കനാടന്‍*സാറാ ജോസഫ്*എന്‍.എസ്.മാധവന്‍', 'സാറാജോസഫ്', NULL, 1, NULL, 0),
(251, 'പ്രാചീന കാലത്ത് ബലിത എന്ന പേരില്‍ അറിയപ്പെട്ടിരുന്ന സ്ഥലം?', 1, 0, 1, 1, 1, 1, NULL, 'തിരുനാവായ*വര്‍ക്കല*തിരുവല്ലം*രാമേശ്വരം', 'വര്‍ക്കല', NULL, 1, NULL, 0),
(252, 'ആധുനിക തിരുവിതാംകൂറിന്റെ സ്ഥാപകന്‍ ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'സ്വാതിതിരുനാള്‍*മാര്‍ത്താണ്ഡവര്‍മ*രാജാ കേശവദാസന്‍*സര്‍ സി.പി.രാമസ്വാമിഅയ്യര്‍', 'മാര്‍ത്താണ്ഡവര്‍മ', NULL, 1, NULL, 0),
(253, 'കേരള സാഹിത്യഅക്കാദമിയുടെ ആദ്യത്തെ പ്രസിഡന്റ്?', 1, 0, 1, 1, 1, 1, NULL, 'കെ.പി. കേശവമേനോന്‍*ജി.ശങ്കരക്കുറുപ്പ്*തകഴി ശിവശങ്കരപ്പിള്ള*സര്‍ദാര്‍ കെ.എം.പണിക്കര്‍', 'സര്‍ദാര്‍ കെ.എം.പണിക്കര്‍', NULL, 1, NULL, 0),
(254, 'ഗുരുവായൂര്‍ സത്യഗ്രഹം നടന്നത് ഏതുവര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1931*1932*1936*1921', '1931', NULL, 1, NULL, 0),
(255, 'ലോകത്തിലെ ഏറ്റവും നീളംകൂടിയ ഡാം?', 1, 0, 1, 1, 1, 1, NULL, 'നാഗാര്‍ജുനാസാഗര്‍*ബീസ്*ഭക്ര*ഹിരാക്കുഡ്', 'ഹിരാക്കുഡ്', NULL, 1, NULL, 0),
(256, 'കൊങ്കണ്‍ റെയില്‍വേ താഴെ പറയുന്നവയില്‍ ഒരു സംസ്ഥാനത്തില്‍കൂടി കടന്നു പോകുന്നില്ല; ഏതാണത്?', 1, 0, 1, 1, 1, 1, NULL, 'കര്‍ണാടക*മഹാരാഷ്ട്ര*ആന്ധ്രാപ്രദേശ്*ഗോവ', 'ആന്ധ്രാപ്രദേശ്', NULL, 1, NULL, 0),
(257, 'ഒരു കുട്ടിയുടെ പിതൃത്വം ആരിലെന്നു തെളിയിക്കുവാന്‍ താഴെ പറയുന്ന ഏതു ടെസ്റ്റാണ് നടത്തുക?', 1, 0, 1, 1, 1, 1, NULL, 'ഡി.എന്‍.എ.ടെസ്റ്റ്*പ്രോട്ടീന്‍ അനാലിസിസ്*ക്രോമസോം കൗണ്ടിങ്ങ്*സെമന്‍ടെസ്റ്റ്', 'ഡി.എന്‍.എ.ടെസ്റ്റ്', NULL, 1, NULL, 0),
(258, 'വെള്ളം ശുദ്ധീകരിക്കുവാന്‍ താഴെ പറയുന്നവയില്‍ ഏതാണ് ഉപയോഗിക്കുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'അമോണിയ*ക്ലോറിന്‍*കാര്‍ബണ്‍ഡൈഓക്‌സൈഡ്*ബ്രോമിന്‍', 'ക്ലോറിന്‍', NULL, 1, NULL, 0),
(259, 'ചന്ദനമരങ്ങള്‍ ഏറ്റവും കൂടുതലുള്ള ഇന്ത്യന്‍ സംസ്ഥാനം?', 1, 0, 1, 1, 1, 1, NULL, 'തമിഴ്‌നാട്*ആന്ധ്രാപ്രദേശ്*കര്‍ണാടക*മധ്യപ്രദേശ്', 'കര്‍ണാടക', NULL, 1, NULL, 0),
(260, 'സാര്‍സ് എന്നാല്‍ എന്ത്?', 1, 0, 1, 1, 1, 1, NULL, 'സിവിയര്‍ അക്യൂട്ട് റസ്പിറേറ്ററി സിസ്റ്റം*സിസ്റ്റമിക് അക്യൂട്ട് റീനല്‍ സിന്‍ഡ്രോം*സോളിറ്ററി അക്യൂട്ട് റസ്പിറേറ്ററി സിസ്റ്റം*സിവിയര്‍ അക്യൂട്ട് റസ്പിറേറ്ററി സിന്‍ഡ്രോം', 'സിവിയര്‍ അക്യൂട്ട് റസ്പിറേറ്ററി സിന്‍ഡ്രോം', NULL, 1, NULL, 0),
(261, 'ഏഷ്യന്‍ ഡവലപ്‌മെന്റ് ബാങ്കിന്റെ ഹെഡ്ക്വാര്‍ട്ടേഴ്‌സ് എവിടെ സ്ഥിതിചെയ്യുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'വാഷിങ്ടണ്‍*മനില*സിംഗപ്പൂര്‍*ലണ്ടന്‍', 'മനില', NULL, 1, NULL, 0),
(262, 'ഇന്ത്യയില്‍ ഏറ്റവും കൂടുതല്‍ മഴ ലഭിക്കുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'വിന്റര്‍ സീസണ്‍*തെക്കുപടിഞ്ഞാറന്‍ മണ്‍സൂണ്‍*വടക്കുകിഴക്കന്‍ മണ്‍സൂണ്‍*സമ്മര്‍സീസണ്‍', 'തെക്കുപടിഞ്ഞാറന്‍ മണ്‍സൂണ്‍', NULL, 1, NULL, 0),
(263, 'ഭൗമദിനം (എര്‍ത്ത് ഡേ) ആചരിക്കുന്നത് ഏതു ദിവസമാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'മാര്‍ച്ച് 22*ഏപ്രില്‍ 22*ജൂണ്‍ 2*സെപ്തംബര്‍ 5', 'ഏപ്രില്‍ 22', NULL, 1, NULL, 0),
(264, 'ഒരു മനുഷ്യന്റെ സാധാരണ ശരീരോഷ്മാവ്?', 1, 0, 1, 1, 1, 1, NULL, '98.4F*98.6F*98.8F*98.2F', '98.4F', NULL, 1, NULL, 0),
(265, 'കേട്ട ഗാനം മധുരം കേള്‍ക്കാത്ത ഗാനം മധുരതരം (ഹേര്‍ഡ് മെലഡീസ് ആര്‍ സ്വീറ്റ് ബട്ട് ദോസ് അണ്‍ഹേര്‍ഡ് മെലഡീസ് ആര്‍ സ്വീറ്റര്‍) ഇതിന്റെ രചയിതാവ് ആര?', 1, 0, 1, 1, 1, 1, NULL, 'ഷേക്‌സ്പിയര്‍*രവീന്ദ്രനാഥടാഗോര്‍*കമലാദാസ്*ജോണ്‍കീറ്റ്‌സ്', 'ജോണ്‍കീറ്റ്‌സ്', NULL, 1, NULL, 0),
(266, 'Idosl എന്ന പുസ്തകത്തിന്റെ രചയിതാവ് ആരാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'സുനില്‍ ഗവാസ്‌കര്‍*വിജയ് അമൃതരാജ്*പ്രകാശ് പദുക്കോണ്‍*എം.എ.കെ.പട്ടൗഡി', 'സുനില്‍ ഗവാസ്‌കര്‍', NULL, 1, NULL, 0),
(267, 'ഫെഡറേഷന്‍ ഓഫ് ഇന്ത്യന്‍ ചേംബര്‍ ഓഫ് കോമേഴ്‌സ് (ഫിക്കി) 1927ല്‍ സ്ഥാപിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, 'ടാറ്റയും ബിര്‍ളയും*സിംഘാനിയയും ടാറ്റയും*ടാറ്റയും താക്കൂര്‍ദാസും*ബിര്‍ളയും താക്കൂര്‍ദാസും', 'ബിര്‍ളയും താക്കൂര്‍ദാസും', NULL, 1, NULL, 0),
(268, 'ഗേറ്റ്‌വേ ഓഫ് ഇന്ത്യ പണികഴിക്കാനുള്ള കാരണം?', 1, 0, 1, 1, 1, 1, NULL, 'കിങ് ജോര്‍ജ് അഞ്ചാമന്റെയും ക്യൂന്‍മേരിയുടെയും ഇന്ത്യാ സന്ദര്‍ശനം*രക്തസാക്ഷികളെ സ്മരിക്കാന്‍*റാണിലക്ഷ്മിഭായിയെ അനുസ്മരിക്കാന്‍*വിദേശരാജ്യങ്ങളും ഇന്ത്യയുമായി കച്ചവടബന്ധം സ്ഥാപിച്ചതിനെ സ്മരിക്കാന്‍', 'കിങ് ജോര്‍ജ് അഞ്ചാമന്റെയും ക്യൂന്‍മേരിയുടെയും ഇന്ത്യാ സന്ദര്‍ശനം', NULL, 1, NULL, 0),
(269, 'മൂന്നു വട്ടമേശ സമ്മേളനങ്ങളിലും പങ്കെടുത്തത് ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'ബി.ആര്‍.അംബേദ്കര്‍*എം.എം.മാളവ്യ*വല്ലഭായി പട്ടേല്‍*മഹാത്മാഗാന്ധി', 'ബി.ആര്‍.അംബേദ്കര്‍', NULL, 1, NULL, 0),
(270, 'അലക്‌സാണ്ടര്‍ ഇന്ത്യയെ ആക്രമിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, '327 ബി.സി.*298 ബി.സി.*302 ബി.സി.*303 ബി.സി.', '327 ബി.സി.', NULL, 1, NULL, 0),
(271, 'ഇന്ത്യന്‍ സംസ്ഥാനങ്ങളിലെ പ്രഥമ വനിതാ മുഖ്യമന്ത്രി?', 1, 0, 1, 1, 1, 1, NULL, 'ഷീലാദീക്ഷിത്*സുചേതാ കൃപലാനി*മായാവതി*ജയലളിത', 'സുചേതാ കൃപലാനി', NULL, 1, NULL, 0),
(272, 'കാര്‍ഷിക ആദായനികുതി ഏര്‍പ്പെടുത്തിയ ആദ്യത്തെ ഇന്ത്യന്‍ സംസ്ഥാനം?', 1, 0, 1, 1, 1, 1, NULL, 'പഞ്ചാബ്*മഹാരാഷ്ട്ര*ബീഹാര്‍*ആന്ധ്രാപ്രദേശ്', 'പഞ്ചാബ്', NULL, 1, NULL, 0),
(273, 'ഇന്ത്യന്‍ സംസ്ഥാനങ്ങളില്‍ ഗവര്‍ണറായി നിയമിക്കപ്പെടാനുള്ള പ്രായപരിധി?', 1, 0, 1, 1, 1, 1, NULL, '65 വയസ്സ്*62 വയസ്സ്*35 വയസ്സ്*70 വയസ്സ്', '35വയസ്സ്', NULL, 1, NULL, 0),
(274, 'ഇന്ത്യയിലെ ചാര്‍ളി ചാപഌന്‍ എന്നറിയപ്പെടുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'ഋഷികപൂര്‍*ഷാരൂഖ്ഖാന്‍*അമിതാഭ്ബച്ചന്‍*രാജ്കപൂര്‍', 'രാജ്കപൂര്‍', NULL, 1, NULL, 0),
(275, 'ഒരു ദേശീയ പാര്‍ട്ടിയായി അംഗീകരിക്കുവാന്‍ ഒരു പാര്‍ട്ടിക്ക് ലഭിക്കേണ്ട വോട്ട്?', 1, 0, 1, 1, 1, 1, NULL, '15 ശതമാനം വോട്ട് രണ്ട് സംസ്ഥാനങ്ങളില്‍*നാലുശതമാനം വോട്ട് നാലോ അതിലധികമോ സംസ്ഥാനങ്ങളില്‍*25ശതമാനം വോട്ട് ഏതെങ്കിലും ഒരു സംസ്ഥാനത്തില്‍*ഇതൊന്നുമല്ല', 'ഇതൊന്നുമല്ല', NULL, 1, NULL, 0),
(276, 'രാജിവെക്കണമെന്നു തീരുമാനിക്കുന്ന ഒരു ലോക്‌സഭാ സ്പീക്കര്‍ തന്റെ രാജിക്കത്ത്?', 1, 0, 1, 1, 1, 1, NULL, 'ലോക്‌സഭാ ഡെ.സ്പീക്കര്‍ക്കു നല്‍കണം*രാഷ്ട്രപതിക്കു നല്‍കണം*ഉപരാഷ്ട്രപതിക്കു നല്‍കണം*പ്രധാനമന്ത്രിക്കു നല്‍കണം', 'ലോക്‌സഭാ ഡെ.സ്പീക്കര്‍ക്കു നല്‍കണം', NULL, 1, NULL, 0),
(277, 'വലിയ തോതില്‍ മോണോസൈറ്റ് കാണുന്നത് താഴെപറയുന്ന ഏതു സംസ്ഥാനത്തിലാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'തമിഴ്‌നാട്*കര്‍ണാടക*കേരളം*ബിഹാര്‍', 'കേരളം', NULL, 1, NULL, 0),
(278, 'മത്സ്യോല്പാദനത്തില്‍ ലോകത്ത് ഒന്നാംസ്ഥാനത്തു നില്‍ക്കുന്ന രാജ്യം?', 1, 0, 1, 1, 1, 1, NULL, 'റഷ്യ*നോര്‍വേ*ഇന്ത്യ*ജപ്പാന്‍', 'ജപ്പാന്‍', NULL, 1, NULL, 0),
(279, 'നാട്ടുരാജ്യങ്ങളെ ഏകീകരിച്ച് ഇന്ത്യന്‍ യൂണിയന്‍ സ്ഥാപിക്കുവാന്‍ മുഖ്യപങ്ക് വഹിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, 'മഹാത്മാഗാന്ധി*സര്‍ദാര്‍ വല്ലഭായി പട്ടേല്‍*ജവഹര്‍ലാല്‍ നെഹ്രു*ലോകമാന്യ തിലകന്‍', 'സര്‍ദാര്‍ വല്ലഭായി പട്ടേല്‍', NULL, 1, NULL, 0),
(280, 'ഇന്ത്യയില്‍ ആദ്യമായി രൂപ ഉപയോഗത്തില്‍ കൊണ്ടുവന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'ഷേര്‍ഷാ*അശോകന്‍*അക്ബര്‍*ജഹാംഗീര്‍', 'ഷേര്‍ഷാ', NULL, 1, NULL, 0),
(281, 'ഇന്ത്യാചരിത്രത്തിലെ ഒരു വഴിത്തിരിവായ ഈ യുദ്ധമാണ് മുഗള്‍ സാമ്രാജ്യം സ്ഥാപിക്കാന്‍ വഴിയൊരുക്കിയത്?', 1, 0, 1, 1, 1, 1, NULL, 'കലിംഗയുദ്ധം*പ്ലാസിയുദ്ധം*ഒന്നാം പാനിപ്പട്ട് യുദ്ധം*മൂന്നാം പാനിപ്പട്ട് യുദ്ധം', 'ഒന്നാം പാനിപ്പട്ട് യുദ്ധം', NULL, 1, NULL, 0),
(282, 'ഇന്ത്യന്‍ നാഷണല്‍ കോണ്‍ഗ്രസിന്റെ പ്രഥമ വനിതാ പ്രസിഡന്റ്?', 1, 0, 1, 1, 1, 1, NULL, 'ആനിബസന്റ്*വിജയലക്ഷ്മിപണ്ഡിറ്റ്*ഇന്ദിരാഗാന്ധി*സരോജിനിനായിഡു', 'ആനിബസന്റ്', NULL, 1, NULL, 0),
(283, 'ഇന്റര്‍നാഷണല്‍ ഒളിമ്പിക് കമ്മിറ്റിയുടെ ഗോള്‍ഡ് മെഡല്‍ ഓഫ് ഒളിമ്പിക് ഓര്‍ഡര്‍ ലഭിച്ച പ്രഥമ വനിത?', 1, 0, 1, 1, 1, 1, NULL, 'ഇന്ദിരാഗാന്ധി*പി.ടി.ഉഷ*വിജയലക്ഷ്മിപണ്ഡിറ്റ്*ഷൈനിവിത്സണ്‍', 'ഇന്ദിരാഗാന്ധി', NULL, 1, NULL, 0),
(284, 'ഈ ബ്രിട്ടീഷ് മിഷണറിയെ ഇന്ത്യാക്കാര്‍ സ്‌നേഹപൂര്‍വം ദീനബന്ധു എന്നുവിളിച്ചു', 1, 0, 1, 1, 1, 1, NULL, 'ആനിബസന്റ്*സി.എഫ്.ആന്‍ഡ്രൂസ്*സര്‍ വില്യം ജോണ്‍സ്*ജോണ്‍ ഹിഗ്ഗിന്‍സ്', 'സി.എഫ്.ആന്‍ഡ്രൂസ്', NULL, 1, NULL, 0);
INSERT INTO `questions` (`id`, `question`, `set_id`, `exam_id`, `subject_id`, `section_id`, `difficulty_level_id`, `language_id`, `image`, `options`, `answer`, `question_import_id`, `question_status_id`, `organization_id`, `share`) VALUES
(285, 'നൈറ്റിംഗേല്‍ ഓഫ് ഇന്ത്യ എന്നറിയപ്പെടുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'ലതാമങ്കേഷ്‌കര്‍*സരോജിനിനായിഡു*എം.എസ്.സുബ്ബലക്ഷ്മി*വിജയലക്ഷ്മിപണ്ഡിറ്റ്', 'സരോജിനിനായിഡു', NULL, 1, NULL, 0),
(286, 'ബെയര്‍ഫൂട്ട് പെയിന്റര്‍ എന്നറിയപ്പെടുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'പിക്കാസോ*ആര്‍.കെ.ലക്ഷ്മണന്‍*രാജാരവിവര്‍മ*എം.എഫ്.ഹുസൈന്‍', 'എം.എഫ്.ഹുസൈന്‍', NULL, 1, NULL, 0),
(287, 'ഇന്ത്യയിലാദ്യമായി മുസ്ലീം ആക്രമണം തുടങ്ങിയതാര്?', 1, 0, 1, 1, 1, 1, NULL, 'ബാബര്‍*നാദിര്‍ഷാ*മുഹമ്മദ് ഗസ്‌നി*മുഹമ്മദ് ഗോറി', 'മുഹമ്മദ് ഗസ്‌നി', NULL, 1, NULL, 0),
(288, 'ഇന്ത്യയുടെ ദേശീയഗാനമായ ജനഗണമന ആദ്യമായി ആലപിക്കപ്പെട്ടത് എവിടെ?', 1, 0, 1, 1, 1, 1, NULL, 'ഡല്‍ഹി*കല്‍ക്കത്ത*പാട്യാല*ലാഹോര്‍', 'കല്‍ക്കത്ത', NULL, 1, NULL, 0),
(289, 'ഇന്ത്യയില്‍ റെയില്‍വേ സംവിധാനം നിലവില്‍ വന്ന വര്‍ഷത്തിലെ ഇന്ത്യയുടെ ഗവര്‍ണര്‍ ജനറല്‍ ആരായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'റിപ്പണ്‍*ഹാര്‍ഡിങ്*കഴ്‌സണ്‍*ഡല്‍ഹൗസി', 'ഡല്‍ഹൗസി', NULL, 1, NULL, 0),
(290, 'ചൗരിചൗര സംഭവത്തിന്റെ ഫലമായി പെട്ടെന്നു നിര്‍ത്തിവെക്കേണ്ടിവന്ന് പ്രക്ഷോഭം?', 1, 0, 1, 1, 1, 1, NULL, 'ഹോംറൂള്‍ പ്രസ്ഥാനം*വഹാബി പ്രസ്ഥാനം*നിസ്സഹകരണപ്രസ്ഥാനം*ഡിസ്ഒബീഡിയന്‍സ് പ്രസ്ഥാനം', 'നിസ്സഹകരണപ്രസ്ഥാനം', NULL, 1, NULL, 0),
(291, 'I am not older than you---------', 1, 0, 1, 1, 1, 1, NULL, 'aren''t I*amn''t I*weren''t I*am I', 'amI', NULL, 1, NULL, 0),
(292, 'The idiom tooth and nail means', 1, 0, 1, 1, 1, 1, NULL, 'without weapon*with all the power*with the available weapon*without courage', 'with all the power', NULL, 1, NULL, 0),
(293, 'He was angry-------- he listened to me', 1, 0, 1, 1, 1, 1, NULL, 'though*despite*neverthless*beause', 'neverthless', NULL, 1, NULL, 0),
(294, 'He talked as if he---------rich', 1, 0, 1, 1, 1, 1, NULL, 'is*was*had been*might have been', 'was', NULL, 1, NULL, 0),
(295, 'Exhort means', 1, 0, 1, 1, 1, 1, NULL, 'advise strongly*accuse*indict*warm', 'advise strongly', NULL, 1, NULL, 0),
(296, 'The committee has to find an ------ date for the meeting', 1, 0, 1, 1, 1, 1, NULL, 'alternate*alternative*alternatively*alternation', 'alternative', NULL, 1, NULL, 0),
(297, 'Sam is very clever ------ cooking', 1, 0, 1, 1, 1, 1, NULL, 'in*at*with*on', 'at', NULL, 1, NULL, 0),
(298, 'The phrase ''in cold blood'' means', 1, 0, 1, 1, 1, 1, NULL, 'indifferently*cruely*thoughtlessly*deliberately', 'cruely', NULL, 1, NULL, 0),
(299, 'Children can usually ------ their parents', 1, 0, 1, 1, 1, 1, NULL, 'get over*get through*get on*get round', 'get round', NULL, 1, NULL, 0),
(300, 'The opposite of vociferous is', 1, 0, 1, 1, 1, 1, NULL, 'faint*clamour*noisy*rumpus', 'faint', NULL, 1, NULL, 0),
(301, 'If the workmen had not been tired; they --------- the work', 1, 0, 1, 1, 1, 1, NULL, 'would have completed*would complete*will complete*will have completed', 'would have completed', NULL, 1, NULL, 0),
(302, 'Hardly --------- see the picture', 1, 0, 1, 1, 1, 1, NULL, 'I can*I could*can I*can''t I', 'I could', NULL, 1, NULL, 0),
(303, 'We are quite used to --------- in queues', 1, 0, 1, 1, 1, 1, NULL, 'wait*waiting*waited*have waited', 'waiting', NULL, 1, NULL, 0),
(304, 'Stubborn means', 1, 0, 1, 1, 1, 1, NULL, 'shameless*fearless*courageous*obstinate', 'obstinate', NULL, 1, NULL, 0),
(305, 'The study of the origin and history of words', 1, 0, 1, 1, 1, 1, NULL, 'Etymology*Entomology*Phonology*Phonetics', 'Etymology', NULL, 1, NULL, 0),
(306, 'Much water has ---------- under the London bridge', 1, 0, 1, 1, 1, 1, NULL, 'frown*flowed*flew*followed', 'flown', NULL, 1, NULL, 0),
(307, 'Sheela has two brothers. She does not like -------- of them', 1, 0, 1, 1, 1, 1, NULL, 'neither*any*either*none', 'either', NULL, 1, NULL, 0),
(308, 'A person who sacrifices his life for a cause', 1, 0, 1, 1, 1, 1, NULL, 'patriot*martyr*revolutionary*soldier', 'martyr', NULL, 1, NULL, 0),
(309, 'Some rules are very rigid: others are-----------', 1, 0, 1, 1, 1, 1, NULL, 'unrigid*hard and fast*loose*flexible', 'flexible', NULL, 1, NULL, 0),
(310, 'The door bell ------- for the last ten minutes', 1, 0, 1, 1, 1, 1, NULL, 'was ringing*is ringing*has been ringing*had been ringing', 'has been ringing', NULL, 1, NULL, 0),
(311, 'ശരിയായ തര്‍ജമ ഏത്?  The boat gradually gathered way:', 1, 0, 1, 1, 1, 1, NULL, 'ബോട്ട് ക്രമേണ വഴിമാറിപ്പോയി*ക്രമേണ ബോ്ട്ട് നേരായ വഴിയിലെത്തി*ബോട്ട് നേരായ വഴിയിലൂടെ പോയി*ബോട്ടിന് ക്രമേണ വേഗത കൂടി', 'ബോട്ടിന് ക്രമേണ വേഗത കൂടി', NULL, 1, NULL, 0),
(312, 'ശരിയായ തര്‍ജമ ഏത്?  The police ran down the criminal:', 1, 0, 1, 1, 1, 1, NULL, 'പോലീസ് കുറ്റവാളിയെ തുരത്തിയോടിച്ചു*പോലീസ് കുറ്റവാളിയെ ഓടിച്ചു പിടിച്ചു*പോലീസ് കുറ്റവാളിയെ താഴേയ്ക്ക് ഓടിച്ചു*കുറ്റവാളി പോലീസിന്റെ കയ്യില്‍ നിന്ന് ഓടി രക്ഷപ്പെട്ടു', 'പോലീസ് കുറ്റവാളിയെ താഴേയ്ക്ക് ഓടിച്ചു', NULL, 1, NULL, 0),
(313, 'ശരിയായ തര്‍ജമ ഏത്?  Finally he fell in with my plan:', 1, 0, 1, 1, 1, 1, NULL, 'ഒടുവില്‍ എന്റെ പദ്ധതിയില്‍ അവന്‍ വീണുപോയി*ഒടുവില്‍ എ്‌ന്റെ പദ്ധതിയോട് അവന്‍ വിയോജിച്ചു*ഒടുവില്‍ അവന്‍ എന്റെ പദ്ധതിയോട് യോജിച്ചു*ഒടുവില്‍ എന്റെ പദ്ധതി അവന്‍ ഉപേക്ഷിച്ചു ', 'ഒടുവില്‍ അവന്‍ എന്റെ പദ്ധതിയോട് യോജിച്ചു', NULL, 1, NULL, 0),
(314, 'കര്‍മധാരായ സമാസം അല്ലാത്ത പദമേത്?', 1, 0, 1, 1, 1, 1, NULL, 'തോള്‍വള*പീതാംബരം*കൊന്നത്തെങ്ങ്*നീലാകാശം', 'തോള്‍വള', NULL, 1, NULL, 0),
(315, 'വ്യാകരണപരമായി വേറിട്ടു നില്‍ക്കുന്ന പദമേത്?', 1, 0, 1, 1, 1, 1, NULL, 'വേപ്പ്*ഉപ്പ്*പരിപ്പ്*നടപ്പ്', 'നടപ്പ്', NULL, 1, NULL, 0),
(316, 'ശരിയായ വാക്യമേത്?', 1, 0, 1, 1, 1, 1, NULL, 'പരീക്ഷ കഠിമായതാണ് കുട്ടികള്‍ തോല്‍ക്കാന്‍ കാരണം*ഓരോ പഞ്ചായത്ത് തോറും ഓരോ ആശുപത്രി ആവശ്യമാണ്*അഴിമതി തീര്‍ച്ചയായും തുടച്ചു നീക്കുകതന്നെ വേണം*പരീക്ഷ കഠിനമായതുകൊണ്ടാണ് കുട്ടികള്‍ തോല്ക്കാന്‍ കാരണം', 'പരീക്ഷ കഠിമായതാണ് കുട്ടികള്‍ തോല്‍ക്കാന്‍ കാരണം', NULL, 1, NULL, 0),
(317, 'വെള്ളം കുടിച്ചു - ഇതില്‍ വെള്ളം എന്ന പദം ഏത് വിഭക്തിയില്‍?', 1, 0, 1, 1, 1, 1, NULL, 'നിര്‍ദ്ദേശിക*പ്രതിഗ്രാഹിക*സംബന്ധിക*ഉദ്ദേശിക', 'പ്രതിഗ്രാഹിക', NULL, 1, NULL, 0),
(318, 'ശരിയായ രൂപമേത്?', 1, 0, 1, 1, 1, 1, NULL, 'വൃച്ഛികം*വൃച്ഛിഗം*വൃശ്ചികം*വൃശ്ചിഗം', 'വൃച്ഛികം', NULL, 1, NULL, 0),
(319, 'താഴെ കൊടുത്തിട്ടുള്ള പ്രയോഗത്തിന്റെ അര്‍ഥമെന്ത്?ശ്ലോകത്തില്‍ കഴിക്കുക', 1, 0, 1, 1, 1, 1, NULL, 'ശ്ലോകം ചൊല്ലുക*പതുക്കെ ചെയ്യുക*ഏറെച്ചുരുക്കുക*പരത്തിപ്പറയുക', 'ഏറെച്ചുരുക്കുക', NULL, 1, NULL, 0),
(320, 'അവന്‍ എന്നതിലെ സന്ധി:', 1, 0, 1, 1, 1, 1, NULL, 'ആദേശം*ലോപം*ദ്വിത്വം*ആഗമം', 'ആഗമം', NULL, 1, NULL, 0),
(321, 'വിജ്ഞാനത്തിന് വായന എന്നപോലെയാണ് ആരോഗ്യത്തിന്?', 1, 0, 1, 1, 1, 1, NULL, 'വ്യായാമം*ആഹാരം*ശീലം*ശരീരം', 'വ്യായാമം', NULL, 1, NULL, 0),
(322, 'പുസ്തകത്തിന് ഗ്രന്ഥകാരനെന്ന പോലെയാണ് പ്രതിമയ്ക്ക്?', 1, 0, 1, 1, 1, 1, NULL, 'മോഡല്‍*ശില്പി*മാര്‍ബിള്‍*ശില', 'ശില്പി', NULL, 1, NULL, 0),
(323, 'താഴെ തന്നിട്ടുള്ള ശ്രേണിയില്‍ ചില അക്ഷരങ്ങള്‍ വിട്ടിരിക്കുന്നു. വിട്ടിട്ടുള്ള അക്ഷരങ്ങള്‍ ക്രമത്തില്‍ എഴുതിയിട്ടുള്ളത് ഏതെന്ന് കണ്ടെത്തുക a-aa-ab-aa-a-a', 1, 0, 1, 1, 1, 1, NULL, 'aabba*abbaa*ababa*babab', 'babab', NULL, 1, NULL, 0),
(324, 'രോഗത്തിന് രോഗശമനം എന്ന പോലെയാണ് പ്രശ്‌നത്തിന്?', 1, 0, 1, 1, 1, 1, NULL, 'വിശകലനംചെയ്യല്‍*അനുഭവിക്കല്‍*അവഗണിക്കല്‍*പരിഹരിക്കല്‍', 'പരിഹരിക്കല്‍', NULL, 1, NULL, 0),
(325, 'താഴെ തന്നിരിക്കുന്ന നാലു വാക്കുകളില്‍ മൂന്നെണ്ണം തമ്മില്‍ ഒരു സാദൃശ്യം ഉണ്ട്. സാദൃശ്യമില്ലാത്തത് കണ്ടുപിടിക്കുക?', 1, 0, 1, 1, 1, 1, NULL, 'ആന*മുയല്‍*ആട്*പൂച്ച', 'പൂച്ച', NULL, 1, NULL, 0),
(326, 'പ്രഭയ്ക്ക് 90 മീറ്റര്‍ 2 മിനിട്ടുകൊണ്ട് നടക്കാന്‍ സാധിക്കുമെങ്കില്‍ 225 മീറ്റര്‍ നടക്കാന്‍ എത്ര സമയമെടുക്കും?', 1, 0, 1, 1, 1, 1, NULL, '3.5മിനിട്ട്*4.5മിനിട്ട്*5മിനിട്ട്*7.5മിനിട്ട്', '5മിനിട്ട്', NULL, 1, NULL, 0),
(327, 'ഒരു കോഡനുസരിച്ച് GOAT എന്ന് എഴുതിയിരിക്കുന്നത് CKWP എന്നാണ്. ഇതേ കോഡുപയോഗിച്ച് എഴുതിയ DWNA താഴെ തന്നിട്ടുള്ളവയില്‍ ഏതിനെ സൂചിപ്പിക്കുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'BEAR*DEER*HARE*MARE', 'HARE', NULL, 1, NULL, 0),
(328, 'ഈ ചോദ്യത്തിലെ സംഖ്യകള്‍ ഒരു പ്രത്യേക രീതിയില്‍ ക്രമീകരിച്ചിരിക്കുന്നു. നിരയില്‍ വിട്ടുപോയ സംഖ്യ ഏതെന്ന് കണ്ടുപിടിക്കുക 12;21;33;23;32;-----?', 1, 0, 1, 1, 1, 1, NULL, '46*55*65*75', '55', NULL, 1, NULL, 0),
(329, 'സിംല കുളുവിനേക്കാളും തണുപ്പുള്ളതും; ശ്രീനഗര്‍ ഷില്ലോംഗിനേക്കാളും തണുപ്പുള്ളതും; നൈനിറ്റാള്‍ സിംലയെക്കാളും തണുപ്പുള്ളതും പക്ഷേ ഷില്ലോംഗിനേക്കാളും ചൂടുള്ളതുമാണെങ്കില്‍ ഏറ്റവും ചൂടുള്ള സ്ഥലമേത്?', 1, 0, 1, 1, 1, 1, NULL, 'സിംല*നൈനിറ്റാള്‍*കുളു*ഷില്ലോംഗ്', 'കുളു', NULL, 1, NULL, 0),
(330, 'താഴെ കൊടുത്തിരിക്കുന്ന ഖണ്ഡിക വായിച്ച് അതിനെ അടിസ്ഥാനപ്പെടുത്തി ചോദിച്ചിട്ടുള്ള ചോദ്യത്തിന് ഉത്തരം കാണുക? ഒരു ചോദ്യക്കടലാസില്‍ 12 ചോദ്യങ്ങളാണുള്ളത്. ഇതില്‍ ആറെണ്ണത്തിന്റെ ഉത്തരം എഴുതണം.ആറു ചോദ്യങ്ങള്‍ക്ക് ഓരോ ചോയ്‌സും ഉണ്ട്. ഓരോ ചോദ്യത്തിന് നാലു ഭാഗങ്ങളുണ്ട്. അതില്‍ മൂന്നെണ്ണത്തിന് ഉത്തരം എഴുതണം. ഇതില്‍ എത്രഭാഗങ്ങള്‍ക്ക് ഉത്തരമെഴുതണം?', 1, 0, 1, 1, 1, 1, NULL, '6*12*15*18', '18', NULL, 1, NULL, 0),
(331, 'താഴെകാണുന്ന അക്ഷരശ്രേണിയില്‍ വിട്ടുപോയ അക്ഷരക്കൂട്ടം ഏതെന്നു കണ്ടുപിടിക്കുക:    ------;fmt; kry; pwd; ubi', 1, 0, 1, 1, 1, 1, NULL, 'aho*ago*afo*ako', 'aho', NULL, 1, NULL, 0),
(332, 'സമയമെന്തായി എന്ന ചോദ്യത്തിന് ഒരാള്‍ മറുപടി നല്‍കി;ദിവസത്തില്‍ പിന്നിട്ട സമയത്തിന്റെ ഏഴിലൊന്നും അവശേഷിക്കുന്ന സമയവും തുല്യം. സമയമെന്തായിരിക്കും?', 1, 0, 1, 1, 1, 1, NULL, '3pm*9pm*4pm*9am', '9pm', NULL, 1, NULL, 0),
(333, 'Aയുടെ പ്രായം Bയുടെ ഇരട്ടിയാണ്. 8 കൊല്ലം മുമ്പ് Aയുടെ പ്രായം Bയുടെ മൂന്നുമടങ്ങായിരുന്നെങ്കില്‍ Aയുടെ പ്രായം എന്ത്?', 1, 0, 1, 1, 1, 1, NULL, '32*16*9*8', '32', NULL, 1, NULL, 0),
(334, 'HOTEL എന്നത് 60 ആയും CAR എന്നത് 22 ആയും കോഡ് ചെയ്താല്‍ SCOOTER എന്നതിന് എന്തെഴുതും?', 1, 0, 1, 1, 1, 1, NULL, '33*44*81*95', '95', NULL, 1, NULL, 0),
(335, '1+2=31; 2+3=51; 3+4=71 ആയാല്‍ 4+5=-------?', 1, 0, 1, 1, 1, 1, NULL, '81*91*61*51', '91', NULL, 1, NULL, 0),
(336, 'താഴെ നാല് അക്ഷരക്കൂട്ടങ്ങള്‍ കൊടുത്തിട്ടുണ്ട്. ഇവയില്‍ ഒരെണ്ണം മറ്റു മൂന്നില്‍ നിന്ന് ചില കാര്യങ്ങളില്‍ വ്യത്യസ്തമായിരിക്കും. അത് ഏതെന്ന് കണ്ടുപിടിക്കുക?', 1, 0, 1, 1, 1, 1, NULL, 'IMQU*BFJN*JNRV*GKOR', 'GKOR', NULL, 1, NULL, 0),
(337, 'മഹേഷ് A എന്ന സ്ഥലത്തു നിന്നു പുറപ്പെട്ട് 1 കി.്മീ. തെക്കോട്ട്ു നടന്നിട്ട് ഇടത്തോട്ട് തിരിഞ്ഞ് 1 കി.മീ. കൂടി നടക്കുന്നു. പിന്നീട് വീണ്ടും ഇടത്തോട്ടു തിരിഞ്ഞ് 1 കി.മീ. കൂടി നടക്കുന്നു. എങ്കില്‍ ഏതു ദിശയിലേക്കാണ് അയാള്‍ ഇപ്പോള്‍ പോകുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'വടക്ക്*കിഴക്ക്*തെക്ക്*പടിഞ്ഞാറ്', 'വടക്ക്', NULL, 1, NULL, 0),
(338, '50 ഉദ്യോഗാര്‍ഥികള്‍ക്കുവേണ്ടി പബ്ലിക് സര്‍വീസ് കമ്മീഷന്‍ നടത്തിയ പരീക്ഷയില്‍ ഒരാള്‍ക്ക് ഇരുപതാമത്തെ റാങ്കുകിട്ടി എങ്കില്‍ താഴെനിന്നും അയാളുടെ റാങ്കെത്ര?', 1, 0, 1, 1, 1, 1, NULL, '29*30*31*32', '31', NULL, 1, NULL, 0),
(339, 'ഇന്ത്യയില്‍ മുസ്ലീം ഭരണം സ്ഥാപിക്കുന്നതിനു മുമ്പ് ഭരിച്ചുകൊണ്ടിരുന്ന അവസാന ഹിന്ദുരാജാവ്?', 1, 0, 1, 1, 1, 1, NULL, 'കനിഷ്‌കന്‍*ചന്ദ്രഗുപ്തന്‍*റാണി ലക്ഷ്മിബായി*പൃഥ്വിരാജ് ചൗഹാന്‍', 'പൃഥ്വിരാജ് ചൗഹാന്‍', NULL, 1, NULL, 0),
(340, 'ഇന്ത്യക്ക് സ്വാതന്ത്ര്യം ലഭിച്ച സമയത്ത് ഇന്ത്യന്‍ നാഷണല്‍ കോണ്‍ഗ്രസ് പ്രസിഡന്റ് ആരായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'ജെ.ബി.കൃപലാനി*സര്‍ദാര്‍ വല്ലഭായ് പട്ടേല്‍*ജവഹര്‍ലാല്‍ നെഹ്രു*മഹാത്മാഗാന്ധി', 'ജെ.ബി.കൃപലാനി', NULL, 1, NULL, 0),
(341, 'സ്വപ്‌നവാസവദത്ത; ദൂതവാക്യ എന്നിവയുടെ കര്‍ത്താവ്?', 1, 0, 1, 1, 1, 1, NULL, 'കാളിദാസന്‍*ഭാസന്‍*വ്യാസന്‍*ബാണഭട്ടന്‍', 'ഭാസന്‍', NULL, 1, NULL, 0),
(342, 'ലോകത്ത് ഏറ്റവും കൂടുതല്‍ മുസ്ലീം ജനസംഖ്യയുള്ള രാജ്യം?', 1, 0, 1, 1, 1, 1, NULL, 'ഇന്തോനേഷ്യ*പാകിസ്ഥാന്‍*ബംഗ്ലാദേശ്*അഫ്ഘാനിസ്ഥാന്‍', 'ഇന്തോനേഷ്യ', NULL, 1, NULL, 0),
(343, 'ആഗ്രാ പട്ടണത്തിന്റെ നിര്‍മാതാവ് ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'അല്ലാവുദ്ദീന്‍ ഖില്‍ജി*മുഹമ്മദ് ബിന്‍ തുഗ്ലക്ക്*സിക്കന്ദര്‍ ലോദി*ഫിറൂസ് തുഗ്ലക്ക്', 'സിക്കന്ദര്‍ലോദി', NULL, 1, NULL, 0),
(344, 'ഇന്ത്യയിലെ ഒന്നാമത്രെ വൈസ്രോയി?', 1, 0, 1, 1, 1, 1, NULL, 'ലോര്‍ഡ് മൗണ്ട് ബാറ്റണ്‍*ലോര്‍ഡ് മെക്കാളെ*ലോര്‍ഡ് വെല്ലിംഗ്ടണ്‍*ലോര്‍ഡ് കാനിംഗ്', 'ലോര്‍ഡ് കാനിംഗ്', NULL, 1, NULL, 0),
(345, 'ഏറ്റവും അവസാനം സ്വതന്ത്രഇന്ത്യയുമായി കൂട്ടിച്ചേര്‍ക്കപ്പെട്ട വിദേശ കോളനി?', 1, 0, 1, 1, 1, 1, NULL, 'മാഹി*ഗോവ*പോണ്ടിച്ചേരി*ആന്‍ഡമാന്‍-നിക്കോബാര്‍', 'ഗോവ', NULL, 1, NULL, 0),
(346, 'ക്വിറ്റ്ഇന്ത്യാ പ്രക്ഷോഭം ആരംഭിച്ചത് ------ന്റെ പരാജയത്തിനു ശേഷമായിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'ക്യാബിനറ്റ് മിഷന്‍*ക്രിപ്‌സ്മിഷന്‍*സിംലാ കോണ്‍ഫറന്‍സ്*ദണ്ഡിമാര്‍ച്ച്', 'ക്രിപ്‌സ്മിഷന്‍', NULL, 1, NULL, 0),
(347, 'ഇന്ത്യയും പാക്കിസ്ഥാനുമായി അഷ്‌കെന്റ് കരാര്‍ ഒപ്പിട്ടത് ഏതു വര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1964*1965*1966*1967', '1966', NULL, 1, NULL, 0),
(348, 'ശ്രീശങ്കരനാല്‍ സ്ഥാപിക്കപ്പെടാത്ത സന്യാസിമഠം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ബദരീനാഥ്*കാലടി*ജഗന്നാഥപുരി*ദ്വാരക', 'കാലടി', NULL, 1, NULL, 0),
(349, '''ജയ് ജവാന്‍ ജയ് കിസാന്‍'' എന്ന മുദ്രാവാക്യം ആദ്യമായി ഉയര്‍ത്തിയത് ആര്?', 1, 0, 1, 1, 1, 1, NULL, 'ലാല്‍ ബഹാദൂര്‍ ശാസ്ത്രി*ഇന്ദിരാഗാന്ധി*ജവഹര്‍ലാല്‍നെഹ്രു*ജഗ്ജീവന്‍ റാം', 'ലാല്‍ബഹാദൂര്‍ശാസ്ത്രി', NULL, 1, NULL, 0),
(350, 'ബൈസൈക്കിള്‍ ആദ്യമായി ഇന്ത്യയില്‍ വന്ന വര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1905*1880*1910*1890', '1890', NULL, 1, NULL, 0),
(351, 'ഏറ്റവും കുറഞ്ഞ പ്രായത്തില്‍ ഇന്ത്യയുടെ രാഷ്ട്രപതി ആയ വ്യക്തി?', 1, 0, 1, 1, 1, 1, NULL, 'വി.വി.ഗിരി*കെ.ആര്‍.നാരായണന്‍*നീലം സഞ്ജീവറെഡ്ഡി*ഡോ.എസ്.രാധാകൃഷ്ണന്‍', 'നീലംസഞ്ജീവറെഡ്ഡി', NULL, 1, NULL, 0),
(352, 'ദേശീയ രാഷ്ട്രീയത്തിലേക്കുള്ള മഹാത്മാഗാന്ധിയുടെ പ്രവേശനം താഴെ കൊടുക്കുന്നവയില്‍ ഏതില്‍ക്കൂടി ആയിരുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'നിസ്സഹകരണപ്രസ്ഥാനം*റൗലറ്റ് സത്യാഗ്രഹം*ചമ്പാരന്‍ പ്രസ്ഥാനം*ദണ്ഡിമാര്‍ച്ച്', 'റൗലറ്റ് സത്യാഗ്രഹം', NULL, 1, NULL, 0),
(353, '''താജ്മഹല്‍'' ഏതു നദീതീരത്ത് സ്ഥിതിചെയ്യുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'സിന്ധു*യമുന*കാവേരി*ഗംഗ', 'യമുന', NULL, 1, NULL, 0),
(354, 'ഇന്ത്യയിലെ 14 ബാങ്കുകള്‍ ആദ്യമായി ദേശസാല്‍ക്കരിച്ചത്?', 1, 0, 1, 1, 1, 1, NULL, '1969*1965*1967*1971', '1969', NULL, 1, NULL, 0),
(355, 'ഗിന്നസ് ബുക്ക് ഓഫ് വേള്‍ഡ് റെക്കോര്‍ഡ്‌സ് പ്രകാരം ലോകത്തിലെ ഏറ്റവും വലിയ തൊഴില്‍ ദായകന്‍?', 1, 0, 1, 1, 1, 1, NULL, 'ഇന്ത്യന്‍ റെയില്‍വേ*ബില്‍ഗേറ്റ്‌സ്*റിലയന്‍സ്*ആരാംകോ', 'ഇന്ത്യന്‍ റെയില്‍വേ', NULL, 1, NULL, 0),
(356, '്മൗലികാവകാശങ്ങള്‍ ഭരണഘടനയില്‍ ഉള്‍പ്പെടുത്താനുള്ള തീരുമാനം ഇന്ത്യ സ്വീകരിച്ചത് ഏതു രാജ്യത്തെ അനുകരിച്ചാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ഫ്രാന്‍സിന്റെ ഭരണഘടന*ബ്രിട്ടന്റെ ഭരണഘടന*ജര്‍മനിയുടെ ഭരണഘടന*അമേരിക്കന്‍ ഭരണഘടന', 'അമേരിക്കന്‍ഭരണഘടന', NULL, 1, NULL, 0),
(357, 'ഒരാള്‍ക്ക് ഒന്നില്‍ കൂടുതല്‍ സംസ്ഥാനങ്ങളുടെ ഗവര്‍ണര്‍ പദം അലങ്കരിക്കാമോ?', 1, 0, 1, 1, 1, 1, NULL, 'ഇല്ല*ആറുമാസത്തേക്ക്മാത്രം*സാധിക്കും*മൂന്നുമാസത്തേക്ക് മാത്രം', 'ആറുമാസത്തേക്ക് മാത്രം', NULL, 1, NULL, 0),
(358, 'മനുഷ്യശരീരത്തില്‍ ഏറ്റവും കൂടുതല്‍ ഉള്ള മൂലകം?', 1, 0, 1, 1, 1, 1, NULL, 'അയണ്‍*ഓക്‌സിജന്‍*നൈട്രജന്‍*ഹൈഡ്രജന്‍', 'ഓക്‌സിജന്‍', NULL, 1, NULL, 0),
(359, 'സാധാരണ ടൂത്ത്‌പേസ്റ്റില്‍ താഴെപറയുന്ന ഏതു രാസപദാര്‍ഥമാണ് ഉപയോഗിക്കുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'കാത്സ്യം ഫ്‌ളൂറൈഡ്*കാത്സ്യം ഓക്‌സൈഡ്*കാത്സ്യം കാര്‍ബണേറ്റ്*കാത്സ്യം ക്ലോറൈഡ്', 'കാത്സ്യം കാര്‍ബണേറ്റ്', NULL, 1, NULL, 0),
(360, 'ലോക ജനദിനം (വേള്‍ഡ് വാട്ടര്‍ ഡേ) ആയി ആചരിക്കുന്ന ദിവസം?', 1, 0, 1, 1, 1, 1, NULL, 'ഏപ്രില്‍ 22*സെപ്തംബര്‍ 5*മാര്‍ച്ച് 22*സെപ്തംബര്‍ 10', 'മാര്‍ച്ച് 22', NULL, 1, NULL, 0),
(361, '''ജാവ''എന്നാല്‍ എന്ത്?', 1, 0, 1, 1, 1, 1, NULL, 'ഒരു പുതിയ ബ്രാന്‍ഡ് കോഫി*ഒരു കമ്പ്യൂട്ടര്‍ ലാംഗ്വേജ്*ഒരു പുതിയ ബ്രാന്‍ഡ് തേയില*ഒരു സൂപ്പര്‍ കമ്പ്യൂട്ടര്‍', 'ഒരു കമ്പ്യൂട്ടര്‍ ലാംഗ്വേജ്', NULL, 1, NULL, 0),
(362, 'ഭൂമിയുടെ ഉള്ളില്‍ (കോര്‍) ഉള്ള ഏകദേശ ചൂട്?', 1, 0, 1, 1, 1, 1, NULL, '1000C*2000C*1200C*2600C', '2600C', NULL, 1, NULL, 0),
(363, 'ഇന്ത്യയുടെ വിസ്തീര്‍ണം മില്യണ്‍ ചതുരശ്ര കിലോമീറ്ററില്‍?', 1, 0, 1, 1, 1, 1, NULL, '3.8*3.3*3.28*2.8', '3.28', NULL, 1, NULL, 0),
(364, 'താഴെ പറയുന്നവയില്‍ ഏതാണ് റോക്ക് കോട്ടണ്‍ എന്നറിയപ്പെടുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'പരുത്തി*മൈക്ക*ഇല്‍മനൈറ്റ്*ആസ്ബസ്റ്റോസ്', 'ആസ്ബസ്‌റ്റോസ്', NULL, 1, NULL, 0),
(365, 'ഇന്ത്യയില്‍ ഒരു പുതിയ സംസ്ഥാനം രൂപീകരിക്കണമെങ്കില്‍?', 1, 0, 1, 1, 1, 1, NULL, 'പാര്‍ലമെന്റില്‍ മൂന്നില്‍ രണ്ട് ഭൂരിപക്ഷം*ഭൂരിപക്ഷം സംസ്ഥാനങ്ങള്‍ ആവശ്യപ്പെട്ടാല്‍*രാഷ്ട്രപതിയുടെ തീരുമാനമനുസരിച്ച്*പാര്‍ലമെന്റില്‍ കേവലഭൂരിപക്ഷം ഉണ്ടെങ്കില്‍', 'പാര്‍ലമെന്റില്‍ കേവലഭൂരിപക്ഷം ഉണ്ടെങ്കില്‍', NULL, 1, NULL, 0),
(366, 'ഫാന്റം; മാന്‍ഡ്രേക്ക് എന്ന മാന്ത്രികന്‍ എന്നിവയുടെ സ്രഷ്ടാവ്?', 1, 0, 1, 1, 1, 1, NULL, 'ലീഫാര്‍ക്ക്*ഹാങ് കെച്ചാം*അബു എബ്രഹാം*വാള്‍ട്ട് ഡിസ്‌നി', 'ലീഫാര്‍ക്ക്', NULL, 1, NULL, 0),
(367, 'ചന്ദ്രന്‍ ഭൂമിയെ വലംവെയ്ക്കാന്‍ എടുക്കുന്നസമയം?', 1, 0, 1, 1, 1, 1, NULL, '28 ദിവസം*27 ദിവസം*26 ദിവസം*28 ദിവസത്തില്‍ സ്വല്പം കുറവ്', '28ദിവസത്തില്‍ സ്വല്പം കുറവ്', NULL, 1, NULL, 0),
(368, 'ബി.സി.ജി. എടുക്കുന്നത് താഴെ പറയുന്നതില്‍ ഏതിനെ പ്രതിരോധിക്കാനാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ട്യൂബര്‍കൂലോസിസ്*ക്യാന്‍സര്‍*ബെറിബെറി*ഹൈഡ്രോഫോബിയ', 'ട്യൂബര്‍കൂലോസിസ്', NULL, 1, NULL, 0),
(369, 'ഇന്ത്യയുടെ ഏറ്റവും വലിയ കൊമേഴ്‌സ്യല്‍ ബാങ്ക് ഏതാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ഇന്ത്യന്‍ബാങ്ക്*സ്‌റ്റേറ്റ് ബാങ്ക് ഓഫ് ഇന്ത്യ*കാനറാ ബാങ്ക്*ബാങ്ക് ഓഫ് ബറോഡ', 'സ്‌റ്റേറ്റ് ബാങ്ക് ഓഫ് ഇന്ത്യ', NULL, 1, NULL, 0),
(370, 'ഒരു കിലോവാട്ട് 1000 വാട്ട്‌സ് ആണ്. എന്നാല്‍ ഒരു മെഗാ വാട്ട് -------വാട്ട്‌സ് ആണ്?', 1, 0, 1, 1, 1, 1, NULL, '10000*100000*10000000*1000000', '1000000', NULL, 1, NULL, 0),
(371, 'ഹാന്‍സെന്‍സ് രോഗം എന്നറിയപ്പെടുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'കുഷ്ഠം*ക്ഷയം*ഗോയിറ്റര്‍*ക്യാന്‍സര്‍', 'കുഷ്ഠം', NULL, 1, NULL, 0),
(372, 'കിങ് ഓഫ് ഷാഡോസ് എന്നറിയപ്പെടുന്ന ലോക പ്രശസ്ത കലാകാരന്‍?', 1, 0, 1, 1, 1, 1, NULL, 'വാന്‍ഗോഗ്*ഗോഗിന്‍*റംബ്രാന്‍ഡ്*പിക്കാസ്സോ', 'റംബ്രാന്‍ഡ്', NULL, 1, NULL, 0),
(373, 'ഫഌഗ് (Flag)കളെപ്പറ്റിയുള്ള പഠനത്തിനെ ഏത് സൂചിപ്പിക്കുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'പാലിയന്റോളജി*ഫ്‌ളാഗോളജി*ലിതോളജി*വെക്‌സില്ലോളജി', 'വെക്‌സില്ലോളജി', NULL, 1, NULL, 0),
(374, 'ദൂരദര്‍ശന്റെ ചിഹ്നത്തില്‍ ആലേഖനം ചെയ്തിരിക്കുന്നത് എന്താണ്?', 1, 0, 1, 1, 1, 1, NULL, 'സത്യമേവ ജയതേ*സത്യം ധര്‍മം നീതി*സത്യം ശിവം സുന്ദരം*സത്യം വിജ്ഞാന്‍ പ്രസാരണ്‍', 'സത്യം ശിവം സുന്ദരം', NULL, 1, NULL, 0),
(375, 'സൗരയൂഥത്തിലെ അഞ്ചാമത്തെ വലിയ ഗ്രഹം?', 1, 0, 1, 1, 1, 1, NULL, 'ബുധന്‍*ഭൂമി*യുറാനസ്*വീനസ്', 'ഭൂമി', NULL, 1, NULL, 0),
(376, 'ഇന്ത്യയിലെ ആദ്യത്തെ 70എം.എം. ഫീച്ചര്‍ സിനിമ ഏതാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ഷോലെ*ഝാന്‍സി കി റാണി*ലവ് ഇന്‍ ടോക്കിയോ*എറൗണ്ട് ദി വേള്‍ഡ്', 'എറൗണ്ട് ദി വേള്‍ഡ്', NULL, 1, NULL, 0),
(377, 'കേരളത്തിന്റെ ഔദ്യോഗിക പുഷ്പം?', 1, 0, 1, 1, 1, 1, NULL, 'കണിക്കൊന്ന*താമര*മുല്ലപ്പൂ*ചെമ്പകം', 'കണിക്കൊന്ന', NULL, 1, NULL, 0),
(378, 'ഏഷ്യന്‍ ഗെയിംസില്‍ സ്വര്‍ണമെഡല്‍ നേടിയ ആദ്യത്തെ ഇന്ത്യന്‍ വനിത ആരാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'പി.ടി.ഉഷ*ഷൈനി വില്‍സണ്‍*എം.ഡി.വത്സമ്മ*കമല്‍ജിത് സന്ധു', 'കമല്‍ജിത് സന്ധു', NULL, 1, NULL, 0),
(379, 'ഇന്ത്യന്‍ ക്രിക്കറ്റ് കണ്‍ട്രോള്‍ ബോര്‍ഡിന്റെ ഇപ്പോഴത്തെ സെക്രട്ടറി ആരാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'സുനില്‍ ഗവാസ്‌കര്‍*സഞ്ജയ് ജഗ്ഡാലേ*ഡാല്‍മിയ*എസ്.കെ.നായര്‍', 'സഞ്ജയ് ജഗ്ഡാലേ', NULL, 1, NULL, 0),
(380, 'വെനീസ് ഓഫ് ദി ഈസ്റ്റ് എന്നറിയപ്പെടുന്നത്?', 1, 0, 1, 1, 1, 1, NULL, 'ആലപ്പുഴ*കൊച്ചി*കോഴിക്കോട്*ബേപ്പൂര്‍', 'ആലപ്പുഴ', NULL, 1, NULL, 0),
(381, 'ഏറ്റവും പഴക്കം ചെന്ന ജുതപ്പള്ളി സ്ഥിതിചെയ്യുന്ന സ്ഥലം?', 1, 0, 1, 1, 1, 1, NULL, 'ഗോവ*മട്ടാഞ്ചേരി*പോണ്ടിച്ചേരി*മാഹി', 'മട്ടാഞ്ചേരി', NULL, 1, NULL, 0),
(382, '2002-ലെ വയലാര്‍ അവാര്‍ഡ് ആര്‍ക്കു ലഭിച്ചു?', 1, 0, 1, 1, 1, 1, NULL, 'റ്റി.പത്മനാഭന്‍*കോവിലന്‍*അയ്യപ്പപ്പണിക്കര്‍*എം.വി.ദേവന്‍', 'അയ്യപ്പപ്പണിക്കര്‍', NULL, 1, NULL, 0),
(383, 'ടെസ്റ്റ് ക്രിക്കറ്റില്‍ സെഞ്ച്വറി നേടിയ ആദ്യ ഇന്ത്യാക്കാരന്‍ ആരാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ലാലാ അമര്‍നാഥ്*മൊഹീന്ദര്‍ അമര്‍നാഥ്*സുനില്‍ ഗവാസ്‌കര്‍*മന്‍സൂര്‍ അലിഖാന്‍ പട്ടൗഡി', 'ലാലാഅമര്‍നാഥ്', NULL, 1, NULL, 0),
(384, 'പുന്നപ്ര-വയലാര്‍ സമരം നടന്നത് ഏതുവര്‍ഷം?', 1, 0, 1, 1, 1, 1, NULL, '1945*1946*1948*1947', '1946', NULL, 1, NULL, 0),
(385, 'കേരളത്തിലെ ഏറ്റവും കുറവ് ജനസംഖ്യയുള്ള താലൂക്ക്?', 1, 0, 1, 1, 1, 1, NULL, 'കൊച്ചി*കോതമംഗലം*അമ്പലപ്പുഴ*ഇതൊന്നുമല്ല', 'ഇതൊന്നുമല്ല', NULL, 1, NULL, 0),
(386, 'കേരളത്തിലെ ആദ്യത്തെ ജലവൈദ്യുതപദ്ധതി ഏതാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ഇടുക്കി*പെരിങ്ങല്‍ക്കുത്ത്*ശബരിഗിരി*പള്ളിവാസല്‍', 'പള്ളിവാസല്‍', NULL, 1, NULL, 0),
(387, 'കേരളത്തിലെ ആദ്യത്തെ ഗവര്‍ണര്‍?', 1, 0, 1, 1, 1, 1, NULL, 'ബി.രാമകൃഷ്ണറാവു*സര്‍ദാര്‍ കെ.എം.പണിക്കര്‍*ഭഗവാന്‍ സഹായി*പനമ്പിള്ളി ഗോവിന്ദമേനോന്‍', 'ബി.രാമകൃഷ്ണറാവു', NULL, 1, NULL, 0),
(388, '2001ല്‍ മികച്ച നടനുള്ള ദേശീയ ചലച്ചിത്ര അവാര്‍ഡ് നേടിയ നടന്‍ ആരാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'മോഹന്‍ലാല്‍*മമ്മൂട്ടി*മുരളി*പ്രേംജി', 'മുരളി', NULL, 1, NULL, 0),
(389, 'I say my prayers ---------I sleep?', 1, 0, 1, 1, 1, 1, NULL, 'while*after*when*before', 'before', NULL, 1, NULL, 0),
(390, 'The higher you climb a Himalayan peak; ____you feel?', 1, 0, 1, 1, 1, 1, NULL, 'the most cold*the colder*colder*more cold', 'thecolder', NULL, 1, NULL, 0),
(391, 'The workers were full of APPLAUSE for the new policy of the management?', 1, 0, 1, 1, 1, 1, NULL, 'approval*adulation*praise*eulogy', 'praise', NULL, 1, NULL, 0),
(392, 'Sonu is an INVETERATE liar?', 1, 0, 1, 1, 1, 1, NULL, 'effective*habitual*frequent*familiar', 'habitual', NULL, 1, NULL, 0),
(393, 'I watch televion_______I have nothing to do?', 1, 0, 1, 1, 1, 1, NULL, 'when*where*then*now', 'when', NULL, 1, NULL, 0),
(394, 'The opposite of ''Ascend''is?', 1, 0, 1, 1, 1, 1, NULL, 'detract*retreat*derange*descend', 'descent', NULL, 1, NULL, 0),
(395, 'Nocturnal related to?', 1, 0, 1, 1, 1, 1, NULL, 'night time*day time*evening*afternoon', 'night time', NULL, 1, NULL, 0),
(396, 'He is the best speaker_______is available?', 1, 0, 1, 1, 1, 1, NULL, 'which*that*whom*what', 'that', NULL, 1, NULL, 0),
(397, 'I would hurry up; if I______you?', 1, 0, 1, 1, 1, 1, NULL, 'where*was*is*am', 'were', NULL, 1, NULL, 0),
(398, 'Replace the capitalised words with a suitable wingle word.''The doctor said that the would on the patient''s head was ONE THAT WOULD CAUSE DEATH?', 1, 0, 1, 1, 1, 1, NULL, 'serious*chronic*dangerous*fatal', 'fatal', NULL, 1, NULL, 0),
(399, 'One word for a collection of ships?', 1, 0, 1, 1, 1, 1, NULL, 'pack*cluster*fleet*group', 'fleet', NULL, 1, NULL, 0),
(400, 'Choose the worlds nearest in meaning of the capiralised words - Our college is WITHIN A STONE''S THROW from here?', 1, 0, 1, 1, 1, 1, NULL, 'very far off*at a very short distance*two and ahalf miles away*none of the above', 'at a very short distance', NULL, 1, NULL, 0),
(401, 'Choose the worlds nearest in meaning of the capiralised words - He TOOK TO HEART the deathof his siter?', 1, 0, 1, 1, 1, 1, NULL, 'was unmoved by*was ignored about*learned about*was deeply affected by', 'was deeply affected by', NULL, 1, NULL, 0),
(402, 'I feel ______ about what happened?', 1, 0, 1, 1, 1, 1, NULL, 'worse*bad*worst*none of the above', 'bad', NULL, 1, NULL, 0),
(403, 'What is a person called when he is recovering from an illness?', 1, 0, 1, 1, 1, 1, NULL, 'ignoramus*convalescent*epidemic*arrogant', 'convalescent', NULL, 1, NULL, 0),
(404, 'Fratricide is?', 1, 0, 1, 1, 1, 1, NULL, 'killing of human being*killing of father*killing of mother*killing of brother or sister', 'killing of brother or sister', NULL, 1, NULL, 0),
(405, 'Wool-gathering means?', 1, 0, 1, 1, 1, 1, NULL, 'to gather wool from sheep*day-dreaming*nightmare*none of these', 'day-dreaming', NULL, 1, NULL, 0),
(406, 'Epilogue is?', 1, 0, 1, 1, 1, 1, NULL, 'introductory part of a literary work*story line of literary work*concluding part of a literary work*synopsis of a literary work', 'concluding part of a literary work', NULL, 1, NULL, 0),
(407, 'Horticulturist is one?', 1, 0, 1, 1, 1, 1, NULL, 'who pretends to be good*who is very cultured*who grows flowers and fruits*none of the above', 'who grows flowers and fruits', NULL, 1, NULL, 0),
(408, 'Pedestrian is?', 1, 0, 1, 1, 1, 1, NULL, 'one who makes speeches*one who is devoted to a party*one who walks along the street*one who loves mankind', 'one who walks alone the street', NULL, 1, NULL, 0),
(409, 'ശരിയായ രൂപം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'പാഠകം*പാഢകം*പാഢഗം*പാടഗം', 'പാഠകം', NULL, 1, NULL, 0),
(410, '''ഉ'' എന്ന പ്രത്യയം ഏത് വിഭക്തിയുടേതാണ്?', 1, 0, 1, 1, 1, 1, NULL, 'ആധാരികയുടെ*നിര്‍ദേശികയുടെ*ഉദ്ദേശികയുടെ*പ്രതിഗ്രാഹികയുടെ', 'ഉദ്ദേശികയുടെ', NULL, 1, NULL, 0),
(411, '''ചാട്ടം''എന്ന പദം ഏതു വിഭാഗത്തില്‍ പെടുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'ഗുണനാദം*ക്രിയാനാമം*മേയനാമം*സര്‍വനാമം', 'ക്രിയാനാമം', NULL, 1, NULL, 0),
(412, '''ഈരേഴ്'' എന്ന പദത്തില്‍ ഉള്‍ച്ചേര്‍ന്നിരിക്കുന്ന ഭേദകം ഏതു വിഭാഗത്തില്‍പ്പെടുന്നു?', 1, 0, 1, 1, 1, 1, NULL, 'സാംഖ്യം*ശുദ്ധം*പാരിമാണിക്കം*വിഭാവകം', 'സാംഖ്യം', NULL, 1, NULL, 0),
(413, 'ആഗമസന്ധിക്കുള്ള ഉദാഹരണം തെരഞ്ഞെടുക്കുക?', 1, 0, 1, 1, 1, 1, NULL, 'കടല്‍+കാറ്റ്=കടല്‍ക്കാറ്റ്*തീ+കനല്‍=തീക്കനല്‍*പോ+ഉന്നു=പോവുന്നു*അല്ല+എന്ന്=അല്ലെന്ന്', 'പോ+ഉന്നു=പോവുന്നു', NULL, 1, NULL, 0),
(414, 'തെറ്റായവാക്യം ഏത്?', 1, 0, 1, 1, 1, 1, NULL, 'ഉദ്ഭൂദ്ധമായ പൗരസഞ്ചയമാണ് ജനാധിപത്യ വ്യവസ്ഥിതിയുടെ അടിസ്ഥാനം*ജനാധിപത്യവും പണാധിപത്യവും തമ്മിലുള്ള അന്തരം തിരിച്ചറിയാതിരിക്കരുത്*വിരാമചിഹ്നം വാക്യസമാപ്തിയെ കുറിക്കുന്നു*ആദ്യം ചോദ്യവും പിന്നീട് ഉത്തരം എന്നതാണല്ലോ ക്രമം', 'ആദ്യം ചോദ്യവും പിന്നീട് ഉത്തരം എന്നതാണല്ലോ ക്രമം', NULL, 1, NULL, 0),
(415, 'ശരിയായ വാക്യം എത്?', 1, 0, 1, 1, 1, 1, NULL, 'എല്ലാം ആലോചിച്ചശേഷം അനന്തരം ഒരു തീരുമാനത്തില്‍ എത്തുക*കാറ്റാടി മരത്തിന്റെ ജന്മദേശം ആസ്‌ത്രേലിയയാണ്*ലബ്ധപ്രതിഷ്ഠ നേടി ഒരു ചിത്രകാരനാണ് അദ്ദേഹം*ഈ ചെടിയുടെ പഴം മറ്റു ചെടികളെപ്പോലെയല്ല', 'കാറ്റാടി മരത്തിന്റെ ജന്മദേശം ആസ്‌ത്രേലിയയാണ്', NULL, 1, NULL, 0),
(416, 'He decided to have a go at film making. തര്‍ജമ തെരഞ്ഞെടുക്കുക?', 1, 0, 1, 1, 1, 1, NULL, 'ചലച്ചിത്ര നിര്‍മാണരംഗം വിട്ടുപോകാന്‍ അയാള്‍ തീരുമാനിച്ചു*ചലച്ചിത്ര നിര്‍മാണം പുനരാരംഭിക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു*ഒരു ചലച്ചിത്രം നിര്‍മ്മിക്കുന്നതെങ്ങനെ എന്നു മനസ്സിലാക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു*ചലച്ചിത്ര നിര്‍മാണത്തില്‍ ഒരു കൈ നോക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു', ' ചലച്ചിത്ര നിര്‍മാണത്തില്‍ ഒരു കൈ നോക്കാന്‍ അയാള്‍ തീരുമാനിച്ചു', NULL, 1, NULL, 0),
(417, 'They gave in after fierce resistence. തര്‍ജമ തെരഞ്ഞെടുക്കുക?', 1, 0, 1, 1, 1, 1, NULL, 'കടുത്ത ചെറുത്തുനില്പിനുശേഷം അവര്‍ കടന്നുകളഞ്ഞു*കടുത്ത ചെറുത്തുനില്പുണ്ടായിട്ടും അവര്‍ മുന്നേറി*കടുത്ത ചെറുത്തുനില്‍പിനു ശേഷം അവര്‍ കീഴടങ്ങി*കടുത്ത ചെറുത്തുനില്പിനേയും അവര്‍ അതിജീവിച്ചു', 'കടുത്ത ചെറുത്തുനില്പിനു ശേഷം അവര്‍ കീഴടങ്ങി', NULL, 1, NULL, 0),
(418, 'When we reach there; they will be sleeping? തര്‍ജമ തെരഞ്ഞെടുക്കുക?', 1, 0, 1, 1, 1, 1, NULL, 'നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങും*നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങിയേക്കുമോ?*നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങുമോ?*നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങുകയായിരിക്കും', ' നമ്മള്‍ അവിടെ എത്തുമ്പോള്‍ അവര്‍ ഉറങ്ങുകയായിരിക്കും', NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_imports`
--

CREATE TABLE IF NOT EXISTS `question_imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `csv_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_zipped_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`),
  KEY `quiz_type_id` (`quiz_type_id`),
  KEY `quiz_status_id` (`quiz_status_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `quiz_type_id`, `total_time`, `quiz_status_id`, `question_ids`, `credit`, `organization_id`) VALUES
(1, 'Sample Quiz 1', 2, '00:05:00', 1, NULL, 0, NULL),
(2, 'Sample Quiz 2', 2, '00:05:00', 1, NULL, 0, NULL),
(3, 'Demo Quiz1', 3, '00:05:00', 1, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_details`
--

CREATE TABLE IF NOT EXISTS `quiz_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `set_id` int(11) DEFAULT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `difficulty_level_id` int(11) DEFAULT NULL,
  `number_of_questions` smallint(6) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `quiz_types`
--

INSERT INTO `quiz_types` (`id`, `name`) VALUES
(1, 'Real Quiz'),
(2, 'Sample Quiz'),
(3, 'Demo Quiz');

-- --------------------------------------------------------

--
-- Table structure for table `sample_quiz_details`
--

CREATE TABLE IF NOT EXISTS `sample_quiz_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `question_ids` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sample_quiz_details`
--

INSERT INTO `sample_quiz_details` (`id`, `quiz_id`, `question_ids`) VALUES
(1, 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100'),
(2, 2, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100'),
(3, 3, '1,2,3,4,5,6,7,8,9,10');

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
-- Table structure for table `set`
--

CREATE TABLE IF NOT EXISTS `set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `set`
--

INSERT INTO `set` (`id`, `name`) VALUES
(1, 'LDC');

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
  `registration_date` datetime NOT NULL,
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
  `user_key` smallint(6) DEFAULT NULL,
  `answer_key` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_test_id` (`user_test_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_test_keys`
--

CREATE TABLE IF NOT EXISTS `user_test_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_test_detail_id` int(11) DEFAULT NULL,
  `answer_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_test_detail_id` (`user_test_detail_id`),
  KEY `answer_option_id` (`answer_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
