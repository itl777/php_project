-- 商品管理
-- 商品頁面的表格們 

CREATE TABLE `product_management` (
`product_id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
`product_name` varchar(255),
`price` integer,
`product_img` varchar(255),
`summary` varchar(255),
`components` varchar(255),
`players` varchar(255),
`duration` integer,
`age` varchar(50),
`category_id` integer,
`status` varchar(255),
`created_at` datetime,
`last_modified_by` varchar(255),
`last_modified_at` datetime
);

CREATE TABLE `product_category` (
`category_id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
`category_name` varchar(255),
`created_at` datetime,
`last_modified_by` varchar(255),
`last_modified_at` datetime
);

CREATE TABLE `product_warehousing` (
`warehousing_id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
`product_id` integer,
`quantity` integer,
`warehousing_person` varchar(255),
`warehousing_date` datetime,
`created_at` datetime,
`last_modified_by` varchar(255),
`last_modified_at` datetime
);

CREATE TABLE `status` (
`status_id` integer PRIMARY KEY  NOT NULL AUTO_INCREMENT,
`status` varchar(50)
);

CREATE TABLE `coupon` (
`coupon_id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
`coupon_name` varchar(255),
`discount` float,
`category_id` integer,
`user_group` varchar(100),
`total_quantity` integer,
`expiry_date` datetime,
`created_at` datetime,
`last_modified_by` VARCHAR(50),
`last_modified_at` datetime
);




-- 表格資料
INSERT INTO `product_category` (`category_id`, `category_name`, `created_at`, `last_modified_by`, `last_modified_at`) VALUES
(NULL, '派對遊戲', '2024-05-12 17:38:54', '管理員', '2024-05-12 17:38:54'),
(NULL, '陣營遊戲', '2024-05-12 17:38:54', '管理員', '2024-05-12 17:38:54'),
(NULL, '策略遊戲', '2024-05-12 17:38:54', '管理員', '2024-05-12 17:38:54'),
(NULL, '兒童遊戲', '2024-05-12 17:38:54', '管理員', '2024-05-12 17:38:54'),
(NULL, '家庭遊戲', '2024-05-12 17:38:54', '管理員', '2024-05-12 17:38:54')
;


INSERT INTO `status` (`status_id`, `status`) VALUES (NULL, '上架'), (NULL, '下架');



INSERT INTO `coupon` (`coupon_id`, `coupon_name`, `discount`, `category_id`, `user_group`, `total_quantity`, `expiry_date`, `created_at`, `last_modified_by`, `last_modified_at`) 
VALUES 
(NULL, '母親節折扣', '0.6', '3', '一般會員', '100', '2024-05-13 01:24:14', '2024-05-13 01:24:14', '員工1', '2024-05-13 01:24:14'),
(NULL, '新年折扣', '0.5', '2', '一般會員', '30', '2024-05-13 01:24:14', '2024-05-13 01:24:14', '員2', '2024-05-13 01:24:14'),
(NULL, '中秋折扣', '0.8', '1', '一般會員', '500', '2024-05-13 01:24:14', '2024-05-13 01:24:14', '員3', '2024-05-13 01:24:14');


-- order-------------------------------------------------------------------------------
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `customer_order_id` varchar(255),
  `order_date` date,
  `member_id` int,
  `payment_method` enum('credit-card','line-pay'),
  `delivery_method` enum('home','7-11'),
  `order_district_id` int,
  `order_address` varchar(255),
  `recipient_name` varchar(255),
  `recipient_mobile` varchar(255),
  `member_carrier` int DEFAULT NULL,
  `recipient_invoice_carrier` varchar(50),
  `recipient_tax_id` varchar(50),
  `order_status_id` int NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_at` datetime DEFAULT NULL
);
ALTER TABLE orders
ADD FOREIGN KEY (member_id) REFERENCES users(user_id);

ALTER TABLE orders
ADD FOREIGN KEY (order_district_id) REFERENCES district(id);

ALTER TABLE orders
ADD FOREIGN KEY (order_status_id) REFERENCES order_status(id);



CREATE TABLE `order_status` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order_status_name` varchar(50) NOT NULL,
  `out_of_warehouse` int NOT NULL DEFAULT '1'
);



