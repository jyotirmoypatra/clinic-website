<?php
include "../db.php";


$patientID = trim($_POST['patientID']);

$delete = "DELETE FROM billing WHERE patient_id = '$patientID'";
$deleteRun = mysqli_query($con, $delete);
if ($deleteRun) {
    echo "success";
} else{
        echo "error";
    
}

?>