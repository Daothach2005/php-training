<?php
require_once 'csrf.php';
require_once 'models/UserModel.php';

$userModel = new UserModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        die("CSRF token không hợp lệ!");
    }

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $userModel->deleteUserById($id); // Delete user
        $_SESSION['message'] = 'User deleted successfully';
    }
}

header('Location: list_users.php');
exit;
