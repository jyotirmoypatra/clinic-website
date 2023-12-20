<?php

$hostUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'];

$patientID = trim($_POST['patientID']);
$patientName = trim($_POST['patientName']);
$patientPhone = trim($_POST['patientPhone']);
$patientAge = trim($_POST['patientAge']);
$patientGender = trim($_POST['patientGender']);
$patientBloodGrp = trim($_POST['patientBloodGrp']);
$patientAddress = trim($_POST['patientAddress']);
$patientDoct = trim($_POST['patientDoct']);

$TotalPrice = $_POST['TotalPrice'];
$subTotalPrice= $_POST['subTotalPrice'];
$discountPrice = $_POST['discountPrice'];


$tableDataJson = $_POST['tableData'];
$tableDecodeData = json_decode($tableDataJson, true);

$currentDate = date('d-m-Y');

require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Create an instance of the Dompdf class
$dompdf = new Dompdf();

// Load HTML content
$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;

        }

        .charge-table {
            width: 100%;
            border-collapse: collapse;
            
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-section {
            text-align:right;
            margin-right:145px;
         
            font-weight: bold;
        }
    </style>
    
</head>

<body>

<div style="width: 100%;" class="invoice-header">
<div style="float:left;width:50%;" class="invoice-title">
    <h2>INVOICE</h2>
    <p style="font-size:13px">Date: '.$currentDate.'</br>Invoice No: '.$patientID.'</p>
</div>
<div style="float:left;width:50%;text-align:right;margin-top:20px;font-size:15px;" class="invoice-title">
<strong style="font-size:18px;">Sanjiban X-Ray and Diagonostic Center</strong></br>
kenduadihi, Bankura, West Bengal 722102</br>Phone:9434224549
</div>
<br style="clear: left;" />
</div>

    <div style="margin-top:-20px;" class="patient-details">
    <h3 style="background: lightgreen;padding:5px;">Patient Details</h3>
    <div style="width: 100%;">
        <div style=""><strong>Name:</strong> ' . $patientName . '</div>
    </div>
    <br style="clear: left;" />
    <div style="width: 100%;">
    <div style="float: left; width: 30%;"> <strong>Phone:</strong> +' . $patientPhone . '</div>
    <div style="float: left; width: 20%;"><strong>Age:</strong> ' . $patientAge . '</div>
        
    </div>
        <br style="clear: left;" />
    
     <div style="width: 100%;margin-top:-20px;">   
        <div style="float: left; width: 30%;"> <strong>Blood Group:</strong> ';


if ($patientBloodGrp == "a-pos") {
    $html .= "A+";
} else if ($patientBloodGrp == "a-neg") {
    $html .= "A-";
} else if ($patientBloodGrp == "b-neg") {
    $html .= "B-";
} else if ($patientBloodGrp == "b-pos") {
    $html .= "B+";
} else if ($patientBloodGrp == "ab-pos") {
    $html .= "AB+";
} else if ($patientBloodGrp == "ab-neg") {
    $html .= "AB-";
}else if ($patientBloodGrp == "unknown") {
    $html .= "Unknown";
}

$html .= '</div>
        <div style="float: left; width: 30%;"><strong>Doctor Name:</strong> ' . $patientDoct . '</div>
       
        <div style="float: left; width: 40%;"> <strong>Address:</strong> ' . $patientAddress . '</div> <br style="clear: left;" />

        <br style="clear: left;" />
    </div>
   </div>

   <h3 style="background: lightgreen;padding:5px;margin-top:-20px;">Test Details</h3>
    <table class="charge-table">
        <thead>
        <tr>
            <th>SL NO</th>
            <th>Test Name</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody> ';
foreach ($tableDecodeData as $row) {
    $html .= ' <tr>
            <td>' . $row['slNo'] . '</td>
            <td>' . $row['testName'] . '</td>
            <td>' . $row['price'] . '</td>
        </tr>';
    // $total += floatval($row['price']);
}

$html .= ' <tr>
    <td style="text-align: right;" colspan="2"><strong >SubTotal:</strong></td>
    <td><strong>' . number_format($subTotalPrice, 2) . '</strong></td>
</tr>';
if ($discountPrice > 0) {
    $html .= '<tr>
        <td style="text-align: right;" colspan="2"><strong>Discount:</strong></td>
        <td><strong>' . number_format($discountPrice, 2) . '</strong></td>
    </tr>';
}
$html .= '<tr>
    <td style="text-align: right;" colspan="2"><strong >Total:</strong></td>
    <td><strong>' . number_format($TotalPrice, 2) . '</strong></td>
</tr>
</tbody>
</table>
</body>

</html>

</body>

</html>';
$dompdf->loadHtml($html);

// Set paper size (optional)
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

ob_start();

// Set the Content-Type header
header('Content-Type: application/pdf');

// Set the Content-Disposition header to trigger download or display in the browser
header('Content-Disposition: inline; filename="output.pdf"'); // Adjust this line accordingly


// Output the generated PDF content
$dompdf->stream();

// End output buffering and clean the buffer
ob_end_flush();






?>