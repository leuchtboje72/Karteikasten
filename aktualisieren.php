<?php
require_once 'funktionen.php';

var_dump($_POST);
if(!empty($_POST))   // Checken, ob die Seite von bearbeiten.php aufgerufen wurde
{
   //karte updaten
    $sql = "UPDATE karteikarten 
            SET kategorie_id={$_POST['kategorie_id']}, "
            . "unterkategorie_id={$_POST['unterkategorie_id']}, 
            frage='{$_POST['frage']}', 
            antwort='{$_POST['antwort']}', 
                geaendert_von=1, geaendert_am=NOW() 
                WHERE id={$_POST['karten_id']} LIMIT 1;";

    $db->query($sql);
    
}
    header('Location: bearbeiten.php');


