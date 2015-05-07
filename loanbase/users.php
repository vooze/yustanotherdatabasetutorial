
<h2>Allready registered users are</h2><p>
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

$sql = "select * from borrowers;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo  $row["Borrower_Name"]. "<br>". "\n" ;
    }
} else {
    echo "0 results";
}

?>

<form action="users.php">
New User name:<br>
<input type="text" name="username" value="">
<br>
<input type="submit" value="Create User">
</form>

<?php

if  (isset( $_GET["username"] )  and  $_GET["username"] != "" )
	{
	echo "username is set ";
	$sql = "INSERT INTO borrowers (Borrower_Name) VALUES ( \"".  $_GET["username"] . "\" )";
	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
else
	echo "username is not set ";



mysqli_close($conn);
?><br>
