<?php



include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                $query="SELECT staffID from admin ORDER BY staffID; ";
                $result=$conn->query($query);

                $rows=mysqli_num_rows($result);
                echo "<h5> Total Admin: $rows </h5>";
                ?>
               

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Customers</div>
              <div class="row no-gutters align-items-center">
              <?php
                $query="SELECT id from tbl_customer ORDER BY id ; ";
                $result=$conn->query($query);

                $rows=mysqli_num_rows($result);
                echo "<h5> Total Customers: $rows </h5>";
                ?>
                <!-- <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">30%</div>
                </div> -->
                <!-- <div class="col"> -->
                  <!-- <div class="progress progress-sm mr-2"> -->
                    <!-- <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div> -->
                  <!-- </div> -->
                <!-- </div> -->
              </div>
            </div>
            <div class="col-auto">
              <i class="fa fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <?php
                $query="SELECT orderStatus from tbl_order ORDER BY orderID ; ";
                $result=$conn->query($query);

                $rows=mysqli_num_rows($result);
                echo "<h5> Total Pending: $rows </h5>";
                ?>
              <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">18</div> -->
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>