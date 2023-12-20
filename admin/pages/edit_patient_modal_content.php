<?php
include_once "../db.php";
$patientID = isset($_GET['patientID']) ? $_GET['patientID'] : '';

$query = "select * from billing where patient_id='$patientID'";
$result = mysqli_query($con, $query);
if ($result) {
    // Fetch patient information
    $patientInfo = mysqli_fetch_assoc($result);

    $patientName = $patientInfo['patient_name'];
    $patientPhone = $patientInfo['patient_phone'];
    $patientAge = $patientInfo['patient_age'];
    $patientGender = $patientInfo['patient_gender'];
    $patientBlood = $patientInfo['patient_blood'];
    $patientAddress = $patientInfo['patient_address'];
    $patientDoct = $patientInfo['patient_doct'];

    $patientTestJson = $patientInfo['patient_test_json'];
    $patientTestJson_Decode = json_decode($patientTestJson, true);

    $discount = $patientInfo['discount'];
    $subTotal = $patientInfo['subtotal_amount'];
    $Total = $patientInfo['total_amount'];
    mysqli_free_result($result);
}

?>


<p id="patient-id" style="font-weight:bold;">Patient/Invoice ID -
    <span><?php echo $patientID; ?></span> <a id="closeModal" href="javascript:void(0)"><i class="fa-solid fa-circle-xmark"></i></a>
</p>

<div class="patient-section-heading  mb-2">
    <h6>Patient Details</h6>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="name">Patient Name:</label>
        <input type="text" name="patientName" class="form-control" value="<?php echo $patientName; ?>" id="patientName">
    </div>
    <div class="col-md-2">
        <label for="phone">Phone Number:</label>
        <input type="text" name="patientPhone" value="<?php echo $patientPhone; ?>" id="patientPhone"
            class="form-control" maxlength="10" oninput="this.value = this.value.replace(/\D/g, '')">
    </div>
    <div class="col-md-2">
        <label for="age">Age:</label>
        <input type="text" name="patientAge" value="<?php echo $patientAge; ?>" class="form-control" maxlength="3"
            oninput="this.value = this.value.replace(/\D/g, '')" id="patientAge">
    </div>

    <div class="col-md-2">
        <label for="gender">Gender:</label></br>
        <select name="patientGender" id="patientGender">
            <option value="select">-select-</option>
            <option <?php echo ($patientGender == 'male') ? 'selected' : ''; ?> value="male">Male</option>
            <option <?php echo ($patientGender == 'female') ? 'selected' : ''; ?> value="female">Female</option>
            <option <?php echo ($patientGender == 'Other') ? 'selected' : ''; ?> value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="blood">Blood:</label></br>
        <select name="patientBloodGrp" id="patientBloodGrp">
            <option value="select">-select-</option>
            <option <?php echo ($patientBlood == 'a-pos') ? 'selected' : ''; ?> value="a-pos">A+</option>
            <option <?php echo ($patientBlood == 'a-neg') ? 'selected' : ''; ?> value="a-neg">A-</option>
            <option <?php echo ($patientBlood == 'b-pos') ? 'selected' : ''; ?> value="b-pos">B+</option>
            <option <?php echo ($patientBlood == 'b-neg') ? 'selected' : ''; ?> value="b-neg">B-</option>
            <option <?php echo ($patientBlood == 'ab-pos') ? 'selected' : ''; ?> value="ab-pos">AB+</option>
            <option <?php echo ($patientBlood == 'ab-neg') ? 'selected' : ''; ?> value="ab-neg">AB-</option>
        </select>
    </div>

</div>
<div class="row mt-1">
    <div class="col-md-6">
        <label for="age">Address:</label>
        <input type="text" value="<?php echo $patientAddress; ?>" class="form-control" id="patientAddress">
    </div>
    <div class="col-md-6">
        <label for="doctor">Doctor Name:</label>
        <input type="text" value="<?php echo $patientDoct; ?>" name="patientDoct" class="form-control" id="patientDoct">
    </div>
</div>
<div class="patient-section-heading  mt-3">
    <h6>Add Tests</h6>
</div>
<div class="row mt-2">
    <div class="col-md-12 mb-3">
        <label for="blo">Choose Test Category</label></br>
        <select name="testcategory" id="testcategory">
            <option value="select">-select-</option>
            <?php
            // modal-content.php
            

            $query = "select * from testcategory";
            $result = mysqli_query($con, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                }
                mysqli_free_result($result);
            }

            mysqli_close($con);
            ?>

        </select>
    </div>
    <div class="col-md-8">
        <label for="autocomplete">Enter Tests:</label></br>

        <select id="select-test" placeholder="No Test List found"> </select>
    </div>
    <div class="col-md-2">
        <label for="price">Price</label>
        <input type="text" class="form-control" oninput="this.value = this.value.replace(/\D/g, '')" id="textprice">
    </div>
    <div class="col-md-2">
        <label for="add"></label></br>
        <button type="button" id="addBtn">ADD</button>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <table id="testTable" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">SL NO</th>
                    <th scope="col">TEST NAME</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody id="EditTestTableBody">
                <?php
                foreach ($patientTestJson_Decode as $row) { ?>
                    <tr>
                        <td>
                            <?php echo $row['slNo']; ?>
                        </td>
                        <td>
                            <?php echo $row['testName']; ?>
                        </td>
                        <td>
                            <?php echo $row['price']; ?>
                        </td>
                        <td>
                            <button
                                style="background: red;border: none;color: white;padding: 8px;border-radius: 15px;font-weight: bold;"
                                type="button" class="deleteBtn">Delete</button>
                        </td>
                    </tr>

                <?php }
                ?>
            </tbody>
        </table>


    </div>
</div>
<hr>
<div class="row" id="totalamountsection">

    <div style="text-align: end;" class="col-md-6 ">
        <h6>SubTotal Price</h6>
    </div>
    <div class="col-md-6">
        <h6 id="subTotalPrice">
            <?php echo $subTotal; ?>
        </h6>
    </div>
    <div style="text-align: end;" class="col-md-6 mt-3">
        <h6>Discount</h6>
    </div>
    <div style="text-align:start" class="col-md-1 mt-3">
        <input type="checkbox" id="discountcheck" name="discountcheck" <?php if ($discount != '0') {
            echo "checked";
        } ?>
            value="">
    </div>
    <div class="col-md-3 mt-3">
        <input style="width: 80px;height:30px;<?php if ($discount == '0') {
            echo "display:none;";
        } ?>" type="text"
            onkeyup="discountApply()" name="discount" id="discountinput" value="<?php echo $discount; ?>"
            class="form-control discount-input" oninput="this.value = this.value.replace(/\D/g, '')">
    </div>

    <div style="text-align: end;" class="col-md-6 mt-3">
        <h6>Total Price</h6>
    </div>
    <div class="col-md-6 mt-3">
        <h6 id="totalPrice">
            <?php echo $Total; ?>
        </h6>
    </div>

</div>

<button id="submit_edit" type="submit" name="submit_edit"
    style="background: green;color: white;font-size: 15px;font-weight: bold;" class="btn btn-default">Submit</button>