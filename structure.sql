CREATE TABLE Person (
  PersonId int AUTO_INCREMENT,
  FirstName VARCHAR(255),
  LastName VARCHAR(255),
  PRIMARY KEY(`PersonId`)  
);

CREATE TABLE `Tag` (
  `TagId` int AUTO_INCREMENT, 
  `Tag` VARCHAR(255),
  PRIMARY KEY(`TagId`)
);

CREATE TABLE `Quote` (
  `QuoteId` int AUTO_INCREMENT,
  `Quote` VARCHAR(255),
  `Year` CHAR(4),
  `PersonId` int,
  PRIMARY KEY(`QuoteId`),
  FOREIGN KEY (`PersonId`) REFERENCES `Person`(`PersonId`)
);

CREATE TABLE QuoteTag (
  `QuoteId` int,
  `TagId` int,
  PRIMARY KEY(`QuoteId`, `TagId`),
  FOREIGN KEY (`QuoteId`) REFERENCES `Quote`(`QuoteId`),
  FOREIGN KEY (`TagId`)   REFERENCES `Tag`(`TagId`)  
);