<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost";
$dbname = "login_db";
$username = "root"; // اسم المستخدم الافتراضي للـ phpMyAdmin
$password = ""; // كلمة المرور الافتراضية

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_pass')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful!";
    header("Location: center.php");
    exit(); // تأكد من إنهاء تنفيذ السكربت بعد التحويل
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>