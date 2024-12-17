<?php

function display_images()
{
    $sql = "select max(parent_id) as 'parent_id' from " . DB_NAME . ".album group by parent_id";
    $rows = getFetchArray($sql);
    if ($rows != null) {
        $data = "";
        foreach ($rows as $result) {
            $name_sql="select product_type_id from ".DB_NAME.".products where id=".$result["parent_id"];
            
            $product_type_id = getSingleValue($name_sql);
            $type_name = getSingleValue("select name from ".DB_NAME.".product_types where id=".$product_type_id);
            $data .= '<li class="list-group-item">
                <a target="_blank" href="#">'.$type_name.'</a>'.__images($result["parent_id"]).'
            </li>';
        }
        return '
<div class="card" style="width: 38rem;">
  <div class="card-header">
    Images
  </div>
  <ul class="list-group list-group-flush">
    '.$data.'
  </ul>
</div>';
    }
    return "";
}

function __images($id){
    $sql = "select path from " . DB_NAME . ".album where parent_id=".$id;
    $rows = getFetchArray($sql);
    if ($rows != null) {
        $data="";
        foreach ($rows as $result) {
            $data .= '<a href="'.$result['path'].'" style="width:10%;padding:1%;margin:1%;" data-lightbox="example-set" data-title="next">
                <img style="width:10%;" class="img-thumbnail" src="'.$result['path'].'" alt=""/></a>';
        }
        return $data;
    }else{
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
    <title><?php echo MAIN_TITLE; ?> - Gallery</title>
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
        <?php echo sidebar();?>
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
                    <!-- Page Heading -->
                    <!-- Default Action buttons -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <!--free left space-->
                        </div>

                    </div>
                    <!-- End Action buttons -->
                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <?php echo display_images(); ?>
                        </div>
                    </div>
                    <!-- main content -->
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

            <!-- Add New Modal -->
            <div class="modal fade" id="reports_form_modal" tabindex="-1" role="dialog" aria-labelledby="reports_form_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reports_form_modalLabel">Reports</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="reports_modal">
                            <div class=" row justify-content-center">
                                <div class="col-md-8 order-md-1">
                                    <form method="post" action="projects.php">
                                        <span class="badge badge-pill badge-primary">Yearly Report</span>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <l6abel for="report_month">Select Year *</l6abel>
                                                <input type="number" class="form-control" id="report_year" name="report_year" required="" placeholder="select year" min="2024" max="2030">
                                                <div class="invalid-feedback">Invalid Year *</div>
                                            </div>
                                        </div>
                                        <span class="badge badge-pill badge-success">Monthly Report</span>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="report_month">Select Month *</label>
                                                <input type="month" class="form-control" id="report_month" name="report_month" required="">
                                                <div class="invalid-feedback">Invalid Execution Date *</div>
                                            </div>
                                        </div>
                                        <span class="badge badge-pill badge-danger">Daily Report</span>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="report_date">Select Date *</label>
                                                <input type="date" class="form-control" id="report_date" name="report_date" required="">
                                                <div class="invalid-feedback">Invalid Execution Date *</div>
                                                <button type="submit" name="run_report" class="btn btn-primary float-right">Submit</button>
                                            </div>
                                        </div>
                                        <button type="submit" name="run_report" class="btn btn-primary float-right">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Add New Modal -->


            <!-- Edit Modal -->
            <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_modalLabel">Bearbeiten</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="edit_body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Edit Modal -->

            <!-- invoice Modal -->
            <div class="modal fade" id="invoice_modal" tabindex="-1" role="dialog" aria-labelledby="invoice_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="invoice_modalLabel">Wahlen die Sprache</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="invoice_body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of invoice Modal -->

            <!-- Pay Modal -->
            <div class="modal fade" id="pay_modal" tabindex="-1" role="dialog" aria-labelledby="pay_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pay_modalLabel">Zahlen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="pay_body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Pay Modal -->
            <!-- Remove Modal -->
            <div class="modal fade" id="remove_modal" tabindex="-1" role="dialog" aria-labelledby="remove_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="remove_modalLabel">Entfernen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="remove_body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Remove Modal -->

            <!-- Photo Modal -->
            <div class="modal fade" id="add_photo_modal" tabindex="-1" role="dialog" aria-labelledby="add_photo_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_photo_modalLabel">Album</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="add_photo_body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Pay Modal -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bereit zum Aufbruch?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Wählen Sie unten „Abmelden“, wenn Sie Ihre aktuelle Sitzung beenden möchten.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php?logoff">Abmelden</a>
                </div>
            </div>
        </div>
    </div>


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