CREATE TABLE `order_details` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order_id` int NOT NULL,
  `order_product_id` int NOT NULL,
  `order_quantity` int NOT NULL,
  `order_unit_price` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_at` datetime DEFAULT NULL
);

ALTER TABLE order_details
ADD FOREIGN KEY (order_id) REFERENCES orders(id);

ALTER TABLE order_details
ADD FOREIGN KEY (order_product_id) REFERENCES product_management(product_id);


ALTER TABLE product_management
ADD FOREIGN KEY (category_id) REFERENCES product_category(category_id);

ALTER TABLE order_details
ADD UNIQUE INDEX idx_order_product_unique (order_id, order_product_id);



INSERT INTO `product_category`(`category_name`, `created_at`, `last_modified_at`) VALUES
('策略遊戲', NOW(), NOW()),
('家庭遊戲', NOW(), NOW()),
('卡牌遊戲', NOW(), NOW()),
('冒險遊戲', NOW(), NOW()),
('派對遊戲', NOW(), NOW());

INSERT INTO `product_warehousing`(`product_id`, `quantity`, `created_at`, `last_modified_at`) VALUES
(1, 24, NOW(), NOW()), (1, 78, NOW(), NOW()),
(2, 35, NOW(), NOW()), (2, 95, NOW(), NOW()),
(3, 40, NOW(), NOW()), (3, 85, NOW(), NOW()),
(4, 22, NOW(), NOW()), (4, 100, NOW(), NOW()),
(5, 45, NOW(), NOW()), (5, 55, NOW(), NOW()),
(6, 25, NOW(), NOW()), (6, 90, NOW(), NOW()),
(7, 50, NOW(), NOW()), (7, 60, NOW(), NOW()),
(8, 70, NOW(), NOW()), (8, 80, NOW(), NOW()),
(9, 20, NOW(), NOW()), (9, 30, NOW(), NOW()),
(10, 44, NOW(), NOW()), (10, 66, NOW(), NOW()),
(11, 29, NOW(), NOW()), (11, 99, NOW(), NOW()),
(12, 31, NOW(), NOW()), (12, 77, NOW(), NOW()),
(13, 33, NOW(), NOW()), (13, 88, NOW(), NOW()),
(14, 22, NOW(), NOW()), (14, 84, NOW(), NOW()),
(15, 21, NOW(), NOW()), (15, 91, NOW(), NOW()),
(16, 45, NOW(), NOW()), (16, 75, NOW(), NOW()),
(17, 50, NOW(), NOW()), (17, 65, NOW(), NOW()),
(18, 55, NOW(), NOW()), (18, 60, NOW(), NOW()),
(19, 35, NOW(), NOW()), (19, 95, NOW(), NOW()),
(20, 40, NOW(), NOW()), (20, 85, NOW(), NOW());


INSERT INTO `order_status`(`order_status_name`) VALUES
('待付款', 1),
('付款失敗', 0),
('已付款', 1),
('已取消', 0),
('理貨中', 1),
('已出貨', 1),
('配送中', 1),
('已收貨', 1),
('已完成', 1)



