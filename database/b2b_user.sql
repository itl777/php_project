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