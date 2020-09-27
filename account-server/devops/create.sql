
CREATE USER 'account'@'%' IDENTIFIED BY 'kGzQEcR79sqrEz7xxChCWqherWXhZmUn';
CREATE DATABASE IF NOT EXISTS `account`;
GRANT ALL PRIVILEGES ON `account`.* TO 'account'@'%';GRANT ALL PRIVILEGES ON `account\_%`.* TO 'account'@'%';
flush privileges;
