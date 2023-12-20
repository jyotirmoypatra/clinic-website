<?php
include "../db.php";


$patientID = trim($_POST['patientID']);
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
$updateSql = "UPDATE billing SET patient_name = '$patientName',patient_phone = '$patientPhone',patient_age = '$patientAge',
patient_gender = '$patientGender',patient_blood = '$patientBloodGrp',patient_address = '$patientAddress',
patient_doct = '$patientDoct',total_amount = '$TotalPrice',subtotal_amount = '$subTotalPrice',discount = '$discountPrice',patient_test_json = '$tableDataJson' WHERE patient_id = '$patientID'";


$update = mysqli_query($con, $updateSql);
if ($update) {
    echo "success";
} else {
    echo "error";
}





?>