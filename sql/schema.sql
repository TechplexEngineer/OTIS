-- phpMyAdmin SQL Dump
-- version 4.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2014 at 08:30 PM
-- Server version: 5.1.73-1
-- PHP Version: 5.3.3-7+squeeze18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `OIS`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(255) NOT NULL DEFAULT '0',
  `homephone` varchar(20) DEFAULT NULL,
  `cellphone` varchar(20) DEFAULT NULL,
  `medications` varchar(1024) DEFAULT NULL,
  `mailaddress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addreses`
--

CREATE TABLE IF NOT EXISTS `addreses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

-- --------------------------------------------------------

--
-- Table structure for table `announcments`
--

CREATE TABLE IF NOT EXISTS `announcments` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  `body` text,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `for` varchar(4) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` varchar(35) DEFAULT NULL,
  `mdate` date DEFAULT NULL,
  `created` date DEFAULT NULL,
  `lastUpdate` date DEFAULT NULL,
  `post` text,
  `author` varchar(100) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `econtact`
--

CREATE TABLE IF NOT EXISTS `econtact` (
  `id` int(255) NOT NULL DEFAULT '0',
  `ecid` int(20) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mailingaddress` varchar(255) DEFAULT NULL,
  `homephone` varchar(255) DEFAULT NULL,
  `workphone` varchar(255) DEFAULT NULL,
  `cellphone` varchar(255) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `bestway` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`,`ecid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) DEFAULT NULL,
  `desc` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_membership`
--

CREATE TABLE IF NOT EXISTS `group_membership` (
  `groupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  UNIQUE KEY `groupid` (`groupid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(255) NOT NULL DEFAULT '0',
  `nickname` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL DEFAULT 'Town, Maine',
  `role` varchar(255) DEFAULT NULL,
  `yog` varchar(255) DEFAULT NULL,
  `interests` varchar(255) DEFAULT NULL,
  `favMoment` varchar(255) DEFAULT NULL,
  `gainThisYr` varchar(255) DEFAULT NULL,
  `futurePlans` varchar(255) DEFAULT NULL,
  `bio` varchar(2048) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_archive`
--

CREATE TABLE IF NOT EXISTS `sms_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` date DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `to` varchar(255) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sms` varchar(255) DEFAULT NULL,
  `sms-rm` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `period` varchar(10) DEFAULT NULL,
  `last_login` varchar(20) NOT NULL,
  `disabled` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Table structure for table `vars`
--

CREATE TABLE IF NOT EXISTS `vars` (
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vocab`
--

CREATE TABLE IF NOT EXISTS `vocab` (
  `word` varchar(50) NOT NULL DEFAULT '',
  `def` text,
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
