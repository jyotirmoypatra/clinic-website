<?php
include "../db.php";

$deleteId = $_POST['deleteId'];

$query = "delete from testlist where id=$deleteId";
$result = mysqli_query($con, $query);
if($result){
    echo 'success';
}else{
    echo 'error';
}
?>