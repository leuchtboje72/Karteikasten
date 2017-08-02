/*LearnBox*/
DROP DATABASE IF EXISTS learnbox;
CREATE DATABASE learnbox;
USE learnbox;
CREATE TABLE karteikarten (
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    kategorie_id SMALLINT UNSIGNED,
    unterkategorie_id SMALLINT UNSIGNED,
    frage TEXT NOT NULL,
    antwort TEXT,
    erstellt_von SMALLINT UNSIGNED,
    erstellt_am DATETIME,
    geaendert_von SMALLINT UNSIGNED,
    geaendert_am DATETIME
);
/*inhalte einfuegen*/
INSERT INTO karteikarten VALUES
(1, 1, 11, 'frage 1', 'antwort 1', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12'),
(2, 1, 12, 'frage 2', 'antwort 2', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12'),
(3, 2, 16, 'frage 3', 'antwort 3', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12'),
(4, 2, 17, 'frage 4', 'antwort 4', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12'),
(5, 3, 18, 'frage 5', 'antwort 5', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12'),
(6, 4, 19, 'frage 6', 'antwort 6', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12');

SELECT * FROM karteikarten;
SHOW COLUMNS FROM karteikarten;

CREATE TABLE kategorien (
	id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    aufgehaengt_an SMALLINT UNSIGNED,
    titel VARCHAR(50) NOT NULL
);
/*Inhalte einfuegen*/
INSERT INTO kategorien VALUES
(1, 0, 'Grundlagen der Anwendungsentwicklung'),
(2, 0, 'Einfache IT-Systeme'),
(3, 0, 'Vernetzte IT-Systeme'),
(4, 0, 'WiSo'),
(11, 1, 'ERD'),
(12, 1, 'PAP'),
(13, 1, 'Struktogramm'),
(14, 1, 'Pseudocode'),
(15, 1, 'SQL'),
(16, 2, 'Schnittstellen'),
(17, 2, 'Grundlagen'),
(18, 3, 'OSI-Modell'),
(19, 4, 'BWL');

CREATE TABLE benutzer (
	id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    benutzername VARCHAR(50) UNIQUE NOT NULL,
    passwort VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE
);
/*Fuellung der table benutzer*/
INSERT INTO benutzer VALUES
(1, 'Biggy', 'anders', 'leuchtboje72@msn.com');
SELECT* FROM kategorien;
SHOW COLUMNS FROM benutzer; 
SELECT * FROM karteikarten, kategorien
JOIN kategorien ON kategorien.id = kategorien.aufgehaengt_an
JOIN kategorien ON kategorien.id = karteikarten.unterkategorie_id;