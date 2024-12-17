<?php
session_start();
if(isset($_GET['logoff']))
{
    // Delete certain session
    unset($_SESSION['user']);
    // Delete all session variables
    // session_destroy();
    session_destroy();
    // Jump to login page
    header('Location: login.php?logged_out');
}elseif(!isset($_SESSION['user'])){
    header('Location: login.php');
}else{
    header('Location: products.php');
}
?>
