-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 04:37 PM
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
(7, 'BAD', 'Airtel', 'PREMIUM', 120, '1737393740', '09115197167');

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
(9, '500MB Mtn Sme - Monthly', 'MS500', '190', 'MTN', 'BDA', '140'),
(10, '1GB Mtn Sme - Monthly', 'MS1000', '300', 'MTN', 'BDA', '273'),
(11, '2GB Mtn Sme - Monthly', 'MS2000', '566', 'MTN', 'BDA', '546'),
(12, '3GB Mtn Sme - Monthly', 'MS3000', '869', 'MTN', 'BDA', '819'),
(13, '5GB Mtn Sme - Monthly', 'MS5000', '1400', 'MTN', 'BDA', '1365'),
(14, '10GB Mtn Sme - Monthly', 'MS10000', '2780', 'MTN', 'BDA', '2730'),
(16, '500MB Glo Data - 30days Validity', 'MBGG500', '193', 'Glo', 'BCC', '148'),
(17, '1GB Glo Data - 30days Validity', 'MBGG1', '300', 'Glo', 'BCC', '290'),
(18, '2GB Glo Data - 30days Validity', 'MBGG2', '600', 'Glo', 'BCC', '580'),
(19, '3GB Glo Data - 30days Validity', 'MBGG3', '920', 'Glo', 'BCC', '870'),
(20, '5GB Glo Data - 30days Validity', 'MBGG5', '1500', 'Glo', 'BCC', '1450'),
(21, '10GB Glo Data - 30days Validity', 'MBGG10', '2950', 'Glo', 'BCC', '2900'),
(22, '75MB Airtel Gifting - 1 Day', 'AG75D1', '97', 'Airtel', 'BCD', '97'),
(23, '200MB Airtel Gifting - 3 Days', 'AG200D3', '194', 'Airtel', 'BCD', '194'),
(26, '750MB Airtel Gifting - 2 Weeks', 'AG750W2', '485', 'Airtel', 'BCD', '485'),
(30, '2GB Airtel Gifting - 1 Day', 'AG2000D1', '485', 'Airtel', 'BCD', '485'),
(39, '40GB Airtel Gifting - Monthly', 'AG40000', '9700', 'Airtel', 'BCD', '9700'),
(40, '75GB Airtel Gifting - Monthly', 'AG75000', '14550', 'Airtel', 'BCD', '14550'),
(41, '110GB Airtel Gifting - Monthly', 'AG110000', '19400', 'Airtel', 'BCD', '19400'),
(42, '40MB Mtn Gifting - 1 Day', 'MG40D', '48', 'MTN', 'BCA', '48'),
(43, '100MB Mtn Gifting - 1 Day', 'MG100D', '97', 'MTN', 'BCA', '97'),
(44, '200MB Mtn Gifting - 3 Days', 'MG200D3', '194', 'MTN', 'BCA', '194'),
(45, '350MB Mtn Gifting - 1 Week', 'MG350W', '291', 'MTN', 'BCA', '291'),
(46, '750MB Mtn Gifting - 2 Weeks', 'MG750W2', '485', 'MTN', 'BCA', '485'),
(59, '17GB Mtn Gifting - Monthly', 'MG17000', '3880', 'MTN', 'BCA', '3880'),
(62, '30GB Mtn Gifting - Monthly', 'MG30000', '5820', 'MTN', 'BCA', '5820'),
(63, '30GB Mtn Gifting - 2 Months', 'MG30000M2', '7760', 'MTN', 'BCA', '7760'),
(65, '75GB Mtn Gifting - Monthly', 'MG75000', '16005', 'MTN', 'BCA', '16005'),
(66, '100GB Mtn Gifting - 2 Months', 'MG100000M2', '21340', 'MTN', 'BCA', '21340'),
(67, '120GB Mtn Gifting - Monthly', 'MG120000', '21340', 'MTN', 'BCA', '21340'),
(68, '160GB Mtn Gifting - 2 Months', 'MG160000M2', '32010', 'MTN', 'BCA', '32010'),
(69, '200GB Mtn Gifting - Monthly', 'MG200000', '32010', 'MTN', 'BCA', '32010'),
(70, '400GB Mtn Gifting - 3 Months', 'MG400000M3', '53500', 'MTN', 'BCA', '53350'),
(71, '600GB Mtn Gifting - 3 Months', 'MG600000M3', '72900', 'MTN', 'BCA', '72750'),
(72, '50MB Glo Gifting - 1 Day', 'GG50D', '46', 'Glo', 'BCC', '46'),
(73, '150MB Glo Gifting - 1 Day', 'GG150D', '92', 'Glo', 'BCC', '92'),
(74, '200MB Glo Gifting - 4 Days', 'GG200D4', '184', 'Glo', 'BCC', '184'),
(75, '350MB Glo Gifting - 2 Days', 'GG350D2', '184', 'Glo', 'BCC', '184'),
(79, '3.9GB Glo Gifting - Monthly (1GB+2GB Night)', 'GG3900', '920', 'Glo', 'BCC', '920'),
(81, '7.5GB Glo Gifting - Monthly (3.5GB+4GB Night)', 'GG7500', '1380', 'Glo', 'BCC', '1380'),
(82, '9.2GB Glo Gifting - Monthly (5.2GB+4GB Night)', 'GG9200', '1840', 'Glo', 'BCC', '1840'),
(86, '14GB Glo Gifting - Monthly (10GB+4GB Night)', 'GG14000', '2860', 'Glo', 'BCC', '2760'),
(87, '18GB Glo Gifting - Monthly (14GB+4GB Night)', 'GG18000', '3780', 'Glo', 'BCC', '3680'),
(88, '24GB Glo Gifting - Monthly (20GB+4GB)', 'GG24000', '4650', 'Glo', 'BCC', '4600'),
(89, '29GB Glo Gifting - Monthly (27.5GB+2GB Night)', 'GG29500', '7360', 'Glo', 'BCC', '7360'),
(90, '50GB Glo Gifting - Monthly (46GB+4GB Night)', 'GG50000', '9200', 'Glo', 'BCC', '9200'),
(91, '93GB Glo Gifting - Monthly (86GB+7GB Night)', 'GG93000', '13800', 'Glo', 'BCC', '13800'),
(92, '119GB Glo Gifting - Monthly (109GB+10GB Night)', 'GG119000', '16560', 'Glo', 'BCC', '16560'),
(93, '138GB Glo Gifting - Monthly (126GB+12GB Night)', 'GG138000', '18400', 'Glo', 'BCC', '18400'),
(94, '225GB Glo Gifting - Monthly', 'GG225000', '27600', 'Glo', 'BCC', '27600'),
(95, '300GB Glo Gifting - Monthly', 'GG300000', '33120', 'Glo', 'BCC', '33120'),
(96, '425GB Glo Gifting - 90 Days', 'GG425D90', '46000', 'Glo', 'BCC', '46000'),
(97, '525GB Glo Gifting - 90 Days', 'GG525D90', '55200', 'Glo', 'BCC', '55200'),
(98, '675GB Glo Gifting - 4 Months', 'GG4Mo', '69000', 'Glo', 'BCC', '69000'),
(99, '1024GB Glo Gifting - 1 Year', 'GG1YR', '92500', 'Glo', 'BCC', '92000'),
(100, '250MB Mtn Data - 30days Validity', 'MBMC250', '140', 'MTN', 'BCA', '78'),
(109, '40GB Mtn Data - 30days Validity', 'MBMC40', '11220', 'MTN', 'BCA', '11120'),
(110, '75GB Mtn Data - 30days Validity', 'MBMC75', '20950', 'MTN', 'BCA', '20850'),
(111, '100GB Mtn Data - 30days Validity', 'MBMC100', '27900', 'MTN', 'BCA', '27800');

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
(3, 'DStv Compact', 15386, 'MBDC2', 'AKC', 15700, 'DSTV'),
(4, 'DStv Compact Plus', 24500, 'MBDCP', 'AKC', 25000, 'DSTV'),
(5, 'DStv Premium', 36260, 'MBDP1', 'AKC', 37000, 'DSTV'),
(6, 'DStv Premium W/Afr  + Asian Bouquet', 41370, 'MBDPA', 'AKC', 42000, 'DSTV'),
(7, 'DStv Indian', 12350, 'MBDAB', 'AKC', 12400, 'DSTV'),
(8, 'DStv Padi', 3550, 'MBDP2', 'AKC', 3600, 'DSTV'),
(9, 'DStv Premium French + Showmax', 57550, 'MBDPF', 'AKC', 57500, 'DSTV'),
(10, 'DStv GWALLE36 + Showmax', 6625, 'MBDGWSBS', 'AKC', 6625, 'DSTV'),
(11, 'DStv Premium W/Afr E36 + Showmax', 37000, 'MBDPWAES', 'AKC', 37000, 'DSTV'),
(12, 'DStv Yanga Bouquet E36 + Showmax', 6850, 'MBDYBES', 'AKC', 6850, 'DSTV'),
(13, 'DStv Compact Plus Bouquet E36 + Showmax', 26750, 'MBDCPBES', 'AKC', 26750, 'DSTV'),
(14, 'DStv Compact Bouquet E36 + Showmax', 17450, 'MBDCBES', 'AKC', 17450, 'DSTV'),
(15, 'DStv Premium W/Afr E36 + ASIAE36 + Showmax', 42000, 'MBDPWAS', 'AKC', 42000, 'DSTV'),
(16, 'DStv Asian Bouquet E36 + Showmax', 15900, 'MBDAES', 'AKC', 15900, 'DSTV'),
(17, 'DStv Premium W/Afr + French Bonus Bouquet E36 + Showmax', 57500, 'MBDPFES', 'AKC', 57500, 'DSTV'),
(18, 'DStv Compact Plus + HDPVR/XtraView', 30000, 'MBDCH', 'AKC', 30000, 'DSTV'),
(19, 'DStv Compact Plus + Asian Add-on', 37400, 'MBDCA', 'AKC', 37400, 'DSTV'),
(20, 'DStv Compact Plus + French Touch + HDPVR/XtraView', 35800, 'MBDCFH', 'AKC', 35800, 'DSTV'),
(21, 'DStv Premium + HDPVR/XtraView', 42000, 'MBDPH', 'AKC', 42000, 'DSTV'),
(22, 'DStv Premium + French Touch + HDPVR/XtraView', 47800, 'MBDPFH', 'AKC', 47800, 'DSTV'),
(23, 'DStv Premium + French Touch', 42800, 'MBDPFT', 'AKC', 42800, 'DSTV'),
(24, 'DStv Premium Asia + HDPVR/XtraView', 4650, 'MBDPAH', 'AKC', 47000, 'DSTV'),
(25, 'DStv Premium Asia + French Touch', 47750, 'MBDPAF', 'AKC', 47800, 'DSTV'),
(26, 'DStv Yanga Bouquet E36 + French Touch', 10900, 'MBDYBF', 'AKC', 10900, 'DSTV'),
(27, 'DStv Yanga Bouquet E36 + HDPVR/XtraView', 10100, 'MBDYBH', 'AKC', 10100, 'DSTV'),
(28, 'DStv Yanga Bouquet E36 + French Touch + HDPVR/XtraView', 15900, 'MBDYFH', 'AKC', 15900, 'DSTV'),
(29, 'DStv Confam Bouquet E36 + French Touch', 15100, 'MBDCBF', 'AKC', 15100, 'DSTV'),
(30, 'DStv Confam Bouquet E36 + HDPVR/XtraView', 14300, 'MBDCBH', 'AKC', 14300, 'DSTV'),
(31, 'DStv Confam Bouquet E36 + French Touch + HDPVR/XtraView', 20100, 'MBDCBFH', 'AKC', 20100, 'DSTV'),
(32, 'GOtv Supa Plus Bouquet', 15700, 'MBGSPB', 'AKA', 15700, 'GOTV'),
(33, 'GOtv Supa Plus - Annual', 126050, 'MBGSPA', 'AKA', 126000, 'GOTV'),
(34, 'GOtv Supa Plus', 12500, 'MBGSPP', 'AKA', 12500, 'GOTV'),
(35, 'GOtv Open', 6600, 'MBGSOP', 'AKA', 6600, 'GOTV'),
(36, 'GOtv Supa', 9600, 'MBGSP', 'AKA', 9600, 'GOTV'),
(37, 'GOtv Max', 7200, 'MBGM', 'AKA', 7200, 'GOTV'),
(38, 'GOtv Jolli Bouquet', 4850, 'MBGJB2', 'AKA', 4850, 'GOTV'),
(39, 'GOtv Jinja Bouquet', 3250, 'MBGJB', 'AKA', 3300, 'GOTV'),
(40, 'GOtv Smallie - monthly', 1500, 'MBGSM', 'AKA', 1575, 'GOTV'),
(41, 'GOtv Smallie - quarterly', 4125, 'MBGSQ', 'AKA', 4175, 'GOTV'),
(42, 'GOtv Smallie - yearly', 12200, 'MBGSY', 'AKA', 12300, 'GOTV');

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
(3, '2804', 'Oluwatosin', 'Akinfenwa', 'atosin056@gmail.com', '09115197167', 'Tosin', 887),
(7, '0306', 'Oluwanifemi', 'Akinfenwa', 'anifemi513@gmail.com', '09015134469', 'Nifemi', 803),
(8, '1505', 'Paul', 'Okunoye', 'rexpauldrex5@gmail.com', '08088222406', 'Rex', -581);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `airtimeprices`
--
ALTER TABLE `airtimeprices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `data_bundles`
--
ALTER TABLE `data_bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `mobilix_transfers`
--
ALTER TABLE `mobilix_transfers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tv`
--
ALTER TABLE `tv`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
