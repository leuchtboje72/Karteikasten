<?php    
// Version 2, Kai
// Fehlerbehandlungen müssen noch eingebaut werden

require_once 'funktionen.php'; 

// Könnte in die funktionen.php ausgelagert werden.
function ajaxLoadUnterkategorie($id,$db) {
    
    $sql = "SELECT   id
                    ,titel
            FROM     kategorien 
            WHERE   aufgehaengt_an = '$id'
            ";
    $stmt = $db->query($sql);
    $row_count = $stmt->rowCount();
    $ergebniss = $stmt->fetchAll();
    
    // Wenn keine Unterkategorie vorhanden ist, bricht das Script mit Exit ab.
    // Und es erfolgt kein Ajax Response
    if(!$row_count) {
        exit;
    }
    return $ergebniss;
}


$id = !empty($_GET['id']) ? $_GET['id'] : false;
$uid = !empty($_GET['uid']) ? $_GET['uid'] : false;


$unterkategorien = ajaxLoadUnterkategorie($id,$db);  
?>
    <select name="unterkategorie_id" id="unterkategorie_id">
        <?php foreach($unterkategorien AS $unterkategorie){ ?>
            <option value="<?php echo $unterkategorie['id']; ?>"
                <?php if ($unterkategorie['id'] === $uid ) {echo 'selected';}?> >      
                <?php echo $unterkategorie['titel']; ?></option>
        <?php } ?>
    </select>
