<?php include("header.php");
include "db.php";
?>


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">


    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div
              class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
              <div>
                <p class="mb-2 text-md-center text-lg-left">Total Patient Today</p>
                <?php

                $currentDate = date('Y-m-d');
                $countQuery = "SELECT *, COUNT(*) OVER() AS total_rows
                FROM billing
                WHERE CAST(billing_date AS DATE) = '$currentDate'
                ORDER BY id DESC";
                 $searchResult = mysqli_query($con, $countQuery);
                if ($searchResult->num_rows > 0) {
                  // Fetch the total number of rows
                  $totalRows = $searchResult->fetch_assoc()['total_rows'];
                 
              } else{
                $totalRows = '0';
              }
                ?>
                <h2 class="mb-0"><?php echo $totalRows;  ?></h2>
              </div>
              <i class="typcn typcn-user icon-xl text-secondary"></i>
            </div>
            <canvas id="expense-chart" height="80"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div
              class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
              <div>
                <p class="mb-2 text-md-center text-lg-left">Total Balance Today</p>
                <?php

                $currentDate = date('Y-m-d');
                $totalQuery = "SELECT *,
                SUM(CAST(total_amount AS DECIMAL(10, 2))) OVER() AS total_amount
                FROM billing
                WHERE CAST(billing_date AS DATE) = '$currentDate'
                ORDER BY id DESC";
                $sumTotalResult = mysqli_query($con, $totalQuery);
                if ($sumTotalResult->num_rows > 0) {
                  // Fetch the total number of rows
                  $totalRows = $sumTotalResult->fetch_assoc()['total_amount'];
                 
              }else{
                $totalRows = '0';
              } ?>
                <h2 class="mb-0">RS. <?php echo  $totalRows; ?></h2>
              </div>
              <!-- <i class="fa-solid fa-indian-rupee-sign" style="font-size:35px;"></i> -->
            </div>
            <canvas id="budget-chart" height="80"></canvas>
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
              href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All rights
            reserved.</span>
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
<!-- container-scroller -->
<!-- 
<script src="<?php echo $hostUrl ?>/sanjiban-xray/admin/js/off-canvas.js"></script>
<script src="<?php echo $hostUrl ?>/sanjiban-xray/admin/js/template.js"></script>
<script src="<?php echo $hostUrl ?>/sanjiban-xray/admin/js/settings.js"></script> -->

<!-- End custom js for this page-->
</body>

</html>