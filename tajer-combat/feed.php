<?php
session_start();

$servername = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT p.content, p.media_url, p.created_at, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        .card img {
            max-width: 100%;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Feed</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                if ($row['media_url']) {
                    echo "<img src='" . htmlspecialchars($row['media_url']) . "' alt='Post Media'>";
                }
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($row['username']) . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($row['content']) . "</p>";
                echo "<p class='card-text'><small class='text-muted'>Posted on " . $row['created_at'] . "</small></p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No posts found.</p>";
        }
        $conn->close();
        ?>
    </div>
    <footer class="magic-footer">
        <a href="chat.html" class="nav-item">
            <i class="fa fa-envelope"></i>
            <span>الرسائل</span>
        <a href="upload.php" class="nav-item">
            <i class="fa fa-upload"></i>
            <span>إضافة إعلان</span>
        </a>
       
        </a> <a href="center.php" class="nav-item">
            <i class="fa fa-home"></i>
            <span>الرئيسية</span>
        </a>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
