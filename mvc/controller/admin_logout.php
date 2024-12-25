<?php
session_start();

class AuthController {
    public function logout() {
        // Hủy session
        session_destroy();

        // Hiển thị thông báo và chuyển hướng
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('You have successfully logged out');
            window.location.href='../view/admin_login.php';
            </script>");
    }
}

// Khởi tạo đối tượng và gọi phương thức logout
$authController = new AuthController();
$authController->logout();
