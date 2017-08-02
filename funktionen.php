<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$optionen = array(
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // nur zur Entwicklung!
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
);

$db = new PDO(
    'mysql:host=localhost;dbname=learnbox', // neue DB!
    'root',
    '',
    $optionen
);

$db->query('SET NAMES utf8');  //kommunikation findet in utf-8 statt

//daten aus learnbox-db holen
function holeSqlDaten($daten, $db) {
    if($daten === 'kategorien') {
       $sql = 'SELECT id, titel FROM kategorien WHERE aufgehaengt_an = 0;'; 
    }
    elseif($daten === 'unterkategorien') {
       $sql = 'SELECT id, titel FROM kategorien WHERE aufgehaengt_an > 0;'; 
    }
          
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    return $result;
}

