-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Apr 2015 um 19:53
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `game`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boardobjects`
--

CREATE TABLE IF NOT EXISTS `boardobjects` (
  `id` varchar(10) NOT NULL,
  `field` varchar(11) NOT NULL,
  `player` varchar(10) NOT NULL,
  `game` varchar(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `move` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `weaponattack` int(11) NOT NULL,
  `armor` int(11) NOT NULL,
  `live` int(11) NOT NULL,
  `maxlive` int(11) NOT NULL,
  `rangedattack` varchar(15) NOT NULL,
  `firststrike` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `boardobjects`
--

INSERT INTO `boardobjects` (`id`, `field`, `player`, `game`, `name`, `move`, `attack`, `weaponattack`, `armor`, `live`, `maxlive`, `rangedattack`, `firststrike`) VALUES
('aBTkNRO1y7', '13*6', '2', 'testgame', 'LEADER', 20, 2, 0, 2, 20, 20, '', ''),
('mIAktyiQmr', '3*6', '1', 'testgame', 'LEADER', 20, 2, 0, 2, 20, 20, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `effects`
--

CREATE TABLE IF NOT EXISTS `effects` (
  `id` varchar(10) NOT NULL,
  `effect` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `target_object` varchar(10) NOT NULL,
  `target_player` varchar(10) NOT NULL,
  `target_field` varchar(11) NOT NULL,
  `start_round` int(11) NOT NULL,
  `end_round` int(11) NOT NULL,
  `game` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fieldowner`
--

