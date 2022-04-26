-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 08:18 AM
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
(2, 63, 3, 9),
(3, 63, 5, 1),
(4, 64, 5, 1),
(5, 64, 4, 1),
(6, 65, 20, 5),
(7, 66, 20, 10),
(8, 67, 20, 10),
(9, 68, 17, 1),
(10, 69, 20, 10),
(12, 71, 6, 1),
(13, 71, 20, 7),
(14, 71, 3, 9),
(19, 74, 18, 3),
(20, 74, 17, 1),
(21, 75, 4, 1),
(22, 76, 6, 2),
(23, 76, 4, 16),
(24, 76, 2, 7),
(25, 76, 5, 3);

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
(54, 'marchio', 'alexander', 1, 'dsa', 'alexa', 'fermi mn edu it', '1234', 'ciao', '$2y$10$U89A2KJmQbAhvn6Qy1LI7eN8Kj/7UlR89Loxv3xLLiIsPdHTKRDyW'),
(55, 'nuovo', 'nuovo', 1, 'nuovo', 'nuovo@nuovo.com', 'nuovo', '1234', 'nuovo', '$2y$10$cQUg61f.pok6pG.h87BJs.aTY.4wEFFOEW6aNGx1VQdeDhLrCtqTK');

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
  `metodo_spedizione_ID` int(11) DEFAULT NULL,
  `metodo_pagamento_ID` int(11) DEFAULT NULL,
  `indirizzo_spedizione` varchar(200) DEFAULT NULL,
  `data_inserimento_ordine` datetime DEFAULT NULL,
  `data_conferma` datetime DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `data_spedizione` datetime DEFAULT NULL,
  `data_annullamento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordine`
--

