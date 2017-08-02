<?php
require_once 'funktionen.php';
//daten abfragen fuer dyn. eintragung in kat_id und subkat_id
$kategorien = holeSqlDaten('kategorien', $db);
$unterkategorien = holeSqlDaten('unterkategorien', $db);

if(!empty($_POST))
{
/*
$sql = "INSERT INTO karteikarten
(kategorie_id, unterkategorie_id, frage, antwort, erstellt_von, erstellt_am, geaendert_von, geaendert_am)
VALUES
(" 
        . $_POST['kategorie_id'] 
        . ",  "
        . $_POST['unterkategorie_id']
        . ", '"
        . $_POST['frage']
        . " ', '"
        . $_POST['antwort']
        ."', 1, '"
        . date('Y-m-d H:i:s')
 *      . "', 1, '"
 *      . date('Y-m-d H:i:s')
 *      . "');";
 */
////////////oder in geschweiften klammern
$sql = "INSERT INTO karteikarten
(kategorie_id, unterkategorie_id, frage, antwort, erstellt_von, erstellt_am, geaendert_von, geaendert_am)
VALUES
({$_POST['kategorie_id']}, {$_POST['unterkategorie_id']}, '{$_POST['frage']}',
    '{$_POST['antwort']}', 1, NOW(), 1, NOW());";
//TODO: Benutzer dynamisch aus der Session auslesen

$stmt = $db->query($sql);
//$karteikarten = $statement->fetchAll();
//var_dump($karteikarten);
//unset($statement);
/*
 * if(isset($_POST['kategorie']) && isset($_POST['unterkategorie']) && isset($_POST['frage']) && isset($_POST['antwort'])) {
    mit php und auch mit javascript auf validierung prüfen
}
 */
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Karte erstellen</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require_once('header.php');?>
        <form action="#" method="POST">
            <!--TODO: Kategorien dynamisch aus der DB holen-->
            <select name="kategorie_id" id="kategorie_id">
                <?php foreach ($kategorien as $k) { ?>
                    <option value="<?php echo $k['id']; ?>">
                        <?php echo $k['titel']; ?>
                    </option> 
                 <?php } ?>               
            </select>
            
            <select name="unterkategorie_id" id="unterkategorie_id">
                 <?php foreach ($unterkategorien as $u) { ?>
                    <option value="<?php echo $u['id']; ?>">
                        <?php echo $u['titel']; ?>
                    </option>        
                 <?php } ?>                            
            </select>
            <textarea name="frage" placeholder="Frage eintragen"></textarea>
            <textarea name="antwort" placeholder="Antwort eintragen"></textarea>
            <input type="submit" value="eintragen" name="senden" id="senden"> | 
            <input type="reset" value="verwerfen">
        </form>
        <script src="js/ajax_load_unterkategorie.js"></script>
        <?php
        // put your code here
        ?>

    </body>
</html>
