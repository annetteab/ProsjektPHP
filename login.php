<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motell Booking - Logg inn</title>
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
            <li><a href="booking.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <li><a href="gjesteprofil.php">Min profil</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <section class="login-box">
        <h2>Logg inn</h2>
        <form method="post" action="login.php">
            <label for="email">E-post:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Passord:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Logg inn">
            <a href="user.php" class="button">Registrer deg</a>

        </form>
        
        <?php
session_start(); // Start sesjonen

// Koble til databasen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "motell";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hent brukerdata fra databasen basert på e-post
    $sql = "SELECT bruker_id, fornavn, etternavn, epost, mobil, passord FROM users WHERE epost = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verifiser passord
        if (password_verify($password, $user['passord'])) {
            // Lagre nødvendige data i $_SESSION
            $_SESSION['bruker_id'] = $user['bruker_id'];
            $_SESSION['fornavn'] = $user['fornavn'];
            $_SESSION['etternavn'] = $user['etternavn'];
            $_SESSION['epost'] = $user['epost'];
            $_SESSION['mobil'] = $user['mobil'];

            // Redirect til bookingsiden
            header("Location: booking.php");
            exit;
        } else {
            echo "Feil passord.";
        }
    } else {
        echo "Bruker ikke funnet.";
    }

    $stmt->close();
}

$conn->close();
?>



    </section>
</div>

<footer>
    <p>&copy; 2024 Motell Booking. Alle rettigheter reservert.</p>
</footer>

</body>
</html>
