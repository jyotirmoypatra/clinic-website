<?php include("../header.php"); ?>


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">


    <div class="row">
      <div class="col-md-12 grid-margin stretch-card add-patient-section">
        <div class="card">
          <div class="card-body">


            <form>
              <div style="background:blueviolet" class="patient-section-heading  mb-2">
                <h6 >New Test Category Add</h6>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="category">Category Name:</label>
                  <input type="text" name="category" class="form-control" id="category">
                </div>
                

              </div>
              <button  id="submit" type="submit" name="submit"
                style="background: green;color: white;font-size: 15px;font-weight: bold;"
                class="btn btn-default mt-3">Add Category</button>
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
    $("#submit").click(function () {
      event.preventDefault();
      var category = $("#category").val();
     
      
    
      // Returns successful data submission message when the entered information is stored in database.
      var dataString = 'category=' + category ;
      

      if (category == ''  ) {
        alert("Please Enter Category!");
      }
      else {
        // AJAX Code To Submit Form.
        $.ajax({
          type: "POST",
          url: "addcategoryajax.php",
          data: dataString,
          cache: false,
          success: function (result) {
            $("#category").val('');
           
             if(result=='success'){
                alert('Successfully Add Category');
             }else if(result=='exist'){
                alert('Category Already Exist !!');
             }
             else{
                alert('Something Went wrong!');
             }
           
          }
        });
      }
      return false;
    });
  });

</script>

</body>

</html>