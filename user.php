<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer ny bruker</title>
    <link rel="stylesheet" href="main.css"> <!-- Eksternt CSS-dokument -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .login-box {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .login-box input[type="text"], 
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-box input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Velkommen til Motellets innloggingsside</h1>
    <nav>
        <ul>
            <li><a href="home.php">Hjem</a></li>
            <li><a href="book.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <li><a href="login.php">Logg inn</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>
<?php
// Koble til databasen
$servername = "localhost"; // Brukernavn for databasen
$username = "root"; // Ditt brukernavn
$password = ""; // Ditt passord
$dbname = "motell"; // Din database

$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk tilkoblingen
if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

//definere variabler og gi dem tomme verdier
$firstname = $lastname = $email = $phone = $password = "";
$firstnameErr = $lastnameErr = $emailErr = $phoneErr = $passwordErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sjekk fornavn
    if (empty($_POST["firstname"])) {
        $firstnameErr = "Navn er obligatorisk";
    } else {
        $firstname = test_input($_POST["firstname"]);
        if (!preg_match("/^[a-zA-ZæøåÆØÅ' \-]*$/", $firstname)) {
            $firstnameErr = "Kun bokstaver og mellomrom er tillatt";
        }
    }

    // Sjekk etternavn
    if (empty($_POST["lastname"])) {
        $lastnameErr = "Navn er obligatorisk";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-ZæøåÆØÅ' \-]*$/", $lastname)) {
            $lastnameErr = "Kun bokstaver og mellomrom er tillatt";
        }
    }

    // Sjekk e-post
    if (empty($_POST["email"])) {
        $emailErr = "E-post er obligatorisk";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Ugyldig e-post format";
        }
    }

    // Sjekk mobilnummer
    if (empty($_POST["phone"])) {
        $phoneErr = "Mobilnummer er obligatorisk";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{8}$/", $phone)) {
            $phoneErr = "Ugyldig mobilnummer. Må være 8 siffer.";
        }
    }

    // Sjekk passord
    if (empty($_POST["password"])) {
        $passwordErr = "Passord er obligatorisk";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordErr = "Passordet må være minst 6 tegn langt";
        }
    }

    // Hvis ingen feil, lagre brukerdata
    if (empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($phoneErr) && empty($passwordErr)) {
        // Hash passordet for sikkerhet
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL-innsettingsspørring
        $sql = "INSERT INTO users (fornavn, etternavn, epost, mobil, passord, rolle) VALUES (?, ?, ?, ?, ?, 'gjest')";
        
        // Forbered og bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $hashed_password);

        // Utfør spørringen
        if ($stmt->execute()) {
            echo "Ny bruker registrert!";
        } else {
            echo "Feil ved registrering: " . $stmt->error;
        }

        // Lukk setningen
        $stmt->close();
    }
}

// Funksjon for å rense inputdata
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Lukk tilkoblingen
$conn->close();
?>

<body>
    <h2>Registrer ny bruker</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="register-form">
        <label for="firstname">Fornavn:</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>">
        <span class="error"><?php echo $firstnameErr; ?></span>
        <br><br>

        <label for="lastname">Etternavn:</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
        <span class="error"><?php echo $lastnameErr; ?></span>
        <br><br>

        <label for="email">E-post:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
        <br><br>
        
        <label for="phone">Mobilnummer:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>
        <br><br>
        
        <label for="password">Passord:</label>
        <input type="password" id="password" name="password">
        <span class="error"><?php echo $passwordErr; ?></span>
        <br><br>
        
        <input type="submit" name="submit" value="Registrer">
    </form>
</body>

</html>