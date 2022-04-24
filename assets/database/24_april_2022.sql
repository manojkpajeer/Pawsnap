-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pawsandfur
CREATE DATABASE IF NOT EXISTS `pawsandfur` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pawsandfur`;

-- Dumping structure for table pawsandfur.admin_master
CREATE TABLE IF NOT EXISTS `admin_master` (
  `AM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `PhoneNo` varchar(25) DEFAULT NULL,
  `Address` text,
  PRIMARY KEY (`AM_Id`),
  UNIQUE KEY `AdminEmail` (`EmailId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='All admin and super admin details';

-- Dumping data for table pawsandfur.admin_master: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin_master` DISABLE KEYS */;
INSERT INTO `admin_master` (`AM_Id`, `FullName`, `EmailId`, `Status`, `DateCreate`, `PhoneNo`, `Address`) VALUES
	(1, 'Admin', 'manojkpajeer127@gmail.com', 1, '2021-12-26 16:30:23', '8547586952', 'Mangalore, Konaje');
/*!40000 ALTER TABLE `admin_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.billing_customer
CREATE TABLE IF NOT EXISTS `billing_customer` (
  `BC_Id` int(100) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(150) DEFAULT NULL,
  `PhoneNo` varchar(50) DEFAULT NULL,
  `SecondaryNo` varchar(50) DEFAULT NULL,
  `Address` text,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `UniqueId` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`BC_Id`),
  UNIQUE KEY `PhoneNo` (`PhoneNo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.billing_customer: ~2 rows (approximately)
/*!40000 ALTER TABLE `billing_customer` DISABLE KEYS */;
INSERT INTO `billing_customer` (`BC_Id`, `FullName`, `EmailId`, `PhoneNo`, `SecondaryNo`, `Address`, `Status`, `DateCreate`, `UniqueId`) VALUES
	(1, 'manoj', 'manu@gmail.com', '9876568694', '6786756754', 'sada', 1, '2022-02-20 15:49:29', NULL),
	(5, 'as', 'admin@gmail.com', '8904675675', '9876568694', 'sdf\'j', 1, '2022-02-20 15:52:01', NULL);
/*!40000 ALTER TABLE `billing_customer` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.blog_master
CREATE TABLE IF NOT EXISTS `blog_master` (
  `BL_Id` int(100) NOT NULL AUTO_INCREMENT,
  `Tag` varchar(50) DEFAULT NULL,
  `Image` varchar(500) DEFAULT NULL,
  `Title` varchar(1000) DEFAULT NULL,
  `Description` text,
  `PostedBy` varchar(50) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`BL_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.blog_master: ~16 rows (approximately)
/*!40000 ALTER TABLE `blog_master` DISABLE KEYS */;
INSERT INTO `blog_master` (`BL_Id`, `Tag`, `Image`, `Title`, `Description`, `PostedBy`, `CreatedDate`, `Status`) VALUES
	(12, 'Vetarinary', 'assets/images/blog/1648025763.jpg', 'Below are the original Latin passages from which Lorem.', 'A 1914 English translation by Harris Rackham reads:', 'Ajay', '2022-03-23 11:10:31', 1),
	(13, 'Food', 'assets/images/blog/1648025749.jpg', 'Coming full circle, the internet\'s remixing of the now infamous', 'Richard McClintock, a Latin scholar from Hampden-Sydney College, is credited with discovering the source behind the ubiquitous filler text. In seeing a sample of lorem ipsum, his interest was piqued by consectetur—a genuine, albeit rare, Latin word. Consulting a Latin dictionary led McClintock to a passage from De Finibus Bonorum et Malorum (“On the Extremes of Good and Evil”), a first-century B.C. text from the Roman philosopher Cicero.', 'Suraj', '2022-03-23 11:10:32', 1),
	(14, 'Birthday', 'assets/images/blog/1648025738.jpg', 'Generally, lorem ipsum is best suited to keeping', 'Until recently, the prevailing view assumed lorem ipsum was born as a nonsense text. “It\'s not Latin, though it looks like it, and it actually says nothing,” Before & After magazine answered a curious reader, “Its ‘words’ loosely approximate the frequency with which letters occur in English, which is why at a glance it looks pretty real.”', 'Ajay', '2022-03-23 11:10:33', 1),
	(15, 'Animal', 'assets/images/blog/1648025728.jpg', 'Some claim lorem ipsum threatens to promote design over content', 'The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn\'t distract from the layout. A practice not without controversy, laying out pages with meaningless filler text can be very useful when the focus is meant to be on design, not content.', 'Admin', '2022-03-23 11:10:34', 1),
	(16, 'Product', 'assets/images/blog/1648025715.jpg', 'Lorem ipsum was popularized in the 1960s', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Suarj', '2022-03-23 11:10:35', 1),
	(17, 'Feelings', 'assets/images/blog/1648025634.jpg', 'Lorem ipsum was purposefully designed to have no meaning, ', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 'Admin', '2022-03-23 11:10:37', 1),
	(18, 'Love', 'assets/images/blog/1648025626.jpg', 'McClintock wrote to Before & After to explain his discovery;', '"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"', 'Ajay', '2022-03-23 11:10:38', 1),
	(19, 'Pet', 'assets/images/blog/1648025619.jpg', 'So how did the classical Latin become so incoherent? ', '"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"', 'Suraj', '2022-03-23 11:10:38', 1),
	(20, 'Care', 'assets/images/blog/1648025611.jpg', 'with some citing the 15th century and others the 20th.', '"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."', 'Ajay', '2022-03-23 11:10:39', 1),
	(21, 'Care', 'assets/images/blog/1648025602.jpeg', 'Creation timelines for the standard lorem ipsum passage,', '"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."', 'Admin', '2022-03-23 11:10:40', 1),
	(22, 'Food', 'assets/images/blog/1648025594.jpg', 'The standard Lorem Ipsum passage, used since the 1500s', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Admin', '2022-03-23 11:10:41', 1),
	(23, 'Doctor', 'assets/images/blog/1648026891.jpg', 'The house 1914 translation by H. Rackham', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Admin', '2022-03-23 11:10:42', 1),
	(24, 'Care', 'assets/images/blog/1648026882.jpg', 'Creation timelines for the standard lorem ipsum passage,', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'Admin', '2022-03-23 11:10:43', 1),
	(25, 'Love', 'assets/images/blog/1648026875.jpg', 'Some claim lorem ipsum threatens to promote design over content', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Admin', '2022-03-23 11:10:43', 1),
	(26, 'Health', 'assets/images/blog/1648026867.jpg', 'The standard Lorem Ipsum passage, used since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Admin', '2022-03-23 11:10:44', 1);
/*!40000 ALTER TABLE `blog_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.boarding_master
CREATE TABLE IF NOT EXISTS `boarding_master` (
  `BM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `OwnerName` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(50) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `BoardingDate` date DEFAULT NULL,
  `Recomened` varbinary(500) DEFAULT NULL,
  `PetName` varchar(100) DEFAULT NULL,
  `PetAge` varchar(50) DEFAULT NULL,
  `PetImage` varchar(50) DEFAULT NULL,
  `PetHabbit` varchar(1000) DEFAULT NULL,
  `VaccinationDetails` varchar(2000) DEFAULT NULL,
  `IllnessDetails` varchar(1000) DEFAULT NULL,
  `BoardingStatus` varchar(50) DEFAULT NULL,
  `BoardingRemarks` varchar(1000) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `DateApproved` datetime DEFAULT NULL,
  `UserId` int(20) DEFAULT NULL,
  PRIMARY KEY (`BM_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.boarding_master: ~8 rows (approximately)
/*!40000 ALTER TABLE `boarding_master` DISABLE KEYS */;
INSERT INTO `boarding_master` (`BM_Id`, `OwnerName`, `PhoneNumber`, `Location`, `BoardingDate`, `Recomened`, `PetName`, `PetAge`, `PetImage`, `PetHabbit`, `VaccinationDetails`, `IllnessDetails`, `BoardingStatus`, `BoardingRemarks`, `DateCreated`, `DateApproved`, `UserId`) VALUES
	(1, 'gsdf', '65675456', 'ty', '2022-03-29', _binary 0x747279, 'try', 'try', NULL, 'try', 'yrty', 'rty', 'Requested', 'Pending admin approval', '2022-03-29 15:31:22', NULL, 5),
	(2, 'gsdf', '65675456', 'ty', '2022-03-29', _binary 0x747279, 'try', 'try', NULL, 'try', 'yrty', 'rty', 'Requested', 'Pending admin approval', '2022-03-29 15:31:43', NULL, 5),
	(3, 'gsdf', '65675456', 'ty', '2022-03-29', _binary 0x747279, 'try', 'try', NULL, 'try', 'yrty', 'rty', 'Requested', 'Pending admin approval', '2022-03-29 15:32:17', NULL, 5),
	(4, 'dsf', '768567567', 'ghjgf', '2022-03-29', _binary 0x66676A, 'fj', 'gjghj', 'assets/images/boarding/1648548235.jpg', 'ghj', 'jhg', 'jg', 'Rejected', 'Slot Full', '2022-03-29 15:33:55', '2022-03-29 17:14:30', 5),
	(5, 'dg', '5754645654645', 'ertert', '2022-04-02', _binary 0x6572747265, 'ret', 'ret', NULL, 'ret', 'tert', 'ter', 'Requested', 'Pending admin approval', '2022-04-02 16:14:35', NULL, 5),
	(6, 'Suraj', '85471254', 'asd', '2022-04-21', _binary 0x736461, 'saf', '2 Year', NULL, 'af', 'fa', 'af', 'Requested', 'Pending admin approval', '2022-04-21 17:28:55', NULL, 18),
	(7, 'dsf', '768657856756', 'fgh', '2022-04-22', _binary 0x676668, 'fgh', 'fgh', NULL, 'fgh', 'gfh', 'fgh', 'Requested', 'Pending admin approval', '2022-04-22 10:58:05', NULL, 18),
	(8, 'dsf', '768657856756', 'fgh', '2022-04-22', _binary 0x676668, 'fgh', 'fgh', NULL, 'fgh', 'gfh', 'fgh', 'Requested', 'Pending admin approval', '2022-04-22 10:58:14', NULL, 18);
/*!40000 ALTER TABLE `boarding_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='Identify product by brands';

-- Dumping data for table pawsandfur.brands: ~6 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`id`, `name`, `Image`, `description`, `status`, `date_created`) VALUES
	(7, 'Nutro', './assets/images/b1.jpg', 'desc', 1, '2021-12-23 20:22:11'),
	(9, 'First Mate', './assets/images/b2.jpg', 'desc', 1, '2021-12-23 20:23:10'),
	(10, 'Diamond', './assets/images/b3.jpg', 'desc', 1, '2021-12-23 20:23:47'),
	(11, 'IAMS', './assets/images/b4.jpg', 'sdf', 1, '2022-02-07 21:45:14'),
	(12, 'Big Heart', './assets/images/b5.jpg', 'sdfsd', 1, '2022-02-07 21:45:18'),
	(13, 'Royal Canin', './assets/images/b6.jpg', 'sdgds', 1, '2022-02-07 21:45:22');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.brand_card
CREATE TABLE IF NOT EXISTS `brand_card` (
  `BC_ID` int(100) NOT NULL AUTO_INCREMENT,
  `BrandId` int(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`BC_ID`),
  UNIQUE KEY `BrandId` (`BrandId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.brand_card: ~6 rows (approximately)
/*!40000 ALTER TABLE `brand_card` DISABLE KEYS */;
INSERT INTO `brand_card` (`BC_ID`, `BrandId`, `Status`, `DateCreate`) VALUES
	(10, 5, 1, '2022-02-22 14:39:45'),
	(11, 6, 1, '2022-02-22 14:40:52'),
	(13, 7, 1, '2022-02-22 14:41:11'),
	(14, 8, 1, '2022-02-22 14:41:15'),
	(15, 9, 1, '2022-02-22 14:41:20'),
	(16, 10, 1, '2022-02-22 14:41:33');
/*!40000 ALTER TABLE `brand_card` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.brand_master
CREATE TABLE IF NOT EXISTS `brand_master` (
  `BR_Id` int(100) NOT NULL AUTO_INCREMENT,
  `BrandName` varchar(100) DEFAULT NULL,
  `BrandImage` varchar(500) DEFAULT NULL,
  `Description` text,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`BR_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.brand_master: ~6 rows (approximately)
/*!40000 ALTER TABLE `brand_master` DISABLE KEYS */;
INSERT INTO `brand_master` (`BR_Id`, `BrandName`, `BrandImage`, `Description`, `Status`, `DateCreate`) VALUES
	(5, 'Drools', 'images/brand/1645509490.png', '', 1, '2022-02-22 11:28:10'),
	(6, 'Whiskas', 'images/brand/1645509508.png', '', 1, '2022-02-22 11:28:28'),
	(7, 'Bark Out Loud', 'images/brand/1645509527.png', '', 1, '2022-02-22 11:28:47'),
	(8, 'Royal Canin', 'images/brand/1645509542.png', '', 1, '2022-02-22 11:29:02'),
	(9, 'Kittos', 'images/brand/1645509556.png', '', 1, '2022-02-22 11:29:16'),
	(10, 'Henlo', 'images/brand/1645509571.png', ' ', 1, '2022-02-22 11:29:31');
/*!40000 ALTER TABLE `brand_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.brand_menu
CREATE TABLE IF NOT EXISTS `brand_menu` (
  `BM_ID` int(100) NOT NULL AUTO_INCREMENT,
  `BrandId` int(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`BM_ID`),
  UNIQUE KEY `BrandId` (`BrandId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.brand_menu: ~4 rows (approximately)
/*!40000 ALTER TABLE `brand_menu` DISABLE KEYS */;
INSERT INTO `brand_menu` (`BM_ID`, `BrandId`, `Status`, `DateCreate`) VALUES
	(1, 6, 1, '2022-02-22 16:26:10'),
	(3, 5, 1, '2022-02-22 16:26:29'),
	(4, 7, 1, '2022-02-22 16:26:40'),
	(5, 8, 1, '2022-02-22 16:26:50');
/*!40000 ALTER TABLE `brand_menu` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `ParentId` int(100) DEFAULT NULL,
  `Image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='Products categories';

-- Dumping data for table pawsandfur.categories: ~18 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `status`, `date_created`, `ParentId`, `Image`) VALUES
	(17, 'Dry Food', 'desc', 1, '2021-12-23 20:20:08', 1, './assets/images/c1.png'),
	(18, 'Wet Food', 'desc', 1, '2021-12-23 20:20:19', 1, './assets/images/c3.png'),
	(20, 'Litter Supplies', 'desc', 1, '2021-12-23 20:21:10', 1, './assets/images/c5.png'),
	(21, 'Food Supplements', 'desc', 1, '2021-12-23 20:21:30', 1, './assets/images/c4.png'),
	(22, 'Toys', 'dsf', 1, '2022-02-07 21:44:21', 1, './assets/images/c10.png'),
	(23, 'Bones & Chews', 'fsdf', 1, '2022-02-07 21:44:35', 1, './assets/images/c3.png'),
	(24, 'Bow Ties', 'reye', 1, '2022-02-07 21:44:40', 3, './assets/images/c6.png'),
	(25, 'Pet Portraits', 'rthfghf', 1, '2022-02-07 21:44:44', 3, './assets/images/c7.png'),
	(26, 'Kushions', 'fasf', 1, '2022-02-07 21:46:10', 3, './assets/images/c8.png'),
	(27, 'Mats', 'fshfsd', 1, '2022-02-07 21:46:14', 3, './assets/images/c9.png'),
	(28, 'Beds', 'sdf', 1, '2022-02-07 21:46:19', 3, './assets/images/c10.png'),
	(29, 'Name Tag', 'asd', 1, '2022-02-07 21:46:23', 3, './assets/images/c7.png'),
	(30, 'Dry food', 'sdf', 1, '2022-02-07 22:21:27', 2, './assets/images/cd2.png'),
	(31, 'Wet Food', 'wqe', 1, '2022-02-07 22:21:35', 2, './assets/images/cd3.png'),
	(32, 'Grooming', 'qw', 1, '2022-02-07 22:21:39', 2, './assets/images/c9.png'),
	(33, 'Treats & Chews', 'sdf', 1, '2022-02-07 22:21:43', 2, './assets/images/cd1.png'),
	(34, 'Bowls & Feeders', 'as', 1, '2022-02-07 22:21:47', 2, './assets/images/c4.png'),
	(35, 'Travel Supplies', 'ad', 1, '2022-02-07 22:22:00', 2, './assets/images/c2.png');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.category_card
CREATE TABLE IF NOT EXISTS `category_card` (
  `CT_ID` int(100) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`CT_ID`),
  UNIQUE KEY `CategoryId` (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.category_card: ~12 rows (approximately)
/*!40000 ALTER TABLE `category_card` DISABLE KEYS */;
INSERT INTO `category_card` (`CT_ID`, `CategoryId`, `Status`, `DateCreate`) VALUES
	(1, 18, 1, '2022-02-07 11:58:52'),
	(2, 20, 1, '2022-02-07 12:00:18'),
	(3, 17, 1, '2022-02-07 22:50:02'),
	(4, 35, 1, '2022-02-07 22:50:20'),
	(5, 34, 1, '2022-02-07 22:50:23'),
	(6, 33, 1, '2022-02-07 22:50:50'),
	(8, 6, 1, '2022-02-22 15:16:08'),
	(10, 8, 1, '2022-02-22 15:16:21'),
	(11, 4, 1, '2022-02-22 15:16:26'),
	(12, 9, 1, '2022-02-22 15:16:33'),
	(13, 12, 1, '2022-02-22 15:16:40'),
	(14, 14, 1, '2022-02-22 15:16:46');
/*!40000 ALTER TABLE `category_card` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.category_master
CREATE TABLE IF NOT EXISTS `category_master` (
  `CT_Id` int(100) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(100) DEFAULT NULL,
  `Description` text,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `ParentId` int(100) DEFAULT NULL,
  `CategoryImage` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`CT_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.category_master: ~12 rows (approximately)
/*!40000 ALTER TABLE `category_master` DISABLE KEYS */;
INSERT INTO `category_master` (`CT_Id`, `CategoryName`, `Description`, `Status`, `DateCreate`, `ParentId`, `CategoryImage`) VALUES
	(3, 'Name Tags', '', 1, '2022-02-22 11:36:11', 3, 'images/category/1645509971.png'),
	(4, 'Bow Ties', '', 1, '2022-02-22 11:36:49', 3, 'images/category/1645510009.png'),
	(5, 'Cushions', '', 1, '2022-02-22 11:37:15', 3, 'images/category/1645510035.png'),
	(6, 'Dogs dry Food', '', 1, '2022-02-22 11:37:38', 1, 'images/category/1645510058.png'),
	(7, 'Dogs Treats', '', 1, '2022-02-22 11:37:57', 1, 'images/category/1645510077.png'),
	(8, 'Dogs Food & Treats', '', 1, '2022-02-22 11:38:24', 1, 'images/category/1645510104.png'),
	(9, 'Cats Grooming', '', 1, '2022-02-22 11:38:46', 2, 'images/category/1645510126.png'),
	(10, 'Cats Treats', '', 1, '2022-02-22 11:39:37', 2, 'images/category/1645510176.png'),
	(11, 'Cat Litter', 'sdf\'ghfg', 1, '2022-02-22 11:39:58', 2, 'images/category/1645510198.png'),
	(12, 'Personalised Beds', '', 1, '2022-02-22 15:04:23', 3, 'images/category/1645522463.png'),
	(13, 'Personalised Mats', '', 1, '2022-02-22 15:05:07', 3, 'images/category/1645522507.png'),
	(14, 'Occasion Wear', '', 1, '2022-02-22 15:05:49', 3, 'images/category/1645522562.png');
/*!40000 ALTER TABLE `category_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.cat_category_menu
CREATE TABLE IF NOT EXISTS `cat_category_menu` (
  `CC_ID` int(100) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`CC_ID`),
  UNIQUE KEY `CategoryId` (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.cat_category_menu: ~9 rows (approximately)
/*!40000 ALTER TABLE `cat_category_menu` DISABLE KEYS */;
INSERT INTO `cat_category_menu` (`CC_ID`, `CategoryId`, `Status`, `DateCreate`) VALUES
	(1, 18, 1, '2022-02-04 22:19:02'),
	(2, 21, 1, '2022-02-07 12:17:46'),
	(3, 31, 1, '2022-02-07 22:42:22'),
	(4, 32, 1, '2022-02-07 22:42:26'),
	(5, 34, 1, '2022-02-07 22:42:30'),
	(6, 35, 1, '2022-02-07 22:42:33'),
	(8, 9, 1, '2022-02-22 16:32:31'),
	(10, 11, 1, '2022-02-22 16:33:06'),
	(12, 10, 1, '2022-02-22 16:33:27');
/*!40000 ALTER TABLE `cat_category_menu` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.contact_master
CREATE TABLE IF NOT EXISTS `contact_master` (
  `CM_Id` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerName` varchar(100) DEFAULT NULL,
  `CustomerEmail` varchar(150) DEFAULT NULL,
  `Subject` varchar(250) DEFAULT NULL,
  `Message` text,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `CustomerPhone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CM_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='All customer querries';

-- Dumping data for table pawsandfur.contact_master: ~6 rows (approximately)
/*!40000 ALTER TABLE `contact_master` DISABLE KEYS */;
INSERT INTO `contact_master` (`CM_Id`, `CustomerName`, `CustomerEmail`, `Subject`, `Message`, `Status`, `DateCreate`, `CustomerPhone`) VALUES
	(1, 'sdf', 'admin@gmail.com', 'as', 'd', 1, '2022-04-14 16:22:58', '9876568694'),
	(2, 'sdf', 'admin@gmail.com', 'as', 'd', 1, '2022-04-14 16:23:23', '9876568694'),
	(3, 'sdf', 'admin@gmail.com', 'as', 'd', 1, '2022-04-14 16:23:42', '9876568694'),
	(4, 'sdf', 'admin@gmail.com', 'as', 'd', 1, '2022-04-14 16:24:01', '7777777777'),
	(5, 'sdf', 'admin@gmail.com', 'as', 'd', 1, '2022-04-14 16:24:24', '7777777777'),
	(6, 'sdf', 'admin@gmail.com', 'as', 'd', 1, '2022-04-14 16:24:39', '7777777777'),
	(7, 'sdf', 'admin@gmail.com', 'as', 'd', 1, '2022-04-14 16:24:53', '7777777777'),
	(8, 'ffsfsdfsdfds', 'admin@gmail.com', 'as', 'sdfsdfsdfsdfsdfsdf', 1, '2022-04-15 11:58:04', '9876568694'),
	(9, 'sdf', 'manojkpajeer127@gmail.com', 'as', 'zxc', 1, '2022-04-20 15:16:33', '6666666666');
/*!40000 ALTER TABLE `contact_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `address` text,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unique_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='Customers data';

-- Dumping data for table pawsandfur.customers: ~2 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `phone2`, `address`, `status`, `date_created`, `unique_id`) VALUES
	(4, 'Suraj', '', '9878786765', '', '', 1, '2021-12-23 19:29:03', NULL),
	(5, 'Ajay M', '', '8547541256', '', '', 1, '2021-12-23 20:16:43', NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.customer_master
CREATE TABLE IF NOT EXISTS `customer_master` (
  `CM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `CustomerEmail` varchar(150) DEFAULT NULL,
  `CustomerPhone` varchar(15) DEFAULT NULL,
  `AddressLine1` varchar(250) DEFAULT NULL,
  `AddressLine2` varchar(250) DEFAULT NULL,
  `CustomerCity` varchar(100) DEFAULT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Landmark` varchar(150) DEFAULT NULL,
  `CustomerState` varchar(100) DEFAULT NULL,
  `CustomerCountry` varchar(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`CM_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='All customer details';

-- Dumping data for table pawsandfur.customer_master: ~9 rows (approximately)
/*!40000 ALTER TABLE `customer_master` DISABLE KEYS */;
INSERT INTO `customer_master` (`CM_Id`, `FullName`, `CustomerEmail`, `CustomerPhone`, `AddressLine1`, `AddressLine2`, `CustomerCity`, `Pincode`, `Landmark`, `CustomerState`, `CustomerCountry`, `Status`, `DateCreate`) VALUES
	(3, 'manoj', 'manu.mobile127@gmail.com', '8904653322', 'asf', 'sa', 'sadsaf', '43534534534534534534534', 'asfsaf', NULL, NULL, 0, '2022-02-21 17:14:48'),
	(5, 'as', 'test@gmail.com', '3333333333333', 'as', 'as', 'as', '222222', 'as', NULL, NULL, 1, '2022-02-23 22:49:56'),
	(6, 'd', 'manojkpajeer127@gmail.coms', '543343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-08 14:02:24'),
	(7, 'sdf', 'manojkpajeer127@gmail.com', '9876568694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-15 13:32:17'),
	(8, 'daas', 'manojkpdajeer127@gmail.com', '9876568694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-15 13:32:44'),
	(9, 'sdf', 'manojkpsssajeer127@gmail.com', '9876568694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-15 13:33:20'),
	(10, 'sad', 'manojkpfdgajeer127@gmail.com', '9876568694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-15 13:33:54'),
	(12, 'sdfssss', 'admin@gmail.com', '9876568694', 'asd', 'fa', 'afs', '565645', 'fa', NULL, NULL, 1, '2022-04-15 15:26:50'),
	(13, 'sdf', 'sujithferns@gmail.com', '6666666666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-15 15:27:03'),
	(18, 'sad', 'manu.mobile127@gmail.com', '9876568694', 'fd', 'dg', 'dfssads', '657567', 's', NULL, NULL, 1, '2022-04-15 15:36:53'),
	(19, 'sad', 'sujithsadasferns@gmail.com', '8888888888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-04-20 15:30:05');
/*!40000 ALTER TABLE `customer_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.dog_category_menu
CREATE TABLE IF NOT EXISTS `dog_category_menu` (
  `CM_ID` int(100) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`CM_ID`),
  UNIQUE KEY `CategoryId` (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.dog_category_menu: ~3 rows (approximately)
/*!40000 ALTER TABLE `dog_category_menu` DISABLE KEYS */;
INSERT INTO `dog_category_menu` (`CM_ID`, `CategoryId`, `Status`, `DateCreate`) VALUES
	(2, 8, 1, '2022-02-22 16:37:49'),
	(3, 6, 1, '2022-02-22 16:38:09'),
	(4, 7, 1, '2022-02-22 16:38:13');
/*!40000 ALTER TABLE `dog_category_menu` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.ecom_sales
CREATE TABLE IF NOT EXISTS `ecom_sales` (
  `ES_Id` int(100) NOT NULL AUTO_INCREMENT,
  `CustomerId` int(100) DEFAULT NULL,
  `OrderId` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `CancelReason` varchar(50) DEFAULT NULL,
  `DeliveryStatus` varchar(50) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `Remarks` text,
  `PaymentId` int(100) DEFAULT NULL,
  PRIMARY KEY (`ES_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.ecom_sales: ~74 rows (approximately)
/*!40000 ALTER TABLE `ecom_sales` DISABLE KEYS */;
INSERT INTO `ecom_sales` (`ES_Id`, `CustomerId`, `OrderId`, `Status`, `CancelReason`, `DeliveryStatus`, `DateCreate`, `Remarks`, `PaymentId`) VALUES
	(1, 2, '1644998295620cae9716af6', '0', NULL, NULL, '2022-02-16 13:28:15', 'Order Initiated', 0),
	(2, 2, '1644998364620caedcaf023', '0', NULL, NULL, '2022-02-16 13:29:24', 'Order Initiated', 0),
	(3, 2, '1644998528620caf80aef24', '0', NULL, NULL, '2022-02-16 13:32:08', 'Order Initiated', 0),
	(4, 2, '1644999321620cb299dce07', '0', NULL, NULL, '2022-02-16 13:45:21', 'Order Initiated', 0),
	(5, 2, '1645023887620d128f06606', '0', NULL, NULL, '2022-02-16 20:34:47', 'Order Initiated', 0),
	(6, 2, '1645025138620d177259ae2', '0', NULL, NULL, '2022-02-16 20:55:38', 'Order Initiated', 0),
	(7, 2, '1645034032620d3a308120f', '0', NULL, NULL, '2022-02-16 23:23:52', 'Order Initiated', 0),
	(8, 2, '1645034322620d3b5219217', '0', NULL, NULL, '2022-02-16 23:28:42', 'Order Initiated', 0),
	(9, 2, '1645082308620df6c4e9bf8', '1', NULL, NULL, '2022-02-17 12:48:28', 'Order Initiated', 8),
	(10, 3, '16456013076215e21b04e2c', '0', NULL, NULL, '2022-02-23 12:58:27', 'Order Initiated', 0),
	(11, 3, '16456014526215E2AC2189F', '0', NULL, NULL, '2022-02-23 13:00:52', 'Order Initiated', 0),
	(12, 3, '16456016076215E347BC410', '0', NULL, NULL, '2022-02-23 13:03:27', 'Order Initiated', 0),
	(13, 3, '16456016826215E3926454D', '0', NULL, NULL, '2022-02-23 13:04:42', 'Order Initiated', 0),
	(14, 3, '16456026166215E7381153E', '0', NULL, NULL, '2022-02-23 13:20:16', 'Order Initiated', 0),
	(15, 3, '16456026476215E75710BAC', '0', NULL, NULL, '2022-02-23 13:20:47', 'Order Initiated', 0),
	(16, 3, '16456049596215F05FD413C', '1', NULL, NULL, '2022-02-23 13:59:19', 'Order Initiated', 12),
	(17, 3, '16456054736215F26160C13', '0', NULL, NULL, '2022-02-23 14:07:53', 'Order Initiated', 0),
	(18, 3, '1645627061621646B5E3FF8', '1', NULL, NULL, '2022-02-23 20:07:41', 'Order Initiated', 14),
	(19, 3, '164562933562164F9781599', '1', NULL, NULL, '2022-02-23 20:45:35', 'Order Initiated', 15),
	(20, 3, '1645635574621667F6F1990', '1', NULL, NULL, '2022-02-23 22:29:34', 'Order Shipped', 16),
	(21, 3, '164563561862166822394B7', '0', NULL, NULL, '2022-02-23 22:30:18', 'Order Failed', 0),
	(22, 5, '164563745462166F4EE5AEB', '1', NULL, NULL, '2022-02-23 23:00:54', 'Order Out for delivary', 18),
	(23, 5, '16456838376217247D7171A', '0', NULL, NULL, '2022-02-24 11:53:57', 'Order Initiated', 0),
	(24, 5, '16456868616217304D29CE6', '0', NULL, NULL, '2022-02-24 12:44:21', 'Order Failed', 0),
	(25, 5, '1646027889621C647138C10', '0', NULL, NULL, '2022-02-28 11:28:09', 'Order Initiated', 0),
	(26, 5, '1646242995621FACB3A4231', '1', NULL, NULL, '2022-03-02 23:13:15', 'Order Placed', 22),
	(27, 5, '1649228355624D3A43D438A', '0', NULL, NULL, '2022-04-06 12:29:15', 'Order Initiated', 0),
	(28, 5, '1649248191624D87BF7D1FC', '0', NULL, NULL, '2022-04-06 17:59:51', 'Order Initiated', 0),
	(29, 5, '1649248426624D88AA6D72A', '0', NULL, NULL, '2022-04-06 18:03:46', 'Order Initiated', 0),
	(30, 5, '1649248774624D8A061F614', '0', NULL, NULL, '2022-04-06 18:09:34', 'Order Initiated', 0),
	(31, 5, '1649266411624DCEEB075C1', '0', NULL, NULL, '2022-04-06 23:03:31', 'Order Initiated', 0),
	(32, 5, '1649266948624DD104673C7', '0', NULL, NULL, '2022-04-06 23:12:28', 'Order Initiated', 0),
	(33, 5, '1649270508624DDEECE5348', '0', NULL, NULL, '2022-04-07 00:11:48', 'Order Initiated', 0),
	(34, 5, '164948734362512DEF5D90E', '0', NULL, NULL, '2022-04-09 12:25:43', 'Order Initiated', 0),
	(35, 5, '164948737762512E116BB2D', '0', NULL, NULL, '2022-04-09 12:26:17', 'Order Initiated', 0),
	(36, 5, '16494880066251308680B70', '1', NULL, NULL, '2022-04-09 12:36:46', 'Order Placed', 26),
	(37, 5, '1649488070625130C633C3D', '0', NULL, NULL, '2022-04-09 12:37:50', 'Order Failed', 0),
	(38, 5, '16494900616251388D9248D', '0', NULL, NULL, '2022-04-09 13:11:01', 'Order Initiated', 0),
	(39, 5, '1649490100625138B4AFFD9', '0', NULL, NULL, '2022-04-09 13:11:40', 'Order Initiated', 0),
	(40, 5, '1649490158625138EE9C0BC', '0', NULL, NULL, '2022-04-09 13:12:38', 'Order Initiated', 0),
	(41, 6, '164949048962513A391D0F6', 'Order Cancelled', 'Ordered By Mistke', 'Order Initiated', '2022-04-09 13:18:09', 'Order Cancelled By User', 0),
	(42, 6, '164949050262513A46EA8E0', '', '', 'Order Initiated', '2022-04-09 13:18:22', 'Order Cancelled By User', 0),
	(43, 18, '165002005062594ED249288', 'Order Cancelled', 'Change of mind', 'Order Initiated', '2022-04-15 16:24:10', 'Order Cancelled By User', 30),
	(44, 18, '165002345062595C1A3A60B', 'Order Initiated', NULL, NULL, '2022-04-15 17:20:50', 'A new order has been initiated by customer', 0),
	(45, 18, '165002352062595C60D0098', 'Order Initiated', NULL, NULL, '2022-04-15 17:22:00', 'A new order has been initiated by customer', 0),
	(46, 18, '165002431062595F7647F2E', 'Order Initiated', NULL, NULL, '2022-04-15 17:35:10', 'A new order has been initiated by customer', 0),
	(47, 18, '165002442262595FE676730', 'Order Initiated', NULL, NULL, '2022-04-15 17:37:02', 'A new order has been initiated by customer', 0),
	(48, 18, '165002442862595FECCC24C', 'Order Initiated', NULL, NULL, '2022-04-15 17:37:08', 'A new order has been initiated by customer', 0),
	(49, 18, '165002447262596018B74C8', 'Order Cancelled', 'Ordered By Mistke', 'Order Initiated', '2022-04-15 17:37:52', 'Order Cancelled By User', 31),
	(50, 12, '1650455648625FF46020075', 'Order Initiated', NULL, NULL, '2022-04-20 17:24:08', 'A new order has been initiated by customer', 0),
	(51, 12, '1650458818626000C237242', 'Order Initiated', NULL, NULL, '2022-04-20 18:16:58', 'A new order has been initiated by customer', 0),
	(52, 12, '16504589986260017605CBA', 'Order Initiated', NULL, NULL, '2022-04-20 18:19:58', 'A new order has been initiated by customer', 0),
	(53, 12, '16504590196260018BDDD4E', 'Order Initiated', NULL, NULL, '2022-04-20 18:20:19', 'A new order has been initiated by customer', 0),
	(54, 12, '1650459051626001AB313CD', 'Order Initiated', NULL, NULL, '2022-04-20 18:20:51', 'A new order has been initiated by customer', 0),
	(55, 12, '1650459103626001DFD673A', 'Order Initiated', NULL, NULL, '2022-04-20 18:21:43', 'A new order has been initiated by customer', 0),
	(56, 12, '1650459220626002542E7C8', 'Order Initiated', NULL, NULL, '2022-04-20 18:23:40', 'A new order has been initiated by customer', 0),
	(57, 12, '16504609456260091191BD4', 'Order Initiated', NULL, NULL, '2022-04-20 18:52:25', 'A new order has been initiated by customer', 0),
	(58, 12, '16504609866260093A265AC', 'Order Initiated', NULL, NULL, '2022-04-20 18:53:06', 'A new order has been initiated by customer', 0),
	(59, 12, '165046103062600966554EE', 'Order Initiated', NULL, NULL, '2022-04-20 18:53:50', 'A new order has been initiated by customer', 0),
	(60, 12, '165046134062600A9C52F3E', 'Order Initiated', NULL, NULL, '2022-04-20 18:59:00', 'A new order has been initiated by customer', 0),
	(61, 12, '165046139962600AD7526EF', 'Order Initiated', NULL, NULL, '2022-04-20 18:59:59', 'A new order has been initiated by customer', 0),
	(62, 12, '165046144962600B0943756', 'Order Initiated', NULL, NULL, '2022-04-20 19:00:49', 'A new order has been initiated by customer', 0),
	(63, 18, '1650525894626106C69F9F4', 'Order Placed', NULL, 'Order Initiated', '2022-04-21 12:54:54', 'Order has been placed successfully', 35),
	(64, 18, '1650530790626119E666B7E', 'Order Initiated', NULL, NULL, '2022-04-21 14:16:30', 'A new order has been initiated by customer', 0),
	(65, 18, '165053178362611DC7BC417', 'Order Initiated', NULL, NULL, '2022-04-21 14:33:03', 'A new order has been initiated by customer', 0),
	(66, 18, '165053245062612062E1437', 'Order Initiated', NULL, NULL, '2022-04-21 14:44:10', 'A new order has been initiated by customer', 0),
	(67, 18, '16507063446263C7A8B2F14', 'Order Initiated', NULL, NULL, '2022-04-23 15:02:24', 'A new order has been initiated by customer', 0),
	(68, 18, '16507082506263CF1A2F299', 'Order Initiated', NULL, NULL, '2022-04-23 15:34:10', 'A new order has been initiated by customer', 0),
	(69, 18, '16507096786263D4AE8F024', 'Order Initiated', NULL, NULL, '2022-04-23 15:57:58', 'A new order has been initiated by customer', 0),
	(70, 18, '16507096826263D4B2EC502', 'Order Initiated', NULL, NULL, '2022-04-23 15:58:02', 'A new order has been initiated by customer', 0),
	(71, 18, '16507115096263DBD5017F1', 'Order Initiated', NULL, NULL, '2022-04-23 16:28:29', 'A new order has been initiated by customer', 0),
	(72, 18, '16507136526263E43456428', 'Order Initiated', NULL, NULL, '2022-04-23 17:04:12', 'A new order has been initiated by customer', 0),
	(73, 18, '16507136636263E43FCD381', 'Order Initiated', NULL, NULL, '2022-04-23 17:04:23', 'A new order has been initiated by customer', 0),
	(74, 18, '16507136846263E45438CAE', 'Order Initiated', NULL, NULL, '2022-04-23 17:04:44', 'A new order has been initiated by customer', 0),
	(75, 18, '16507136956263E45FE2E34', 'Order Initiated', NULL, NULL, '2022-04-23 17:04:55', 'A new order has been initiated by customer', 0);
/*!40000 ALTER TABLE `ecom_sales` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.ecom_sales_temp
CREATE TABLE IF NOT EXISTS `ecom_sales_temp` (
  `EC_Id` int(100) NOT NULL AUTO_INCREMENT,
  `OrderId` varchar(50) DEFAULT NULL,
  `ProductId` int(100) DEFAULT NULL,
  `Quantity` double DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `Message` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`EC_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.ecom_sales_temp: ~71 rows (approximately)
/*!40000 ALTER TABLE `ecom_sales_temp` DISABLE KEYS */;
INSERT INTO `ecom_sales_temp` (`EC_Id`, `OrderId`, `ProductId`, `Quantity`, `Status`, `DateCreate`, `Message`) VALUES
	(1, '1644998295620cae9716af6', 18, 1, 1, '2022-02-16 13:28:15', NULL),
	(2, '1644998364620caedcaf023', 18, 1, 1, '2022-02-16 13:29:24', NULL),
	(3, '1644998528620caf80aef24', 18, 1, 1, '2022-02-16 13:32:08', NULL),
	(4, '1644999321620cb299dce07', 18, 2, 1, '2022-02-16 13:45:21', NULL),
	(5, '1644999321620cb299dce07', 17, 1, 1, '2022-02-16 13:45:21', NULL),
	(6, '1645023887620d128f06606', 18, 1, 1, '2022-02-16 20:34:47', NULL),
	(7, '1645025138620d177259ae2', 18, 1, 1, '2022-02-16 20:55:38', NULL),
	(8, '1645034032620d3a308120f', 18, 1, 1, '2022-02-16 23:23:52', NULL),
	(9, '1645034322620d3b5219217', 17, 1, 1, '2022-02-16 23:28:42', NULL),
	(10, '1645082308620df6c4e9bf8', 18, 1, 1, '2022-02-17 12:48:29', NULL),
	(11, '16456013076215e21b04e2c', 4, 1, 1, '2022-02-23 12:58:27', NULL),
	(12, '16456013076215e21b04e2c', 6, 1, 1, '2022-02-23 12:58:27', NULL),
	(13, '16456013076215e21b04e2c', 7, 1, 1, '2022-02-23 12:58:27', NULL),
	(14, '16456013076215e21b04e2c', 5, 1, 1, '2022-02-23 12:58:27', NULL),
	(15, '16456014526215E2AC2189F', 4, 2, 1, '2022-02-23 13:00:52', NULL),
	(16, '16456014526215E2AC2189F', 7, 1, 1, '2022-02-23 13:00:52', NULL),
	(17, '16456016076215E347BC410', 4, 1, 1, '2022-02-23 13:03:27', NULL),
	(18, '16456016826215E3926454D', 4, 1, 1, '2022-02-23 13:04:42', NULL),
	(19, '16456026166215E7381153E', 5, 1, 1, '2022-02-23 13:20:16', NULL),
	(20, '16456026476215E75710BAC', 4, 1, 1, '2022-02-23 13:20:47', NULL),
	(21, '16456049596215F05FD413C', 5, 1, 1, '2022-02-23 13:59:19', NULL),
	(22, '16456054736215F26160C13', 4, 1, 1, '2022-02-23 14:07:53', NULL),
	(23, '1645627061621646B5E3FF8', 5, 1, 1, '2022-02-23 20:07:42', NULL),
	(24, '164562933562164F9781599', 4, 1, 1, '2022-02-23 20:45:35', NULL),
	(25, '1645635574621667F6F1990', 5, 1, 1, '2022-02-23 22:29:35', NULL),
	(26, '164563561862166822394B7', 4, 1, 1, '2022-02-23 22:30:18', NULL),
	(27, '164563745462166F4EE5AEB', 4, 1, 1, '2022-02-23 23:00:54', NULL),
	(28, '16456838376217247D7171A', 5, 1, 1, '2022-02-24 11:53:57', NULL),
	(29, '16456868616217304D29CE6', 6, 1, 1, '2022-02-24 12:44:21', NULL),
	(30, '1646027889621C647138C10', 5, 1, 1, '2022-02-28 11:28:09', NULL),
	(31, '1646242995621FACB3A4231', 5, 1, 1, '2022-03-02 23:13:15', NULL),
	(32, '1649228355624D3A43D438A', 6, 1, 1, '2022-04-06 12:29:15', NULL),
	(33, '1649248191624D87BF7D1FC', 7, 1, 1, '2022-04-06 17:59:51', NULL),
	(34, '1649248426624D88AA6D72A', 7, 1, 1, '2022-04-06 18:03:46', NULL),
	(35, '1649248774624D8A061F614', 7, 1, 1, '2022-04-06 18:09:34', NULL),
	(36, '1649266411624DCEEB075C1', 7, 1, 1, '2022-04-06 23:03:31', NULL),
	(37, '1649266948624DD104673C7', 5, 1, 1, '2022-04-06 23:12:28', NULL),
	(38, '1649270508624DDEECE5348', 5, 1, 1, '2022-04-07 00:11:48', NULL),
	(39, '164948734362512DEF5D90E', 6, 1, 1, '2022-04-09 12:25:43', NULL),
	(40, '164948737762512E116BB2D', 5, 1, 1, '2022-04-09 12:26:17', NULL),
	(41, '16494880066251308680B70', 6, 1, 1, '2022-04-09 12:36:46', NULL),
	(42, '1649488070625130C633C3D', 4, 1, 1, '2022-04-09 12:37:50', NULL),
	(43, '16494900616251388D9248D', 5, 1, 1, '2022-04-09 13:11:01', NULL),
	(44, '1649490100625138B4AFFD9', 5, 1, 1, '2022-04-09 13:11:40', NULL),
	(45, '1649490158625138EE9C0BC', 6, 1, 1, '2022-04-09 13:12:38', NULL),
	(46, '164949048962513A391D0F6', 5, 1, 1, '2022-04-09 13:18:09', NULL),
	(47, '164949050262513A46EA8E0', 6, 1, 1, '2022-04-09 13:18:22', NULL),
	(48, '165002005062594ED249288', 12, 1, 1, '2022-04-15 16:24:10', NULL),
	(49, '165002345062595C1A3A60B', 5, 1, 1, '2022-04-15 17:20:50', NULL),
	(50, '165002352062595C60D0098', 5, 1, 1, '2022-04-15 17:22:00', NULL),
	(51, '165002431062595F7647F2E', 5, 3, 1, '2022-04-15 17:35:10', NULL),
	(52, '165002442262595FE676730', 12, 1, 1, '2022-04-15 17:37:02', NULL),
	(53, '165002442862595FECCC24C', 12, 1, 1, '2022-04-15 17:37:08', NULL),
	(54, '165002447262596018B74C8', 4, 1, 1, '2022-04-15 17:37:52', NULL),
	(55, '1650459220626002542E7C8', 5, 1, 1, '2022-04-20 18:23:40', 'sad'),
	(56, '16504609456260091191BD4', 9, 1, 1, '2022-04-20 18:52:25', ''),
	(57, '16504609456260091191BD4', 4, 25, 1, '2022-04-20 18:52:25', ''),
	(58, '16504609456260091191BD4', 5, 26, 1, '2022-04-20 18:52:25', ''),
	(59, '16504609456260091191BD4', 6, 5, 1, '2022-04-20 18:52:25', ''),
	(60, '16504609456260091191BD4', 7, 14, 1, '2022-04-20 18:52:25', ''),
	(61, '16504609456260091191BD4', 10, 1, 1, '2022-04-20 18:52:25', ''),
	(62, '16504609456260091191BD4', 11, 1, 1, '2022-04-20 18:52:25', ''),
	(63, '16504609866260093A265AC', 6, 1, 1, '2022-04-20 18:53:06', ''),
	(64, '16504609866260093A265AC', 7, 1, 1, '2022-04-20 18:53:06', ''),
	(65, '16504609866260093A265AC', 4, 1, 1, '2022-04-20 18:53:06', ''),
	(66, '165046103062600966554EE', 7, 1, 1, '2022-04-20 18:53:50', ''),
	(67, '165046103062600966554EE', 4, 1, 1, '2022-04-20 18:53:50', ''),
	(68, '165046134062600A9C52F3E', 5, 1, 1, '2022-04-20 18:59:00', 'sad'),
	(69, '165046134062600A9C52F3E', 7, 1, 1, '2022-04-20 18:59:00', 'N/A'),
	(70, '165046139962600AD7526EF', 7, 1, 1, '2022-04-20 18:59:59', 'N/A'),
	(71, '165046139962600AD7526EF', 4, 1, 1, '2022-04-20 18:59:59', 'asd'),
	(72, '165046144962600B0943756', 4, 1, 1, '2022-04-20 19:00:49', 'sdf'),
	(73, '165046144962600B0943756', 7, 1, 1, '2022-04-20 19:00:49', 'N/A'),
	(74, '1650525894626106C69F9F4', 7, 1, 1, '2022-04-21 12:54:54', 'N/A'),
	(75, '1650530790626119E666B7E', 4, 1, 1, '2022-04-21 14:16:30', 'A'),
	(76, '165053178362611DC7BC417', 7, 1, 1, '2022-04-21 14:33:03', 'N/A'),
	(77, '165053245062612062E1437', 7, 1, 1, '2022-04-21 14:44:10', 'N/A'),
	(78, '16507063446263C7A8B2F14', 7, 1, 1, '2022-04-23 15:02:24', 'N/A'),
	(79, '16507082506263CF1A2F299', 7, 1, 1, '2022-04-23 15:34:10', 'N/A'),
	(80, '16507096786263D4AE8F024', 8, 1, 1, '2022-04-23 15:57:58', 'da'),
	(81, '16507096826263D4B2EC502', 5, 1, 1, '2022-04-23 15:58:02', 'sa'),
	(82, '16507115096263DBD5017F1', 5, 1, 1, '2022-04-23 16:28:29', 'fdgs'),
	(83, '16507136526263E43456428', 7, 1, 1, '2022-04-23 17:04:12', 'N/A'),
	(84, '16507136636263E43FCD381', 7, 3, 1, '2022-04-23 17:04:23', 'N/A'),
	(85, '16507136846263E45438CAE', 7, 1, 1, '2022-04-23 17:04:44', 'N/A'),
	(86, '16507136956263E45FE2E34', 7, 4, 1, '2022-04-23 17:04:55', 'N/A');
/*!40000 ALTER TABLE `ecom_sales_temp` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.grooming_request
CREATE TABLE IF NOT EXISTS `grooming_request` (
  `GR_Id` int(100) NOT NULL AUTO_INCREMENT,
  `DateCreate` datetime DEFAULT NULL,
  `GroomingStatus` varchar(50) DEFAULT NULL,
  `Remarks` text,
  `UserName` varchar(100) DEFAULT NULL,
  `UserPhone` varchar(50) DEFAULT NULL,
  `UserAddress` text,
  `AppointmentDate` date DEFAULT NULL,
  `UserId` int(100) DEFAULT NULL,
  `TokenNo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`GR_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.grooming_request: ~22 rows (approximately)
/*!40000 ALTER TABLE `grooming_request` DISABLE KEYS */;
INSERT INTO `grooming_request` (`GR_Id`, `DateCreate`, `GroomingStatus`, `Remarks`, `UserName`, `UserPhone`, `UserAddress`, `AppointmentDate`, `UserId`, `TokenNo`) VALUES
	(1, '2022-04-04 17:03:24', 'Requested', 'Your request sent to admin.', 'sdf', '9876568694', 'asd', '2022-04-04', NULL, NULL),
	(2, '2022-04-04 17:03:32', 'Requested', 'Your request sent to admin.', 'sdf', '9876568694', 'asd', '2022-04-04', NULL, NULL),
	(3, '2022-04-04 17:03:48', 'Requested', 'Your request sent to admin.', 'sdf', '9876568694', 'asd', '2022-04-04', NULL, NULL),
	(4, '2022-04-04 17:04:21', 'Requested', 'Your request sent to admin.', 'daas', '8888888888', 'sad', '2022-04-04', NULL, NULL),
	(5, '2022-04-04 17:14:46', 'Requested', 'Your request sent to admin.', 'asff', '9876568694', 'sfdas', '2022-04-04', NULL, NULL),
	(6, '2022-04-04 17:21:57', 'Requested', 'Your request sent to admin.', 'sa', '8904675675', 'df', '2022-04-04', 5, NULL),
	(7, '2022-04-04 17:22:39', 'Requested', 'Your request sent to admin.', 'asd', '9876568694', 'das', '2022-04-04', 5, NULL),
	(8, '2022-04-23 12:55:58', 'Initiated', 'Request initiated by customer', 'das', '9876568694', 'sad', '2022-04-23', 18, '16506979346263A6CEDD72E'),
	(9, '2022-04-23 12:58:53', 'Initiated', 'Request initiated by customer', 'sad', '9876568333', 'sad', '2022-04-23', 18, '16506979346263A6CEDD72E'),
	(10, '2022-04-23 12:59:01', 'Initiated', 'Request initiated by customer', 'sad', '9876568333', 'sad', '2022-04-23', 18, '16506979346263A6CEDD72E'),
	(11, '2022-04-23 13:15:48', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, ''),
	(12, '2022-04-23 13:16:03', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, ''),
	(13, '2022-04-23 13:16:28', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16506999886263AED4CAEB8'),
	(14, '2022-04-23 13:17:01', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507000216263AEF50E72A'),
	(15, '2022-04-23 13:17:17', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507000376263AF0567B88'),
	(16, '2022-04-23 13:17:46', 'Confirmed', 'Request confirmed by user', 'asd', '9876568694', 'sad', '2022-04-23', 18, '16507000666263AF22EAF54'),
	(17, '2022-04-23 13:19:12', 'Confirmed', 'Request confirmed by user', 'asd', '9876568694', 'asdsa', '2022-04-23', 18, '16507001526263AF78EAF55'),
	(18, '2022-04-23 13:52:18', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507021386263B73AC614F'),
	(19, '2022-04-23 15:25:23', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507077236263CD0BD608D'),
	(20, '2022-04-23 15:37:46', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507084666263CFF271B3D'),
	(21, '2022-04-23 15:50:49', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507092496263D301659CD'),
	(22, '2022-04-23 16:20:29', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507110296263D9F5A6160'),
	(23, '2022-04-23 16:52:58', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507129786263E192D3DE0'),
	(24, '2022-04-23 16:53:09', 'Initiated', 'Request initiated by user', NULL, NULL, NULL, NULL, 18, '16507129896263E19DAC509');
/*!40000 ALTER TABLE `grooming_request` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.login_master
CREATE TABLE IF NOT EXISTS `login_master` (
  `LM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `UserEmail` varchar(100) DEFAULT NULL,
  `UserPassword` varchar(100) DEFAULT NULL,
  `UserRole` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`LM_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='All users login details';

-- Dumping data for table pawsandfur.login_master: ~12 rows (approximately)
/*!40000 ALTER TABLE `login_master` DISABLE KEYS */;
INSERT INTO `login_master` (`LM_Id`, `UserEmail`, `UserPassword`, `UserRole`) VALUES
	(5, 'saf@ads', 'ASqq123', 'Staff'),
	(6, 'manojkpajeer127@gmail.com', '1f1cd299226a29b23f908ac3033bc067', 'Admin'),
	(8, 'test@gmail.com', 'MAnoj143', 'Customer'),
	(10, 'fgh@sfd', 'Adsgs3123', 'Staff'),
	(11, 'manojkpajeer127@gmail.coms', 'MAnoj143@@', 'Customer'),
	(12, 'manojkpajeer127@gmail.com', 'ss!AsssssWWaa@@21', 'Customer'),
	(13, 'manojkpdajeer127@gmail.com', 'd@safasda#Qwdssda2', 'Customer'),
	(14, 'manojkpsssajeer127@gmail.com', 'AAAaaa@@111', 'Customer'),
	(15, 'manojkpfdgajeer127@gmail.com', 'MAnoj132!!!', 'Customer'),
	(16, 'admin@gmail.com', '1f1cd299226a29b23f908ac3033bc067', 'Customer'),
	(17, 'sujithferns@gmail.com', 'd', 'Customer'),
	(18, 'manu.mobile127@gmail.com', '1f1cd299226a29b23f908ac3033bc067', 'Customer'),
	(19, 'sujithsadasferns@gmail.com', '997a93dab3caa5ede6d59b23448a7cd9', 'Customer');
/*!40000 ALTER TABLE `login_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.log_master
CREATE TABLE IF NOT EXISTS `log_master` (
  `LO_id` int(100) NOT NULL AUTO_INCREMENT,
  `UserId` int(100) DEFAULT NULL,
  `UserRole` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`LO_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1 COMMENT='All user log details';

-- Dumping data for table pawsandfur.log_master: ~13 rows (approximately)
/*!40000 ALTER TABLE `log_master` DISABLE KEYS */;
INSERT INTO `log_master` (`LO_id`, `UserId`, `UserRole`, `CreateDate`) VALUES
	(100, 1, 'Admin', '2022-02-03 12:13:17'),
	(101, 1, 'Admin', '2022-02-03 12:23:02'),
	(102, 1, 'Admin', '2022-02-03 20:53:35'),
	(103, 1, 'Admin', '2022-02-03 22:02:11'),
	(104, 1, 'Admin', '2022-02-04 11:49:30'),
	(105, 1, 'Admin', '2022-02-04 13:42:45'),
	(106, 1, 'Admin', '2022-02-04 16:49:32'),
	(107, 1, 'Admin', '2022-02-04 17:04:26'),
	(108, 1, 'Admin', '2022-02-04 19:07:01'),
	(109, 1, 'Admin', '2022-02-07 11:44:21'),
	(110, 1, 'Admin', '2022-02-07 14:56:13'),
	(111, 1, 'Admin', '2022-02-07 15:52:39'),
	(112, 1, 'Admin', '2022-02-07 21:59:38');
/*!40000 ALTER TABLE `log_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.news_letter
CREATE TABLE IF NOT EXISTS `news_letter` (
  `NL_Id` int(100) NOT NULL AUTO_INCREMENT,
  `EmailID` varchar(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`NL_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='All subscribers emails';

-- Dumping data for table pawsandfur.news_letter: ~10 rows (approximately)
/*!40000 ALTER TABLE `news_letter` DISABLE KEYS */;
INSERT INTO `news_letter` (`NL_Id`, `EmailID`, `Status`, `DateCreate`) VALUES
	(1, 'vijay@gmail.com', 1, '2022-02-03 22:01:30'),
	(2, 'suraj@outlook.com', 1, '2022-02-03 22:01:44'),
	(3, 'shanti@gmail.com', 1, '2022-02-07 11:36:27'),
	(4, 'somu@gmail.com', 1, '2022-02-22 12:41:29'),
	(5, 'shayam@gmail.com', 1, '2022-02-22 12:45:47'),
	(6, 'satya@gmail.com', 1, '2022-02-22 12:46:03'),
	(7, 'bharat@gmail.com', 1, '2022-02-22 12:47:56'),
	(8, 'suntosh@gmail.com', 1, '2022-02-22 12:48:32'),
	(9, 'ganesh@gmail.com', 1, '2022-02-22 12:55:31'),
	(10, 'rajesh@gmail.com', 1, '2022-02-23 11:20:00');
/*!40000 ALTER TABLE `news_letter` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.online_discount
CREATE TABLE IF NOT EXISTS `online_discount` (
  `OD_Id` int(11) NOT NULL AUTO_INCREMENT,
  `DiscountStatus` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `DateUpdate` datetime DEFAULT NULL,
  `DiscountRate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`OD_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.online_discount: ~0 rows (approximately)
/*!40000 ALTER TABLE `online_discount` DISABLE KEYS */;
INSERT INTO `online_discount` (`OD_Id`, `DiscountStatus`, `DateCreate`, `DateUpdate`, `DiscountRate`) VALUES
	(1, 1, '2022-04-23 17:01:09', '2022-04-23 17:01:08', '5');
/*!40000 ALTER TABLE `online_discount` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.payment_master
CREATE TABLE IF NOT EXISTS `payment_master` (
  `PM_Id` int(11) NOT NULL AUTO_INCREMENT,
  `OrderId` varchar(50) DEFAULT NULL,
  `TransactionId` varchar(50) DEFAULT NULL,
  `PaidCurrency` varchar(50) DEFAULT NULL,
  `PaymentStatus` varchar(150) DEFAULT NULL,
  `DatePaid` datetime DEFAULT NULL,
  `TotalAmount` decimal(20,6) DEFAULT NULL,
  `CustomerId` int(100) DEFAULT NULL,
  `PaymentMessage` text,
  PRIMARY KEY (`PM_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.payment_master: ~39 rows (approximately)
/*!40000 ALTER TABLE `payment_master` DISABLE KEYS */;
INSERT INTO `payment_master` (`PM_Id`, `OrderId`, `TransactionId`, `PaidCurrency`, `PaymentStatus`, `DatePaid`, `TotalAmount`, `CustomerId`, `PaymentMessage`) VALUES
	(1, '1645025138620d177259ae2', 'pi_3KTrU4SEbPv1KY8x0Yr108Ah', 'inr', 'Initiated', '2022-02-16 23:10:07', 1425.000000, 2, 'requires_payment_method'),
	(2, '1645025138620d177259ae2', 'pi_3KTrUCSEbPv1KY8x0UN83BE9', 'inr', 'Initiated', '2022-02-16 23:10:15', 1425.000000, 2, 'requires_payment_method'),
	(3, '1645025138620d177259ae2', 'pi_3KTrVASEbPv1KY8x1nVgY8HZ', 'inr', 'Initiated', '2022-02-16 23:11:17', 1425.000000, 2, 'requires_payment_method'),
	(4, '1645034032620d3a308120f', 'pi_3KTrhPSEbPv1KY8x020g51jE', 'inr', 'Initiated', '2022-02-16 23:23:55', 1425.000000, 2, 'requires_payment_method'),
	(5, '1645025138620d177259ae2', 'pi_3KTrjsSEbPv1KY8x0rNkZ82g', 'inr', 'Initiated', '2022-02-16 23:26:29', 1425.000000, 2, 'requires_payment_method'),
	(6, '1645025138620d177259ae2', 'pi_3KTrkISEbPv1KY8x0MR1UAuq', 'inr', 'Initiated', '2022-02-16 23:26:55', 1425.000000, 2, 'requires_payment_method'),
	(7, '1645034322620d3b5219217', 'pi_3KTrm5SEbPv1KY8x0t2IfytE', 'inr', 'Initiated', '2022-02-16 23:28:45', 2322.000000, 2, 'requires_payment_method'),
	(8, '1645082308620df6c4e9bf8', 'pi_3KU4G4SEbPv1KY8x0uzdYuEv', 'inr', 'Initiated', '2022-02-17 12:48:33', 1425.000000, 2, 'requires_payment_method'),
	(9, '1645082308620df6c4e9bf8', 'pi_3KU4GkSEbPv1KY8x1LrXk51s', 'inr', 'Initiated', '2022-02-17 12:49:15', 1425.000000, 2, 'requires_payment_method'),
	(10, '1645082308620df6c4e9bf8', 'pi_3KU4tBSEbPv1KY8x0SSw7MPH', 'inr', 'Initiated', '2022-02-17 13:28:58', 1425.000000, 2, 'requires_payment_method'),
	(11, '1645082308620df6c4e9bf8', 'pi_3KU4tvSEbPv1KY8x0JgDPDUe', 'inr', 'Initiated', '2022-02-17 13:29:44', 1425.000000, 2, 'requires_payment_method'),
	(12, '16456049596215F05FD413C', 'pi_3KWGFFSEbPv1KY8x1EO2L6Cm', 'inr', 'Initiated', '2022-02-23 14:00:45', 500.000000, 3, 'requires_payment_method'),
	(13, '16456054736215F26160C13', 'pi_3KWGMDSEbPv1KY8x0iM3A3RT', 'inr', 'Initiated', '2022-02-23 14:07:56', 1080.000000, 3, 'requires_payment_method'),
	(14, '1645627061621646B5E3FF8', 'pi_3KWLyRSEbPv1KY8x1KSmKrTn', 'inr', 'Initiated', '2022-02-23 20:07:45', 500.000000, 3, 'requires_payment_method'),
	(15, '164562933562164F9781599', 'pi_3KWMZ6SEbPv1KY8x0mfWfnYu', 'inr', 'Initiated', '2022-02-23 20:45:38', 1080.000000, 3, 'requires_payment_method'),
	(16, '1645635574621667F6F1990', 'pi_3KWOBkSEbPv1KY8x0BNuWopb', 'inr', 'Initiated', '2022-02-23 22:29:38', 500.000000, 3, 'requires_payment_method'),
	(17, '164563561862166822394B7', 'pi_3KWOCPSEbPv1KY8x132qJean', 'inr', 'Initiated', '2022-02-23 22:30:20', 1080.000000, 3, 'requires_payment_method'),
	(18, '164563745462166F4EE5AEB', 'pi_3KWOgNSEbPv1KY8x1ReOoJIy', 'inr', 'Initiated', '2022-02-23 23:01:17', 1080.000000, 5, 'requires_payment_method'),
	(19, '16456838376217247D7171A', 'pi_3KWakCSEbPv1KY8x0IQ6EFmT', 'inr', 'Initiated', '2022-02-24 11:54:06', 500.000000, 5, 'requires_payment_method'),
	(20, '16456868616217304D29CE6', 'pi_3KWbWvSEbPv1KY8x163TBR7p', 'inr', 'Initiated', '2022-02-24 12:44:24', 1425.000000, 5, 'requires_payment_method'),
	(21, '16456868616217304D29CE6', 'pi_3KWbXVSEbPv1KY8x1UEGjCO4', 'inr', 'Initiated', '2022-02-24 12:45:01', 1425.000000, 5, 'requires_payment_method'),
	(22, '1646242995621FACB3A4231', 'pi_3KYwCpSEbPv1KY8x1LPvp7RX', 'inr', 'Initiated', '2022-03-02 23:13:21', 500.000000, 5, 'requires_payment_method'),
	(23, '1649270508624DDEECE5348', 'pi_3KldrNSEbPv1KY8x1scPC9Xf', 'inr', 'Initiated', '2022-04-07 00:15:39', 500.000000, 5, 'requires_payment_method'),
	(24, '1649270508624DDEECE5348', 'pi_3KldrpSEbPv1KY8x0IUMAb98', 'inr', 'Initiated', '2022-04-07 00:16:07', 500.000000, 5, 'requires_payment_method'),
	(25, '164948737762512E116BB2D', 'pi_3KmYH0SEbPv1KY8x0Bh9zDgY', 'inr', 'Initiated', '2022-04-09 12:29:56', 500.000000, 5, 'requires_payment_method'),
	(26, '16494880066251308680B70', 'pi_3KmYNhSEbPv1KY8x17imZrf7', 'inr', 'Initiated', '2022-04-09 12:36:50', 1900.000000, 5, 'requires_payment_method'),
	(27, '1649488070625130C633C3D', 'pi_3KmYOiSEbPv1KY8x19Bi0nPI', 'inr', 'Initiated', '2022-04-09 12:37:53', 1200.000000, 5, 'requires_payment_method'),
	(28, '164949048962513A391D0F6', 'pi_3KmZ1jSEbPv1KY8x07iLyNR6', 'inr', 'Initiated', '2022-04-09 13:18:11', 500.000000, 5, 'requires_payment_method'),
	(29, '164949050262513A46EA8E0', 'pi_3KmZ1xSEbPv1KY8x13fp5eHg', 'inr', 'Initiated', '2022-04-09 13:18:26', 1900.000000, 5, 'requires_payment_method'),
	(30, '165002005062594ED249288', 'pi_3Komn4SEbPv1KY8x13YPVuFk', 'inr', 'Initiated', '2022-04-15 16:24:15', 812.040000, 18, 'requires_payment_method'),
	(31, '165002447262596018B74C8', 'pi_3KonyGSEbPv1KY8x0cAB0a6p', 'inr', 'Initiated', '2022-04-15 17:39:52', 1080.000000, 18, 'requires_payment_method'),
	(32, '165046144962600B0943756', 'pi_3Kqdd8SEbPv1KY8x04Reg2Ht', 'inr', 'Initiated', '2022-04-20 19:01:36', 2580.000000, 12, 'requires_payment_method'),
	(33, '165046144962600B0943756', 'pi_3KqeJlSEbPv1KY8x0ckfcmvy', 'inr', 'Initiated', '2022-04-20 19:45:39', 2580.000000, 12, 'requires_payment_method'),
	(34, '165046144962600B0943756', 'pi_3KqeL9SEbPv1KY8x09siz69y', 'inr', 'Initiated', '2022-04-20 19:47:05', 2580.000000, 12, 'requires_payment_method'),
	(35, '1650525894626106C69F9F4', 'pi_3KqueYSEbPv1KY8x0WCuoOOl', 'inr', 'Initiated', '2022-04-21 13:12:12', 1500.000000, 18, 'requires_payment_method'),
	(36, '1650525894626106C69F9F4', 'pi_3KquxdSEbPv1KY8x0w4bAcej', 'inr', 'Initiated', '2022-04-21 13:31:54', 1500.000000, 18, 'requires_payment_method'),
	(37, '1650525894626106C69F9F4', 'pi_3Kquy2SEbPv1KY8x13P4quNF', 'inr', 'Initiated', '2022-04-21 13:32:19', 1500.000000, 18, 'requires_payment_method'),
	(38, '1650525894626106C69F9F4', 'pi_3Kqv3qSEbPv1KY8x1TE8jziU', 'inr', 'Initiated', '2022-04-21 13:38:20', 1500.000000, 18, 'requires_payment_method'),
	(39, '1650530790626119E666B7E', 'pi_3KqverSEbPv1KY8x1n6tiXBd', 'inr', 'Initiated', '2022-04-21 14:16:35', 1080.000000, 18, 'requires_payment_method');
/*!40000 ALTER TABLE `payment_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.personalise_card
CREATE TABLE IF NOT EXISTS `personalise_card` (
  `PC_ID` int(100) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(100) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`PC_ID`),
  UNIQUE KEY `CategoryId` (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.personalise_card: ~6 rows (approximately)
/*!40000 ALTER TABLE `personalise_card` DISABLE KEYS */;
INSERT INTO `personalise_card` (`PC_ID`, `CategoryId`, `Status`, `DateCreate`) VALUES
	(1, 3, 1, '2022-02-22 14:58:47'),
	(3, 4, 1, '2022-02-22 14:59:14'),
	(4, 5, 1, '2022-02-22 14:59:18'),
	(5, 14, 1, '2022-02-22 15:06:16'),
	(6, 13, 1, '2022-02-22 15:06:21'),
	(7, 12, 1, '2022-02-22 15:06:26');
/*!40000 ALTER TABLE `personalise_card` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.personalise_category_menu
CREATE TABLE IF NOT EXISTS `personalise_category_menu` (
  `PC_ID` int(100) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`PC_ID`),
  UNIQUE KEY `CategoryId` (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.personalise_category_menu: ~3 rows (approximately)
/*!40000 ALTER TABLE `personalise_category_menu` DISABLE KEYS */;
INSERT INTO `personalise_category_menu` (`PC_ID`, `CategoryId`, `Status`, `DateCreate`) VALUES
	(1, 3, 1, '2022-02-22 15:37:38'),
	(3, 4, 1, '2022-02-22 15:37:48'),
	(4, 14, 1, '2022-02-22 15:38:00');
/*!40000 ALTER TABLE `personalise_category_menu` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `category_id` int(100) NOT NULL,
  `brand_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `discount` varchar(50) NOT NULL,
  `gst` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='All types of products';

-- Dumping data for table pawsandfur.products: ~3 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `code`, `image`, `description`, `price`, `discount`, `gst`, `status`, `date_created`) VALUES
	(17, 17, 7, 'Royal Canin Giant Junior Dog Dry Food ', '1000001', 'product/132076-p1.webp', 'this is thanks to a balanced intake of energy and minerals such as calcium and phosphorus', -100.000000, '10', '18', 1, '2021-12-23 20:53:58'),
	(18, 17, 10, 'Maxi Puppy Wet Food ', '1000002', 'product/588207-p2.webp', 'this is thanks to a balanced intake of energy and minerals such as calcium and phosphorus', 1500.000000, '5', '18', 1, '2021-12-23 20:55:42'),
	(19, 17, 9, 'Drools Pup Booster Puppy Weaning Diet', '1000003', 'product/505401-p3.webp', 'this is thanks to a balanced intake of energy and minerals such as calcium and phosphorus', 4900.000000, '25', '18', 1, '2021-12-23 20:56:51');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.product_master
CREATE TABLE IF NOT EXISTS `product_master` (
  `PM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(100) DEFAULT NULL,
  `BrandId` int(100) DEFAULT NULL,
  `ProductName` varchar(250) DEFAULT NULL,
  `ProductCode` varchar(50) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Description` text,
  `Price` decimal(20,6) DEFAULT NULL,
  `Discount` double DEFAULT NULL,
  `GST` double DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `Image1` varchar(250) DEFAULT NULL,
  `Image2` varchar(250) DEFAULT NULL,
  `Image3` varchar(250) DEFAULT NULL,
  `ProductQuantity` varchar(50) DEFAULT NULL,
  `OnlineDiscount` double DEFAULT NULL,
  PRIMARY KEY (`PM_Id`),
  UNIQUE KEY `ProductCode` (`ProductCode`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.product_master: ~7 rows (approximately)
/*!40000 ALTER TABLE `product_master` DISABLE KEYS */;
INSERT INTO `product_master` (`PM_Id`, `CategoryId`, `BrandId`, `ProductName`, `ProductCode`, `Image`, `Description`, `Price`, `Discount`, `GST`, `Status`, `DateCreate`, `Image1`, `Image2`, `Image3`, `ProductQuantity`, `OnlineDiscount`) VALUES
	(4, 5, 8, 'Personalised Cushion', '1245124512', 'images/product/16455134916810.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1200.000000, 10, 18, 1, '2022-02-22 12:34:51', 'images/product/16455134913396.jpg', 'images/product/16455134915413.jpg', 'images/product/16455134917476.jpg', NULL, 10),
	(5, 3, 9, 'Personalised Name Tag', '5874521452', 'images/product/16455135646820.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 500.000000, 0, 18, 1, '2022-02-22 12:36:05', 'images/product/16455135642315.jpg', 'images/product/16455135641877.jpg', 'images/product/16455135649919.jpg', NULL, 20),
	(6, 4, 10, 'Bow Ties', '9854712541', 'images/product/16455136393478.jpg', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1900.000000, 25, 18, 1, '2022-02-22 12:37:19', 'images/product/16455136393316.jpg', 'images/product/16455136396323.jpg', 'images/product/16455136399028.jpg', NULL, 30),
	(7, 6, 8, 'Maxi Breed Dry Food', '8547125412', 'images/product/16455201384240.jpg', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', 2500.000000, 10, 18, 1, '2022-02-22 14:25:38', 'images/product/16455201384955.jpg', 'images/product/16455201389849.jpg', 'images/product/16455201385024.jpg', NULL, 40),
	(8, 3, 5, 'fs', 'asds', 'images/product/16493127312342.png', 'description', 43.000000, 0, 18, 1, '2022-04-07 11:55:31', 'images/product/16493127311774.webp', 'images/product/16493127318114.png', 'images/product/16493127319314.jpg', NULL, 50),
	(9, 4, 6, 'saf', 'sdf', 'images/product/16493135134799.jpg', 'description', 100.000000, 0, 18, 1, '2022-04-07 12:08:33', 'images/product/16493135134799.jpg', 'images/product/16493135134799.jpg', 'images/product/16493135134799.jpg', '12', 60),
	(10, 5, 7, 'SAD', 'AD', 'images/product/16493153055654.jpg', 'DF', 122.000000, 0, 18, 1, '2022-04-07 12:38:25', 'images/product/16493153052868.webp', 'images/product/16493153051196.jpg', 'images/product/16493153059424.webp', '10', 5),
	(11, 3, 7, 'sad', 'as', 'images/product/16494089256976.png', 'description', 1212.000000, 20, 18, 1, '2022-04-08 14:38:45', 'images/product/16494089256976.png', 'images/product/16494089256976.png', 'images/product/16494089256976.png', '10', 40),
	(12, 3, 5, 'sad', 'asd', 'images/product/16494101964589.png', 'weq', 1212.000000, 20, 18, 1, '2022-04-08 14:59:56', 'images/product/16494101964589.png', 'images/product/16494101964589.png', 'images/product/16494101964589.png', '10', 33);
/*!40000 ALTER TABLE `product_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.product_purchase
CREATE TABLE IF NOT EXISTS `product_purchase` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `bill_date` date NOT NULL,
  `vendor_id` int(100) NOT NULL,
  `billno` varchar(100) NOT NULL,
  `purchase_status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_gst` varchar(50) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
  `total_discount` varchar(50) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='Item purchase from vendors';

-- Dumping data for table pawsandfur.product_purchase: ~5 rows (approximately)
/*!40000 ALTER TABLE `product_purchase` DISABLE KEYS */;
INSERT INTO `product_purchase` (`id`, `bill_date`, `vendor_id`, `billno`, `purchase_status`, `date_created`, `total_gst`, `grand_total`, `total_discount`, `total_amount`) VALUES
	(3, '2022-03-15', 4, '463461', 1, '2022-03-15 22:10:13', '1', '1', '1', '1'),
	(4, '2022-03-15', 3, '463461', 1, '2022-03-15 22:12:13', '1', '1', '1', '1'),
	(6, '2022-03-15', 3, '4634622', 1, '2022-03-15 23:30:33', '321', '321', '21321', '213'),
	(7, '2022-03-15', 4, '4634612', 1, '2022-03-15 23:37:44', '53', '53', '435', '29362.5');
/*!40000 ALTER TABLE `product_purchase` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.product_row
CREATE TABLE IF NOT EXISTS `product_row` (
  `PR_ID` int(100) NOT NULL AUTO_INCREMENT,
  `ProductId` int(100) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `Row` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PR_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.product_row: ~8 rows (approximately)
/*!40000 ALTER TABLE `product_row` DISABLE KEYS */;
INSERT INTO `product_row` (`PR_ID`, `ProductId`, `Status`, `DateCreate`, `Row`) VALUES
	(3, 6, 1, '2022-02-22 13:23:57', '2'),
	(5, 5, 1, '2022-02-22 13:29:52', '2'),
	(6, 4, 1, '2022-02-22 13:39:21', '2'),
	(8, 4, 1, '2022-02-22 13:41:16', '1'),
	(9, 5, 1, '2022-02-22 13:41:21', '1'),
	(10, 6, 1, '2022-02-22 13:41:26', '1'),
	(11, 7, 1, '2022-02-22 14:25:57', '2'),
	(12, 7, 1, '2022-02-22 14:26:06', '1');
/*!40000 ALTER TABLE `product_row` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.purchase_temp
CREATE TABLE IF NOT EXISTS `purchase_temp` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(100) NOT NULL,
  `billno` varchar(100) NOT NULL,
  `bill_date` date NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Store purchase product barcode';

-- Dumping data for table pawsandfur.purchase_temp: ~5 rows (approximately)
/*!40000 ALTER TABLE `purchase_temp` DISABLE KEYS */;
INSERT INTO `purchase_temp` (`id`, `vendor_id`, `billno`, `bill_date`, `product_id`, `quantity`, `discount`, `price`, `status`) VALUES
	(4, 4, '463461', '2022-03-15', 4, '1', '0', '1', 1),
	(5, 3, '463461', '2022-03-15', 4, '3', '0', '10', 1),
	(7, 3, '46346213', '2022-03-15', 4, '2', '0', '0', 0),
	(8, 3, '4634622', '2022-03-15', 5, '11', '10', '123', 1),
	(9, 4, '4634612', '2022-03-15', 4, '2', '0', '0', 1);
/*!40000 ALTER TABLE `purchase_temp` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `customer_id` int(100) NOT NULL,
  `billno` varchar(100) NOT NULL,
  `bill_date` date NOT NULL,
  `discount` varchar(50) NOT NULL,
  `sales_status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid` varchar(50) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.sales: ~6 rows (approximately)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`id`, `customer_id`, `billno`, `bill_date`, `discount`, `sales_status`, `date_created`, `paid`, `remark`) VALUES
	(10, 4, '1640273969', '2021-12-23', '0', 1, '2021-12-23 21:10:04', '2322', ''),
	(12, 4, '1640273971', '2021-12-23', '15', 1, '2021-12-23 21:11:57', '15000', 'Ask after tow days'),
	(15, 5, '1640273974', '2022-03-15', '0', 1, '2022-03-15 22:49:14', '1425', ''),
	(16, 5, '1640273975', '2022-03-15', '0', 1, '2022-03-15 23:21:00', '2660', ''),
	(17, 5, '1640273976', '2022-03-15', '0', 1, '2022-03-15 23:21:21', '100', ''),
	(18, 5, '1640273977', '2022-03-15', '0', 1, '2022-03-15 23:44:36', '100', '');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.sales_temp
CREATE TABLE IF NOT EXISTS `sales_temp` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `billno` varchar(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `Message` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COMMENT='sold products list';

-- Dumping data for table pawsandfur.sales_temp: ~9 rows (approximately)
/*!40000 ALTER TABLE `sales_temp` DISABLE KEYS */;
INSERT INTO `sales_temp` (`id`, `billno`, `product_id`, `quantity`, `date_created`, `status`, `Message`) VALUES
	(34, '1640273969', 17, '1', '2021-12-23 21:09:54', 1, NULL),
	(36, '1640273971', 17, '2', '2021-12-23 21:11:06', 1, NULL),
	(37, '1640273971', 18, '1', '2021-12-23 21:11:12', 1, NULL),
	(38, '1640273971', 19, '5', '2021-12-23 21:11:16', 1, NULL),
	(46, '1640273974', 6, '1', '2022-03-15 22:49:11', 1, NULL),
	(47, '1640273975', 4, '2', '2022-03-15 23:20:52', 1, NULL),
	(48, '1640273975', 5, '1', '2022-03-15 23:20:58', 1, NULL),
	(49, '1640273976', 5, '2', '2022-03-15 23:21:14', 1, NULL),
	(50, '1640273977', 5, '2', '2022-03-15 23:44:22', 1, NULL);
/*!40000 ALTER TABLE `sales_temp` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.service_temp
CREATE TABLE IF NOT EXISTS `service_temp` (
  `TokenNo` varchar(50) DEFAULT NULL,
  `ST_Id` int(11) NOT NULL AUTO_INCREMENT,
  `ServiceId` int(11) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ST_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.service_temp: ~19 rows (approximately)
/*!40000 ALTER TABLE `service_temp` DISABLE KEYS */;
INSERT INTO `service_temp` (`TokenNo`, `ST_Id`, `ServiceId`, `DateCreate`, `Status`) VALUES
	('16507000666263AF22EAF54', 1, 2, '2022-04-23 13:17:46', 1),
	('16507000666263AF22EAF54', 2, 4, '2022-04-23 13:17:46', 1),
	('16507000666263AF22EAF54', 3, 5, '2022-04-23 13:17:46', 1),
	('16507000666263AF22EAF54', 4, 6, '2022-04-23 13:17:46', 1),
	('16507001526263AF78EAF55', 5, 5, '2022-04-23 13:19:12', 1),
	('16507001526263AF78EAF55', 6, 6, '2022-04-23 13:19:12', 1),
	('16507021386263B73AC614F', 7, 1, '2022-04-23 13:52:18', 1),
	('16507021386263B73AC614F', 8, 2, '2022-04-23 13:52:18', 1),
	('16507077236263CD0BD608D', 9, 2, '2022-04-23 15:25:23', 1),
	('16507077236263CD0BD608D', 10, 4, '2022-04-23 15:25:23', 1),
	('16507077236263CD0BD608D', 11, 5, '2022-04-23 15:25:23', 1),
	('16507084666263CFF271B3D', 12, 1, '2022-04-23 15:37:46', 1),
	('16507084666263CFF271B3D', 13, 2, '2022-04-23 15:37:46', 1),
	('16507092496263D301659CD', 14, 1, '2022-04-23 15:50:49', 1),
	('16507092496263D301659CD', 15, 2, '2022-04-23 15:50:49', 1),
	('16507110296263D9F5A6160', 16, 3, '2022-04-23 16:20:29', 1),
	('16507110296263D9F5A6160', 17, 5, '2022-04-23 16:20:29', 1),
	('16507129786263E192D3DE0', 18, 1, '2022-04-23 16:52:58', 1),
	('16507129786263E192D3DE0', 19, 2, '2022-04-23 16:52:58', 1),
	('16507129896263E19DAC509', 20, 2, '2022-04-23 16:53:09', 1);
/*!40000 ALTER TABLE `service_temp` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.service_type
CREATE TABLE IF NOT EXISTS `service_type` (
  `SR_Id` int(100) NOT NULL AUTO_INCREMENT,
  `ServiceName` varchar(100) DEFAULT NULL,
  `ServicePrice` decimal(20,2) DEFAULT NULL,
  `ServiceDescription` text,
  `ServiceStatus` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`SR_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.service_type: ~7 rows (approximately)
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` (`SR_Id`, `ServiceName`, `ServicePrice`, `ServiceDescription`, `ServiceStatus`, `DateCreate`) VALUES
	(1, 'Bath With Shampoo', 2501.00, 'There are many variations of passages of ipsum available but the majority red.', 1, '2022-04-04 17:13:41'),
	(2, 'Nail Clipping', 251.00, 'There are many variations of passages of ipsum available but the majority red.', 1, '2022-04-04 17:13:42'),
	(3, 'Ear Cleaning', 250.00, 'There are many variations of passages of ipsum available but the majority red.', 1, '2022-04-04 17:13:43'),
	(4, 'Paw Massage', 300.00, 'There are many variations of passages of ipsum available but the majority red.', 1, '2022-04-04 17:13:43'),
	(5, 'Combing/Brushing', 1500.00, 'There are many variations of passages of ipsum available but the majority red.', 1, '2022-04-04 17:13:44'),
	(6, 'Hair Styling', 1000.00, 'There are many variations of passages of ipsum available but the majority red.', 1, '2022-04-04 17:13:45'),
	(7, 'Hair Trimming', 500.00, 'There are many variations of passages of ipsum available but the majority red.', 0, '2022-04-04 17:13:44');
/*!40000 ALTER TABLE `service_type` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.slider_master
CREATE TABLE IF NOT EXISTS `slider_master` (
  `SL_ID` int(100) NOT NULL AUTO_INCREMENT,
  `Image` varchar(250) DEFAULT NULL,
  `Text` varchar(500) DEFAULT NULL,
  `SubText` varchar(500) DEFAULT NULL,
  `Title` varchar(500) DEFAULT NULL,
  `Link` varchar(500) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`SL_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.slider_master: ~3 rows (approximately)
/*!40000 ALTER TABLE `slider_master` DISABLE KEYS */;
INSERT INTO `slider_master` (`SL_ID`, `Image`, `Text`, `SubText`, `Title`, `Link`, `Status`, `DateCreate`) VALUES
	(6, 'assets/images/slider/1645542252.jpg', 'Sections 1.10.32 and 1.10.33 from ', 'Contrary to popular belief, Lorem Ipsum', 'Lorem Ipsum used', '', 1, '2022-02-22 20:27:46'),
	(7, 'assets/images/slider/1645542371.jpg', 'English versions from the 1914 translation by H. Rackham.', 'Contrary to popular belief, Lorem Ipsum', 'Contrary to popular', '#', 1, '2022-02-22 20:28:16'),
	(8, 'assets/images/slider/1645541940.jpg', 'Reproduced below for those interested', 'Contrary to popular belief, Lorem Ipsum', 'The standard chunk', '#', 1, '2022-02-22 20:29:01');
/*!40000 ALTER TABLE `slider_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.slot_master
CREATE TABLE IF NOT EXISTS `slot_master` (
  `SL_Id` int(20) NOT NULL AUTO_INCREMENT,
  `TotalSlot` int(20) DEFAULT NULL,
  `SlotName` varchar(50) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `SlotStatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`SL_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.slot_master: ~1 rows (approximately)
/*!40000 ALTER TABLE `slot_master` DISABLE KEYS */;
INSERT INTO `slot_master` (`SL_Id`, `TotalSlot`, `SlotName`, `DateCreate`, `DateModified`, `SlotStatus`) VALUES
	(1, 10, 'Main Slot', '2022-03-29 13:49:12', '2022-03-29 14:12:29', NULL);
/*!40000 ALTER TABLE `slot_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.staff_master
CREATE TABLE IF NOT EXISTS `staff_master` (
  `ST_Id` int(100) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(150) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `PhoneNo` varchar(50) DEFAULT NULL,
  `Address` text,
  PRIMARY KEY (`ST_Id`),
  UNIQUE KEY `EmailId` (`EmailId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='All Staff Details';

-- Dumping data for table pawsandfur.staff_master: ~1 rows (approximately)
/*!40000 ALTER TABLE `staff_master` DISABLE KEYS */;
INSERT INTO `staff_master` (`ST_Id`, `FullName`, `EmailId`, `Status`, `DateCreate`, `PhoneNo`, `Address`) VALUES
	(2, 'sssssss', 'saf@ads', 1, '2022-02-20 14:25:33', '8888888888', 'sadsa\'h'),
	(4, 'fgh', 'fgh@sfd', 1, '2022-03-14 22:27:43', '7567565465', 'ert');
/*!40000 ALTER TABLE `staff_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.testmonial_master
CREATE TABLE IF NOT EXISTS `testmonial_master` (
  `TM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Message` text,
  `DateCreate` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`TM_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.testmonial_master: ~4 rows (approximately)
/*!40000 ALTER TABLE `testmonial_master` DISABLE KEYS */;
INSERT INTO `testmonial_master` (`TM_Id`, `UserName`, `Location`, `Image`, `Message`, `DateCreate`, `Status`) VALUES
	(3, 'Dr. Gopal Reddy', 'Bangalore', 'assets/images/testimonial/1645515408.jpg', '"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam"', '2022-02-04 21:46:25', 1),
	(4, 'Mr. Akhilesh J', 'Hasan', 'assets/images/testimonial/1645515265.jpg', ' "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua"', '2022-02-22 00:03:13', 1),
	(5, 'Mr. Ajay K S', '', 'assets/images/testimonial/1645515453.jpg', ' "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua"', '2022-02-22 13:07:33', 1),
	(6, 'Mr. Bharath Raj B', 'Udupi', 'assets/images/testimonial/1645515477.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam', '2022-02-22 13:07:57', 1);
/*!40000 ALTER TABLE `testmonial_master` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT 'users/user.jpg',
  `type` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COMMENT='Admin and Staff details ';

-- Dumping data for table pawsandfur.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `image`, `type`, `status`, `created_date`) VALUES
	(11, 'Admin', 'manojkpajeer127@gmail.com', '8547125631', 'password', 'users/426724-user.jpg', 'Admin', 1, '2021-12-23 19:21:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.vendors
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `gstin` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='Vendors lists';

-- Dumping data for table pawsandfur.vendors: ~2 rows (approximately)
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` (`id`, `name`, `phone`, `phone2`, `gstin`, `address`, `status`, `date_created`) VALUES
	(6, 'Happy paws', '6985475485', '', '22AAAAA0000A1Z5', 'Bus Station, Marnamikatta, Father Mullers Rd, Marnamikatte, Mangaluru, Karnataka 575002', 1, '2021-12-23 20:32:58'),
	(7, 'Bubbels hub', '8547123652', '', '22AAAAA0000A1Z6', 'Bird shop in Ullal, Karnataka', 1, '2021-12-23 20:33:39');
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.vendor_master
CREATE TABLE IF NOT EXISTS `vendor_master` (
  `VM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `PhoneNo` varchar(50) DEFAULT NULL,
  `PhoneNo2` varchar(50) DEFAULT NULL,
  `GSTIN` varchar(50) DEFAULT NULL,
  `Address` text,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`VM_Id`),
  UNIQUE KEY `GSTIN` (`GSTIN`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.vendor_master: ~3 rows (approximately)
/*!40000 ALTER TABLE `vendor_master` DISABLE KEYS */;
INSERT INTO `vendor_master` (`VM_Id`, `FullName`, `PhoneNo`, `PhoneNo2`, `GSTIN`, `Address`, `Status`, `DateCreate`) VALUES
	(3, 'sss', '9876568645', '6786756754', '22AABCU9603R1ZS', 'sad\'jj', 1, '2022-02-20 20:25:59'),
	(4, 'xzc', '9876568694', '', '22AABCU9603R1ZX', 'd', 1, '2022-03-14 22:31:26');
/*!40000 ALTER TABLE `vendor_master` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
