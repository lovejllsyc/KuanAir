Register.php — CREATE Account
mysqli_connect('localhost', 'root', '', 'kuan_air') connects PHP to the kuan_air database.
if (!$conn) checks if nag-fail ang database connection. Ang mysqli_connect_error() ga-display sang connection error.
$_SERVER["REQUEST_METHOD"] == "POST" checks if na-submit ang registration form.
$_POST['username'] and $_POST['password'] get the username and password nga gin-type sa HTML form.
pasword_hash() creates a hashed version sang password para indi plain text ang password nga ma-store sa database.
Ang INSERT INTO users SQL command ga-add sang new account sa users table.
mysqli_query() runs the SQL command. If successful, ma-redirect ang user sa login.html.
mysqli_error() gets the query error if may problem, while mysqli_close() closes the database connection.

Login.php — READ Account and Log In
session_start() starts a session para ma-keep ang logged-in user's information while ga-navigate sa pages.
mysqli_connect() connects PHP to the same database, while if (!$conn) checks if successful ang connection.
$_POST gets the username and password nga gin-submit halin sa login.html.
SELECT * FROM users WHERE username='$username' searches the users table for the entered username.
mysqli_query() runs the SELECT query. mysqli_num_rows() checks if may matching account.
mysqli_fetch_assoc() gets the matching record as an associative array, so ma-access ang values gamit ang column names like id and password(meaaning, instead nga number lang ang gamiton para ma-access ang data, pwede gamiton ang column names like $row['id'], $row['username'], and $row['password'])
password_verify() checks if ang entered password matches the stored hashed password.
If correct ang login details, $_SESSION stores the user's ID and username, then ma-redirect ang user sa dashboard.html.
mysqli_close() closes the database connection.

CreateReservation.php — CREATE Reservation
session_start() allows the code to access the logged-in user's session.
mysqli_connect() connects PHP to kuan_air, while if (!$conn) checks for connection problems.
$_POST gets the passenger name, departure, destination, and flight date from the booking form sa dashboard.html.
Ang INSERT INTO reservations SQL command saves the reservation details sa reservations table. Gin-save man ang `user_id para ma-connect ang reservation sa account nga nag-book.
mysqli_query() runs the INSERT command. If successful, may success message; otherwise, mysqli_error() gets the query error.
mysqli_close() closes the database connection.
ReadReservation.php — READ Reservations
session_start() accesses the current user's session.
mysqli_connect() connects PHP to the database, and the connection check makes sure nga successful ang connection.
SELECT * FROM reservations WHERE user_id='$user_id' retrieves the reservations connected to that user ID.
mysqli_query() runs the SELECT query.
mysqli_num_rows() checks if may matching reservations.
while ($row = mysqli_fetch_assoc($result)) goes through each reservation one by one. Gin-display sang code ang reservation ID, passenger name, departure, destination, and flight date.
If wala sang matching records, ma-display ang No reservations found.
mysqli_close() closes the database connection.

UpdateReservation.php — UPDATE Reservation
session_start() accesses the logged-in user's session, while mysqli_connect() connects PHP to the database.
Ang form sends the reservation ID and the new passenger name through POST.
UPDATE reservations SET name=... WHERE id=... AND user_id=... changes the passenger name only if the reservation ID matches and belongs to that user.
mysqli_query() runs the UPDATE command. The code displays a success or error message, then mysqli_close() closes the connection.

DeleteReservation.php — DELETE Reservation
session_start() starts the session, while mysqli_connect() connects PHP to the database.
Ang form sends the reservation ID through POST.
DELETE FROM reservations WHERE id=... AND user_id=... deletes the selected reservation only if the reservation ID and user ID match.
mysqli_query() runs the DELETE command. The code displays a success or error message, then mysqli_close() closes the connection.

Logout.php — Log Out
session_start() opens the current session.
session_destroy() ends the session and clears the session data.
header("Location: index.html") redirects the user back to the home page.
exit() stops the PHP script after the redirect.