-- teams
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-05-15 02:42:22
-- 伺服器版本： 8.0.36
-- PHP 版本： 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- teams table Create
CREATE TABLE `teams` (
  `team_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `team_title` varchar(40) DEFAULT NULL,
  `leader_id` int NOT NULL,
  `team_limit` int NOT NULL,
  `tour` int NOT NULL,
  `create_at` datetime NOT NULL,
  `team_status` int NOT NULL DEFAULT(0),
  `team_display` int NOT NULL DEFAULT(1),
  `team_note` varchar(600) DEFAULT NULL,
  `last_modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- teams data----------------------------------------------------------------
INSERT INTO `teams` (`team_id`, `team_title`, `leader_id`, `team_limit`, `tour`, `create_at`, `last_modified_at`) VALUES
(1, '第一團', 2, 1, 3, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(2, '第二團', 5, 4, 3, '2024-05-10 14:47:18', '2024-05-13 09:12:08'),
(3, '第3團', 1, 3, 2, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(4, '第4團', 4, 3, 5, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(5, '第5團', 5, 2, 1, '2024-05-10 14:47:18', '2024-05-14 12:57:46'),
(6, '第6團', 4, 3, 6, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(7, '第7團', 7, 1, 5, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(8, '第8團', 8, 3, 8, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(9, '第9團', 4, 2, 2, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(10, '第10團', 9, 3, 11, '2024-05-10 14:47:18', '2024-05-10 14:47:18'),
(11, '勇氣之團', 10, 3, 3, '2024-05-13 09:10:14', '2024-05-13 09:10:14'),
(12, '我只是來打牌的', 9, 3, 5, '2024-05-13 09:14:26', '2024-05-13 09:14:26');

-- teams chat table
CREATE TABLE `teams_chats` (
  `chat_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `chat_at` int DEFAULT NULL,
  `chat_by` int DEFAULT NULL,
  `chat_text` varchar(200) DEFAULT NULL,
  `chat_display` int NOT NULL DEFAULT(1),
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `teams_chats` (`chat_id`, `chat_at`, `chat_by`, `chat_text`, `create_at`) VALUES
(1, 1, 5, '哈囉大家好我搶到第一團了', '2024-05-13 13:38:28'),
(2, 2, 5, '第二推', '2024-05-13 13:38:37'),
(3, 1, 7, '再測試一次', '2024-05-13 14:03:50'),
(4, 1, 8, '我也來測試看看', '2024-05-13 14:04:14'),
(5, 3, 4, '這團也測試看看', '2024-05-13 14:16:17'),
(6, 12, 8, '測試看看留言機能', '2024-05-14 10:30:19'),
(7, 12, 7, '測試', '2024-05-14 10:38:25'),
(8, 12, 2, '都在留言沒人要加', '2024-05-14 10:52:54'),
(9, 12, 3, 'ㄏㄏ', '2024-05-14 10:53:30'),
(10, 1, 3, '廣告廣告廣告', '2024-05-14 10:58:02'),
(11, 1, 10, '這團好熱鬧', '2024-05-14 10:58:49'),
(12, 5, 2, '我想加但沒空', '2024-05-14 11:31:24');

--

CREATE TABLE `teams_members` (
  `no` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `join_team_id` int DEFAULT NULL,
  `join_user_id` int DEFAULT NULL,
  `create_at` datetime DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `teams_members` (`join_team_id`, `join_user_id`, `create_at`) VALUES
(1, 3, '2024-05-13 15:14:49'),
(2, 1, '2024-05-13 15:14:49'),
(2, 8, '2024-05-13 15:14:49'),
(7, 12, '2024-05-13 15:14:49'),
(10, 7, '2024-05-13 15:14:49'),
(10, 9, '2024-05-13 15:14:49'),
(9, 5, '2024-05-13 15:14:49'),
(6, 1, '2024-05-13 15:14:49'),
(6, 2, '2024-05-13 15:14:49');

--

CREATE TABLE `teams_status` (
  `status_id` int NOT NULL PRIMARY KEY,
  `status_text` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `teams_status` (`status_id`, `status_text`) VALUES
(0, '募集中'),
(1, '已滿團'),
(2, '準備成團'),
(3, '已成團');

-- b2b_user---------------------------------------------------
INSERT INTO web_page (page_name)
VALUES
('users'),
('orders'),
('projects'),
('teams'),
('themes');

INSERT INTO roles (roles)
VALUES
('admin');

INSERT INTO link_roles_permission (roles_id,page_name,permission)
VALUES
(1,1,3),
(1,2,3),
(1,3,3),
(1,4,3),
(1,5,3);

INSERT INTO b2b_user (account,password,b2b_name,roles_id,b2b_user_status,created_at,last_modified_at)
VALUES('admin','$2y$10$VIEau.JS64xoeldwBXyxiuFC2Q1UF28zTAE9.G2V0H4Udyumit99.','管理員',1,1,NOW(),NOW());
-- users-------------------------------------------------------------------------------
CREATE TABLE city (
id INT AUTO_INCREMENT PRIMARY KEY,
city_name VARCHAR(20) NOT NULL);

INSERT INTO city(city_name) VALUES
('臺北市'),
('基隆市'),
('新北市'),
('宜蘭縣'),
('新竹市'),
('新竹縣'),
('桃園市'),
('苗栗縣'),
('臺中市'),
('彰化縣'),
('南投縣'),
('嘉義市'),
('嘉義縣'),
('雲林縣'),
('臺南市'),
('高雄市'),
('澎湖縣'),
('金門縣'),
('屏東縣'),
('臺東縣'),
('花蓮縣'),
('連江縣');


CREATE TABLE district (
id INT AUTO_INCREMENT PRIMARY KEY,
postal_codes INT,
district_name VARCHAR(20) NOT NULL,
city_id INT NOT NULL,
FOREIGN KEY (city_id) REFERENCES city(id));



INSERT INTO district(postal_codes,district_name,city_id) VALUE
(100,'中正區',1),
(103,'大同區',1),
(104,'中山區',1),
(105,'松山區',1),
(106,'大安區',1),
(108,'萬華區',1),
(110,'信義區',1),
(111,'士林區',1),
(112,'北投區',1),
(114,'內湖區',1),
(115,'南港區',1),
(116,'文山區',1),
(200,'仁愛區',2),
(201,'信義區',2),
(202,'中正區',2),
(203,'中山區',2),
(204,'安樂區',2),
(205,'暖暖區',2),
(206,'七堵區',2),
(207,'萬里區',3),
(208,'金山區',3),
(209,'南竿鄉',22),
(210,'北竿鄉',22),
(211,'莒光鄉',22),
(212,'東引鄉',22),
(220,'板橋區',3),
(221,'汐止區',3),
(222,'深坑區',3),
(223,'石碇區',3),
(224,'瑞芳區',3),
(226,'平溪區',3),
(227,'雙溪區',3),
(228,'貢寮區',3),
(231,'新店區',3),
(232,'坪林區',3),
(233,'烏來區',3),
(234,'永和區',3),
(235,'中和區',3),
(236,'土城區',3),
(237,'三峽區',3),
(238,'樹林區',3),
(239,'鶯歌區',3),
(241,'三重區',3),
(242,'新莊區',3),
(243,'泰山區',3),
(244,'林口區',3),
(247,'蘆洲區',3),
(248,'五股區',3),
(249,'八里區',3),
(251,'淡水區',3),
(252,'三芝區',3),
(253,'石門區',3),
(260,'宜蘭市',4),
(261,'頭城鎮',4),
(262,'礁溪鄉',4),
(263,'壯圍鄉',4),
(264,'員山鄉',4),
(265,'羅東鎮',4),
(266,'三星鄉',4),
(267,'大同鄉',4),
(268,'五結鄉',4),
(269,'冬山鄉',4),
(270,'蘇澳鎮',4),
(272,'南澳鄉',4),
(300,'新竹市',5),
(302,'竹北市',6),
(303,'湖口鄉',6),
(304,'新豐鄉',6),
(305,'新埔鎮',6),
(306,'關西鎮',6),
(307,'芎林鄉',6),
(308,'寶山鄉',6),
(310,'竹東鎮',6),
(311,'五峰鄉',6),
(312,'橫山鄉',6),
(313,'尖石鄉',6),
(314,'北埔鄉',6),
(315,'峨眉鄉',6),
(320,'中壢區',7),
(324,'平鎮區',7),
(325,'龍潭區',7),
(326,'楊梅區',7),
(327,'新屋區',7),
(328,'觀音區',7),
(330,'桃園區',7),
(333,'龜山區',7),
(334,'八德區',7),
(335,'大溪區',7),
(336,'復興區',7),
(337,'大園區',7),
(338,'蘆竹區',7),
(350,'竹南鎮',8),
(351,'頭份市',8),
(352,'三灣鄉',8),
(353,'南庄鄉',8),
(354,'獅潭鄉',8),
(356,'後龍鎮',8),
(357,'通霄鎮',8),
(358,'苑裡鎮',8),
(360,'苗栗市',8),
(361,'造橋鄉',8),
(362,'頭屋鄉',8),
(363,'公館鄉',8),
(364,'大湖鄉',8),
(365,'泰安鄉',8),
(366,'銅鑼鄉',8),
(367,'三義鄉',8),
(368,'西湖鄉',8),
(369,'卓蘭鎮',8),
(400,'中區',9),
(401,'東區',9),
(402,'南區',9),
(403,'西區',9),
(404,'北區',9),
(406,'北屯區',9),
(407,'西屯區',9),
(408,'南屯區',9),
(411,'太平區',9),
(412,'大里區',9),
(413,'霧峰區',9),
(414,'烏日區',9),
(420,'豐原區',9),
(421,'后里區',9),
(422,'石岡區',9),
(423,'東勢區',9),
(424,'和平區',9),
(426,'新社區',9),
(427,'潭子區',9),
(428,'大雅區',9),
(429,'神岡區',9),
(432,'大肚區',9),
(433,'沙鹿區',9),
(434,'龍井區',9),
(435,'梧棲區',9),
(436,'清水區',9),
(437,'大甲區',9),
(438,'外埔區',9),
(439,'大安區',9),
(500,'彰化市',10),
(502,'芬園鄉',10),
(503,'花壇鄉',10),
(504,'秀水鄉',10),
(505,'鹿港鎮',10),
(506,'福興鄉',10),
(507,'線西鄉',10),
(508,'和美鎮',10),
(509,'伸港鄉',10),
(510,'員林市',10),
(511,'社頭鄉',10),
(512,'永靖鄉',10),
(513,'埔心鄉',10),
(514,'溪湖鎮',10),
(515,'大村鄉',10),
(516,'埔鹽鄉',10),
(520,'田中鎮',10),
(521,'北斗鎮',10),
(522,'田尾鄉',10),
(523,'埤頭鄉',10),
(524,'溪州鄉',10),
(525,'竹塘鄉',10),
(526,'二林鎮',10),
(527,'大城鄉',10),
(528,'芳苑鄉',10),
(530,'二水鄉',10),
(540,'南投市',11),
(541,'中寮鄉',11),
(542,'草屯鎮',11),
(544,'國姓鄉',11),
(545,'埔里鎮',11),
(546,'仁愛鄉',11),
(551,'名間鄉',11),
(552,'集集鎮',11),
(553,'水里鄉',11),
(555,'魚池鄉',11),
(556,'信義鄉',11),
(557,'竹山鎮',11),
(558,'鹿谷鄉',11),
(600,'嘉義市',12),
(602,'番路鄉',13),
(603,'梅山鄉',13),
(604,'竹崎鄉',13),
(605,'阿里山鄉',13),
(606,'中埔鄉',13),
(607,'大埔鄉',13),
(608,'水上鄉',13),
(611,'鹿草鄉',13),
(612,'太保市',13),
(613,'朴子市',13),
(614,'東石鄉',13),
(615,'六腳鄉',13),
(616,'新港鄉',13),
(621,'民雄鄉',13),
(622,'大林鎮',13),
(623,'溪口鄉',13),
(624,'義竹鄉',13),
(625,'布袋鎮',13),
(630,'斗南鎮',14),
(631,'大埤鄉',14),
(632,'虎尾鎮',14),
(633,'土庫鎮',14),
(634,'褒忠鄉',14),
(635,'東勢鄉',14),
(636,'臺西鄉',14),
(637,'崙背鄉',14),
(638,'麥寮鄉',14),
(640,'斗六市',14),
(643,'林內鄉',14),
(646,'古坑鄉',14),
(647,'莿桐鄉',14),
(648,'西螺鎮',14),
(649,'二崙鄉',14),
(651,'北港鎮',14),
(652,'水林鄉',14),
(653,'口湖鄉',14),
(654,'四湖鄉',14),
(655,'元長鄉',14),
(700,'中西區',15),
(701,'東區',15),
(702,'南區',15),
(704,'北區',15),
(708,'安平區',15),
(709,'安南區',15),
(710,'永康區',15),
(711,'歸仁區',15),
(712,'新化區',15),
(713,'左鎮區',15),
(714,'玉井區',15),
(715,'楠西區',15),
(716,'南化區',15),
(717,'仁德區',15),
(718,'關廟區',15),
(719,'龍崎區',15),
(720,'官田區',15),
(721,'麻豆區',15),
(722,'佳里區',15),
(723,'西港區',15),
(724,'七股區',15),
(725,'將軍區',15),
(726,'學甲區',15),
(727,'北門區',15),
(730,'新營區',15),
(731,'後壁區',15),
(732,'白河區',15),
(733,'東山區',15),
(734,'六甲區',15),
(735,'下營區',15),
(736,'柳營區',15),
(737,'鹽水區',15),
(741,'善化區',15),
(742,'大內區',15),
(743,'山上區',15),
(744,'新市區',15),
(745,'安定區',15),
(800,'新興區',16),
(801,'前金區',16),
(802,'苓雅區',16),
(803,'鹽埕區',16),
(804,'鼓山區',16),
(805,'旗津區',16),
(806,'前鎮區',16),
(807,'三民區',16),
(811,'楠梓區',16),
(812,'小港區',16),
(813,'左營區',16),
(814,'仁武區',16),
(815,'大社區',16),
(817,'東沙群島',16),
(819,'南沙群島',16),
(820,'岡山區',16),
(821,'路竹區',16),
(822,'阿蓮區',16),
(823,'田寮區',16),
(824,'燕巢區',16),
(825,'橋頭區',16),
(826,'梓官區',16),
(827,'彌陀區',16),
(828,'永安區',16),
(829,'湖內區',16),
(830,'鳳山區',16),
(831,'大寮區',16),
(832,'林園區',16),
(833,'鳥松區',16),
(840,'大樹區',16),
(842,'旗山區',16),
(843,'美濃區',16),
(844,'六龜區',16),
(845,'內門區',16),
(846,'杉林區',16),
(847,'甲仙區',16),
(848,'桃源區',16),
(849,'那瑪夏區',16),
(851,'茂林區',16),
(852,'茄萣區',16),
(880,'馬公市',17),
(881,'西嶼鄉',17),
(882,'望安鄉',17),
(883,'七美鄉',17),
(884,'白沙鄉',17),
(885,'湖西鄉',17),
(890,'金沙鎮',18),
(891,'金湖鎮',18),
(892,'金寧鄉',18),
(893,'金城鎮',18),
(894,'烈嶼鄉',18),
(896,'烏坵鄉',18),
(900,'屏東市',19),
(901,'三地門鄉',19),
(902,'霧臺鄉',19),
(903,'瑪家鄉',19),
(904,'九如鄉',19),
(905,'里港鄉',19),
(906,'高樹鄉',19),
(907,'鹽埔鄉',19),
(908,'長治鄉',19),
(909,'麟洛鄉',19),
(911,'竹田鄉',19),
(912,'內埔鄉',19),
(913,'萬丹鄉',19),
(920,'潮州鎮',19),
(921,'泰武鄉',19),
(922,'來義鄉',19),
(923,'萬巒鄉',19),
(924,'崁頂鄉',19),
(925,'新埤鄉',19),
(926,'南州鄉',19),
(927,'林邊鄉',19),
(928,'東港鎮',19),
(929,'琉球鄉',19),
(931,'佳冬鄉',19),
(932,'新園鄉',19),
(940,'枋寮鄉',19),
(941,'枋山鄉',19),
(942,'春日鄉',19),
(943,'獅子鄉',19),
(944,'車城鄉',19),
(945,'牡丹鄉',19),
(946,'恆春鎮',19),
(947,'滿州鄉',19),
(950,'臺東市',20),
(951,'綠島鄉',20),
(952,'蘭嶼鄉',20),
(953,'延平鄉',20),
(954,'卑南鄉',20),
(955,'鹿野鄉',20),
(956,'關山鎮',20),
(957,'海端鄉',20),
(958,'池上鄉',20),
(959,'東河鄉',20),
(961,'成功鎮',20),
(962,'長濱鄉',20),
(963,'太麻里鄉',20),
(964,'金峰鄉',20),
(965,'大武鄉',20),
(966,'達仁鄉',20),
(970,'花蓮市',21),
(971,'新城鄉',21),
(972,'秀林鄉',21),
(973,'吉安鄉',21),
(974,'壽豐鄉',21),
(975,'鳳林鎮',21),
(976,'光復鄉',21),
(977,'豐濱鄉',21),
(978,'瑞穗鄉',21),
(979,'萬榮鄉',21),
(981,'玉里鎮',21),
(982,'卓溪鄉',21),
(983,'富里鄉',21);


CREATE Table roles (
id INT AUTO_INCREMENT PRIMARY KEY ,
roles VARCHAR(20) NOT NULL);


CREATE Table web_page (
id INT AUTO_INCREMENT PRIMARY KEY ,
page_name VARCHAR(20) NOT NULL);


CREATE Table link_roles_permission (
id INT AUTO_INCREMENT PRIMARY KEY ,
roles_id INT NOT NULL,
page_name INT NOT NULL,
permission CHAR(1) NOT NULL,
FOREIGN KEY (roles_id) REFERENCES roles(id),
FOREIGN KEY (page_name) REFERENCES web_page(id));




CREATE TABLE store (
id INT AUTO_INCREMENT PRIMARY KEY,
store VARCHAR(20) NOT NULL,
address VARCHAR(100) NOT NULL,
phone CHAR(10) NOT NULL,
picture VARCHAR(100) NOT NULL,
open TIME NOT NULL,
close TIME NOT NULL,
notice VARCHAR(100),
store_status CHAR(1) NOT NULL,
created_at DATETIME NOT NULL DEFAULT now(),
last_modified_at DATETIME,
last_modified_by VARCHAR(20));


CREATE Table b2b_user (
b2b_id INT AUTO_INCREMENT PRIMARY KEY,
account CHAR(10) NOT NULL UNIQUE KEY,
password VARCHAR(255) NOT NULL,
b2b_name VARCHAR(20) NOT NULL,
roles_id INT,
b2b_user_status CHAR(1) NOT NULL ,
created_at DATETIME NOT NULL,
last_modified_at DATETIME,
last_modified_by INT,
FOREIGN KEY (roles_id) REFERENCES roles(id));


CREATE TABLE users (
user_id INT AUTO_INCREMENT PRIMARY KEY ,
account VARCHAR(100) NOT NULL UNIQUE KEY ,
password VARCHAR(255) NOT NULL ,
name VARCHAR(20) NOT NULL ,
nick_name VARCHAR(50) NOT NULL ,
gender CHAR(1) ,
birthday DATE ,
mobile_phone CHAR(10) ,
invoice_carrier_id CHAR(8) ,
tax_id CHAR(8),
avatar VARCHAR(100),
note VARCHAR(200),
user_status CHAR(1),
blacklist CHAR(1),
created_at DATETIME NOT NULL DEFAULT now() ,
last_modified_at DATETIME,
last_modified_by INT);


CREATE TABLE address (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
district_id INT NOT NULL,
address VARCHAR(100) NOT NULL,
recipient_name VARCHAR(20) NOT NULL,
mobile_phone CHAR(10) NOT NULL,
type CHAR(1),
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (district_id) REFERENCES district(id));


-- 行程-----------------------------------------------------------------------------------



-- Themes table
CREATE TABLE themes (
    theme_id INT auto_increment PRIMARY KEY,
    theme_name VARCHAR(20),
    start_time VARCHAR(10),
    end_time VARCHAR(10),
    theme_time VARCHAR(10),
    intervals VARCHAR(10),
    theme_desc VARCHAR(250),
    difficulty INT,
    suitable_players VARCHAR(10),
    theme_img VARCHAR(255),
    price VARCHAR(10),
    start_date DATE,
    end_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_modified_by VARCHAR(255),
    last_modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO themes (theme_name, start_time, end_time, theme_time, intervals, theme_desc, difficulty, suitable_players, theme_img, price, start_date, end_date)
VALUES 
('尋找失落的寶藏', '09:00:00', '10:30:00', 90, 30, '在古老的山洞中尋找失落的寶藏，需要解開謎題才能找到寶藏。', 3, '3~5人', 'treasure_hunt.jpg', 500, '2024-05-01', '2025-05-01'),
('失落的實驗室', '09:00:00', '10:30:00', 90, 30, '在一個被遺棄的實驗室中尋找失踪的科學家和他的實驗。', 4, '4~6人', 'lab_escape.jpg', 600, '2024-06-01', '2025-06-01'),
('進擊的巨人', '09:00:00', '10:00:00', 60, 30, '面對巨型巨人的進擊，找到一個逃脫的方法。', 5, '3~5人', 'giant_attack.jpg', 700, '2024-07-01', '2025-07-01'),
('古堡迷宮', '09:00:00', '10:30:00', 90, 60, '在一個古堡迷宮中找到出口，但要小心不要被怪物吃掉。', 3, '4~6人', 'castle_maze.jpg', 550, '2024-08-01', '2025-08-01'),
('海底之旅', '09:00:00', '10:30:00', 90, 60, '在海底世界中探險，找到失落的寶藏並逃脫。', 4, '5~8人', 'underwater_adventure.jpg', 600, '2024-09-01', '2025-09-01'),
('未來之城', '09:00:00', '10:30:00', 60, 30, '探索一個科技發達的未來城市，解開它的種種謎題。', 5, '4~6人', 'future_city.jpg', 700, '2024-10-01', '2025-10-01'),
('迷失之森', '09:00:00', '10:30:00', 90, 60, '在一片神秘的森林中迷路，找到回家的路。', 3, '3~5人', 'lost_forest.jpg', 550, '2024-11-01', '2025-11-01'),
('幽靈屋', '09:00:00', '10:30:00', 60, 30, '在一間幽靈屋中解開它的魔咒，找到出口。', 4, '5~8人', 'haunted_house.jpg', 600, '2024-12-01', '2025-12-01'),
('星際探險', '09:00:00', '10:30:00', 90, 60, '在太空船上進行一次星際探險，找到失踪的船員和他們的秘密。', 5, '4~6人', 'space_exploration.jpg', 600, '2025-01-01', '2026-01-01'),
('失落的實驗室', '09:00:00', '10:30:00', 90, 30, '在一個神秘的實驗室中尋找脫逃的方法，記住，時間是有限的！', 4, '5~8人', 'ultimate_challenge.jpg', 600, '2025-02-01', '2026-02-01');

-- Branches table--------------------------------------------------------------
CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    branch_name VARCHAR(20),
    theme_id INT,
    branch_address VARCHAR(50),
    branch_phone VARCHAR(20),
    branch_img VARCHAR(255),
    open_time VARCHAR(20),
    close_time VARCHAR(20),
    branch_status VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_modified_by VARCHAR(255),
    last_modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (theme_id) REFERENCES themes(theme_id)
);

INSERT INTO branches (branch_name, branch_address, branch_phone, branch_img, open_time, close_time, branch_status, last_modified_by)
VALUES 
('探秘-北分店', '台北市大安區永恆街4號3樓', '02-12345678', 'branch_north.jpg', '09:00:00', '21:00:00', 'open', 'Admin'),
('探秘-中分店', '台中市三民區一中街27號5樓', '04-23456789', 'branch_central.jpg', '09:00:00', '21:00:00', 'open', 'Admin'),
('探秘-南分店', '高雄市鳳山區四維路50號2樓', '06-34567890', 'branch_south.jpg', '09:00:00', '21:00:00', 'open', 'Admin');

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    branch_id INT,
    theme_id INT,
    re_datetime DATETIME,
    participants INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (branch_id) REFERENCES branches(id),
    FOREIGN KEY (theme_id) REFERENCES themes(theme_id)
);
-- FOREIGN KEY (user_id) REFERENCES users(user_id),

INSERT INTO reservations (branch_id, theme_id, re_datetime, participants)
VALUES 
(1, 1, '2024-05-11 09:00:00', 4),
(2, 2, '2024-05-12 09:30:00', 5),
(3, 3, '2024-05-13 10:00:00', 3),
(1, 4, '2024-05-14 10:30:00', 6),
(2, 5, '2024-05-15 11:00:00', 7),
(3, 6, '2024-05-16 11:30:00', 4),
(2, 7, '2024-05-17 12:00:00', 5),
(1, 8, '2024-05-18 12:30:00', 8),
(2, 9, '2024-05-19 13:00:00', 3),
(1, 10, '2024-05-20 13:30:00', 6),
(1, 2, '2024-05-21 09:00:00', 4),
(2, 3, '2024-05-22 09:30:00', 5),
(3, 4, '2024-05-23 10:00:00', 3),
(2, 5, '2024-05-24 10:30:00', 6),
(1, 6, '2024-05-25 11:00:00', 7),
(2, 7, '2024-05-26 11:30:00', 4),
(2, 8, '2024-05-27 12:00:00', 5),
(3, 9, '2024-05-28 12:30:00', 8),
(1, 10, '2024-05-29 13:00:00', 3),
(3, 1, '2024-05-30 13:30:00', 6);

CREATE TABLE branch_themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    branch_id INT,
    theme_id INT,
    FOREIGN KEY (branch_id) REFERENCES branches(id),
    FOREIGN KEY (theme_id) REFERENCES themes(theme_id)
);
