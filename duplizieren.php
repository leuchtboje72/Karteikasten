<?php
require_once 'funktionen.php';

var_dump($_POST);

if(!empty($_POST))   // Checken, ob die Seite von Karte bearbeiten.php leer aufgerufen wurde
{
    $sql = "SELECT * FROM karteikarten WHERE id = {$_POST['karten_id']};";
    $stmt=$db->query($sql);
    $karteikarte = $stmt->fetch();
   //karte duplizieren
   $sql = "INSERT INTO karteikarten
(kategorie_id, unterkategorie_id, frage, antwort, erstellt_von, erstellt_am, geaendert_von, geaendert_am)
VALUES
({$karteikarte['kategorie_id']}, {$karteikarte['unterkategorie_id']}, '{$karteikarte['frage']}',
    '{$karteikarte['antwort']}', 1, NOW(), 1, NOW());";
    $db->query($sql);
}
   header('Location: bearbeiten.php');


