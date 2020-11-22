
CREATE USER 'account-api'@'%' IDENTIFIED BY 'password';
CREATE DATABASE IF NOT EXISTS `account-api`;
GRANT ALL PRIVILEGES ON `account-api`.* TO 'account-api'@'%';GRANT ALL PRIVILEGES ON `account-api\_%`.* TO 'account-api'@'%';
flush privileges;
