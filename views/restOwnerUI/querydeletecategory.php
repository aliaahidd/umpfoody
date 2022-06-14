<?php
require '../../connection/dbase.php';
session_start();
$categoryID = $_GET['id'];

//delete order
$delete_query = "DELETE FROM menucategory where categoryID = '$categoryID'";
$delete_query_result = mysqli_query($con, $delete_query) or die(mysqli_error($con));

//delete menu
$delete_query_menu = "DELETE FROM menulist where categoryID = '$categoryID'";
$delete_query_result_menu = mysqli_query($con, $delete_query_menu) or die(mysqli_error($con));
?>
<script>
    window.alert("Category details has been deleted in the database");
</script>
<meta http-equiv="refresh" content="1;url=restownermenu.php">