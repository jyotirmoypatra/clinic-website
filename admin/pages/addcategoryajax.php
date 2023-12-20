<?php
include "../db.php";


$category = trim($_POST['category']);

$duplicate = "select * from testcategory where  category='$category'";
$duplicatequery = mysqli_query($con, $duplicate);
if (mysqli_num_rows($duplicatequery) > 0) {
    echo "exist";
} else {

    $insertquery = "insert into testcategory (category) values('$category')";
    $query = mysqli_query($con, $insertquery);

    if ($query) {
        echo "success";
    }
}

mysqli_close($con);

?>