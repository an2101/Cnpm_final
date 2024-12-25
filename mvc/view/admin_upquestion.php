<?php 
include '../controller/admin_session.php';
include '../../config.php';
include '../model/admin_checkquestion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Questions</title>
    <style type="text/css">
        html, body {
            height: 100%; 
            margin: 0; 
            background-color: #e0e0e0; 
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Thay đổi align-items thành flex-start */
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            background-color: #fff; 
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            padding: 2rem; 
            width: 400px; 
            text-align: center;
            margin-top: 50px; /* Điều chỉnh khoảng cách từ trên xuống */
        }
        .form-container h2 {
            color: #770DAB; 
            margin-bottom: 1rem; 
        }
        .form-container .select-message {
            color: #d9534f; /* Màu đỏ nhạt cho thông báo */
            margin-bottom: 1rem; 
            font-weight: bold; 
        }
        .form-container input[type="file"] {
            border: 2px dashed #770DAB; 
            padding: 20px; 
            border-radius: 8px; 
            width: calc(100% - 16px); 
            cursor: pointer; 
            margin-bottom: 1.5rem; 
            box-sizing: border-box; 
        }
        .form-container input[type="text"],
        .form-container input[type="number"] {
            margin-bottom: 0.3rem; /* Thêm khoảng cách phía dưới */
        }
        .button {
            background-color: #770DAB; 
            color: white; 
            border: none; 
            width: 100%; 
            height: 2.5rem; 
            border-radius: 8px; 
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s; 
            margin-top: 5px;
        }
        .button:hover {
            background-color: #C079E4; 
        }
        .message {
            margin-top: 1rem; 
            color: red; 
            padding: 10px; 
            border: 1px solid #770DAB; 
            border-radius: 8px; 
            background-color: #f8d7da; 
            display: none; 
            animation: fadeIn 0.5s ease; /* Thêm hoạt ảnh fadeIn */
        }
        
        .message.show {
            display: block; 
        }

        /* Định nghĩa hoạt ảnh fadeIn */
        @keyframes fadeIn {
            from {
                opacity: 0; 
                transform: translateY(-10px); /* Đưa hộp thông báo lên trên */
            }
            to {
                opacity: 1; 
                transform: translateY(0); /* Về vị trí ban đầu */
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Upload Questions</h2>
    <div class="select-message"><u>Select Only CSV files</u></div>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="question_file" accept=".csv">   

        <select name="table_choice">
            <option value="q2">Save to Quiz 1</option>
            <option value="q3">Save to Quiz 2</option>
            <option value="q4">Save to Quiz 3</option>
        </select>

        <!-- Thêm trường nhập code và thời gian -->
        <input type="text" name="quiz_code" placeholder="Enter Quiz Code" required>
        <input type="number" name="quiz_time" placeholder="Enter Time (minutes)" required>

        <input type="submit" class="button" name="upload" value="Upload">
    </form>

    <?php
    // Hiển thị thông báo ở đây
    if (isset($message)) {
        echo "<div class='message show'>$message</div>"; // Hiển thị thông báo
    }
    ?>
</div>

</body>
</html>
