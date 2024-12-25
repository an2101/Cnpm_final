<?php
    // Kiểm tra nếu chưa chọn tệp CSV
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_FILES['question_file']['name'])) {
            $message = "Select a file to upload."; // Thông báo nếu không có tệp
        } else {
            // Logic upload file ở đây
            // Nếu upload thành công
            $message = "Upload successful!"; // Thông báo thành công
        }
    }

    // Hiển thị thông báo
    if (isset($message)) {
        echo "<div class='message show'>$message</div>"; // Hiển thị thông báo
    }
    ?>