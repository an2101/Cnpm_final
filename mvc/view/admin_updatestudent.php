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
    <title>Update Student Status</title>
    <style type="text/css">
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 40px auto; /* Tăng khoảng cách trên để tránh bị che bởi footer */
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
            background-color: #e1bee7;
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
        }
        .button:hover {
            background-color: #C079E4;
        }
        footer {
            margin-top: 40px; /* Đảm bảo có khoảng cách dưới cùng */
            text-align: center;
            padding: 20px 0;
            background-color: #770DAB;
            color: white;
            position: relative; /* Có thể chỉnh sửa nếu cần thiết */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Student Status</h2>
    <form action="../controller/admin_update_nav.php" method="post">
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
                $myarrray = [];
                while ($rows = mysqli_fetch_array($result)) {
                    $ar = $rows[1];
                    $_SESSION['usn'] = $rows[1];
                    $myarrray[] = $ar;
                ?>
                <tr>
                    <td><?php echo $rows[1]; ?></td>
                    <td><?php echo $rows[2]; ?></td>
                    <td>
                        <input type="radio" value="present" name="status[<?php echo $rows[1]; ?>]" <?php if ($rows[3] == "present") echo "checked"; ?>> Present
                        <br>
                        <input type="radio" value="absent" name="status[<?php echo $rows[1]; ?>]" <?php if ($rows[3] == "absent") echo "checked"; ?>> Absent
                    </td>
                </tr>
                <?php
                $_SESSION['name'] = $myarrray;
                }
                ?>
            </tbody>
        </table>
        <div style="text-align: center;">
            <button class="button" name="submit">Update</button>
        </div>
    </form>
</div>



</body>
</html>
