<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من وجود بيانات النموذج والجلسة
if (!isset($_POST['content']) || !isset($_FILES['media']) || !isset($_SESSION['user_id'])) {
    die("Missing content, file, or user ID.");
}

$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

$media_url = "";
if (isset($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    
    // التحقق من وجود المجلد وإنشائه إذا لم يكن موجودًا
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $file_name = basename($_FILES['media']['name']);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['media']['tmp_name'], $target_file)) {
        $media_url = $target_file;
    } else {
        die("Failed to upload file.");
    }
}

$sql = "INSERT INTO posts (user_id, content, media_url) VALUES ('$user_id', '$content', '$media_url')";

if ($conn->query($sql) === TRUE) {
    // إعادة التوجيه إلى الصفحة center.php بعد النجاح
    header("Location: center.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
