<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conn = mysqli_connect("localhost", "root", "", "kuan_air");

if (!$conn) {
    die("Unable to connect to the database. Please try again later.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        echo "<script>
            alert('Please fill in all fields.');
            window.location.href = 'register.html';
        </script>";
        exit();
    }

    if (strlen($password) < 6) {
        echo "<script>
            alert('Password must be at least 6 characters long.');
            window.location.href = 'register.html';
        </script>";
        exit();
    }


    $checkSql = "SELECT id FROM users WHERE username = ?";
    $checkStmt = mysqli_prepare($conn, $checkSql);

    if (!$checkStmt) {
        echo "Something went wrong. Please try again later.";
        mysqli_close($conn);
        exit();
    }

    mysqli_stmt_bind_param($checkStmt, "s", $username);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        mysqli_stmt_close($checkStmt);
        mysqli_close($conn);

        echo "<script>
            alert('Username already exists. Please choose another one.');
            window.location.href = 'register.html';
        </script>";
        exit();
    }

    mysqli_stmt_close($checkStmt);


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Registration failed. Please try again later.";
        mysqli_close($conn);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: login.html");
        exit();
    } else {

        if (mysqli_stmt_errno($stmt) === 1062) {
            echo "<script>
                alert('Username already exists. Please choose another one.');
                window.location.href = 'register.html';
            </script>";
        } else {
            echo "Registration failed. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Please submit the registration form.";
}

mysqli_close($conn);
?>
