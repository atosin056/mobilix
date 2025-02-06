-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 07:29 PM
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
-- Database: `mobilix`
--

-- --------------------------------------------------------

--
-- Table structure for table `airtime`
--

CREATE TABLE `airtime` (
  `id` int(11) NOT NULL,
  `service_id` varchar(255) NOT NULL,
  `Network` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL DEFAULT 'standard',
  `price` int(11) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airtime`
--

INSERT INTO `airtime` (`id`, `service_id`, `Network`, `service_type`, `price`, `trans_id`, `phone`) VALUES
(1, 'BAD', 'Airtel', 'PREMIUM', 50, '676d7af10a5a9', '09115197167'),
(2, 'BAD', 'Airtel', 'PREMIUM', 80, '676d7b40af852', '09115197167'),
(3, 'BAD', 'Airtel', 'PREMIUM', 70, '676d7c4e9a718', '09115197167'),
(4, 'BAD', 'Airtel', 'PREMIUM', 100, '676d7f7cabdb8', '09115197167'),
(5, 'BAD', 'Airtel', 'PREMIUM', 50, '677930d98f268', '09115197167'),
(6, 'BAD', 'Airtel', 'STANDARD', 50, '678a7d8f111c6', '09115197167'),
(7, 'BAD', 'Airtel', 'PREMIUM', 120, '1737393740', '09115197167'),
(8, 'BAD', 'MTN', 'PREMIUM', 100, '1737805163', '07031272572'),
(9, 'BAD', 'Airtel', 'PREMIUM', 1000, '1738509876', '09115197167');

-- --------------------------------------------------------

--
-- Table structure for table `airtimeprices`
--

CREATE TABLE `airtimeprices` (
  `id` int(11) NOT NULL,
  `network` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airtimeprices`
--

INSERT INTO `airtimeprices` (`id`, `network`, `price`) VALUES
(1, 'Mtn', 50),
(2, 'Mtn', 100),
(3, 'Mtn', 200),
(4, 'Mtn', 500),
(5, 'Mtn', 1000),
(6, 'Mtn', 2000),
(7, 'Airtel', 50),
(8, 'Airtel', 100),
(9, 'Airtel', 200),
(10, 'Airtel', 500),
(11, 'Airtel', 1000),
(12, 'Airtel', 2000),
(13, 'Glo', 50),
(14, 'Glo', 100),
(15, 'Glo', 200),
(16, 'Glo', 500),
(17, 'Glo', 1000),
(18, 'Glo', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `data_bundles`
--

CREATE TABLE `data_bundles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `network` varchar(255) NOT NULL,
  `service_id` varchar(255) NOT NULL,
  `real_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_bundles`
--

INSERT INTO `data_bundles` (`id`, `name`, `product_code`, `price`, `network`, `service_id`, `real_price`) VALUES
(2, '500MB Airtel Data - 30days Validity', 'MBAS500', '194', 'Airtel', 'BCD', '144'),
(3, '1GB Airtel Data - 30days Validity', 'MBAS1', '300', 'Airtel', 'BCD', '290'),
(4, '2GB Airtel Data - 30days Validity', 'MBAS2', '600', 'Airtel', 'BCD', '580'),
(5, '5GB Airtel Data - 30days Validity', 'MBAS5', '1500', 'Airtel', 'BCD', '1450'),
(6, '10GB Airtel Data - 30days Validity', 'MBAS10', '2950', 'Airtel', 'BCD', '2900'),
(7, '15GB Airtel Data - 30days Validity', 'MBAS15', '4400', 'Airtel', 'BCD', '4350'),
(8, '20GB Airtel Data - 30days Validity', 'MBAS20', '5850', 'Airtel', 'BCD', '5800'),
(9, '500MB Mtn Sme - Monthly', 'MS500', '190', 'MTN', 'BCA', '140'),
(10, '1GB Mtn Sme - Monthly', 'MS1000', '300', 'MTN', 'BCA', '273'),
(11, '2GB Mtn Sme - Monthly', 'MS2000', '566', 'MTN', 'BCA', '546'),
(12, '3GB Mtn Sme - Monthly', 'MS3000', '869', 'MTN', 'BCA', '819'),
(13, '5GB Mtn Sme - Monthly', 'MS5000', '1400', 'MTN', 'BCA', '1365'),
(14, '10GB Mtn Sme - Monthly', 'MS10000', '2780', 'MTN', 'BDA', '2730'),
(16, '500MB Glo Data - 30days Validity', 'MBGG500', '193', 'Glo', 'BCC', '148'),
(17, '1GB Glo Data - 30days Validity', 'MBGG1', '300', 'Glo', 'BCC', '290'),
(18, '2GB Glo Data - 30days Validity', 'MBGG2', '600', 'Glo', 'BCC', '580'),
(19, '3GB Glo Data - 30days Validity', 'MBGG3', '920', 'Glo', 'BCC', '870'),
(20, '5GB Glo Data - 30days Validity', 'MBGG5', '1500', 'Glo', 'BCC', '1450'),
(21, '10GB Glo Data - 30days Validity', 'MBGG10', '2950', 'Glo', 'BCC', '2900');

-- --------------------------------------------------------

--
-- Table structure for table `mobilix_transfers`
--

CREATE TABLE `mobilix_transfers` (
  `id` int(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `reciever` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supported_banks`
--

CREATE TABLE `supported_banks` (
  `id` int(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_code` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supported_banks`
--

INSERT INTO `supported_banks` (`id`, `bank_name`, `bank_code`) VALUES
(1, '78 FINANCE COMPANY LIMITED', 110072),
(2, '9 PAYMENT SOLUTIONS BANK', 120001),
(3, '9JAPAY MICROFINANCE BANK', 90629),
(4, 'AB MICROFINANCE BANK ', 90270),
(5, 'ABBEY MORTGAGE BANK', 70010),
(6, 'ABOVE ONLY MICROFINANCE BANK ', 90260),
(7, 'ABU MICROFINANCE BANK ', 90197),
(8, 'Access bank', 44),
(9, 'ACCESS MONEY', 927),
(10, 'ACCESS YELLO & BETA', 100052),
(11, 'ACCION MICROFINANCE BANK', 90134),
(12, 'ADA MICROFINANCE BANK', 90483),
(13, 'ADDOSSER MICROFINANCE BANK', 90160),
(14, 'ADEYEMI COLLEGE STAFF MICROFINANCE BANK', 90268),
(15, 'AELLA MFB', 90614),
(16, 'AFEKHAFE MICROFINANCE BANK', 90292),
(17, 'AG MORTGAGE BANK', 100028),
(18, 'AKALABO MFB', 90698),
(19, 'AKU Microfinance Bank', 90531),
(20, 'AL-BARAKAH MICROFINANCE BANK', 90133),
(21, 'ALEKUN MICROFINANCE BANK', 90259),
(22, 'ALERT MICROFINANCE BANK', 90297),
(23, 'ALLWORKERS MICROFINANCE BANK', 90131),
(24, 'ALPHA KAPITAL MICROFINANCE BANK ', 90169),
(25, 'AMML MICROFINANCE BANK ', 914),
(26, 'Amucha Microfinance Bank', 90645),
(27, 'APEKS MICROFINANCE BANK', 90143),
(28, 'ARISE MICROFINANCE BANK', 90282),
(29, 'ASO SAVINGS', 905),
(30, 'ASSETMATRIX MICROFINANCE BANK', 90287),
(31, 'ASSETS MFB', 90473),
(32, 'ASTRAPOLARIS MICROFINANCE BANK', 90172),
(33, 'AUCHI MICROFINANCE BANK ', 90264),
(34, 'AVUENEGBE MICROFINANCE BANK', 90478),
(35, 'AWACASH MICROFINANCE BANK', 51351),
(36, 'BAINES CREDIT MICROFINANCE BANK', 90188),
(37, 'BALOGUN GAMBARI MICROFINANCE BANK', 90326),
(38, 'BAM MICROFINANCE BANK', 90651),
(39, 'BANKLY MFB', 90529),
(40, 'BAOBAB MICROFINANCE BANK', 90136),
(41, 'BC KASH MICROFINANCE BANK', 90127),
(42, 'Beststar MFB', 90615),
(43, 'BETHEL MICROFINANCE BANK', 90683),
(44, 'BIPC MICROFINANCE BANK', 90336),
(45, 'BOCTRUST MICROFINANCE BANK LIMITED', 952),
(46, 'BOKKOS MFB', 90703),
(47, 'BOROMU MICROFINANCE BANK', 90501),
(48, 'BOSAK MICROFINANCE BANK', 90176),
(49, 'Bowen Microfinance Bank', 50931),
(50, 'Branch International Financial Services', 5),
(51, 'BRENT MORTGAGE BANK', 70015),
(52, 'BRIGHTWAY MICROFINANCE BANK', 90308),
(53, 'BUILD MICROFINANCE BANK', 90613),
(54, 'BUYPOWER MICROFINANCE BANK', 90682),
(55, 'CAPITALMETRIQ', 51319),
(56, 'CARBON', 940),
(57, 'CASHBRIDGE MICROFINANCE BANK', 90634),
(58, 'CASHCONNECT MICROFINANCE BANK', 90360),
(59, 'CELLULANT', 919),
(60, 'CEMCS Microfinance Bank', 50823),
(61, 'CHAMS MOBILE', 929),
(62, 'CHIKUM MICROFINANCE BANK', 90141),
(63, 'Citibank Nigeria', 23),
(64, 'CITYCODE MORTGAGE BANK', 70027),
(65, 'Clearpay Microfinance Bank', 90482),
(66, 'COASTLINE MICROFINANCE BANK', 90374),
(67, 'CONPRO MICROFINANCE BANK', 90380),
(68, 'CONSUMER MICROFINANCE BANK', 90130),
(69, 'CONTEC GLOBAL INFOTECH LIMITED(NOWNOW)', 100032),
(70, 'CORESTEP MICROFINANCE BANK', 90365),
(71, 'Coronation Bank', 946),
(72, 'County Finance Limited', 50001),
(73, 'COVENANT MFB', 949),
(74, 'CREDIT AFRIQUE MICROFINANCE BANK', 90159),
(75, 'CRUST MICROFINANCE BANK', 90560),
(76, 'CRUTECH  MFB', 90414),
(77, 'CSD MICROFINANCE BANK', 90686),
(78, 'DAL MFB', 90596),
(79, 'DAVENPORT MICROFINANCE BANK', 90673),
(80, 'DAVODANI  MICROFINANCE BANK', 90391),
(81, 'DAYLIGHT MICROFINANCE BANK', 90167),
(82, 'DESTINY MFB', 90723),
(83, 'Diamond bank', 63),
(84, 'DOJE Microfinance Bank Limited', 90404),
(85, 'E-BARCS MICROFINANCE BANK', 90156),
(86, 'EAGLE FLIGHT MICROFINANCE BANK', 90294),
(87, 'Earnwell MICROFINANCE BANK', 90674),
(88, 'EARTHOLEUM', 935),
(89, 'Ecobank Nigeria Plc', 50),
(90, 'ECOBANK XPRESS ACCOUNT', 922),
(91, 'ECOMOBILE', 307),
(92, 'EJINDU MFB', 90694),
(93, 'EK-RELIABLE MICROFINANCE BANK', 90389),
(94, 'EKIMOGUN MFB', 90552),
(95, 'EKONDO MICROFINANCE BANK', 90097),
(96, 'EMERALD MICROFINANCE BANK', 90273),
(97, 'EMPIRE TRUST MICROFINANCE BANK', 913),
(98, 'ENTERPRISE BANK', 84),
(99, 'ESO-E MICROFINANCE BANK', 90166),
(100, 'eTRANZACT', 920),
(101, 'EVANGEL MICROFINANCE BANK ', 90304),
(102, 'EVERGREEN MICROFINANCE BANK', 90332),
(103, 'EXCEL MICROFINANCE BANK', 90678),
(104, 'Eyowo', 50126),
(105, 'FairMoney', 51318),
(106, 'FAST MICROFINANCE BANK', 90179),
(107, 'FBNQUEST MERCHANT BANK', 911),
(108, 'FCMB MOBILE', 100031),
(109, 'FCT MICROFINANCE BANK', 90290),
(110, 'FEDPOLY NASARAWA MICROFINANCE BANK', 90298),
(111, 'FETS', 915),
(112, 'FEWCHORE FINANCE COMAPNY LIMITED', 50002),
(113, 'FFS MICROFINANCE BANK', 90153),
(114, 'Fidelity bank', 70),
(115, 'FIDELITY MOBILE', 933),
(116, 'FIDFUND MICROFINANCE Bank', 90126),
(117, 'FINATRUST MICROFINANCE BANK', 90111),
(118, 'FINCA MICROFINANCE BANK', 90400),
(119, 'FIRMUS MICROFINANCE BANK', 90366),
(120, 'First bank', 11),
(121, 'First City Monument Bank Plc', 214),
(122, 'FIRST GENERATION MORTGAGE BANK', 70014),
(123, 'FIRST OPTION MICROFINANCE BANK', 90285),
(124, 'FIRST ROYAL MICROFINANCE BANK', 90164),
(125, 'FIRST TRUST MORTGAGE BANK PLC', 910),
(126, 'FIRSTMONIE WALLET', 928),
(127, 'FLUTTERWAVE TECHNOLOGY SOLUTIONS LIMITED', 110002),
(128, 'FOCUS MFB', 90709),
(129, 'FORTIS MICROFINANCE BANK', 948),
(130, 'FORTIS MOBILE', 930),
(131, 'FSDH', 400001),
(132, 'FULLRANGE MICROFINANCE BANK', 90145),
(133, 'FUTO MICROFINANCE BANK', 90158),
(134, 'Gabsyn Microfinance Bank Limited', 90591),
(135, 'Garun Mallam MFB', 90691),
(136, 'GATEWAY MORTGAGE BANK', 70009),
(137, 'GDL FINANCE', 50026),
(138, 'Globus', 103),
(139, 'Globus Bank', 103),
(140, 'GLORY MICROFINANCE BANK', 90278),
(141, 'GOLDMAN MICROFINANCE BANK', 50356),
(142, 'GOOD SHEPHERD MICROFINANCE BANK', 90664),
(143, 'GOODNEWS MICROFINANCE BANK', 90495),
(144, 'GOSIFECHUKWU MFB', 90687),
(145, 'GOWANS MICROFINANCE BANK', 90122),
(146, 'GRANTS MICROFINANCE BANK', 90335),
(147, 'GREENBANK MICROFINANCE BANK', 90178),
(148, 'Greenwich Merchant Bank', 60004),
(149, 'GROOMING MICROFINANCE BANK', 90195),
(150, 'GT MOBILE', 923),
(151, 'GTBank', 58),
(152, 'GTI MICROFINANCE BANK', 90385),
(153, 'Hackman Microfinance Bank', 51251),
(154, 'HAGGAI MORTGAGE BANK LIMITED', 70017),
(155, 'HALO MICROFINANCE BANK', 90539),
(156, 'Hasal Microfinance Bank', 50383),
(157, 'HEADWAY MICROFINANCE BANK', 90363),
(158, 'HEDONMARK', 931),
(159, 'Heritage bank', 30),
(160, 'HopePSB', 120002),
(161, 'Ibile Microfinance Bank', 51244),
(162, 'IHIALA MFB', 90725),
(163, 'IKENNE MICROFINANCE BANK', 90324),
(164, 'IKIRE MICROFINANCE BANK', 90275),
(165, 'IKIRE MICROFINANCE BANK', 90279),
(166, 'IKOYI ILE MICROFINANCE BANK', 90681),
(167, 'ILISAN MICROFINANCE BANK', 90370),
(168, 'IMO STATE MICROFINANCE BANK', 90258),
(169, 'IMPERIAL HOMES MORTGAGE BANK', 938),
(170, 'IMSU MICROFINANCE BANK', 90670),
(171, 'Infinity MFB', 50457),
(172, 'INFINITY TRUST MORTGAGE BANK', 70016),
(173, 'INNOVECTIVES KESH', 100029),
(174, 'INSIGHT MICROFINANCE BANK', 90434),
(175, 'INTELLFIN', 941),
(176, 'INTERLAND MICROFINANCE BANK', 90386),
(177, 'IRL MICROFINANCE BANK', 90149),
(178, 'ISALEOYO MICROFINANCE BANK', 90377),
(179, 'ISUA MFB', 90701),
(180, 'ISUOFIA MICROFINANCE BANK', 90353),
(181, 'JAIZ BANK', 301),
(182, 'JUBILEE LIFE', 906),
(183, 'KADPOLY MICROFINANCE BANK', 90320),
(184, 'KADUPE MICROFINANCE BANK', 90669),
(185, 'KAYI MICROFINANCE BANK', 90667),
(186, 'Kayvee MICROFINANCE BANK', 90554),
(187, 'Kenechukwu microfinance bank', 513),
(188, 'Keystone bank', 82),
(189, 'KONTAGORA MICROFINANCE BANK', 90299),
(190, 'Kuda MFB', 90267),
(191, 'Kuda Microfinance Bank', 50211),
(192, 'LAGOS BUILDING AND INVESTMENT COMPANY', 70012),
(193, 'Lagos Building Investment Company Plc.', 90052),
(194, 'LAPO MICROFINANCE BANK', 90177),
(195, 'LAVENDER MICROFINANCE BANK', 90271),
(196, 'LEGEND MICROFINANCE BANK', 90372),
(197, 'Letshego MFB', 216),
(198, 'Links Microfinance Bank', 90435),
(199, 'LOMA MICROFINANCE BANK', 90620),
(200, 'LOTUS Bank', 303),
(201, 'LOVONUS MICROFINANCE BANK', 90265),
(202, 'M&M MICROFINANCE BANK', 90685),
(203, 'M36', 100035),
(204, 'Madobi MFB', 90605),
(205, 'MAINSTREET MICROFINANCE BANK', 90171),
(206, 'MANNY MICROFINANCE BANK', 90383),
(207, 'MAYFAIR MICROFINANCE BANK', 90321),
(208, 'MAYFRESH MORTGAGE BANK', 70019),
(209, 'MEGAPRAISE MICROFINANCE BANK', 90280),
(210, 'MICROVIS MICROFINANCE BANK ', 90113),
(211, 'MINT-FINEX MFB', 90281),
(212, 'MOLUSI MICROFINANCE BANK', 90362),
(213, 'MoMo PSB', 120003),
(214, 'MONEY BOX', 934),
(215, 'MONEY TRUST MICROFINANCE BANK', 963),
(216, 'MONEYFIELD MICROFINANCE BANK', 90144),
(217, 'Moneymaster PSB', 120005),
(218, 'Moniepoint Microfinance Bank', 50515),
(219, 'MOZFIN MICROFINANCE BANK', 90392),
(220, 'MUTUAL ALLIANCE MORTGAGE BANK', 70028),
(221, 'MUTUAL BENEFITS MFB', 90190),
(222, 'MUTUAL TRUST MICROFINANCE BANK', 90151),
(223, 'NDDC MICROFINANCE BANK', 90679),
(224, 'NDIORAH MICROFINANCE BANK', 90128),
(225, 'NEPTUNE MICROFINANCE BANK', 90329),
(226, 'NET MFB', 90675),
(227, 'NET MFB', 90675),
(228, 'NEW DAWN MICROFINANCE BANK', 90205),
(229, 'NEW GOLDEN PASTURES MICROFINANCE BANK', 90378),
(230, 'NIGERIAN NAVY MICROFINANCE BANK ', 90263),
(231, 'NIRSAL NATIONAL MICROFINANCE BANK', 90194),
(232, 'NNEW WOMEN MICROFINANCE BANK', 90283),
(233, 'NOVA MERCHANT BANK', 637),
(234, 'NOVUS MFB', 90734),
(235, 'NPF MICROFINANCE BANK', 947),
(236, 'NUGGETS MFB', 90676),
(237, 'NUTURE MICROFINANCE BANK', 90364),
(238, 'NWANNEGADI MICROFINANCE BANK', 90399),
(239, 'OCHE MICROFINANCE BANK', 90333),
(240, 'OCTOPUS MICROFINANCE BANK', 90576),
(241, 'OHAFIA MICROFINANCE BANK', 90119),
(242, 'OK MICROFINANCE BANK', 90567),
(243, 'OKENGWE MICROFINANCE BANK', 90646),
(244, 'OKPOGA MICROFINANCE BANK', 90161),
(245, 'OLABISI ONABANJO UNIVERSITY MICROFINANCE ', 90272),
(246, 'OLIVE MFB', 90696),
(247, 'OMIYE MICROFINANCE BANK', 90295),
(248, 'OMOLUABI', 950),
(249, 'OPAY', 999992),
(250, 'OPTIMUS BANK', 107),
(251, 'OSCOTECH MICROFINANCE BANK', 90396),
(252, 'OTUO MICROFINANCE BANK', 90542),
(253, 'PAGA', 327),
(254, 'PAGA - 100002', 100002),
(255, 'PAGE MFBank', 951),
(256, 'PALMPAY', 100033),
(257, 'PARALLEX', 907),
(258, 'Parkway Projects', 311),
(259, 'PARKWAY-READYCASH', 917),
(260, 'PATHFINDER MICROFINANACE BANK LIMITED', 90680),
(261, 'PATRICKGOLD MICROFINANCE BANK', 90317),
(262, 'PAYATTITUDE ONLINE', 943),
(263, 'PAYCOM (OPAY)', 305),
(264, 'PAYSTACK PAYMENTS LIMITED', 110006),
(265, 'PECANTRUST MICROFINANCE BANK', 90137),
(266, 'PENNYWISE MICROFINANCE BANK ', 90196),
(267, 'PERSONAL TRUST MICROFINANCE BANK', 90135),
(268, 'Petra Mircofinance Bank Plc', 50746),
(269, 'PFI FINANCE COMPANY LIMITED', 50021),
(270, 'PILLAR MICROFINANCE BANK', 90289),
(271, 'PLATINUM MORTGAGE BANK', 70013),
(272, 'Polaris Bank', 76),
(273, 'POLYIBADAN MFB', 90534),
(274, 'POLYUNWANA MICROFINANCE BANK', 90296),
(275, 'Premium Trust Bank', 105),
(276, 'PRESTIGE MICROFINANCE BANK', 90274),
(277, 'PROSPECTS MFB', 90689),
(278, 'PROSPERITY MFB', 90642),
(279, 'Providus Bank', 101),
(280, 'PRUDENT MICROFINANCE BANK', 90690),
(281, 'PURPLEMONEY MICROFINANCE BANK', 90303),
(282, 'Qube Microfinance Bank', 90569),
(283, 'QUICKFUND MICROFINANCE BANK', 90261),
(284, 'RAND MERCHANT BANK', 502),
(285, 'RANDALPHA MICROFINANCE BANK', 90496),
(286, 'Randalpha Microfinance Bank', 90496),
(287, 'REFUGE MORTGAGE BANK', 70011),
(288, 'REGENT MICROFINANCE BANK', 955),
(289, 'Rehoboth Microfinance bank', 90463),
(290, 'RENMONEY MICROFINANCE BANK ', 90198),
(291, 'REPHIDIM MICROFINANCE BANK', 90322),
(292, 'REX Microfinance Bank', 90449),
(293, 'RICHWAY MICROFINANCE BANK', 90132),
(294, 'ROCKSHIELD MICROFINANCE BANK', 90547),
(295, 'ROYAL EXCHANGE MICROFINANCE BANK', 90138),
(296, 'RSU MICROFINANCE BANK', 90535),
(297, 'Rubies Micro-finance Bank', 125),
(298, 'RUBIES MICROFINANCE BANK', 90175),
(299, 'SAFE HAVEN MICROFINANCE BANK', 90286),
(300, 'SAFETRUST', 909),
(301, 'SAGAMU MICROFINANCE BANK', 966),
(302, 'SEAP Microfinance Bank', 90513),
(303, 'SEED CAPITAL MICROFINANCE BANK', 609),
(304, 'SEEDVEST MICROFINANCE BANK', 90369),
(305, 'SHALOM MFB', 90502),
(306, 'Signature Bank', 34),
(307, 'SmartCash', 803),
(308, 'Sparkle Microfinance Bank', 51310),
(309, 'STANBIC IBTC @Ease WALLET', 921),
(310, 'Stanbic IBTC Bank Ltd.', 221),
(311, 'Standard Chartered Bank Nigeria Ltd.', 68),
(312, 'STANFORD MICROFINANACE BANK', 90162),
(313, 'STELLAS MICROFINANCE BANK ', 90262),
(314, 'Sterling bank', 232),
(315, 'STERLING MOBILE', 936),
(316, 'SULSPAP MICROFINANCE BANK', 90305),
(317, 'Suntrust Bank Nigeria Limited', 100),
(318, 'TAGPAY', 937),
(319, 'Taj Bank', 302),
(320, 'Taj_Pinspay', 80002),
(321, 'TCF MFB', 51211),
(322, 'TEASY INTERNATIONAL', 100010),
(323, 'TEASY MOBILE', 924),
(324, 'THINK FINANCE MICROFINANCE BANK', 90373),
(325, 'Titan Bank', 102),
(326, 'TITAN-PAYSTACK MICROFINANCE BANK', 100039),
(327, 'TREASURES MICROFINANCE BANK', 90663),
(328, 'TRIDENT MICROFINANCE BANK', 90146),
(329, 'TRIVES FINANCE COMPANY LTD', 50023),
(330, 'TRUST MICROFINANCE BANK', 90327),
(331, 'TRUSTBANC J6 MICROFINANCE BANK LIMITED', 90123),
(332, 'TRUSTFUND MICROFINANCE BANK ', 90276),
(333, 'TSANYAWA MICROFINANCE BANK', 90672),
(334, 'U & C MICROFINANCE BANK', 90315),
(335, 'UCEE MFB', 90706),
(336, 'UMUCHINEMERE PROCREDIT MICROFINANCE BANK', 90514),
(337, 'UNAAB MICROFINANCE BANK', 90331),
(338, 'Unical Microfinance Bank', 50871),
(339, 'Union bank', 32),
(340, 'United Bank For Africa Plc', 33),
(341, 'Unity Bank Plc', 215),
(342, 'UNIUYO MICROFINANCE BANK', 90338),
(343, 'UNIVERSITY OF NIGERIA, NSUKKA MICROFINANCE BANK', 90251),
(344, 'URE MICROFINANCE BANK', 90619),
(345, 'VENTURE GARDEN NIGERIA LIMITED', 110009),
(346, 'VFD microfinance bank', 566),
(347, 'VIRTUE MICROFINANCE BANK', 90150),
(348, 'VISA MICROFINANCE BANK', 90139),
(349, 'VT NETWORKS', 926),
(350, 'Wema bank', 35),
(351, 'WESLEY MFB', 90699),
(352, 'WETLAND  MICROFINANCE BANK LIMITED', 954),
(353, 'Wetland Microfinance Bank Limited', 90120),
(354, 'WRA MFB', 90631),
(355, 'WUDIL MICROFINANCE BANK', 90253),
(356, 'Xpress Wallet', 100040),
(357, 'XSLNCE MICROFINANCE BANK', 90124),
(358, 'YES MICROFINANCE BANK', 90142),
(359, 'YOBE MICROFINANCE  BANK', 90252),
(360, 'Zenith bank', 57),
(361, 'ZENITH MOBILE', 932),
(362, 'ZINTERNET - KONGAPAY', 939),
(363, 'Zitra MfB', 90718);

-- --------------------------------------------------------

--
-- Table structure for table `tv`
--

CREATE TABLE `tv` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `product_code` text NOT NULL,
  `service_id` text NOT NULL,
  `real_price` int(255) NOT NULL,
  `provider` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tv`
--

INSERT INTO `tv` (`id`, `name`, `price`, `product_code`, `service_id`, `real_price`, `provider`) VALUES
(1, 'DStv Yanga Bouquet E36', 5000, 'MBDYB', 'AKC', 5100, 'DSTV'),
(2, 'DStv Confam Bouquet E36', 9114, 'MBDCB', 'AKC', 9300, 'DSTV'),
(3, 'DStv Compact', 15400, 'MBDC2', 'AKC', 15700, 'DSTV'),
(4, 'DStv Compact Plus', 24500, 'MBDCP', 'AKC', 25000, 'DSTV'),
(5, 'DStv Premium', 36300, 'MBDP1', 'AKC', 37000, 'DSTV'),
(6, 'DStv Premium W/Afr  + Asian Bouquet', 41160, 'MBDPA', 'AKC', 42000, 'DSTV'),
(7, 'DStv Indian', 12152, 'MBDAB', 'AKC', 12400, 'DSTV'),
(8, 'DStv Padi', 3528, 'MBDP2', 'AKC', 3600, 'DSTV'),
(9, 'DStv Premium French + Showmax', 56350, 'MBDPF', 'AKC', 57500, 'DSTV'),
(10, 'DStv GWALLE36 + Showmax', 6493, 'MBDGWSBS', 'AKC', 6625, 'DSTV'),
(11, 'DStv Premium W/Afr E36 + Showmax', 36260, 'MBDPWAES', 'AKC', 37000, 'DSTV'),
(12, 'DStv Yanga Bouquet E36 + Showmax', 6713, 'MBDYBES', 'AKC', 6850, 'DSTV'),
(13, 'DStv Compact Plus Bouquet E36 + Showmax', 26215, 'MBDCPBES', 'AKC', 26750, 'DSTV'),
(14, 'DStv Compact Bouquet E36 + Showmax', 17101, 'MBDCBES', 'AKC', 17450, 'DSTV'),
(15, 'DStv Premium W/Afr E36 + ASIAE36 + Showmax', 41160, 'MBDPWAS', 'AKC', 42000, 'DSTV'),
(16, 'DStv Asian Bouquet E36 + Showmax', 15582, 'MBDAES', 'AKC', 15900, 'DSTV'),
(17, 'DStv Premium W/Afr + French Bonus Bouquet E36 + Showmax', 56350, 'MBDPFES', 'AKC', 57500, 'DSTV'),
(18, 'DStv Compact Plus + HDPVR/XtraView', 29400, 'MBDCH', 'AKC', 30000, 'DSTV'),
(19, 'DStv Compact Plus + Asian Add-on', 36652, 'MBDCA', 'AKC', 37400, 'DSTV'),
(20, 'DStv Compact Plus + French Touch + HDPVR/XtraView', 35084, 'MBDCFH', 'AKC', 35800, 'DSTV'),
(21, 'DStv Premium + HDPVR/XtraView', 41160, 'MBDPH', 'AKC', 42000, 'DSTV'),
(22, 'DStv Premium + French Touch + HDPVR/XtraView', 46844, 'MBDPFH', 'AKC', 47800, 'DSTV'),
(23, 'DStv Premium + French Touch', 41944, 'MBDPFT', 'AKC', 42800, 'DSTV'),
(24, 'DStv Premium Asia + HDPVR/XtraView', 46060, 'MBDPAH', 'AKC', 47000, 'DSTV'),
(25, 'DStv Premium Asia + French Touch', 46844, 'MBDPAF', 'AKC', 47800, 'DSTV'),
(26, 'DStv Yanga Bouquet E36 + French Touch', 10682, 'MBDYBF', 'AKC', 10900, 'DSTV'),
(27, 'DStv Yanga Bouquet E36 + HDPVR/XtraView', 9898, 'MBDYBH', 'AKC', 10100, 'DSTV'),
(28, 'DStv Yanga Bouquet E36 + French Touch + HDPVR/XtraView', 15582, 'MBDYFH', 'AKC', 15900, 'DSTV'),
(29, 'DStv Confam Bouquet E36 + French Touch', 14798, 'MBDCBF', 'AKC', 15100, 'DSTV'),
(30, 'DStv Confam Bouquet E36 + HDPVR/XtraView', 14014, 'MBDCBH', 'AKC', 14300, 'DSTV'),
(31, 'DStv Confam Bouquet E36 + French Touch + HDPVR/XtraView', 19900, 'MBDCBFH', 'AKC', 20100, 'DSTV'),
(32, 'GOtv Supa Plus Bouquet', 15386, 'MBGSPB', 'AKA', 15700, 'GOTV'),
(33, 'GOtv Supa Plus - Annual', 124480, 'MBGSPA', 'AKA', 126000, 'GOTV'),
(34, 'GOtv Supa Plus', 12250, 'MBGSPP', 'AKA', 12500, 'GOTV'),
(35, 'GOtv Open', 6468, 'MBGSOP', 'AKA', 6600, 'GOTV'),
(36, 'GOtv Supa', 9408, 'MBGSP', 'AKA', 9600, 'GOTV'),
(37, 'GOtv Max', 7056, 'MBGM', 'AKA', 7200, 'GOTV'),
(38, 'GOtv Jolli Bouquet', 4753, 'MBGJB2', 'AKA', 4850, 'GOTV'),
(39, 'GOtv Jinja Bouquet', 3234, 'MBGJB', 'AKA', 3300, 'GOTV'),
(40, 'GOtv Smallie - monthly', 1544, 'MBGSM', 'AKA', 1575, 'GOTV'),
(41, 'GOtv Smallie - quarterly', 4092, 'MBGSQ', 'AKA', 4175, 'GOTV'),
(42, 'GOtv Smallie - yearly', 12054, 'MBGSY', 'AKA', 12300, 'GOTV');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `balance` bigint(20) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pin`, `firstname`, `lastname`, `email`, `phone`, `nickname`, `balance`) VALUES
(3, '2804', 'Oluwatosin', 'Akinfenwa', 'atosin056@gmail.com', '09115197167', 'Tosin', 146),
(7, '0306', 'Oluwanifemi', 'Akinfenwa', 'anifemi513@gmail.com', '09015134469', 'Nifemi', 551),
(8, '1505', 'Paul', 'Okunoye', 'rexpauldrex5@gmail.com', '08088222406', 'Rex', 375),
(9, '1980', 'Kehinde', 'Akinfenwa', 'fenwakehinde538@gmail.com', '07031272572', 'Hellen', 721);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airtime`
--
ALTER TABLE `airtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airtimeprices`
--
ALTER TABLE `airtimeprices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_bundles`
--
ALTER TABLE `data_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobilix_transfers`
--
ALTER TABLE `mobilix_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supported_banks`
--
ALTER TABLE `supported_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tv`
--
ALTER TABLE `tv`
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
-- AUTO_INCREMENT for table `airtime`
--
ALTER TABLE `airtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `airtimeprices`
--
ALTER TABLE `airtimeprices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `data_bundles`
--
ALTER TABLE `data_bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `mobilix_transfers`
--
ALTER TABLE `mobilix_transfers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supported_banks`
--
ALTER TABLE `supported_banks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `tv`
--
ALTER TABLE `tv`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
