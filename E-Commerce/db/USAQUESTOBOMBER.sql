-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2022 at 04:05 PM
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
(37, 83, 42, 20),
(39, 83, 45, 1),
(40, 84, 41, 1),
(41, 85, 41, 1),
(42, 86, 41, 1),
(43, 87, 41, 1);

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
(59, 'nome_utente_amminist', 'cognome_utente_ammin', 1, 'AMMINISTRATORETECNICO', 'amministratore@tecnico.com', 'Amministratore Tecnico 23', '1111111', 'adminTecnico1', '$2y$10$RHZP.wJuWZLOa5RtYoToTONfutfBf88EE9fMPmfFVXPNyzv5G64Ai'),
(60, 'nome_utente_amminist', 'cognome_utente_ammin', 2, 'AMMINISTRATORECOMMERCIALE', 'amministratore@commerciale.com', 'Amministratore Commerciale 23', '2222222', 'adminCommerciale1', '$2y$10$IOQBshaB7lIXoT.Kkodls.EMiUh1utCIFiFmTePrGDD3H1cIXIqPu'),
(61, 'nome_utente_registra', 'cognome_utente_regis', 3, 'UTENTEREGISTRATO', 'utente@registrato.com', 'Utente Registrato 12', '3333333', 'utenteRegistrato1', '$2y$10$8RSHSZMiLpm4EMontx2sOe5BFHdfx6/kFygp5aVxotQXw80JoyaGq');

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
(83, 61, 1, 2, 'Italy, UD, Cassacco, Cassacco, 33010, Borgo Baiutti 21', '2022-05-01 15:48:19', '2022-05-01 15:49:23', '2022-05-01 15:49:23', NULL, NULL),
(84, 61, NULL, NULL, NULL, '2022-05-01 15:53:56', '2022-05-01 15:54:15', '2022-05-01 15:54:15', NULL, '2022-05-01 15:56:04'),
(85, 61, NULL, NULL, NULL, '2022-05-01 15:56:11', '2022-05-01 15:57:10', '2022-05-01 15:57:10', NULL, NULL),
(86, 61, 1, 1, 'Italy, BN, Montesarchio, Montesarchio, 82016, Via Ciaolilli 321', '2022-05-01 15:59:15', '2022-05-01 16:00:01', '2022-05-01 16:00:01', NULL, NULL),
(87, 61, 1, 1, 'Italy, PT, Pescia, Pescia, 51017, Sdrucciolo del Duomo 22', '2022-05-01 16:00:23', '2022-05-01 16:00:41', '2022-05-01 16:00:41', NULL, NULL);

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
  `descrizione_breve` varchar(200) NOT NULL,
  `descrizione_dettagliata` varchar(10000) NOT NULL,
  `prezzo` float NOT NULL,
  `quantita_in_magazzino` int(11) NOT NULL,
  `link_quadro` varchar(100) NOT NULL,
  `archiviato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quadro`
--

