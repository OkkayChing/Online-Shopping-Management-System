-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2014 at 05:51 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `megashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_log_date` date NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `last_log_date`, `first_name`, `last_name`) VALUES
(1, 'mizan', 'mizan', '2012-12-25', 'mizan', 'zihan');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `adding_date` date NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `Quantity`, `price`, `adding_date`) VALUES
(1, 1, '19', 1, '30', '2013-04-25'),
(3, 1, '21', 1, '10', '2013-04-26'),
(4, 2, '16', 1, '25', '2014-07-22'),
(5, 2, '17', 1, '22', '2014-07-22'),
(6, 2, '51', 1, '18', '2014-07-22'),
(7, 2, '26', 1, '450', '2014-07-22'),
(8, 1, '16', 1, '25', '2014-10-26'),
(9, 3, '16', 1, '25', '2014-12-05'),
(11, 3, '16', 1, '25', '2014-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Category_id` int(11) NOT NULL AUTO_INCREMENT,
  `Category_name` varchar(255) NOT NULL,
  `Category_desc` text NOT NULL,
  PRIMARY KEY (`Category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_name`, `Category_desc`) VALUES
(1, 'Apparel', 'Various apparel with modern design and better price. We provide latest model t-shirts, Shirts, Jeans made apparel, Cotton made apparel available from various well known fashion houses in our store.'),
(2, 'Electronics', 'Top manufacturers electronics products are ready to sell. we have product based discount offer and attractive gifts in various occasion. Stay with us for latest technological release and news.\r\n'),
(3, 'Books', 'World''s famous writers creation now is in your hand. Besides famous novels from Bangladeshi top writers also available here. We also provide regular home delivery of several magazines and journals.'),
(4, 'Food', 'Taste the world. We are ready to deliver you what you wish for eat. Home delivery is available for most of the city. We have also food court some of the big cities.');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_name` (`product_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `details`, `category`, `subcategory`, `date_added`) VALUES
(15, 'Blue coloured Shirt', '35', 'Color: Blue\r\n100% cotton', 'Apparel', '1.1', '2012-12-31'),
(16, 'T-shirt', '25', 'Color: Deep blue', 'Apparel', '1.1', '2012-12-28'),
(17, 'WiFI Shirt', '22', 'Color:Deep \r\nDesign: WiFi network', 'Apparel', '1.1', '2012-12-28'),
(18, 'Jeans Jacket', '45', 'Color: Sea Blue \r\nType: Jeans \r\n', 'Apparel', '1.1', '2012-12-28'),
(19, 'Jeans Pant', '30', 'Type: Full \r\nThree size available', 'Apparel', '1.2', '2012-12-31'),
(20, 'Mobile Pant', '30', 'Color: Fade \r\nType: Multi-pocket system\r\n', 'Apparel', '1.2', '2012-12-28'),
(21, 'Cap', '10', 'Color: White with Red lining\r\n', 'Apparel', '1.3', '2012-12-28'),
(22, 'Orange Cap', '12', 'Color: Mixed', 'Apparel', '1.3', '2012-12-31'),
(23, 'Grey Cap', '12', 'Color: Grey', 'Apparel', '1.3', '2012-12-28'),
(24, 'Winter Cap', '10', 'Type: Specially made for winter season', 'Apparel', '1.3', '2012-12-28'),
(25, 'Smart Cap', '15', 'Color: Ash', 'Apparel', '1.3', '2012-12-28'),
(26, 'Acer - Laptop', '450', 'Color available: Black, Silver, Grey', 'Electronics', '2.1', '2012-12-28'),
(27, 'HP pavilion', '500', 'Color available: Black, Silver, Grey', 'Electronics', '2.1', '2012-12-31'),
(28, 'HP - Silver', '480', 'Color available: Silver', 'Electronics', '2.1', '2012-12-28'),
(29, 'HP Dressing Room', '490', 'Color available: Black, Silver, Grey', 'Electronics', '2.1', '2012-12-28'),
(31, 'Dell - One Piece', '500', 'Color available: Black, Silver', 'Electronics', '2.1', '2012-12-28'),
(32, 'RAM - DDR2', '30', '3 years warrenty', 'Electronics', '2.2', '2012-12-28'),
(33, 'RAM - DDR3', '20', '3 Years warrenty', 'Electronics', '2.2', '2012-12-31'),
(34, 'Blue headphone', '50', 'Type: dasasd', 'Electronics', '2.2', '2012-12-28'),
(35, 'Purple headphone', '45', '2 Year Guaranteeing ', 'Electronics', '2.2', '2012-12-28'),
(36, 'headphone', '420', 'Just Simple', 'Electronics', '2.2', '2012-12-31'),
(37, '7up', '2', 'Home Delivery available for buying 10items', 'Food', '4.1', '2012-12-28'),
(38, 'Coca-Cola', '3', 'Home delivery is not available', 'Food', '4.1', '2012-12-28'),
(39, 'Pizza', '20', 'Home delivery available. Extra charge required.', 'Food', '4.2', '2012-12-31'),
(40, 'French Fries', '15', 'Home delivery available. Extra charge required.', 'Food', '4.2', '2012-12-28'),
(41, 'Doler nam black dragon by md. jafor iqbal', '15', 'Adventure, thriller', 'Books', '3.1', '2013-04-17'),
(42, '2030 saler ekdin o onnanno by md. jafor iqbal', '16', 'Vision, article', 'Books', '3.1', '2013-02-14'),
(43, 'dese bidese by syed mujtaba ali', '20', 'Adventure', 'Books', '3.1', '2012-04-12'),
(44, 'chacha kahini', '14', 'Adventure, Fun', 'Books', '3.1', '2013-04-25'),
(45, 'Robot Vision by Isaac Asimov', '20', 'Science fiction', 'Books', '3.2', '2013-04-30'),
(46, 'sonkusomogro by satyajit roy', '19', 'Science fiction, adventure', 'Books', '3.2', '2013-04-27'),
(47, 'parapaer by humayun ahmed', '16', 'Novel', 'Books', '3.1', '2013-01-09'),
(48, 'Feluda somogro by satyajit roy', '25', 'Adventure, thriller', 'Books', '3.1', '2013-02-28'),
(49, 'Himur nil josna by humayun ahmed', '20', 'Novel', 'Books', '3.1', '2013-02-20'),
(50, 'fera humayun ahmed', '16', 'Novel', 'Books', '3.1', '2013-03-12'),
(51, 'Jutassic park by michael crichton', '18', 'Adventure, Science Fiction', 'Books', '3.2', '2013-04-18'),
(52, 'War of the world by H. G. Wells', '19', 'Science Fiction, adventure', 'Books', '3.2', '2013-04-20'),
(53, 'Octopuser chokh by md. jafor iqbal', '16', 'Science Fiction', 'Books', '3.2', '2013-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `saubcategory`
--

CREATE TABLE IF NOT EXISTS `saubcategory` (
  `category_id` int(11) NOT NULL,
  `subcategory_id` varchar(255) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_desc` text NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saubcategory`
--

INSERT INTO `saubcategory` (`category_id`, `subcategory_id`, `subcategory_name`, `subcategory_desc`) VALUES
(1, '1.1', 'Shirts', 'Some description'),
(1, '1.2', 'Pants', 'Some description'),
(1, '1.3', 'Hats', 'Some description'),
(2, '2.1', 'Computer', 'Some description'),
(2, '2.2', 'Accessories', 'Some description'),
(3, '3.1', 'Novel', 'Some description'),
(3, '3.2', 'Science Fiction', 'Some description'),
(4, '4.1', 'Drinks', 'Some description'),
(4, '4.2', 'Other Foods', 'Some description');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `address`, `province`, `country`, `phone_number`, `zip_code`) VALUES
(1, 'Nabil', 'Ahmad', 'nabil24', 'nabil', 'nabil@nstu.com', 'Maijdee', 'Noakhali', 'Bangladesh', '01925624653', '3802'),
(3, 'uken', 'marma', 'uken45', 'uken45', 'greenasia445@gmail.com', 'awsrwqr', '56687587687', 'ban', '01824677445', '56465');
