<?php
require '../../connection/dbase.php';
session_start();
extract($_POST);

//Insert new category
if (isset($_POST["newCategory"])) {
    $restaurantID = $_SESSION['restaurantID'];

    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $insert_query = "INSERT INTO menucategory(restaurantID, categoryName, categoryPhoto) values ('$restaurantID','$categoryName','$image')";
    $insert_result = mysqli_query($con, $insert_query) or die(mysqli_error($con));

?>
    <script>
        window.alert("New Category has been added in the database");
    </script>
    <meta http-equiv="refresh" content="1;url=restownermenu.php">
<?php } ?>

<?php
//Insert new menu
if (isset($_POST["newMenu"])) {
    $restaurantID = $_SESSION['restaurantID'];
    $categoryID = $_GET['id'];

    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $insert_query = "INSERT INTO menulist(restaurantID, categoryID, menuName, menuPrice, menuQuantityAvail, menuDescription, menuPhoto) values ('$restaurantID','$categoryID','$menuName','$menuPrice','$menuQty','$menuDescription','$image')";
    $insert_result = mysqli_query($con, $insert_query) or die(mysqli_error($con));

?>
    <script>
        window.alert("New Menu has been added in the database");
    </script>
    <meta http-equiv="refresh" content="1;url=menulist.php?id=<?php echo $categoryID ?>">
<?php } ?>