INSERT INTO `quadro` (`quadro_ID`, `nome_quadro`, `nome_autore`, `nazione_di_origine`, `genere`, `descrizione_breve`, `descrizione_dettagliata`, `prezzo`, `quantita_in_magazzino`, `link_quadro`, `archiviato`) VALUES
(39, 'Notte stellata', 'Vincent van Gogh', 'Francia', 'Impressionismo', 'Paesaggio di campagna nella notte.', 'Un paesaggio di campagna nella notte. Le finestre sono illuminate dalle luci domestiche mentre la falce di luna illumina un cielo nel quale si agitano turbini inquietanti. Sotto ad un cielo costellato di stelle, con una falce di luna in alto a destra, Vincent van Gogh dipinge un paesaggio di campagna.', 10, 100, '865e43a7783dd5c338cddcba93cfae8c.jpg', 0),
(41, 'Il 3 maggio 1808', 'Francisco Goya', 'Spagna', 'Romanticismo', 'Un povero contadino che, dignitosamente, affronta il suo sacrificio a favore della libertà', 'Si tratta di un povero contadino che, dignitosamente, affronta il suo sacrificio a favore della libertà. Il contadino è inginocchiato, con le braccia alzate, e guarda direttamente il plotone di esecuzione. La sua immagine ricorda quella di un Cristo crocifisso.', 100, 91, '060503521b683f03147a985ddaf596c1.jpg', 0),
(42, 'La Gioconda', 'Leonardo da Vinci', 'Italia', 'Rinascimento', 'La Gioconda ritrae a metà figura una giovane donna con lunghi capelli scuri.', 'La Gioconda ritrae a metà figura una giovane donna con lunghi capelli scuri. È inquadrata di tre quarti, il busto è rivolto alla sua destra, il volto verso il osservatore. Le mani sono incrociate in primo piano e con le braccia si appoggia a quello che sembra il bracciolo di una sedia.', 30, 980, 'fd9da97a0fdfda50c41ca26a7b242abd.jpeg', 0),
(43, 'Camille Monet sul letto di mor', 'Claude Monet', 'Francia', 'Impressionismo', 'Rappresenta la morte della moglie di Claude Monet.', 'La descrizione migliore dell opera è affidata alle parole dello stesso Monet: \"Un giorno, all alba mi sono trovato al capezzale del letto di una persona che mi era molto cara e che tale rimarrà sempre. I miei occhi erano rigidamente fissi sulle tragiche tempie e mi sorpresi a seguire la morte nelle ombre del colorito che essa depone sul volto con sfumature graduali. Toni blu, gialli, grigi, che so. A tal punto ero arrivato. Naturalmente si era fatta strada in me il desiderio di fissare l immagine di colei che ci ha lasciati per sempre. Tuttavia prima che mi balenasse il pensiero di dipingere i lineamenti a me così cari e familiari, il corpo reagì automaticamente allo choc dei colori.. (C. Monet - 1879).', 79, 22, 'bb371bf79e05dd5b755b081023bfa912.jpg', 0),
(44, 'Il Bacio', 'Francesco Hayez', 'Italia', 'Romanticismo', 'Il Bacio di Francesco Hayez è un dipinto del 1859 che racchiude un messaggio di ribellione verso l occupazione straniera in Italia.', 'Due giovani in abiti del quattrocento sono in piedi abbracciati e si baciano. Il giovane è interamente coperto da un ampio mantello mentre la giovane indossa un semplice abito azzurro. Il ragazzo porta un cappello che copre il suo viso invece la protagonista ha i lunghi capelli sciolti. Sebbene il ragazzo sia nascosto dal mantello si intravede un arma al suo fianco sinistro.  La scena si svolge all interno di uno scenario architettonico medioevale. Infatti le mura sono costruite da grandi blocchi di pietra. Inoltre sullo stipite si intravedono decorazioni scolpite. Infine a sinistra nel buio si proietta sul muro quella che pare essere l ombra di una sagoma umana.', 100, 2, 'e4eb0747e47ccd1471e48552d66e0d6f.jpg', 0),
(45, 'Impero delle luci', 'René Magritte', 'Francia', 'Surrealismo', 'Due scenari opposti: la notte e il giorno.', 'Nello sfondo campeggia un cielo azzurro cosparso di vaporose nuvole bianche, invece in primo piano è stata rappresentata una strada buia con un lampione che rischiara debolmente un abitazione immersa in un paesaggio cupo e puramente notturno. Le forme sono tridimensionali, la tecnica è impeccabile, quasi accademica, ma la particolarità del dipinto sta nella realtà che vi è rappresentata. L opera accosta due momenti diversi, opposti tra loro: la metà superiore è vista in pieno giorno, quella inferiore di notte. La luminosità del sole è contrapposta alla sensazione di turbamento e malessere tradizionalmente collegato all oscurità; l obiettivo dell artista è stato quello di creare un effetto di shock, di spaesamento nei confronti dello spettatore. Citando direttamente Magritte:  «Nell Impero delle luci  ho rappresentato due idee diverse, vale a dire un paesaggio notturno e un cielo come lo vediamo di giorno. Il paesaggio fa pensare alla notte e il cielo al giorno. Trovo che questa contemporaneità di giorno e notte abbia la forza di sorprendere e di incantare. Chiamo questa forza poesia».', 147, 3, '6e63b002216fc5634e419e0a2a1f90f5.jpg', 0),
(46, 'Il ciclista', 'Natalja Goncharova', 'Russi', 'Futurismo', 'Combina elementi desunti da riflessioni sul cubismo e sul futurismo italiano, oltre che elementi propri dell avanguardia russa.', 'Insieme ad artisti come Michail Larionov e Kasimir Malevic, Natalja Goncharova fu tra i massimi esponenti dell avanguardismo russo.  Il ciclista  è probabilmente la sua opera più famosa: risale al 1913, è conservata presso il Museo Russo di San Pietroburgo e combina elementi desunti da riflessioni sul cubismo e sul futurismo italiano, oltre che elementi propri dell avanguardia russa.  Il protagonista, un ciclista in movimento sulla sua bicicletta, è scomposto in diverse parti secondo il procedimento tipico dei pittori cubisti come Picasso o Braque, ma è raffigurato anche nel suo dinamismo come facevano i futuristi italiani (per esempio Giacomo Balla). Il tutto con l inserimento di elementi prettamente grafici, come i caratteri cirillici e i numeri, un procedimento che anche Larionov utilizzava nei suoi dipinti.', 15, 76, '8c31edff9f1b3d8dace2fb810dd78f78.jpg', 0),
(47, 'Urlo', 'Munch', 'Norvegia', 'Espressionismo', 'L urlo è un dipinto di Edvard Munch che, grazie alla sua efficace sintesi simbolica, divenne icona della sofferenza umana, personale e collettiva, del Novecento.', 'A destra del dipinto si sviluppa il mare con la sua isola centrale. A circa tre quarti dell altezza si trova poi la linea dell orizzonte, ondulata e mossa. Da qui sale il cielo modellato da linee sinuose orizzontali e sovrapposte. Al centro dell immagine, in basso, si trova invece la figura umana serpeggiante che porta le mani al viso e urla con disperazione.  Il suo volto è privo di connotati di età e sesso. Anche gli abiti che indossa sono semplificati e ridotti ad una veste scura che copre interamente il corpo. Infine, al limite posteriore del sentiero si intravedono due sagome di uomini che procedono affiancati.', 54, 22, 'c79e9ea6b4eba87720f5a05bdcc86e5a.jpg', 0),
(48, 'I mangiatori di patate', 'Vincent van Gogh', 'Francia', 'Impressionismo', 'I mangiatori di patate di Vincent van Gogh è considerato dagli storici il primo importante dipinto dell’artista caratterizzato da uno stile espressionista.', 'Una modesta famiglia di contadini è riunita intorno al tavolo di sera. Una debole luce proviene dalla lanterna appesa al soffitto. Illumina i loro volti e il cibo sul tavolo di legno. Le loro fisionomie sono rocciose e quasi deformi. Anche le mani sono nodose. Le nocche descrivono il peso delle loro fatiche. Infine, un espressione stanca e priva di speranza è dipinta sui loro volti.', 70, 2, '649c9eb6f0f772685677f39308140d07.jpg', 0),
(50, 'Dinamismo di un cane al guinza', 'Giacomo Balla', 'Italia', 'Futurismo', 'Dinamismo di un cane al guinzaglio è un efficace esempio del tentativo dei pittori futuristi di rappresentare il movimento delle figure all interno dei loro dipinti.', 'I piedi della donna e le gambe del cane sono dipinti più volte all interno dell arco della traiettoria del loro movimento. La rappresentazione del movimento fu la principale preoccupazione dei futuristi. Il Futurismo fu fondato da Filippo Tommaso Marinetti con la pubblicazione nel 1909 del Manifesto del Futurismo a Parigi. Nacque così il principale movimento d avanguardia italiano. Il movimento simboleggiava l esaltazione del moderno attraverso la velocità e l azione. Altra componente del Movimento futurista era la rappresentazione della quarta dimensione cioè il tempo. Gli artisti cubisti che rappresentavano il tempo tramite l osservazione da più punti di vista dell oggetto. Gli artisti futuristi scelsero di rappresentare il movimento attraverso la registrazione contemporanea dell oggetto che si sposta nello spazio.', 150, 10, 'f5dcd4b29214b02fc5a82cb05d9df9ff.jpg', 0),
(51, 'Ragazza col turbante', 'Jan Vermeer', 'Olanda', 'Secolo di oro Olande', 'La ragazza col turbante rappresenta una fanciulla su uno sfondo scuro, di mezzo busto di profilo e la testa ruotante di tre quarti che guarda verso lo spettatore, illuminata da una luce proveniente da', 'L opera ritrae una ragazza di profilo a mezzo busto che rivolge il suo volto e i suoi occhi verso lo spettatore. La giovane è vestita in abiti esotici, in particolare con un inconsueto turbante sulla testa e con un luminescente orecchino di perla.  Il contrasto col fondale scuro fa emergere la bellezza luminosa della fanciulla: l espressione languida ma incantevole della giovane è data dal suo sorriso abbozzato, dal suo sguardo intenso e dall incarnato delicatamente vivo.  Ad attirare è anche l abbigliamento della giovane: la lucentezza del turbante avvolto da due pezzi di stoffa, uno azzurro e uno giallo, il luccichio del gioiello in perla e l eleganza semplice del suo manto in accordo armonico col copricapo.  Sappiamo che all inizio del XX secolo il dipinto fu molto sporco, tanto da non poter riconoscere la mano di Vermeer. Sottoposto a diverse operazioni di pulitura, il quadro ha fatto emergere il suo ottimo stato di conservazione e soprattutto la sua luminosità.', 100, 21, '104811a0f5bd92a80b74638d9e3bbf56.jpg', 0),
(52, 'Ritratto dei coniugi Arnolfini', 'Jan van Eyck', 'Olanda', 'Pittura Fiamminga', 'Considerato tra i capolavori dell artista, è anche una delle opere più significative della pittura fiamminga. Nella sua aura complessa ed enigmatica, ha acquistato una fama misteriosa, che i numerosi ', 'L opera è uno dei più antichi esempi conosciuti di pittura che ha come soggetto un ritratto privato, di personaggi viventi, anziché le consuete scene religiose.  Mostra la coppia in piedi, riccamente abbigliata, che si trova dentro la stanza da letto, mentre l uomo, Giovanni Arnolfini, fa un gesto verso lo spettatore che può essere interpretato in vari modi, dalla benedizione, al saluto, al giuramento (anche di fedeltà alla memoria). La moglie gli offre la sua mano destra, mentre appoggia la sinistra sul proprio ventre, con un gesto che ha fatto pensare a un allusione a una gravidanza futura o prossima. La posa dei personaggi appare piuttosto cerimoniosa, praticamente ieratica; questi atteggiamenti sono probabilmente dovuti al fatto che si sta rappresentando la celebrazione di un matrimonio o la commemorazione di una defunta, dove tale serietà è del tutto appropriata.   Jan van Eyck, Ritratto di uomo con turbante rosso (forse autoritratto), 1433; olio su tavola, 25,5×19 cm, National Gallery, Londra La stanza è rappresentata con estrema precisione ed è popolata da una grande varietà di oggetti, tutti raffigurati con un attenzione estrema al dettaglio. Tra questi oggetti spicca, al centro, uno specchio convesso, dettaglio giustamente celebre ed enigmatico, dove il pittore dipinse la coppia di spalle e il rovescio della stanza, dove si vede una porta aperta con due personaggi in piedi, uno dei quali potrebbe essere il pittore stesso.', 50, 10, '0fc48ff0d3701f1457881c5c7a19bf3b.jpg', 0),
(53, 'Autoritratto con orecchio bend', 'Vincent van Gogh', 'Francia', 'Impressionismo', 'In Autoritratto con orecchio bendato, Vincent Van Gogh si raffigura con una evidente bendatura all orecchio destro.', 'Nell Autoritratto con l orecchio bendato predominano i colori freddi, che danno una nota ancor più malinconica al dipinto, accentuata dall utilizzo di pennellate accidentate, che indugiano su ogni osso. Il volto dell artista è invero smunto e ossuto, con la carnagione definita da un giallo cereo, ed il suo sguardo abbattuto e perso nel vuoto sembra quasi affondare in mondi immaginari dove egli può eludere dall etichetta di «folle» che la società gli ha imposto. Il cappotto abbottonato e il cappello, indossati anche in casa, sembrano alludere all assenza di un impianto di riscaldamento, che forse, per le condizioni economiche sempre precarie, l artista non poteva permettersi: ma non va tuttavia dimenticato anche il significato più profondo di riparo da un mondo ormai ritenuto nemico dall artista.', 300, 1, 'b45a503076c05af9aa55e0cecf4a89ac.jpg', 0),
(54, 'Dama con ermellino', 'Leonardo da Vinci', 'Italia', 'Rinascimento', 'La Dama con l ermellino è Cecilia Gallerani, una giovane nobildonna di Milano e amante di Ludovico il Moro.', 'In quest opera lo schema del ritratto quattrocentesco, a mezzo busto e di tre quarti, venne superato da Leonardo, che concepì una duplice rotazione, con il busto rivolto a sinistra e la testa a destra. Vi è corrispondenza tra il punto di vista di Cecilia e dell ermellino; l animale infatti sembra identificarsi con la fanciulla, per una sottile comunanza di tratti, per gli sguardi dei due, che sono intensi e allo stesso tempo candidi. La figura slanciata di Cecilia trova riscontro armonico nell animale.  La dama sembra volgersi come se stesse osservando qualcuno sopraggiungente nella stanza, e al tempo stesso ha l imperturbabilità solenne di un antica statua. Un impercettibile sorriso aleggia sulle sue labbra: per esprimere un sentimento Leonardo preferiva accennare alle emozioni piuttosto che renderle esplicite. Grande risalto è dato alla mano, investita dalla luce, con le dita lunghe e affusolate che accarezzano l animale, testimoniando la sua delicatezza e la sua grazia.', 30, 95, '0e0446b188112119bf0ae7ead70d822f.jpg', 0),
(55, 'Donna in berretto e vestito a ', 'Pablo Picasso', 'Spagna', 'Cubismo', ' Una donna in un berretto e un vestito a quadri - Questa è un immagine luminosa, acuta e intensa di Marie-Therese Walter, la  musa dorata  di Picasso. Il ritratto è stato creato nel dicembre 1937, div', ' Una donna in un berretto e un vestito a quadri - Questa è un immagine luminosa, acuta e intensa di Marie-Therese Walter, la  musa dorata  di Picasso. Il ritratto è stato creato nel dicembre 1937, diventando il culmine di forse l anno più intenso nella vita dell artista. Cinque mesi prima, ha creato il suo più grande capolavoro -  Guernica dedicato al bombardamento della città con lo stesso nome durante la guerra civile spagnola. E sebbene Picasso continuasse ancora il suo rapporto con Walter, un altra donna conquistò una posizione sempre più significativa nella sua vita: Dora Maar, che il maestro incontrò nel 1935.  Sembra che attraverso questo ritratto, Picasso abbia cercato di esprimere i suoi sentimenti nei confronti di entrambe le donne. Questa dualità è visibile nella transizione di due stili - il sentimento più dolce e festoso del  periodo Marie-Terese  lascia il posto a forme cubiste più dolorose associate alla Dora Maar, politicamente orientata (nello stesso 1937 ha posato per  Donna che piange che è ora nella collezione della Tate Modern Gallery di Londra).  Dietro il volto di Marie-Terese su  Women in Beret , emerge una silhouette in cui l artista potrebbe implicare la sua prossima amata. Lo stesso Picasso disse:  Deve essere doloroso per la ragazza vedere nella foto che il suo tempo sta per scadere.', 500, 10, '624c4f107bf75c2cccec849a7b93505f.jpg', 0),
(56, 'Les demoiselles dAvignon', 'Pablo Picasso', 'Spagna', 'Cubismo', 'A partire dal 1907, l arte di Picasso cominciò a subire una nuova metamorfosi...', 'A partire dal 1907, l arte di Picasso cominciò a subire una nuova metamorfosi. Al suo interno trovavano sempre più spazio elementi tradizionali iberici e, dopo una visita al Trocadero – dov era ospitato il primo Museo Etnografico parigino [3] –, anche reminiscenze africane. Inoltre stava prendendo avvio quel percorso che di lì a poco l avrebbe portato al cubismo.  Il quadro certamente più famoso di questo periodo è Les demoiselles d Avignon, che in realtà Picasso aveva intitolato Il bordello d Avignone. Il titolo fu poi modificato in fase di esposizione dai curatori.', 87, 11, 'eef45ca74cb235d1548c27f0826b5eb7.jpg', 0);

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
  MODIFY `prodotto_carrello_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `dati_utente`
--
ALTER TABLE `dati_utente`
  MODIFY `utente_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
  MODIFY `ordine_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `quadro`
--
ALTER TABLE `quadro`
  MODIFY `quadro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
