<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'kuan_air');

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ReservationID = $_POST['id'];
    $Name = $_POST['name'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE reservations SET name='$Name' WHERE id='$ReservationID' AND user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Reservation updated successfully!');
                window.location.href='dashboard.html';
              </script>";
    } else {
        echo "Error updating reservation: " . mysqli_error($conn);
    }
}

$conn->close();
?>
