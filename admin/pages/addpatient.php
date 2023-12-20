<?php include("../header.php"); ?>

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">


    <div class="row">
      <div class="col-md-12 grid-margin stretch-card add-patient-section">
        <div class="card">
          <div class="card-body">


            <form>
              <div class="patient-section-heading  mb-2">
                <h6>Patient Details</h6>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label for="name">Patient Name:</label>
                  <input type="text" name="patientName" class="form-control" id="patientName">
                </div>
                <div class="col-md-2">
                  <label for="phone">Phone Number:</label>
                  <input type="text" onkeyup="phoneKeyUp()" name="patientPhone" id="patientPhone" class="form-control"
                    maxlength="10" oninput="this.value = this.value.replace(/\D/g, '')">
                </div>
                <div class="col-md-2">
                  <label for="age">Age:</label>
                  <input type="text" name="patientAge" class="form-control" maxlength="3"
                    oninput="this.value = this.value.replace(/\D/g, '')" id="patientAge">
                </div>

                <div class="col-md-2">
                  <label for="gender">Gender:</label></br>
                  <select name="patientGender" id="patientGender">
                    <option value="select">-select-</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="blood">Blood:</label></br>
                  <select name="patientBloodGrp" id="patientBloodGrp">
                    <option value="select">-select-</option>
                    <option value="a-pos">A+</option>
                    <option value="a-neg">A-</option>
                    <option value="b-pos">B+</option>
                    <option value="b-neg">B-</option>
                    <option value="ab-pos">AB+</option>
                    <option value="ab-neg">AB-</option>
                    <option value="unknown">Unknown</option>
                  </select>
                </div>

              </div>
              <div class="row mt-1">
                <div class="col-md-6">
                  <label for="age">Address:</label>
                  <input type="text" class="form-control" id="patientAddress">
                </div>
                <div class="col-md-6">
                  <label for="doctor">Doctor Name:</label>
                  <input type="text" name="patientDoct" class="form-control" id="patientDoct">
                </div>
                <div id="exist-msg" class="col-md-12 mt-2">
                 
                </div>
              </div>
              <div class="patient-section-heading ">
                <h6>Add Tests</h6>
              </div>

              <div class="row mt-2">
                <div class="col-md-12 mb-3">
                  <label for="blo">Choose Test Category</label></br>
                  <select name="testcategory" id="testcategory">
                    <option value="select">-select-</option>
                    <?php
                    include_once "../db.php";


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
                  <input type="text" class="form-control" oninput="this.value = this.value.replace(/\D/g, '')"
                    id="textprice">
                </div>
                <div class="col-md-2">
                  <label for="add"></label></br>
                  <button type="button" id="addBtn"> + ADD</button>
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
                    <tbody id="testTableBody">


                      <!-- <tr>
                        <td class="text-right font-weight-bold" colspan="2">Total Amount</td>
                        <td class=" font-weight-bold" >0</td>
                      </tr> -->
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
                  <h6 id="subTotalPrice">0.00</h6>
                </div>
                <div style="text-align: end;" class="col-md-6 mt-3">
                  <h6>Discount</h6>
                </div>
                <div style="text-align:start" class="col-md-1 mt-3">
                  <input type="checkbox" id="discountcheck" name="discountcheck" value="">
                </div>
                <div class="col-md-3 mt-3">
                  <input style="width: 80px;display:none;height:30px;" type="text" onkeyup="discountApply()"
                    name="discount" id="discountinput" class="form-control discount-input"
                    oninput="this.value = this.value.replace(/\D/g, '')">
                </div>

                <div style="text-align: end;" class="col-md-6 mt-3">
                  <h6>Total Price</h6>
                </div>
                <div class="col-md-6 mt-3">
                  <h6 id="totalPrice">0.00</h6>
                </div>

              </div>




              <button id="submit" type="submit" name="submit"
                style="background: green;color: white;font-size: 15px;font-weight: bold;"
                class="btn btn-default">Submit</button>
            </form>




          </div>
        </div>
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
              href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All
            rights reserved.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Sanjiban X-Ray and
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

  $(document).ready(function () {
    // $('#select-test').html('<option value="test">test</option>')

    var $selectTest = $('#select-test').selectize({
      sortField: 'text',
      placeholder: 'No Test List found', // Set the placeholder
      valueField: 'value',
      labelField: 'text',
    });


    var $selectize;
    var selectedLabel = '';
    console.log(selectedLabel);
    $('#testcategory').change(function () {
      var selectedCategory = $(this).val();
      //   var $selectTest = $('#select-test');
      // Disable the second dropdown while loading options
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
            console.log("Selected Price:", price);
            $('#textprice').val(price);

          });
        }
      });
    });


    $("#submit").click(function () {
      event.preventDefault();
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
      // Returns successful data submission message when the entered information is stored in database.
      var dataString = 'patientName=' + patientName + '&patientPhone=' + patientPhone + '&patientAge=' + patientAge + '&patientGender=' + patientGender + '&patientBloodGrp=' + patientBloodGrp + '&patientAddress=' + patientAddress + '&patientDoct=' + patientDoct;
      // Collect table data
      var tableBody = document.getElementById('testTableBody');
      var rows = tableBody.getElementsByTagName('tr');
      var rowData = [];

      // Iterate through each row
      for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var rowObject = {
          slNo: cells[0].innerText,
          testName: cells[1].innerText,
          price: cells[2].innerText
        };
        rowData.push(rowObject);
      }

      // Add table data to dataString
      dataString += '&tableData=' + JSON.stringify(rowData) + '&subTotalPrice=' + subTotalPrice + '&TotalPrice=' + TotalPrice + '&discountPrice=' + discountPrice;
      console.log(dataString);

      if (patientName == '' || patientPhone == '' || patientAge == '' || patientGender == 'select' || patientBloodGrp == 'select' || patientAddress == '' || patientDoct == '' || dataString == '') {
        alert("Please Fill All Fields");
      } else if (rowData.length == 0) {
        alert("Please Add Tests");
      } else if (TotalPrice < 0) {
        alert("Total Amount Should not Negetive!");
      }
      else {
        // AJAX Code To Submit Form.
        $.ajax({
          type: "POST",
          url: "ajaxsubmitnewpatient.php",
          data: dataString,
          cache: false,
          success: function (result) {
            if (result.startsWith('SANJIBAN')) {
              showPdf(result);
              setTimeout(function () {
                location.reload();
              }, 2000);


            } else {
              alert('something went wrong');
            }

          }
        });

        function showPdf(result) {
          dataString += '&patientID=' + result;
          $.ajax({
            type: "POST",
            url: "showpdfpatient.php",
            data: dataString,
            cache: false,
            xhrFields: {
              responseType: 'arraybuffer' // Set response type to handle binary data
            },
            success: function (result, textStatus, xhr) {

              // It's a PDF, handle it
              var blob = new Blob([result], { type: 'application/pdf' });
              var url = URL.createObjectURL(blob);

              // Open the PDF in a new window or tab
              window.open(url, '_blank');


            }
          });
        }



      }
      return false;
    });





    checkTestTableCount();
    document.getElementById('addBtn').addEventListener('click', function () {
      // Get values from inputs
      //var testName = document.getElementById('select-test').value;
      console.log(selectedLabel);
      var price = document.getElementById('textprice').value;

      // Check if both fields are filled
      if (selectedLabel && price) {
        // Create a new table row
        var tableBody = document.getElementById('testTableBody');
        var newRow = tableBody.insertRow(tableBody.rows.length);;

        // Add cells to the row
        var slNoCell = newRow.insertCell(0);
        var testNameCell = newRow.insertCell(1);
        var priceCell = newRow.insertCell(2);
        var deleteCell = newRow.insertCell(3)

        // Incremental SL NO
        slNoCell.textContent = tableBody.rows.length;

        // Set values to the cells
        testNameCell.textContent = selectedLabel;
        priceCell.textContent = price;
        //deleteCell.innerHTML = '<i class="fa-solid fa-trash"></i>';



        // Clear input fields
        // var $selectTest = $('#select-test').selectize();
        //  $selectTest[0].selectize.clear();

        document.getElementById('textprice').value = '';

        // updateTotalAmount();
        setTimeout(function () {
          // Set the text content of the heading
          updateTotalAmount();
        }, 2);

        // Ensure deleteCell is not null before adding the delete button
        if (deleteCell) {
          deleteCell.innerHTML = '<button style="background: red;border: none;color: white;padding: 8px;border-radius: 15px;font-weight: bold;" type="button" class="deleteBtn">Delete</button>';

          // Set up event listener for the new delete button
          deleteCell.querySelector('.deleteBtn').addEventListener('click', function () {
            // Remove the parent row when the delete button is clicked
            tableBody.deleteRow(newRow.rowIndex - 1);
            // Update SL NO after deletion
            updateSLNO();
            // Update total amount after deletion
            updateTotalAmount();
            resetDiscount();
          });
        } else {
          console.error('deleteCell is null or undefined');
        }
      } else {
        alert('Please enter both Test Name and Price before adding.');
      }

    });
    function updateSLNO() {
      var tableBody = document.getElementById('testTableBody');
      var rows = tableBody.getElementsByTagName('tr');

      for (var i = 0; i < rows.length; i++) {
        rows[i].cells[0].textContent = i + 1;
      }
    }
    function updateTotalAmount() {
      var tableBody = document.getElementById('testTableBody');
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
    function checkTestTableCount() {
      var tableBody = document.getElementById('testTableBody');
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


    $('#discountcheck').change(function () {
      // If the checkbox is checked, show the discount input; otherwise, hide it
      if ($(this).is(':checked')) {
        $('#discountinput').show();
      } else {
        resetDiscount();
      }
    });

  });

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
  function phoneKeyUp() {
    var phoneNo = $('#patientPhone').val();
    console.log(phoneNo);
    var dataString = 'phoneNo=' + phoneNo;
    $.ajax({
      type: "POST",
      url: "check_phno_exist_ajax.php",
      data: dataString,
      cache: false,
      success: function (result) {
        $('#exist-msg').html(result);
          
      }
    });

    return false;
  }

</script>
<!-- endinject -->
</body>

</html>