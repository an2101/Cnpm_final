<?php
session_start();
require_once '../../config.php';
require_once '../model/admin_checklogin.php';

class AdminController {
    private $adminModel;

    public function __construct($dbConnection) {
        $this->adminModel = new AdminModel($dbConnection);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['user'];
            $pass = $_POST['pass'];

            // Kiểm tra thông tin đăng nhập
            $result = $this->adminModel->authenticate($name, $pass);
            $num = $result->num_rows;

            if ($num == 1) {
                // Lấy thông tin user
                $userDetails = $this->adminModel->getUserDetails($name);
                $_SESSION['uname'] = $userDetails[1]; // Lưu tên người dùng
                $_SESSION['admin'] = $name;

                // Điều hướng tới trang admin
                header('location:../view/admin_page.php');
            } else {
                // Điều hướng về trang đăng nhập
                header('location:../view/admin_login.php');
            }
        }
    }
}

// Khởi tạo controller và xử lý yêu cầu
$controller = new AdminController($con);
$controller->login();
