<?php
require_once 'funktionen.php';

var_dump($_POST);
$sql = 'SELECT kk.id AS karts_id, kk.frage, kat1.titel AS kat_titel, 
        kat.titel AS subkat_titel, b.benutzername, kk.erstellt_am 
        FROM karteikarten kk
        JOIN kategorien kat ON kk.unterkategorie_id = kat.id
        JOIN kategorien kat1 ON kat.aufgehaengt_an = kat1.id
        JOIN benutzer b ON b.id = kk.erstellt_von;';
if(!empty($_POST))   // Checken, ob die Seite von bearbeiten.php aufgerufen wurde
{
    $kategorien = holeSqlDaten('kategorien', $db);
    $unterkategorien = holeSqlDaten('unterkategorien', $db);

    $sql = "SELECT * FROM karteikarten WHERE id={$_POST['karten_id']};";
    $stmt = $db->query($sql);

    $karteikarte = $stmt->fetch();
    //var_dump($karteikarte);
} else {
    header('Location: erstellen.php');
}
$statement = $db->query($sql);
$karteikarten = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Karte eintragen</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require_once('header.php');?>
        <form action="#" method="POST">
            <!--TODO: Kategorien dynamisch aus der DB holen-->
            <select name="kategorie_id">
                <?php foreach ($kategorien as $k) { ?>
                    <option value="<?php echo $k['id']; ?>"
                        <?php if($k['id'] === $karteikarte['kategorie_id']){echo 'selected';} ?>>
                        <?php echo $k['titel']; ?>
                    </option> 
                <?php } ?>               
            </select>
            <select name="unterkategorie_id">
                <?php foreach ($unterkategorien as $u) { ?>
                    <option value="<?php echo $u['id']; ?>"
                        <?php if($u['id'] === $karteikarte['unterkategorie_id']){echo 'selected';} ?>>
                        <?php echo $u['titel'];?>
                    </option>        
                <?php } ?>                            
            </select>
            <textarea name="frage" placeholder="Frage eintragen"><?php echo $karteikarte['frage']; ?></textarea>
            <textarea name="antwort" placeholder="Antwort eintragen"><?php echo $karteikarte['antwort']; ?></textarea>
            <input type="submit" value="eintragen" name="senden" id="senden"> | 
            <input type="reset" value="verwerfen">
        </form>
        <?php
        // put your code here
        ?>

    </body>
</html>
