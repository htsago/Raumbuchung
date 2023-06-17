<?php 


include'raum.php';

function reserviertePlaetze($raumnr, $datum, $startzeit, $endzeit) {
    // Connect to the database
    $db = new mysqli('localhost', 'root', '', 'users');

    // Check for errors
    if ($db->connect_error) {
        die("Verbindung fehlgeschlagen: " . $db->connect_error);
    }

    // Prepare the SQL query
    $stmt = $db->prepare("SELECT SUM(plaetze) FROM buchung WHERE raumnr = ? AND datum = ? AND ((startzeit >= ? AND startzeit < ?) OR (endzeit > ? AND endzeit <= ?) OR (startzeit <= ? AND endzeit>= ?))");

    // Bind the parameters
    $stmt->bind_param("ssssssss", $raumnr, $datum, $startzeit, $endzeit, $startzeit, $endzeit, $startzeit, $endzeit);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $stmt->bind_result($gebuchtePltze);
    $stmt->fetch();

    // Close the statement and the database connection
    $stmt->close();
    $db->close();

    // Return the booked seats count
    return $gebuchtePlaetze;
}

?>
