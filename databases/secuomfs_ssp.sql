-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2022 at 04:06 AM
-- Server version: 10.3.34-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secuomfs_ssp`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `number` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `shop` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `duration` tinyint(4) NOT NULL,
  `price` int(4) NOT NULL,
  `car_plate` varchar(255) NOT NULL,
  `fopen` enum('closed','open','opened') NOT NULL DEFAULT 'closed',
  `come` tinyint(1) NOT NULL DEFAULT 0,
  `go_out` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`number`, `user`, `shop`, `id`, `start`, `end`, `duration`, `price`, `car_plate`, `fopen`, `come`, `go_out`) VALUES
(1, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608a9b68b62b37.64628436', '2021-04-30 13:00:00', '2021-04-30 14:00:00', 1, 0, '1234ببب', 'closed', 0, 0),
(2, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608a9b733aa1d2.57391081', '2021-04-30 13:00:00', '2021-04-30 14:00:00', 1, 0, '1234ببب', '', 0, 0),
(3, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608a9e29732551.42960747', '2021-04-30 13:00:00', '2021-04-30 14:00:00', 1, 0, '1234ببب', '', 0, 0),
(4, 'ahmedelkholy89@gmail.com', 'alexandria-montaza-shop-a', '608a9e62cbd8b4.51019042', '2021-04-29 15:00:00', '2021-04-29 21:00:00', 6, 0, '1894رب', '', 0, 0),
(5, 'ahmedelkholy89@gmail.com', 'alexandria-montaza-shop-a', '608aa0d01c3393.04266611', '2021-04-29 15:00:00', '2021-04-29 21:00:00', 6, 0, '1894رب', '', 0, 0),
(6, 'ahmedelkholy89@gmail.com', 'alexandria-montaza-shop-a', '608aa10100b018.71759470', '2021-04-29 15:00:00', '2021-04-29 21:00:00', 6, 0, '1894رب', '', 0, 0),
(7, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608aa2180ff087.51751771', '2021-04-29 15:00:00', '2021-04-29 16:00:00', 1, 0, '4567رب', '', 0, 0),
(8, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608abbe18befc6.09499279', '2021-04-30 15:00:00', '2021-04-30 18:00:00', 3, 0, '1234رب', '', 0, 0),
(9, 'ahmedelkholy89@gmail.com', 'alexandria-montaza-shop-b', '608c83ccde1aa2.94866342', '2021-05-01 01:00:00', '2021-05-01 07:00:00', 6, 0, '1234سبب', '', 0, 0),
(10, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608c8c2061cad4.99200865', '2021-05-01 04:00:00', '2021-05-01 05:00:00', 1, 0, '1234رب', '', 0, 0),
(11, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608c8c43e04c91.58758342', '2021-05-01 04:00:00', '2021-05-01 06:00:00', 2, 0, '4444سبب', '', 0, 0),
(12, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608c8c675efea2.78914610', '2021-05-01 04:00:00', '2021-05-01 07:00:00', 3, 0, '1ي', '', 0, 0),
(13, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608c8c913b18e8.06996347', '2021-05-01 04:00:00', '2021-05-01 08:00:00', 4, 0, '1234سيي', '', 0, 0),
(14, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608c8caf19ab52.69321342', '2021-05-01 05:00:00', '2021-05-01 10:00:00', 5, 0, '65ووو', '', 0, 0),
(15, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608c8ce4239ba6.88426441', '2021-05-01 04:00:00', '2021-05-01 10:00:00', 6, 0, '1234ننن', '', 0, 0),
(16, 'ahmedelkholy89@gmail.com', 'alexandria-montaza-shop-b', '608d43d9177822.82787248', '2021-05-01 15:00:00', '2021-05-01 16:00:00', 1, 0, '234رب', '', 0, 0),
(17, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608d48915ba635.56563266', '2021-05-01 18:00:00', '2021-05-01 20:00:00', 2, 0, '1111رب', '', 0, 0),
(18, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608d4db4df7d73.03806920', '2021-05-01 18:00:00', '2021-05-01 19:00:00', 1, 0, '1234س', '', 0, 0),
(19, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608d4f4d989348.18205969', '2021-05-01 18:00:00', '2021-05-01 20:00:00', 2, 8, '1234رب', '', 0, 0),
(20, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608d4f9f9fb525.96201436', '2021-05-01 18:00:00', '2021-05-01 20:00:00', 2, 8, '1234ببب', '', 0, 0),
(21, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608d4fc1956c23.22603015', '2021-05-01 18:00:00', '2021-05-02 00:00:00', 6, 24, '1234ننن', '', 0, 0),
(22, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ea8c4593e69.32847014', '2021-05-02 18:00:00', '2021-05-02 19:00:00', 1, 4, '1234سبب', '', 0, 0),
(23, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ea94f909a90.93362667', '2021-05-02 18:00:00', '2021-05-02 20:00:00', 2, 8, '1234لب', '', 0, 0),
(24, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ea9896fdeb3.46854077', '2021-05-02 18:00:00', '2021-05-02 21:00:00', 3, 12, '1234رب', '', 0, 0),
(25, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608eaa1e4e9900.75942703', '2021-05-02 18:00:00', '2021-05-02 22:00:00', 4, 16, '1234سبب', '', 0, 0),
(26, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608eaa3a9db338.57468188', '2021-05-02 18:00:00', '2021-05-02 23:00:00', 5, 20, '134يا', '', 0, 0),
(27, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ecf46181177.34540903', '2021-05-02 19:00:00', '2021-05-03 01:00:00', 6, 24, '1234رب', '', 0, 0),
(28, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ffc75119154.61678907', '2021-05-03 18:00:00', '2021-05-04 00:00:00', 6, 24, '1234سبب', '', 0, 0),
(29, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ffcad5c53d4.25153603', '2021-05-03 18:00:00', '2021-05-04 00:00:00', 6, 24, '1234سبب', '', 0, 0),
(30, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ffcf99f7252.88901377', '2021-05-03 18:00:00', '2021-05-04 00:00:00', 6, 24, '1234سبب', '', 0, 0),
(31, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ffd10aee202.74156997', '2021-05-03 18:00:00', '2021-05-04 00:00:00', 6, 24, '1234سبب', '', 0, 0),
(32, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '608ffd34b56db3.07937391', '2021-05-03 18:00:00', '2021-05-04 00:00:00', 6, 24, '1234سبب', '', 0, 0),
(33, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60900b08bbd630.86499652', '2021-05-04 18:00:00', '2021-05-05 00:00:00', 6, 24, '1234رب', '', 0, 0),
(34, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60900c134da730.76943398', '2021-05-04 18:00:00', '2021-05-04 23:00:00', 5, 20, '1234ياي', '', 0, 0),
(35, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60900de2ad4e63.58664044', '2021-05-04 18:00:00', '2021-05-04 20:00:00', 2, 8, '1234رب', '', 0, 0),
(36, 'ahmedelkholy89@gmail.com', 'alexandria-smouha-shop-a', '609013862d7661.18214696', '2021-05-04 18:00:00', '2021-05-04 21:00:00', 3, 12, '5555سبب', '', 0, 0),
(37, 'ahmedelkholy89@gmail.com', 'alexandria-smouha-shop-b', '6090157e7f1236.61829380', '2021-05-03 18:00:00', '2021-05-03 22:00:00', 4, 16, '3333رب', '', 0, 0),
(38, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60901690346767.96807948', '2021-05-04 20:00:00', '2021-05-05 00:00:00', 4, 16, '1234رب', '', 0, 0),
(39, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '6090524642bf47.46971443', '2021-05-04 21:00:00', '2021-05-04 23:00:00', 2, 8, '1234سبب', '', 0, 0),
(40, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '6090546019d8a2.76416908', '2021-05-04 21:00:00', '2021-05-04 23:00:00', 2, 8, '1234سبب', '', 0, 0),
(41, 'a.m_elkholy32@yahoo.com', 'cairo-ramsis-shop', '609055f8e5b663.54032028', '2021-05-05 21:00:00', '2021-05-05 23:00:00', 2, 8, '1234سبب', '', 0, 0),
(42, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60906dceb268b0.24018197', '2021-05-05 23:00:00', '2021-05-06 05:00:00', 6, 24, '1234سبب', '', 0, 0),
(43, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60907bc8ad4f69.72186531', '2021-05-07 00:00:00', '2021-05-07 06:00:00', 6, 24, '1234رب', '', 0, 0),
(44, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '6092fcb4393d45.94267636', '2021-05-06 15:00:00', '2021-05-06 21:00:00', 6, 24, '1234سبب', '', 0, 0),
(45, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '6092fdf277fe93.96086193', '2021-05-06 16:00:00', '2021-05-06 22:00:00', 6, 24, '1111رب', '', 0, 0),
(46, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '609b27aaef56f1.06277940', '2021-05-12 18:00:00', '2021-05-13 00:00:00', 6, 24, '1234سبب', '', 0, 0),
(56, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '609d4fe5983b28.73273743', '2021-05-13 19:00:00', '2021-05-14 01:00:00', 6, 24, '1234رب', '', 0, 0),
(59, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60a8bbdd7142a8.03750162', '2021-05-22 10:00:00', '2021-05-22 17:00:00', 6, 24, '1234رب', '', 0, 0),
(60, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60ade1d2bff3a0.43360745', '2021-05-26 08:00:00', '2021-05-26 15:00:00', 6, 24, '1234رب', '', 0, 0),
(61, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60c2ae17056db8.49242219', '2021-06-11 02:00:00', '2021-06-11 09:00:00', 6, 24, '123رب', 'closed', 0, 0),
(62, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60c3c12d4044a2.14751374', '2021-06-11 22:00:00', '2021-06-12 05:00:00', 6, 24, '1234رب', 'open', 0, 0),
(63, 'a.m_elkholy32@yahoo.com', 'cairo-ramsis-shop', '60c3fed699dbd7.29840540', '2021-06-12 02:00:00', '2021-06-12 09:00:00', 6, 24, '1234رب', 'open', 0, 0),
(64, 'ahmedelkholy89@gmail.com', 'alexandria-montaza-shop-a', '60d37d2a206a33.81463199', '2021-06-23 20:00:00', '2021-06-24 03:00:00', 6, 24, '1234رب', 'open', 0, 0),
(65, 'a.m_elkholy32@yahoo.com', 'cairo-ramsis-shop', '60d383a00b1b62.15172726', '2021-06-23 21:00:00', '2021-06-24 04:00:00', 6, 24, '1234رب', 'open', 0, 0),
(66, '201600428@pua.edu.eg', 'cairo-ramsis-shop', '60d48b6ebe8349.07802854', '2021-06-25 03:00:00', '2021-06-25 05:00:00', 2, 8, '5798سجب', 'closed', 0, 0),
(67, '201600281@pua.edu.eg', 'cairo-ramsis-shop', '60d4e29d263f53.63068923', '2021-06-24 21:00:00', '2021-06-25 01:00:00', 2, 8, '1234رب', 'open', 0, 0),
(69, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60d8b516c55955.75083449', '2021-06-27 20:00:00', '2021-06-27 22:00:00', 2, 8, '1234رب', 'open', 0, 0),
(70, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60e10ac68d7661.07781667', '2021-07-04 04:00:00', '2021-07-04 10:00:00', 6, 24, '1234رب', 'opened', 1, 0),
(74, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60e22edf433997.46389737', '2021-07-05 01:00:00', '2021-07-05 02:00:00', 1, 4, '5798سجب', 'closed', 0, 0),
(76, '201600428@pua.edu.eg', 'cairo-ramsis-shop', '60e233f5335112.37599364', '2021-07-05 01:00:00', '2021-07-05 02:00:00', 1, 4, '5798سجب', 'closed', 0, 0),
(77, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60e2ab2e891108.26992194', '2021-07-05 09:00:00', '2021-07-05 15:00:00', 6, 24, '1345مصر', 'opened', 1, 0),
(78, '201600428@pua.edu.eg', 'cairo-ramsis-shop', '60e2b1ffdf0a86.89615226', '2021-07-05 09:00:00', '2021-07-05 15:00:00', 6, 24, '5798سجب', 'closed', 0, 0),
(79, 'a.m_elkholy32@yahoo.com', 'cairo-ramsis-shop', '60e2b2d540bf35.50154559', '2021-07-05 09:00:00', '2021-07-05 15:00:00', 6, 24, '3456سجد', 'closed', 0, 0),
(80, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '60e2c2e4f381d9.16404729', '2021-07-05 11:00:00', '2021-07-05 17:00:00', 6, 24, '1345مصر', 'closed', 0, 0),
(81, 'a.m_elkholy32@yahoo.com', 'cairo-ramsis-shop', '60e2c3a606d687.87293936', '2021-07-05 12:00:00', '2021-07-05 18:00:00', 6, 24, '5798سجب', 'closed', 0, 0),
(82, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '611cc0907bedb2.52701586', '2021-08-18 10:00:00', '2021-08-18 16:00:00', 6, 24, '1345مصر', 'closed', 0, 0),
(83, 'ahmedelkholy89@gmail.com', 'cairo-ramsis-shop', '611ccd381ea452.93293323', '2021-08-18 12:00:00', '2021-08-18 18:00:00', 6, 24, '1234مصر', 'closed', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `shopname` varchar(255) NOT NULL,
  `shopname_ar` varchar(255) NOT NULL,
  `seat` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `shopname`, `shopname_ar`, `seat`) VALUES
(3, 'alexandria-montaza-shop-a', 'الإسكندرية-المنتزة -المحل-أ', 580),
(4, 'alexandria-montaza-shop-b', 'الإسكندرية-المنتزة-المحل-ب', 320),
(1, 'alexandria-smouha-shop-a', 'الإسكندرية-سموحة-المحل-أ', 200),
(2, 'alexandria-smouha-shop-b', 'الإسكندرية-سموحة-المحل-ب', 1000),
(5, 'cairo-ramsis-shop', 'القاهرة-رمسيس-محل', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `money` int(11) NOT NULL DEFAULT 10,
  `ai` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `gender`, `birthday`, `phone`, `password`, `money`, `ai`) VALUES
(14, '201600281@pua.edu.eg', 'Ahmed Elkholy', 'male', '1997-10-22', '01008983638', '$2y$10$0E1VHRKGb4DaySvRLaxi9O9kZdNyaIPiWf5Fv4f4Ric0.YgxnPWXa', 2, 1),
(10, '201600428@pua.edu.eg', 'Mohahmed Ahmed', 'male', '2021-04-13', '01555476721', '$2y$10$e4MXWWae9oS0BvkAAqaTNuVaVZpuUgE54FdznjBq/dYUD3Yr3uXHW', 1970, 1),
(1, 'a.m_elkholy32@yahoo.com', 'Ahmed Elkholy', 'male', '1997-10-22', '01128278235', '$2y$10$PeB8Ndf9y4jzdQTrXiJSkOwrKz20/tA.9zaM66.h7lmH/C/MbvOhy', 6, 1),
(2, 'ahmedelkholy89@gmail.com', 'Ahmed Elkholy', 'male', '2021-04-14', '01024238373', '$2y$10$wNL59HPzgLz0qKHeILsEcO25f3d5Ru5E2tB3fnAO9m8/mSJzIm5wi', 1553, 1),
(11, 'modyahmed199827@gmail.com', 'Mohamed Shamma', 'male', '1998-07-09', '01555746721', '$2y$10$gREur6FYpUgKZaDXVecXbeaZkqP/pLPqu2Rq1wLvseXxhjyhDtM6O', 10, 0),
(13, 'mohamedshama206@gmail.com', 'Mohamed Shama', 'male', '1998-07-09', '01223801062', '$2y$10$Y96SaGu7QLU.wjXxV2GD/On6WNb6F4puSLs5bORFil9zE4A94IU6u', 10, 0),
(12, 'mohamedshamma1998@gmail.com', 'Mohamed Shamma', 'male', '1998-07-09', '01222979715', '$2y$10$cMOCK5RFgZBfcBFj0u8x1ulTXASVOVkDgbu/rMz3deCmoG429nLKi', 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`number`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `const_user` (`user`),
  ADD KEY `const_shop` (`shop`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shopname`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `shopname_ar` (`shopname_ar`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `const_shop` FOREIGN KEY (`shop`) REFERENCES `shops` (`shopname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `const_user` FOREIGN KEY (`user`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
