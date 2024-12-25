<?php 
session_start(); 

if (!isset($_SESSION['usn'])) {
    header('location:../../index.php');
}
?>

<?php include('student_header2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Code of Conduct</title>
    <style type="text/css">
        body {
            background-color: #f5f5f5; /* Nền trang sáng */
            font-family: Arial, sans-serif; /* Phông chữ thân thiện */
            margin: 0; /* Xóa margin mặc định */
            padding: 20px; /* Thêm khoảng cách bên trong */
        }

        .container {
            max-width: 800px; /* Đặt chiều rộng tối đa cho khối chính */
            margin: 40px auto; /* Căn giữa khối chính */
            background-color: #fff; /* Màu nền trắng cho khối chính */
            border-radius: 10px; /* Bo tròn các góc */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng */
            padding: 30px; /* Thêm padding cho khối chính */
        }

        h3 {
            text-align: center; /* Căn giữa tiêu đề */
            color: #770DAB; /* Màu chữ cho tiêu đề */
            margin-bottom: 20px; /* Khoảng cách dưới tiêu đề */
        }

        h4 {
            margin: 10px 0; /* Khoảng cách cho tiêu đề phụ */
        }

        .warning {
            color: red; /* Màu đỏ cho cảnh báo */
        }

        .terms {
            margin: 20px 0; /* Khoảng cách cho phần điều khoản */
            text-align: left; /* Căn trái cho điều khoản */
        }

        .button {
            background-color: #770DAB; /* Màu nền nút */
            color: white; /* Màu chữ nút */
            border: none; /* Không viền cho nút */
            border-radius: 5px; /* Bo tròn các góc của nút */
            padding: 10px 20px; /* Thêm padding cho nút */
            font-size: 16px; /* Kích thước chữ */
            cursor: pointer; /* Hiệu ứng con trỏ */
            display: block; /* Hiển thị nút dưới dạng khối */
            margin: 20px auto; /* Căn giữa nút */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
        }

        .button:hover {
            background-color: #C079E4; /* Màu nền khi hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="student_exam.php" id="submited" method="post">
            <h3><u>Code Of Conduct</u></h3>

            <div class="terms">
                <h4>(a) You are only allowed to take the exam once and within a limited time.</h4>
                <?php //echo $_SESSION['time_value']?>
                <h4 class="warning">(b) Warning: Do not try to access another tab or window, it will auto-submit the examination.</h4>
                <br>
                <input type="checkbox" name="accept_terms" required> I accept the terms and conditions.
            </div>

            <input type="submit" id="btn1" name="submit" class="button" value="Submit">
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
