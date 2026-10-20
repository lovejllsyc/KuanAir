```php
<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'jetsetgo');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM reservations WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations | JetSetGo</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #0b1f3a;
            color: white;
            padding: 22px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #38bdf8;
        }

        nav {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        nav a:hover {
            color: #38bdf8;
        }

        main {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 50px 30px;
        }

        .page-heading {
            margin-bottom: 35px;
        }

        .page-heading h1 {
            color: #0b1f3a;
            font-size: 34px;
            margin-bottom: 10px;
        }

        .page-heading p {
            color: #64748b;
            line-height: 1.6;
        }

        .reservation-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .reservation-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
            transition: 0.3s;
        }

        .reservation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.10);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px dashed #cbd5e1;
        }

        .card-top h2 {
            color: #0b1f3a;
            font-size: 18px;
        }

        .status {
            background: #dcfce7;
            color: #166534;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .reservation-id {
            background: #eff6ff;
            color: #2563eb;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .passenger {
            margin-bottom: 22px;
        }

        .label {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .value {
            color: #0f172a;
            font-size: 15px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .route {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #f1f5f9;
            padding: 18px 14px;
            border-radius: 10px;
            margin-bottom: 22px;
        }

        .route-point {
            flex: 1;
            min-width: 0;
        }

        .route-point:last-child {
            text-align: right;
        }

        .route-point small {
            display: block;
            color: #64748b;
            font-size: 10px;
            margin-bottom: 8px;
        }

        .route-point strong {
            font-size: 14px;
            color: #0b1f3a;
            overflow-wrap: anywhere;
        }

        .plane {
            color: #0284c7;
            font-size: 22px;
        }

        .flight-date {
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
        }

        .empty-state {
            grid-column: 1 / -1;
            background: white;
            text-align: center;
            padding: 55px 25px;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
        }

        .empty-state .empty-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .empty-state h2 {
            color: #0b1f3a;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #64748b;
            line-height: 1.7;
        }

        footer {
            background: #0b1f3a;
            color: #cbd5e1;
            text-align: center;
            padding: 25px 20px;
            margin-top: auto;
            font-size: 13px;
            line-height: 1.8;
        }

        footer strong {
            color: #38bdf8;
        }

        @media (max-width: 650px) {
            header {
                flex-direction: column;
                padding: 22px 5%;
            }

            nav {
                justify-content: center;
                gap: 15px;
            }

            nav a {
                font-size: 12px;
            }

            main {
                padding: 35px 20px;
            }

            .page-heading h1 {
                font-size: 28px;
            }

            .reservation-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="logo">✈ JetSetGo</div>

    <nav>
        <a href="index.php">Home</a>
        <a href="booking.php">Book a Flight</a>
        <a href="my_reservations.php">My Reservations</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<main>
    <div class="page-heading">
        <h1>My Reservations</h1>
        <p>All your flight bookings, organized in one place.</p>
    </div>

    <div class="reservation-container">

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='reservation-card'>";

        echo "<div class='card-top'>";
        echo "<h2>Flight Reservation</h2>";
        echo "<span class='status'>RESERVED</span>";
        echo "</div>";

        echo "<div class='reservation-id'>";
        echo "Reservation ID: " . $row['id'];
        echo "</div>";

        echo "<div class='passenger'>";
        echo "<span class='label'>PASSENGER NAME</span>";
        echo "<span class='value'>" . $row['name'] . "</span>";
        echo "</div>";

        echo "<div class='route'>";

        echo "<div class='route-point'>";
        echo "<small>DEPARTURE</small>";
        echo "<strong>" . $row['departure'] . "</strong>";
        echo "</div>";

        echo "<div class='plane'>✈</div>";

        echo "<div class='route-point'>";
        echo "<small>DESTINATION</small>";
        echo "<strong>" . $row['destination'] . "</strong>";
        echo "</div>";

        echo "</div>";

        echo "<div class='flight-date'>";
        echo "<span class='label'>FLIGHT DATE</span>";
        echo "<span class='value'>" . $row['flight_date'] . "</span>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "<div class='empty-state'>";
    echo "<div class='empty-icon'>✈</div>";
    echo "<h2>No Reservations Found</h2>";
    echo "<p>You don't have any reservations yet.<br>";
    echo "Your next adventure is waiting!</p>";
    echo "</div>";
}

mysqli_close($conn);
?>

    </div>
</main>

<footer>
    <p>&copy; 2026 <strong>JetSetGo</strong>. All rights reserved.</p>
    <p>Your journey begins with us. Fly smarter, travel farther.</p>
</footer>

</body>
</html>
```
