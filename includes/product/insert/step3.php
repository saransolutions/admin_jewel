<?php
function step3($data, $page)
{
    $step1 = unserialize($data["step1"]);
    $word = str_replace("_", " ", $step1["product_type"]);
    $word = ucfirst($word);
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
                                    <a class="nav-item nav-link" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-text mt-4">
                                            <div class="wizard-step-text-name">Step <span class="badge badge-light">2 </span></div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 4-->
                                    <a class="nav-item nav-link active" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
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

                                        <?php echo step3_form($data, $step1); ?>

                                    </div>
                                </div>
                            </div>

                            <!-- start of cart -->
                            <div class="col-sm">
                                <?php echo step3_cart($word, $data, $step1); ?>
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


function step3_cart($word, $data, $step1)
{
    $product_type = $step1["product_type"];
    $metal_type = $step1["metal_type"];
    $purity = $step1["purity"];
    $weight_in_grams = $data["weight_in_grams"];
    $size = $data["size"];
    $gender = $data["gender"];
    $collection = $data["collection"];
    $stone_type = $data["stone_type"];
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
                    <small class="text-muted">New <?php echo $word; ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Metal Type</h6>
                    <small class="text-muted"><?php echo ucfirst($metal_type); ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Purity</h6>
                    <small class="text-muted"><?php echo ucfirst($purity); ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Weight</h6>
                    <small class="text-muted"><?php echo ucfirst($weight_in_grams); ?> grams</small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <div>
                    <h6 class="my-0">Others</h6>
                    <small class="text-muted"><?php echo ucfirst($gender) . ' - ' . ucfirst($size) . ' in Size - ' . ucfirst($collection); ?></small>
                </div>
            </li>
            <li class="list-group-item d-flex">
                <a href="products.php" class="btn btn-secondary btn-sm" onclick="return confirm('Are you sure?')" name="cancel_project">Cancel</a>
            </li>
        </ul>
    </div>
<?php
}

function step3_form($data, $input)
{
    $purity = $input["purity"];
    $metal_type = $input["metal_type"];
    $weight_in_grams = $data["weight_in_grams"];
    $today_rate = get_rate($purity, $metal_type);
    $purchase_amount = $today_rate * $weight_in_grams;
?>
    <script type="text/javascript">
        $(function() {
            $("#calc_total").on('click', function(e) {
                e.preventDefault();
                let num1 = $('#purchase_amount').val();
                let num2 = $('#purchase_expense').val();
                let num3 = $('#making_charges').val();
                let total = Number(num1) + Number(num2) + Number(num3);
                $('#total_amount').val(total);
            })
        });
    </script>
    <form method="post" action="products.php" enctype="multipart/form-data">
        <input type="hidden" name="step1" value="<?php echo htmlentities(serialize($input)) ?>" />
        <input type="hidden" name="step2" value="<?php echo htmlentities(serialize($data)) ?>" />
        <div class="container">
            <div class="row mt-1">
                <div class="col-md-7"><label for="gold_rate">Today Gold Rate <short>(for gram)</short> *</label>
                    <input type="number" step="0.01" class="form-control" id="gold_rate" name="gold_rate" value="<?php echo $today_rate; ?>" required="">
                    <div class="invalid-feedback">Invalid Gold Rate *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-7"><label for="purchase_amount">Product Price *</label>
                    <input type="number" step="0.01" class="form-control" id="purchase_amount" name="purchase_amount" value="<?php echo $purchase_amount; ?>" required="">
                    <div class="invalid-feedback">Invalid Product Price *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-7"><label for="making_charges">Making Charges </label>
                    <input type="number" step="0.01" class="form-control" id="making_charges" name="making_charges">
                    <div class="invalid-feedback">Invalid Making Charges *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-7"><label for="purchase_expense">Purchase Expense </label>
                    <input type="number" step="0.01" class="form-control" id="purchase_expense" name="purchase_expense">
                    <div class="invalid-feedback">Invalid Purchase Expense *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-7">
                    <div class="form-row align-items-end">
                        <div class="form-group col">
                            <label for="label1">Total Amount *</label>
                            <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required="">
                        </div>
                        <div class="form-group col-auto">
                            <button class="btn btn-light" id="calc_total" title="calculate total"><i class="fas fa-fw fa-check"></i></button>
                        </div>
                    </div>
                    <div class="invalid-feedback">Invalid Total Amount *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-7"><label for="purchase_cost">Supplier </label>
                    <select class="form-control" id="supplier" name="supplier">
                        <option></option>
                        <option value="20">M.R.K Jewellery</option>
                        <option>M.S.P Jewellery</option>
                    </select>
                    <div class="invalid-feedback">Invalid Purchase Cost *</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12"><label for="image">Image </label>
                    <input type="file" class="form-control-file" id="image" name="photo1" accept=".jpg, .jpeg, .png">
                    <div class="invalid-feedback">Invalid Image *</div>
                </div>
            </div>
            <input type="submit" name="new_product" onclick="return confirm('Are you sure?')" class="btn btn-primary float-right"></input>
        </div>
    </form>
<?php
}

function insert_product($data, $files, $page)
{
    $step1 = unserialize($data["step1"]);
    $product_type_id = $step1["type_id"];
    $metal_type = $step1["metal_type"];
    $purity = $step1["purity"];

    $step2 = unserialize($data["step2"]);
    $weight_in_grams = $step2["weight_in_grams"];
    $size = $step2["size"];
    $gender = $step2["gender"];
    $collection = $step2["collection"];
    $stone_type = $step2["stone_type"];

    $gold_rate = $data["gold_rate"];
    $purchase_expense = $data["purchase_expense"];
    $purchase_amount = $data["purchase_amount"];
    $making_charges = $data["making_charges"];
    $total_amount = $data["total_amount"];
    $supplier = $data["supplier"];

    $sql = "INSERT INTO " . DB_NAME . ".products
    (id, metal_type, purity, weight_in_grams, size_range, gender, collection, stone_type, created_date, product_type_id, today_gold_rate, purchase_expense, purchase_amount, supplier_id, comments, making_charges, in_stock, total_amount)
    VALUES (null,'" . $metal_type . "'," . checkSNull($purity) . ",'" . $weight_in_grams . "','" . $size . "','" . $gender . "','" . $collection . "','" . $stone_type . "',CURRENT_TIMESTAMP(), " . $product_type_id . " , " . $gold_rate . ", " . checkSNull($purchase_expense) . ", " . $purchase_amount . ", '" . checkSNull($supplier) . "', NULL, " . checkSNull($making_charges) . ", 'yes', $total_amount)";
    echo $sql;
    executeSQL($sql);
    $product_id = getSingleValue("select max(id) from " . DB_NAME . ".products");
    if ($product_id != null) {
        upload_photo($product_id, $files);
    }
    $file = QR_CODES_PROD_DIR."/product_".$product_id."_".uniqid().".png";
    $text = $page["php"]."?pid=" . $product_id;
    $image_path = generate_qr_code($file, $text);
    executeSQL("update " . DB_NAME . ".products set qr_image_path = '" . $image_path . "' where id = " . $product_id);
    return $product_id;
}

function upload_photo($id, $files)
{
    if ($id != null) {
        $dir = ALBUM_PATH . '/' . $id;
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
            echo "directory is created";
        }
        $path = $dir . "/" . $files["photo1"]["name"];
        if (move_uploaded_file($files["photo1"]["tmp_name"], $path)) {
            $sql = "INSERT INTO " . DB_NAME . ".album (id, added_date, parent_id, path) VALUES (NULL, current_timestamp(), '" . $id . "', '" . $path . "');";
            executeSQL($sql);
        }
    }
    return false;
}
?>