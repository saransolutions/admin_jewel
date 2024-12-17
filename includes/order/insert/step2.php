<?php
function step2($input, $page)
{
    
    $data = [];
    $data["pid"] = $input["pid"];
    $data["cid"] = $input["cid"];
    $data["total"] = $input["total"];
    $product = getFetchArray("select * from products where id=".$data["pid"])[0];
    $customer = getFetchArray("select * from customers where id=".$data["cid"])[0];
    $data["product"] = $product;
    $data["customer"] = $customer;

?>
    <?php echo step2_head(); ?>
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
                                    <a class="nav-item nav-link" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">1 </span></div>
                                        </div>
                                    </a>

                                    <!-- Wizard navigation item 3-->
                                    <a class="nav-item nav-link active" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">2 </span></div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 4-->
                                    <a class="nav-item nav-link" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">3 </span></div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <!-- end card - steps -->


                        <!-- start form + cart -->
                        <div class="row mt-4">
                            <!-- to use the left space commented out -->
                            <!--<div class="col-sm">
                            </div>-->
                            <div class="col-sm">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Display Price details</h3>
                                        <?php echo step2_form($data, $page); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- start of cart -->
                            <div class="col-sm">
                                <?php echo step2_cart($data, $page); ?>
                            </div>
                            <!-- end of cart -->
                        </div>
                        <!-- end of form + cart -->
                    </div>
                    <!-- /page content -->
                </div>
                <!-- End of Main Content -->
                <?php echo get_footer(); ?>

                <?php echo reports_form(); ?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
        <?php echo use_old_gold_modal(); ?>
        <?php echo logout_modal(); ?>


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <?php echo js_scripts() ?>
    </body>
<?php
}



function step2_cart($data, $page)
{
    $customer = $data["customer"];
    $customer_name = $customer["first_name"]." ".$customer["last_name"];
    $cid = $customer["id"];
    $product = $data["product"];
    $pid = $product["id"];
    $type_id = $product["product_type_id"];
    $sql = "select name from ".DB_NAME.".product_types where id=".$type_id;
    $type = getSingleValue($sql);
    $word = str_replace("_", " ", $type);
    $word = ucfirst($word);
?>
    <div class="col-md-9 col-lg-6 order-md-last">
        <h4 class="">
            <span class="text-primary">Your cart</span>
            <span class="badge badge-dark bg-primary rounded-pill">1</span>
        </h4>
        <ul class="list-group">
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Customer Name</h6>
                    <small class="text-muted">
                        <a href="customers.php?id=<?php echo $cid; ?>"><?php echo $customer_name; ?></a>
                    </small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Product Type</h6>
                    <small class="text-muted">
                        <a href="products.php?pid=<?php echo $pid; ?>" target="_blank">New <?php echo $word; ?> (<?php echo $pid; ?>) </a>
                    </small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Weight <short>in grams</short>
                    </h6>
                    <small class="text-muted"><?php echo $product["weight_in_grams"]; ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Total Amount</h6>
                    <small class="text-muted"><?php echo $data["total"]; ?> CHF</small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <a href="products.php" class="btn btn-secondary btn-sm" onclick="return confirm('Are you sure?')" name="cancel_project">Cancel</a>
            </li>
        </ul>
    </div>
<?php
}

function step2_form($data)
{ 
?>
    <form method="post" action="orders.php" enctype="multipart/form-data">
        <input type="hidden" name="step2" value="<?php echo htmlentities(serialize($data))?>" />
        <input type="hidden" name="action" value="step3" />
        <div class="container">
            <div class="row mt-1">
                <div class="col-md-12"><label for="square_meters">Total Amount *</label>
                    <input type="text" class="form-control" id="total_amount" name="total_amount" value="<?php echo $data["total"]; ?>" readonly>
                    <div class="invalid-feedback">Invalid Total Amount *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12"><label for="square_meters">Discount</label>
                    <input type="number" step="0.01" value="0" class="form-control" id="discount" name="discount"><br>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#use_old_gold_modal">Use Old Gold</a>
                    <button type="button" class="btn btn-secondary float-right">Use Coupon</button>
                    <div class="invalid-feedback">Invalid Discount *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12"><label for="square_meters">Notes</label>
                    <textarea cols="3" class="form-control" id="discount_notes" name="discount_notes"></textarea>
                    <div class="invalid-feedback">Invalid Discount *</div>
                </div>
            </div>
            <br>
            <button type="submit" name="step3" class="btn btn-primary float-right" onclick="return confirm('Are you sure?')">Confirm</button>
        </div>
    </form>
<?php
}


function step2_head()
{
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo MAIN_TITLE . " - Add New Product"; ?></title>
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
<?php
}

function js_scripts()
{
?>
    <!--scripts-->
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!--scripts-->
<?php
}

function use_old_gold_modal()
{ ?>
    <!-- use_old_gold_modal Modal-->
    <div class="modal fade" id="use_old_gold_modal" tabindex="-1" role="dialog" aria-labelledby="use_old_gold_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="use_old_gold_modalLabel">Use Old Gold</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Enter old gold details</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php?logoff">Return</a>
                </div>
            </div>
        </div>
    </div>
    <!-- use_old_gold_modal Modal-->

<?php } ?>