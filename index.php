<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velkommen til Motell Solsiden</title>
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
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        .hero {
            background-image: url('motell.jpg'); /* Sett inn din bilde-url her */
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .hero h2 {
            font-size: 48px;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .room-types {
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .room-types div {
            flex: 1;
            margin: 0 15px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .room-types h3 {
            color: #444;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Motell Solsiden</h1>
    <p>Velkommen til vårt koselige motell ved kysten</p>
</header>

<nav>
        <ul>
            <li><a href="booking.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="contact.php">Kontakt oss</a></li>
            <li><a href="gjesteprofil.php">Min profil</a></li>
            <li><a href="login.php">Logg inn</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
<div class="hero">
    <h2>Føl deg hjemme, uansett hvor du er</h2>
</div>

<div class="container">
    <h2>Velg ditt opphold</h2>
    <div class="room-types">
        <div>
            <h3>Enkeltrom</h3>
            <p>For den enslige reisende. Koselig og privat.</p>
            <p>Plass til 1 voksen.</p>
        </div>
        <div>
            <h3>Dobbeltrom</h3>
            <p>Perfekt for par eller to venner.</p>
            <p>Plass til 2 voksne.</p>
        </div>
        <div>
            <h3>Junior Suite</h3>
            <p>For ekstra komfort og plass.</p>
            <p>Plass til 2 voksne og 2 barn.</p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Motell Solsiden. Alle rettigheter reservert.</p>
</footer>

</body>
</html>
