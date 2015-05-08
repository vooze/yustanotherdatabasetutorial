
<h2>Allready registered items are</h2><p>
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

$sql = "select * from items;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo  $row["Item_Name"]. "<br>". "\n" ;
    }
} else {
    echo "0 results";
}

?>

<form action="items.php">
New Item name:<br>
<input type="text" name="itemname" value="">
<br>
<input type="submit" value="Create Item">
</form>

<?php

if  (isset( $_GET["itemname"] )  and  $_GET["itemname"] != "" )
	{
	echo "itemname is set ";
	$sql = "INSERT INTO items (Item_Name) VALUES ( \"".  $_GET["itemname"] . "\" )";
	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
else
	echo "itemname is not set ";



mysqli_close($conn);
?><br>
<?php include 'footer.php';?>
