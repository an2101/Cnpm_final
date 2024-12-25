<?php

session_start();
include '../../config.php'; // Kết nối cơ sở dữ liệu
include '../model/admin_update.php'; // Include Model

if (isset($_POST['submit'])) {
    $status = $_POST['status'];
    $ar = $_SESSION['name'];

    // Khởi tạo đối tượng StudentModel
    $studentModel = new StudentModel($con);

    // Cập nhật trạng thái từng sinh viên
    foreach ($ar as $usn) {
        $state = $status[$usn];
        $studentModel->updateStudentStatus($usn, $state);
    }

    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Student details updated');
        window.location.href='../view/admin_updatestudent.php';
    </script>");
}
?>
