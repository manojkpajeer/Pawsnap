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
	(13, 'Food', 'assets/images/blog/1648025749.jpg', 'Coming full circle, the internet\'s remixing of the now infamous', 'Richard McClintock, a Latin scholar from Hampden-Sydney College, is credited with discovering the source behind the ubiquitous filler text. In seeing a sample of lorem ipsum, his interest was piqued by consectetur???a genuine, albeit rare, Latin word. Consulting a Latin dictionary led McClintock to a passage from De Finibus Bonorum et Malorum (???On the Extremes of Good and Evil???), a first-century B.C. text from the Roman philosopher Cicero.', 'Suraj', '2022-03-23 11:10:32', 1),
	(14, 'Birthday', 'assets/images/blog/1648025738.jpg', 'Generally, lorem ipsum is best suited to keeping', 'Until recently, the prevailing view assumed lorem ipsum was born as a nonsense text. ???It\'s not Latin, though it looks like it, and it actually says nothing,??? Before & After magazine answered a curious reader, ???Its ???words??? loosely approximate the frequency with which letters occur in English, which is why at a glance it looks pretty real.???', 'Ajay', '2022-03-23 11:10:33', 1),
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.boarding_master: ~4 rows (approximately)
/*!40000 ALTER TABLE `boarding_master` DISABLE KEYS */;
INSERT INTO `boarding_master` (`BM_Id`, `OwnerName`, `PhoneNumber`, `Location`, `BoardingDate`, `Recomened`, `PetName`, `PetAge`, `PetImage`, `PetHabbit`, `VaccinationDetails`, `IllnessDetails`, `BoardingStatus`, `BoardingRemarks`, `DateCreated`, `DateApproved`, `UserId`) VALUES
	(1, 'gsdf', '65675456', 'ty', '2022-03-29', _binary 0x747279, 'try', 'try', NULL, 'try', 'yrty', 'rty', 'Requested', 'Pending admin approval', '2022-03-29 15:31:22', NULL, 5),
	(2, 'gsdf', '65675456', 'ty', '2022-03-29', _binary 0x747279, 'try', 'try', NULL, 'try', 'yrty', 'rty', 'Requested', 'Pending admin approval', '2022-03-29 15:31:43', NULL, 5),
	(3, 'gsdf', '65675456', 'ty', '2022-03-29', _binary 0x747279, 'try', 'try', NULL, 'try', 'yrty', 'rty', 'Requested', 'Pending admin approval', '2022-03-29 15:32:17', NULL, 5),
	(4, 'dsf', '768567567', 'ghjgf', '2022-03-29', _binary 0x66676A, 'fj', 'gjghj', 'assets/images/boarding/1648548235.jpg', 'ghj', 'jhg', 'jg', 'Rejected', 'Slot Full', '2022-03-29 15:33:55', '2022-03-29 17:14:30', 5),
	(5, 'dg', '5754645654645', 'ertert', '2022-04-02', _binary 0x6572747265, 'ret', 'ret', NULL, 'ret', 'tert', 'ter', 'Requested', 'Pending admin approval', '2022-04-02 16:14:35', NULL, 5);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All customer querries';

-- Dumping data for table pawsandfur.contact_master: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_master` DISABLE KEYS */;
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
  PRIMARY KEY (`CM_Id`),
  UNIQUE KEY `CustomerEmail` (`CustomerEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='All customer details';

-- Dumping data for table pawsandfur.customer_master: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer_master` DISABLE KEYS */;
INSERT INTO `customer_master` (`CM_Id`, `FullName`, `CustomerEmail`, `CustomerPhone`, `AddressLine1`, `AddressLine2`, `CustomerCity`, `Pincode`, `Landmark`, `CustomerState`, `CustomerCountry`, `Status`, `DateCreate`) VALUES
	(3, 'manoj', 'manu.mobile127@gmail.com', '8904653322', 'asf', 'sa', 'sadsaf', '43534534534534534534534', 'asfsaf', NULL, NULL, 0, '2022-02-21 17:14:48'),
	(5, 'as', 'test@gmail.com', '3333333333333', 'as', 'as', 'as', '222222', 'as', NULL, NULL, 1, '2022-02-23 22:49:56');
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
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `Remarks` text,
  `PaymentId` int(100) DEFAULT NULL,
  PRIMARY KEY (`ES_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.ecom_sales: ~26 rows (approximately)
