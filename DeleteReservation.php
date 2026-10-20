<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'jetsetgo');

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ReservationID = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM reservations WHERE id='$ReservationID' AND user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Reservation deleted successfully!');
                window.location.href='dashboard.html';
              </script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

$conn->close();
?>
