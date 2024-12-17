<?php
session_start();
require_once 'includes/cons.php';
require_once 'includes/db.php';
require_once "includes/login/page.php";
$errMsg = null;
$page = "login";
$page_title = "Login";
$profile = array();
$profile["page-title"] = $page_title;
$profile["page"] = $page;
echo login($profile);
