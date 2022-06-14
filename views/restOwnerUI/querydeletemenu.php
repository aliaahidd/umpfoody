<?php
require '../../connection/dbase.php';
session_start();

$menuID = $_GET['id'];
$categoryID = $_GET['mc'];

//delete menu
$delete_query_menu = "DELETE FROM menulist where menuID = '$menuID'";
$delete_query_result_menu = mysqli_query($con, $delete_query_menu) or die(mysqli_error($con));
?>
<script>
    window.alert("Menu details has been deleted in the database");
</script>
<meta http-equiv="refresh" content="1;url=menulist.php?id=<?php echo $categoryID ?>">