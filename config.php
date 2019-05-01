<?php
    $host = "db.ist.utl.pt";
    $user ="ist424863";
    $password = "bd2018";
    $dbname = $user;
    
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
