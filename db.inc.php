<?php

define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'motell');
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST; // Driver settes her
/*
    try {                                                  //finne feil 
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        echo "Error connecting to database: " . $e->getMessage(); // Aldri gjør dette i produksjon/innlevering! Aldri gi ut info om databasen som ikke er nødvendig
    }
*/
?>