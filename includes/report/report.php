<?php

function run_report($input, $type)
{
    $part1 = '
    <table class="table table-bordered" cellspacing="0" width="100%" id="dataTable" cellspacing="0">
    <thead>
        <tr>
            <th class="w-auto p-1">S.No</th>
            <th>Product</th>
            <th>Metal Type</th>
            <th>Purity</th>
            <th>Product Type</th>
            <th>Weight</th>
            <th>Gold Rate</th>
            <th>Product Price</th>
            <th>Making Charges</th>
            <th>Purchase Expenses</th>
            <th>Total</th>
            <th>In Stock</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        ';
    $sql = 'SELECT * FROM ' . DB_NAME . '.products WHERE';
    if ($type == "year") {
        $sql .= " date_format(created_date, '%Y') = " . $input;
    } elseif ($type == "month") {
        $sql .= " date_format(created_date, '%Y-%m') = '" . $input . "'";
    } else {
        $sql .= " created_date = '" . $input . "'";
    }

    $rows = getFetchArray($sql);
    if ($rows == null) {
        return;
    }
    $data = '';
    $count = 1;
    foreach ($rows as $result) {
        $id = $result['id'];
        $metal_type = $result['metal_type'];
        $product_type = getSingleValue("select name from " . DB_NAME . ".product_types where id=" . $result['product_type_id']);
        $purity = $result['purity'];
        $weight_in_grams = $result['weight_in_grams'];
        $size_range = $result['size_range'];
        $gender = $result['gender'];
        $collection = $result['collection'];
        $stone_type = $result['stone_type'];
        $created_date = $result['created_date'];

        $in_stock = $result['in_stock'];

        $gold_rate = $result['today_gold_rate'];
        $making_charges = $result['making_charges'];
        $purchase_expense = $result['purchase_expense'];
        $purchase_amount = $result['purchase_amount'];
        $supplier = $result['supplier_id'];
        $total_amount = $result['total_amount'];

        $qr_image_path = $result['qr_image_path'];

        $data = $data . '<tr>
            <td class="w-auto p-1">' . $count . '</td>
			<td><a href="projects.php?pid=' . $id . '">' . $metal_type . ' > ' . $product_type . '>' . $id . '</a></td>
            <td>' . $metal_type . '</td>
            <td>' . $purity . '</td>
            <td>' . $product_type . '</td>
            <td>' . $weight_in_grams . '</td>
            <td>' . $gold_rate . '</td>
            <td>' . $purchase_amount . '</td>
            <td>' . $making_charges . '</td>
            <td>' . $purchase_expense . '</td>
            <td>' . $total_amount . '</td>
            <td>' . $in_stock . '</td>
            <td>' . $created_date . '</td>
		</tr>';
        $count = $count + 1;
    }
    $part3 = '
    </tbody>
</table>';
    return $part1 . $data . $part3;
}

