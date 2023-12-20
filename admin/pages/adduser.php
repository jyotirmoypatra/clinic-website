<?php include("../header.php");include_once "../db.php"; ?>


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">


    <div class="row">
      <div class="col-md-12 grid-margin stretch-card add-patient-section">
        <div class="card">
          <div class="card-body">


            <form>
              <div style="background:blueviolet" class="patient-section-heading  mb-2">
                <h6>Add New User Details</h6>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label for="uname">User Name:</label>
                  <input type="text" name="uname" class="form-control" id="uname">
                </div>
                <div class="col-md-3">
                  <label for="uemail">User Email:</label>
                  <input type="text" name="uemail" class="form-control" id="uemail">
                </div>
                <div class="col-md-2">
                  <label for="upass">Set User Password:</label>
                  <input type="text" name="upass" class="form-control" id="upass">
                </div>

                <div class="col-md-3">
                  <label for="urole">Role:</label></br>
                  <select style="width: 170px;" name="urole" id="urole">
                    <option value="select">-select-</option>
                    <option value="admin">Admin</option>
                    <option value="Receptionist">Receptionist</option>
                  </select>
                </div>

              </div>
              <button id="submit" type="submit" name="submit"
                style="background: green;color: white;font-size: 15px;font-weight: bold;"
                class="btn btn-default mt-3">ADD</button>
            </form>

          </div>
        </div>
      </div>
      <div class="col-md-12 mt-2">
        <div class="card ">
          <div class="row card-body">
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr class="text-center">
                    <th colspan="4"><h5>All User</h5></td>
                  </tr>
                  <tr>
                    <th scope="col">Username</th>
                    <th scope="col">User Email</th>
                    <th scope="col">User Password</th>
                    <th scope="col">Role</th>
                  </tr>
                </thead>
                <tbody id="testTableBody">
                  <?php
                  $userquery = "select * from users order by id desc";
                  $result = mysqli_query($con, $userquery);

                  if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                      <tr>
                        <td>
                          <?php echo $row['name']; ?>
                        </td>
                        <td>
                          <?php echo $row['email']; ?>
                        </td>
                        <td>
                          <?php echo $row['pass']; ?>
                        </td>

                        <td>
                         
                        <?php if($row['role']==1){echo "Admin";}else{echo "Receptionist";}; ?>
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
    $("#submit").click(function () {
      event.preventDefault();
      var uname = $("#uname").val();
      var uemail = $("#uemail").val();
      var upass = $("#upass").val();
      var urole = $("#urole").val();

      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      // Returns successful data submission message when the entered information is stored in database.
      var dataString = 'uname=' + uname + '&uemail=' + uemail + '&upass=' + upass + '&urole=' + urole;


      if (uname == '' || uemail == '' || upass == '' || urole == 'select') {
        alert("Please Fill All Fields");
      }else if(!emailRegex.test(uemail)){
        alert("Email not valid!");
      }
      else {
        // AJAX Code To Submit Form.
        $.ajax({
          type: "POST",
          url: "ajaxsubmitnewuser.php",
          data: dataString,
          cache: false,
          success: function (result) {
            var msg = '';


            if (result == 'exist') {
              msg = 'Same Username and Email Exist in database!';
            } else if (result == 'success') {

              $("#uname").val('');
              $("#uemail").val('');
              $("#upass").val('');
              $("#urole").val('select');

              msg = 'User Created SuccessFully';
              location.reload(true);

            } else {
              msg = 'Something Went Wrong!!';
            }
            alert(msg);
          }
        });
      }
      return false;
    });
  });

</script>

</body>

</html>