INSERT INTO `ordine` (`ordine_ID`, `utente_ID`, `metodo_spedizione_ID`, `metodo_pagamento_ID`, `indirizzo_spedizione`, `data_inserimento_ordine`, `data_conferma`, `data_pagamento`, `data_spedizione`, `data_annullamento`) VALUES
(63, 54, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 25', '2022-04-18 17:57:53', '2022-04-18 18:00:10', '2022-04-18 18:00:10', NULL, '2022-04-18 18:16:08'),
(64, 54, 1, 1, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 22', '2022-04-18 18:16:50', '2022-04-18 18:17:14', '2022-04-18 18:17:14', NULL, '2022-04-18 18:20:09'),
(65, 54, 1, 1, 'Italy, MN, Guidizzolo, Guidizzolo, 46040, Borgo Breda 321', '2022-04-18 18:21:15', '2022-04-18 18:21:44', '2022-04-18 18:21:44', NULL, '2022-04-18 18:21:55'),
(66, 54, 1, 1, 'Italy, MN, Guidizzolo, Guidizzolo, 46040, Borgo Breda 231321321', '2022-04-18 18:24:49', '2022-04-18 18:25:04', '2022-04-18 18:25:04', NULL, '2022-04-18 18:25:15'),
(67, 54, 1, 1, 'Italy, MI, Buccinasco, Buccinasco, 20090, Via Odessa 32', '2022-04-18 18:27:22', '2022-04-18 18:27:51', '2022-04-18 18:27:51', NULL, '2022-04-18 18:31:37'),
(68, 54, 1, 1, 'Italy, LI, Livorno, Livorno, 57123, Darsena Toscana 21', '2022-04-18 18:32:46', '2022-04-18 18:33:48', '2022-04-18 18:33:48', NULL, '2022-04-18 18:34:11'),
(69, 54, 1, 1, 'Italy, RM, Roma, Roma, 00185, Via degli Equi 12', '2022-04-18 18:34:46', '2022-04-18 18:35:01', '2022-04-18 18:35:01', NULL, '2022-04-18 18:36:30'),
(71, 55, 1, 2, 'Italy, MN, Guidizzolo, Rebecco, 46040, Borgo Baite 32', '2022-04-21 16:12:55', '2022-04-21 17:29:30', '2022-04-21 17:29:30', '2022-04-21 20:01:20', NULL),
(73, 55, 1, 1, 'Italy, FI, Firenze, Firenze, 50123, Borgo Ognissanti 21', '2022-04-21 17:31:31', '2022-04-21 17:31:53', '2022-04-21 17:31:53', NULL, NULL),
(74, 55, 1, 1, 'Italy, FI, Firenze, Firenze, 50121, Borgo Pinti 333', '2022-04-21 17:33:43', '2022-04-21 17:34:05', '2022-04-21 17:34:05', NULL, '2022-04-21 17:34:39'),
(75, 55, 1, 1, 'Italy, TP, Mazara del Vallo, Verona, 91026, Viale Affacciata 22', '2022-04-21 19:37:02', '2022-04-21 19:37:27', '2022-04-21 19:37:27', NULL, '2022-04-21 19:37:42'),
(76, 55, 1, 1, 'Italy, UD, Manzano, Manzano, 33044, Borgo Tinet 22', '2022-04-24 09:28:01', '2022-04-25 12:19:16', '2022-04-25 12:19:16', '2022-04-25 12:19:30', NULL);

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
  `link_quadro` varchar(100) NOT NULL,
  `archiviato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quadro`
--

INSERT INTO `quadro` (`quadro_ID`, `nome_quadro`, `nome_autore`, `nazione_di_origine`, `genere`, `descrizione_breve`, `descrizione_dettagliata`, `prezzo`, `quantita_in_magazzino`, `link_quadro`, `archiviato`) VALUES
(1, 'Lurloaaaaaaaaaaaaa', 'nooooooooooo', 'dsadsa', 'Espressionismo', 'Lorem', 'Lorem', 32, 40, '94f4d50d1ab1014a58c3e38e58d23455.jpg', 1),
(2, '3 Maggio', 'Francisco Goya', 'Spagna', 'Romanticismo', 'interessante', 'molto molto molto interessante', 100, 1, '3-Maggio_Goya.jpg', 0),
(3, 'Ascesa all\'Empireo', 'Hieronymus Bosch', 'Paesi Bassi', 'Rinascimento', 'wow', 'wowowowowoowowowow', 250, 968, 'Ascesa-all\'Empireo_Bosch.jpg', 0),
(4, 'Camille Monet sul letto di mor', 'Claude Monet', 'Francia', 'Impressionismo', 'lol', 'omega lol', 5, 0, 'Camille-Monet-sul-letto-di-morte_Monet.jpg', 0),
(5, 'Centauro Maniscalco', 'Arnold Böcklin', 'Svizzera', 'Simbolismo', 'centauro ', 'centauro centauro', 75, 8, 'Centauro-Maniscalco_Bocklin.jpg', 0),
(6, 'Mangiatori di patate', 'Vincent van Gogh', 'Paesi Bassi', 'Impressionismo', 'wooooooooow', 'aaaaaaaaaaaaaaaaaaaaaaaaaawwwwwwwwwwwwwwwwwwwwwaaaaaaaa', 1000, 545, 'Mangiatori-di-patate_Vincent-van-Gogh.jpg', 0),
(17, 'Cristo nella tempesta sul mare', 'Rembrandt van Rijn', 'Paesi Bassi', 'Secolo d\'oro olandes', 'aaa', 'bbbbbbbbbbbbb', 155, 11, 'Cristo-nella-tempesta-sul-mare-di-Galilea_van-Rijn.jpg', 0),
(18, 'Notte Stellata', 'Vincent Van Gogh', 'Francia', 'Impressionismo', 'bel quadro', 'quadro interessante di Van Gogh, ciao arrivederci.', 16.49, 131, '11cf956be65af795ee17c66e47db1859.jpg', 0),
(20, 'Il Ciclista', 'Natalia Goncharova', 'Russia', 'Futurismo', 'Bici', 'Mega Ultra Bici', 50, 33, 'd799664e3af35b328fdc2eacfdf717b2.jpg', 0),
(29, 'saaaaaaaaaaaaaaaaaaaaa', 'fddfs', 'fdsfds', 'fds', 'fds', 'fds', 99, 109, '13e805f0f19b5f1f5e632fb2d614e62a.jpg', 0),
(30, 'ciao', 'icadksa', 'dsaijd', 'dkaisdisajdisa', 'dsaijodsa', 'dsaijodsadsadsadsadsa', 12, 32, '', 0),
(31, 'ciao', 'icadksa', 'dsaijd', 'dkaisdisajdisa', 'dsaijodsa', 'dsaijodsadsadsadsadsa', 12, 32, '', 0),
(32, 'ciao', 'icadksa', 'dsaijd', 'dkaisdisajdisa', 'dsaijodsa', 'dsaijodsadsadsadsadsa', 12, 32, '', 0),
(33, 'ciao', 'icadksa', 'dsaijd', 'dkaisdisajdisa', 'dsaijodsa', 'dsaijodsadsadsadsadsa', 12, 32, '058f677a6b12930c9c380766a267a3b0.jpg', 0),
(34, 'dsa', 'dsa', 'sdsaa', 'dsad', 'dsadas', 'dsa', 10, 1010, 'a47eea6961e8227d95ad92e3d848ac5b.jpeg', 0),
(35, 'normale', 'normale', 'normale', 'normale', 'normale', 'normalissimissimisismo', 1, 1244, '0105b990121238d3d62193dbf6e7bc28.jpeg', 0),
(36, 'ancora', 'ancora', 'ancora', 'ancora', 'ancora', 'ancora ancora', 10, 1000, 'b66a36e1cbc46d3c326a2c79b8f527f3.jpg', 0),
(37, 'dinuovo', 'dinuovo', 'dinuovo', 'dinuovo', 'dinuivissumismssi', 'kdosapkdodsadsadsadsadsadsadsadas', 10, 1000, 'e1cb83e34c9de04e7e3921cdcf3f2e81.jpg', 0),
(38, 'stran', 'strano', 'strano', 'strano', 'strano', 'stranissimissimio', 20, 20, 'f91fb2ab4ab683dc7d13acb573f4124c.jpg', 0);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acquisto`
--
ALTER TABLE `acquisto`
  MODIFY `prodotto_carrello_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `dati_utente`
--
ALTER TABLE `dati_utente`
  MODIFY `utente_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
  MODIFY `ordine_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `quadro`
--
ALTER TABLE `quadro`
  MODIFY `quadro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `ruolo`
--
ALTER TABLE `ruolo`
  MODIFY `ruolo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acquisto`
--
ALTER TABLE `acquisto`
  ADD CONSTRAINT `acquisto_ibfk_2` FOREIGN KEY (`ordine_ID`) REFERENCES `ordine` (`ordine_ID`),
  ADD CONSTRAINT `acquisto_ibfk_3` FOREIGN KEY (`quadro_ID`) REFERENCES `quadro` (`quadro_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `ordine_ibfk_4` FOREIGN KEY (`utente_ID`) REFERENCES `dati_utente` (`utente_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
