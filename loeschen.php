<?php
var_dump($_POST);
require_once 'funktionen.php';
// , k2.id, k2.titel
// join kategorien kat und kat1 muss 2-mal aufgerufen werden, weil es sich sonst ueberschreibt
if(!empty($_POST)) {
    
    $sql = "DELETE FROM karteikarten WHERE id={$_POST['karten_id']};";

    $statement = $db->query($sql);
}
//sonst...go back to bearbeiten.php
header('Location: bearbeiten.php');