USE learnbox;
SELECT karte.id, frage, antwort, titel AS karten_id 
    FROM karteikarten karte
JOIN kategorien kat ON karte.unterkategorie_id=kat.id    
WHERE kat.id>0;