<?php
require '../../connection/dbase.php';
session_start();
extract($_POST);
$fromDate = $_GET['fd'];
$toDate = $_GET['td'];

$output = '';

$query = "SELECT * FROM orderlist where restaurantID = '" . $_SESSION['restaurantID'] . "' && (OrderDate BETWEEN '$fromDate' and '$toDate') order by OrderDate desc";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Address </th>
                    <th>Phone No</th>
                    <th>Menu Name</th>
                    <th>Date</th>
                    <th>Amount</th>
                    </tr>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
                    <tr>  
                         <td>' . $row["orderID"] . '</td>  
                         <td>' . $row["custName"] . '</td>  
                         <td>' . $row["orderAddress"] . '</td>  
                         <td>' . $row["custPhone"] . '</td>  
                         <td>' . $row["menuList"] . '</td>  
                         <td>' . $row["OrderDate"] . ', ' . date('l', strtotime($row['OrderDate'])); '</td>   
                         <td>RM' . $row["amountPaid"] . '</td>
                    </tr>
   ';
    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=Order-Record.xls');
    echo $output;
}
