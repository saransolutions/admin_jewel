<?php
function step5($data)
{
    $service = $data["service"];
    $word = str_replace("_", " ", $service);
    $start_date = $data["start_date"];
    $end_date = $data["end_date"];

    $building_type = $data["building_type"];
    $number_of_rooms = $data["number_of_rooms"];
    $floor = $data["floor"];
    $square_meters = $data["square_meters"];
    $is_elevator = $data["is_elevator"];
    $ort_von = "";
    if (isset($data["ort_von"])) {
        $ort_von = $data["ort_von"];
    }

    $ort_nach = "";
    if (isset($data["ort_nach"])) {
        $ort_nach = $data["ort_nach"];
    }


    $prefix = $data["prefix"];
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $address = $data["address"];
    $ort = $data["ort"];
    $pin_code = $data["pin_code"];
    $mobile = $data["mobile"];
    $email = $data["email"];

?>
    <?php echo step5_head(); ?>

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
                                    <!-- Wizard navigation item 2-->
                                    <a class="nav-item nav-link" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">2 </span></div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 3-->
                                    <a class="nav-item nav-link" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">3 </span></div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 4-->
                                    <a class="nav-item nav-link" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">4 </span></div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 5-->
                                    <a class="nav-item nav-link active" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">5 </span></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end card - steps -->

                        <!-- start main content -->
                        <div class="row mt-4">
                            <div class="col-sm">
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h1>New <?php echo $word; ?> Project</h1>
                                    <!--form-->
                                    <?php echo step5_form(
                                        $word,
                                        $start_date,
                                        $end_date,
                                        $building_type,
                                        $number_of_rooms,
                                        $floor,
                                        $square_meters,
                                        $is_elevator,
                                        $ort_von,
                                        $ort_nach,
                                        $prefix,
                                        $first_name,
                                        $last_name,
                                        $address,
                                        $ort,
                                        $pin_code,
                                        $mobile,
                                        $email
                                    ); ?>
                                    <!--form-->
                                </div>
                            </div>
                            <div class="col-sm">
                                <!-- cart -->
                                <?php echo step5_cart(
                                    $word,
                                    $start_date,
                                    $end_date,
                                    $building_type,
                                    $number_of_rooms,
                                    $floor,
                                    $square_meters,
                                    $is_elevator,
                                    $ort_von,
                                    $ort_nach,
                                    $prefix,
                                    $first_name,
                                    $last_name,
                                    $address,
                                    $ort,
                                    $pin_code,
                                    $mobile,
                                    $email
                                ); ?>
                                <!-- cart -->
                            </div>
                        </div>

                        <!-- main content -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <?php echo get_footer(); ?>

                <?php echo reports_form(); ?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <?php echo logout_modal() ?>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <?php echo js_scripts() ?>
    </body>
<?php
}

function step5_cart(
    $word,
    $start_date,
    $end_date,
    $building_type,
    $number_of_rooms,
    $floor,
    $square_meters,
    $is_elevator,
    $ort_von,
    $ort_nach,
    $prefix,
    $first_name,
    $last_name,
    $address,
    $ort,
    $pin_code,
    $mobile,
    $email
) {
?>
    <div class="col-md-9 col-lg-6 order-md-last">
        <h4 class="">
            <span class="text-primary">Your cart</span>
            <span class="badge badge-dark bg-primary rounded-pill">1</span>
        </h4>
        <ul class="list-group">
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Product name</h6>
                    <small class="text-muted">New <?php echo $word; ?> Project</small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Dates</h6>
                    <small class="text-muted"><?php echo $start_date; ?> - <?php echo $end_date; ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Platz</h6>
                    <small class="text-muted"><?php echo $building_type . " (" . $number_of_rooms . " zimmer) (" . $floor . ")- " . $square_meters . " m2"; ?></small>
                </div>
            </li>
            <?php
            if ($word == "Umzug") {
            ?>
                <li class="list-group-item d-flex">
                    <div>
                        <h6 class="my-0">Umzug</h6>
                        <small class="text-muted"><?php echo $ort_von . " - " . $ort_nach; ?></small>
                    </div>
                </li>
            <?php
            }
            ?>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Kunden</h6>
                    <small class="text-muted"><?php echo $first_name . " " . $last_name; ?></small>
                    <small class="text-muted"><?php echo $address . ", " . $ort . " " . $pin_code; ?></small>
                    <small class="text-muted"><?php echo $mobile ?></small>
                    <small class="text-muted"><?php echo $email; ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <span>Total </span>
                <strong><?php echo INITIAL_UMZUG_PACKAGE_AMOUNT; ?> CHF</strong>
            </li>
            <li class="list-group-item d-flex">
                <a href="projects.php" class="btn btn-secondary btn-sm" onclick="return confirm('Are you sure?')" name="cancel_project">Cancel</a>
            </li>
        </ul>
    </div>
<?php
}