/*!40000 ALTER TABLE `ecom_sales` DISABLE KEYS */;
INSERT INTO `ecom_sales` (`ES_Id`, `CustomerId`, `OrderId`, `Status`, `DateCreate`, `Remarks`, `PaymentId`) VALUES
	(1, 2, '1644998295620cae9716af6', 0, '2022-02-16 13:28:15', 'Order Initiated', 0),
	(2, 2, '1644998364620caedcaf023', 0, '2022-02-16 13:29:24', 'Order Initiated', 0),
	(3, 2, '1644998528620caf80aef24', 0, '2022-02-16 13:32:08', 'Order Initiated', 0),
	(4, 2, '1644999321620cb299dce07', 0, '2022-02-16 13:45:21', 'Order Initiated', 0),
	(5, 2, '1645023887620d128f06606', 0, '2022-02-16 20:34:47', 'Order Initiated', 0),
	(6, 2, '1645025138620d177259ae2', 0, '2022-02-16 20:55:38', 'Order Initiated', 0),
	(7, 2, '1645034032620d3a308120f', 0, '2022-02-16 23:23:52', 'Order Initiated', 0),
	(8, 2, '1645034322620d3b5219217', 0, '2022-02-16 23:28:42', 'Order Initiated', 0),
	(9, 2, '1645082308620df6c4e9bf8', 1, '2022-02-17 12:48:28', 'Order Initiated', 8),
	(10, 3, '16456013076215e21b04e2c', 0, '2022-02-23 12:58:27', 'Order Initiated', 0),
	(11, 3, '16456014526215E2AC2189F', 0, '2022-02-23 13:00:52', 'Order Initiated', 0),
	(12, 3, '16456016076215E347BC410', 0, '2022-02-23 13:03:27', 'Order Initiated', 0),
	(13, 3, '16456016826215E3926454D', 0, '2022-02-23 13:04:42', 'Order Initiated', 0),
	(14, 3, '16456026166215E7381153E', 0, '2022-02-23 13:20:16', 'Order Initiated', 0),
	(15, 3, '16456026476215E75710BAC', 0, '2022-02-23 13:20:47', 'Order Initiated', 0),
	(16, 3, '16456049596215F05FD413C', 1, '2022-02-23 13:59:19', 'Order Initiated', 12),
	(17, 3, '16456054736215F26160C13', 0, '2022-02-23 14:07:53', 'Order Initiated', 0),
	(18, 3, '1645627061621646B5E3FF8', 1, '2022-02-23 20:07:41', 'Order Initiated', 14),
	(19, 3, '164562933562164F9781599', 1, '2022-02-23 20:45:35', 'Order Initiated', 15),
	(20, 3, '1645635574621667F6F1990', 1, '2022-02-23 22:29:34', 'Order Shipped', 16),
	(21, 3, '164563561862166822394B7', 0, '2022-02-23 22:30:18', 'Order Failed', 0),
	(22, 5, '164563745462166F4EE5AEB', 1, '2022-02-23 23:00:54', 'Order Out for delivary', 18),
	(23, 5, '16456838376217247D7171A', 0, '2022-02-24 11:53:57', 'Order Initiated', 0),
	(24, 5, '16456868616217304D29CE6', 0, '2022-02-24 12:44:21', 'Order Failed', 0),
	(25, 5, '1646027889621C647138C10', 0, '2022-02-28 11:28:09', 'Order Initiated', 0),
	(26, 5, '1646242995621FACB3A4231', 1, '2022-03-02 23:13:15', 'Order Placed', 22),
	(27, 5, '1649228355624D3A43D438A', 0, '2022-04-06 12:29:15', 'Order Initiated', 0),
	(28, 5, '1649248191624D87BF7D1FC', 0, '2022-04-06 17:59:51', 'Order Initiated', 0),
	(29, 5, '1649248426624D88AA6D72A', 0, '2022-04-06 18:03:46', 'Order Initiated', 0),
	(30, 5, '1649248774624D8A061F614', 0, '2022-04-06 18:09:34', 'Order Initiated', 0),
	(31, 5, '1649266411624DCEEB075C1', 0, '2022-04-06 23:03:31', 'Order Initiated', 0),
	(32, 5, '1649266948624DD104673C7', 0, '2022-04-06 23:12:28', 'Order Initiated', 0),
	(33, 5, '1649270508624DDEECE5348', 0, '2022-04-07 00:11:48', 'Order Initiated', 0);
