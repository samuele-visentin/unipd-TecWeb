-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tecweb
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `tecweb`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `tecweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `tecweb`;

--
-- Table structure for table `capitolo`
--

DROP TABLE IF EXISTS `capitolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capitolo` (
  `id` char(16) NOT NULL,
  `idIndagine` char(16) NOT NULL,
  `progressivo` int(11) NOT NULL,
  `titolo` varchar(75) NOT NULL,
  `descrizione` varchar(510) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idIndagine` (`idIndagine`),
  CONSTRAINT `capitolo_ibfk_1` FOREIGN KEY (`idIndagine`) REFERENCES `indagine` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capitolo`
--

LOCK TABLES `capitolo` WRITE;
/*!40000 ALTER TABLE `capitolo` DISABLE KEYS */;
INSERT INTO `capitolo` VALUES ('000000000000001','000000000000001',1,'Indagine nel salone','<p>Il primo obiettivo &egrave; concentrarsi sul furto e capirne la dinamica, perci&ograve; l&apos;indagine inizia nel luogo del furto: ti trovi nel salone da ballo, ora adibito a sala da pranzo per l&apos;evento di cena al buio. Nuove prove sono state rinvenute sul luogo e aggiunte alla collezione. Rispondi alle domande per proseguire al prossimo capitolo.</p>'),('000000000000002','000000000000001',2,'Indagine nello studio','<p>Ora &egrave; il momento di focalizzarsi sulla dinamica del delitto: ti trovi nello studio, l&apos;ambiente &egrave; stato messo a soqquadro e il pavimento ha diversi fogli sparsi nel terreno, provenienti da cartelle di documenti estratte dagli archivi. Le nuove prove sono state aggiunte alla collezione, pronte per essere esaminate per rispondere alle domande.</p>\r\n'),('000000000000003','000000000000001',3,'Indagine nel giardino d\'inverno','<p>Ti stai avvicinando alla conclusione del caso! Hai esaminato le stanze principali e ti sei spostato nel giardino d&apos;inverno per osservare pi&ugrave; da vicino il famoso orto botanico della villa, di cui hai tanto sentito parlare.</p>\r\n<p>Ci sono ancora dei dubbi che ti sono rimasti impressi, utilizza le prove collezionate finora per scoprire se possono aiutarti a risolvere il caso.</p>'),('000000000000004','000000000000001',0,'Partenza','<p>Che l&apos;indagine abbia inizio!</p>\r\n<p>\r\nOgni capitolo consiste di una serie di domande a cui dovrai rispondere utilizzando le prove collezionate.\r\nAll&apos;inizio di ogni nuovo capitolo avrai delle nuove prove da esaminare oltre a quelle che hai gi&agrave; ottenuto.\r\nIl tuo primo compito &egrave; esaminare le prove di partenza fornite dal cliente e dalla polizia per rispondere alla prima domanda\r\n</p>\r\n<p lang=\"en\">Good luck!</p>'),('000000000000005','000000000000001',4,'Caccia al ladro','<p>Incredibile ma vero, hai scoperto un passaggio segreto! Assolutamente non un clich&eacute;, ma sembra proprio che la vecchia libreria nascondesse un segreto sotto alla pila di libri polverosi.</p>\r\n<p>&Egrave; il momento della verit&agrave;: con le nuove prove ottenute, devi decidere chi ha commesso il furto.</p>'),('000000000000006','000000000000001',5,'Trova il colpevole','<p>Matilde ha confessato di aver commesso il furto! Puoi trovare un riassunto della sua versione tra le prove.</p>\r\n<p>Ed ora &egrave; arrivato il momento di scovare l&apos;assassino. Con tutte le prove accumulate, sarai in grado di trovare la persona giusta?</p>\r\n');
/*!40000 ALTER TABLE `capitolo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentoiniziale`
--

DROP TABLE IF EXISTS `documentoiniziale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentoiniziale` (
  `progressivo` int(11) NOT NULL,
  `tipo` enum('lettera','cronologia') NOT NULL,
  `contenuto` text NOT NULL,
  `idIndagine` char(16) NOT NULL,
  PRIMARY KEY (`progressivo`,`idIndagine`),
  KEY `idIndagine` (`idIndagine`),
  CONSTRAINT `documentoiniziale_ibfk_1` FOREIGN KEY (`idIndagine`) REFERENCES `indagine` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentoiniziale`
--

