<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "motell";
$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk tilkobling
if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

// Hent romnummer fra URL
if (isset($_GET['room'])) {
    $romnummer = $_GET['room'];

    // Hent romdetaljer
    $sql = "SELECT * FROM Rom WHERE Romnummer = '$romnummer'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "Rom ikke funnet.";
        exit();
    }
}

// Oppdater data når skjema sendes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $beskrivelse = $_POST['beskrivelse'];
    $pris = $_POST['pris'];
    $maks_voksne = $_POST['maks_voksne'];
    $maks_barn = $_POST['maks_barn'];
    $tilgjengelighet = $_POST['tilgjengelighet'];
    $etasje = $_POST['etasje'];
    $nar_heis = $_POST['nar_heis'];

    $update_sql = "UPDATE Rom SET 
        Type='$type',
        Beskrivelse='$beskrivelse',
        Pris='$pris',
        Maks_voksne='$maks_voksne',
        Maks_barn='$maks_barn',
        Tilgjengelighet='$tilgjengelighet',
        Etasje='$etasje',
        Nar_heis='$nar_heis'
        WHERE Romnummer='$romnummer'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Rom oppdatert!";
    } else {
        echo "Feil ved oppdatering: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Rediger Rom</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            flex-direction: column; /* Dette gjør at headeren kommer øverst */
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }

        header h1 {
            margin: 0;
        }

        .edit-form-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .edit-form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            color: #555;
        }

        input[type="text"], 
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px; /* Legg til luft mellom knappene */
        }

        button:last-child {
            margin-bottom: 0; /* Fjern marginen for den siste knappen */
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #333; 
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #555; 
        }

    </style>
</head>
<body>

<header>
    <h1>Oppdatering av rom</h1>
</header>

<div class="edit-form-container">
    <h1>Rediger Rom <?php echo $romnummer; ?></h1>
    <form method="POST">
        <label>Type:</label>
        <input type="text" name="type" value="<?php echo $room['Type']; ?>">
        
        <label>Beskrivelse:</label>
        <input type="text" name="beskrivelse" value="<?php echo $room['Beskrivelse']; ?>">

        <label>Pris (NOK):</label>
        <input type="number" name="pris" value="<?php echo $room['Pris']; ?>">
        
        <label>Maks Voksne:</label>
        <input type="number" name="maks_voksne" value="<?php echo $room['Maks_voksne']; ?>">
        
        <label>Maks Barn:</label>
        <input type="number" name="maks_barn" value="<?php echo $room['Maks_barn']; ?>">
        
        <label>Tilgjengelighet:</label>
        <input type="text" name="tilgjengelighet" value="<?php echo $room['Tilgjengelighet']; ?>">
        
        <label>Etasje:</label>
        <input type="text" name="etasje" value="<?php echo $room['Etasje']; ?>">
        
        <label>Nær Heis:</label>
        <input type="text" name="nar_heis" value="<?php echo $room['Nar_heis']; ?>">
        
        <button type="submit">Oppdater</button>
        <button type="reset">Tilbakestill</button>
        <a href="admin.php" class="back-button">Tilbake</a>
    </form>
</div>

</body>
</html>
