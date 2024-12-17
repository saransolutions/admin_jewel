<?php

function load_env()
{
	$env = file_get_contents(__DIR__ . "/../.env");
	$lines = explode("\n", $env);
	foreach ($lines as $line) {
		preg_match("/([^#]+)\=(.*)/", $line, $matches);
		if (isset($matches[2])) {
			putenv(trim($line));
		}
	}
}
define("MAIN_TITLE", "Saran Jewellery");
define("MAIN_LOGO_IMG", "logo.png");

define("MAIN_ACCOUNT_NUMBER", "CH86 0900 0000 1636 3866 5");
define("HEAD_ADDRESS_LINE_1", "Sportweg 27");
define("HEAD_ADDRESS_LINE_2", "3250 Lyss");
define("HEAD_ADDRESS_LINE_3", "saransolutions.ch");
define("HEAD_PHONE", "079 568 06 36 <br>079 568 06 36");
define("HEAD_MOBILE", " ");
define("HEAD_WED_ADDRESS", "info@saransolutions.ch");
define("HEAD_LOGO", "img/logo.png");
define("HEAD_UID", "CHE-45.7.949.122");
define("HEAD_FIRST_NAME", "Saran");
define("HEAD_LAST_NAME", "Solutions");

define("HEAD_PREFIX", "");
define("HEAD_LOGO_STYLE", "float:right;");
define("ALBUM_PATH", "./album");
define("QR_CODES_PROD_DIR", "./qr_codes/products");
define("QR_CODES_CUST_DIR", "./qr_codes/customers");

define("INITIAL_UMZUG_PACKAGE_AMOUNT", "500");
define("ERR_1_INVALID_DATE", "Error : Invalid date :(");
define("ERR_2_MORE_THAN_10_DAYS", "Error : Project duration is more than 10 days :(");
define("ERR_3_ALREADY_OCCUPIED", "Warning : Dates already occupied");

define("ORDER_INI_PAY_STATUS", "Unpaid");
define("ORDER_INI_DEL_STATUS", "Ordered");

define("FOOT_MSG", 'Rathusstr, 63,CH – 4410 LIESTAL, Tel: 061 272 23 01 Fax: 061 272 23 04 Mobile: 076 570 50 03
www.kayathri.ch info@kayathri.ch Credit Suisse IBAN: CH85 0483 5172 4580 6100 0');


define("PDF_FOOTER_SARAN_SOLUTIONS", '<div><p style="margin-left:70%;font-size: 8pt;">Developed By <font style="font-style:italic;text-decoration: underline;">www.saransolutions.in</font></p></div>');


function checkUserLoggedIn()
{
	if (!isset($_SESSION['user'])) {
		header("Location: login.php");
	} elseif (isset($_GET['logoff'])) {
		unset($_SESSION['user']);
		session_destroy();
		header('Location: login.php');
	}
}

function checkSNull($value)
{
	if ($value == null) {
		return "NULL";
	} else {
		return "'" . $value . "'";
	}
}

define("PDF_STYLE_TABLE_ITEMS", '
<style>
        table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
        </style>
');

load_env();
define("DB_NAME", getenv("DB_NAME"));
define("QR_REPO", getenv("COMPOSER_REPO") . "/qrcode/vendor/autoload.php");
define("MPDF_REPO", getenv("COMPOSER_REPO") . "/mpdf/vendor/autoload.php");

function generate_qr_code($file, $text){
    include 'phpqrcode/qrlib.php';
    $ecc = 'L';
    $pixel_Size = 10;
    $frame_Size = 10;
    QRcode::png($text, $file, $ecc, $pixel_Size, $frame_Size);
    return $file;
}

function get_page_info($module){
	$page = [];
	$page["module"] = $module;
	$with_s = $module."s";
	$page["table"] = DB_NAME.".".$with_s;
	$page["title"] = ucfirst($with_s);
	$page["php"] = $with_s.".php";
	return $page;
}

function get_total_amount($purity, $metal_type, $weight_in_grams, $purchase_expense){
	$today_rate = get_rate($purity, $metal_type);
    $net_amount = round($today_rate*$weight_in_grams);
	return round(($net_amount + $purchase_expense));
}