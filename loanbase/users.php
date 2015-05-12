<?php include_once 'header.php';?>
<h2>Allready registered users are</h2><p>
<?php
include_once 'database_connection.php';

$sql1 = "select * from borrowers;";
$result = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo  $row["Borrower_Name"]. "<br>";
    }
} else {
    echo "0 results";
}

?>

<form action="users.php">
New User name:<br>
<input type="text" name="username">
<br>
<input type="submit" value="Create User">
</form>

<?php
$username = $_GET["username"]; // Remember to sanitize!!
if  (!empty($_GET["username"])) {
	echo "username is set <br>";
	$sql2 = "INSERT INTO borrowers (Borrower_Name) VALUES ('$username')";
	if (mysqli_query($conn, $sql2)) {
	    echo "New record created successfully";
	} else {
    		echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
		}
	}
else { echo "username is not set "; }



mysqli_close($conn);
echo "<br>";
include_once 'footer.php';
