
 CREATE TABLE `users` (  
 `ID` int NOT NULL AUTO_INCREMENT,
   `firstname` varchar(45) NOT NULL,
    `lastname` varchar(45) NOT NULL,
    `dob` date NOT NULL,
    `gender` varchar(45) NOT NULL,
    `mobile` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `password` varchar(255) NOT NULL,
    `address` varchar(45) NOT NULL,
    `city` varchar(45) NOT NULL,
    `country` varchar(45) NOT NULL,
    `is_admin` varchar(45) NOT NULL DEFAULT 0,
    PRIMARY KEY (`ID`),
    UNIQUE KEY `ID_UNIQUE` (`ID`),
    UNIQUE KEY `email_UNIQUE` (`email`),
    UNIQUE KEY `mobile_UNIQUE` (`mobile`)) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

# Table	Create Table
CREATE TABLE `appointment` (
  `idappointment` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `category` varchar(45) NOT NULL,
  `comment` text,
  PRIMARY KEY (`idappointment`),
  UNIQUE KEY `idappointment_UNIQUE` (`idappointment`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci



# Table	Create Table
CREATE TABLE `rating` (
  `idrating` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `rating` varchar(45) NOT NULL,
  PRIMARY KEY (`idrating`),
  KEY `email_idx` (`email`),
  CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

