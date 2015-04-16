CREATE TABLE `CAccounts` (
  `ID` int(11) NOT NULL,
  `Admin` int(11) NOT NULL,
  `Manager` int(11) NOT NULL,
  `O_Name` varchar(40) NOT NULL,
  `status` varchar(31) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`ID`),
  KEY `Admin` (`Admin`),
  KEY `Manager` (`Manager`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `User_Contact` (
  `CID` int(11) NOT NULL,
  `cName` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone` varchar(40) DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL,
  `Manager` tinyint(1) DEFAULT NULL,
  `Contact` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `Contact` (
  `AID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  PRIMARY KEY (`AID`,`CID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
