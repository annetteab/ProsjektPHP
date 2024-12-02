<?php

// Start sessionen for å få tilgang til session-variabler
session_start();

// Sjekk om brukeren er logget inn
if (isset($_SESSION['bruker_id'])) {
    // Fjern alle session-variabler
    $_SESSION = array();

    // Ødelegg sessionen
    session_destroy();

    // Diriger brukeren til login-siden etter logout
    header("Location: login.php");  // Eller en annen side du ønsker å sende brukeren til
    exit;
} else {
    // Hvis ingen bruker er logget inn, kan du videresende til login-siden
    header("Location: login.php");
    exit;
}
?>

