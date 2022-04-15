-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 07:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce_quadri`
--

-- --------------------------------------------------------

--
-- Table structure for table `acquisto`
--

CREATE TABLE `acquisto` (
  `prodotto_carrello_ID` int(11) NOT NULL,
  `ordine_ID` int(11) NOT NULL,
  `quadro_ID` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acquisto`
--

INSERT INTO `acquisto` (`prodotto_carrello_ID`, `ordine_ID`, `quadro_ID`, `quantita`) VALUES
(32, 37, 1, 6),
(33, 37, 2, 5),
(34, 37, 4, 16),
(35, 37, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dati_utente`
--

CREATE TABLE `dati_utente` (
  `utente_ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `ruolo_ID` int(11) NOT NULL,
  `data_nascita` date DEFAULT NULL,
  `codice_fiscale` varchar(30) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `indirizzo` varchar(100) NOT NULL,
  `numero_telefono` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dati_utente`
--

INSERT INTO `dati_utente` (`utente_ID`, `nome`, `cognome`, `ruolo_ID`, `data_nascita`, `codice_fiscale`, `email`, `indirizzo`, `numero_telefono`, `username`, `password`) VALUES
(38, '1', '1', 1, '2011-11-11', '1', '1', '1', '1', '1', '1'),
(39, '2', '2', 2, '2022-11-11', '2', '2', '2', '2', '2', '2'),
(40, '1', '1', 1, '2011-11-11', '1', '1', '1', '1', '1', '1'),
(42, '3', '3', 3, '0000-00-00', '', '3', '3', '3', '3', '3'),
(43, '4', '4', 4, '0000-00-00', '', '4', '4', '4', '4', '4'),
(44, '6', '6', 1, '0000-00-00', '', '6', '6', '6', '6', '6'),
(45, '2', '3', 2, '0000-00-00', '', '2', '2', '2', '2', '2'),
(46, '3', '3', 2, '0000-00-00', '', '2', '1', '1', '4', '\n														$2y$10$e1X/FJ8K3AUAjAm6rW.dueD208U6uyM1h/ByteeSUaNmlAfXBSQ0e'),
(47, '8', '8', 1, '0000-00-00', '', '8', '8', '8', 'a', '\n														$2y$10$msWz0UmgNFpWwa2b/FYzaeJfAWpSw/Ztn5V.jPkCgz7rYMksXovMS'),
(48, '3', '3', 1, '0000-00-00', '', '1', '1', '1', 'aa', 'bb');

-- --------------------------------------------------------

--
-- Table structure for table `metodo_pagamento`
--

CREATE TABLE `metodo_pagamento` (
  `metodo_ID` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `metodo_spedizione`
--

CREATE TABLE `metodo_spedizione` (
  `metodo_id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `costo` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordine`
--

CREATE TABLE `ordine` (
  `ordine_ID` int(11) NOT NULL,
  `utente_ID` int(11) NOT NULL,
  `stato_ID` int(11) NOT NULL,
  `metodo_spedizione_ID` int(11) DEFAULT NULL,
  `metodo_pagamento_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordine`
--

INSERT INTO `ordine` (`ordine_ID`, `utente_ID`, `stato_ID`, `metodo_spedizione_ID`, `metodo_pagamento_ID`) VALUES
(37, 40, 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quadro`
--

CREATE TABLE `quadro` (
  `quadro_ID` int(11) NOT NULL,
  `prezzo` decimal(10,0) NOT NULL,
  `nazione_di_origine` varchar(20) NOT NULL,
  `descrizione_breve` varchar(100) NOT NULL,
  `genere` varchar(20) NOT NULL,
  `descrizione_dettagliata` varchar(500) NOT NULL,
  `nome_quadro` varchar(30) NOT NULL,
  `nome_autore` varchar(30) NOT NULL,
  `quantita_in_magazzino` int(11) NOT NULL,
  `link_quadro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quadro`
--

INSERT INTO `quadro` (`quadro_ID`, `prezzo`, `nazione_di_origine`, `descrizione_breve`, `genere`, `descrizione_dettagliata`, `nome_quadro`, `nome_autore`, `quantita_in_magazzino`, `link_quadro`) VALUES
(1, '50', 'Norvegia', 'Lorem ipsum', 'Espressionismo', 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', 'L\'urlo', 'Edvard Munch', 5, '../../Immagini/Quadri/L\'Urlo_Munch.jpg'),
(2, '100', 'Spagna', 'interessante', 'Romanticismo', 'molto molto molto interessante', '3 Maggio', 'Francisco Goya', 2, '../../Immagini/Quadri/3-Maggio_Goya.jpg'),
(3, '250', 'Paesi Bassi', 'wow', 'Rinascimento', 'wowowowowoowowowow', 'Ascesa all\'Empireo', 'Hieronymus Bosch', 1000, '../../Immagini/Quadri/Ascesa-all\'Empireo_Bosch.jpg'),
(4, '5', 'Francia', 'lol', 'Impressionismo', 'omega lol', 'Camille Monet sul letto di mor', 'Claude Monet', 1, '../../Immagini/Quadri/Camille-Monet-sul-letto-di-morte_Monet.jpg'),
(5, '75', 'Svizzera', 'centauro ', 'Simbolismo', 'centauro centauro', 'Centauro Maniscalco', 'Arnold Böcklin', 7, '../../Immagini/Quadri/Centauro-Maniscalco_Bocklin.jpg'),
(6, '1000', 'Paesi Bassi', 'wooooooooow', 'Impressionismo', 'aaaaaaaaaaaaaaaaaaaaaaaaaawwwwwwwwwwwwwwwwwwwwwaaaaaaaa', 'Mangiatori di patate', 'Vincent van Gogh', 543, '../../Immagini/Quadri/Mangiatori-di-patate_Vincent-van-Gogh.jpg'),
(17, '155', 'Paesi Bassi', 'aaa', 'Secolo d\'oro olandes', 'bbbbbbbbbbbbb', 'Cristo nella tempesta sul mare', 'Rembrandt van Rijn', 34, '../../Immagini/Quadri/Cristo-nella-tempesta-sul-mare-di-Galilea_van-Rijn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ruolo`
--

CREATE TABLE `ruolo` (
  `ruolo_ID` int(11) NOT NULL,
  `nome_ruolo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruolo`
--

INSERT INTO `ruolo` (`ruolo_ID`, `nome_ruolo`) VALUES
(1, 'Amministratore tecnico'),
(2, 'Amministratore commerciale'),
(3, 'Cliente registrato'),
(4, 'Cliente ospite');

-- --------------------------------------------------------

--
-- Table structure for table `stato_ordine`
--

CREATE TABLE `stato_ordine` (
  `stato_ID` int(11) NOT NULL,
  `data_inserimento_ordine` datetime NOT NULL,
  `data_conferma` datetime DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `data_spedizione` datetime DEFAULT NULL,
  `data_annullamento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stato_ordine`
--

INSERT INTO `stato_ordine` (`stato_ID`, `data_inserimento_ordine`, `data_conferma`, `data_pagamento`, `data_spedizione`, `data_annullamento`) VALUES
(23, '2022-03-05 17:35:06', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquisto`
--
ALTER TABLE `acquisto`
  ADD PRIMARY KEY (`prodotto_carrello_ID`),
  ADD KEY `ordine_ID` (`ordine_ID`),
  ADD KEY `quadro_ID` (`quadro_ID`);

--
-- Indexes for table `dati_utente`
--
ALTER TABLE `dati_utente`
  ADD PRIMARY KEY (`utente_ID`),
  ADD KEY `ruolo_ID` (`ruolo_ID`);

--
-- Indexes for table `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  ADD PRIMARY KEY (`metodo_ID`);

--
-- Indexes for table `metodo_spedizione`
--
ALTER TABLE `metodo_spedizione`
  ADD PRIMARY KEY (`metodo_id`);

--
-- Indexes for table `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`ordine_ID`),
  ADD KEY `utenteID` (`utente_ID`),
  ADD KEY `statoID` (`stato_ID`),
  ADD KEY `metodo_spedizione_ID` (`metodo_spedizione_ID`),
  ADD KEY `metodo_pagamento_ID` (`metodo_pagamento_ID`);

--
-- Indexes for table `quadro`
--
ALTER TABLE `quadro`
  ADD PRIMARY KEY (`quadro_ID`);

--
-- Indexes for table `ruolo`
--
ALTER TABLE `ruolo`
  ADD PRIMARY KEY (`ruolo_ID`);

--
-- Indexes for table `stato_ordine`
--
ALTER TABLE `stato_ordine`
  ADD PRIMARY KEY (`stato_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acquisto`
--
ALTER TABLE `acquisto`
  MODIFY `prodotto_carrello_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dati_utente`
--
ALTER TABLE `dati_utente`
  MODIFY `utente_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  MODIFY `metodo_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metodo_spedizione`
--
ALTER TABLE `metodo_spedizione`
  MODIFY `metodo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordine`
--
ALTER TABLE `ordine`
  MODIFY `ordine_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `quadro`
--
ALTER TABLE `quadro`
  MODIFY `quadro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ruolo`
--
ALTER TABLE `ruolo`
  MODIFY `ruolo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stato_ordine`
--
ALTER TABLE `stato_ordine`
  MODIFY `stato_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acquisto`
--
ALTER TABLE `acquisto`
  ADD CONSTRAINT `acquisto_ibfk_1` FOREIGN KEY (`quadro_ID`) REFERENCES `quadro` (`quadro_ID`),
  ADD CONSTRAINT `acquisto_ibfk_2` FOREIGN KEY (`ordine_ID`) REFERENCES `ordine` (`ordine_ID`);

--
-- Constraints for table `dati_utente`
--
ALTER TABLE `dati_utente`
  ADD CONSTRAINT `dati_utente_ibfk_1` FOREIGN KEY (`ruolo_ID`) REFERENCES `ruolo` (`ruolo_ID`);

--
-- Constraints for table `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`metodo_spedizione_ID`) REFERENCES `metodo_spedizione` (`metodo_id`),
  ADD CONSTRAINT `ordine_ibfk_2` FOREIGN KEY (`metodo_pagamento_ID`) REFERENCES `metodo_pagamento` (`metodo_ID`),
  ADD CONSTRAINT `ordine_ibfk_3` FOREIGN KEY (`stato_ID`) REFERENCES `stato_ordine` (`stato_ID`),
  ADD CONSTRAINT `ordine_ibfk_4` FOREIGN KEY (`utente_ID`) REFERENCES `dati_utente` (`utente_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
