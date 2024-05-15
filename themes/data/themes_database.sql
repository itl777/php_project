create database themes_database;
use themes_database;

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

-- Branches table
CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    branch_name VARCHAR(20),
    branch_address VARCHAR(50),
    branch_phone VARCHAR(20),
    open_time VARCHAR(20),
    close_time VARCHAR(20),
    branch_status VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_modified_by VARCHAR(255),
    last_modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO branches (branch_name, branch_address, branch_phone,open_time, close_time, branch_status, last_modified_by)
VALUES 
('探秘-北分店', '台北市大安區永恆街4號3樓', '02-12345678', '09:00:00', '21:00:00', 'open', 'Admin'),
('探秘-中分店', '台中市三民區一中街27號5樓', '04-23456789', '09:00:00', '21:00:00', 'open', 'Admin'),
('探秘-南分店', '高雄市鳳山區四維路50號2樓', '06-34567890', '09:00:00', '21:00:00', 'open', 'Admin');

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    branch_id INT,
    theme_id INT,
    re_datetime DATETIME,
    participants INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
    theme_id INT
);

