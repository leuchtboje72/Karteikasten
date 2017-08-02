<?php
require_once 'funktionen.php';
// , k2.id, k2.titel
// join kategorien kat und kat1 muss 2-mal aufgerufen werden, weil es sich sonst ueberschreibt
$sql = 'SELECT kk.id AS karts_id, kk.frage, kat1.titel AS kat_titel, 
        kat.titel AS subkat_titel, b.benutzername, kk.erstellt_am 
        FROM karteikarten kk
        JOIN kategorien kat ON kk.unterkategorie_id = kat.id
        JOIN kategorien kat1 ON kat.aufgehaengt_an = kat1.id
        JOIN benutzer b ON b.id = kk.erstellt_von;';

$statement = $db->query($sql);
$karteikarten = $statement->fetchAll();
//var_dump($karteikarten);
//unset($statement);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Karte bearbeiten</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require_once('header.php');?>
        <table>
            <thead>
                <tr>
                    <th>KK - ID</th>
                    <th>Frage</th>
                    <th>Kategorie</th>
                    <th>Subkategorie</th>
                    <th>Benutzer</th>
                    <th>erstellt am</th>
                    <th></th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>

                <?php foreach ($karteikarten as $k) { ?>
                    <tr>
                        <td><?php echo $k['karts_id']; ?></td>
                        <td><?php echo $k['frage']; ?></td>
                        <td><?php echo $k['kat_titel']; ?></td>
                        <td><?php echo $k['subkat_titel']; ?></td>
                        <td><?php echo $k['benutzername']; ?></td>
                        <td><?php echo $k['erstellt_am']; ?></td>
                        <td>
                      <form action="loeschen.php" method="POST">
                <input type = "hidden" name="karten_id" value="<?=$k['karts_id']?>">                                <input type="submit" value="l&ouml;schen">
                      </form>
                        </td>
                        <td>
                      <form action="bearbeiten_karte.php" method="POST">
                <input type = "hidden" name="karten_id" value="<?=$k['karts_id']?>">                                <input type="submit" value="bearbeiten">
                      </form>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

        <?php
        // put your code here
        ?>

    </body>
</html>
