<?php
require_once 'funktionen.php';

//var_dump($_POST);
if(!empty($_POST))   // Checken, ob die Seite von bearbeiten.php aufgerufen wurde
{
    $kategorien = holeSqlDaten('kategorien', $db);
    $unterkategorien = holeSqlDaten('unterkategorien', $db);

    $sql = "SELECT * FROM karteikarten WHERE id={$_POST['karten_id']};";
    $stmt = $db->query($sql);

    $karteikarte = $stmt->fetch();
   // var_dump($karteikarte);
} else {
    header('Location: bearbeiten.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Karte bearbeiten</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require('header.php');?>
        <form action="aktualisieren.php" method="POST" id="aktualisierenForm">
            <input type="hidden" name="karten_id" value="<?php echo $karteikarte['id']; ?>">
            <!--TODO: Kategorien dynamisch aus der DB holen-->
            <select name="kategorie_id" onChange="cardChanging();" onKeyup="cardChanging();">
                <?php foreach ($kategorien as $k) { ?>
                    <option value="<?php echo $k['id']; ?>"
                        <?php if($k['id'] === $karteikarte['kategorie_id']){echo 'selected';} ?>>
                        <?php echo $k['titel']; ?>
                    </option> 
                <?php } ?>               
            </select>
            <select name="unterkategorie_id" onChange="cardChanging();" onKeyup="cardChanging();">
                <?php foreach ($unterkategorien as $u) { ?>
                    <option value="<?php echo $u['id']; ?>"
                        <?php if($u['id'] === $karteikarte['unterkategorie_id']){echo 'selected';} ?>>
                        <?php echo $u['titel'];?>
                    </option>        
                <?php } ?>                            
            </select>
            <textarea name="frage" onChange="cardChanging();" onKeyup="cardChanging();" placeholder="Frage eintragen"><?php echo $karteikarte['frage']; ?></textarea>
            <textarea name="antwort" onChange="cardChanging();" onKeyup="cardChanging();" placeholder="Antwort eintragen"><?php echo $karteikarte['antwort']; ?></textarea>
            <input type="submit" value="aktualisieren"> | 
            <input type="reset" value="verwerfen" onClick="history.back()">
        </form>
        <style type="text/css">
            //wenn die formularfelder leer sind, dann dupliziere die karte
            #button_sichtbar{
                //display: none;
            }
            </style>
        <form id="button_sichtbar" action="duplizieren.php" method="post">
            <input type="hidden" name="karten_id" value="<?php echo $karteikarte['id']; ?>">
            <input type="submit" id="duplizieren" value="duplizieren">
            <script>
                function cardChanging()
                {
                    document.getElementById('button_sichtbar').style.display="none";
                }
            </script>
        </form>
            <script src="js/ajax_load_unterkategorie.js"></script>
        <?php
        // put your code here
        ?>

    </body>
</html>
