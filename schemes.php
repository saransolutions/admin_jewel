<?php
session_start();
require_once 'includes/cons.php';
require_once 'includes/db.php';
$module = "scheme";
$page = get_page_info($module);
require_once 'includes/webpage.php';
require_once 'includes/pdf_page.php';
require_once 'includes/'.$module.'/remove.php';
require_once 'includes/'.$module.'/select.php';
require_once 'includes/'.$module.'/update.php';
require_once 'includes/'.$module.'/body.php';
checkUserLoggedIn();
if (isset($_GET["add_photo_id"])) {
    require_once 'includes/album/insert/step1.php';
    $id = $_GET["add_photo_id"];
    echo add_photo_form($id);
}elseif (isset($_GET["export"])) {
    require_once 'includes/report/report.php';
    export_report($_GET["export"], $_GET["type"]);
}elseif (isset($_POST["add-new-customer"])) {
    require_once 'includes/'.$module.'/insert.php';
    insert_customer($_POST, $page);
    header('Location: ' . $page["php"]);
} elseif (isset($_POST["add_photo_customer"])) {
    require_once 'includes/album/insert/step1.php';
    upload_photo($_POST, $_FILES);
    header('Location: ' . $page["php"]);
} elseif (isset($_GET["export_id"])) {
    require_once __DIR__ . '/vendor/autoload.php';
    export($_GET["export_id"]);
} elseif (isset($_GET["invoice_id"])) {
    require_once __DIR__ . '/vendor/autoload.php';
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
}elseif (isset($_GET["edit_id"])) {
    require_once 'includes/'.$module.'/edit.php';
    echo edit_form($_GET["edit_id"]);
}elseif (isset($_POST["update_project"])) {
    require_once 'includes/'.$module.'/edit.php';
    edit_project($_POST);
    header('Location: ' . $page["php"]);
}elseif (isset($_GET["remove_id"])) {
    $id = $_GET["remove_id"];
    echo get_remove_form($id);
} elseif (isset($_GET["id"])) {
    require_once 'includes/'.$module.'/body_single.php';
    get_single_page($_GET["id"], $page);
} elseif (isset($_POST["remove-customer-form"])) {
    remove_project($_POST);
    header('Location: ' . $page["php"]);
}else {
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php echo get_head($page) ?>
    <?php echo get_body() ?>
    </html>
<?php } ?>