function step5_form(
    $word,
    $start_date,
    $end_date,
    $building_type,
    $number_of_rooms,
    $floor,
    $square_meters,
    $is_elevator,
    $ort_von,
    $ort_nach,
    $prefix,
    $first_name,
    $last_name,
    $address,
    $ort,
    $pin_code,
    $mobile,
    $email
) {
?>
    <form method="post" action="projects.php">
        <input type="hidden" name="type_of_service" value="<?php echo $word; ?>" />
        <input type="hidden" name="start_date" value="<?php echo $start_date; ?>" />
        <input type="hidden" name="end_date" value="<?php echo $end_date; ?>" />

        <input type="hidden" name="building_type" value="<?php echo $building_type; ?>" />
        <input type="hidden" name="number_of_rooms" value="<?php echo $number_of_rooms; ?>" />
        <input type="hidden" name="floor" value="<?php echo $floor; ?>" />
        <input type="hidden" name="square_meters" value="<?php echo $square_meters; ?>" />
        <input type="hidden" name="is_elevator" value="<?php echo $is_elevator; ?>" />
        <input type="hidden" name="ort_von" value="<?php echo $ort_von; ?>" />
        <input type="hidden" name="ort_nach" value="<?php echo $ort_nach; ?>" />

        <input type="hidden" name="prefix" value="<?php echo $prefix; ?>" />
        <input type="hidden" name="first_name" value="<?php echo $first_name; ?>" />
        <input type="hidden" name="last_name" value="<?php echo $last_name; ?>" />
        <input type="hidden" name="address" value="<?php echo $address; ?>" />
        <input type="hidden" name="ort" value="<?php echo $ort; ?>" />
        <input type="hidden" name="pin_code" value="<?php echo $pin_code; ?>" />
        <input type="hidden" name="mobile" value="<?php echo $mobile; ?>" />
        <input type="hidden" name="email" value="<?php echo $email; ?>" />


        <div class="container-sm">
            <div class="row">
                <div class="col-md-6 mb-3"><label for="total_price">Gesamtpreis *</label><input type="text" class="form-control" id="total_price" name="total_price" required="">
                    <div class="invalid-feedback">Invalid Total</div>
                </div>

                <div class="col-md-6 mb-3"><label for="advance_amount">Vorschuss-Betrag *</label><input type="text" class="form-control" id="advance_amount" name="advance_amount" required="">
                    <div class="invalid-feedback">Invalid Advance</div>
                </div>
            </div>

            <div class="form-group">
                <label for="comments1">Bemerkungen 1</label>
                <textarea class="form-control" id="comments1" name="comments_1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="comments1">Bemerkungen 2</label>
                <textarea class="form-control" id="comments2" name="comments_2" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="comments1">Bemerkungen 3</label>
                <textarea class="form-control" id="comments3" name="comments_3" rows="3"></textarea>
            </div>
            <input type="submit" name="step5" class="btn btn-primary"></input>
        </div>
    </form>
<?php
}


function step5_head()
{
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>FinishExpress - Create New Project</title>
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


?>