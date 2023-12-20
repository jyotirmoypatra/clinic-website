<?php
include "../db.php";

$searchValue = $_POST['searchValue'];
$dateValue = $_POST['dateValue'];
$query = '';
if ($dateValue == 'allcategory' && $searchValue == '') {
    $query = "SELECT testlist.id, testlist.test_name,testlist.test_price, testcategory.category
    FROM testlist
    JOIN testcategory ON testlist.testcategory_id = testcategory.id ORDER BY testlist.id DESC";

} else if ($dateValue == 'allcategory' && $searchValue != '') {
    $query = "SELECT testlist.id, testlist.test_name, testlist.test_price,testcategory.category
    FROM testlist
    JOIN testcategory ON testlist.testcategory_id = testcategory.id WHERE testlist.test_name LIKE '%$searchValue%' OR testcategory.category LIKE '%$searchValue%' ORDER BY testlist.id DESC";

} else if ($dateValue != '' && $dateValue != 'allcategory' && $searchValue == '') {
    $query = "SELECT testlist.id, testlist.test_name, testlist.test_price,testcategory.category
    FROM testlist
    JOIN testcategory ON testlist.testcategory_id = testcategory.id WHERE testcategory.id = '$dateValue' ORDER BY testlist.id DESC";

} else if ($dateValue != '' && $dateValue != 'allcategory' && $searchValue != '') {
    $query = "SELECT testlist.id, testlist.test_name, testlist.test_price,testcategory.category
    FROM testlist
    JOIN testcategory ON testlist.testcategory_id = testcategory.id WHERE testlist.test_name LIKE '%$searchValue%' AND testcategory.id = '$dateValue' ORDER BY testlist.id DESC";

}

$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>
                    <?php echo $row['test_name']; ?>
                </td>
                <td>
                    <?php echo $row['category']; ?>
                </td>
                <td>
                    <?php echo $row['test_price']; ?>
                </td>
                <td>
                    <a class="delete-icon" href="#"> <i data-value="<?php echo $row['id']; ?>" class="fa-solid fa-trash"></i></a>

                </td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="3">No data found</td></tr>';
    }
    mysqli_free_result($result);
}

?>