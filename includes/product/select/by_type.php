<?php
$type_id = $_GET["by_type_id"];
function display_images($type_id)
{
    $data = "";
    $sql = "select * from " . DB_NAME . ".products where in_stock = 'yes' and product_type_id=".$type_id;
    
    $rows = getFetchArray($sql);
    if ($rows != null) {
        foreach ($rows as $result) {

            $today_rate = get_rate($result["purity"], $result["metal_type"]);
            $net_amount = round($today_rate*$result["weight_in_grams"]);
            $total_amount = round(($net_amount + $result["purchase_expense"]));
            $img_path_sql = "select path from " . DB_NAME . ".album where parent_id = ".$result["id"]." order by id LIMIT 1";
            $path = getSingleValue($img_path_sql);
            $data .= '<div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <a href="products.php?pid=' . $result["id"] . '"><img class="card-img-top" src="' . $path . '" alt="' . $result["weight_in_grams"] . '"></a>
                        <div class="card-body">
                            <ul class="list-group" >
                                <li class="list-group-item">Weight: <span class="badge badge-primary">'.$result["weight_in_grams"].'</span> grams</li>
                                <li class="list-group-item">Price: <span class="badge badge-success">'.$total_amount.'</span> CHF</li>
                            </ul>
                            <div class="d-flex justify-content-between text-right" style="float: right;margin-top:10px;">
                                <div class="btn-group">
                                    <a href="products.php?pid=' . $result["id"] . '" class="btn btn-sm btn-outline-secondary">View</a>
                                    <a href="orders.php?add_new=' . $result["id"] . '" class="btn btn-sm btn-outline-primary">Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
    return $data;
}

function __images($id)
{
    $sql = "select path from " . DB_NAME . ".album where parent_id=" . $id;
    $rows = getFetchArray($sql);
    if ($rows != null) {
        $data = "";
        foreach ($rows as $result) {
            $data .= '<a href="' . $result['path'] . '" style="width:10%;padding:1%;margin:1%;" data-lightbox="example-set" data-title="next">
                <img style="width:10%;" class="img-thumbnail" src="' . $result['path'] . '" alt=""/></a>';
        }
        return $data;
    } else {
        return "";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo MAIN_TITLE; ?> - Products</title>
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
    <link rel="stylesheet" href="vendor/lightbox2/dist/css/lightbox.min.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php echo sidebar(); ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                                </ol>
                            </nav>
                        </h6>
                        
                    </div>
                    <main role="main">
                        <div class="album py-5 bg-light">
                            <div class="container">
                                <!-- row started -->
                                <div class="row">
                                    <!-- product types -->
                                    <?php echo display_images($type_id); ?>
                                    <!-- end product types -->
                                </div>
                                <!-- row ended -->
                            </div>
                    </main>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo MAIN_TITLE; ?> 2024</span><br>
                        <span>Designed by <a href="https://saransolutions.ch/">Saran Solutions</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <?php logout_modal()?>


    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="vendor/lightbox2/dist/js/lightbox-plus-jquery.min.js"></script>

</body>

</html>

<?php
?>