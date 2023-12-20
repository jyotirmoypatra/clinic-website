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
                                <h6>New Test Add</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="blo">Choose Test Category:</label></br>
                                    <select name="testcategory" id="testcategory">
                                        <option value="select">-select-</option>
                                        <?php



                                        $query = "select * from testcategory";
                                        $result = mysqli_query($con, $query);

                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                                            }

                                        }




                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="testname">Enter Test Name:</label>
                                    <input type="text" name="testname" class="form-control" id="testname">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="testprice">Enter Test Price:</label>
                                    <input type="text" pattern="[0-9]*"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="testprice"
                                        class="form-control" id="testprice">
                                </div>

                            </div>
                            <button id="submit" type="submit" name="submit"
                                style="background: green;color: white;font-size: 15px;font-weight: bold;"
                                class="btn btn-default mt-3">Add Test</button>


                            <div class="row mt-5">
                                <div class="col-md-12 text-center mt-2 mb-3">
                                    <h4 style="text-decoration:underline;">All Test List</h4>
                                </div>
                                <div class="col-md-8 .search-container  mb-3">
                                    <input type="text" onkeyup="searchTestKeyUp()" placeholder="Search Test.."
                                        name="testname" class="form-control search-input" id="searchTestInput">
                                    <i class="fas fa-search search-icon"></i>
                                    <i class="fas fa-times clear-icon" id="clearIcon"></i>
                                </div>

                                <div class="col-md-4">
                                    <select style="width:unset;max-width:100%;" name="date-select" id="date-select">
                                        <option value="allcategory">All Category</option>
                                        <?php
                                        $query = "select * from testcategory";
                                        $result = mysqli_query($con, $query);

                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                                            }

                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Test Name</th>
                                                <th scope="col">Test Category</th>
                                                <th scope="col">Test Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="testTableBody">
                                            <?php
                                            $query = "SELECT testlist.id, testlist.test_name,testlist.test_price ,testcategory.category
                                            FROM testlist
                                            JOIN testcategory ON testlist.testcategory_id = testcategory.id ORDER BY testlist.id DESC";
                                            $result = mysqli_query($con, $query);

                                            if ($result) {
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
                                                            <a class="delete-icon" href="#"> <i
                                                                    data-value="<?php echo $row['id']; ?>"
                                                                    class="fa-solid fa-trash"></i></a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                mysqli_free_result($result);
                                            }



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

    $(document).ready(function () {
        $("#submit").click(function () {
            event.preventDefault();

            var testname = $("#testname").val();
            var testcategory = $("#testcategory").val();
            var testprice = $("#testprice").val();



            // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'testname=' + testname + '&testcategory=' + testcategory + '&testprice=' + testprice;


            if (testcategory == 'select' || testname == '' || testprice == '') {
                alert("Please Enter All details!");
            }
            else {
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "addtestajax.php",
                    data: dataString,
                    cache: false,
                    success: function (result) {

                        var msg = '';
                        if (result == 'success') {
                            $("#testname").val('');
                            $("#testprice").val('');
                            $("#testcategory").val('select');
                            alert('Successfully Add Test');
                            searchTestKeyUp();
                        } else if (result == 'exist') {
                            alert('Test Already Exist !!');
                        }
                        else {
                            alert('Something Went wrong!');
                        }

                    }
                });
            }
            return false;
        });


        $('#clearIcon').on('click', function () {
            $('#searchTestInput').val('');
            $(this).hide();
            searchTestKeyUp();
        });


        $('#date-select').change(function () {

            searchTestKeyUp();

        });
    });

    function searchTestKeyUp() {
        var searchValue = $('#searchTestInput').val();
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
            url: "search_test_ajax.php",
            data: dataString,
            cache: false,
            success: function (result) {
                console.log(result);
                $('#testTableBody').html(result);

            }
        });

        return false;
    }


    $(document).on('click', '.delete-icon', function (e) {
        e.preventDefault();
        var deleteId = $(this).find("i").data("value");
        var dataString = 'deleteId=' + deleteId;
        var confirmation = confirm("Are you sure you want to delete this test?");
        if(confirmation) {
        // Perform your AJAX call here
        $.ajax({
            type: "POST",
            url: "delete_test_ajax.php",
            data: dataString,
            success: function (response) {
                if (response == 'success') {
                    searchTestKeyUp();
                } else if (response == 'error') {
                    alert('Something Went Wrong');
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    }
    });

</script>

</body>

</html>