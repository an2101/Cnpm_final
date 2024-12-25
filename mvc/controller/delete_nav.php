<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../view/admin_login.php');
    exit();
}

include '../../config.php';
include '../model/delete.php'; // Include model

// Lấy quiz_type từ GET
$quizType = isset($_GET['quiz_type']) ? $_GET['quiz_type'] : 'result'; // Mặc định là bảng 'result'

// Kiểm tra quiz_type hợp lệ và tương ứng với bảng cần xóa
$validQuizTypes = ['result', 'result2', 'result3']; // Các bảng hợp lệ cho quiz_type
if (in_array($quizType, $validQuizTypes)) {
    // Khởi tạo đối tượng QuizModel và gọi phương thức truncate
    $quizModel = new QuizModel($con);
    $result = $quizModel->truncateQuizResults($quizType);

    if ($result) {
        echo "<script>alert('All quiz results have been successfully deleted.'); window.location.href='../view/admin_result.php?quiz_type=$quizType';</script>";
    } else {
        echo "<script>alert('Error when deleting results: '); window.location.href='../view/admin_result.php?quiz_type=$quizType';</script>";
    }
} else {
    echo "<script>alert('Quiz type is not valid.'); window.location.href='../view/admin_result.php';</script>";
}

mysqli_close($con);
?>
