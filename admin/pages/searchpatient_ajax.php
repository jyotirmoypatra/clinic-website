<?php
include "../db.php";

$searchValue = $_POST['searchValue'];
$dateValue = $_POST['dateValue'];

if($dateValue=='today'){
    $currentDate = date('Y-m-d');
}else if($dateValue=='yesterday'){
    $currentDate = date('Y-m-d', strtotime('-1 day'));
}

$searchQuery='';
if($searchValue!='' && $dateValue=="alldate"){
 $searchQuery = "SELECT * FROM billing WHERE patient_id LIKE '%$searchValue%'  OR patient_name LIKE '%$searchValue%' OR patient_phone LIKE '%$searchValue%' order by id DESC";
}else if($searchValue=='' && ($dateValue=="today" or $dateValue=="yesterday")){
    $searchQuery = "SELECT * FROM billing WHERE  CAST(billing_date as date) = '$currentDate' order by id DESC";
}else if($dateValue=="alldate" && $searchValue==''){
     $searchQuery = "SELECT * FROM billing order by id DESC";
}else if($dateValue=="thisMonth" && $searchValue==''){
    $searchQuery =   "SELECT * FROM billing WHERE MONTH(billing_date) = MONTH(CURRENT_DATE()) AND YEAR(billing_date) = YEAR(CURRENT_DATE())  order by id DESC";
}else if($searchValue!='' && $dateValue=="today") {
    $searchQuery = "SELECT * FROM billing WHERE (patient_id LIKE '%$searchValue%'  OR patient_name LIKE '%$searchValue%' OR patient_phone LIKE '%$searchValue%') AND DATE(billing_date) = CURDATE() order by id DESC";
}else if($searchValue!='' && $dateValue=="yesterday") {
    $searchQuery = "SELECT * FROM billing WHERE (patient_id LIKE '%$searchValue%'  OR patient_name LIKE '%$searchValue%' OR patient_phone LIKE '%$searchValue%') AND CAST(billing_date as date) = '$currentDate' order by id DESC";
}

$searchResult = mysqli_query($con, $searchQuery);

if ($searchResult) {
    if (mysqli_num_rows($searchResult) > 0) {
        // Process the search results
        while ($row = mysqli_fetch_assoc($searchResult)) {
            echo '<tr>';
            echo '<td>' . $row['patient_name'] . '</td>';
            echo '<td>' . $row['patient_id'] . '</td>';
            echo '<td>' . $row['patient_phone'] . '</td>';
            echo '<td>  <a class="pdf-icon-link" href="#"> <i  data-value="' . $row['patient_id'] . '" class="fa-regular fa-file-pdf"></i> </a> <a class="edit_icon ml-3" href="#"> <i
            data-value="' . $row['patient_id'] . '" class="fa-solid fa-pen-to-square"></i></a> <a class="delete-icon ml-4" href="#"> <i
            data-value="' . $row['patient_id'] . '" class="fa-solid fa-trash"></i></a></td>';
            echo '</tr>';
        }


    } else {
        echo '<tr><td colspan="3">No data found</td></tr>';
    }
}

mysqli_close($con);

?>