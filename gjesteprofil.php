<!DOCTYPE html>
<html>
<head>
    <title>Brukerprofil</title>
</head>

<?php
//eksisterende brukerdata i en matrise
$user = array(
    "name" => "Annette Aas Brynhildsen",
    "email" => "annette@test.no",
    "phone" => "87654321"
);

$nameErr = $emailErr = $phoneErr = "";
$newData = array();

// Sjekk om skjemaet er sendt inn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider navn
    if (empty($_POST["name"])) {
        $nameErr = "Navn er obligatorisk";
    } else {
        $newData["name"] = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-ZæøåÆØÅ' \-]*$/", $newData["name"])) {
            $nameErr = "Kun bokstaver, bindestrek og mellomrom tillatt";
        }
    }

// Valider e-post
if (empty($_POST["email"])) {
    $emailErr = "E-post er obligatorisk";
} else {
    $newData["email"] = test_input($_POST["email"]);
    if (!filter_var($newData["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Ugyldig e-post format";
    }
}

// Valider mobilnummer
if (empty($_POST["phone"])) {
    $phoneErr = "Mobilnummer er obligatorisk";
} else {
    $newData["phone"] = test_input($_POST["phone"]);
    if (!preg_match("/^[0-9]{8}$/", $newData["phone"])) {
        $phoneErr = "Mobilnummer må være 8 siffer";
    }
}

// Hvis ingen feil, sjekk om det er noen endringer
if (empty($nameErr) && empty($emailErr) && empty($phoneErr)) {
    $changesMade = false;

    // Sjekk om noe har endret seg, og oppdater matrisen om nødvendig
    foreach ($newData as $key => $value) {
        if ($user[$key] != $value) {
            $user[$key] = $value;
            $changesMade = true;
        }
    }

    // Gi beskjed om oppdatering eller ingen endringer
    if ($changesMade) {
        echo "Brukerprofilen er oppdatert.<br>";
    } else {
        echo "Ingen endringer ble gjort.<br>";
    }
}
}

// Funksjon for å rense inputdata
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<body>
<h2>Oppdater brukerprofil</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Navn: <input type="text" name="name" value="<?php echo $user["name"]; ?>">
    <span style="color:red"><?php echo $nameErr; ?></span>
    <br><br>
    E-post: <input type="text" name="email" value="<?php echo $user["email"]; ?>">
    <span style="color:red"><?php echo $emailErr; ?></span>
    <br><br>
    Mobilnummer: <input type="text" name="phone" value="<?php echo $user["phone"]; ?>">
    <span style="color:red"><?php echo $phoneErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Oppdater">
</form>

</body>
</html>