<?php 
include '../controller/admin_session.php';
include '../../config.php';
$q = "SELECT * FROM `student`";
$result = mysqli_query($con, $q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students</title>
    <style type="text/css">
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 40px auto; /* Tạo khoảng cách trên */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #770DAB;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #C37BE7;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e1bee7; /* Hiệu ứng hover cho hàng */
        }
        .button {
            background-color: #770DAB;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 20px auto; /* Tự động căn giữa */
        }
        .button:hover {
            background-color: #C079E4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Student Status</h2>
        <form action="../controller/delete_student_nav.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rows = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $rows[1]; ?></td>
                        <td><?php echo $rows[2]; ?></td>
                        <td>
                            <input type="radio" name="status[<?php echo $rows[1]; ?>]" value="present" <?php if ($rows[3] == "present") echo "checked"; ?>> Present
                            <br>
                            <input type="radio" name="status[<?php echo $rows[1]; ?>]" value="absent" <?php if ($rows[3] == "absent") echo "checked"; ?>> Absent
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <button class="button" name="delete">Delete All</button>
        </form>
    </div>
</body>
</html>
