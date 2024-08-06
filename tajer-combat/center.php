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

// استرجاع جميع المنشورات
$sql = "SELECT posts.id, posts.content, posts.media_url, posts.created_at, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.id DESC";
$result = $conn->query($sql);

$posts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تاجر براحتك</title>
    <link rel="stylesheet" href="styles2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            margin-top: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #007bff;
            color: white;
            padding: 10px;
        }
        .header .site-name {
            font-size: 24px;
        }
        .header .search-bar input {
            width: 100%;
        }
        .colored-bar {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            height: 10px;
            margin-bottom: 20px;
        }
        .post-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 20px;
        }
        .post-card img, .post-card video {
            max-width: 100%;
            height: auto;
        }
        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .post-footer button {
            background: transparent;
            border: none;
            color: #007bff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="site-name">تاجر براحتك</div>
            <div class="search-bar">
                <input type="text" class="form-control" placeholder="Search...">
            </div>
        </div>
        <div class="colored-bar"></div>
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <h5><?php echo htmlspecialchars($post['username']); ?></h5>
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                    <?php if (!empty($post['media_url'])): ?>
                        <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $post['media_url'])): ?>
                            <img src="<?php echo htmlspecialchars($post['media_url']); ?>" alt="Media">
                        <?php elseif (preg_match('/\.(mp4|webm|ogg)$/i', $post['media_url'])): ?>
                            <video controls>
                                <source src="<?php echo htmlspecialchars($post['media_url']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="post-footer">
                        <button>Like</button>
                        <button>Add to Favorites</button>
                        <span><?php echo htmlspecialchars(date('d M Y, H:i', strtotime($post['created_at']))); ?></span>
                        <span>Views: 123</span> <!-- Adjust as needed -->
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>لايوجد منشورات جديدة.</p>
        <?php endif; ?>
    </div>
    <footer class="magic-footer">
        <a href="chat.html" class="nav-item">
            <i class="fa fa-envelope"></i>
            <span>الرسائل</span>
        <a href="post.html" class="nav-item">
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
