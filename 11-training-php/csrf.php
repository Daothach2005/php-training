<?php
// csrf.php
session_start();

/**
 * Tạo token CSRF
 */
function csrf_token()
{
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['_csrf_token_time'] = time();
    }
    return $_SESSION['_csrf_token'];
}

/**
 * Trả về input hidden
 */
function csrf_field()
{
    $token = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
    return "<input type=\"hidden\" name=\"_csrf_token\" value=\"{$token}\">";
}

/**
 * Xác minh token
 */
function csrf_verify()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['_csrf_token']) || empty($_SESSION['_csrf_token'])) {
            return false;
        }
        if (!hash_equals($_SESSION['_csrf_token'], $_POST['_csrf_token'])) {
            return false;
        }
    }
    return true;
}
