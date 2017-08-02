USE learnbox;
INSERT INTO karteikarten
(kategorie_id, unterkategorie_id, frage, antwort, erstellt_von, erstellt_am, geaendert_von, geaendert_am)
VALUES
(1, 12, 'Frage 8', 'Antwort 8', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12'),
(1, 12, 'Frage 4', 'Antwort 4', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12'),
(1, 12, 'Frage 45', 'Antwort 45', 1, '2016-01-11 11:11:11', 1, '2016-01-11 11:11:12');
SELECT * FROM karteikarten;