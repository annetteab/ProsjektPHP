<!-- HTML-skjema -->
<!DOCTYPE html>
<html>
<head>
    <title>Registrer ny bruker</title>
</head>

<?php
//definere variabler og gi dem tomme verdier
$name = $email = $phone = $password = "";
$nameErr = $emailErr = $phoneErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //sjekk navn
    if (empty($_POST["name"])) {
        $nameErr = "Navn er obligatorisk";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-ZæøåÆØÅ' \-]*$/", $name)) {
            $nameErr = "Kun bokstaver og mellomrom er tillatt";
        }
    }

//sjekk e-post
if (empty($_POST["email"])) {
    $emailErr = "E-post er obligatorisk";
} else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Ugyldig e-post format";
    }
}


//Sjekk tlfnr
if (empty($_POST["phone"])) {
    $phoneErr = "Mobilnummer er obligatorisk";
} else {
    $phone = test_input($_POST["phone"]);
    if (!preg_match("/^[0-9]{8}$/", $phone)) {      //validere input for å se om det matcher et mønster
        $phoneErr = "Ugyldig mobilnummer. Må være 8 siffer.";
    }
}

//sjekk passord
if (empty($_POST["password"])) {
    $passwordErr = "Passord er obligatorisk";
} else {
    $password = test_input($_POST["password"]);
    if (strlen($password) < 6) {
        $passwordErr = "Passordet må være minst 6 tegn langt";
    }
}

// Hvis ingen feil, lagre brukerdata
if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($passwordErr)) {
    $user = array(
        "Navn" => $name,
        "E-post" => $email,
        "Mobilnummer" => $phone
    );

    echo "Ny bruker registrert:<br>";
    echo "<pre>";
    print_r($user);
    echo "</pre>";
}
}
// Funksjon for å rengjøre inputdata
function test_input($data) {
    $data = trim($data);                //fjerner unødvendig mellomrom
    $data = stripslashes($data);        //fjerner backslash fra input
    $data = htmlspecialchars($data);    //konverter spesialtegn til HTML-entiteter for å unngå XSS-angrep
    return $data;
}
?>

<body>
    <h2>Registrer ny bruker</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Navn: <input type="text" name="name" value="<?php echo $name; ?>">
        <span style="color:red"><?php echo $nameErr; ?></span>
        <br><br>
        E-post: <input type="text" name="email" value="<?php echo $email; ?>">
        <span style="color:red"><?php echo $emailErr; ?></span>
        <br><br>
        Mobilnummer: <input type="text" name="phone" value="<?php echo $phone; ?>">
        <span style="color:red"><?php echo $phoneErr; ?></span>
        <br><br>
        Passord: <input type="password" name="password">
        <span style="color:red"><?php echo $passwordErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Registrer">
    </form>
</body>
</html>