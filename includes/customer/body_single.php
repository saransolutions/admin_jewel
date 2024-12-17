<?php
function display_images($id){
    $sql="select * from ".DB_NAME.".album where parent_id = ".$id;
    $rows = getFetchArray($sql);
    if ($rows != null){
        $data = "";
        foreach ($rows as $result) {
            $data .= '<a href="'.$result['path'].'" style="width:10%;padding:1%;margin:1%;" data-lightbox="example-set" data-title="next">
                <img style="width:10%;" class="img-thumbnail" src="'.$result['path'].'" alt=""/></a>';
        }
        return "<div>".$data."</div>";
    }
    return "";
}

function get_single_page($id, $page)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo MAIN_TITLE." - ".$page["title"];?></title>
        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="vendor/lightbox2/dist/css/lightbox.min.css">
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#pay_button,#edit_button,#remove_button,#export_button,#invoice_button").click(function() {
                    var value = $(this).attr("value")
                    var button_name = $(this).attr("name")
                    if (button_name == "export") {
                        var win = window.open("projects.php?export_id=" + value + "", "_blank");
                        if (win) {
                            win.focus();
                        } else {
                            alert("Please allow popups for this website");
                        }
                    }
                    if (button_name == "invoice") {
                        var win = window.open("projects.php?invoice_id=" + value + "", "_blank");
                        if (win) {
                            win.focus();
                        } else {
                            alert("Please allow popups for this website");
                        }
                    }
                    if (button_name == "edit") {
                        $.ajax({
                            type: "GET",
                            url: "projects.php",
                            data: {
                                "edit_id": value
                            },
                            success: function(data) {
                                $("#edit_body").html(data);
                            }
                        });
                    }
                    if (button_name == "pay") {
                        $.ajax({
                            type: "GET",
                            url: "projects.php",
                            data: {
                                "pay_id": value
                            },
                            success: function(data) {
                                $("#pay_body").html(data);
                            }
                        });
                    }
                    if (button_name == "remove") {
                        $.ajax({
                            type: "GET",
                            url: "projects.php",
                            data: {
                                "remove_id": value
                            },
                            success: function(data) {
                                $("#remove_body").html(data);
                            }
                        });
                    }
                });
            });
        </script>

    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- start of sidebar -->
            <?php echo sidebar(); ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php echo top_bar(); ?>
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Content Row -->
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-lg-3">
                            </div>
                            <!-- Second Column -->
                            <div class="col-lg-6">
                                <!-- Background Gradient Utilities -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                    <li class="breadcrumb-item"><a href="products.php"></a><?php echo $page["title"]; ?></li>
                                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $id; ?></li>
                                                </ol>
                                            </nav>
                                        </h6>
                                        <h6 class="m-0 font-weight-bold text-primary text-right">
                                            <!--<a href="projects.php?add_new" class="btn btn-success btn-sm" >Hinzufügen</a>-->
                                            <button type="button" class="btn btn-secondary btn-sm" value="<?php echo $id; ?>" name="edit" id="edit_button" data-toggle="modal" data-target="#edit_modal">Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm" value="<?php echo $id; ?>" name="remove" id="remove_button" data-toggle="modal" data-target="#remove_modal">Remove</button>
                                            
                                            <!--<button type="button" class="btn btn-warning btn-sm" name="reports" data-toggle="modal" data-target="#reports_form_modal">Reports</button>-->
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <?php echo get_single($id, $page); ?>
                                    </div>
                                </div>
                                <!-- album -->
                                <?php echo display_images($id);?>
                                <!-- album -->
                            </div>
                            <!-- Third Column -->
                            <div class="col-lg-3">
                            </div>
                        </div>
                        <!-- end of row-->
                    </div>
                    <!-- /.container-fluid -->
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php echo get_footer(); ?>
                <!-- End of Footer -->

                
                <?php echo reports_form(); ?>

                <!-- Edit Modal -->
                <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit_modalLabel">Edit Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="edit_body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Edit Modal -->
                <!-- Pay Modal -->
                <div class="modal fade" id="pay_modal" tabindex="-1" role="dialog" aria-labelledby="pay_modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pay_modalLabel">Pay Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="pay_body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                                <h5 class="modal-title" id="remove_modalLabel">Remove Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="remove_body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Remove Modal -->

                <!-- invoice Modal -->
                <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="invoiceModalLabel">Select language</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <a class="btn btn-primary btn-sm" href="projects.php?lang=de&invoice_id=<?php echo $id; ?>" target="_blank" role="button">Deutsch</a>
                            <a class="btn btn-secondary btn-sm" href="projects.php?lang=fr&invoice_id=<?php echo $id; ?>" target="_blank" role="button">French</a>
                            <a class="btn btn-warning btn-sm" href="projects.php?lang=en&invoice_id=<?php echo $id; ?>" target="_blank" role="button">English</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of invoice Modal -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Logout Modal-->
        <?php echo logout_modal(); ?>
        <!-- End of Logout Modal-->


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
}
?>