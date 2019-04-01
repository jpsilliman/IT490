-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2019 at 08:05 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IT490DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `URL` text NOT NULL,
  `Likes` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Lists`
--

CREATE TABLE `Lists` (
  `UserName` varchar(32) NOT NULL,
  `List` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lists`
--

INSERT INTO `Lists` (`UserName`, `List`) VALUES
('1', NULL),
('2', NULL),
('22', NULL),
('222', NULL),
('27', NULL),
('4952', NULL),
('72', NULL),
('chris', NULL),
('epic', NULL),
('evan', NULL),
('gary', NULL),
('german', NULL),
('hablo', NULL),
('hats', NULL),
('hi', NULL),
('jolly', NULL),
('marty', NULL),
('nj', NULL),
('paul', NULL),
('pete', NULL),
('portia', NULL),
('random', NULL),
('rich', NULL),
('Royals', NULL),
('st', NULL),
('sweat', NULL),
('tj', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `firstName` varchar(32) DEFAULT NULL,
  `LastName` varchar(32) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `UserName` varchar(32) NOT NULL,
  `Password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`firstName`, `LastName`, `EMAIL`, `UserName`, `Password`) VALUES
('1', '1', '1@101.11', '1', '1'),
('2', '2', '2@2.2', '2', '2'),
('2', '2', '2@2.22', '22', '22'),
('2', '2', '2@2.222', '222', '2'),
('2', '2', '22@2.22', '27', '27'),
('49', '52', '49@52.lol', '4952', 'lol'),
('72', 'tree', '72@TREE.net', '72', 'tree'),
('Chris', 'Monty', 'chris@monty.com', 'chris', 'montry'),
('epic', 'fail', 'fail@epic.net', 'epic', 'fail'),
('evan', 'boy', 'evan@boy.com', 'evan', 'boy'),
('Gary', 'Snail', 'gary@sponge.hom', 'gary', 'meow'),
('German', 'French', 'german@french.us', 'german', 'french'),
('Hablo', 'Pablo', 'ha@blo.com', 'hablo', 'pablo'),
('hatted', 'men', 'hats@hatsmen.men', 'hats', 'stah'),
('hi', 'hy', 'h@y.i', 'hi', 'hi'),
('Jolly', 'Green Giant', 'jollygreengiant@peas.net', 'jolly', 'jolly'),
('Marty', 'Fish', 'martyfish@fishman.com', 'marty', 'fish'),
('NJ', 'IT', 'polytechnicalinstitute@college.edu', 'nj', 'it'),
('Paul', 'Tran', 'paul@dan.tran', 'paul', 'tran'),
('pete', 'pete', 'pete@pete.me', 'pete', 'pete'),
('Portia', 'Shaheed', 'portia@rha.com', 'portia', 'porsche'),
('random', '.net', 'reallylongemailthatwonthaveaduplicate@random.net', 'random', 'net'),
('Richard', 'Matthew', 'richard@matthew.com', 'rich', 'matt'),
('KC', 'Royals', 'roy@als.kc', 'Royals', 'Royals'),
('me', 'you', 'stupid@email', 'st', 'st'),
('Sweat', 'Sweat', 'swe@ty.com', 'sweat', 'sweat'),
('tj', 'wagner', 'imsofedupwiththisshit@donewith.it', 'tj', 'wags');

-- --------------------------------------------------------

--
-- Table structure for table `Pantry`
--

CREATE TABLE `Pantry` (
  `UserName` varchar(64) NOT NULL,
  `Item` varchar(64) NOT NULL,
  `Amount` int(16) NOT NULL,
  `Unit` varchar(64) NOT NULL COMMENT 'ABSOLUTE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Pantry`
--

INSERT INTO `Pantry` (`UserName`, `Item`, `Amount`, `Unit`) VALUES
('hats', 'ss', 5, 's'),
('rich', 'bread', 2, 'loaves'),
('rich', 'oranges', 5, 'oranges'),
('rich', 'tuna', 16, 'cans'),
('rich', 'turkey', 20, 'lbs'),
('rich', 'vanilla extract', 4, 'oz');

-- --------------------------------------------------------

--
-- Table structure for table `Preferences`
--

CREATE TABLE `Preferences` (
  `UserName` varchar(32) NOT NULL COMMENT 'User Name linked by logins',
  `Balanced` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Protein/Fat/Carb values in 15/35/50 ratio',
  `High-Fiber` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'More than 5g fiber per serving',
  `High-Protein` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'More than 50% of total calories from proteins',
  `Low-Carb` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 20% of total calories from carbs',
  `Low-Fat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 15% of total calories from fat',
  `Low-Sodium` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 140mg Na per serving',
  `Alcohol-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No alcohol used or contained',
  `Celery-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain celery or derivatives',
  `Crustacean-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain crustaceans (shrimp, lobster etc.) or derivatives',
  `Dairy` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No dairy; no lactose',
  `Eggs` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No eggs or products containing eggs',
  `Fish` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No fish or fish derivatives',
  `Gluten` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No ingredients containing gluten',
  `Kidney-friendly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'per serving – phosphorus less than 250 mg AND potassium less than 500 mg AND sodium: less than 500 mg',
  `Kosher` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'contains only ingredients allowed by the kosher diet. However it does not guarantee kosher preparation of the ingredients themselves',
  `Low-potassium` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 150mg per serving',
  `Lupine-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain lupine or derivatives',
  `Mustard-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain mustard or derivatives',
  `No-oil-added` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No oil added except to what is contained in the basic ingredients',
  `No-sugar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '	No simple sugars – glucose, dextrose, galactose, fructose, sucrose, lactose, maltose',
  `Paleo` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Excludes what are perceived to be agricultural products; grains, legumes, dairy products, potatoes, refined salt, refined sugar, and processed oils',
  `Peanuts` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No peanuts or products containing peanuts',
  `Pescatarian` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Does not contain meat or meat based products, can contain dairy and fish',
  `Pork-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain pork or derivatives',
  `Red-meat-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain beef, lamb, pork, duck, goose, game, horse, and other types of red meat or products containing red meat.',
  `Sesame-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain sesame seed or derivatives',
  `Shellfish` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No shellfish or shellfish derivatives',
  `Soy` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No soy or products containing soy',
  `Sugar-conscious` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 4g of sugar per serving',
  `Tree Nuts` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No tree nuts or products containing tree nuts',
  `Vegan` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No meat, poultry, fish, dairy, eggs or honey',
  `Vegetarian` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No meat, poultry, or fish',
  `Wheat-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No wheat, can have gluten though'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Preferences`
--

INSERT INTO `Preferences` (`UserName`, `Balanced`, `High-Fiber`, `High-Protein`, `Low-Carb`, `Low-Fat`, `Low-Sodium`, `Alcohol-free`, `Celery-free`, `Crustacean-free`, `Dairy`, `Eggs`, `Fish`, `Gluten`, `Kidney-friendly`, `Kosher`, `Low-potassium`, `Lupine-free`, `Mustard-free`, `No-oil-added`, `No-sugar`, `Paleo`, `Peanuts`, `Pescatarian`, `Pork-free`, `Red-meat-free`, `Sesame-free`, `Shellfish`, `Soy`, `Sugar-conscious`, `Tree Nuts`, `Vegan`, `Vegetarian`, `Wheat-free`) VALUES
('1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('22', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('222', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('27', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('4952', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('72', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('chris', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('epic', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('evan', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('gary', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('german', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('hablo', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('hats', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('hi', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('jolly', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('marty', 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
('nj', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('paul', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('pete', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('portia', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('random', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('rich', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Royals', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('st', 1, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
('sweat', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('tj', 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Lists`
--
ALTER TABLE `Lists`
  ADD PRIMARY KEY (`UserName`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`UserName`);

--
-- Indexes for table `Pantry`
--
ALTER TABLE `Pantry`
  ADD PRIMARY KEY (`UserName`,`Item`);

--
-- Indexes for table `Preferences`
--
ALTER TABLE `Preferences`
  ADD PRIMARY KEY (`UserName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Lists`
--
ALTER TABLE `Lists`
  ADD CONSTRAINT `Lists_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `logins` (`UserName`) ON DELETE CASCADE;

--
-- Constraints for table `Pantry`
--
ALTER TABLE `Pantry`
  ADD CONSTRAINT `Pantry_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `logins` (`UserName`) ON DELETE CASCADE;

--
-- Constraints for table `Preferences`
--
ALTER TABLE `Preferences`
  ADD CONSTRAINT `Preferences_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `logins` (`UserName`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
