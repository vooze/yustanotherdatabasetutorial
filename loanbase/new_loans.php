<h2> Allready registered loans are </h2><p>
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

$sql = "select * from borrowers 
join items join transactions 
where 
borrowers.borower_id = transactions.borrower_id 
and items.item_id = transactions.item_id  order by borrower_name  ;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "The User: " . $row["Borrower_Name"]. " Has borrowed: " . $row["Item_Name"]. "<br>". "\n" ;
    }
} else {
    echo "0 results";
}
?>

<h2> Create a new loans here </h2><p>
<form action="new_loans.php">
Borrower  :
<select name="Username">
<?php
$sql = "select * from borrowers;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option value=\"" . $row["Borrower_Name"]. "\">" .  $row["Borrower_Name"] ."</option>" . "\n" ;
    };
};

?>
</select>
Borrows   :
<select name="Itemname">
<?php
$sql = "select * from items;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option value=\"" . $row["Item_Name"]. "\">" .  $row["Item_Name"] ."</option>" . "\n" ;
    };
};

?>
</select>
<br><br>
<input type="submit"  Value="Create">
</form>
<?php
if  (isset( $_GET["Username"] )  and  $_GET["Username"] != ""  and isset( $_GET["Itemname"] )  and  $_GET["Itemname"] != "" )
        {
        echo "values are ready for inserting <p> ";
//find   Borower_Id  from Borrower_Name and  Item_Id from Item_Name
//insert    Borower_Id  and  Item_Id   into  transactions
$sql = "select Borower_Id from borrowers WHERE  Borrower_Name=\"" .  $_GET["Username"] ."\" ;";
echo $sql .  "<p>";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Borower_ID is " . $row["Borower_Id"]. "<p>" . "\n" ;
        $BID = $row["Borower_Id"];
//	print_r($row);
    };
};
$sql = "select Item_Id from items WHERE  Item_Name=\"" .  $_GET["Itemname"] ."\" ;";
echo $sql .  "<p>";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Item_Id is " . $row["Item_Id"]. "<p>" . "\n" ;
        $IID = $row["Item_Id"];
//	print_r($row);
    };
};
     


$sql = "insert into transactions (Borrower_ID,Item_Id)values (". $BID .",".$IID.");";
echo $sql;
$result = mysqli_query($conn, $sql);
echo "insert result ".$result;




}; //if the fields are not empty


mysqli_close($conn);


?> 
<?php include 'footer.php';?>
