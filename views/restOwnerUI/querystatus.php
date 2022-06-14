<?php
//Edit Order Status
require '../../connection/dbase.php';
session_start();
extract($_POST);

$id = $_GET['id'];
$restaurantID = $_SESSION['restaurantID'];

$update_query_status = "UPDATE orderlist SET orderStatus = 'Prepared' where orderID='$id'";
$update_result_status = mysqli_query($con, $update_query_status) or die(mysqli_error($con));

?>
<meta http-equiv="refresh" content="1;url=restownerorder.php">