<?php
include "../db.php";


$testname = trim($_POST['testname']);
$testcategory = trim($_POST['testcategory']);
$testprice = trim($_POST['testprice']);

$duplicate = "select * from testlist where  test_name='$testname' && testcategory_id='$testcategory'";
$duplicatequery = mysqli_query($con, $duplicate);
if (mysqli_num_rows($duplicatequery) > 0) {
    echo "exist";
} else {

    $insertquery = "insert into testlist(testcategory_id,test_name,test_price) values('$testcategory','$testname','$testprice')";
    $query = mysqli_query($con, $insertquery);

    if ($query) {
        echo "success";
    }
}

mysqli_close($con);

?>