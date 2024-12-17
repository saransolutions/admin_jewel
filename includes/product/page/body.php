<?php

function js_scripts(){
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


function get_body()
{
?>

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
                        <?php echo main_content(); ?>
                        <!-- main content -->
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <?php echo get_footer(); ?>
                
                <?php echo reports_form(); ?>

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
        <?php logout_modal(); ?>
        <?php update_rates_modal(); ?>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>
    </body>
<?php
}

function main_content()
{
?>
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="text-right">
                <!-- <button type="button" class="btn btn-success btn-sm"
                    name="add_new" data-toggle="modal"
                    data-target="#add_new_modal">
                </button> -->
                <!--<a href="projects.php?add_new" class="btn btn-success btn-sm" >Hinzufügen</a>-->
                <button type="button" class="btn btn-secondary btn-sm" name="edit" id="edit_button" data-toggle="modal" data-target="#edit_modal">Bearbeiten</button>
                <button type="button" class="btn btn-dark btn-sm" name="pay" id="pay_button" data-toggle="modal" data-target="#pay_modal">Zahlen</button>
                <button type="button" class="btn btn-danger btn-sm" name="remove" id="remove_button" data-toggle="modal" data-target="#remove_modal">Löschung</button>
                <!--<button type="button" class="btn btn-primary btn-sm" name="export" id="export_button">Export</button>-->
                <!--<button type="button" class="btn btn-warning btn-sm" name="invoice" id="invoice_button">Invoice</button>-->
                <button type="button" class="btn btn-primary btn-sm" name="invoice" id="invoice_button" data-toggle="modal" data-target="#invoice_modal">Rechnung</button>
                <button type="button" class="btn btn-warning btn-sm" name="add_photo" id="add_photo_button" data-toggle="modal" data-target="#add_photo_modal">Add Photo</button>
                <!--<a href="projects.php?letter_pad" target="_blank" class="btn btn-success btn-sm" >Letter pad</a>-->
                <!--<button type="button" class="btn btn-warning btn-sm" name="reports" data-toggle="modal" data-target="#reports_form_modal">Beichte</button>-->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php echo get_main_table(); ?>
            </div>
        </div>
    </div>
<?php
}
