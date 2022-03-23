

CREATE DATABASE IF NOT EXISTS `schoolwhalesexe1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `schoolwhalesexe1`;



DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

