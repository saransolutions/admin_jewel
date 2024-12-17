<?php
session_start();

require_once 'includes/cons.php';
require_once 'includes/db.php';
$module = "product";
$page = get_page_info($module);
require_once 'includes/webpage.php';
require_once 'includes/pdf_page.php';
require_once 'includes/' . $module . '/remove.php';
require_once 'includes/' . $module . '/select.php';
require_once 'includes/' . $module . '/update.php';
require_once 'includes/' . $module . '/page/body.php';



checkUserLoggedIn();

if (isset($_GET["add_new"])) {
    require_once 'includes/product/insert/step1.php';
    echo step1($page);
} elseif (isset($_POST["update_rates"])) {
    require_once 'includes/product/insert/update_todays_rate.php';
    update_todays_rate($_POST);
    header('Location: ' . $page["php"] . "?dashboard");
} elseif (isset($_GET["add_photo_id"])) {
    require_once 'includes/album/insert/step1.php';
    $id = $_GET["add_photo_id"];
    echo add_photo_form($id);
} elseif (isset($_POST["action"]) && $_POST["action"] == "step2") {
    require_once 'includes/product/insert/step2.php';
    step2($_POST, $page);
} elseif (isset($_POST["step3"])) {
    require_once 'includes/product/insert/step3.php';
    echo step3($_POST, $page);
} elseif (isset($_GET["mreport_form"])) {
    require_once 'includes/report/report.php';
    report_form(null, null, "month");
} elseif (isset($_GET["yreport_form"])) {
    require_once 'includes/report/report.php';
    report_form(null, null, "year");
} elseif (isset($_GET["export"])) {
    require_once 'includes/report/report.php';
    if ($_GET["as"] == "excel"){export_report_excel($_GET["export"], $_GET["type"]);}
    else{export_report_pdf($_GET["export"], $_GET["type"]);}
    
} elseif (isset($_POST["report"])) {
    require_once 'includes/report/report.php';
    $input = $_POST["input_value"];
    $type = $_POST["type"];
    $data = run_report($input, $type);
    if ($data != null) {
        $button = '<a class="btn btn-danger ml-1 float-right" href="products.php?type=' . $type . '&export=' . $input . '&as=excel" role="button">Export as Excel</a>
        <a class="btn btn-primary float-right" href="products.php?type=' . $type . '&export=' . $input . '&as=pdf" role="button">Export as PDF</a>';
        report_form($button . " " . $data, $input, $type);
    } else {
        $button = '<div class="alert alert-danger" role="alert">
                        No records found - ' . $input . '
                    </div>';
        report_form($button . " " . $data, $input, $type);
    }
} elseif (isset($_GET["gallery"])) {
    require_once 'includes/album/select/view.php';
} elseif (isset($_GET["by_type_id"])) {
    require_once 'includes/product/select/by_type.php';
} elseif (isset($_GET["dashboard"])) {
    require_once 'includes/product/select/dashboard.php';
} elseif (isset($_POST["step4"])) {
    require_once 'includes/product/insert/step5.php';
    echo step5($_POST);
} elseif (isset($_POST["new_product"])) {
    require_once 'includes/product/insert/step3.php';
    insert_product($_POST, $_FILES, $page);
    header('Location: ' . $page["php"]);
} elseif (isset($_POST["add_photo_project"])) {
    require_once 'includes/album/insert/step1.php';
    upload_photo($_POST, $_FILES);
    header('Location: ' . $page["php"]);
} elseif (isset($_GET["export_id"])) {
    require_once MPDF_REPO;
    export($_GET["export_id"]);
} elseif (isset($_GET["invoice_id"])) {
    require_once MPDF_REPO;
    $id = $_GET["invoice_id"];
    $lang = $_GET["lang"];
    $content = invoice($id, $lang);

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
    $file_name = "SJ-00" . $id . "_" . date("d-m-Y") . ".pdf";
    $mpdf->Output($file_name, "I");
} elseif (isset($_GET["letter_pad"])) {
    require_once MPDF_REPO;
    $content = letter_pad(123);
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
    $file_name = "letter-pad" . "_" . date("d-m-Y") . ".pdf";
    $mpdf->Output($file_name, "I");
} elseif (isset($_GET["pay_id"])) {
    echo get_pay_form($_GET["pay_id"]);
} elseif (isset($_GET["edit_id"])) {
    require_once 'includes/product/edit.php';
    echo edit_form($_GET["edit_id"]);
} elseif (isset($_POST["update_project"])) {
    require_once 'includes/product/edit.php';
    edit_project($_POST);
    header('Location: ' . $page_php);
} elseif (isset($_POST["pay_project_form"])) {
    pay_project($_POST);
    header('Location: ' . $page_php);
} elseif (isset($_GET["remove_id"])) {
    $id = $_GET["remove_id"];
    echo get_remove_form($id);
} elseif (isset($_GET["pid"])) {
    require_once 'includes/' . $module . '/page/body_single.php';
    get_single_page($_GET["pid"]);
} elseif (isset($_POST["remove-product-form"])) {
    remove_project($_POST);
    header('Location: ' . $page_php);
} elseif (isset($_GET["get_invoice_lang"])) {
    $id = $_GET['get_invoice_lang'];
    echo '
    <a class="btn btn-primary btn-sm" href="projects.php?lang=de&invoice_id=' . $id . '" target="_blank" role="button">Deutsch</a>
    <a class="btn btn-secondary btn-sm" href="projects.php?lang=fr&invoice_id=' . $id . '" target="_blank" role="button">Französisch</a>
    ';
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php get_head($page); ?>
    <?php get_body(); ?>

    </html>
<?php } ?>