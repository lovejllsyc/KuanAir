<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'jetsetgo');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $flight_date = $_POST['flight_date'];

    $sql = "INSERT INTO reservations (user_id, name, departure, destination, flight_date) VALUES ('$user_id', '$name', '$departure', '$destination', '$flight_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Reservation added successfully!');
                window.location.href='dashboard.html';
              </script>";
    } else {
        echo "Error adding reservation: " . $conn->error;
    }
}

$conn->close();
?>
