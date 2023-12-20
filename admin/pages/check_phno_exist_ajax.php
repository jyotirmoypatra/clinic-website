<?php 
include "../db.php";
$patientPhone = trim($_POST['phoneNo']);

$duplicate = "SELECT COUNT(*) AS patientCount, SUM(CAST(total_amount AS DECIMAL(10, 2))) AS totalSum FROM billing WHERE patient_phone = '$patientPhone'";
$result = mysqli_query($con, $duplicate);
if ($result) {
    $row = mysqli_fetch_assoc($result);

    $patientCount = $row['patientCount'];
    $totalSum = $row['totalSum'];
    if ($patientCount > 0) {
        echo "<p style='color:red;'>Note:  This Patient Visit -> $patientCount times,and previous total billing ->Rs. $totalSum</p>";
    } else {
        echo ""; // Echo blank line or any other desired output for count zero
    }
  
} else {
    echo "<p style='color:red;'>Note: Error in query execution: " . mysqli_error($con) . "</p>";
}




?>