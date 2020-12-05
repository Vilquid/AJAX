DROP USER IF EXISTS 'ouahjax'@'%';
DROP DATABASE IF EXISTS ouahjax;
CREATE USER 'ouahjax'@'%' IDENTIFIED BY '';
CREATE DATABASE ouahjax CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON ouahjax.* TO 'ouahjax'@'%';