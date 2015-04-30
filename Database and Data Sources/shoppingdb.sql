-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2015 at 01:06 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shoppingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminId` varchar(12) NOT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `passWord` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `passWord`) VALUES
('ad', 'ad', 'ad', '523af537946b79c4f8369ed39ba78605'),
('admin', 'Super', 'Administrator', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`custNbr` int(10) unsigned NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `dateJoined` date NOT NULL,
  `address1` varchar(45) NOT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `suburb` varchar(45) NOT NULL,
  `state` enum('ACT','NSW','NT','QLD','SA','TAS','VIC','WA') NOT NULL,
  `postCode` int(10) unsigned NOT NULL,
  `passWord` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custNbr`, `email`, `firstName`, `lastName`, `dateJoined`, `address1`, `address2`, `suburb`, `state`, `postCode`, `passWord`) VALUES
(9, 'test@test1.com', 'yousef', 'alharbi', '2014-12-04', '1', '1', '2', 'VIC', 3000, 'c4ca4238a0b923820dcc509a6f75849b'),
(10, 'fff@fff.com', 'fff', 'fff', '2015-01-30', '10 street', '', 'Preston', 'VIC', 3000, '8fa14cdd754f91cc6554c9e71929cce7');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `deliveryState` enum('ACT','NSW','NT','QLD','SA','TAS','VIC','WA') NOT NULL,
  `deliveryRate` decimal(10,2) unsigned NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deliveryState`, `deliveryRate`) VALUES
('ACT', '6.00'),
('NSW', '5.50'),
('NT', '9.50'),
('QLD', '5.50'),
('SA', '15.50'),
('TAS', '8.50'),
('VIC', '5.50'),
('WA', '7.50');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `itemCode` varchar(10) NOT NULL,
  `itemName` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` enum('FICTION','SCIENCE','HEALTH','HISTORY','COMICS') NOT NULL,
  `qtyOnHand` int(11) NOT NULL DEFAULT '0',
  `unitPrice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `photo1` varchar(50) NOT NULL,
  `photo2` varchar(50) DEFAULT NULL,
  `photo3` varchar(50) DEFAULT NULL,
  `thumbNail` varchar(50) NOT NULL,
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemCode`, `itemName`, `description`, `category`, `qtyOnHand`, `unitPrice`, `photo1`, `photo2`, `photo3`, `thumbNail`, `featured`) VALUES
('A001', 'Nineteen Eighty-Four', '''Who controls the past controls the future: who controls the present controls the past'' Hidden away in the Record Department of the sprawling Ministry of Truth, Winston Smith skilfully rewrites the past to suit the needs of the Party.', 'FICTION', 200, '27.50', 'book1.jpg', 'book6.jpg', 'book5.jpg', 'book1Thumb.jpg', 1),
('A002', 'Dune', 'Dune tells the story of young Paul Atreides, the heir apparent to Duke Leto Atreides as his family accepts control of the desert planet Arrakis, the only source of the ''spice'' melange.', 'FICTION', 250, '30.20', 'book2.jpg', NULL, NULL, 'book2Thumb.jpg', 1),
('A003', 'Harry Potter and the Deat', 'Harry Potter and the Deathly Hallows is the seventh and final of the Harry Potter novels. The novel chronicles the events directly following Harry Potter and the Half-Blood Prince (2005), and the final confrontation between the wizards Harry Potter and Lo', 'FICTION', 100, '20.00', 'book3.jpg', NULL, NULL, 'book3Thumb.jpg', 0),
('A004', 'A Tale of Two Cities', 'A Tale of Two Cities is a novel by Charles Dickens, set in London and Paris before and during the French Revolution.', 'FICTION', 229, '26.00', 'book4.jpg', NULL, NULL, 'book4Thumb.jpg', 0),
('A005', 'A Brief History of Time', 'A Brief History of Time attempts to explain a range of subjects in cosmology, including the Big Bang, black holes and light cones, to the nonspecialist reader.', 'SCIENCE', 89, '26.00', 'book5.jpg', NULL, NULL, 'book5Thumb.jpg', 0),
('A006', 'The Selfish Gene', 'The Selfish Gene is a book on evolution by Richard Dawkins, published in 1976. It builds upon the principal theory of George C. Williams''s first book Adaptation and Natural Selection.', 'SCIENCE', 98, '20.00', 'book6.jpg', NULL, NULL, 'book6Thumb.jpg', 0),
('A007', 'The World Without Us', 'The World Without Us is a non-fiction book about what would happen to the natural and built environment if humans suddenly disappeared, written by American journalist Alan Weisman.', 'SCIENCE', 105, '23.00', 'book7.jpg', NULL, NULL, 'book7Thumb.jpg', 0),
('A008', 'The Blind Watchmaker', 'The Blind Watchmaker: Why the Evidence of Evolution Reveals a Universe without Design is a 1986 book by Richard Dawkins in which he presents an explanation of, and argument for, the theory of evolution by means of natural selection.', 'SCIENCE', 125, '39.00', 'book8.jpg', NULL, NULL, 'book8Thumb.jpg', 0),
('A009', 'Ontogeny and Phylogeny', 'Ontogeny and Phylogeny explores the relationship between embryonic development (ontogeny) and biological evolution (phylogeny)', 'SCIENCE', 134, '18.00', 'book9.jpg', NULL, NULL, 'book9Thumb.jpg', 0),
('A010', 'The Magic of Reality', 'How We Know What''s Really True is a 2011 book by British biologist Richard Dawkins, with illustrations by Dave McKean.', 'SCIENCE', 118, '23.00', 'book10.jpg', NULL, NULL, 'book10Thumb.jpg', 0),
('A011', 'Perfect Health', 'A decade ago, Deepak Chopra, M.D., wrote Perfect Health, the first practical guide to harnessing the healing power of the mind, which became a national bestseller.', 'HEALTH', 53, '45.00', 'book11.jpg', NULL, NULL, 'book11Thumb.jpg', 0),
('A012', 'Healing Yourself! 23 Ways', 'This is a book for individuals with an earnest desire to alter their health and to become a positive active healing force in their own or another''s life.', 'HEALTH', 20, '15.00', 'book12.jpg', NULL, NULL, 'book12Thumb.jpg', 1),
('A013', 'Lies My Teacher Told Me', 'Lies My Teacher Told Me: Everything Your American History Textbook Got Wrong is a 1995 book by sociologist James Loewen.', 'HISTORY', 62, '45.00', 'book13.jpg', NULL, NULL, 'book13Thumb.jpg', 0),
('A014', 'OUR SUNBURNT COUNTRY', 'Our Sunburnt Country: An illustrated history of Australia tells the story of Australia''s heritage, from Aboriginal settlement until the present.', 'HISTORY', 500, '24.99', 'book14.jpg', NULL, NULL, 'book14Thumb.jpg', 0),
('A015', 'Australian Legends', 'This book, covers the development of the Australian Quarter Horse history, which began a relatively short time ago with the 1954 arrival of the first four King Ranch stallions â€“ Vaquero, Jackaroo, Gold Standard and Mescal.', 'HISTORY', 40, '10.99', 'book15.jpg', NULL, NULL, 'book15Thumb.jpg', 0),
('A016', 'The Walking Dead', 'Popularized by the hit AMC television show, the series follows a band of survivors struggling to live from one day to the next amidst a zombie apocalypse.', 'COMICS', 500, '15.50', 'book16.jpg', NULL, NULL, 'book16Thumb.jpg', 0),
('A017', 'Batman', 'Revitalized in 2011 through DC comicâ€™s â€œNew 52? initiative, Bruce Wayne is back in black, ever vigilant for crimes on Gothamâ€™s streets.', 'COMICS', 400, '15.50', 'book17.jpg', NULL, NULL, 'book17Thumb.jpg', 0),
('A018', 'Saga', 'Borrowing elements from both science-fiction and fantasy, two star-crossed lovers escape across the galaxy amidst a war between worlds.', 'COMICS', 200, '15.50', 'book18.jpg', NULL, NULL, 'book18Thumb.jpg', 0),
('A019', 'Justice League of America', 'Starring DCâ€™s entire cast of heroes and villains, the series serves as a link between all of DCâ€™s other printed issues in exploring the dynamics between its characters.', 'COMICS', 200, '18.50', 'book19.jpg', NULL, NULL, 'book19Thumb.jpg', 0),
('A020', 'The Superior Spider-Man', 'After Peter Parkerâ€™s death in â€œThe Amazing Spider-Manâ€s 700th issue, Marvel brought a new Spider-Man into the fray to carry on the web-slinging legacy.', 'COMICS', 800, '24.99', 'book20.jpg', NULL, NULL, 'book20Thumb.jpg', 0),
('NEWBOOK', 'New Book', 'Item Description', 'FICTION', 5, '50.00', 'apache_pb2.png', NULL, NULL, 'testThumbNail', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordereditem`
--

CREATE TABLE IF NOT EXISTS `ordereditem` (
  `orderNbr` int(10) unsigned NOT NULL,
  `itemCode` varchar(10) NOT NULL,
  `qtyOrdered` int(10) unsigned NOT NULL,
  `sellingPrice` decimal(10,2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordereditem`
--

INSERT INTO `ordereditem` (`orderNbr`, `itemCode`, `qtyOrdered`, `sellingPrice`) VALUES
(5, 'A001', 2, '27.50'),
(5, 'A005', 1, '26.00'),
(6, 'A001', 2, '27.50'),
(6, 'A008', 1, '39.00'),
(7, 'A001', 1, '27.50'),
(7, 'A011', 1, '45.00'),
(8, 'A001', 1, '27.50'),
(9, 'A001', 1, '27.50'),
(10, 'A007', 1, '23.00'),
(11, 'A003', 2, '20.00'),
(11, 'A008', 1, '39.00'),
(12, 'A014', 1, '24.99'),
(13, 'A001', 1, '27.50'),
(13, 'A003', 2, '20.00'),
(14, 'A001', 1, '27.50'),
(15, 'A005', 1, '26.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`orderNbr` int(10) unsigned NOT NULL,
  `custNbr` int(10) unsigned NOT NULL,
  `orderDate` date NOT NULL,
  `dispatchDate` date DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `orderNetValue` decimal(10,2) unsigned NOT NULL,
  `deliverTo` varchar(60) NOT NULL,
  `deliveryAddress1` varchar(45) NOT NULL,
  `deliveryAddress2` varchar(45) DEFAULT NULL,
  `deliverySuburb` varchar(45) NOT NULL,
  `deliveryState` enum('ACT','NSW','NT','QLD','SA','TAS','VIC','WA') NOT NULL,
  `deliveryPostCode` int(10) unsigned NOT NULL,
  `deliveryInstructions` varchar(255) DEFAULT NULL,
  `deliveryValue` decimal(10,2) unsigned NOT NULL,
  `paymentType` enum('VC','MC','BP','PP','AE','DC') NOT NULL,
  `paymentRef` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderNbr`, `custNbr`, `orderDate`, `dispatchDate`, `deliveryDate`, `orderNetValue`, `deliverTo`, `deliveryAddress1`, `deliveryAddress2`, `deliverySuburb`, `deliveryState`, `deliveryPostCode`, `deliveryInstructions`, `deliveryValue`, `paymentType`, `paymentRef`) VALUES
(7, 9, '2014-12-04', '2014-12-04', '2014-12-06', '72.50', 'yousef ', '1', '1', '2', 'ACT', 3000, '', '6.00', 'MC', 'yiWluuYJmWBCmxNBez0M'),
(8, 9, '2014-12-04', '2014-12-04', '2014-12-06', '27.50', 'yousef ', '1', '1', '2', 'ACT', 3000, '', '6.00', 'VC', 'L4zCZDUMryE1kDLUpeIz'),
(9, 9, '2015-01-19', '2015-01-19', '2015-01-21', '27.50', 'yousef ', '1', '1', '2', 'ACT', 3000, '', '6.00', 'MC', 'MGF8SCnJMK0s6OULV0VE'),
(10, 9, '2015-01-28', '2015-01-28', '2015-01-30', '23.00', 'yousef ', '1', '1', '2', 'ACT', 3000, '', '6.00', 'MC', 'aGvQEpqvJujGv90nz6P1'),
(11, 9, '2015-01-28', '2015-01-28', '2015-01-30', '79.00', 'yousef ', '1', '1', '2', 'ACT', 3000, '', '6.00', 'MC', 'bIBSHC6TmkNQ9sp3w6ao'),
(12, 9, '2015-01-28', '2015-01-28', '2015-01-30', '24.99', 'yousef ', '1', '1', '2', 'ACT', 3000, 's', '6.00', 'VC', 'sPMbqLshouW0P5rfG9Fj'),
(13, 9, '2015-01-28', '2015-01-28', '2015-01-30', '67.50', 'yousef ', '1', '1', '2', 'ACT', 3000, '', '6.00', 'MC', 'TXkFnHLgSVDl6ZoYiJ2M'),
(14, 9, '2015-01-28', '2015-01-28', '2015-01-30', '27.50', 'yousef ', '1', '1', '2', 'ACT', 3000, '', '6.00', 'MC', 'F9ZsjCXekbDhL4Szf00z'),
(15, 10, '2015-01-30', '2015-01-30', '2015-02-01', '26.00', 'faisal  ', '10 street', '', 'Preston', 'ACT', 3000, 'Please delivery during the day.', '6.00', 'MC', 'pabfuf3rfTK7jQAMLjpm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`custNbr`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
 ADD PRIMARY KEY (`deliveryState`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`itemCode`);

--
-- Indexes for table `ordereditem`
--
ALTER TABLE `ordereditem`
 ADD PRIMARY KEY (`orderNbr`,`itemCode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`orderNbr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `custNbr` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `orderNbr` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
