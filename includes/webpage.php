<?php


function get_head($page)
{
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo MAIN_TITLE . " - " . $page["title"]; ?></title>
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
        <script src="includes/<?php echo $page["module"]; ?>/<?php echo $page["module"]; ?>.js"></script>
    </head>
<?php
}
?>

<?php
function sidebar()
{
?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <img src="img/logo.png" alt="test" style="width:100%;background-color:#fff2e6"></img>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->

        <!-- Divider -->
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="#" style="color:yellow;" data-toggle="modal" data-target="#updateRatesModal">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Update Rates</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="orders.php">
                <i class="fas fa-fw fa-folder"></i>
                <span>Orders</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="products.php?dashboard">
                <i class="fas fa-fw fa-folder"></i>
                <span>Products</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="scan.php" target="_blank">
                <i class="fas fa-fw fa-folder"></i>
                <span>Scan</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="customers.php">
                <i class="fas fa-fw fa-folder"></i>
                <span>Customers</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="schemes.php">
                <i class="fas fa-fw fa-folder"></i>
                <span>Schemes</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="products.php?letter_pad">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Letter Pad</span></a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" target="_blank" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-table"></i>
                <span>Berichte</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="products.php?mreport_form">Monat-Berichte</a>
                    <a class="collapse-item" href="products.php?yreport_form">Jahr-Berichte</a>
                </div>
            </div>
        </li>
        <!-- Nav Item - Utilities Collapse Menu -->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->


    </ul>
    <!-- End of Sidebar -->
<?php
}

function top_bar()
{
?>
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
        </form>


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->

            </li>

            <!-- Nav Item - Alerts -->


            <!-- Nav Item - Messages -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                    <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Abmelden
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->
<?php
}

function get_footer()
{
    return '
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; ' . MAIN_TITLE . ' 2024</span><br>
                <span>Designed by <a href="https://saransolutions.ch/">Saran Solutions</a></span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
    ';
}

function logout_modal()
{ ?>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php?logoff">Abmelden</a>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php function update_rates_modal()
{ ?>
    <!-- update_rates Modal-->
    <div class="modal fade" id="updateRatesModal" tabindex="-1" role="dialog" aria-labelledby="updateRatesModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRatesModal">Today's Rate</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php get_today_rates(); ?></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- update_rates Modal-->
<?php } ?>

<?php

function get_rate($purity, $metal_type)
{
    $part2 = '';
    if ($purity != null) {
        $part2 = "and purity='" . $purity . "'";
    }
    $part1 = "select rate from " . DB_NAME . ".today_rates where metal_type = '" . $metal_type . "' and purity='" . $purity . "' and modified_date";
    $sql = $part1 . " = (SELECT max(modified_date) FROM " . DB_NAME . ".today_rates WHERE metal_type = '" . $metal_type . "' " . $part2 . " )";
    return getSingleValue($sql);
}
function get_today_rates()
{
    $page_php = "products.php";
?>
    <!-- update_rates_form -->
    <div class="container" aria-hidden="false">
        <form method="post" action="<?php echo $page_php; ?>" enctype="multipart/form-data" name="update_rates_form">
            <div class="form-group row">
                <label for="gold_22k">Gold 22K per Gram</label>
                <div class="col-md-3">
                    <input type="number" step="0.01" class="form-control" id="gold_22k" name="gold_22k" value="<?php echo get_rate("22", "gold"); ?>" required="">
                </div>
            </div>
            <div class="form-group row">
                <label for="gold_24k">Gold 24K per Gram</label>
                <div class="col-sm-3">
                    <input type="number" step="0.01" class="form-control" id="gold_24k" name="gold_24k" value="<?php echo get_rate("24", "gold"); ?>" required="">
                </div>
            </div>
            <div class="form-group row">
                <label for="silver">Silver per Kilo</label>
                <div class="col-md-3">
                    <input type="number" step="0.01" class="form-control" id="silver" name="silver" value="<?php echo get_rate(null, "silver"); ?>" required="">
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="update_rates">Update</button>
        </form>
    </div>
    <!-- update_rates_form -->
<?php }

function get_steps_card($page)
{
?>
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
<?php
}
?>