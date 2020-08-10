-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2020 at 02:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `member_since` datetime NOT NULL DEFAULT current_timestamp(),
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`, `profile_pic`, `zipcode`, `country`, `state`, `member_since`, `address`) VALUES
(1, 'admin', 'admin', 'System', 'Admin', 'admin@gmail.com', '', '', '', '', '', '2020-02-21 02:30:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `id` int(11) NOT NULL,
  `post_category` varchar(100) DEFAULT NULL,
  `subcategory` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `announcement` text DEFAULT NULL,
  `dateposted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`id`, `post_category`, `subcategory`, `title`, `announcement`, `dateposted`) VALUES
(1, 'Season', 'Winter', 'Farming guide in winter season', '&lt;h2&gt;What is Lorem Ipsum?&lt;/h2&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Why do we use it?&lt;/h2&gt;\r\n\r\n&lt;p&gt;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &amp;#39;Content here, content here&amp;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &amp;#39;lorem ipsum&amp;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;h2&gt;Where does it come from?&lt;/h2&gt;\r\n\r\n&lt;p&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &amp;quot;de Finibus Bonorum et Malorum&amp;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &amp;quot;Lorem ipsum dolor sit amet..&amp;quot;, comes from a line in section 1.10.32.&lt;/p&gt;\r\n', '2020-06-22 09:41:30'),
(2, 'Farming Fruits', 'Mango', 'Farming guide for mango', '&lt;p&gt;The main mango growing regions are around Rajshahi, Chapainawabganj, Nawabganj, and Dinajpur.&lt;/p&gt;\r\n', '2020-06-22 09:44:41'),
(3, 'Farming Vegetables', 'Potatoe', 'Farming guide for Potatoe', '&lt;h2&gt;&lt;strong&gt;Soil and soil Preparation&lt;/strong&gt;&amp;nbsp;&lt;br /&gt;\r\nSandy loam soil is&lt;img alt=&quot;&quot; src=&quot;https://www.google.com/url?sa=i&amp;amp;url=https%3A%2F%2Fwww.walmart.ca%2Fen%2Fip%2Fpotato-russet%2F6000194575285&amp;amp;psig=AOvVaw0OES6S-kjRcdwT1Y_fXIee&amp;amp;ust=1594299266104000&amp;amp;source=images&amp;amp;cd=vfe&amp;amp;ved=0CAIQjRxqFwoTCODtnd3ZveoCFQAAAAAdAAAAABAD&quot; /&gt; suitable for cultivating potato. The land should be prepared by deep and furious cultivation.&lt;br /&gt;\r\n&lt;strong&gt;Time of sowing of potatoes and rate of seed Sowing time&lt;/strong&gt;&lt;br /&gt;\r\nThe first week of November for the northern part of the country and the last week from mid-November to mid-November is the ideal time for planting potatoes.&lt;br /&gt;\r\n&lt;strong&gt;Seed rate&lt;/strong&gt;&lt;br /&gt;\r\nThe quantity of seeds per hectare is 1.5 tonnes. The planting distance is 3 cm (as-potato) and 3 cm (cut potato).&lt;br /&gt;\r\n&lt;strong&gt;The name of the fertilizer and Amount &amp;nbsp;(Kg / ha)&lt;/strong&gt;&lt;br /&gt;\r\nDung (8000-10000), Urea (220-250), TSP (120-150), MP (220-250), Gypsum (100-120).&lt;br /&gt;\r\n&lt;strong&gt;Disease&lt;/strong&gt;&lt;br /&gt;\r\nLate blight: The disease is organized by a fungus called Phytophthora infestense. First, small wet spots appear on the leaves, tip and bud. It seems the crop of the land has burned down.&lt;br /&gt;\r\n&lt;strong&gt;Remedy&lt;/strong&gt;&lt;br /&gt;\r\nshould be used to Disease free seeds.&lt;br /&gt;\r\nInfected irrigation and urea fertilizer application should be stopped.&lt;br /&gt;\r\nAs soon as the disease develops, Ridomil or Diethane M-45 should be mixed with 2 grams per liter of water and spray after at a rate of 8-12 days&lt;br /&gt;\r\n&amp;nbsp;&lt;/h2&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;Beautiful Natural Flower Stock Photos, Images &amp;amp; Photography ...&quot; src=&quot;https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ45Az7g_ZaHorWn72vna7YopGR8TCEAHHxWg&amp;amp;usqp=CAU&quot; /&gt;&lt;/p&gt;\r\n', '2020-07-04 20:05:20'),
(4, 'Farming Vegetables', 'lorem ipsum', 'LoremIpsum', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', '2020-07-12 19:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_no` varchar(200) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `product_id` int(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `seller_id` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `priceperkg` int(100) NOT NULL,
  `totalprice` int(100) NOT NULL,
  `buyer_id` int(100) NOT NULL,
  `card` varchar(100) DEFAULT NULL,
  `name_on_card` varchar(200) DEFAULT NULL,
  `card_no` bigint(200) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `notify` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_no`, `order_date`, `product_id`, `product`, `seller_id`, `qty`, `priceperkg`, `totalprice`, `buyer_id`, `card`, `name_on_card`, `card_no`, `exp_date`, `cvv`, `status`, `notify`) VALUES