LOCK TABLES `documentoiniziale` WRITE;
/*!40000 ALTER TABLE `documentoiniziale` DISABLE KEYS */;
INSERT INTO `documentoiniziale` VALUES (1,'lettera','    <section class=\"letter\">\r\n        <header>\r\n            <h2>Lettera di presentazione del caso</h2>\r\n        </header>\r\n        <p>Buongiorno detective,</p>\r\n        <p>Colgo l&apos;occasione per darti il benvenuto all&apos;agenzia investigativa <span lang=\"en\">Clue Catchers</span>.</p>\r\n        <p>Come gi&agrave; saprai, esistono alcune situazioni peculiari in cui le indagini di polizia non bastano a risolvere un mistero, casi che nel tempo diventano &ldquo;freddi&rdquo;, dimenticati e irrisolti, misteri inspiegabili che hanno perseguitato l&apos;umanit&agrave; per anni e di cui non si conosce risposta, ed &egrave; proprio in queste situazioni che noi entriamo in scena.</p>\r\n        <p>Ad ogni modo non ti allarmare, non ti stiamo certo chiedendo di trovare il colpevole degli omicidi di Jack the Ripper o di risolvere la misteriosa scomparsa di D. B. Cooper, almeno non per il momento.</p>\r\n        <p>Le nuove reclute devono prima farsi un periodo di gavetta con casi che riteniamo essere pi&ugrave; risolvibili, come quello che ti &egrave; stato appena assegnato.</p>\r\n        <p>Il mistero sul quale dovrai cimentarti riguarda un furto ed un omicidio in un&apos;antica villa veneta durante un evento di cena al buio, che ha spiazzato le forze dell&apos;ordine. Nel dossier allegato a questa nota troverai le informazioni finora raccolte e la lettera del nostro cliente. La polizia ha accettato di collaborare, ci ha passato l&apos;autopsia e ci ha consentito l&apos;accesso alla villa, che &egrave; ancora chiusa al pubblico. Ti consiglio di recarti per dare un&apos;occhiata di persona, potresti trovare informazioni che nessuno ha notato finora.</p>\r\n        <p lang=\"en\">Good luck.</p>\r\n        <p>PS. Ricorda che, per accertarsi che un sospetto &egrave; colpevole, &egrave; necessario provare che questo aveva i mezzi per compiere il crimine, un motivo per farlo e un&apos;opportunit&agrave; di farlo.</p>\r\n        <p>PPS. Se hai notato una donna vestita di nero aggirarsi per l&apos;edificio, non farci caso, &egrave; la medium assegnata d&apos;ufficio che, a quanto pare, non &egrave; di molte parole e preferisce interloquire con gli spiriti.</p>\r\n        <footer>\r\n            <p><span class=\"signature\">Bruno Brunetti</span>, Esperto di pirateria aerea e <span lang=\"en\">Senior Investigator</span>.</p>\r\n        </footer>\r\n    </section>','000000000000001'),(2,'lettera','  <section class=\"letter\">\r\n        <header>\r\n            <h2>Lettera da Armando Torbelli all&apos;agenzia investigativa <span lang=\"en\">Clue Catchers</span></h2>\r\n        </header>\r\n        <p>Buongiorno Sig. Brunetti, La ringrazio per aver accettato di indagare sul caso. Come da richiesta, Le descrivo brevemente la sequenza degli eventi.</p>\r\n        <p>La sera del <time datetime=\"2023-12-22\">22 Dicembre 2023</time> ho organizzato assieme alla mia amica Lucrezia Remondini un evento di prova di cena al buio, il cui scopo &egrave; permettere a chi non ha disabilit&agrave; visiva di provare dal vivo quello che noi sperimentiamo ogni giorno, proponendo un&apos;esperienza in cui poter fare affidamento su tutti gli altri sensi piuttosto che quello visivo, che di solito prevale.</p>\r\n        <p>Le persone presenti nella casa (arrivate tutte in mattinata) erano:</p>\r\n        <ul>\r\n            <li>Io e Lucrezia Remondini, organizzatori dell&apos;evento;</li>\r\n            <li>Matilde Bolognini, una mia amica di lunga data che ci ha aiutato ad organizzare l&apos;evento e per questo &egrave; stata invitata come ospite;</li>\r\n            <li>Eriberto Mariconda, un mio collega di lavoro al quale ho proposto di partecipare a questo primo esperimento;</li>\r\n            <li>Mariangela Finetti, la migliore amica di Lucrezia, anche lei invitata all&apos;evento come primo esperimento;</li>\r\n            <li>Edgardo Dal Maso, il proprietario della villa, lo abbiamo invitato per ringraziarlo di aver accettato di ospitare l&apos;evento, anche se non sembrava particolarmente interessato;</li>\r\n            <li>Ermenegildo Dal Maso, il figlio del proprietario, sempre invitato per cortesia;</li>\r\n            <li>Genoveffa Lanzi, la governante storica della villa, che ha fatto amicizia con Lucrezia ed &egrave; stata invitata all&apos;ultimo momento;</li>\r\n            <li>I due cuochi, che sono arrivati verso il primo pomeriggio per preparare la cena e sono rimasti tutto il tempo in cucina.</li>\r\n        </ul>\r\n        <p>La cena si &egrave; tenuta in una villa veneta, della quale allego la locandina. Dopo un iniziale apericena a lume di candela nel giardino d&apos;inverno verso le <time datetime=\"20:30\">20:30</time>, abbiamo invitato gli ospiti a mettere la benda e li abbiamo condotti verso i tavoli del salone da ballo, dove si sarebbe dovuta tenere la cena, con quasi tutte le luci spente, eccetto qualche lampada a bassa luminosit&agrave;. Tuttavia, una volta che tutti si sono seduti, ci siamo presto resi conto che era saltata la corrente perch&eacute; l&apos;impianto stereo che riproduceva la musica si &egrave; interrotto e le luci si sono spente.</p>\r\n        <p>Abbiamo cercato di capire come organizzarci nel buio, Eriberto che &egrave; un ingegnere elettrotecnico si &egrave; offerto di andare a vedere il quadro elettrico e ci siamo resi conto che il proprietario della villa, Edgardo Dal Maso,  non era nella stanza con noi. In quel momento, la governante anziana ha detto qualcosa sugli spiriti che infestano la casa ed &egrave; svenuta. Cos&igrave; ci siamo divisi come segue:</p>\r\n        <ul>\r\n            <li>Mariangela &egrave; rimasta con Genoveffa nel salone;</li>\r\n            <li>Ermenegildo &egrave; andato al piano di sopra per vedere se il padre era tornato in camera;</li>\r\n            <li>Matilde &egrave; andata nel giardino d&apos;inverno, per vedere se per caso Edgardo fosse tornato l&igrave;;</li>\r\n            <li>Eriberto &egrave; andato nel magazzino del piano di sotto per vedere il contatore;</li>\r\n            <li>Io e Lucrezia siamo andati in cucina per vedere la situazione.</li>\r\n        </ul>\r\n        <p>Mentre stavamo tornando dalla cucina, abbiamo sentito un rumore di vetri rotti e poco dopo &egrave; tornata la luce.  Tornati nel salone, abbiamo raggiunto gli altri e abbiamo scoperto che la teca contenente i cimeli della villa era stata rotta nel buio e un cofanetto era stato sottratto.</p>\r\n        <p>Quando tutti sono tornati, abbiamo chiarito che Edgardo era ancora scomparso e, in quel momento, abbiamo sentito un rumore di sparo al piano di sopra. Ermenegildo ed Eriberto sono corsi al piano di sopra e hanno trovato il corpo di Edgardo nel suo ufficio, riverso su una pozza di sangue.</p>\r\n        <p>Ci sono molte cose che non quadrano in quello che &egrave; successo, e la polizia sembra non avere idea di come procedere con le indagini, perch&eacute; al momento dello sparo eravamo tutti nel salone, eccetto i cuochi che per&ograve; sono rimasti in cucina, mentre il furto &egrave; avvenuto a luci spente, quando tutti erano separati.</p>\r\n        <p>Allego quello che sono riuscito a raccogliere in termini di prove, inoltre ho raccolto delle testimonianze a fine serata, nella speranza che possano tornare utili al caso.</p>\r\n        <footer>\r\n            <p><span class=\"signature\">Armando Torbelli</span></p>\r\n        </footer>\r\n    </section>','000000000000001'),(3,'cronologia','<section class=\"timeline\">\r\n    <header>\r\n        <h2>Cronologia degli eventi</h2>\r\n    </header>\r\n    <dl>\r\n        <dt><time datetime=\"09:00\">09:00</time></dt>\r\n        <dd>Arrivo degli ospiti</dd>\r\n        <dt><time datetime=\"20:30\">20:30</time></dt>\r\n        <dd>Apericena nel giardino d&apos;inverno</dd>\r\n        <dt><time datetime=\"21:00\">21:00</time></dt>\r\n        <dd>Cena al buio con bende e poche lampade a luce soffusa</dd>\r\n        <dt><time datetime=\"21:20\">21:20</time></dt>\r\n        <dd>Salta la corrente</dd>\r\n        <dt><time datetime=\"21:22\">21:22</time></dt>\r\n        <dd>Appello, manca Edgardo. Ci si divide.</dd>\r\n        <dt><time datetime=\"21:35\">21:35</time></dt>\r\n        <dd>La teca viene rotta</dd>\r\n        <dt><time datetime=\"21:38\">21:38</time></dt>\r\n        <dd>Ritorna la luce</dd>\r\n        <dt><time datetime=\"21:39\">21:39</time></dt>\r\n        <dd>Matilde ritorna nel salone allarmata dal rumore del vetro</dd>\r\n        <dt><time datetime=\"21:40\">21:40</time></dt>\r\n        <dd>Armando e Lucrezia tornano in sala</dd>\r\n        <dt><time datetime=\"21:45\">21:45</time></dt>\r\n        <dd>Ritorna Ermenegildo</dd>\r\n        <dt><time datetime=\"21:50\">21:50</time></dt>\r\n        <dd>Ritorna Eriberto, dopo aver controllato il pannello</dd>\r\n        <dd>Appello secondario, nessuna traccia di Edgardo</dd>\r\n        <dt><time datetime=\"21:51\">21:51</time></dt>\r\n        <dd>Rumore di sparo, Ermenegildo e Edgardo vanno a cercare nello studio e rinvengono il corpo</dd>\r\n        <dt><time datetime=\"21:58\">21:58</time></dt>\r\n        <dd>Chiamata all&apos;ambulanza e polizia</dd>\r\n        <dt><time datetime=\"22:10\">22:10</time></dt>\r\n        <dd>Ermenegildo esce a fumare nel giardino d&apos;inverno</dd>\r\n        <dt><time datetime=\"22:12\">22:12</time></dt>\r\n        <dd>Lucrezia esce per controllare come sta Ermenegildo</dd>\r\n        <dt><time datetime=\"22:25\">22:25</time></dt>\r\n        <dd>Arrivano le forze dell&apos;ordine. Ermenegildo e Lucrezia rientrano</dd>\r\n    </dl>\r\n</section>','000000000000001');
/*!40000 ALTER TABLE `documentoiniziale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domanda`
--

DROP TABLE IF EXISTS `domanda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domanda` (
  `id` char(16) NOT NULL,
  `progressivo` int(11) NOT NULL,
  `idCapitolo` char(16) NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCapitolo` (`idCapitolo`),
  CONSTRAINT `domanda_ibfk_1` FOREIGN KEY (`idCapitolo`) REFERENCES `capitolo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domanda`
--

LOCK TABLES `domanda` WRITE;
/*!40000 ALTER TABLE `domanda` DISABLE KEYS */;
INSERT INTO `domanda` VALUES ('000000000000001',1,'000000000000004','È possibile che un esterno si sia introdotto nella villa?'),('000000000000002',2,'000000000000001','Quando è uscito Edgardo?'),('000000000000003',3,'000000000000001','Come è stata rotta la teca?'),('000000000000004',4,'000000000000001','Dove si trovava chi ha rotto il vetro?'),('000000000000005',5,'000000000000001','Quando è stato rubato il cofanetto?'),('000000000000006',6,'000000000000001','Chi non avrebbe potuto rubarlo?'),('000000000000007',1,'000000000000002','Chi poteva introdursi nello studio dopo l\'interruzione di corrente?'),('000000000000008',2,'000000000000002','È plausibile la teoria del suicidio'),('000000000000009',3,'000000000000002','Cosa ci faceva un guscio di petardo nello studio?'),('000000000000010',4,'000000000000002','Per quale motivo c\'è un buco sul piumino?'),('000000000000011',5,'000000000000002','Cosa indicano i movimenti nel frammento di libro contabile?'),('000000000000012',6,'000000000000002','Chi avrebbe potuto covare rancore verso Edgardo?'),('000000000000013',7,'000000000000002','Quando è avvenuto il decesso?'),('000000000000014',1,'000000000000003','A cosa sono dovuti i rumori nei muri della casa?'),('000000000000015',2,'000000000000003','Quali sono le uscite dal giardino d’inverno?'),('000000000000016',3,'000000000000005','Chi ha compiuto il furto?'),('000000000000017',4,'000000000000006','Chi ha ucciso Edgardo?');
/*!40000 ALTER TABLE `domanda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indagine`
--

DROP TABLE IF EXISTS `indagine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indagine` (
  `id` char(16) NOT NULL,
  `dataInserimento` datetime NOT NULL,
  `nome` varchar(25) NOT NULL,
  `descrizione` varchar(255) NOT NULL,
  `image_path` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indagine`
--

LOCK TABLES `indagine` WRITE;
/*!40000 ALTER TABLE `indagine` DISABLE KEYS */;
INSERT INTO `indagine` VALUES ('000000000000001','2024-01-11 22:02:06','Cena al buio con delitto','Indaga sullo strabiliante caso irrisolto dell\'omicidio del signor Edgardo e scopri l\'assassino e il movente!',NULL);
/*!40000 ALTER TABLE `indagine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prova`
--

DROP TABLE IF EXISTS `prova`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prova` (
  `id` char(16) NOT NULL,
  `tipo` enum('evento','testimonianza','indizio') NOT NULL,
  `idIndagine` char(16) NOT NULL,
  `idCapitolo` char(16) NOT NULL,
  `contenuto` text NOT NULL,
  `image_path` varchar(75) DEFAULT NULL,
  `titolo` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idIndagine` (`idIndagine`),
  KEY `idCapitolo` (`idCapitolo`),
  CONSTRAINT `prova_ibfk_1` FOREIGN KEY (`idIndagine`) REFERENCES `indagine` (`id`),
  CONSTRAINT `prova_ibfk_2` FOREIGN KEY (`idCapitolo`) REFERENCES `capitolo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prova`
--

LOCK TABLES `prova` WRITE;
/*!40000 ALTER TABLE `prova` DISABLE KEYS */;
INSERT INTO `prova` VALUES ('000000000000001','indizio','000000000000001','000000000000001','<p>Vecchia foto in bianco e nero che ritrae una bambina e un bambino che si tengono per mano mentre camminano su una strada sterrata. La bambina &egrave; pi&ugrave; grande, sui cinque anni, mentre il bambino &egrave; pi&ugrave; piccolo, forse 3 o 4 anni. Entrambi sono vestiti in abbigliamento invernale.</p>\r\n<p>Sul retro: &ldquo;I miei topolini, Severo e M. Eufelia, Santo Natale <time datetime=\"1971\">1971</time>&rdquo;</p>','/images/indagine1/capitolo1/foto1.jpg','Foto - <time datetime=\"1971\">1971</time>'),('000000000000002','testimonianza','000000000000001','000000000000004','<p>Se devo trovare qualcosa di strano che ho notato nella serata, &egrave; il fatto che durante la cena mi &egrave; sembrato di sentire rumori di passi in due momenti distinti, uno all&apos;inizio della cena, i primi minuti dopo le <time datetime=\"21:00\">21:00</time>, vicino all&apos;ingresso interno del salone, e uno poco prima del blackout, tra i tavoli nel salone.</p>\r\n<p>A proposito, qualcuno deve aver spostato le piante che erano davanti alla libreria, perch&eacute;, quando sono uscita nel giardino d&apos;inverno verso le <time datetime=\"22:12\">22:12</time>, stavo per inciampare su un vaso che era in mezzo alla stanza.</p>\r\n<p>Un&apos;altra cosa che mi &egrave; rimasta impressa &egrave; il fatto che nessuno abbia trovato l&apos;oggetto con cui &egrave; stata rotta la teca, il che mi fa supporre che sia semplicemente stata spinta per terra, infrangendosi.</p>\r\n<p>Dati sulla persona:</p>\r\n<dl>\r\n    <dt>Anni:</dt>\r\n    <dd>34</dd>\r\n    <dt>Lavoro:</dt>\r\n    <dd><span lang=\"en\">Ghostwriter</span></dd>\r\n    <dt>Passatempo:</dt>\r\n    <dd>Caccia ai fantasmi</dd>\r\n</dl>',NULL,'Testimonianza di Lucrezia Remondini'),('000000000000003','testimonianza','000000000000001','000000000000004','<p>Io ho cercato nel giardino di inverno per vedere se il vecchio si fosse appisolato da qualche parte, ho anche provato a guardare fuori dalle finestre se si vedesse qualche movimento nel giardino, ma non ho notato nulla. Ho poi sentito il rumore di un vetro rotto e sono tornata dentro per vedere cosa fosse successo, trovando la teca del salone da ballo, contenente i gioielli della villa, con il vetro rotto.</p>\r\n<p>Dati sulla persona:</p>\r\n<dl>\r\n    <dt>Anni:</dt>\r\n    <dd>56</dd>\r\n    <dt>Lavoro:</dt>\r\n    <dd>Avvocato</dd>\r\n    <dt>Passatempo:</dt>\r\n    <dd>Pallamano (ex-giocatrice agonistica)</dd>\r\n</dl>',NULL,'Testimonianza di Matilde Bolognini'),('000000000000004','testimonianza','000000000000001','000000000000004','<p>L&apos;interruzione di corrente &egrave; avvenuta subito dopo che ci sono state servite le caraffe con acqua e vino. Mi sono diretto nel ripostiglio verso il contatore della corrente, su suggerimento di Ermenegildo, tra l&apos;altro all&apos;inizio ho fatto fatica a trovarlo perch&eacute; la stanza &egrave; trattata come uno sgabuzzino, pieno di mobili vecchi tutti accatastati. Ho visto che era scattato l&apos;interruttore magnetotermico, e ho riattivato la corrente, rendendomi conto che le lavatrici e asciugatrici erano state tutte programmate per azionarsi in intervalli di tempo sovrapposti, motivo che probabilmente ha fatto scattare la corrente in origine. Le ho staccate e sono ritornato nel salone.</p>\r\n<p>Per come la penso io, il proprietario si deve essere ucciso, oppure &egrave; stato qualcuno che &egrave; entrato nella villa dall&apos;esterno, perch&eacute; al momento dello sparo eravamo tutti nel salone.</p>\r\n<p>Dati sulla persona:</p>\r\n<dl>\r\n    <dt>Anni:</dt>\r\n    <dd>51</dd>\r\n    <dt>Lavoro:</dt>\r\n    <dd>Ingegnere elettrotecnico</dd>\r\n    <dt>Passatempo:</dt>\r\n    <dd><span lang=\"en\">Lockpicking</span></dd>\r\n</dl>',NULL,'Testimonianza di Eriberto Mariconda'),('000000000000005','testimonianza','000000000000001','000000000000004','<p>Dopo che Genoveffa &egrave; svenuta, sono rimasta nel salone, cercando di farle riprendere conoscenza. Quando si &egrave; rialzata, ha continuato a parlare di maledizioni e spiriti che infestano la casa. Eravamo entrambe nel salone quando &egrave; avvenuto il furto, con la torcia del cellulare accesa. Appena sentito il rumore di vetro che si rompeva, abbiamo diretto la luce verso la teca, ma non abbiamo visto nessuno, solo il vetro rotto e il cofanetto, che giusto un&apos;ora prima stavo ammirando prima di andare all&apos;aperitivo nel giardino d&apos;inverno, era sparito.</p>\r\n<p>Quello che non capisco &egrave; il motivo per cui il colpevole abbia fatto saltare la corrente, era solo per creare il panico? Oppure aveva un altro scopo, come ad esempio eludere i sistemi di sicurezza? In effetti, facendo saltare la corrente ha spento le telecamere e sbloccato l&apos;ingresso allo studio, che ho notato era chiuso con serrature elettroniche, ma non ha spento i dispositivi che registrano i movimenti sulle porte del salone, che sono essenziali per capire gli spostamenti al buio.</p>\r\n<p>Dati sulla persona:</p>\r\n<dl>\r\n    <dt>Anni:</dt>\r\n    <dd>52</dd>\r\n    <dt>Lavoro:</dt>\r\n    <dd>Consulente per la sicurezza informatica</dd>\r\n    <dt>Passatempo:</dt>\r\n    <dd><span lang=\"en\">Digital forensics</span></dd>\r\n</dl>',NULL,'Testimonianza di Mariangela Finetti'),('000000000000006','testimonianza','000000000000001','000000000000004','<p>Quando &egrave; saltata la corrente e ci siamo resi conto che mio padre era sparito, ho subito pensato che fosse salito in camera sua perch&eacute; si era dimenticato di prendere le pastiglie, cosa che succede di continuo. Sono salito al piano di sopra e ho controllato in camera sua, ma non l&apos;ho trovato. Uscendo dalla camera ho sentito il rumore di vetro infrangersi, e ho pensato che qualcuno avesse urtato nel buio una delle damigiane usate nella produzione di profumo ai tempi della Convallaria, esposte nell&apos;ala est del secondo piano, per&ograve; sul momento non ci ho fatto caso e sono tornato al piano di sotto, dove invece ho scoperto che il rumore era il vetro della teca nel salone.</p>\r\n<p>Quando ci siamo riuniti, vedendo che mio padre ancora non c&apos;era, ho pensato che potesse essere andato nel suo studio ed &egrave; l&igrave; che io ed Eriberto lo abbiamo trovato morto. Oltre al corpo, ho notato subito che l&apos;armadio che contiene i vecchi libri contabili dell&apos;azienda in cui mio padre lavorava era stato aperto.</p>\r\n<p>Dati sulla persona:</p>\r\n<dl>\r\n    <dt>Anni:</dt>\r\n    <dd>48</dd>\r\n    <dt>Lavoro:</dt>\r\n    <dd>Disoccupato</dd>\r\n    <dd>Ha abbandonato gli studi di economia per filosofia</dd>\r\n    <dt>Passatempo:</dt>\r\n    <dd>Pittura</dd>\r\n</dl>',NULL,'Testimonianza di Ermenegildo Dal Maso'),('000000000000007','testimonianza','000000000000001','000000000000004','<p>Secondo me sono stati gli spiriti che infestano questa casa. Negli anni varie disgrazie sono avvenute nella villa: la leggendaria scomparsa del professor Vittorio Trevisan, il tracollo dell&apos;azienda Convallaria, con il declino della famiglia Bolognini e ora questo, e chiss&agrave; quanti altri segreti queste mura potrebbero raccontare. Certo io ne so qualcosa, negli anni ho sentito molto spesso sussurri e risate provenire dalle mura della casa, spesso nell&apos;ala est, dove credo gli spiriti si concentrino maggiormente. L&apos;ho detto molte volte al padron Bolognini, che per&ograve; ogni volta mi derideva, dicendo che era colpa dei &ldquo;topolini nelle mura&rdquo;, diceva sempre cos&igrave;. Anzi, spesso se la prendeva anche con i figli, sgridandoli perch&eacute; credeva che si divertissero a burlarsi di me, ma io so cosa ho sentito.</p>\r\n<p>Quella sera secondo me sono stati gli spiriti del passato. Cosa sia successo di preciso non lo so, anche perch&eacute; di tutti i cimeli esposti nella teca, hanno portato via solo un vecchio cofanetto, che conteneva solo un paio di vecchie chiavi che non hanno mai aperto nessuna porta in villa, ma posso assicurare che quella sera c&apos;&egrave; stata la mano del diavolo. Certo il padron Dal Maso era una persona piuttosto severa, se la prendeva spesso con il figlio per aver rinunciato agli studi di economia verso i quali lui lo aveva indirizzato, e i due litigavano spesso, e litigava anche con il precedente proprietario, con il quale era socio in affari prima che il Bolognini mettesse all&apos;asta la villa, ma sicuramente non meritava di morire per questo.</p>\r\n<p>Dati sulla persona:</p>\r\n<dl>\r\n    <dt>Anni:</dt>\r\n    <dd>79</dd>\r\n    <dt>Lavoro:</dt>\r\n    <dd>Governante in villa dal <time datetime=\"1962\">1962</time></dd>\r\n    <dt>Passatempo:</dt>\r\n    <dd>Membro onorario del club locale di <span lang=\"en\">quilting</span></dd>\r\n</dl>',NULL,'Testimonianza di Genoveffa Lanzi'),('000000000000008','indizio','000000000000001','000000000000004','<p>Costruita nella seconda met&agrave; del &apos;500 come residenza estiva per la nobile famiglia Trevisan, &egrave; stata oggetto di importanti ristrutturazioni ed ampliamenti nel corso del tempo, con particolare attenzione al giardino botanico, per volere del professor Vittorio Antonio Trevisan, stimato botanico che nella seconda met&agrave; dell&apos; &apos;800 ha costruito diverse serre per la coltivazione e lo studio di piante esotiche. Dopo la morte in circostanze misteriose del professor Trevisan, la villa ha vissuto un periodo di degrado a cavallo tra fine &apos;800 e inizio &apos;900, fino all&apos;acquisto nel <time datetime=\"1934\">1934</time> da parte della famiglia Bolognini, proprietaria di un saponificio a conduzione familiare, che ha saputo riconoscere e far propria la passione per la natura che negli anni &egrave; stata il simbolo della villa.</p>\r\n<p>Gli attuali proprietari sono lieti di mettere a dispone alcuni locali all&apos;interno della villa per l&apos;organizzazione di eventi quali feste, convegni e rinfreschi. L&apos;edificio offre un ampio salone da ballo adattabile a sala da pranzo con annessa cucina completamente attrezzata. Mette inoltre a disposizione alcune camere da letto ed eventualmente altre stanze secondo necessit&agrave;. Sar&agrave; possibile inoltre visitare il parco botanico annesso e accedere al giardino d&apos;inverno.</p>\r\n<p>Per prenotazioni rivolgersi a Edgado Dal Maso al numero di telefono 000000000</p>','images/indagine1/capitolo0/villa.jpg','Locandina di Villa Trevisan'),('000000000000009','indizio','000000000000001','000000000000004','<p>La villa si espande in altezza su tre piani ed &egrave; costituita da un edificio centrale e due edifici laterali.</p>\r\n<p>Entrando dalla porta principale, l&apos;ingresso ha l&apos;aspetto di un ampio corridoio orizzontale dal quale si pu&ograve; accedere agli edifici laterali tramite porte collocate alle estremit&agrave; del corridoio, oppure si pu&ograve; accedere al salone da ballo tramite una porta collocata al centro del corridoio. Alternativamente, si pu&ograve; accedere ai piani superiori tramite due scalinate poste sempre alle estremit&agrave; del corridoio.</p>\r\n<p>La sala da ballo dell&apos;edificio centrale &egrave; ora utilizzata come sala da pranzo per gli eventi: qui si trovavano gli ospiti durante la cena al buio. Al centro della stanza si trovano i cimeli della villa, coperti da una teca protettiva.</p>\r\n<p>Dal salone da ballo si pu&ograve; accedere al giardino d&apos;inverno, che percorre l&apos;edificio principale sul retro della casa e contiene una piccola sala lettura, con una libreria. La libreria &egrave; attualmente inutilizzabile, perch&eacute; davanti sono state messe tutte le piante del giardino che avevano bisogno di essere riparate per l&apos;inverno.</p>\r\n<p>Gli edifici laterali al piano terra contengono una singola stanza ciascuno, a destra la cucina, mentre a sinistra un magazzino con lavatrici, asciugatrici e il pannello elettrico della villa.</p>\r\n<p>Al secondo piano, l&apos;edificio centrale &egrave; composto di due corridoi laterali che costituiscono un ballatoio con vista sul salone da ballo. e di una piccola stanza centrale che separa i due corridoi utilizzata dalla vittima come studio, dove hanno rinvenuto il corpo.</p>\r\n<p>Gli edifici laterali del secondo piano contengono le camere da letto, alcune riservate ai proprietari della villa e altre per gli ospiti, e i bagni.</p>\r\n<p>Il terzo piano &egrave; composto di una singola stanza inagibile perch&eacute; in fase di ristrutturazione.</p>','/images/indagine1/capitolo0/mappa.png','Mappa della villa'),('000000000000010','evento','000000000000001','000000000000004','<ul>\r\n    <li>Webcam offline dalle <time datetime=\"21:20\">21:20</time>. Nessun filmato sospetto prima.</li>\r\n    <li>Porte dello studio aperte dalle <time datetime=\"21:20\">21:20</time>. Apertura di sicurezza entrata in azione dopo l&apos;interruzione di corrente.</li>\r\n    <li>Registri dei movimenti nelle porte del salone:\r\n        <dl>\r\n            <dt>Porta tra Giardino d&apos;inverno e Salone:</dt>\r\n            <dd><time datetime=\"21:22\">21:22</time> - un movimento</dd>\r\n            <dd><time datetime=\"21:39\">21:39</time> - un movimento</dd>\r\n            <dd><time datetime=\"22:10\">22:10</time> - un movimento</dd>\r\n            <dd><time datetime=\"22:12\">22:12</time> - un movimento</dd>\r\n            <dd><time datetime=\"22:25\">22:25</time> - due movimenti</dd>\r\n            <dt>Porta tra Ingresso e Salone:</dt>\r\n            <dd><time datetime=\"21:03\">21:03</time> - un movimento</dd>\r\n            <dd><time datetime=\"21:22\">21:22</time> - quattro movimenti</dd>\r\n            <dd><time datetime=\"21:40\">21:40</time> - due movimenti</dd>\r\n            <dd><time datetime=\"21:45\">21:45</time> - un movimento</dd>\r\n            <dd><time datetime=\"21:50\">21:50</time> - un movimento</dd>\r\n            <dd><time datetime=\"21:52\">21:52</time> - due movimenti</dd>\r\n            <dd><time datetime=\"21:57\">21:57</time> - due movimenti</dd>\r\n        </dl>\r\n    </li>\r\n</ul>',NULL,'Analisi dei dispositivi di sicurezza'),('000000000000011','indizio','000000000000001','000000000000004','<p>L&apos;esame autoptico sul corpo di Edgardo Dal Maso ha evidenziato:</p>\r\n<ul>\r\n    <li>La presenza di farmaci (che gli erano stati regolarmente prescritti), assunti poco prima della morte.</li>\r\n    <li>Una contusione sulla nuca precedente alla morte, che si presume si sia procurato sbattendo contro lo spigolo della scrivania.</li>\r\n    <li>Una ferita letale d&apos;arma da fuoco sulla schiena.</li>\r\n</ul>\r\n<p>L&apos;esame sul proiettile ha confermato che l&apos;arma del delitto &egrave; la pistola della vittima, rinvenuta vicino al corpo.</p>',NULL,'Autopsia'),('000000000000012','indizio','000000000000001','000000000000004','<p>La polizia ha rilevato evidenti prove di una collutazione nella scena del delitto.</p>',NULL,'Prove di una collutazione'),('000000000000013','indizio','000000000000001','000000000000004','<section class=\"articlePiece\">\r\n    <header>\r\n        <h2>Grandi trionfi per la Convallaria - <time datetime=\"1934\">1934</time></h2>\r\n    </header>\r\n    <p>Clamoroso il successo della storica azienda Padovana, che negli ultimi mesi ha visto un aumento vertiginoso del suo fatturato, grazie al lancio della nuova linea di profumi &ldquo;Le Chat Noir&rdquo;, in concomitanza con l&apos;apertura della nuova filiale nella famosa strada commerciale di Corso Buenos Aires a Milano.</p>\r\n    <p>Il successo del negozio, che fin dai primi giorni di attivit&agrave; ha richiamato clienti a frotte dalle pi&ugrave; alte estrazioni sociali, &egrave; dovuto all&apos;astuzia di Padron Antonio Bolognini, che ha saputo abilmente convertire parte della produzione dell&apos;azienda verso l&apos;arte della profumeria, creando fragranze pregiate ed inebrianti, con una qualit&agrave; che da sempre ha distinto l&apos;azienda, fin dai suoi albori.</p>\r\n    <p>Nata nel <time datetime=\"1921\">1921</time> come piccola impresa a conduzione familiare per mano di Antonio Bolognini e Augusta Bottaro, la Convallaria si &egrave; distinta fin da subito per la qualit&agrave; dei suoi saponi, creati artigianalmente con prodotti di provenienza locale, come olii, fiori e legni raccolti direttamente nel giardino di famiglia.</p>\r\n    <p>Il clamoroso successo nel corso del tempo ha permesso all&apos;azienda di espandersi pur mantenendo quei valori di qualit&agrave; e cura nei prodotti che l&apos;hanno fin da sempre contraddistinta, e ad oggi la produzione ha scelto di includere anche il ramo della profumeria. Un progetto che si &egrave; rivelato vincente quando le fragranze si sono diffuse per le strade di Milano attirando l&apos;interesse delle clienti pi&ugrave; facoltose.</p>\r\n    <p>Al momento la produzione conta una decina di profumi destinati ad aumentare grazie al recente  acquisto di una villa cinquecentesca in degrado, che la famiglia conta di restaurare, ampliandone il giardino con la coltivazione di nuove variet&agrave; da destinare alla produzione aziendale.</p>\r\n</section>\r\n<section class=\"articlePiece\">\r\n    <header>\r\n        <h2>Svolta ai vertici di Convallaria - <time datetime=\"1961\">1961</time></h2>\r\n    </header>\r\n    <p>In seguito alla dipartita dello storico titolare Antonio Bolognini, il figlio Giovanni, che oggi ha in mano le redini dell&apos;azienda ha deciso di aprire le porte ad un nuovo socio per far fronte alle sempre pi&ugrave; pressanti esigenze di mercato. &Egrave; cos&igrave; che Edgado Dal Maso &egrave; entrato a far parte della famiglia come socio in affari occupandosi della gestione amministrativa dell&apos;azienda.</p>\r\n    <p>Il Dal Maso, assunto come dipendente nel <time datetime=\"1947\">1947</time>, si &egrave; sempre contraddistinto per le sue capacit&agrave; imprenditoriali che hanno mantenuto a galla l&apos;azienda anche in periodi di difficolt&agrave; economica vista la sempre maggiore concorrenza di mercato e questo gli &egrave; valso l&apos;apprezzamento della famiglia Bolognini tanto da farlo entrare come socio. Con il suo ingresso Giovanni pu&ograve; dedicarsi interamente alla produzione sul campo per garantire alta qualit&agrave; ai prodotti, lasciando le incombenze amministrative e burocratiche al Dal Maso.</p>\r\n</section>\r\n<section class=\"articlePiece\">\r\n    <header>\r\n        <h2>La caduta di Convallaria - <time datetime=\"1973\">1973</time></h2>\r\n    </header>\r\n    <p>Inutili sono stati i tentativi di risollevare le sorti della storica azienda padovana che negli ultimi anni ha incontrato gravi difficolt&agrave; finanziarie, fino ad arrivare alla chiusura definitiva imposta dal Tribunale lo scorso mese. Un declino inspiegabile, visto l&apos;evidente successo di vendita dei prodotti nelle diverse filiali sparse sul territorio italiano.</p>\r\n    <p>Villa Trevisan, la residenza di famiglia e cuore pulsante della produzione aziendale, ha chiuso definitivamente i battenti ed &egrave; stata messa all&apos;asta per cercare di arginare, almeno parzialmente, i debiti contratti.</p>\r\n</section>',NULL,'Ritagli di giornale'),('000000000000014','indizio','000000000000001','000000000000001','<p>Un collo di bottiglia rinvenuto sotto ad un tavolo del salone.</p>',NULL,'Collo di bottiglia'),('000000000000015','indizio','000000000000001','000000000000001','<p>Nel vano dove si trovava il cofanetto rubato si trovano dei frammenti di vetro.</p>',NULL,'Vetro sopra al vano del cofanetto'),('000000000000016','indizio','000000000000001','000000000000001','p>Un messaggio rinvenuto nel cestino del salone sul quale &egrave; scritto: &ldquo;Non ci sar&agrave; alcun finanziamento. Un artista di talento &egrave; in grado di guadagnare successo da solo, se ne vale veramente la pena.&rdquo;</p>',NULL,'Messaggio nel cestino'),('000000000000017','indizio','000000000000001','000000000000002','<p>Il guscio di un petardo, rinvenuto nel camino dello studio. La governante dice di non averlo visto la sera prima, quando ha acceso il fuoco.</p>',NULL,'Guscio di un petardo'),('000000000000018','indizio','000000000000001','000000000000002','<p>Un piumino del divano dello studio. Presenta un foro che lo trapassa per intero, con segni di bruciatura.</p>',NULL,'Piumino bucato'),('000000000000019','indizio','000000000000001','000000000000002','<p>Una pagina strappata da un libro contabile, dove si possono leggere alcuni movimenti dell&apos;azienda Convallaria. Altre pagine risultano essere strappate dal libro, nessuna &egrave; stata rinvenuta.</p>\r\n<p id=\"tabSummary\">La tabella contiene i movimenti dell&apos;azienda in ordine progressivo di tempo. Ogni riga descrive il movimento con data, descrizione, entrate ed uscite</p>\r\n<table aria-describedby=\"tabSummary\">\r\n    <tr>\r\n        <th scope=\"col\">Data</th>\r\n        <th scope=\"col\">Descrizione</th>\r\n        <th scope=\"col\">Entrate</th>\r\n        <th scope=\"col\">Uscite</th>\r\n    </tr>\r\n    <tr>\r\n        <td><time datetime=\"1970-05-09\">09/05/1970</time></td>\r\n        <td>Pagamento fattura 1163 - Consorzio Agricolo Ballarin, acquisto bulbi e sementi</td>\r\n        <td>Nessuna</td>\r\n        <td>387.500&euro;</td>\r\n    </tr>\r\n    <tr>\r\n        <td><time datetime=\"1970-05-09\">09/05/1970</time></td>\r\n        <td>Pagamento fattura 3/70 - Zanivello Giardini, sfalcio erba</td>\r\n        <td>Nessuna</td>\r\n        <td>500.000&euro;</td>\r\n    </tr>\r\n    <tr>\r\n        <td><time datetime=\"1970-05-10\">10/05/1970</time></td>\r\n        <td>Prelievo</td>\r\n        <td>Nessuna</td>\r\n        <td>200.000&euro;</td>\r\n    </tr>\r\n    <tr>\r\n        <td><time datetime=\"1970-05-11\">11/05/1970</time></td>\r\n        <td>Incasso fattura 95 - Profumeria Pillan, rivendita</td>\r\n        <td>1.000.000&euro;</td>\r\n        <td>Nessuna</td>\r\n    </tr>\r\n    <tr>\r\n        <td><time datetime=\"1970-05-11\">11/05/1970</time></td>\r\n        <td>Incasso corrispettivi dal <time datetime=\"1970-05-01\">01/05</time> al <time datetime=\"1970-05-08\">08/05/1970</time> - negozio via Buenos Aires</td>\r\n        <td>817.000&euro;</td>\r\n        <td>Nessuna</td>\r\n    </tr>\r\n    <tr>\r\n        <td><time datetime=\"1970-05-13\">13/05/1970</time></td>\r\n        <td>Prelievo</td>\r\n        <td>Nessuna</td>\r\n        <td>150.000&euro;</td>\r\n    </tr>\r\n</table>',NULL,'Frammento di libro contabile'),('000000000000020','indizio','000000000000001','000000000000002','<section class=\"letter\">\r\n    <header>\r\n        <h2>Lettera dalla banca all&apos;azienda Convallaria - <time datetime=\"1971\">1971</time></h2>\r\n    </header>\r\n    <p>Padova, <time datetime=\"1971-10-29\">29/10/1971</time></p>\r\n    <p>Spettabile azienda, con la presente siamo a comunicare la decisione del nostro istituto di credito di non voler concedere ulteriore dilazione del credito vantato nei confronti della vostra societ&agrave; in quanto, nonostante i numerosi solleciti, non vi &egrave; stata l&apos;intenzione da parte vostra di colmare tale debito.</p>\r\n    <p>Vi intimiamo pertanto di provvedere entro 30 giorni dal ricevimento della presente lettera al saldo di quanto dovuto. Non ottenendo risposte positive in tal senso, trascorso il periodo sopra citato, ci vedremo costretti a dar seguito alle vie legali.</p>\r\n    <footer>\r\n        <p>Sicuri di un vostro riscontro in tal senso, porgiamo distinti saluti.</p>\r\n    </footer>\r\n</section>\r\n<section class=\"letter\">\r\n    <header>\r\n        <h2>Lettera da Giovanni Bolognini a Edgardo Dal Maso - <time datetime=\"1971\">1971</time></h2>\r\n    </header>\r\n    <p>Padova, <time datetime=\"1971-11-05\">05/11/1971</time></p>\r\n    <p>Egregio socio,</p>\r\n    <p>Vengo a ricevere in questi giorni, con mia grande sorpresa, una diffida dalla banca nella quale ci intimano di restituire a breve una somma di danaro che, a detta loro, ci hanno concesso come credito.</p>\r\n    <p>Con la presente sono a chiederti spiegazioni in tal senso, in quanto a mio avviso la produzione non ha subito cali o flessioni tali da giustificare codesto ammanco di liquidit&agrave;.</p>\r\n    <p>Resto in attesa di ricevere tue notizie a stretto giro di posta.</p>\r\n    <footer>\r\n        <p>Saluti. <span class=\"signature\">Giovanni Bolognini.</span></p>\r\n    </footer>\r\n</section>',NULL,'Discussione fra soci'),('000000000000021','indizio','000000000000001','000000000000004','Pistola rinvenuta nello studio confermata essere l’arma del delitto dalla perizia\r\nbalistica. Di proprietà della vittima, si trovava già nello studio prima del\r\ndelitto.',NULL,'Pistola di Edgardo'),('000000000000022','indizio','000000000000001','000000000000005','<p>Nella libreria, dietro ad alcuni libri, si trova una serratura con chiave inserita. Girandola, si accede ad un passaggio segreto che porta al magazzino del piano superiore, vicino alle scale. Dentro al passaggio si trova un paio di guanti.</p>\r\n',NULL,'Libreria'),('000000000000023','indizio','000000000000001','000000000000005','<p>Un paio di guanti utilizzati di recente perch&eacute; non presentano polvere, al contrario di tutto il resto del passaggio, in evidente stato di abbandono. Un&apos;analisi di laboratorio ha concluso che non presentano tracce di polvere da sparo.</p>',NULL,'Guanti nel passaggio'),('000000000000024','testimonianza','000000000000001','000000000000006','<p>Matilde, messa a confronto con le prove raccolte, ha dato una sua versione dell&apos;accaduto. Ha rubato il cofanetto durante la cena, approfittando della cecit&agrave; temporanea dei partecipanti, per ottenere le chiavi ed aprire il passaggio segreto nella libreria. Ha poi causato l&apos;interruzione di corrente per sbloccare le porte dello studio ed aprofittare del panico per raggiungere l&apos;armadietto con i registri di Convallaria, alla ricerca di prove contro l&apos;ex-socio del padre. Tuttavia, Edgardo &egrave; entrato nello studio mentre stava strappando le pagine e l&apos;ha attaccata. Segue una collutazione nella quale, per difendersi, lo ha spinto e lui ha sbattuto la testa.</p>\r\n<p>Matilde dice di essere scappata dallo studio in fretta, aver lanciato la damigiana contro la teca del piano di sotto grazie alle abilit&agrave; di precisione maturate negli anni di pallacanestro, ma nega categoricamente di aver ucciso Edgardo.</p>',NULL,'Confessioni di livore');
/*!40000 ALTER TABLE `prova` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provadimostra`
--

DROP TABLE IF EXISTS `provadimostra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provadimostra` (
  `idProva` char(16) NOT NULL,
  `idDomanda` char(16) NOT NULL,
  PRIMARY KEY (`idProva`,`idDomanda`),
  KEY `provadimostra_ibfk_2` (`idDomanda`),
  CONSTRAINT `provadimostra_ibfk_1` FOREIGN KEY (`idProva`) REFERENCES `prova` (`id`),
  CONSTRAINT `provadimostra_ibfk_2` FOREIGN KEY (`idDomanda`) REFERENCES `domanda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provadimostra`
--

LOCK TABLES `provadimostra` WRITE;
/*!40000 ALTER TABLE `provadimostra` DISABLE KEYS */;
INSERT INTO `provadimostra` VALUES ('000000000000001','000000000000014'),('000000000000002','000000000000002'),('000000000000002','000000000000005'),('000000000000002','000000000000006'),('000000000000002','000000000000015'),('000000000000004','000000000000009'),('000000000000005','000000000000007'),('000000000000006','000000000000003'),('000000000000006','000000000000004'),('000000000000007','000000000000012'),('000000000000007','000000000000014'),('000000000000007','000000000000016'),('000000000000009','000000000000004'),('000000000000010','000000000000001'),('000000000000010','000000000000002'),('000000000000010','000000000000006'),('000000000000010','000000000000007'),('000000000000011','000000000000008'),('000000000000012','000000000000008'),('000000000000013','000000000000011'),('000000000000014','000000000000003'),('000000000000015','000000000000005'),('000000000000016','000000000000012'),('000000000000017','000000000000009'),('000000000000017','000000000000013'),('000000000000018','000000000000010'),('000000000000018','000000000000013'),('000000000000019','000000000000011'),('000000000000019','000000000000012'),('000000000000020','000000000000012'),('000000000000021','000000000000010'),('000000000000022','000000000000015'),('000000000000022','000000000000016'),('000000000000023','000000000000017'),('000000000000024','000000000000017');
/*!40000 ALTER TABLE `provadimostra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recensione`
--

DROP TABLE IF EXISTS `recensione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recensione` (
  `id` char(8) NOT NULL,
  `contenuto` varchar(255) NOT NULL,
  `dataIniziale` datetime NOT NULL,
  `dataModifica` datetime DEFAULT NULL,
  `idUtente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUtente` (`idUtente`),
  CONSTRAINT `recensione_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recensione`
--

LOCK TABLES `recensione` WRITE;
/*!40000 ALTER TABLE `recensione` DISABLE KEYS */;
/*!40000 ALTER TABLE `recensione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risposta`
--

DROP TABLE IF EXISTS `risposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risposta` (
  `id` char(16) NOT NULL,
  `codice` int(11) NOT NULL,
  `idDomanda` char(16) NOT NULL,
  `isCorrect` tinyint(1) NOT NULL DEFAULT 0,
  `contenuto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idDomanda` (`idDomanda`),
  CONSTRAINT `risposta_ibfk_1` FOREIGN KEY (`idDomanda`) REFERENCES `domanda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risposta`
--

LOCK TABLES `risposta` WRITE;
/*!40000 ALTER TABLE `risposta` DISABLE KEYS */;
INSERT INTO `risposta` VALUES ('000000000000001',1,'000000000000001',0,'Si'),('000000000000002',2,'000000000000001',1,'No'),('000000000000003',1,'000000000000002',0,'Non è mai uscito'),('000000000000004',2,'000000000000002',0,'Durante l\'apertura'),('000000000000005',3,'000000000000002',0,'Durante il blackout'),('000000000000006',4,'000000000000003',1,'A inizio cena'),('000000000000007',1,'000000000000003',0,'Spingendolo a terra'),('000000000000008',2,'000000000000003',0,'Con una bottiglia d\'acqua'),('000000000000009',3,'000000000000003',1,'Con una damigiana'),('000000000000010',4,'000000000000003',0,'Con un sasso'),('000000000000011',1,'000000000000004',0,'Nel salone'),('000000000000012',2,'000000000000004',1,'Al piano di sopra'),('000000000000013',3,'000000000000004',0,'Nell\'ingresso'),('000000000000014',4,'000000000000004',0,'In giardino'),('000000000000015',1,'000000000000005',0,'Prima dell\'aperitivo'),('000000000000016',2,'000000000000005',1,'Durante la cena'),('000000000000017',3,'000000000000005',0,'Dopo aver rotto la teca'),('000000000000018',4,'000000000000005',0,'Dopo il blackout'),('000000000000019',1,'000000000000006',0,'Armando'),('000000000000020',2,'000000000000006',1,'Edgardo'),('000000000000021',3,'000000000000006',0,'Genoveffa'),('000000000000022',4,'000000000000006',0,'Ermenegildo'),('000000000000023',1,'000000000000007',1,'Tutti'),('000000000000024',2,'000000000000007',0,'Edgardo'),('000000000000025',3,'000000000000007',0,'Edgardo, Ermenegildo'),('000000000000026',4,'000000000000007',0,'Edgardo, Ermenegildo, Genoveffa'),('000000000000027',1,'000000000000008',0,'Si'),('000000000000028',2,'000000000000008',1,'No'),('000000000000029',1,'000000000000009',0,'Per spaventare Edgardo'),('000000000000030',2,'000000000000009',0,'Per festeggiare capodanno'),('000000000000031',3,'000000000000009',0,'Èsempre stato lì '),('000000000000032',4,'000000000000009',1,'Per sviare le indagini'),('000000000000033',1,'000000000000010',0,'Per una bruciatura di sigaretta'),('000000000000034',2,'000000000000010',0,'A causa di una scintilla del camino'),('000000000000035',3,'000000000000010',0,'Un buco del ferro da stiro'),('000000000000036',4,'000000000000010',1,'Per attutire un suono'),('000000000000037',1,'000000000000011',1,'Appropriazione indebita'),('000000000000038',2,'000000000000011',0,'Un’azienda in difficoltà economica'),('000000000000039',3,'000000000000011',0,'Contabilità inattendibile'),('000000000000040',4,'000000000000011',0,'Troppe spese'),('000000000000041',1,'000000000000012',1,'Un socio'),('000000000000042',2,'000000000000012',0,'Genoveffa'),('000000000000043',3,'000000000000012',0,'Gli spiriti'),('000000000000044',4,'000000000000012',1,'Ermenegildo'),('000000000000045',5,'000000000000013',0,'Armando'),('000000000000046',1,'000000000000013',0,'Prima dell’apericena'),('000000000000047',2,'000000000000013',1,'Prima del rumore di sparo'),('000000000000048',3,'000000000000013',0,'Durante il rumore di sparo'),('000000000000049',4,'000000000000013',0,'Dopo il rumore di sparo'),('000000000000050',1,'000000000000014',0,'Vecchie tubature'),('000000000000051',2,'000000000000014',1,'Bambini nelle mura'),('000000000000052',3,'000000000000014',0,'Roditori'),('000000000000053',4,'000000000000014',0,'Lo spirito di Vittorio Trevisan'),('000000000000054',1,'000000000000015',0,'Una verso il salone e una verso il giardino esterno'),('000000000000055',2,'000000000000015',0,'Due verso il salone, una verso il giardino esterno'),('000000000000056',3,'000000000000015',1,'Una verso l’interno, una verso il salone e una verso il giardino esterno'),('000000000000057',4,'000000000000015',0,'Un accesso alle cantine'),('000000000000058',1,'000000000000016',0,'Armando'),('000000000000059',2,'000000000000016',0,'Lucrezia'),('000000000000060',3,'000000000000016',1,'Matilde'),('000000000000061',4,'000000000000016',0,'Eriberto'),('000000000000062',5,'000000000000016',0,'Mariangela'),('000000000000063',6,'000000000000016',0,'Ermenegildo'),('000000000000064',7,'000000000000016',0,'Genoveffa'),('000000000000065',8,'000000000000016',0,'Gli spiriti'),('000000000000066',1,'000000000000017',0,'Armando'),('000000000000067',2,'000000000000017',0,'Lucrezia'),('000000000000068',3,'000000000000017',0,'Matilde'),('000000000000069',4,'000000000000017',0,'Eriberto'),('000000000000070',5,'000000000000017',0,'Mariangela'),('000000000000071',6,'000000000000017',1,'Ermenegildo'),('000000000000072',7,'000000000000017',0,'Genoveffa'),('000000000000073',8,'000000000000017',0,'Gli spiriti'),('000000000000074',5,'000000000000012',0,'Armando');
/*!40000 ALTER TABLE `risposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salvataggio`
--

DROP TABLE IF EXISTS `salvataggio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salvataggio` (
  `idIndagine` char(16) NOT NULL,
  `idUtente` int(11) NOT NULL,
  `progressivoDomanda` char(16) DEFAULT NULL,
  PRIMARY KEY (`idIndagine`,`idUtente`),
  KEY `idUtente` (`idUtente`),
  KEY `progressivoDomanda` (`progressivoDomanda`),
  CONSTRAINT `salvataggio_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`id`),
  CONSTRAINT `salvataggio_ibfk_2` FOREIGN KEY (`progressivoDomanda`) REFERENCES `domanda` (`id`),
  CONSTRAINT `salvataggio_ibfk_3` FOREIGN KEY (`idIndagine`) REFERENCES `indagine` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salvataggio`
--

LOCK TABLES `salvataggio` WRITE;
/*!40000 ALTER TABLE `salvataggio` DISABLE KEYS */;
/*!40000 ALTER TABLE `salvataggio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-15 10:27:58