function report_form($data, $value, $type)
{
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo MAIN_TITLE; ?> - Reports</title>
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
                        <!-- start form + cart -->
                        <div class="row" style="padding:10px;">
                            <div class="col-md-6 col-lg-3">
                                <div class="card text-center">
                                    <div class="card-body">

                                        <form action="products.php" method="POST">
                                            <?php if ($type == "month") {
                                                echo '<h1>Monthly Report</h1>';
                                                echo '<div class="form-group">
                                                    <label for="month">Select Month</label>
                                                    <input type="hidden" name="type" value="month">
                                                    <input type="month" value="' . $value . '" class="form-control" id="input_value" name="input_value" aria-describedby="monthHelp" placeholder="Select Month">
                                                </div>';
                                            } else {
                                                echo '<h1>Yearly Report</h1>';
                                                echo '<div class="form-group">
                                                    <label for="month">Select Year</label>
                                                    <input type="hidden" name="type" value="year">
                                                    <select class="form-select form-select-lg mb-3" name="input_value">
                                                        <option value="2024" selected>2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                    </select>
                                                </div>';
                                            } ?>
                                            <button type="submit" name="report" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of form + cart -->
                        <?php echo $data; ?>
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

function export_report_excel($input, $type)
{
    // Start the output buffer.
    ob_start();

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=Monthly_report_' . $input . '.csv');
    ob_end_clean();
    $output = fopen('php://output', 'w');

    $headers = "id, metal_type, purity, weight_in_grams, size_range, gender, collection, stone_type, created_date, product_type_id, today_gold_rate, purchase_expense, purchase_amount, supplier_id, comments, making_charges, in_stock, qr_image_path, total_amount";
    $header_array = explode(",", $headers);
    $csv_header_array = array();
    foreach ($header_array as $row) {
        $csv_header_array[] = str_replace("_", " ", strtoupper($row));
    }

    $sql = 'SELECT ' . $headers . ' FROM ' . DB_NAME . '.products WHERE';
    if ($type == "year") {
        $sql .= " date_format(created_date, '%Y') = " . $input;
    } elseif ($type == "month") {
        $sql .= " date_format(created_date, '%Y-%m') = '" . $input . "'";
    } else {
        $sql .= " created_date = '" . $input . "'";
    }

    $conn = getDBConnection();
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        fputcsv($output, $csv_header_array);
    }
    foreach ($result as $row) {
        $row = array_map("utf8_decode", $row);
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}

function export_report_pdf($input, $type)
{
    require_once MPDF_REPO;

    $headers = "id, metal_type, purity, weight_in_grams, (select name from product_types where id = p.product_type_id)product_type, today_gold_rate, purchase_amount, in_stock, total_amount";
    $sql = 'SELECT ' . $headers . ' FROM ' . DB_NAME . '.products p WHERE';
    
    if ($type == "year") {
        $sql .= " date_format(created_date, '%Y') = " . $input;
    } elseif ($type == "month") {
        $sql .= " date_format(created_date, '%Y-%m') = '" . $input . "'";
    } else {
        $sql .= " created_date = '" . $input . "'";
    }

    $conn = getDBConnection();
    $result = mysqli_query($conn, $sql);
    $part1 = pdf_head() . '
        <body>
        ' . pdf_block(1) . '
        <br>
        <table lass="items" width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top:5%;margin-bottom:5%;" cellpadding="8">
            <thead>
<tr>
                <th style="border: 1px solid gray;">Id</th>
                <th style="border: 1px solid gray;">Metal</th>
                <th style="border: 1px solid gray;">Purity</th>
                <th style="border: 1px solid gray;">Product</th>
                <th style="border: 1px solid gray;">Weight</th>
                <th style="border: 1px solid gray;">Rate</th>
                <th style="border: 1px solid gray;">Price</th>
                <th style="border: 1px solid gray;">Total</th>
                <th style="border: 1px solid gray;">In</th>
</tr>
</thead>';
    $part2 = '';
    foreach ($result as $row){
        $part2 .= '<tr>
                <td style="border: 1px solid gray;">'.$row["id"].'</td>
                <td style="border: 1px solid gray;">'.$row["metal_type"].'</td>
                <td style="border: 1px solid gray;">'.$row["purity"].'</td>
                <td style="border: 1px solid gray;">'.$row["product_type"].'</td>
                <td style="border: 1px solid gray;">'.$row["weight_in_grams"].'</td>
                <td style="border: 1px solid gray;">'.$row["today_gold_rate"].'</td>
                <td style="border: 1px solid gray;">'.$row["purchase_amount"].'</td>
                <td style="border: 1px solid gray;">'.$row["total_amount"].'</td>
                <td style="border: 1px solid gray;">'.$row["in_stock"].'</td>
            </tr>';
        
    }
    $part2 .= '</table>';
    $content = $part1.$part2;
    
    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 20,
        'margin_right' => 15,
        'margin_top' => 48,
        'margin_bottom' => 25,
        'margin_header' => 10,
        'margin_footer' => 10
    ]);

    $mpdf->SetProtection(array('print'));
    $mpdf->SetAuthor("author");
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($content);
    $file_name = "SJ-Products-00"  . "_" . date("d-m-Y") . ".pdf";
    $mpdf->Output($file_name, "I");
}
?>