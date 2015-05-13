<?php include_once 'header.php';?>
<h2>Allready registered items are</h2><p>
<?php
include_once 'database_connection.php';
$sql = "select * from items;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo  $row["Item_Name"]. "<br>";
    }
} else {
    echo "0 results";
}?>

<form action="items.php">
New Item name:<br>
<input type="text" name="itemname">
<br>
<input type="submit" value="Create Item">
</form>

<?php
$itemname = $_GET["itemname"]; // Remember to Sanitize!
if  (!empty($_GET["itemname"])) {
	echo "itemname is set ";
	$sql = "INSERT INTO items (Item_Name) VALUES ('$itemname')";
	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
else { echo "itemname is not set "; }
mysqli_close($conn);
echo "<br>";
include_once 'footer.php';
// Consider a redirect to update Database on input