(1, '2866964385', '2020-06-21 11:51:16', 1, 'potato', 2, 5, 100, 500, 3, 'debit', 'sonali', 11111111111111, '0000-00-00', 458, 3, 1),
(2, '2974541944', '2020-06-22 10:37:32', 8, 'potato', 2, 5, 20, 100, 3, 'debit', 'Islami', 1111111111, '0000-00-00', 652, 2, 1),
(3, '342920262', '2020-06-28 12:15:40', 2, 'Mango', 2, 1, 50, 50, 3, 'credit', 'Islami', 1254666324, '0000-00-00', 5698, 2, 1),
(4, '1329933546', '2020-07-01 09:24:03', 2, 'Mango', 2, 2, 50, 100, 3, 'debit', 'Islami', 145566662225555, '0000-00-00', 54566, 1, 1),
(5, '3183451315', '2020-07-01 09:47:53', 3, 'Rice', 2, 1, 20, 20, 3, 'debit', 'sonali', 1254585663255, '0000-00-00', 4586, 1, 0),
(6, '1420275470', '2020-07-02 10:20:02', 3, 'Rice', 2, 2, 20, 40, 3, 'debit', 'Islami', 145226366566, '0000-00-00', 44555, 1, 1),
(7, '1354374684', '2020-07-04 20:38:44', 1, 'potato', 2, 1, 100, 100, 3, 'debit', 'Islami', 1245895621478, '0000-00-00', 1452, 1, 1),
(8, '184478447', '2020-07-07 21:33:19', 1, 'potato', 2, 1, 100, 100, 3, 'credit', 'Islami', 4852036585445625, '0000-00-00', 5662, 1, 0),
(9, '94596161', '2020-07-12 19:56:11', 1, 'potato', 2, 2, 100, 200, 3, 'credit', 'Abu Shama', 14235436242, '0000-00-00', 321, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_posted` datetime NOT NULL DEFAULT current_timestamp(),
  `post_title` varchar(200) DEFAULT NULL,
  `post_name` varchar(200) DEFAULT NULL,
  `post_category` varchar(200) DEFAULT NULL,
  `post_amount` int(200) NOT NULL DEFAULT 0,
  `post_price` int(200) NOT NULL DEFAULT 0,
  `post_phone` varchar(200) DEFAULT NULL,
  `post_description` text DEFAULT NULL,
  `post_photo` varchar(200) DEFAULT NULL,
  `post_address` varchar(250) DEFAULT NULL,
  `post_zip` int(200) DEFAULT NULL,
  `post_city` varchar(200) DEFAULT NULL,
  `post_country` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `time_posted`, `post_title`, `post_name`, `post_category`, `post_amount`, `post_price`, `post_phone`, `post_description`, `post_photo`, `post_address`, `post_zip`, `post_city`, `post_country`) VALUES
(1, 2, '2020-06-20 10:05:44', 'Sell for potato', 'potato', 'Vegetables', 98, 100, '+8801744311146', 'All product Are good.', 'potato.jpg', 'lalpur', 6418, 'Natore', 'Bangladesh'),
(2, 2, '2020-06-20 10:07:59', 'Sell for Mango', 'Mango', 'Fruits', 200, 50, '+8801744311146', 'All products are good.', 'mango-picture.jpg', 'lalpur', 6418, 'Natore', 'Bangladesh'),
(3, 2, '2020-06-20 10:15:51', 'Sell for rice', 'Rice', 'Grains', 500, 20, '+8801744311146', 'All products are good.', 'Rice.jpg', 'lalpur', 6418, 'Natore', 'Bangladesh'),
(4, 2, '2020-06-20 10:18:54', 'Sell for onion', 'Onion', 'Others', 150, 30, '+8801744311146', 'All products are good.', 'onion-.jpg', 'lalpur', 6418, 'Natore', 'Bangladesh'),
(9, 2, '2020-07-02 10:45:01', 'Chili', 'Chili', 'Vegetables', 10, 10, '125457795478', 'product are good ', 'green-chilli.jpg', 'unigarden', 93000, 'kuching', 'Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `member_since` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `phone`, `role`, `address`, `zipcode`, `country`, `state`, `profile_pic`, `member_since`) VALUES
(2, 'abushamaomi@gmail.com', 'abu', 'mr', 'abu', '+8801744311146', 1, 'lalpur', 6418, 'Bangladesh', 'Rajshahi', NULL, '2020-06-20 09:59:58'),
(3, 'shama01112608407@gmail.com', 'shama', 'Mrr', 'shama', '8801725364585', 2, 'lalpur', 6418, 'Bangladesh', 'Rajshahi', 'car.jpg', '2020-06-20 10:00:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guide`
--
ALTER TABLE `guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
