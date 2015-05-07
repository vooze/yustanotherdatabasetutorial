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

$sql = "select * from borrowers join items join transactions where borrowers.borower_id = transactions.borrower_id and items.item_id = transactions.item_id;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "The User: " . $row["Borrower_Name"]. " Has borrowed: " . $row["Item_Name"]. "<br>". "\n" ;
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?> 
