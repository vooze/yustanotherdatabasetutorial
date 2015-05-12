<?php include_once 'header.php';?>
<h2> Allready registered loans are </h2>
<?php
include_once 'database_connection.php';

$sql1 = "select * from borrowers 
join items join transactions 
where 
borrowers.borower_id = transactions.borrower_id 
and items.item_id = transactions.item_id  order by borrower_name  ;";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result1)) {
        echo "The User: " . $row["Borrower_Name"]. " Has borrowed: " . $row["Item_Name"]. "<br>" ;
    }
} else {
    echo "0 results";
}
?>

<h2> Create a new loans here </h2>
<form action="new_loans.php">
Borrower  :
<select name="Username">
<?php
$sql2 = "select * from borrowers;";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result2)) {
        echo "<option value=".$row["Borrower_Name"].">".$row["Borrower_Name"]."</option>";
    }
}

?>
</select>
Borrows   :
<select name="Itemname">
<?php
$sql3 = "select * from items;";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result3)) {
        echo "<option value".$row["Item_Name"].">".$row["Item_Name"]."</option>";
    }
}

?>
</select>
<br><br>
<input type="submit"  Value="Create">
</form>
<?php
$username = $_GET["Username"]; // Remember to Sanitize!
$itemname =  $_GET["Itemname"]; // Remember to Sanitize!
if  (!empty($_GET["Username"]) and !empty($_GET["Itemname"]) )
        {
        echo "values are ready for inserting <p> ";
//find   Borower_Id  from Borrower_Name and  Item_Id from Item_Name
//insert    Borower_Id  and  Item_Id   into  transactions
$sql4 = "select Borower_Id from borrowers WHERE Borrower_Name='$username'";
echo $sql4 .  "<br>";
$result4 = mysqli_query($conn, $sql4);
if (mysqli_num_rows($result4) > 0) {
    while($row = mysqli_fetch_assoc($result4)) {
        echo "Borower_ID is " . $row["Borower_Id"]. "<p>";
        $BID = $row["Borower_Id"];
//	print_r($row);
    }
}
$sql5 = "select Item_Id from items WHERE Item_Name='$itemname'";
echo $sql5 ."<br>";
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0) {
    while($row = mysqli_fetch_assoc($result5)) {
        echo "Item_Id is " . $row["Item_Id"]. "<br>";
        $IID = $row["Item_Id"];
//	print_r($row);
    }
}
     
$sql6 = "insert into transactions (Borrower_ID,Item_Id)values ('$BID','$IID');";
echo $sql6;
$result6 = mysqli_query($conn, $sql6);
echo "insert result ".$result6;
} //if the fields are not empty
mysqli_close($conn);
include_once 'footer.php';
