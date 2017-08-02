USE learnbox;
UPDATE karteikarten SET kategorie_id=1, unterkategorie_id=12, frage='Frage geupdated',
antwort='antwort geupdatet', geaendert_von=1, geaendert_am=NOW() WHERE id=1 LIMIT 1;
SELECT * FROM karteikarten;