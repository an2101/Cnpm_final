<?php 
include '../controller/admin_session.php';
include '../../config.php';
include '../model/admin_checkstudent.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Upload Student Data</title>
	<style type="text/css">
        /* CSS tổng quát */
        html, body {
            height: 100%; 
            margin: 0; 
            display: flex;
            justify-content: center;
            align-items: flex-start;
            font-family: Arial, sans-serif;
        }
        
        /* Khung chứa form */
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            width: 400px;
            text-align: center;
            margin-top: 50px;
            transition: all 0.3s;
        }
        
        .form-container h2 {
            color: #5a2d82; 
            margin-bottom: 1rem;
        }

        .select-message {
            color: #d9534f;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        /* Ô chọn file */
        .form-container input[type="file"] {
            border: 2px dashed #770DAB; 
            padding: 20px; 
            border-radius: 8px; 
            width: calc(100% - 16px); 
            cursor: pointer; 
            margin-bottom: 1.5rem; 
            box-sizing: border-box; 
        }

        .form-container input[type="file"]:hover {
            background-color: #f8f0fb;
        }

        /* Nút upload */
        .button {
            background-color: #5a2d82;
            color: white;
            border: none;
            width: 100%;
            height: 2.5rem;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #7c4bb8;
        }

        /* Hiển thị thông báo */
        .message {
            margin-top: 1rem;
            color: #721c24;
            padding: 10px;
            border: 1px solid #d9534f;
            border-radius: 8px;
            background-color: #f8d7da;
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .message.show {
            display: block;
        }

        /* Hoạt ảnh fadeIn */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
	</style>
</head>
<body>

<div class="form-container">
    <h2>Upload Student Data</h2>
    <div class="select-message"><u>Select Only CSV files</u></div>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="question_file" accept=".csv"> <!-- Xóa required -->
        <input type="submit" class="button" name="upload" value="Upload">
    </form>
    <?php
    include '../controller/admin_checkstudent_nav.php';
    ?>
</div>

</body>
</html>
