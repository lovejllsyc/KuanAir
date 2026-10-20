<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'jetsetgo');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM reservations WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Reservation ID: " . $row['id'] . "<br>";
        echo "Passenger Name: " . $row['name'] . "<br>";
        echo "Departure: " . $row['departure'] . "<br>";
        echo "Destination: " . $row['destination'] . "<br>";
        echo "Flight Date: " . $row['flight_date'] . "<br><hr>";
    }
} else {
    echo "No reservations found.";
}

mysqli_close($conn);
?>
