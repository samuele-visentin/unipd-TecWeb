drop database if exists tecweb;
create database tecweb;
use tecweb;

create table utente(
    id char(16) primary key,
    username varchar(16) not null UNIQUE,  -- si potrebbe mettere come chiave ma poi aggiornare username forse richiederebbe piu tempo?
    passwordHash varchar(255) not null,
    isAdmin boolean DEFAULT 0
);

CREATE TABLE recensione (
    id char(8) PRIMARY KEY,
    contenuto varchar(255) not null,
    dataIniziale datetime not null,
    dataModifica datetime default null,
    idUtente char(16) not null,
    foreign key (idUtente) REFERENCES utente(id)
);

-- 4. Indagine
CREATE TABLE indagine (
    id CHAR(16) PRIMARY key,
    dataInserimento DATETIME NOT NULL,
    nome VARCHAR(25) NOT NULL,
    descrizione VARCHAR(255) NOT NULL,
    image_path varchar(75) default null
);

-- 3. Salvataggio
CREATE TABLE salvataggio (
    idIndagine CHAR(16) not null,
    idUtente CHAR(16) not null,
    progressivoDomanda INT NOT NULL DEFAULT 1,
    PRIMARY key (idIndagine, idUtente),
    foreign key (idIndagine) REFERENCES indagine(id),
    foreign key (idUtente) REFERENCES utente(id)
);


-- 5. Capitolo
CREATE TABLE capitolo (
    id CHAR(16) PRIMARY KEY,
    idIndagine CHAR(16) not null,
    progressivo INT not null,
    contenuto TEXT NOT NULL,
    foreign key (idIndagine) REFERENCES indagine(id)
);


-- 6. Domanda
CREATE TABLE domanda (
    id CHAR(16) primary key,
    progressivo INT NOT NULL,
    idCapitolo CHAR(16) not null,
    contenuto VARCHAR(255) NOT NULL,
    foreign key (idCapitolo) REFERENCES capitolo(id)
);

-- 7. Risposta
CREATE TABLE risposta (
    id CHAR(16) PRIMARY key,
    codice INT not null,
    idDomanda CHAR(16) not null,
    isCorrect BOOLEAN NOT NULL,
    contenuto VARCHAR(255) NOT NULL,
    foreign key (idDomanda) REFERENCES domanda(id)
);

-- 8. Prova
CREATE TABLE prova (
    id CHAR(16) PRIMARY key,
    tipo ENUM('evento', 'testimonianza', 'indizio') NOT NULL,
    idIndagine CHAR(16) not null,
    idCapitolo CHAR(16) not null,
    descrizione VARCHAR(255) NOT NULL,
    image_path varchar(75) default null,
    foreign key (idIndagine) REFERENCES indagine(id),
    foreign key (idCapitolo) REFERENCES capitolo(id)
);

-- 9. ProvaDimostra
CREATE TABLE provaDimostra (
    idProva CHAR(16) Not null,
    idRisposta CHAR(16) not null,
  	PRIMARY key (idProva, idRisposta),
    foreign key (idProva) REFERENCES prova(id),
    foreign key (idRisposta) REFERENCES risposta(id)
);

--documentoInziale

CREATE TABLE `documentoiniziale` (
  `progressivo` int(11) NOT NULL,
  `tipo` enum('lettera','cronologia') NOT NULL,
  `contenuto` text NOT NULL,
  `idIndagine` char(16) NOT NULL,
  PRIMARY KEY (`progressivo`,`idIndagine`),
    FOREIGN KEY (`idIndagine`) REFERENCES `indagine` (`id`)
);
