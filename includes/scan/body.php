<?php

function main()
{
?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo MAIN_TITLE." - Add New Product";?></title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <?php echo sidebar(); ?>
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <?php echo top_bar(); ?>
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <!-- Default Action buttons -->
            <div class="d-flex justify-content-between">
              <div>
                <!--free left space-->
              </div>
            </div>
            <!-- End Action buttons -->
            <!-- start card - steps -->
            <div class="card">
              <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                  <!-- Wizard navigation item 1-->
                  <a class="nav-item nav-link active" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                    <div class="wizard-step-text mt-4">
                      <div class="wizard-step-text-name">Step <span class="badge badge-light">1 </span></div>
                    </div>
                  </a>
                  <!-- Wizard navigation item 3-->
                  <a class="nav-item nav-link" href="#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                    <div class="wizard-step-text mt-4">
                      <div class="wizard-step-text-name">Step <span class="badge badge-light">2 </span></div>
                    </div>
                  </a>
                  <!-- Wizard navigation item 4-->
                  <a class="nav-item nav-link" href="#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                    <div class="wizard-step-text mt-4">
                      <div class="wizard-step-text-name">Step <span class="badge badge-light">3 </span></div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <!-- end card - steps -->


            <!-- start form + cart -->
            <div class="row" style="padding:10px;">
              <div class="col-md-12 col-lg-9">
                <div class="card text-center">
                  <div class="card-body">
                    <h1>Add New Product</h1>
                    <div class="dropdown" style="padding-top:5%;">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Product Type
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="products.php?action=step2&type_id=2">Necklace</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=3">Ear rings</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=5">Bracelets</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=6">Bangles</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=7">Pendents</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=4">Rings</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=8">Chains</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=9">Dollars</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=10">Gold Biscuits</a>
                        <a class="dropdown-item" href="products.php?action=step2&type_id=11">Gold Lamps</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- start of cart -->
              <div class="col-sm">
                <div class="col-md-12 col-lg-9 order-md-last">
                  <h4 class="">
                    <span class="text-primary">Your cart</span>
                    <span class="badge badge-dark bg-primary rounded-pill">1</span>
                  </h4>
                  <ul class="list-group">
                    <li class="list-group-item d-flex">
                      <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">New Project</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex">
                      <span>Total </span>
                      <strong> 0 CHF</strong>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- end of cart -->
            </div>
            <!-- end of form + cart -->
          </div>
          <!-- End of Page Content -->
        </div>
        <!-- End of Main Content -->
        <?php echo get_footer(); ?>
        <?php echo reports_form(); ?>
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <?php echo logout_modal() ?>
    <!-- Logout Modal-->
    <!-- call js scripts -->
    <?php echo js_scripts() ?>
    <!-- call js scripts -->
  </body>
<?php
}

?>