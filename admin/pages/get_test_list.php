<?php

include "../db.php";


$selectedCategoryId = trim($_POST['selectedCategory']);
$get_test_query = "select * from testlist where testcategory_id='$selectedCategoryId' order by id DESC";
$testList = mysqli_query($con, $get_test_query);

$optionsHtml = '';

if (mysqli_num_rows($testList) > 0) {
    while ($row = mysqli_fetch_assoc($testList)) {
       
        $optionsHtml .= '<option data-price="'.$row['test_price'].'" value="' . $row['id'] . '" >' . $row['test_name'] . '</option>';

       
      }
     
} 

mysqli_close($con);

echo $optionsHtml;

?>