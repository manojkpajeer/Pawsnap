<?php

    session_start();
    $_SESSION['user_id'] = "";
    $_SESSION['user_role'] = "";
    $_SESSION['user_email'] = "";
    $_SESSION['user_name'] = "";
    $_SESSION['is_billing_admin_login'] = false;

    unset($_SESSION['user_id']);
    unset($_SESSION['user_role']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['is_billing_admin_login']);

    echo "<script>location.href='../index.php';</script>";
?>