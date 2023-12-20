<?php
include "../db.php";


$uname = trim($_POST['uname']);
$uemail = trim($_POST['uemail']);
$upass = trim($_POST['upass']);
$urole = trim($_POST['urole']);





$duplicate = "select * from users where  email='$uemail'";
$duplicatequery = mysqli_query($con, $duplicate);
if (mysqli_num_rows($duplicatequery) > 0) {
    echo "exist";
} else {


    if($urole=='admin'){
        $role=1;
    }else{
        $role=0;
    }

    $insertquery = "insert into users (name,email,pass,role) values('$uname','$uemail','$upass',$role)";
    $query = mysqli_query($con, $insertquery);

    if ($query) {
        echo "success";
    }
}


?>