<?php include_once 'header.php';?>
<?php
include_once 'database_connection.php';

$sql = "select * from borrowers join items join transactions where borrowers.borower_id = transactions.borrower_id and items.item_id = transactions.item_id  group by  Borrower_Name ;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "The User: " . $row["Borrower_Name"]. " Has borrowed: " . $row["Item_Name"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
include_once 'footer.php';
