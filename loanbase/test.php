<!DOCTYPE html>
<html>
<body>

<form action="test.php">
Name of new User:<br>
<input type="text" name="user" value="">
<br>

<input type="submit" value="Create User">
</form> 



Welcome <?php echo $_GET["user"]; ?><br>


<?php
$servername = "localhost";
$username = "root";
$password = "rootpass";
$dbname = "borrowbase";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "insert into borrowers (Borrower_Name)value (\"". $_GET["user"] . "\");";
//echo $sql;
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>
</body>
</html>


