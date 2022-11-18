CREATE TABLE `Usuari` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Nom` varchar(50),
  `Cognom` varchar(50),
  `DNI` varchar(50),
  `Telefon` varchar(50),
  `DataNaixement` datetime,
  `DataInscripcio` datetime,
  `NomUsuari` varchar(50) NOT NULL,
  `Contrasenya` varchar(255) NOT NULL,
  `HashRecuperacio` varchar(255),
  `CorreuElectronic` varchar(50) NOT NULL,
  `CorreuValidat` boolean,
  `Acceptat` boolean,
  `Verificat` boolean,
  `Bloquejat` boolean,
  `Biografia` varchar(500),
  `Web` varchar(500),
  `IdTipusUsuari` int NOT NULL,
  `HashCorreuValidar` varchar(64),
  `HashCanviContrasenya` varchar(64)
);

CREATE TABLE `Insignies` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL
);

CREATE TABLE `Insignies_Usuaris` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `IdUsuari` int NOT NULL,
  `IdInsignia` int NOT NULL
);

CREATE TABLE `TipusUsuari` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `TipusUsuari` varchar(50) NOT NULL
);

CREATE TABLE `Retweet` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Data` datetime NOT NULL,
  `IdPublicacio` int NOT NULL,
  `IdUsuari` int NOT NULL
);

CREATE TABLE `Publicacio` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `DataPublicacio` datetime NOT NULL,
  `Censurat` boolean,
  `IdPost` int NOT NULL,
  `IdComentari` int NOT NULL,
  `IdUsuari` int NOT NULL
);

CREATE TABLE `Topic` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Topic` varchar(50) NOT NULL,
  `Censurat` boolean
);

CREATE TABLE `Publicacio_Topic` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `IdPublicacio` int NOT NULL,
  `IdTopic` int NOT NULL
);

CREATE TABLE `Recurs` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `TipusRecurs` varchar(50) NOT NULL,
  `Referencia` varchar(100) NOT NULL,
  `IdComentari` varchar(50),
  `Censurat` boolean NOT NULL,
  `IdPublicacio` int NOT NULL
);

CREATE TABLE `Magrada` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Data` datetime,
  `IdPublicacio` int NOT NULL,
  `IdUsuari` int NOT NULL
);

CREATE TABLE `Notificacio` (
  `Id` int PRIMARY KEY NOT NULL,
  `Tipus` varchar(50) NOT NULL,
  `Censurat` boolean,
  `IdPublicacio` int NOT NULL,
  `IdRetweet` int NOT NULL,
  `IdUsuari` int NOT NULL,
  `IdMagrada` int NOT NULL
);

ALTER TABLE `Usuari` ADD FOREIGN KEY (`IdTipusUsuari`) REFERENCES `TipusUsuari` (`Id`);

ALTER TABLE `Insignies_Usuaris` ADD FOREIGN KEY (`IdUsuari`) REFERENCES `Usuari` (`Id`);

ALTER TABLE `Insignies_Usuaris` ADD FOREIGN KEY (`IdInsignia`) REFERENCES `Insignies` (`Id`);

ALTER TABLE `Retweet` ADD FOREIGN KEY (`IdPublicacio`) REFERENCES `Publicacio` (`Id`);

ALTER TABLE `Retweet` ADD FOREIGN KEY (`IdUsuari`) REFERENCES `Usuari` (`Id`);

ALTER TABLE `Publicacio` ADD FOREIGN KEY (`IdComentari`) REFERENCES `Publicacio` (`Id`);

ALTER TABLE `Publicacio` ADD FOREIGN KEY (`IdUsuari`) REFERENCES `Usuari` (`Id`);

ALTER TABLE `Publicacio_Topic` ADD FOREIGN KEY (`IdPublicacio`) REFERENCES `Publicacio` (`Id`);

ALTER TABLE `Publicacio_Topic` ADD FOREIGN KEY (`IdTopic`) REFERENCES `Topic` (`Id`);

ALTER TABLE `Recurs` ADD FOREIGN KEY (`IdPublicacio`) REFERENCES `Publicacio` (`Id`);

ALTER TABLE `Magrada` ADD FOREIGN KEY (`IdPublicacio`) REFERENCES `Publicacio` (`Id`);

ALTER TABLE `Magrada` ADD FOREIGN KEY (`IdUsuari`) REFERENCES `Usuari` (`Id`);

ALTER TABLE `Notificacio` ADD FOREIGN KEY (`IdPublicacio`) REFERENCES `Publicacio` (`Id`);

ALTER TABLE `Notificacio` ADD FOREIGN KEY (`IdRetweet`) REFERENCES `Retweet` (`Id`);

ALTER TABLE `Notificacio` ADD FOREIGN KEY (`IdUsuari`) REFERENCES `Usuari` (`Id`);

ALTER TABLE `Notificacio` ADD FOREIGN KEY (`IdMagrada`) REFERENCES `Magrada` (`Id`);