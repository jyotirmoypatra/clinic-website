<?php
include "../db.php";



$patientName = trim($_POST['patientName']);
$patientPhone = trim($_POST['patientPhone']);
$patientAge = trim($_POST['patientAge']);
$patientGender = trim($_POST['patientGender']);
$patientBloodGrp = trim($_POST['patientBloodGrp']);
$patientAddress = trim($_POST['patientAddress']);
$patientDoct = trim($_POST['patientDoct']);

$TotalPrice = $_POST['TotalPrice'];
$subTotalPrice = $_POST['subTotalPrice'];
$discountPrice = $_POST['discountPrice'];

$tableDataJson = $_POST['tableData'];
$tableDecodeData = json_decode($tableDataJson, true);

$currentDateTime = date('Y-m-d H:i:s');
//store in database--------->>>>>>>>>>>>>>>>>>>>>>


$uniqueId = generateUniqueId();
$insertBillingQuery = "insert into billing (patient_id,patient_name,patient_phone,patient_age,patient_gender,patient_blood,patient_address,patient_doct,patient_test_json,billing_date,subtotal_amount,total_amount,discount) values('$uniqueId','$patientName','$patientPhone','$patientAge','$patientGender','$patientBloodGrp','$patientAddress','$patientDoct','$tableDataJson','$currentDateTime','$subTotalPrice','$TotalPrice','$discountPrice')";
$insertBill = mysqli_query($con, $insertBillingQuery);
if ($insertBill) {
  echo $uniqueId;
}else{
  echo "error";
}





function generateUniqueId()
{
  $prefix = 'SANJIBAN';

  // Get the current date and time
  $currentDateTime = new DateTime();

  // Format the date and time as a string (e.g., "YmdHis")
  $formattedDateTime = $currentDateTime->format('YmdHis');

  // Combine the prefix and formatted date-time to create the unique ID
  $uniqueId = $prefix . $formattedDateTime;

  return $uniqueId;
}

?>