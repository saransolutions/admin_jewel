<?php

function step1($page)
{
?>
  <?php echo get_head($page); ?>
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
                    <form method="post" action="products.php" enctype="multipart/form-data">
                      <input type="hidden" name="action" value="step2" />
                      <div class="mb-3">
                        <label for="input1" class="form-label">Metal Type</label>
                        <select class="dropdown" name="metal_type" id="metal_type">
                          <option></option>
                          <option value="gold">Gold</option>
                          <option value="silver">Silver</option>
                          <option value="diamond">Diamond</option>
                        </select>
                      </div>
                      <div id="ph_purity"></div>
                      <button type="submit" name="step2" class="btn btn-primary float-right">Next</button>
                    </form>

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