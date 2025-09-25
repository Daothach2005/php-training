<?php
require_once 'csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        die("CSRF token không hợp lệ!");
    }

    // csrf.php đã start session rồi, không cần gọi lại
    session_destroy();

    // Điều hướng về login
    header("Location: login.php");
    exit;
}
