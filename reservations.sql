SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteRes` (IN `strNume` VARCHAR(256))  BEGIN
        DELETE FROM reservations WHERE name=strNume;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertRes` (IN `strNume` VARCHAR(256), IN `strEmail` VARCHAR(256), IN `phone` INT, IN `persons` INT, IN `strDate` VARCHAR(256), IN `strTime` VARCHAR(256), IN `strImage` VARCHAR(256))  BEGIN
        INSERT INTO reservations
        (name,email,phone,persons,date,time,image)
    VALUES (strNume, strEmail, phone, persons,strDate,strTime,strImage);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateRes` (IN `strNume` VARCHAR(256), IN `strEmail` VARCHAR(256), IN `phone` INT, IN `persons` INT, IN `strDate` VARCHAR(256), IN `strTime` VARCHAR(256))  BEGIN
        UPDATE reservations SET email=strEmail, phone=phone, persons=persons, date=strDate, time=strTime WHERE strNume=name;
    END$$

DELIMITER ;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` int(11) NOT NULL,
  `persons` int(11) NOT NULL,
  `date` varchar(256) NOT NULL,
  `time` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `persons`, `date`, `time`, `image`) VALUES
(29, 'VICTOR IORDACHE', 'victor.iordach@gmail.com', 2147483647, 33, '4/13/2020', '14:20pm', ''),
(34, 'VICTOR IORDACHE', 'victor.iordach@gmail.com', 2147483647, 33, '4/13/2020', '14:20pm', ''),
(38, 'Victor Iordache', 'yolohowy@gmail.com', 2147483647, 33, '4/13/2020', '12:00am', 'images/bd15ac0daf264ce96b1c54cb06d9392769157184_504129127056905_2176185870762115072_n.jpg'),
(39, '', '', 0, 0, '', '', 'images/1fe31475d5f8d8c0fd35e89199ec2f2eImage6.jpg');

DELIMITER $$
CREATE TRIGGER `MysqlTrigger1` BEFORE INSERT ON `reservations` FOR EACH ROW BEGIN
    INSERT INTO reservations_updated(nume,status,id,edtime) VALUES (NEW.name,'UPDATED',NULL,NOW());
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TriggerDelete` AFTER DELETE ON `reservations` FOR EACH ROW BEGIN
    INSERT INTO reservations_updated(nume,status,id,edtime) VALUES (OLD.name,'DELETED',NULL,NOW());
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TriggerUpdate` BEFORE UPDATE ON `reservations` FOR EACH ROW BEGIN
    SET NEW.name=UPPER(NEW.name);
    END
$$
DELIMITER ;

CREATE TABLE `reservations_updated` (
  `nume` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `id` int(11) NOT NULL,
  `edtime` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `reservations_updated` (`nume`, `status`, `id`, `edtime`) VALUES
('Victor Iordache', 'UPDATED', 1, '2020-04-25 16:08:40'),
('Cristian', 'UPDATED', 3, '2020-04-25 16:14:17'),
('Victor=', 'UPDATED', 4, '2020-04-25 16:46:36'),
('Victor=', 'DELETED', 5, '2020-04-25 16:58:19'),
('Victor Iordache', 'UPDATED', 6, '2020-04-25 17:24:24'),
('', 'UPDATED', 7, '2020-04-25 17:28:36');

ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservations_updated`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

ALTER TABLE `reservations_updated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
