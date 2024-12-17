<?php
function step2($data, $page)
{
    $product_type = $data["product_type"];
    $sql = "select id from ".DB_NAME.".product_types where name = '".$product_type."'";
    $type_id = getSingleValue($sql);
    $purity = null;
    if (isset($data["purity"])){$purity = $data["purity"];}
    
    $metal_type = $data["metal_type"];
    
    $word = str_replace("_", " ", $product_type);
    $word = ucfirst($word);
    $input = [];
    $input["type_id"] = $type_id;
    $input["product_type"] = $product_type;
    $input["purity"] = $purity;
    $input["metal_type"] = $metal_type;
    $input["word"] = $word;

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
                            <div class="col-sm">
                            </div>
                            <div class="col-sm">
                                <div class="card">
                                    <div class="card-body">
                                        <h1>New <?php echo $word; ?></h1>
                                            <?php echo step2_form($input); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- start of cart -->
                            <div class="col-sm">
                                <?php echo step2_cart($input); ?>
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

        <?php echo logout_modal() ?>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <?php echo js_scripts() ?>
    </body>
<?php
}


function step2_cart($input)
{
?>
    <div class="col-md-9 col-lg-6 order-md-last">
        <h4 class="">
            <span class="text-primary">Your cart</span>
            <span class="badge badge-dark bg-primary rounded-pill">1</span>
        </h4>
        <ul class="list-group">
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Product Type</h6>
                    <small class="text-muted">New <?php echo $input["word"]; ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Metal Type</h6>
                    <small class="text-muted"> <?php echo ucfirst($input["metal_type"]); ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Purity</h6>
                    <small class="text-muted"><?php echo ucfirst($input["purity"]); ?></small>
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
    <form method="post" action="products.php" enctype="multipart/form-data">
        <input type="hidden" name="step1" value="<?php echo htmlentities(serialize($data))?>" />
        <div class="container">
            <div class="row mt-1">
                <div class="col-md-6"><label for="square_meters">Weight in Grams *</label>
                    <input type="number" step="0.01" class="form-control" id="weight_in_grams" name="weight_in_grams" required="">
                    <div class="invalid-feedback">Invalid Weight Grams *</div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-6">
                    <label for="floors">Size *</label>
                    <select class="form-control" id="size" name="size" required="">
                        <option>Short</option>
                        <option>Long</option>
                        <option>Medium</option>
                    </select>
                    <div class="invalid-feedback">Invalid Size *</div>
                </div>
            </div>
            
            <div class="row mt-1">
                <div class="col-md-6"><label for="Gender">Gender *</label>
                    <select class="form-control" id="Gender" name="gender" required="">
                        <option>Women</option>
                        <option>Men</option>
                        <option>Boy</option>
                        <option>Girl</option>
                    </select>
                    <div class="invalid-feedback">Invalid Gender *</div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-6"><label for="collection">Collection *</label>
                    <select class="form-control" id="collection" name="collection" required="">
                        <option>Fancy</option>
                        <option>Classic</option>
                        <option>Functional</option>
                        <option>Office</option>
                    </select>
                    <div class="invalid-feedback">Invalid Collection *</div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-6"><label for="stone_type">Stone Type *</label>
                    <select class="form-control" id="stone_type" name="stone_type" required="">
                        <option>Plain</option>
                        <option>Modern</option>
                    </select>
                    <div class="invalid-feedback">Invalid Stone Type *</div>
                </div>
            </div>
            <button type="submit" name="step3" class="btn btn-primary float-right">Next</button>
        </div>
    </form>
<?php
}
?>