<?php
    require_once 'funktionen.php'; 
   
    session_start();
    
    
        $antwortStatus = Array(
        '0' => 'Nicht bewertet',
        '1' => 'Richtig',
        '2' => 'Falsch'
    );
    
     
    if (empty($_GET['frage'])) {
        $_GET['frage'] = '';
    }  
    
    if (!empty($_GET['frage'])) {
        
        
        if (array_key_exists($_GET['frage'], $_SESSION['karteikarten'])) {
        
                $_SESSION['fragennr'] = $_GET['frage'];

                if(  $_GET['frage'] >= $_SESSION['fragen_gesamt']) {

                    $_SESSION['button_weiter'] = false;
                    $_SESSION['frage_vor'] = $_SESSION['fragennr'];

                }
                else {
                    $_SESSION['button_weiter'] = true;
                    $_SESSION['frage_vor'] = $_SESSION['fragennr'] + 1;
                }

                if($_GET['frage'] == '1'  ) {
                    $_SESSION['button_zurueck'] = false;
                    $_SESSION['frage_zurueck'] = $_SESSION['fragennr'];
                }
                else {
                    $_SESSION['button_zurueck'] = true;
                    $_SESSION['frage_zurueck'] = $_SESSION['fragennr'] - 1;
                }
        }
        else {
            header('Location: auswahl_kategorie.php');
        }
    }
    elseif(!empty($_GET['antwort'])) {
        
        $_SESSION['karteikarten'][''.$_SESSION['fragennr'].'']['status'] = intval($_GET['antwort']);
    } 
        
    elseif(!empty($_POST)) {
        
        $sql = "SELECT  titel AS Kategorie
                FROM    kategorien 
                WHERE   id = {$_POST['kategorie_id']}
               ";        
        
        $stmt = $db->query($sql);
        $kategorie = $stmt->fetch();
        
        $sql = "SELECT  kar.id
                       ,kar.frage
                       ,kar.antwort
                       ,kat1.titel AS Unterkategorie
                FROM    karteikarten kar 
                JOIN    kategorien kat1
                ON      kat1.id = kar.unterkategorie_id
                WHERE   kar.kategorie_id = {$_POST['kategorie_id']}
               ";        
        
        $stmt = $db->query($sql);
        $karteikarten = $stmt->fetchAll();
        
        shuffle ($karteikarten);
        
        foreach($karteikarten as $key => $value)
        {
            $karteikarten_neu[$key + 1] = $value;
            
            
        }
        foreach($karteikarten_neu as $key => $value)
        {
            $karteikarten_neu[$key]['status'] = 0;
            
        }
        
        $_SESSION = array();
       
        $_SESSION['fragennr'] = 1;
        $_SESSION['frage_vor'] = $_SESSION['fragennr'] + 1;
        $_SESSION['button_weiter'] = true;
        $_SESSION['button_zurueck'] = false;
        
        $_SESSION['karteikarten'] = $karteikarten_neu;
        $_SESSION['fragen_gesamt'] = count($karteikarten_neu);
        $_SESSION['kategorie'] = $kategorie['Kategorie'];
        
    } else {
        
        header('Location: auswahl_kategorie.php');
        
    }
    
    // var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lernen</title>
        <style></style>
    </head>
    <body>

        <h3><?=$_SESSION['kategorie']?></h3>   
        <p><?php echo $_SESSION['karteikarten'][''.$_SESSION['fragennr'].'']['Unterkategorie']; ?></p>
        <h4>Frage <?php echo $_SESSION['fragennr']; ?> von <?php echo $_SESSION['fragen_gesamt']; ?></h4>   
        <p>Status : <?=$antwortStatus[$_SESSION['karteikarten'][''.$_SESSION['fragennr'].'']['status']]?></p>
        
        <p>Frage: <br /><?php echo $_SESSION['karteikarten'][''.$_SESSION['fragennr'].'']['frage']; ?></p>
        <p id="antwort">Antwort : <br /><?php echo $_SESSION['karteikarten'][''.$_SESSION['fragennr'].'']['antwort']; ?></p>
        <button id="bt_antwort_einblenden" onclick="blendeAntwortEin();">Antwort einblenden</button>
        <br>

        <form action="lernen.php" method="GET">
        <input type="hidden" name="antwort" value="2">
        <button type="submit" id="bt_falsch">Falsch</button>
        </form>
        
        <form action="lernen.php" method="GET">
            <input type="hidden" name="antwort" value="1">
        <button type="submit" id="bt_richtig">Richtig</button>
        </form>
        <br>

        <?php if ($_SESSION['button_zurueck']) { ?>
        <a href="?frage=<?=$_SESSION['frage_zurueck']?>"> zur&uuml;ck  <?=$_SESSION['frage_zurueck']?></a>
        <?php } ?>
        
        <?php if ($_SESSION['button_weiter']) { ?>
        <a href="?frage=<?=$_SESSION['frage_vor']?>"> weiter zu Frage <?=$_SESSION['frage_vor']?></a>
        <?php } ?>
        
        <a href="lernen_auswertung.php"> Auswertung </a>
        
        <script>
            document.getElementById('antwort').style.display = 'none';
            document.getElementById('bt_falsch').style.display = 'none';
            document.getElementById('bt_richtig').style.display = 'none';

            function blendeAntwortEin() {
                document.getElementById('antwort').style.display = 'block';
                document.getElementById('bt_falsch').style.display = 'inline';
                document.getElementById('bt_richtig').style.display = 'inline';
                document.getElementById('bt_antwort_einblenden').style.display = 'none';
            } 
            function faerbeHintergrundRot() {
                document.getElementById('bt_falsch').style.backgroundColor = 'red';
                document.getElementById('bt_richtig').style.backgroundColor = 'rgb(221,221,221';
            }
            function faerbeHintergrundGruen() {
                document.getElementById('bt_falsch').style.backgroundColor = 'rgb(221,221,221';
                document.getElementById('bt_richtig').style.backgroundColor = 'green';
            }
            
        </script>
    </body>
</html>
