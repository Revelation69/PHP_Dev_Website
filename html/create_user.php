<?php
include('functions.php');

if (!isLoggedIn() || !isAdmin()) {
    $_SESSION['msg'] = "You must log in as admin first";
    header('location: login.php');
}

if (isset($_POST['register_btn'])) {
    register();
}
?>