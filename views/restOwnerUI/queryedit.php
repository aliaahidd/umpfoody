<?php
require '../../connection/dbase.php';
session_start();
extract($_POST);

//Edit Category
if (isset($_POST["editCategory"])) {
    $id = $_GET['id'];
    $restaurantID = $_SESSION['restaurantID'];

    $image = addslashes(($_FILES['image']['tmp_name']));
    $update_query = "UPDATE menucategory SET categoryName = '$categoryName' where categoryID='$id'";
    $update_result = mysqli_query($con, $update_query) or die(mysqli_error($con));

    if ($image != "") {
        $imageCategory = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $update_image_query = "UPDATE menucategory SET categoryPhoto='$imageCategory' where categoryID='$id'";
        $update_image_query_result = mysqli_query($con, $update_image_query) or die(mysqli_error($con));
    }

?>
    <script>
        window.alert("Category details has been updated in the database");
    </script>
    <meta http-equiv="refresh" content="1;url=restownermenu.php">
<?php } ?>


<?php
//Edit Menu
if (isset($_POST["editMenu"])) {
    $id = $_GET['id'];
    $categoryID = $_GET["mc"];
    $restaurantID = $_SESSION['restaurantID'];

    $image = addslashes(($_FILES['image']['tmp_name']));
    $update_query = "UPDATE menulist SET menuName = '$menuName', menuPrice = '$menuPrice', menuQuantityAvail = '$menuQty' where menuID='$id'";
    $update_result = mysqli_query($con, $update_query) or die(mysqli_error($con));

    if ($image != "") {
        $imageMenu = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $update_image_query = "UPDATE menulist SET menuPhoto='$imageMenu' where menuID='$id'";
        $update_image_query_result = mysqli_query($con, $update_image_query) or die(mysqli_error($con));
    }

?>
    <script>
        window.alert("Category details has been updated in the database");
    </script>
    <meta http-equiv="refresh" content="1;url=menulist.php?id=<?php echo $categoryID ?>">
<?php } ?>