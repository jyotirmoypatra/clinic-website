<?php include("../header.php");
include_once "../db.php";
?>


<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card add-patient-section">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div style="background:blueviolet" class="patient-section-heading  mb-2">
                                <h6>Patient List</h6>
                            </div>
                            <div class="row mt-3">

                                <div class="col-md-6 .search-container ">
                                    <input type="text" onkeyup="searchKeyUp()"
                                        placeholder="Search by Name or ID or Phone" name="testname"
                                        class="form-control search-input" id="searchPatient">
                                    <i class="fas fa-search search-icon"></i>
                                    <i class="fas fa-times clear-icon" id="clearIcon"></i>
                                </div>
                                <div class="col-md-3">
                                    <select name="date-select" id="date-select">
                                        <option value="alldate">All Date</option>
                                        <option value="today">Today</option>
                                        <option value="yesterday">Yesterday</option>
                                        <option value="thisMonth">This Month</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <?php

                                    $count = "select count(*) as total from billing";
                                    $result = mysqli_query($con, $count);

                                    if ($result->num_rows > 0) {
                                        // Fetch the result as an associative array
                                        $row = $result->fetch_assoc();

                                        // Total count of rows
                                        $totalCount = $row['total'];


                                    } else {
                                        $totalCount = '0';
                                    }
                                    ?>
                                    <p id="count-tag" style="text-align: end; color:blue;">
                                        <?php echo "Total Count: " . $totalCount; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">NAME</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">PHONE</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="testTableBody">
                                            <?php

                                            $query = "select * from billing order by id DESC";
                                            $result = mysqli_query($con, $query);

                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['patient_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['patient_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['patient_phone']; ?>
                                                        </td>
                                                        <td>
                                                            <a class="pdf-icon-link" href="#"> <i
                                                                    data-value="<?php echo $row['patient_id']; ?>"
                                                                    class="fa-regular fa-file-pdf"></i></a>
                                                            <a class="edit_icon ml-4" href="#"> <i
                                                                    data-value="<?php echo $row['patient_id']; ?>"
                                                                    class="fa-solid fa-pen-to-square"></i></a>
                                                            <a class="delete-icon ml-4" href="#"> <i
                                                                    data-value="<?php echo $row['patient_id']; ?>"
                                                                    class="fa-solid fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                mysqli_free_result($result);
                                            }

                                            mysqli_close($con);

                                            ?>


                                        </tbody>
                                    </table>


                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!--------- edit patient modal----------------------->
        <div class="card-body add-patient-section" id="myModal">
            <div class="modalContent" id="modalContentContainer">
            </div>

        </div>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a
                            href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>.
                        All
                        rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Sanjiban X-Ray
                        and
                        diagonestic centre</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>



