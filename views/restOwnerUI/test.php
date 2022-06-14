<?php 
$query = "SELECT
SUBSTRING_INDEX(SUBSTRING_INDEX(menulist, ',', 1), ',', -1) AS first_name,
If(length(menulist) - length(replace(menulist, ' ', ''))>1,  
    SUBSTRING_INDEX(SUBSTRING_INDEX(menulist, ',', 2), ',', -1) ,NULL) as middle_name,
FROM orderlist"; ?>
