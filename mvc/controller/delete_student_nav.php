<?php

include '../controller/admin_session.php'; // Kiểm tra session admin
include '../../config.php'; // Kết nối cơ sở dữ liệu
include '../model/delete_student.php'; // Include model

// Khởi tạo đối tượng StudentModel
$studentModel = new StudentModel($con);

// Gọi phương thức xóa dữ liệu
$result = $studentModel->truncateStudentTable();

if ($result) {
    echo "<script>alert('All data has been deleted successfully.'); window.location.href='../view/admin_students.php';</script>";
} else {
    echo "<script>alert('Error when deleting data: " . mysqli_error($con) . "'); window.location.href='../view/admin_students.php';</script>";
}

mysqli_close($con);
?>
