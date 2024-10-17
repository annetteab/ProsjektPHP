<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motell Booking</title>
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

        .search-box {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <h1>Velkommen til Motellets Bookingsystem</h1>
    <nav>
        <ul>
            <li><a href="home.php">Hjem</a></li>
            <li><a href="book.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <section class="intro">
        <h2>Om Motellet</h2>
        <p>Motellet vårt tilbyr komfortable rom til en rimelig pris. Vi har tre forskjellige romtyper: enkeltrom, dobbeltrom og junior suite. Vårt mål er å gi våre gjester en behagelig og avslappende opplevelse.</p>
    </section>

    <section class="search-box">
        <h3>Søk etter ledige rom</h3>
        <form method="post" action="search.php">
            <label for="check_in">Innsjekk:</label>
            <input type="date" id="check_in" name="check_in" required><br><br>

            <label for="check_out">Utsjekk:</label>
            <input type="date" id="check_out" name="check_out" required><br><br>

            <label for="adults">Antall voksne:</label>
            <input type="number" id="adults" name="adults" min="1" required><br><br>

            <label for="children">Antall barn:</label>
            <input type="number" id="children" name="children" min="0"><br><br>

            <input type="submit" value="Søk Rom">
        </form>
    </section>
</div>

<footer>
    <p>&copy; 2024 Motell Booking. Alle rettigheter reservert.</p>
</footer>

</body>
</html>


<?php


/*
$booking_id
$user_id
$room_id
$check_in_date
$check_out_date
$adults
$children
*/

?>