/*!40000 ALTER TABLE `ecom_sales` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.ecom_sales_temp
CREATE TABLE IF NOT EXISTS `ecom_sales_temp` (
  `EC_Id` int(100) NOT NULL AUTO_INCREMENT,
  `OrderId` varchar(50) DEFAULT NULL,
  `ProductId` int(100) DEFAULT NULL,
  `Quantity` double DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`EC_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.ecom_sales_temp: ~31 rows (approximately)
/*!40000 ALTER TABLE `ecom_sales_temp` DISABLE KEYS */;
INSERT INTO `ecom_sales_temp` (`EC_Id`, `OrderId`, `ProductId`, `Quantity`, `Status`, `DateCreate`) VALUES
	(1, '1644998295620cae9716af6', 18, 1, 1, '2022-02-16 13:28:15'),
	(2, '1644998364620caedcaf023', 18, 1, 1, '2022-02-16 13:29:24'),
	(3, '1644998528620caf80aef24', 18, 1, 1, '2022-02-16 13:32:08'),
	(4, '1644999321620cb299dce07', 18, 2, 1, '2022-02-16 13:45:21'),
	(5, '1644999321620cb299dce07', 17, 1, 1, '2022-02-16 13:45:21'),
	(6, '1645023887620d128f06606', 18, 1, 1, '2022-02-16 20:34:47'),
	(7, '1645025138620d177259ae2', 18, 1, 1, '2022-02-16 20:55:38'),
	(8, '1645034032620d3a308120f', 18, 1, 1, '2022-02-16 23:23:52'),
	(9, '1645034322620d3b5219217', 17, 1, 1, '2022-02-16 23:28:42'),
	(10, '1645082308620df6c4e9bf8', 18, 1, 1, '2022-02-17 12:48:29'),
	(11, '16456013076215e21b04e2c', 4, 1, 1, '2022-02-23 12:58:27'),
	(12, '16456013076215e21b04e2c', 6, 1, 1, '2022-02-23 12:58:27'),
	(13, '16456013076215e21b04e2c', 7, 1, 1, '2022-02-23 12:58:27'),
	(14, '16456013076215e21b04e2c', 5, 1, 1, '2022-02-23 12:58:27'),
	(15, '16456014526215E2AC2189F', 4, 2, 1, '2022-02-23 13:00:52'),
	(16, '16456014526215E2AC2189F', 7, 1, 1, '2022-02-23 13:00:52'),
	(17, '16456016076215E347BC410', 4, 1, 1, '2022-02-23 13:03:27'),
	(18, '16456016826215E3926454D', 4, 1, 1, '2022-02-23 13:04:42'),
	(19, '16456026166215E7381153E', 5, 1, 1, '2022-02-23 13:20:16'),
	(20, '16456026476215E75710BAC', 4, 1, 1, '2022-02-23 13:20:47'),
	(21, '16456049596215F05FD413C', 5, 1, 1, '2022-02-23 13:59:19'),
	(22, '16456054736215F26160C13', 4, 1, 1, '2022-02-23 14:07:53'),
	(23, '1645627061621646B5E3FF8', 5, 1, 1, '2022-02-23 20:07:42'),
	(24, '164562933562164F9781599', 4, 1, 1, '2022-02-23 20:45:35'),
	(25, '1645635574621667F6F1990', 5, 1, 1, '2022-02-23 22:29:35'),
	(26, '164563561862166822394B7', 4, 1, 1, '2022-02-23 22:30:18'),
	(27, '164563745462166F4EE5AEB', 4, 1, 1, '2022-02-23 23:00:54'),
	(28, '16456838376217247D7171A', 5, 1, 1, '2022-02-24 11:53:57'),
	(29, '16456868616217304D29CE6', 6, 1, 1, '2022-02-24 12:44:21'),
	(30, '1646027889621C647138C10', 5, 1, 1, '2022-02-28 11:28:09'),
	(31, '1646242995621FACB3A4231', 5, 1, 1, '2022-03-02 23:13:15'),
	(32, '1649228355624D3A43D438A', 6, 1, 1, '2022-04-06 12:29:15'),
	(33, '1649248191624D87BF7D1FC', 7, 1, 1, '2022-04-06 17:59:51'),
	(34, '1649248426624D88AA6D72A', 7, 1, 1, '2022-04-06 18:03:46'),
	(35, '1649248774624D8A061F614', 7, 1, 1, '2022-04-06 18:09:34'),
	(36, '1649266411624DCEEB075C1', 7, 1, 1, '2022-04-06 23:03:31'),
	(37, '1649266948624DD104673C7', 5, 1, 1, '2022-04-06 23:12:28'),
	(38, '1649270508624DDEECE5348', 5, 1, 1, '2022-04-07 00:11:48');
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
  `ServiceId` int(100) DEFAULT NULL,
  `UserId` int(100) DEFAULT NULL,
  PRIMARY KEY (`GR_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.grooming_request: ~7 rows (approximately)
/*!40000 ALTER TABLE `grooming_request` DISABLE KEYS */;
INSERT INTO `grooming_request` (`GR_Id`, `DateCreate`, `GroomingStatus`, `Remarks`, `UserName`, `UserPhone`, `UserAddress`, `AppointmentDate`, `ServiceId`, `UserId`) VALUES
	(1, '2022-04-04 17:03:24', 'Requested', 'Your request sent to admin.', 'sdf', '9876568694', 'asd', '2022-04-04', 1, NULL),
	(2, '2022-04-04 17:03:32', 'Requested', 'Your request sent to admin.', 'sdf', '9876568694', 'asd', '2022-04-04', 1, NULL),
	(3, '2022-04-04 17:03:48', 'Requested', 'Your request sent to admin.', 'sdf', '9876568694', 'asd', '2022-04-04', 1, NULL),
	(4, '2022-04-04 17:04:21', 'Requested', 'Your request sent to admin.', 'daas', '8888888888', 'sad', '2022-04-04', 1, NULL),
	(5, '2022-04-04 17:14:46', 'Requested', 'Your request sent to admin.', 'asff', '9876568694', 'sfdas', '2022-04-04', 2, NULL),
	(6, '2022-04-04 17:21:57', 'Requested', 'Your request sent to admin.', 'sa', '8904675675', 'df', '2022-04-04', 2, 5),
	(7, '2022-04-04 17:22:39', 'Requested', 'Your request sent to admin.', 'asd', '9876568694', 'das', '2022-04-04', 1, 5);
/*!40000 ALTER TABLE `grooming_request` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.login_master
CREATE TABLE IF NOT EXISTS `login_master` (
  `LM_Id` int(100) NOT NULL AUTO_INCREMENT,
  `UserEmail` varchar(100) DEFAULT NULL,
  `UserPassword` varchar(100) DEFAULT NULL,
  `UserRole` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`LM_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='All users login details';

-- Dumping data for table pawsandfur.login_master: ~3 rows (approximately)
/*!40000 ALTER TABLE `login_master` DISABLE KEYS */;
INSERT INTO `login_master` (`LM_Id`, `UserEmail`, `UserPassword`, `UserRole`) VALUES
	(5, 'saf@ads', 'ASqq123', 'Staff'),
	(6, 'manojkpajeer127@gmail.com', 'MAnoj143@@a', 'Admin'),
	(8, 'test@gmail.com', 'MAnoj143', 'Customer'),
	(10, 'fgh@sfd', 'Adsgs3123', 'Staff');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.payment_master: ~22 rows (approximately)
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
	(24, '1649270508624DDEECE5348', 'pi_3KldrpSEbPv1KY8x0IUMAb98', 'inr', 'Initiated', '2022-04-07 00:16:07', 500.000000, 5, 'requires_payment_method');
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
  PRIMARY KEY (`PM_Id`),
  UNIQUE KEY `ProductCode` (`ProductCode`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.product_master: ~5 rows (approximately)
/*!40000 ALTER TABLE `product_master` DISABLE KEYS */;
INSERT INTO `product_master` (`PM_Id`, `CategoryId`, `BrandId`, `ProductName`, `ProductCode`, `Image`, `Description`, `Price`, `Discount`, `GST`, `Status`, `DateCreate`, `Image1`, `Image2`, `Image3`, `ProductQuantity`) VALUES
	(4, 5, 8, 'Personalised Cushion', '1245124512', 'images/product/16455134916810.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1200.000000, 10, 18, 1, '2022-02-22 12:34:51', 'images/product/16455134913396.jpg', 'images/product/16455134915413.jpg', 'images/product/16455134917476.jpg', NULL),
	(5, 3, 9, 'Personalised Name Tag', '5874521452', 'images/product/16455135646820.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 500.000000, 0, 18, 1, '2022-02-22 12:36:05', 'images/product/16455135642315.jpg', 'images/product/16455135641877.jpg', 'images/product/16455135649919.jpg', NULL),
	(6, 4, 10, 'Bow Ties', '9854712541', 'images/product/16455136393478.jpg', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1900.000000, 25, 18, 1, '2022-02-22 12:37:19', 'images/product/16455136393316.jpg', 'images/product/16455136396323.jpg', 'images/product/16455136399028.jpg', NULL),
	(7, 6, 8, 'Maxi Breed Dry Food', '8547125412', 'images/product/16455201384240.jpg', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', 2500.000000, 10, 18, 1, '2022-02-22 14:25:38', 'images/product/16455201384955.jpg', 'images/product/16455201389849.jpg', 'images/product/16455201385024.jpg', NULL),
	(8, 3, 5, 'fs', 'asds', 'images/product/16493127312342.png', 'description', 43.000000, 0, 18, 1, '2022-04-07 11:55:31', 'images/product/16493127311774.webp', 'images/product/16493127318114.png', 'images/product/16493127319314.jpg', NULL),
	(9, 4, 6, 'saf', 'sdf', 'images/product/16493135134799.jpg', 'description', 100.000000, 0, 18, 1, '2022-04-07 12:08:33', 'images/product/16493135134799.jpg', 'images/product/16493135134799.jpg', 'images/product/16493135134799.jpg', '12'),
	(10, 5, 7, 'SAD', 'AD', 'images/product/16493153055654.jpg', 'DF', 122.000000, 0, 18, 1, '2022-04-07 12:38:25', 'images/product/16493153052868.webp', 'images/product/16493153051196.jpg', 'images/product/16493153059424.webp', '10');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COMMENT='sold products list';

-- Dumping data for table pawsandfur.sales_temp: ~8 rows (approximately)
/*!40000 ALTER TABLE `sales_temp` DISABLE KEYS */;
INSERT INTO `sales_temp` (`id`, `billno`, `product_id`, `quantity`, `date_created`, `status`) VALUES
	(34, '1640273969', 17, '1', '2021-12-23 21:09:54', 1),
	(36, '1640273971', 17, '2', '2021-12-23 21:11:06', 1),
	(37, '1640273971', 18, '1', '2021-12-23 21:11:12', 1),
	(38, '1640273971', 19, '5', '2021-12-23 21:11:16', 1),
	(46, '1640273974', 6, '1', '2022-03-15 22:49:11', 1),
	(47, '1640273975', 4, '2', '2022-03-15 23:20:52', 1),
	(48, '1640273975', 5, '1', '2022-03-15 23:20:58', 1),
	(49, '1640273976', 5, '2', '2022-03-15 23:21:14', 1),
	(50, '1640273977', 5, '2', '2022-03-15 23:44:22', 1);
/*!40000 ALTER TABLE `sales_temp` ENABLE KEYS */;

-- Dumping structure for table pawsandfur.service_type
CREATE TABLE IF NOT EXISTS `service_type` (
  `SR_Id` int(100) NOT NULL AUTO_INCREMENT,
  `ServiceName` varchar(100) DEFAULT NULL,
  `ServicePrice` decimal(20,2) DEFAULT NULL,
  `ServiceStatus` tinyint(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  PRIMARY KEY (`SR_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table pawsandfur.service_type: ~6 rows (approximately)
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` (`SR_Id`, `ServiceName`, `ServicePrice`, `ServiceStatus`, `DateCreate`) VALUES
	(1, 'Bath With Shampoo & Conditioner', 2500.00, 1, '2022-04-04 17:13:41'),
	(2, 'Nail Clipping', 250.00, 1, '2022-04-04 17:13:42'),
	(3, 'Ear Cleaning', 250.00, 1, '2022-04-04 17:13:43'),
	(4, 'Paw Massage', 300.00, 1, '2022-04-04 17:13:43'),
	(5, 'Combing/Brushing', 1500.00, 1, '2022-04-04 17:13:44'),
	(6, 'Hair Styling', 1000.00, 1, '2022-04-04 17:13:45'),
	(7, 'Hair Trimming', 500.00, 1, '2022-04-04 17:13:44');
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
