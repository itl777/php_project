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



-- ALTER TABLE `product_category` ADD FOREIGN KEY (`category_id`) REFERENCES `product_management` (`category_id`);
-- ALTER TABLE `product_warehousing` ADD FOREIGN KEY (`product_id`) REFERENCES `product_management` (`product_id`);


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