<?php
session_start();
require_once 'includes/cons.php';
require_once 'includes/db.php';
$page = get_page_info("order");
require_once 'includes/webpage.php';
require_once 'includes/pdf_page.php';
checkUserLoggedIn();
require_once 'includes/'.$page["module"].'/remove.php';
require_once 'includes/'.$page["module"].'/select.php';
require_once 'includes/'.$page["module"].'/update.php';
require_once 'includes/'.$page["module"].'/body.php';
require_once 'includes/'.$page["module"].'/body_single.php';

if (isset($_GET["action"]) && "new" == $_GET["action"]) {
    $action = $_GET["action"];
    $id = $_GET["id"];
    $total = $_GET["total"];
    require_once 'includes/'.$page["module"].'/insert/step1.php';
    step1($id, $total, $page);
}elseif (isset($_GET["action"]) && "step2" == $_GET["action"]) {
    $action = $_GET["action"];
    require_once 'includes/'.$page["module"].'/insert/step2.php';
    step2($_GET, $page);
}elseif (isset($_POST["action"]) && "step3" == $_POST["action"]) {
    require_once 'includes/'.$page["module"].'/insert/step3.php';
    $order_id = create_order($_POST, $page);
    if ($order_id != null){
        header('Location: ' . $page["php"]);
    }else{
        echo "Order creation failed";
    }
}elseif (isset($_GET["add_photo_id"])) {
    require_once 'includes/album/insert/step1.php';
    $id = $_GET["add_photo_id"];
    echo add_photo_form($id);
} elseif (isset($_GET["mreport_form"])) {
    require_once 'includes/report/report.php';
    report_form(null, null, "month");
} elseif (isset($_GET["yreport_form"])) {
    require_once 'includes/report/report.php';
    report_form(null, null, "year");
} elseif (isset($_GET["export"])) {
    require_once 'includes/report/report.php';
    export_report($_GET["export"], $_GET["type"]);
} elseif (isset($_POST["report"])) {
    require_once 'includes/report/report.php';
    $input = $_POST["input_value"];
    $type = $_POST["type"];
    $data = run_report($input, $type);
    if ($data != null) {
        $button = '<a class="btn btn-danger float-right" href="projects.php?type='.$type.'&export=' . $input . '" role="button">Export</a>';
        report_form($button . " " . $data, $input, $type);
    } else {
        $button = '<div class="alert alert-danger" role="alert">
                        No records found - ' . $input . '
                    </div>';
        report_form($button . " " . $data, $input, $type);
    }
}elseif (isset($_GET["gallery"])) {
    require_once 'includes/album/select/view.php';
}elseif (isset($_GET["by_type_id"])) {
    require_once 'includes/album/select/by_type.php';
}elseif (isset($_GET["dashboard"])) {
    require_once 'includes/album/select/dashboard.php';
}elseif (isset($_POST["new_product"])) {
    require_once 'includes/'.$page["module"].'/insert/step3.php';
    insert_product($_POST, $_FILES);
    header('Location: ' . $page_php);
} elseif (isset($_POST["add_photo_project"])) {
    require_once 'includes/album/insert/step1.php';
    upload_photo($_POST, $_FILES);
    header('Location: ' . $page_php);
} elseif (isset($_GET["export_id"])) {
    require_once __DIR__ . '/vendor/autoload.php';
    export($_GET["export_id"]);
} elseif (isset($_GET["invoice_id"])) {
    
    $id = $_GET["invoice_id"];
    $lang = $_GET["lang"];
    $content = invoice($id, $lang);

    require_once MPDF_REPO;
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
    $file_name = "SJ" . "_" . date("d-m-Y") . ".pdf";
    $mpdf->Output($file_name, "I");
} elseif (isset($_GET["pay_id"])) {
    echo get_pay_form($_GET["pay_id"]);
} elseif (isset($_GET["edit_id"])) {
    require_once 'includes/'.$page["module"].'/edit.php';
    echo edit_form($_GET["edit_id"]);
} elseif (isset($_POST["update_project"])) {
    require_once 'includes/'.$page["module"].'/edit.php';
    edit_project($_POST);
    header('Location: ' . $page_php);
} elseif (isset($_POST["pay_project_form"])) {
    pay_project($_POST);
    header('Location: ' . $page_php);
} elseif (isset($_GET["remove_id"])) {
    $id = $_GET["remove_id"];
    echo get_remove_form($id);
} elseif (isset($_GET["pid"])) {
    require_once 'includes/'.$page["module"].'/body_single.php';
    get_single_page($_GET["pid"]);
} elseif (isset($_POST["remove-product-form"])) {
    remove_project($_POST);
    header('Location: ' . $page_php);
}elseif (isset($_GET["get_invoice_lang"])) {
    $id = $_GET['get_invoice_lang'];
    echo '
    <a class="btn btn-primary btn-sm" href="orders.php?lang=de&invoice_id=' . $id . '" target="_blank" role="button">Deutsch</a>
    <a class="btn btn-secondary btn-sm" href="orders.php?lang=fr&invoice_id=' . $id . '" target="_blank" role="button">Französisch</a>
    ';
}elseif (isset($_GET["id"])) {
    $id = $_GET["id"];
    get_single_page($id);
}else {
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php echo get_head($page) ?>
    <?php echo get_body() ?>

    </html>
<?php } ?>