<script>


    function searchKeyUp() {

        var searchValue = $('#searchPatient').val();
        var dateValue = $('#date-select').val();
        var dataString = 'searchValue=' + searchValue + '&dateValue=' + dateValue;
        console.log(dataString);
        if (searchValue) {
            $('#clearIcon').show();
        } else {
            $('#clearIcon').hide();
        }

        console.log(searchValue);
        // AJAX Code To Submit Form.
        $.ajax({
            type: "POST",
            url: "searchpatient_ajax.php",
            data: dataString,
            cache: false,
            success: function (result) {
                console.log(result);
                $('#testTableBody').html(result);
                countlist();
            }
        });

        return false;

    }
    function countlist() {
        var rowCount = $('#testTableBody tr').length;

        if (rowCount === 1 && $('#testTableBody tr td').text().trim() === 'No data found') {
            rowCount = 0;
        }

        $('#count-tag').text('Total Count: ' + rowCount);
    }

    $('#clearIcon').on('click', function () {
        $('#searchPatient').val('');
        $(this).hide();
        searchKeyUp();
    });
    $(document).ready(function () {
        $('#date-select').change(function () {

            searchKeyUp();

        });
    });
    $(document).on('click', '.pdf-icon-link', function (e) {
        e.preventDefault();
        var pid = $(this).find("i").data("value");
        var dataString = 'pid=' + pid;
        // Perform your AJAX call here
        $.ajax({
            type: "POST",
            url: "showpdf_by_id.php",
            data: dataString,
            xhrFields: {
                responseType: 'arraybuffer' // Set response type to handle binary data
            },
            success: function (response) {

                // It's a PDF, handle it
                var blob = new Blob([response], { type: 'application/pdf' });
                var url = URL.createObjectURL(blob);

                // Open the PDF in a new window or tab
                window.open(url, '_blank');
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });







    });

    $(document).ready(function () {

        $(document).on('click', '.edit_icon', function () {
            var patientID = $(this).find('i').data('value');
            console.log(patientID);
            $('#myModal').show();
            document.body.classList.add('modal-open');
            loadModalContent(patientID);
        });

        $(document).on('click', '.delete-icon', function () {
            var patientID = $(this).find('i').data('value');
            console.log(patientID);
            var dataString = 'patientID=' + patientID;
            var confirmation = confirm("Are you sure you want to delete this Patient?");
            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "delete_patient.php",
                    data: dataString,
                    cache: false,
                    success: function (result) {
                        if (result == 'success') {

                            alert('Deleted User Successfully');

                            searchKeyUp();
                        } else {
                            alert('something went wrong');
                        }

                    }
                });
            }

        });




        var $selectTest = $('#select-test').selectize({
            sortField: 'text',
            placeholder: 'No Test List found', // Set the placeholder
            valueField: 'value',
            labelField: 'text',
        });


    });
    function closeModal() {
        $('#myModal').hide();
        document.body.classList.remove('modal-open');
    }
    function loadModalContent(patientID) {
        // Use AJAX to fetch th   var $selectize='';
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Populate the modal content container with the fetched content
                document.getElementById('modalContentContainer').innerHTML = xhr.responseText;
                console.log('EditTestTableBody:', document.getElementById('EditTestTableBody'));
                $selectTest = $('#select-test').selectize({
                    sortField: 'text',
                    placeholder: 'No Test List found', // Set the placeholder
                    valueField: 'value',
                    labelField: 'text',
                });
                checkTestTableCount();
                //  updateTotalAmount();

                var deleteButtons = document.querySelectorAll('.deleteBtn');

                deleteButtons.forEach(function (deleteBtn) {
                    deleteBtn.addEventListener('click', function () {
                        var row = this.closest('tr');
                        handleDeleteRow(row);
                    });
                });

                $('#discountcheck').change(function () {
                    // If the checkbox is checked, show the discount input; otherwise, hide it
                    if ($(this).is(':checked')) {
                        $('#discountinput').show();
                    } else {
                        resetDiscount();
                    }
                });
                var selectedLabel = '';
                console.log(selectedLabel);
                $('#testcategory').change(function () {
                    var selectedCategory = $(this).val();

                    $selectTest.prop('disabled', true);

                    var dataString = 'selectedCategory=' + selectedCategory;
                    if ($selectTest[0].selectize) {
                        $selectTest[0].selectize.destroy();
                    }
                    $.ajax({
                        url: 'get_test_list.php',
                        type: 'POST',
                        data: dataString,
                        success: function (response) {
                            $('#textprice').val('');
                            var isResponseEmpty = $.trim(response) === '';

                            console.log(response); // Log the response for debugging

                            $selectTest.html(response);
                            $selectTest.prop('disabled', false);
                            $selectize = $('#select-test').selectize({
                                sortField: 'text',
                                valueField: 'value',
                                labelField: 'text',
                                placeholder: isResponseEmpty ? 'No Test List found' : 'Pick a Test...', // Set the placeholder
                                onInitialize: function () {
                                    var s = this;
                                    this.revertSettings.$children.each(function () {
                                        $.extend(s.options[this.value], $(this).data());
                                    });
                                }

                            })[0].selectize;
                            // $selectTest[0].selectize.clear();
                            $selectize.clear();


                            // Bind the onChange event here
                            $selectize.on('change', function (value) {
                                selectedLabel = $selectize.options[value].text;

                                var s = $('#select-test')[0].selectize; // Get selectize instance
                                var selectedOptionValue = s.items[0]; // Get the value of the selected option
                                var data = s.options[selectedOptionValue]; // Get data() for the active option
                                var price = data.price; // Assuming 'price' is the data attribute you want to retrieve

                                // Now you can use the retrieved data as needed

                                $('#textprice').val(price);

                            });
                        }
                    });
                });



                document.getElementById('addBtn').addEventListener('click', function () {

                    var price = document.getElementById('textprice').value;
                    console.log(selectedLabel);
                    console.log("Selected Price:", price);
                    // Check if both fields are filled
                    if (selectedLabel && price) {
                        // Create a new table row
                        var tableBody = document.getElementById('EditTestTableBody');
                        var newRow = tableBody.insertRow(tableBody.rows.length);;
                        console.log("row-", newRow);
                        // Add cells to the row
                        var slNoCell = newRow.insertCell(0);
                        var testNameCell = newRow.insertCell(1);
                        var priceCell = newRow.insertCell(2);
                        var deleteCell = newRow.insertCell(3)


                        slNoCell.textContent = tableBody.rows.length;


                        testNameCell.textContent = selectedLabel;
                        priceCell.textContent = price;

                        document.getElementById('textprice').value = '';

                        setTimeout(function () {

                            updateTotalAmount();
                        }, 2);


                        if (deleteCell) {
                            deleteCell.innerHTML = '<button style="background: red;border: none;color: white;padding: 8px;border-radius: 15px;font-weight: bold;" type="button" class="deleteBtn">Delete</button>';


                            deleteCell.querySelector('.deleteBtn').addEventListener('click', function () {

                                handleDeleteRow(newRow);
                            });
                        } else {
                            console.error('deleteCell is null or undefined');
                        }
                    } else {
                        alert('Please enter both Test Name and Price before adding.');
                    }

                });
                //submit edit patient data
                $('#submit_edit').on('click', function () {
                    event.preventDefault();
                    var patient_id = $('#patient-id span').text();
                    var patientName = $("#patientName").val();
                    var patientPhone = $("#patientPhone").val();
                    var patientAge = $("#patientAge").val();
                    var patientGender = $("#patientGender").val();
                    var patientBloodGrp = $("#patientBloodGrp").val();
                    var patientAddress = $("#patientAddress").val();
                    var patientDoct = $("#patientDoct").val();
                    var TotalPrice = parseFloat($('#totalPrice').text());
                    var subTotalPrice = parseFloat($('#subTotalPrice').text());
                    var discountPrice = $("#discountinput").val();
                    if (discountPrice == '') { discountPrice = 0 }
                    var dataString = 'patientID=' + patient_id + '&patientName=' + patientName + '&patientPhone=' + patientPhone + '&patientAge=' + patientAge + '&patientGender=' + patientGender + '&patientBloodGrp=' + patientBloodGrp + '&patientAddress=' + patientAddress + '&patientDoct=' + patientDoct;
                    var tableBody = document.getElementById('EditTestTableBody');
                    var rows = tableBody.getElementsByTagName('tr');
                    var rowData = [];
                    for (var i = 0; i < rows.length; i++) {
                        var cells = rows[i].getElementsByTagName('td');
                        var rowObject = {
                            slNo: cells[0].innerText,
                            testName: cells[1].innerText,
                            price: cells[2].innerText
                        };
                        rowData.push(rowObject);
                    }
                    dataString += '&tableData=' + JSON.stringify(rowData) + '&subTotalPrice=' + subTotalPrice + '&TotalPrice=' + TotalPrice + '&discountPrice=' + discountPrice;
                    console.log(dataString);
                    if (patientName == '' || patientPhone == '' || patientAge == '' || patientGender == 'select' || patientBloodGrp == 'select' || patientAddress == '' || patientDoct == '' || dataString == '') {
                        alert("Please Fill All Fields");
                    } else if (rowData.length == 0) {
                        alert("Please Add Tests");
                    } else if (TotalPrice < 0) {
                        alert("Total Amount Should not Negetive!");
                    } else {
                        // AJAX Code To Submit Form.
                        $.ajax({
                            type: "POST",
                            url: "edit_old_patient_data.php",
                            data: dataString,
                            cache: false,
                            success: function (result) {
                                if (result == 'success') {

                                    alert('Edited Successfully');
                                    closeModal();

                                } else {
                                    alert('something went wrong');
                                }

                            }
                        });
                    }
                });

                document.getElementById('closeModal').addEventListener('click', closeModal);
            }
        };
        xhr.open('GET', 'edit_patient_modal_content.php?patientID=' + patientID, true);
        xhr.send();
    }
    function updateSLNO() {
        var tableBody = document.getElementById('EditTestTableBody');
        var rows = tableBody.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            rows[i].cells[0].textContent = i + 1;
        }
    }
    function updateTotalAmount() {
        var tableBody = document.getElementById('EditTestTableBody');
        var rows = tableBody.getElementsByTagName('tr');
        var subTotalAmountText = document.getElementById('subTotalPrice'); // Assuming the total amount cell is in the last row and third cell (index 2)

        var totalAmount = 0;
        console.log(rows.length);
        // Skip the header and total rows
        for (var i = 0; i < rows.length; i++) {
            var priceCell = rows[i].cells[2]; // Assuming the price cell is the fourth cell (index 3)

            if (priceCell) {
                var priceText = priceCell.textContent.trim(); // Remove leading/trailing whitespaces
                // console.log('Price Text:', priceText);

                var price = parseFloat(priceText);
                // console.log('Parsed Price:', price);

                totalAmount += isNaN(price) ? 0 : price;



            }

        }

        // Update the total amount cell
        subTotalAmountText.textContent = totalAmount; // Format as needed
        checkTestTableCount();
        resetDiscount();
    }
    function handleDeleteRow(row) {
        var tableBody = document.getElementById('EditTestTableBody');

        // Handle deletion logic here (e.g., update SL NO, total amount, etc.)
        tableBody.deleteRow(row.rowIndex - 1);
        updateSLNO();
        updateTotalAmount();
        resetDiscount();
    }

    function checkTestTableCount() {
        var tableBody = document.getElementById('EditTestTableBody');
        var myTable = document.getElementById('testTable');
        var totalAmountSection = document.getElementById('totalamountsection');

        if (tableBody.rows.length === 0) {
            myTable.style.display = 'none';
            totalAmountSection.style.display = 'none';
        } else {
            myTable.style.display = 'table'; // Show the table (default display property)
            totalAmountSection.style.display = 'flex';
        }
    }
    function resetDiscount() {
        $('#discountcheck').prop('checked', false);
        $('#discountinput').hide();
        $('#discountinput').val('')
        var TotalAmountText = document.getElementById('totalPrice');
        var subTotalPrice = parseFloat($('#subTotalPrice').text());
        TotalAmountText.textContent = subTotalPrice;
    }

    function discountApply() {
        if ($('#discountcheck').is(':checked')) {
            var discountPrice = parseFloat($('#discountinput').val());
            var subTotalPrice = parseFloat($('#subTotalPrice').text());

            console.log(discountPrice);
            console.log(subTotalPrice);
            subTotalPrice -= isNaN(discountPrice) ? 0 : discountPrice;

            var TotalAmountText = document.getElementById('totalPrice');
            TotalAmountText.textContent = subTotalPrice;

        }
    }
</script>


</body>


</html>