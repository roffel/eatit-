-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 07 nov 2014 om 18:41
-- Serverversie: 5.6.14
-- PHP-versie: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `eatit`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Drank`
--

CREATE TABLE IF NOT EXISTS `Drank` (
  `dranknr` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `prijs` decimal(2,0) DEFAULT NULL,
  `hoeveelheid` int(11) DEFAULT NULL,
  `eenheid` varchar(45) DEFAULT NULL,
  `voorraad` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dranknr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `Drank`
--

INSERT INTO `Drank` (`dranknr`, `naam`, `prijs`, `hoeveelheid`, `eenheid`, `voorraad`) VALUES
(1, 'Cola', '2', 1, 'blikje(s)', 80),
(2, 'Bier', '4', 6, 'blikje(s)', 604),
(3, 'Witte wijn', '5', 1, 'liter', 97),
(4, 'Rode wijn', '5', 1, 'liter', 99);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Gebruiker`
--

CREATE TABLE IF NOT EXISTS `Gebruiker` (
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `rang` enum('gebruiker','admin') NOT NULL,
  `actief` enum('ja','nee') DEFAULT 'nee',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `Gebruiker`
--

INSERT INTO `Gebruiker` (`email`, `password`, `rang`, `actief`) VALUES
('f.vd.gamma@gmail.com', 'ebdac6ad', 'gebruiker', 'ja'),
('inge@eatit.nl', 'test', 'admin', 'ja'),
('pietje123@hotmail.nl', 'e1cc6bc0', 'gebruiker', 'ja'),
('rutgerroffel@gmail.com', 'test', 'gebruiker', 'ja'),
('tim@eatit.nl', 'test', 'admin', 'ja');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Gerecht`
--

CREATE TABLE IF NOT EXISTS `Gerecht` (
  `gerechtnr` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `omschrijving` varchar(225) DEFAULT NULL,
  `soort` enum('vlees','vis','vegetarisch') DEFAULT NULL,
  PRIMARY KEY (`gerechtnr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `Gerecht`
--

INSERT INTO `Gerecht` (`gerechtnr`, `naam`, `omschrijving`, `soort`) VALUES
(1, 'Kip-appel schotel', 'Lekker kip met lekker appel hmm smullen echt lekker.', 'vlees'),
(2, 'Haring met ui', 'Haring met verse snippertjes ui. ', 'vis'),
(3, 'Ui salade', 'Salade met verschillende soorten ui. Er zit geen vlees in deze salade.', 'vegetarisch'),
(4, 'Vispizza', 'Pizza met vis en andere dingen.', 'vis'),
(5, 'Bakje patat', 'Patat in een bakje.', 'vegetarisch');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Gerechtmenu`
--

CREATE TABLE IF NOT EXISTS `Gerechtmenu` (
  `gerechtmenu` int(11) NOT NULL AUTO_INCREMENT,
  `menunr` int(11) DEFAULT NULL,
  `gerechtnr` int(11) DEFAULT NULL,
  PRIMARY KEY (`gerechtmenu`),
  KEY `menunr_idx` (`menunr`),
  KEY `gerechtnr_idx` (`gerechtnr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `Gerechtmenu`
--

INSERT INTO `Gerechtmenu` (`gerechtmenu`, `menunr`, `gerechtnr`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Ingredient`
--

CREATE TABLE IF NOT EXISTS `Ingredient` (
  `ingredientnr` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) DEFAULT NULL,
  `hoeveelheid` int(11) DEFAULT NULL,
  `eenheid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ingredientnr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `Ingredient`
--

INSERT INTO `Ingredient` (`ingredientnr`, `naam`, `hoeveelheid`, `eenheid`) VALUES
(1, 'Kip', 49800, 'gram'),
(2, 'Appel', 29, 'stuks'),
(3, 'Haring', 46, 'stuks'),
(4, 'Ui', 44, 'stuks'),
(5, 'Friet', 46, 'porties'),
(6, 'Scholfilet', 38, 'stuks'),
(7, 'Banaan', 34, 'stuks'),
(8, 'Komkommer', 13, 'stuks'),
(9, 'Appelmoes', 12, 'porties'),
(10, 'Tomatensaus', 34, 'porties'),
(11, 'Kaas', 46, 'porties');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Ingredientgerecht`
--

CREATE TABLE IF NOT EXISTS `Ingredientgerecht` (
  `idingredientgerecht` int(11) NOT NULL AUTO_INCREMENT,
  `gerechtnr` int(11) NOT NULL,
  `ingredientnr` int(11) NOT NULL,
  `hoeveelheid` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`idingredientgerecht`),
  KEY `gerechtnr_idx` (`gerechtnr`),
  KEY `ingredientnr_idx` (`ingredientnr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `Ingredientgerecht`
--

INSERT INTO `Ingredientgerecht` (`idingredientgerecht`, `gerechtnr`, `ingredientnr`, `hoeveelheid`) VALUES
(1, 1, 1, '99.99'),
(2, 1, 2, '3.00'),
(3, 2, 3, '1.00'),
(4, 2, 4, '1.00'),
(6, 3, 4, '2.00'),
(7, 4, 3, '1.00'),
(8, 4, 10, '1.00'),
(9, 4, 6, '1.00'),
(10, 4, 11, '1.00'),
(11, 5, 5, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Klant`
--

CREATE TABLE IF NOT EXISTS `Klant` (
  `klantnr` int(11) NOT NULL AUTO_INCREMENT,
  `achternaam` varchar(225) NOT NULL,
  `tussenvoegsel` varchar(45) DEFAULT NULL,
  `voornaam` varchar(225) NOT NULL,
  `adres` varchar(225) NOT NULL,
  `postcode` varchar(225) NOT NULL,
  `woonplaats` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `telefoon` varchar(13) NOT NULL,
  PRIMARY KEY (`klantnr`),
  KEY `email_idx` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `Klant`
--

INSERT INTO `Klant` (`klantnr`, `achternaam`, `tussenvoegsel`, `voornaam`, `adres`, `postcode`, `woonplaats`, `email`, `telefoon`) VALUES
(3, 'Gamma', 'van de', 'Freek', 'Weiland 13', '1234JK', 'Drachten', 'f.vd.gamma@gmail.com', '0900098321'),
(14, 'EatIT', '', 'Tim', 'Timstraat 13', '1543TM', 'Timmelonia', 'tim@eatit.nl', '2346210691'),
(15, 'Fransen', 'de', 'Piet', 'Dagobertlaan 99', '9977 RR', 'Duckstad', 'pietje123@hotmail.nl', '6830186739'),
(16, 'Roffel', '', 'Rutger', 'Molenhornstraat 31', '9671KS', 'Winschoten', 'rutgerroffel@gmail.com', '0643870046'),
(17, 'Eatit', 'van', 'Inge', 'Oude Ebbingestraat 12', '9429 GR', 'Groningen', 'inge@eatit.nl', '2952710581');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Menu`
--

CREATE TABLE IF NOT EXISTS `Menu` (
  `menunr` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `omschrijving` varchar(255) DEFAULT NULL,
  `prijs` decimal(8,2) NOT NULL,
  `actief` enum('ja','nee') DEFAULT 'nee',
  `soort` enum('Vis','Vlees','Vegetarisch') NOT NULL DEFAULT 'Vlees',
  `daghap` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menunr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `Menu`
--

INSERT INTO `Menu` (`menunr`, `naam`, `omschrijving`, `prijs`, `actief`, `soort`, `daghap`) VALUES
(1, 'Herfstmenu', 'Voor deze koude dagen is er een apart menu. ', '8.50', 'ja', 'Vlees', 1),
(2, 'Zeemenu', 'Menu met verse vis', '9.95', 'ja', 'Vis', 0),
(3, 'Sla met ui', 'Lekker sla met ui, geen vlees want dat is voor stoere mensen.', '6.35', 'ja', 'Vegetarisch', 0),
(4, 'Vispizza Deluxe', 'Menu met een vispizza, lekker als snelle hap.', '12.95', 'nee', 'Vis', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Order`
--

CREATE TABLE IF NOT EXISTS `Order` (
  `ordernr` int(11) NOT NULL AUTO_INCREMENT,
  `klantnr` int(11) NOT NULL,
  `tijd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('geplaatst','klaar','afgehandeld') NOT NULL DEFAULT 'geplaatst',
  PRIMARY KEY (`ordernr`),
  KEY `klantnr_idx` (`klantnr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `Order`
--

INSERT INTO `Order` (`ordernr`, `klantnr`, `tijd`, `status`) VALUES
(2, 15, '2014-11-07 09:50:47', 'klaar'),
(3, 3, '2014-11-07 09:57:07', 'geplaatst'),
(4, 16, '2014-11-07 10:46:18', 'geplaatst'),
(5, 16, '2014-11-07 14:21:07', 'geplaatst');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Orderregel`
--

CREATE TABLE IF NOT EXISTS `Orderregel` (
  `orderregelnr` int(11) NOT NULL AUTO_INCREMENT,
  `ordernr` int(11) NOT NULL,
  `menunr` int(11) DEFAULT NULL,
  `dranknr` int(11) DEFAULT NULL,
  `aantal` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`orderregelnr`),
  KEY `ordernr_idx` (`ordernr`),
  KEY `menunr_idx` (`menunr`),
  KEY `dranknr_idx` (`dranknr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `Orderregel`
--

INSERT INTO `Orderregel` (`orderregelnr`, `ordernr`, `menunr`, `dranknr`, `aantal`) VALUES
(3, 2, 1, NULL, 1),
(4, 2, NULL, 3, 1),
(5, 3, 3, NULL, 1),
(6, 3, NULL, 1, 2),
(7, 3, NULL, 2, 1),
(8, 4, 1, NULL, 1),
(9, 4, NULL, 4, 1),
(10, 5, 3, NULL, 1),
(11, 5, NULL, 2, 3);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `Gerechtmenu`
--
ALTER TABLE `Gerechtmenu`
  ADD CONSTRAINT `gerechtnr` FOREIGN KEY (`gerechtnr`) REFERENCES `Gerecht` (`gerechtnr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `menunr` FOREIGN KEY (`menunr`) REFERENCES `Menu` (`menunr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Ingredientgerecht`
--
ALTER TABLE `Ingredientgerecht`
  ADD CONSTRAINT `gerechtnr2` FOREIGN KEY (`gerechtnr`) REFERENCES `Gerecht` (`gerechtnr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ingredientnr` FOREIGN KEY (`ingredientnr`) REFERENCES `Ingredient` (`ingredientnr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Klant`
--
ALTER TABLE `Klant`
  ADD CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `Gebruiker` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `klantnr` FOREIGN KEY (`klantnr`) REFERENCES `Klant` (`klantnr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Orderregel`
--
ALTER TABLE `Orderregel`
  ADD CONSTRAINT `dranknr` FOREIGN KEY (`dranknr`) REFERENCES `Drank` (`dranknr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `menunr2` FOREIGN KEY (`menunr`) REFERENCES `Menu` (`menunr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ordernr` FOREIGN KEY (`ordernr`) REFERENCES `Order` (`ordernr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
