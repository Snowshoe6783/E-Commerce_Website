-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2022 at 12:21 PM
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
(65, 52, 5, 2),
(66, 52, 6, 143),
(67, 52, 4, 1),
(68, 53, 3, 2),
(69, 54, 5, 1),
(70, 55, 3, 22),
(71, 55, 1, 1),
(72, 56, 2, 1),
(73, 56, 4, 5),
(74, 57, 4, 5),
(75, 57, 3, 3),
(76, 58, 4, 4),
(77, 58, 3, 5),
(78, 59, 6, 41),
(79, 59, 3, 54),
(80, 60, 4, 4),
(81, 60, 3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `dati_utente`
--

CREATE TABLE `dati_utente` (
  `utente_ID` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `ruolo_ID` int(11) NOT NULL,
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

INSERT INTO `dati_utente` (`utente_ID`, `nome`, `cognome`, `ruolo_ID`, `codice_fiscale`, `email`, `indirizzo`, `numero_telefono`, `username`, `password`) VALUES
(54, 'marchio', 'alexander', 1, 'dsa', 'alexa', 'fermi mn edu it', '1234', 'ciao', '$2y$10$U89A2KJmQbAhvn6Qy1LI7eN8Kj/7UlR89Loxv3xLLiIsPdHTKRDyW');

-- --------------------------------------------------------

--
-- Table structure for table `metodo_pagamento`
--

CREATE TABLE `metodo_pagamento` (
  `metodo_ID` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metodo_pagamento`
--

INSERT INTO `metodo_pagamento` (`metodo_ID`, `nome`) VALUES
(1, 'Carta di Credito'),
(2, 'PayPal'),
(3, 'Bonifico');

-- --------------------------------------------------------

--
-- Table structure for table `metodo_spedizione`
--

CREATE TABLE `metodo_spedizione` (
  `metodo_id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `costo` float(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metodo_spedizione`
--

INSERT INTO `metodo_spedizione` (`metodo_id`, `nome`, `costo`) VALUES
(1, 'Corriere', 2),
(2, 'Corriere espresso', 5),
(3, 'Poste', 1),
(4, 'Punto di ritiro', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordine`
--

CREATE TABLE `ordine` (
  `ordine_ID` int(11) NOT NULL,
  `utente_ID` int(11) NOT NULL,
  `stato_ID` int(11) NOT NULL,
  `metodo_spedizione_ID` int(11) DEFAULT NULL,
  `metodo_pagamento_ID` int(11) DEFAULT NULL,
  `indirizzo_spedizione` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordine`
--

INSERT INTO `ordine` (`ordine_ID`, `utente_ID`, `stato_ID`, `metodo_spedizione_ID`, `metodo_pagamento_ID`, `indirizzo_spedizione`) VALUES
(52, 54, 45, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 11'),
(53, 54, 46, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 11'),
(54, 54, 47, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 11'),
(55, 54, 48, 1, 1, 'Italy, MN, Guidizzolo, Guidizzolo, 46040, Borgo Breda 23'),
(56, 54, 49, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 11'),
(57, 54, 50, 1, 1, 'Italy, MN, Guidizzolo, Guidizzolo, 46040, Borgo Breda 21'),
(58, 54, 51, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 11'),
(59, 54, 52, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 21'),
(60, 54, 53, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 11');

-- --------------------------------------------------------

--
-- Table structure for table `quadro`
--

CREATE TABLE `quadro` (
  `quadro_ID` int(11) NOT NULL,
  `nome_quadro` varchar(30) NOT NULL,
  `nome_autore` varchar(30) NOT NULL,
  `nazione_di_origine` varchar(20) NOT NULL,
  `genere` varchar(20) NOT NULL,
  `descrizione_breve` varchar(100) NOT NULL,
  `descrizione_dettagliata` varchar(500) NOT NULL,
  `prezzo` float NOT NULL,
  `quantita_in_magazzino` int(11) NOT NULL,
  `link_quadro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quadro`
--

INSERT INTO `quadro` (`quadro_ID`, `nome_quadro`, `nome_autore`, `nazione_di_origine`, `genere`, `descrizione_breve`, `descrizione_dettagliata`, `prezzo`, `quantita_in_magazzino`, `link_quadro`) VALUES
(1, 'L\'urlo', 'Edvard Munch', 'Norvegia', 'Espressionismo', 'Lorem ipsum', 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', 50, 30, 'L\'Urlo_Munch.jpg'),
(2, '3 Maggio', 'Francisco Goya', 'Spagna', 'Romanticismo', 'interessante', 'molto molto molto interessante', 100, 0, '3-Maggio_Goya.jpg'),
(3, 'Ascesa all\'Empireo', 'Hieronymus Bosch', 'Paesi Bassi', 'Rinascimento', 'wow', 'wowowowowoowowowow', 250, 969, 'Ascesa-all\'Empireo_Bosch.jpg'),
(4, 'Camille Monet sul letto di mor', 'Claude Monet', 'Francia', 'Impressionismo', 'lol', 'omega lol', 5, 5, 'Camille-Monet-sul-letto-di-morte_Monet.jpg'),
(5, 'Centauro Maniscalco', 'Arnold Böcklin', 'Svizzera', 'Simbolismo', 'centauro ', 'centauro centauro', 75, 1, 'Centauro-Maniscalco_Bocklin.jpg'),
(6, 'Mangiatori di patate', 'Vincent van Gogh', 'Paesi Bassi', 'Impressionismo', 'wooooooooow', 'aaaaaaaaaaaaaaaaaaaaaaaaaawwwwwwwwwwwwwwwwwwwwwaaaaaaaa', 1000, 541, 'Mangiatori-di-patate_Vincent-van-Gogh.jpg'),
(17, 'Cristo nella tempesta sul mare', 'Rembrandt van Rijn', 'Paesi Bassi', 'Secolo d\'oro olandes', 'aaa', 'bbbbbbbbbbbbb', 155, 0, 'Cristo-nella-tempesta-sul-mare-di-Galilea_van-Rijn.jpg'),
(18, 'Notte Stellata', 'Vincent Van Gogh', 'Francia', 'Impressionismo', 'bel quadro', 'quadro interessante di Van Gogh, ciao arrivederci.', 16.49, 121, '11cf956be65af795ee17c66e47db1859.jpg'),
(20, 'Il Ciclista', 'Natalia Goncharova', 'Russia', 'Futurismo', 'Bici', 'Mega Ultra Bici', 50, 25, 'd799664e3af35b328fdc2eacfdf717b2.jpg');

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
(45, '2022-04-15 10:16:49', '2022-04-15 10:17:34', '2022-04-15 10:17:34', '2022-04-17 10:17:34', '2022-04-16 09:16:02'),
(46, '2022-04-15 10:21:19', '2022-04-15 10:21:35', '2022-04-15 10:21:35', '2022-04-17 10:21:35', '2022-04-16 09:31:40'),
(47, '2022-04-15 11:42:50', '2022-04-15 11:43:01', '2022-04-15 11:43:01', '2022-04-17 11:43:01', NULL),
(48, '2022-04-15 12:16:27', '2022-04-15 12:16:49', '2022-04-15 12:16:49', '2022-04-17 12:16:49', '2022-04-16 09:17:07'),
(49, '2022-04-16 09:17:47', '2022-04-16 09:18:05', '2022-04-16 09:18:05', '2022-04-18 09:18:05', '2022-04-16 09:19:19'),
(50, '2022-04-16 09:19:41', '2022-04-16 09:20:17', '2022-04-16 09:20:17', '2022-04-18 09:20:17', '2022-04-16 09:20:55'),
(51, '2022-04-16 09:24:35', '2022-04-16 09:25:34', '2022-04-16 09:25:34', '2022-04-18 09:25:34', NULL),
(52, '2022-04-16 09:25:58', '2022-04-16 09:26:34', '2022-04-16 09:26:34', '2022-04-18 09:26:34', '2022-04-16 09:31:10'),
(53, '2022-04-16 09:28:24', '2022-04-16 09:28:57', '2022-04-16 09:28:57', '2022-04-18 09:28:57', '2022-04-16 09:29:45');

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
  ADD UNIQUE KEY `username` (`username`),
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
  MODIFY `prodotto_carrello_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `dati_utente`
--
ALTER TABLE `dati_utente`
  MODIFY `utente_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  MODIFY `metodo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metodo_spedizione`
--
ALTER TABLE `metodo_spedizione`
  MODIFY `metodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordine`
--
ALTER TABLE `ordine`
  MODIFY `ordine_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `quadro`
--
ALTER TABLE `quadro`
  MODIFY `quadro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ruolo`
--
ALTER TABLE `ruolo`
  MODIFY `ruolo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stato_ordine`
--
ALTER TABLE `stato_ordine`
  MODIFY `stato_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
