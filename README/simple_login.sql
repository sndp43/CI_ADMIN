-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2018 at 06:51 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `profilepic` varchar(250) NOT NULL,
  `upgraded` int(1) NOT NULL,
  `FacebookId` varchar(255) NOT NULL,
  `GoogleId` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `telnum` varchar(255) NOT NULL,
  `country_abbreviation` varchar(250) NOT NULL,
  `country_code_num` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `MailVerified` int(11) NOT NULL,
  `added_time` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `pward` varchar(255) NOT NULL,
  `agree` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `profilepic`, `upgraded`, `FacebookId`, `GoogleId`, `firstname`, `role`, `telnum`, `country_abbreviation`, `country_code_num`, `email`, `MailVerified`, `added_time`, `added_by`, `updated_time`, `updated_by`, `pward`, `agree`, `status`) VALUES
(1, '', 0, '', '', 'Admin', 1, '121 454 5787', 'in', '+91', 'admin@slogin.com', 0, 1496648274, 0, 1514542251, 1, '$2y$09$wP71a0vh6GaQj6g2al6l3.a4OKOY96GjtAyIRwMEuJx0qPEpNNHEy', 1, 1),
(65, 'chatrapati_shivaji_maharaj1.jpg', 0, '', '', 'sandeep', 2, '80971 21141', 'in', '+91', 'innovac.sandeep@gmail.com', 0, 1515135541, 0, 1515139902, 65, '$2y$09$arNvt4RjcXBNvHka4Q1ga.ZEDni4wMI7Y4T9CUke1IKuVQXlN6fhy', 1, 1),
(66, '', 0, '', '', 'Ritesh', 2, '8087252347', 'in', '+91', 'innovac.ritesh@gmail.com', 1, 1516083080, 0, 0, 0, '$2y$09$k5J4FpTD9U5SsN7t4jHBX.8CtDovbZAPnzkmAIJqdDZm4y/wD3aR.', 1, 1),
(67, '', 0, '', '', 'Sanjivani Gaikwad', 2, '9863254174', 'in', '+91', 'innovac.sanjivani@gmail.com', 0, 1516185109, 1, 0, 0, '$2y$09$wP71a0vh6GaQj6g2al6l3.a4OKOY96GjtAyIRwMEuJx0qPEpNNHEy', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `capcha`
--

CREATE TABLE `capcha` (
  `id` int(11) NOT NULL,
  `capcha` varchar(222) NOT NULL,
  `time` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capcha`
--

INSERT INTO `capcha` (`id`, `capcha`, `time`) VALUES
(1, '1514550246.jpg', '1514550246'),
(2, '1514550249.jpg', '1514550249'),
(3, '1514550278.jpg', '1514550278'),
(4, '1514550286.jpg', '1514550286'),
(5, '1514550294.jpg', '1514550294'),
(6, '1514550390.jpg', '1514550390'),
(7, '1514550393.jpg', '1514550393'),
(8, '1514550445.jpg', '1514550445'),
(9, '1514550457.jpg', '1514550457'),
(10, '1514550466.jpg', '1514550466'),
(11, '1514550510.jpg', '1514550510'),
(12, '1514550511.jpg', '1514550511'),
(13, '1514550512.jpg', '1514550512'),
(14, '1514550514.jpg', '1514550514'),
(15, '1514550524.jpg', '1514550524'),
(16, '1514550614.jpg', '1514550614'),
(17, '1514550615.jpg', '1514550615'),
(18, '1514550616.jpg', '1514550616'),
(19, '1514550645.jpg', '1514550645'),
(20, '1514550693.jpg', '1514550693'),
(21, '1514550718.jpg', '1514550718'),
(22, '1514550734.jpg', '1514550734'),
(23, '1514550739.jpg', '1514550739'),
(24, '1514550759.jpg', '1514550759'),
(25, '1514550767.jpg', '1514550767'),
(26, '1514550768.jpg', '1514550768'),
(27, '1514550772.jpg', '1514550772'),
(28, '1514550781.jpg', '1514550781'),
(29, '1514550797.jpg', '1514550797'),
(30, '1514550837.jpg', '1514550837'),
(31, '1514550840.jpg', '1514550840'),
(32, '1514550850.jpg', '1514550850'),
(33, '1514550852.jpg', '1514550852'),
(34, '1514550884.jpg', '1514550884'),
(35, '1514550885.jpg', '1514550885'),
(36, '1514550887.jpg', '1514550887'),
(37, '1514550888.jpg', '1514550888'),
(38, '1514550889.jpg', '1514550889'),
(39, '1514550890.jpg', '1514550890'),
(40, '1514550891.jpg', '1514550891'),
(41, '1514550893.jpg', '1514550893'),
(42, '1514550896.jpg', '1514550896'),
(43, '1514550897.jpg', '1514550897'),
(44, '1514550898.jpg', '1514550898'),
(45, '1514550910.jpg', '1514550910'),
(46, '1514550915.jpg', '1514550915'),
(47, '1514551290.jpg', '1514551290'),
(48, '1514551347.jpg', '1514551347'),
(49, '1514551372.jpg', '1514551372'),
(50, '1514551414.jpg', '1514551414'),
(51, '1514551416.jpg', '1514551416'),
(52, '1514551440.jpg', '1514551440'),
(53, '1514551635.jpg', '1514551635'),
(54, '1514551638.jpg', '1514551638'),
(55, '1514552262.jpg', '1514552262'),
(56, '1514553391.jpg', '1514553391'),
(57, '1514553395.jpg', '1514553395'),
(58, '1514553681.jpg', '1514553681'),
(59, '1514553682.jpg', '1514553682'),
(60, '1514616347.jpg', '1514616347'),
(61, '1514616363.jpg', '1514616363'),
(62, '1514616380.jpg', '1514616380'),
(63, '1514616382.jpg', '1514616382'),
(64, '1514616385.jpg', '1514616385'),
(65, '1514616397.jpg', '1514616397'),
(66, '1514616398.jpg', '1514616398'),
(67, '1514619188.jpg', '1514619188'),
(68, '1514619481.jpg', '1514619481'),
(69, '1514619784.jpg', '1514619784'),
(70, '1514620132.jpg', '1514620132'),
(71, '1514620365.jpg', '1514620365'),
(72, '1514620367.jpg', '1514620367'),
(73, '1514620369.jpg', '1514620369'),
(74, '1514620370.jpg', '1514620370'),
(75, '1514620372.jpg', '1514620372'),
(76, '1514620395.jpg', '1514620395'),
(77, '1514620397.jpg', '1514620397'),
(78, '1514621004.jpg', '1514621004'),
(79, '1514621082.jpg', '1514621082'),
(80, '1514621084.jpg', '1514621084'),
(81, '1514621098.jpg', '1514621098'),
(82, '1514621133.jpg', '1514621133'),
(83, '1514621138.jpg', '1514621138'),
(84, '1514621525.jpg', '1514621525'),
(85, '1514623613.jpg', '1514623613'),
(86, '1514623616.jpg', '1514623616'),
(87, '1514877962.jpg', '1514877962'),
(88, '1514877972.jpg', '1514877972'),
(89, '1514878879.jpg', '1514878879'),
(90, '1514878916.jpg', '1514878916'),
(91, '1514883284.jpg', '1514883284'),
(92, '1514887904.jpg', '1514887904'),
(93, '1514888262.jpg', '1514888262'),
(94, '1514888793.jpg', '1514888793'),
(95, '1514890288.jpg', '1514890288'),
(96, '1514890783.jpg', '1514890783'),
(97, '1514890810.jpg', '1514890810'),
(98, '1514892380.jpg', '1514892380'),
(99, '1514892392.jpg', '1514892392'),
(100, '1514892434.jpg', '1514892434'),
(101, '1514892463.jpg', '1514892463'),
(102, '1514893830.jpg', '1514893830'),
(103, '1514894104.jpg', '1514894104'),
(104, '1514894187.jpg', '1514894187'),
(105, '1514894654.jpg', '1514894654'),
(106, '1514896394.jpg', '1514896394'),
(107, '1514896420.jpg', '1514896420'),
(108, '1514896460.jpg', '1514896460'),
(109, '1514897865.jpg', '1514897865'),
(110, '1514897875.jpg', '1514897875'),
(111, '1514898052.jpg', '1514898052'),
(112, '1514898091.jpg', '1514898091'),
(113, '1514898123.jpg', '1514898123'),
(114, '1514898178.jpg', '1514898178'),
(115, '1514898439.jpg', '1514898439'),
(116, '1514898446.jpg', '1514898446'),
(117, '1514898492.jpg', '1514898492'),
(118, '1514898514.jpg', '1514898514'),
(119, '1514898699.jpg', '1514898699'),
(120, '1514898724.jpg', '1514898724'),
(121, '1514898781.jpg', '1514898781'),
(122, '1514898808.jpg', '1514898808'),
(123, '1514899603.jpg', '1514899603'),
(124, '1514899768.jpg', '1514899768'),
(125, '1514899833.jpg', '1514899833'),
(126, '1514900167.jpg', '1514900167'),
(127, '1514900943.jpg', '1514900943'),
(128, '1514901036.jpg', '1514901036'),
(129, '1514901110.jpg', '1514901110'),
(130, '1515131121.jpg', '1515131121'),
(131, '1515131123.jpg', '1515131123'),
(132, '1515131614.jpg', '1515131614'),
(133, '1515131640.jpg', '1515131640'),
(134, '1515132309.jpg', '1515132309'),
(135, '1515132350.jpg', '1515132350'),
(136, '1515132707.jpg', '1515132707'),
(137, '1515133075.jpg', '1515133075'),
(138, '1515133277.jpg', '1515133277'),
(139, '1515133387.jpg', '1515133387'),
(140, '1515133449.jpg', '1515133449'),
(141, '1515135435.jpg', '1515135435'),
(142, '1515135549.jpg', '1515135549'),
(143, '1515136941.jpg', '1515136941'),
(144, '1515136982.jpg', '1515136982'),
(145, '1515139837.jpg', '1515139837'),
(146, '1515139861.jpg', '1515139861'),
(147, '1515139863.jpg', '1515139863'),
(148, '1515146921.jpg', '1515146921'),
(149, '1515480423.jpg', '1515480423'),
(150, '1515481242.jpg', '1515481242'),
(151, '1515566945.jpg', '1515566945'),
(152, '1516082733.jpg', '1516082732'),
(153, '1516083088.jpg', '1516083088'),
(154, '1516427861.jpg', '1516427861'),
(155, '1516428481.jpg', '1516428481'),
(156, '1516428527.jpg', '1516428527');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('nbe1rddolrgle7j2b2pf2j8jtgj1f3n3', '::1', 1516427916, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363432373931363b7765627369746564657461696c7373657373696f6e7c4f3a383a22737464436c617373223a32303a7b733a323a226964223b733a313a2232223b733a31323a22576562736974655469746c65223b733a303a22223b733a373a2241646472657373223b733a303a22223b733a31323a22436f6e74616374456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a353a2250686f6e65223b733a303a22223b733a333a22466178223b733a303a22223b733a343a224c6f676f223b733a303a22223b733a373a2246617669636f6e223b733a303a22223b733a31323a22416e616c79746963436f6465223b733a303a22223b733a383a224d61696c486f7374223b733a32323a2273736c3a2f2f736d74702e6d61696c67756e2e6f7267223b733a383a224d61696c506f7274223b733a333a22343635223b733a31323a224d61696c557365724e616d65223b733a32393a226e6f7265706c7940696e6e6f766163636f6e73756c74696e672e636f6d223b733a31323a224d61696c50617373776f7264223b733a31323a22216e6e6f7661634032303137223b733a393a2246726f6d456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a393a224d6574615469746c65223b733a303a22223b733a383a224d65746144657363223b733a303a22223b733a31313a225765627369746541646472223b733a303a22223b733a363a2266624c696e6b223b733a303a22223b733a363a2267704c696e6b223b733a303a22223b733a353a22746c696e6b223b733a303a22223b7d64656661756c745f7374796c657c733a31313a2264656661756c742e637373223b63617074636861436f64657c733a353a22585636564c223b),
('eudpf56l6opqkl62kp6ph2nq0hcau6te', '::1', 1516428220, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363432383232303b7765627369746564657461696c7373657373696f6e7c4f3a383a22737464436c617373223a32303a7b733a323a226964223b733a313a2232223b733a31323a22576562736974655469746c65223b733a303a22223b733a373a2241646472657373223b733a303a22223b733a31323a22436f6e74616374456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a353a2250686f6e65223b733a303a22223b733a333a22466178223b733a303a22223b733a343a224c6f676f223b733a303a22223b733a373a2246617669636f6e223b733a303a22223b733a31323a22416e616c79746963436f6465223b733a303a22223b733a383a224d61696c486f7374223b733a32323a2273736c3a2f2f736d74702e6d61696c67756e2e6f7267223b733a383a224d61696c506f7274223b733a333a22343635223b733a31323a224d61696c557365724e616d65223b733a32393a226e6f7265706c7940696e6e6f766163636f6e73756c74696e672e636f6d223b733a31323a224d61696c50617373776f7264223b733a31323a22216e6e6f7661634032303137223b733a393a2246726f6d456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a393a224d6574615469746c65223b733a303a22223b733a383a224d65746144657363223b733a303a22223b733a31313a225765627369746541646472223b733a303a22223b733a363a2266624c696e6b223b733a303a22223b733a363a2267704c696e6b223b733a303a22223b733a353a22746c696e6b223b733a303a22223b7d64656661756c745f7374796c657c733a31313a2264656661756c742e637373223b63617074636861436f64657c733a353a22585636564c223b),
('kmd0t40jdir762tg54utd747ompmtuds', '::1', 1516428281, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363432383232303b7765627369746564657461696c7373657373696f6e7c4f3a383a22737464436c617373223a32303a7b733a323a226964223b733a313a2232223b733a31323a22576562736974655469746c65223b733a303a22223b733a373a2241646472657373223b733a303a22223b733a31323a22436f6e74616374456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a353a2250686f6e65223b733a303a22223b733a333a22466178223b733a303a22223b733a343a224c6f676f223b733a303a22223b733a373a2246617669636f6e223b733a303a22223b733a31323a22416e616c79746963436f6465223b733a303a22223b733a383a224d61696c486f7374223b733a32323a2273736c3a2f2f736d74702e6d61696c67756e2e6f7267223b733a383a224d61696c506f7274223b733a333a22343635223b733a31323a224d61696c557365724e616d65223b733a32393a226e6f7265706c7940696e6e6f766163636f6e73756c74696e672e636f6d223b733a31323a224d61696c50617373776f7264223b733a31323a22216e6e6f7661634032303137223b733a393a2246726f6d456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a393a224d6574615469746c65223b733a303a22223b733a383a224d65746144657363223b733a303a22223b733a31313a225765627369746541646472223b733a303a22223b733a363a2266624c696e6b223b733a303a22223b733a363a2267704c696e6b223b733a303a22223b733a353a22746c696e6b223b733a303a22223b7d64656661756c745f7374796c657c733a31313a2264656661756c742e637373223b63617074636861436f64657c733a353a22585636564c223b),
('3sv900i1qt0tt1m0vcd9angdeico8a9t', '::1', 1516428527, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363432383437363b7765627369746564657461696c7373657373696f6e7c4f3a383a22737464436c617373223a32303a7b733a323a226964223b733a313a2232223b733a31323a22576562736974655469746c65223b733a303a22223b733a373a2241646472657373223b733a303a22223b733a31323a22436f6e74616374456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a353a2250686f6e65223b733a303a22223b733a333a22466178223b733a303a22223b733a343a224c6f676f223b733a303a22223b733a373a2246617669636f6e223b733a303a22223b733a31323a22416e616c79746963436f6465223b733a303a22223b733a383a224d61696c486f7374223b733a32323a2273736c3a2f2f736d74702e6d61696c67756e2e6f7267223b733a383a224d61696c506f7274223b733a333a22343635223b733a31323a224d61696c557365724e616d65223b733a32393a226e6f7265706c7940696e6e6f766163636f6e73756c74696e672e636f6d223b733a31323a224d61696c50617373776f7264223b733a31323a22216e6e6f7661634032303137223b733a393a2246726f6d456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a393a224d6574615469746c65223b733a303a22223b733a383a224d65746144657363223b733a303a22223b733a31313a225765627369746541646472223b733a303a22223b733a363a2266624c696e6b223b733a303a22223b733a363a2267704c696e6b223b733a303a22223b733a353a22746c696e6b223b733a303a22223b7d64656661756c745f7374796c657c733a31313a2264656661756c742e637373223b73657373696f6e5f7374796c657c733a31303a22666c61746c792e637373223b63617074636861436f64657c733a353a223853563947223b),
('ftcnomoqe6h65tuvbm09jerfivej12r8', '::1', 1516559600, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535393630303b7765627369746564657461696c7373657373696f6e7c4f3a383a22737464436c617373223a32303a7b733a323a226964223b733a313a2232223b733a31323a22576562736974655469746c65223b733a303a22223b733a373a2241646472657373223b733a303a22223b733a31323a22436f6e74616374456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a353a2250686f6e65223b733a303a22223b733a333a22466178223b733a303a22223b733a343a224c6f676f223b733a303a22223b733a373a2246617669636f6e223b733a303a22223b733a31323a22416e616c79746963436f6465223b733a303a22223b733a383a224d61696c486f7374223b733a32323a2273736c3a2f2f736d74702e6d61696c67756e2e6f7267223b733a383a224d61696c506f7274223b733a333a22343635223b733a31323a224d61696c557365724e616d65223b733a32393a226e6f7265706c7940696e6e6f766163636f6e73756c74696e672e636f6d223b733a31323a224d61696c50617373776f7264223b733a31323a22216e6e6f7661634032303137223b733a393a2246726f6d456d61696c223b733a32363a22696e666f40696e6e6f766163636f6e73756c74696e672e636f6d223b733a393a224d6574615469746c65223b733a303a22223b733a383a224d65746144657363223b733a303a22223b733a31313a225765627369746541646472223b733a303a22223b733a363a2266624c696e6b223b733a303a22223b733a363a2267704c696e6b223b733a303a22223b733a353a22746c696e6b223b733a303a22223b7d64656661756c745f7374796c657c733a31313a2264656661756c742e637373223b73657373696f6e5f7374796c657c733a31303a226c69746572612e637373223b69735f61646d696e7c733a313a2231223b6c6f67676564696e5f61646d696e5f73657373696f6e7c4f3a383a22737464436c617373223a31393a7b733a323a226964223b733a313a2231223b733a31303a2270726f66696c65706963223b733a303a22223b733a383a227570677261646564223b733a313a2230223b733a31303a2246616365626f6f6b4964223b733a303a22223b733a383a22476f6f676c654964223b733a303a22223b733a393a2266697273746e616d65223b733a353a2241646d696e223b733a343a22726f6c65223b733a313a2231223b733a363a2274656c6e756d223b733a31323a22313231203435342035373837223b733a32303a22636f756e7472795f616262726576696174696f6e223b733a323a22696e223b733a31363a22636f756e7472795f636f64655f6e756d223b733a333a222b3931223b733a353a22656d61696c223b733a31363a2261646d696e40736c6f67696e2e636f6d223b733a31323a224d61696c5665726966696564223b733a313a2230223b733a31303a2261646465645f74696d65223b733a31303a2231343936363438323734223b733a383a2261646465645f6279223b733a313a2230223b733a31323a22757064617465645f74696d65223b733a31303a2231353134353432323531223b733a31303a22757064617465645f6279223b733a313a2231223b733a353a227077617264223b733a36303a22243279243039247750373161307668364761516a366732616c366c332e61344f4b4f593936476a7441794952774d45754a7830715045704e4e484579223b733a353a226167726565223b733a313a2231223b733a363a22737461747573223b733a313a2231223b7d),
('4874sgpj9jtovdfaevdoi09f9mdf3gag', '::1', 1516559610, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535393630303b7765627369746564657461696c7373657373696f6e7c4f3a383a22737464436c617373223a32303a7b733a323a226964223b733a313a2232223b733a31323a22576562736974655469746c65223b733a303a22223b733a373a2241646472657373223b733a303a22223b733a31323a22436f6e74616374456d61696c223b733a31353a22696e666f40736c6f67696e2e636f6d223b733a353a2250686f6e65223b733a303a22223b733a333a22466178223b733a303a22223b733a343a224c6f676f223b733a303a22223b733a373a2246617669636f6e223b733a303a22223b733a31323a22416e616c79746963436f6465223b733a303a22223b733a383a224d61696c486f7374223b733a32323a2273736c3a2f2f736d74702e6d61696c67756e2e6f7267223b733a383a224d61696c506f7274223b733a333a22343635223b733a31323a224d61696c557365724e616d65223b733a31383a226e6f7265706c7940736c6f67696e2e636f6d223b733a31323a224d61696c50617373776f7264223b733a333a22313233223b733a393a2246726f6d456d61696c223b733a31353a22696e666f40736c6f67696e2e636f6d223b733a393a224d6574615469746c65223b733a303a22223b733a383a224d65746144657363223b733a303a22223b733a31313a225765627369746541646472223b733a303a22223b733a363a2266624c696e6b223b733a303a22223b733a363a2267704c696e6b223b733a303a22223b733a353a22746c696e6b223b733a303a22223b7d64656661756c745f7374796c657c733a31313a2264656661756c742e637373223b73657373696f6e5f7374796c657c733a31303a226c69746572612e637373223b69735f61646d696e7c733a313a2231223b6c6f67676564696e5f61646d696e5f73657373696f6e7c4f3a383a22737464436c617373223a31393a7b733a323a226964223b733a313a2231223b733a31303a2270726f66696c65706963223b733a303a22223b733a383a227570677261646564223b733a313a2230223b733a31303a2246616365626f6f6b4964223b733a303a22223b733a383a22476f6f676c654964223b733a303a22223b733a393a2266697273746e616d65223b733a353a2241646d696e223b733a343a22726f6c65223b733a313a2231223b733a363a2274656c6e756d223b733a31323a22313231203435342035373837223b733a32303a22636f756e7472795f616262726576696174696f6e223b733a323a22696e223b733a31363a22636f756e7472795f636f64655f6e756d223b733a333a222b3931223b733a353a22656d61696c223b733a31363a2261646d696e40736c6f67696e2e636f6d223b733a31323a224d61696c5665726966696564223b733a313a2230223b733a31303a2261646465645f74696d65223b733a31303a2231343936363438323734223b733a383a2261646465645f6279223b733a313a2230223b733a31323a22757064617465645f74696d65223b733a31303a2231353134353432323531223b733a31303a22757064617465645f6279223b733a313a2231223b733a353a227077617264223b733a36303a22243279243039247750373161307668364761516a366732616c366c332e61344f4b4f593936476a7441794952774d45754a7830715045704e4e484579223b733a353a226167726565223b733a313a2231223b733a363a22737461747573223b733a313a2231223b7d666c6173685f6d6573736567657c733a32383a22576562736974652075706461746564207375636365737366756c6c79223b5f5f63695f766172737c613a323a7b733a31333a22666c6173685f6d657373656765223b733a333a226f6c64223b733a31373a22666c6173685f6572726f725f636c617373223b733a333a226f6c64223b7d666c6173685f6572726f725f636c6173737c733a31393a22616c65727420616c6572742d73756363657373223b),
('9gsij1h79sr6cbh8e1d56smvgp3ucj8c', '::1', 1524588639, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532343538383437313b7765627369746564657461696c7373657373696f6e7c4f3a383a22737464436c617373223a32303a7b733a323a226964223b733a313a2232223b733a31323a22576562736974655469746c65223b733a303a22223b733a373a2241646472657373223b733a303a22223b733a31323a22436f6e74616374456d61696c223b733a31353a22696e666f40736c6f67696e2e636f6d223b733a353a2250686f6e65223b733a303a22223b733a333a22466178223b733a303a22223b733a343a224c6f676f223b733a303a22223b733a373a2246617669636f6e223b733a303a22223b733a31323a22416e616c79746963436f6465223b733a303a22223b733a383a224d61696c486f7374223b733a32323a2273736c3a2f2f736d74702e6d61696c67756e2e6f7267223b733a383a224d61696c506f7274223b733a333a22343635223b733a31323a224d61696c557365724e616d65223b733a31383a226e6f7265706c7940736c6f67696e2e636f6d223b733a31323a224d61696c50617373776f7264223b733a333a22313233223b733a393a2246726f6d456d61696c223b733a31353a22696e666f40736c6f67696e2e636f6d223b733a393a224d6574615469746c65223b733a303a22223b733a383a224d65746144657363223b733a303a22223b733a31313a225765627369746541646472223b733a303a22223b733a363a2266624c696e6b223b733a303a22223b733a363a2267704c696e6b223b733a303a22223b733a353a22746c696e6b223b733a303a22223b7d64656661756c745f7374796c657c733a31313a2264656661756c742e637373223b69735f61646d696e7c733a313a2231223b6c6f67676564696e5f61646d696e5f73657373696f6e7c4f3a383a22737464436c617373223a31393a7b733a323a226964223b733a313a2231223b733a31303a2270726f66696c65706963223b733a303a22223b733a383a227570677261646564223b733a313a2230223b733a31303a2246616365626f6f6b4964223b733a303a22223b733a383a22476f6f676c654964223b733a303a22223b733a393a2266697273746e616d65223b733a353a2241646d696e223b733a343a22726f6c65223b733a313a2231223b733a363a2274656c6e756d223b733a31323a22313231203435342035373837223b733a32303a22636f756e7472795f616262726576696174696f6e223b733a323a22696e223b733a31363a22636f756e7472795f636f64655f6e756d223b733a333a222b3931223b733a353a22656d61696c223b733a31363a2261646d696e40736c6f67696e2e636f6d223b733a31323a224d61696c5665726966696564223b733a313a2230223b733a31303a2261646465645f74696d65223b733a31303a2231343936363438323734223b733a383a2261646465645f6279223b733a313a2230223b733a31323a22757064617465645f74696d65223b733a31303a2231353134353432323531223b733a31303a22757064617465645f6279223b733a313a2231223b733a353a227077617264223b733a36303a22243279243039247750373161307668364761516a366732616c366c332e61344f4b4f593936476a7441794952774d45754a7830715045704e4e484579223b733a353a226167726565223b733a313a2231223b733a363a22737461747573223b733a313a2231223b7d666c6173685f6d6573736567657c733a31373a224661696c656420746f20696d706f727421223b5f5f63695f766172737c613a323a7b733a31333a22666c6173685f6d657373656765223b733a333a226f6c64223b733a31373a22666c6173685f6572726f725f636c617373223b733a333a226f6c64223b7d666c6173685f6572726f725f636c6173737c733a31383a22616c65727420616c6572742d64616e676572223b);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `rolename`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `site_cookie`
--

CREATE TABLE `site_cookie` (
  `id` int(11) NOT NULL,
  `cookie_code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry_date` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblemailtemplate`
--

CREATE TABLE `tblemailtemplate` (
  `id` int(11) NOT NULL,
  `Key` varchar(255) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Bodya` varchar(2000) DEFAULT NULL,
  `DateUpdated` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `added_time` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblemailtemplate`
--

INSERT INTO `tblemailtemplate` (`id`, `Key`, `Subject`, `Bodya`, `DateUpdated`, `added_by`, `added_time`, `updated_by`, `updated_time`) VALUES
(1, 'WEBSITE_USER_REGISTRATION', 'Registration Successful!', '<p>We thank you for registering your details with #projectname#.</p>\r\n', '2016-10-19 17:49:59', 0, 0, 1, 1514451203),
(2, 'WEBSITE_USER_FORGOT_PASSWORD', 'User Account Details', 'Hi #Name#,<br>You have received this email after having submitted a Forgot Password request.<br>Your new password: #Password#<br>Please click here to &lt;p&gt;&lt;a href=\"#link#\"&gt;login&lt;/a&gt; <br><br>Thanks,<br>Customer Support Team<br>#projectname#\r\n<br><br>', '2016-10-19 17:53:07', 0, 0, 0, 0),
(3, 'WEBSITE_USER_PASSWORD_RESET', 'Reset Password of User', '<p>Hi #Name#,<br>\r\n<br>\r\nYou have received this email after having submitted a password reset request.<br>\r\nPlease click here to <a href=\"#link#\">reset password </a><br>\r\n<br>\r\nThanks,<br>\r\nCustomer Support Team<br>\r\n#projectname#<br>\r\n </p>\r\n', '2016-10-19 17:54:22', 0, 0, 1, 1514451546),
(4, 'WEBSITE_USER_SUCCESSFUL_PASSWORD_RESET', 'Successful Password Reset!', 'Hi #Name#,<br><br>Congratulation! Your password has been reset successfully.<br>Your new password is: #password#<br><br>Thanks,<br>Customer Support Team<br>#projectname#<br><br>', '2016-10-19 18:12:17', 0, 0, 0, 0),
(5, 'WEBSITE_USER_REGISTRATION_VERIFY', 'Registration Successful!', '<p>Hello,#fullname#</p>\r\n\r\n<p>We thank you for registering your details with #projectname#.</p>\r\n\r\n<p><strong>Your Username is :</strong> #username#</p>\r\n\r\n<p><strong>Your Password is :<strong> #Password#</strong></strong></p>\r\n\r\n<p><strong><strong>Please click here to verify your account <a href=\"#link#\">Verify</a></strong></strong></p>\r\n\r\n<p><br>\r\n<strong><strong>or goto #link#<br>\r\n<br>\r\nThanks,<br>\r\nCustomer Support Team<br>\r\n#projectname# </strong></strong></p>\r\n', NULL, 0, 0, 1, 1514456436),
(6, 'WEBSITE_USER_REGISTRATION_JUSTVERIFY', 'Registration Verification!', '<p>Hello,#fullname#</p>\r\n\r\n<p>We thank you for registering your details with #projectname#.</p>\r\n\r\n<p>Please click here to verify your account <a href=\"#link#\">Verify</a></p>\r\n\r\n<p><br>\r\nor goto #link#<br>\r\n<br>\r\nThanks,<br>\r\nCustomer Support Team<br>\r\n#projectname#</p>\r\n', NULL, 0, 0, 1, 1514450848),
(7, 'WEBSITE_USER_REGISTRATION_INFORM_ADMIN', 'New Registration Successful!', '<p>Hello,#admin#</p>\r\n\r\n<p>New registration with #projectname#.</p>\r\n\r\n<p><strong>Email is :</strong> #email#</p>\r\n\r\n<p>Thanks,<br>\r\nCustomer Support Team<br>\r\n#projectname#</p>\r\n\r\n<p> </p>\r\n', NULL, 1, 1515135002, 1, 1516559487);

-- --------------------------------------------------------

--
-- Table structure for table `tblwebsite_master`
--

CREATE TABLE `tblwebsite_master` (
  `id` int(50) NOT NULL,
  `WebsiteTitle` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `ContactEmail` varchar(255) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Fax` varchar(50) NOT NULL,
  `Logo` varchar(255) NOT NULL,
  `Favicon` varchar(255) NOT NULL,
  `AnalyticCode` varchar(255) NOT NULL,
  `MailHost` varchar(100) NOT NULL,
  `MailPort` varchar(45) NOT NULL,
  `MailUserName` varchar(45) NOT NULL,
  `MailPassword` varchar(100) NOT NULL,
  `FromEmail` varchar(100) NOT NULL,
  `MetaTitle` text NOT NULL,
  `MetaDesc` text NOT NULL,
  `WebsiteAddr` text NOT NULL,
  `fbLink` varchar(255) NOT NULL,
  `gpLink` varchar(255) NOT NULL,
  `tlink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblwebsite_master`
--

INSERT INTO `tblwebsite_master` (`id`, `WebsiteTitle`, `Address`, `ContactEmail`, `Phone`, `Fax`, `Logo`, `Favicon`, `AnalyticCode`, `MailHost`, `MailPort`, `MailUserName`, `MailPassword`, `FromEmail`, `MetaTitle`, `MetaDesc`, `WebsiteAddr`, `fbLink`, `gpLink`, `tlink`) VALUES
(2, '', '', 'info@slogin.com', '', '', '', '', '', 'ssl://smtp.mailgun.org', '465', 'noreply@slogin.com', '123', 'info@slogin.com', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(250) NOT NULL,
  `country_name` varchar(250) NOT NULL,
  `currancy_code` varchar(250) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_time` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `country_code`, `country_name`, `currancy_code`, `added_by`, `added_time`, `updated_by`, `updated_time`, `status`) VALUES
(8, '+100', 'india', 'in', 1, 1515140278, 0, 0, 0),
(9, '+23', 'sfb', 'ed', 1, 1515140278, 1, 1514534978, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emailverification`
--

CREATE TABLE `tbl_emailverification` (
  `id` int(11) NOT NULL,
  `hased_email` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `hased_pass` varchar(1000) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_time` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_emailverification`
--

INSERT INTO `tbl_emailverification` (`id`, `hased_email`, `email`, `hased_pass`, `added_by`, `added_time`, `updated_by`, `updated_time`, `status`) VALUES
(21, '77e0ffccbb11e8dd7ad0dd152711a7ba', 'innovac.sandeep@gmail.com', '811b05fd7f40fa93d6814e3998765dd1', 0, 1515135541, 0, 0, 1),
(22, '00d0e6a625d8b4c1c153669abcdf7222', 'innovac.ritesh@gmail.com', '8bf2a5917b2df9e4ba9167c38a902d15', 0, 1516083080, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_settings`
--

CREATE TABLE `tbl_social_settings` (
  `id` int(11) NOT NULL,
  `fbapi_key` varchar(250) NOT NULL,
  `fbapp_secret` varchar(250) NOT NULL,
  `gpapplication_name` varchar(250) NOT NULL,
  `gpclient_secret` varchar(250) NOT NULL,
  `gpapi_key` varchar(250) NOT NULL,
  `gpclient_id` varchar(250) NOT NULL,
  `gpredirect_uri` varchar(250) NOT NULL,
  `added_time` int(1) NOT NULL,
  `added_by` int(1) NOT NULL,
  `updated_time` int(1) NOT NULL,
  `updated_by` int(1) NOT NULL,
  `platform` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_social_settings`
--

INSERT INTO `tbl_social_settings` (`id`, `fbapi_key`, `fbapp_secret`, `gpapplication_name`, `gpclient_secret`, `gpapi_key`, `gpclient_id`, `gpredirect_uri`, `added_time`, `added_by`, `updated_time`, `updated_by`, `platform`) VALUES
(1, '1455420854549591', '6c3434ce192c07e6c6e4a0edc48ba92c', 'Simple_Login', '3DgWCpnlI8ltNr6pvopg0Dfr', 'AIzaSyDjkTPMznlOcQZXy5I3s807I19e8vC_Jk8', '473789168650-08plsdskljkee2aok1pp74pg21mtpo8d.apps.googleusercontent.com', 'http://demo.anr.in/labs/Simple_Login/Register/gplogin', 1514370580, 1, 1516559456, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_style`
--

CREATE TABLE `tbl_style` (
  `id` int(11) NOT NULL,
  `selected_css` varchar(250) NOT NULL,
  `style_desc` varchar(1000) NOT NULL,
  `added_time` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `style_default` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_style`
--

INSERT INTO `tbl_style` (`id`, `selected_css`, `style_desc`, `added_time`, `added_by`, `updated_time`, `updated_by`, `status`, `style_default`) VALUES
(10, 'darky.css', 'acsc', 1513951239, 1, 1514268329, 1, 1, 0),
(11, 'flatly.css', '', 1514183304, 1, 1514188830, 1, 1, 0),
(12, 'litera.css', '', 1514183318, 1, 1514462475, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `capcha`
--
ALTER TABLE `capcha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_cookie`
--
ALTER TABLE `site_cookie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemailtemplate`
--
ALTER TABLE `tblemailtemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblwebsite_master`
--
ALTER TABLE `tblwebsite_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_emailverification`
--
ALTER TABLE `tbl_emailverification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social_settings`
--
ALTER TABLE `tbl_social_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_style`
--
ALTER TABLE `tbl_style`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selected_css` (`selected_css`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `capcha`
--
ALTER TABLE `capcha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_cookie`
--
ALTER TABLE `site_cookie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblemailtemplate`
--
ALTER TABLE `tblemailtemplate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblwebsite_master`
--
ALTER TABLE `tblwebsite_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_emailverification`
--
ALTER TABLE `tbl_emailverification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_social_settings`
--
ALTER TABLE `tbl_social_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_style`
--
ALTER TABLE `tbl_style`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
