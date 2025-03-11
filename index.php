<?php
// 현재 시각을 'Y-m-d H:i:s' 형식으로 가져옴
$timestamp = date('Y-m-d H:i:s');

// 로그 파일 경로
$logFile = '/var/www/html/logs/debug.log';

// 로그 메시지
$logMessage = "현재시간 : [$timestamp] " . PHP_EOL;

// 로그 파일에 기록 (추가 모드)
file_put_contents($logFile, $logMessage, FILE_APPEND);
?>
<!DOCTYPE html>
<html>
<head>
    <title>웹 서버 IP 주소 확인</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <div class="container">
            <a href="/">
<!--                <img src="https://static.toastoven.net/toast/resources/img/logo_nhn_cloud_color.svg" class="img-fluid" alt="Logo" />-->
              saltlux
            </a>
        </div>
    </header>

    <div class="container mt-5 text-center">
        <h1 class="display-4">현재 웹 서버의 IP 주소</h1>
        <p class="lead"><?php echo $_SERVER['SERVER_ADDR']; ?></p>
        <div class="btn-group mt-4" role="group">
            <button class="btn btn-secondary" onclick="location.href='db_connect.php.php'">DB Connect</button>
            <button class="btn btn-primary" onclick="location.href='stress.php'">Stress Test</button>
            <button class="btn btn-secondary" onclick="location.href='upload.php'">S3 Upload</button>
        </div>
    </div>

    <!-- Link to Bootstrap JavaScript (Optional: Only required if you use Bootstrap JavaScript components) -->
    <!-- Add this script tag at the end of the body section -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>