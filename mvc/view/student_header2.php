<?php //session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Thêm Font Awesome cho biểu tượng -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
body {
  margin: 0;
  font-family: 'Arial', sans-serif;
}

.navbar {
  overflow: hidden;
  background: linear-gradient(90deg, #770DAB, #ff6f61);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  width: 100%;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
}

.nav {
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  transition: background-color 0.3s;
}

.navbar a:hover {
  background: #ddd;
  color: black;
}

.navbar p {
  float: right;
  font-size: 1rem;
  padding-right: 1rem;
  margin: 0;
  font-weight: bold; /* Để in đậm tên người dùng */
}

.main {
  padding: 16px;
  margin-top: 60px;
}
</style>

<title>Student Page</title>
</head>
<body>

<div class="navbar">
  <div class="nav">
    <!-- Biểu tượng sinh viên và tên người dùng -->
    <p>
      <i class="fas fa-user-graduate"></i> <?php echo $_SESSION['uname']; ?>
    </p>
    <center>Online Examination System - Student</center>
  </div>
</div>

</body>
</html>
