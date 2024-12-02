<?php
// Start sesjonen
session_start();

// Funksjon for å sjekke om brukeren er logget inn
function checkAuth() {
    // Hvis brukerens ID er lagret i sesjonen, er de logget inn
    if (isset($_SESSION['bruker_id'])) {
        return true;
    } else {
        return false;
    }
}

// Funksjon for å logge ut brukeren
function logout() {
    // Slett sesjonsdata
    session_unset();
    session_destroy();
    header("Location: login.php"); // Omadresser til innloggingssiden
    exit();
}

// Funksjon for å logge inn (kan brukes på innloggingssiden)
function login($bruker_id, $fornavn, $etternavn) {
    $_SESSION['bruker_id'] = $bruker_id;
    $_SESSION['fornavn'] = $fornavn;
    $_SESSION['etternavn'] = $etternavn;
}
?>
