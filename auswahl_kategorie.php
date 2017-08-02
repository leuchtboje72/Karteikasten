<?php
require_once 'funktionen.php';
$kategorien = holeSqlDaten('kategorien', $db);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lernen</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
          <form action="lernen_1.php" method="POST">
            <!--TODO: Kategorien dynamisch aus der DB holen-->
            <select name="kategorie_id" id="kategorie_id">
                <?php foreach ($kategorien as $k) { ?>
                    <option value="<?php echo $k['id']; ?>">
                        <?php echo $k['titel']; ?>
                    </option> 
                 <?php } ?>               
            </select>
         <!--   <input type="hidden" name="kat_titel" value="<?php echo $k['titel']; ?>"> -->
            <input type="submit" value="Na dann..."> | 
            <input type="reset" value="verwerfen">
        </form>
        <script src="js/ajax_load_unterkategorie.js"></script>
        <?php
        // put your code here
        ?>

    </body>
</html>
