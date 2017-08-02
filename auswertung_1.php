<?php
    require_once 'funktionen.php'; 
   
    session_start();
    
    $antwortStatus = Array(
        '0' => 'Nicht beantwortet',
        '1' => 'Richtig',
        '2' => 'Falsch'
    );
 
    ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lernen</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Auswertung</h1>
        <?php foreach ($_SESSION['karteikarten'] AS $key => $auswertung) { ?>
        <b><a href="lernen.php?frage=<?=$key?>"> Frage <?=$key?></a>
            <?=$antwortStatus[$auswertung['status']]?>
            <?php $AuswertungsCount[] =  $auswertung['status']; ?>
        </b>
        <br />
        <?=$auswertung['frage']?>
        <hr />
        <?php 
        }
        $AuswertungsCountTemp = array_count_values($AuswertungsCount);
        foreach ($AuswertungsCountTemp AS $key => $value) {
               echo $antwortStatus[''.$key.''].' : '.$value.'<br />';
        } 
        // var_dump();
        // var_dump($auswertung);
        ?>
        <hr />
        <a href="auswahl_kategorie.php"> Neuer Test </a>
    </body>
</html>


