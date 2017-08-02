USE learnbox;
SELECT k.id, k.frage, kat.titel, b.benutzername, k.erstellt_am 
FROM karteikarten k
JOIN kategorien kat ON k.kategorie_id = kat.id
JOIN benutzer b on k.erstellt_von = b.id;