CREATE TABLE IF NOT EXISTS `fieldowner` (
  `id` varchar(10) NOT NULL,
  `field` varchar(11) NOT NULL,
  `player` varchar(10) NOT NULL,
  `game` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `fieldowner`
--

INSERT INTO `fieldowner` (`id`, `field`, `player`, `game`) VALUES
('r5P26fBzNN', '14*6', '2', 'testgame'),
('OTNPKxBUA3', '12*6', '2', 'testgame'),
('a1r91fldCM', '13*7', '2', 'testgame'),
('KLNWovKlbY', '13*5', '2', 'testgame'),
('TydLOFJROu', '14*7', '2', 'testgame'),
('VzsrejXd2r', '14*5', '2', 'testgame'),
('mdD3nc370v', '12*7', '2', 'testgame'),
('N9JlOwMGAj', '12*5', '2', 'testgame'),
('TbeKwsIBXM', '4*6', '1', 'testgame'),
('Ig2QiCqYZE', '2*6', '1', 'testgame'),
('2Vmlcx4dUK', '3*7', '1', 'testgame'),
('45QHmUdKEH', '3*5', '1', 'testgame'),
('t3nl2HQV5m', '4*7', '1', 'testgame'),
('VSTnoVs4pU', '4*5', '1', 'testgame'),
('2v1350SxTL', '2*7', '1', 'testgame'),
('VmnAxuAUdt', '2*5', '1', 'testgame'),
('XQwOZXEfmj', '13*6', '2', 'testgame'),
('04M1zP3hPV', '3*6', '1', 'testgame');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gamevars`
--

CREATE TABLE IF NOT EXISTS `gamevars` (
  `id` varchar(10) NOT NULL,
  `player` varchar(250) NOT NULL,
  `variable` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `game` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `gamevars`
--

INSERT INTO `gamevars` (`id`, `player`, `variable`, `value`, `game`) VALUES
('FbIyKlAH1f', 'game', 'round', '1', ''),
('cSNkDFx19Y', '1', 'selected', 'board*3*6', 'testgame'),
('EmeDpXB79D', '2', 'buildpointsrefresh', '99100', 'testgame'),
('updjjdpSe9', '2', 'maxbuildpoints', '99191', 'testgame'),
('IEv0L7Rk9M', '2', 'buildpoints', '9941', 'testgame'),
('1mmCa73sJ7', '1', 'buildpointsrefresh', '99100', 'testgame'),
('VDFJiyaVN4', '1', 'maxbuildpoints', '99191', 'testgame'),
('R9EXyMwxpW', '1', 'buildpoints', '9991', 'testgame'),
('Ql9UJEps3n', 'game', 'round', '1', 'testgame');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inventionbase`
--

CREATE TABLE IF NOT EXISTS `inventionbase` (
  `id` varchar(10) NOT NULL,
  `base1` varchar(10) NOT NULL,
  `base2` varchar(10) NOT NULL,
  `result` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `inventionbase`
--

INSERT INTO `inventionbase` (`id`, `base1`, `base2`, `result`) VALUES
('07h1t9ilFQ', 'WIND', 'CLOUD', 'STORM'),
('1GhTXkcLFW', 'RAIN', 'EARTH', 'MUD'),
('21UB4uTBzZ', 'AIR', 'STONE', 'STONETHROW'),
('362GYt7YPH', 'FIRE', 'CLOUD', 'STORM'),
('46Jy3L1ErS', 'WATER', 'WATER', 'LAKE'),
('4nyRR0tIWt', 'LAKE', 'STONE', 'WAVES'),
('6Y079dLxcr', 'STONE', 'STONE', 'SAND'),
('7VcH2H6G9Y', 'FLOWER', 'FLOWER', 'GARDEN'),
('88uXjdepzQ', 'TOWER', 'CASTLE', 'FORTRESS'),
('amAta0At6c', 'LAKE', 'LAKE', 'OCEAN'),
('B1GGqf3NZP', 'LAKE', 'FLOWER', 'WATERLILY'),
('BggBKXYWtK', 'SUN', 'SKY', 'DAY'),
('C37V3J5ruF', 'AMBOS', 'IRON', 'SWORD'),
('D0XKrLFJJg', 'HOUSE', 'AMBOS', 'FORGE'),
('DG7hJ9mykM', 'SUN', 'PLANT', 'FLOWER'),
('dy0VNFZhjs', 'IRON', 'IRON', 'AMBOS'),
('dY44PwH1g7', 'LAKE', 'EARTH', 'ISLAND'),
('efc8ZixExQ', 'AIR', 'FIRE', 'EXPLOSION'),
('Fhu3WKIpwh', 'STORM', 'AIR', 'WIND'),
('HVl0DDmswX', 'HILL', 'HILL', 'MOUNTAIN'),
('I2SQNgtxC2', 'METEOR', 'FIRE', 'COMET'),
('IiXnD6bgtP', 'SUN', 'IRON', 'GOLD'),
('IVtY4gTcEg', 'SKY', 'WATER', 'CLOUD'),
('jizaFRJ0un', 'WALL', 'HOUSE', 'VILLAGE'),
('KK0HSwiblu', 'EARTH', 'WATER', 'MUD'),
('L4spfbrHfS', 'TOWER', 'WALL', 'CASTLE'),
('L9H0hAxxwW', 'EARTH', 'EARTH', 'PLAINS'),
('lQrJnVO3A1', 'FIRE', 'FIRE', 'FIREBALL'),
('m9Tfo3s1j5', 'FIRE', 'IRON', 'SWORD'),
('mfmhfmfmfo', 'CLAY', 'FLOWER', 'VASE'),
('Mndm5TIdwx', 'TREE', 'TREE', 'FOREST'),
('NdX5tO3W88', 'HOLE', 'HILL', 'CAVE'),
('nogFUZcIAk', 'WALL', 'PLANT', 'IVY'),
('Ny70PRFPVN', 'GOLD', 'IRON', 'SILVER'),
('o1PNLSft08', 'FIRE', 'WATER', 'FOG'),
('O6m7WDUWb0', 'MUD', 'WATER', 'SWAMP'),
('oPPQIZ6T0f', 'SWORD', 'SWORD', 'SWORDSMAN'),
('pfQfG021aX', 'SKY', 'FIRE', 'FIREWORKS'),
('PusuYz9x2S', 'WALL', 'WALL', 'HOUSE'),
('q6Izq2BaQr', 'AIR', 'EARTH', 'DUST'),
('Qgjnzr55gO', 'STORM', 'SAND', 'SANDSTORM'),
('qHKOPatPeO', 'BRICK', 'BRICK', 'WALL'),
('QnS9iigOE3', 'WIND', 'SAND', 'SANDSTORM'),
('qtJlzEOket', 'PLAINS', 'EARTH', 'HILL'),
('QWT19Bk4fI', 'SKY', 'STONE', 'METEOR'),
('R05oYgL0Q6', 'AIR', 'WATER', 'CLOUD'),
('RnwNmD2NKI', 'FIRE', 'CLAY', 'BRICK'),
('SALPCtdEeA', 'HOLE', 'EARTH', 'PITFALL'),
('SsIR49sJ7V', 'AIR', 'AIR', 'SKY'),
('Szh0j8Lof6', 'SAND', 'FIRE', 'GLASS'),
('szjnPudI3W', 'FIRE', 'STONE', 'IRON'),
('Tb5Vz7AG1h', 'OCEAN', 'EARTH', 'ISLAND'),
('Tjfb1RzEtX', 'HOUSE', 'GOLD', 'BANK'),
('TKRDYYy3l9', 'PITFALL', 'CASTLE', 'FORTRESS'),
('TSr3nnBHwK', 'HOUSE', 'HOUSE', 'TOWER'),
('U7Wm5I7xHh', 'PLANT', 'PLANT', 'TREE'),
('UbSTYcq7nh', 'FOREST', 'FIRE', 'ASH'),
('V6OgwKBNbg', 'MUD', 'DUST', 'CLAY'),
('VDgfr4jeSR', 'AIR', 'EXPLOSION', 'SOUND'),
('vqXRHyS4B9', 'FLOWER', 'EARTH', 'GARDEN'),
('WHUKJnKyyI', 'FORGE', 'IRON', 'SWORD'),
('x8ikdi5TLQ', 'SKY', 'CLOUD', 'RAIN'),
('xAOEYgFrcL', 'MOUNTAIN', 'STONE', 'AVALANCHE'),
('YjzMd4mAL8', 'EARTH', 'FIRE', 'STONE'),
('YTLt7ScVIH', 'TOWER', 'PLANT', 'IVY'),
('yzIpDqlMK8', 'RAIN', 'PLAINS', 'PLANT'),
('z5fxM2Ww0I', 'SOUND', 'EARTH', 'EARTHQUAKE'),
('z8wolzJnli', 'EXPLOSION', 'EARTH', 'HOLE'),
('zcf22vY2Qs', 'CLOUD', 'CLOUD', 'STORM'),
('ZdhZtboiJ5', 'RAIN', 'CLOUD', 'STORM'),
('zFE2kU5L2f', 'PLANT', 'EARTH', 'TREE'),
('ZYTFBf4ljP', 'SKY', 'FIREBALL', 'SUN');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inventions`
--

CREATE TABLE IF NOT EXISTS `inventions` (
  `id` varchar(10) NOT NULL,
  `player` varchar(10) NOT NULL,
  `object` varchar(10) NOT NULL,
  `game` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `inventions`
--

INSERT INTO `inventions` (`id`, `player`, `object`, `game`) VALUES
('3E62RxyBnY', '2', 'WATER', 'testgame'),
('IRxDa3t8le', '2', 'AIR', 'testgame'),
('lpbeiuXs4X', '2', 'FIRE', 'testgame'),
('mvbL2PNyGU', '1', 'EARTH', 'testgame'),
('Pawwhov0Z4', '1', 'AIR', 'testgame'),
('PGBXDRdniJ', '2', 'EARTH', 'testgame'),
('TQ1vFDctzF', '1', 'WATER', 'testgame'),
('ufqbRmAvLC', '1', 'FIRE', 'testgame');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` varchar(10) NOT NULL,
  `player` varchar(10) NOT NULL,
  `round` int(11) NOT NULL,
  `message` text NOT NULL,
  `time` int(11) NOT NULL,
  `game` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `objectbase`
--

CREATE TABLE IF NOT EXISTS `objectbase` (
  `id` varchar(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `buildtype` varchar(30) NOT NULL,
  `cost` int(11) NOT NULL,
  `move` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `weaponattack` int(11) NOT NULL,
  `armor` int(11) NOT NULL,
  `live` int(11) NOT NULL,
  `maxlive` int(11) NOT NULL,
  `text` text NOT NULL,
  `icon` varchar(250) NOT NULL,
  `spell` varchar(100) NOT NULL,
  `creatureprice` float NOT NULL,
  `buildingprice` float NOT NULL,
  `rangedattack` varchar(15) NOT NULL,
  `firststrike` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `objectbase`
--

INSERT INTO `objectbase` (`id`, `name`, `buildtype`, `cost`, `move`, `attack`, `weaponattack`, `armor`, `live`, `maxlive`, `text`, `icon`, `spell`, `creatureprice`, `buildingprice`, `rangedattack`, `firststrike`) VALUES
('AIR', 'Luft', '', -9999, -9999, 0, 0, 0, 0, 0, 'Luft ist eines der vier Basiselemente', 'air.png', '', 0, 0, '', ''),
('AMBOS', 'Amboss', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Baupunkte um 8 Punkte erhöht', 'ambos.png', '', 0, 0, '', ''),
('ASH', 'Asche', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Leben um einen Punkt erhöht', 'ash.png', '', 0, 0, '', ''),
('BANK', 'Bank', 'building', 100, -9999, 0, 0, 4, 25, 25, 'Technologie-Bonus: Baupunkte-Maximum um 20 Punkte erhöht und Baupunkte-Zuwachs um 5 Punkte erhöht.<br><br>\r\n\r\nAlle Gebäude sind 2% billiger zu beschwören\r\n\r\n', 'bank.png', '', 0, 0.98, '', ''),
('BRICK', 'Ziegel', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Baupunkte um 2 Punkte erhöht', 'brick.png', '', 0, 0, '', ''),
('CASTLE', 'Burg', 'building', 140, -9999, 12, 0, 15, 100, 100, 'Technologie-Bonus: Anführer-Angriff und Anführer-Rüstung um 2 Punkte erhöht.\r\n\r\nHat Erstschlag', 'castle.png', '', 0, 2, '', 'yes'),
('CAVE', 'Höhle', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Rüstung Anführer-Leben um jeweils zwei Punkte erhöht', 'cave.png', '', 0, 0, '', ''),
('CLAY', 'Lehm', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Baupunkte um 4 Punkte erhöht', 'clay.png', '', 0, 0, '', ''),
('CLOUD', 'Wolken', '', 10, -9999, 0, 0, 0, 0, 0, 'Verringert die Baupunkte des Gegners um zwei Punkte.', 'cloud.png', 'all*stealresources*2', 0, 0, '', ''),
('COMET', 'Komet', '', 45, 0, 0, 0, 0, 0, 0, 'Kometeneinschlag verursacht 6-18 Flächenschaden', 'comet.png', 'all*areadamage*12', 0, 0, '', ''),
('DAY', 'Tag', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Bewegungskosten um 2 Punkte reduziert', 'day.png', '', 0, 0, '', ''),
('DUST', 'Staub', '', 5, -9999, 0, 0, 0, 0, 0, 'Verlangsamt eine gegnerische Kreatur für zwei Runden um 30%', 'dust.png', 'enemy*movement*1.3', 0, 0, '', ''),
('EARTH', 'Erde', '', -9999, -9999, 0, 0, 0, 0, 0, 'Erde ist eines der vier Basiselemente', 'earth.png', '', 0, 0, '', ''),
('EARTHQUAKE', 'Erdbeben', '', 40, 0, 0, 0, 0, 0, 0, '20-60 Schaden gegen Gebäude', 'earthquake.png', 'all*areabuildingdamage*40', 0, 0, '', ''),
('EXPLOSION', 'Explosion', '', 30, -9999, 0, 0, 0, 0, 0, 'Eine Explosion verursacht 2-6 Flächenschaden', 'explosion.png', 'all*areadamage*4', 0, 0, '', ''),
('FIRE', 'Feuer', '', -9999, -9999, 0, 0, 0, 0, 0, 'Feuer ist eines der vier Basiselemente', 'fire.png', '', 0, 0, '', ''),
('FIREBALL', 'Feuerball', '', 20, -9999, 0, 0, 0, 0, 0, 'Ein Feuerball macht 2-6 Schaden auf eine gegnerische Kreatur', 'fireball.png', 'enemy*damage*4', 0, 0, '', ''),
('FIREWORKS', 'Feuerwerk', '', -9999, 1, 10, 0, 0, 1, 1, 'Das Feuerelementar ist flüssig', 'fireworks.png', '', 0, 0, '', ''),
('FLOWER', 'Blume', '', -9999, -9999, 0, 0, 0, 0, 0, '', 'flower.png', '', 0, 0, '', ''),
('FOG', 'Nebel', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Leben um 2 Punkte erhöht', 'fog.png', '', 0, 0, '', ''),
('FOREST', 'Wald', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Baupunkte um 8 Punkte erhöht. Anführer-Leben um 4 Punkte erhöht', 'forest.png', '', 0, 0, '', ''),
('FORGE', 'Schmiede', '', 100, -9999, 0, 0, 5, 30, 30, 'Technologie-Bonus: Baupunkte um 10 Punkte erhöht, Baupunktezuwachs um 5 erhöht.\r\n\r\nAlle Gebäude und Kreaturen sind 3% billiger zu beschwören', 'forge.png', '', 0.97, 0.97, '', ''),
('FORTRESS', 'Festung', 'building', 180, -9999, 15, 0, 18, 140, 140, 'Technologie-Bonus: Anführer-Angriff und Anführer-Rüstung um 1 Punkte erhöht. Hat Erstschlag', 'fortress.png', '', 0, 0, '', 'yes'),
('GARDEN', 'Garten', '', 8, -9999, 10, 0, 0, 1, 1, 'Das Feuerelementar ist flüssig', 'garden.png', '', 0, 0, '', ''),
('GLASS', 'Glas', '', 12, 0, 20, 0, 0, 1, 1, 'Bumm', 'glass.png', '', 0, 0, '', ''),
('GOLD', 'Gold', '', 15, 3, 5, 0, 5, 1, 1, 'Ein sehr geschmeidiges Geschmeide', 'gold.png', '', 0, 0, '', ''),
('HILL', 'Hügel', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Rüstung Anführer-Leben um jeweils einen Punkt erhöht', 'hill.png', '', 0, 0, '', ''),
('HOLE', 'Loch', 'building', 5, -9999, 0, 0, 1, 1, 1, 'Ein Loch im Boden', 'hole.png', '', 0, 0, '', ''),
('HOUSE', 'Haus', 'building', 60, -9999, 1, 0, 5, 30, 30, 'Alle Kreaturen sind 2% billiger zu beschwören', 'house.png', '', 0.98, 1, '', ''),
('IRON', 'Eisen', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Rüstung um 2 Punkte erhöht', 'iron.png', '', 0, 0, '', ''),
('ISLAND', 'Insel', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Leben um drei-Punkte erhöht', 'island.png', '', 0, 0, '', ''),
('IVY', 'Efeu', '', -9999, -9999, 0, 0, 0, 0, 0, '', 'ivy.png', '', 0, 0, '', ''),
('LAKE', 'See', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Leben um 3 Punkte erhöht', 'lake.png', '', 0, 0, '', ''),
('LEADER', 'Anführer', '', -9999, 20, 2, 0, 2, 20, 20, 'Wenn der Anführer stirbt, ist das Spiel verloren.', 'player.png', '', 0, 0, '', ''),
('LIGHT', 'Licht', '', -9999, 1, 10, 0, 0, 1, 1, 'Das Feuerelementar ist flüssig', 'light.png', '', 0, 0, '', ''),
('METEOR', 'Meteor', '', 60, 0, 0, 0, 0, 0, 0, 'Ein Feuerball macht 8-24 Schaden auf eine gegnerische Kreatur', 'meteor.png', 'enemy*damage*16', 0, 0, '', ''),
('MONEY', 'Geld', '', -9999, -9999, 10, 0, 0, 1, 1, 'Das Feuerelementar ist flüssig', 'money.png', '', 0, 0, '', ''),
('MOUNTAIN', 'Berg', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Leben um 5 Punkte erhöht', 'mountain.png', '', 0, 0, '', ''),
('MUD', 'Schlamm', '', 9, -9999, 0, 0, 0, 0, 0, 'Heilt eine eigene Kreatur um einen verlorenen Lebenspunkt', 'mud.png', 'self*heal*1', 0, 0, '', ''),
('OCEAN', 'Ozean', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Bewegungskosten um 1 Punkt reduziert', 'ocean.png', '', 0, 0, '', ''),
('PITFALL', 'Fallgrube', 'building', 7, -9999, 2, 0, 2, 2, 2, '', 'pitfall.png', '', 0, 0, '', ''),
('PLAINS', 'Ebene', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Bewegungskosten um 2 Punkte reduziert', 'plains.png', '', 0, 0, '', ''),
('PLANT', 'Pflanzen', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Leben um jeweils 8 Punkte erhöht', 'plant.png', '', 0, 0, '', ''),
('RAIN', 'Regen', '', 12, -9999, 0, 0, 0, 0, 0, 'Verringert die Baupunkte des Gegners um drei Punkte.', 'rain.png', 'all*stealresources*3', 0, 0, '', ''),
('RIVER', 'Fluss', '', 8, -9999, 10, 0, 0, 1, 1, 'Das Feuerelementar ist flüssig', 'river.png', '', 0, 0, '', ''),
('RUST', 'Rost', '', 8, -9999, 0, 0, 0, 0, 0, 'Halbiert den Waffenschaden einer Kreatur', 'rust.png', 'enemy*rust*0.5', 0, 0, '', ''),
('SAND', 'Sand', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Baupunkte um 5 Punkte erhöht', 'sand.png', '', 0, 0, '', ''),
('SANDSTORM', 'Sandsturm', '', 20, 0, 0, 0, 0, 0, 0, 'Verringert die Baupunkte des Gegners um acht Punkte.', 'sandstorm.png', 'all*stealresources*8', 0, 0, '', ''),
('SKY', 'Himmel', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Bewegungskosten um einen Punkt reduziert', 'sky.png', '', 0, 0, '', ''),
('SOUND', 'Lärm', '', -9999, -9999, 0, 0, 0, 0, 0, 'Nur Schall und Rauch - Kein Effekt', 'sound.png', '', 0, 0, '', ''),
('STEEL', 'Stahl', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Angriff um 3 Punkte erhöht', 'steel.png', '', 0, 0, '', ''),
('STONE', 'Stein', '', 15, -9999, 0, 0, 0, 0, 0, 'Stattet eine eigene Kreatur mit einer Waffe aus.', 'stone.png', 'self*weapon*2', 0, 0, '', ''),
('STONETHROW', 'Steinwerfer', 'creature', 20, 12, 3, 0, 1, 5, 5, 'Hat Fernkampfangiff', 'stonethrower.png', '', 0, 0, 'yes', ''),
('STORM', 'Sturm', '', 15, -9999, 0, 0, 0, 0, 0, 'Verringert die Baupunkte des Gegners um fünf Punkte.', 'storm.png', 'all*stealresources*5', 0, 0, '', ''),
('SUN', 'Sonne', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Angrif um 2 Punkte und Anführer-Leben um 5 Punkte erhöht', 'sun.png', '', 0, 0, '', ''),
('SWAMP', 'Sumpf', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Anführer-Leben um 2 Punkte erhöht', 'swamp.png', '', 0, 0, '', ''),
('SWORD', 'Schwert', '', 25, -9999, 0, 0, 0, 0, 0, 'Stattet eine eigene Kreatur mit einer Waffe aus.', 'sword.png', 'self*weapon*8', 0, 0, '', ''),
('SWORDSMAN', 'Schwertkämpfer', 'creature', 45, 10, 8, 0, 4, 15, 15, '', 'swordsman.png', '', 0, 0, '', ''),
('TOWER', 'Turm', 'building', 85, 0, 8, 0, 12, 60, 60, 'Hat Erstschlag', 'tower.png', '', 0, 0, '', 'yes'),
('TREE', 'Baum', '', -9999, -9999, 0, 0, 0, 0, 0, 'Technologie-Bonus: Baupunkte um 3 Punkte erhöht', 'tree.png', '', 0, 0, '', ''),
('VACUUM', 'Vakuum', '', -9999, -9999, 20, 0, 0, 1, 1, 'Technologie-Bonus: Gegnerischer Anführer erleidet vier Schaden', 'vacuum.png', '', 0, 0, '', ''),
('VASE', 'Vase', '', -9999, -9999, 0, 0, 0, 0, 0, '', 'vase.png', '', 0, 0, '', ''),
('VILLAGE', 'Dorf', 'building', 100, -9999, 3, 0, 8, 50, 50, 'Alle Gebäude sind 4% billiger zu beschwören', 'village.png', '', 0, 0.96, '', ''),
('WALL', 'Mauer', 'building', 25, -9999, 0, 0, 8, 20, 20, 'Wasser ist eines der vier Basiselemente', 'wall.png', '', 0, 0, '', ''),
('WATER', 'Wasser', '', -9999, -9999, 0, 0, 0, 0, 0, 'Wasser ist eines der vier Basiselemente', 'water.png', '', 0, 0, '', ''),
('WATERLILY', 'Wasserlilie', '', -9999, -9999, 0, 0, 0, 0, 0, '', 'waterlily.png', '', 0, 0, '', ''),
('WIND', 'Wind', '', 12, 0, 20, 0, 0, 1, 1, 'Bumm', 'wind.png', 'damage*8', 0, 0, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
