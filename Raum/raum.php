<?php
    session_start();
    // Check if the form has been submitted
    if(isset($_POST['submit'])) {

        // Get the form data
        $raumnr = $_POST['raumnr'];
        $etagenr = $_POST['etagenr'];
        $datum = $_POST['datum'];
        $startzeit = $_POST['startzeit'];
        $endzeit = $_POST['endzeit'];
        

 // Get the form data
$raumnr = $_POST['raumnr'];
$etagenr = $_POST['etagenr'];
$datum = $_POST['datum'];
$startzeit = $_POST['startzeit'];
$endzeit = $_POST['endzeit'];

// Validate the form data

// If the data is valid, store it in the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Verbindung ist fehlgeschlagen: " . $conn->connect_error);
}

// Check if there are already bookings for the given room number and floor number
$stmt = $conn->prepare("SELECT endzeit FROM buchung1 WHERE raumnr = ? AND etagenr = ? AND datum = ? ORDER BY endzeit DESC LIMIT 1");
$stmt->bind_param("sss", $raumnr, $etagenr, $datum);
$stmt->execute();
$stmt->bind_result($etage_count);
$stmt->bind_result($vorherige_endezeit);
$stmt->fetch();
$stmt->close();

if ($vorherige_endezeit && $startzeit < $vorherige_endezeit) {
    echo "Bereits ausgebucht!";
} 
elseif ($raumnr=='B1-1' && $etage_count >=0 &&  $etagenr=='Etage 3') {
  
    echo "Dieser Raum ist nür für den Geschäfsleiter!.";
    exit();
} 

elseif ($raumnr=='B1-1' && $etage_count >=1) {
  
    echo "Bereits ausgebucht!";
} 





else {
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO buchung1 (raumnr, etagenr, datum, startzeit, endzeit) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $raumnr, $etagenr, $datum, $startzeit, $endzeit);

    // check if required fields are not empty
    $currentDate = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');

    if (empty($raumnr) || empty($etagenr) || empty($datum) || empty($startzeit) || empty($endzeit)) {
        // display an error message
        echo "Bitte alle Felder ausfüllen!";
    } else {
        // check if date, start time, and end time are after current date and time
        if ($datum < $currentDate || ($datum == $currentDate && $startzeit < date('H:i:s')) || ($datum == $currentDate && $startzeit == date('H:i:s') && $endzeit < date('H:i:s'))) {
            // display an error message
            echo "Das Datum und die Uhrzeit dürfen nicht in der Vergangenheit liegen";
        } else {
            // continue with booking process
            if ($stmt->execute() === TRUE) {
                echo "Die Buchung war erfolgreich!";
            } else {
                echo "Fehler: " . $stmt->error;
            }
        }
    }
}

// Close the database connection
$stmt->close();
$conn->close();


    }
?>
