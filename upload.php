<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // 사용자 입력 데이터
    $AWS_ACCESS_KEY_ID = $_POST['AWS_ACCESS_KEY_ID'];
    $AWS_SECRET_ACCESS_KEY = $_POST['AWS_SECRET_ACCESS_KEY'];
    $REGION = $_POST['REGION'];
    $BUCKET_NAME = $_POST['BUCKET_NAME'];

    // 업로드된 파일 정보
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $filePath = $file['tmp_name'];

    try {
        // S3 클라이언트 설정
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => $REGION,
            'credentials' => [
                'key'    => $AWS_ACCESS_KEY_ID,
                'secret' => $AWS_SECRET_ACCESS_KEY,
            ],
        ]);

        // S3에 파일 업로드
        $result = $s3->putObject([
            'Bucket' => $BUCKET_NAME,
            'Key'    => $fileName,
            'SourceFile' => $filePath,
            'ACL'    => 'public-read',  // 파일을 공개적으로 접근 가능하도록 설정
        ]);

        // 업로드 성공 메시지 출력
        echo "<h3>파일 업로드 성공!</h3>";
        echo "<p>파일 URL: <a href='" . $result['ObjectURL'] . "' target='_blank'>" . $result['ObjectURL'] . "</a></p>";
    } catch (AwsException $e) {
        echo "<h3>업로드 실패!</h3>";
        echo "<p>오류 메시지: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<h3>파일이 선택되지 않았습니다.</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>AWS S3 파일 업로드</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<header class="bg-primary text-white text-center py-3">
  <div class="container">
    <h1>AWS S3 파일 업로드</h1>
  </div>
</header>

<div class="container mt-5">
  <h2 class="text-center">AWS S3 업로드 설정</h2>
  <form action="s3_upload.php" method="post" enctype="multipart/form-data" class="mt-4">
    <div class="mb-3">
      <label for="AWS_ACCESS_KEY_ID" class="form-label">AWS_ACCESS_KEY_ID:</label>
      <input type="text" id="AWS_ACCESS_KEY_ID" name="AWS_ACCESS_KEY_ID" class="form-control"
             required>
    </div>
    <div class="mb-3">
      <label for="AWS_SECRET_ACCESS_KEY" class="form-label">AWS_SECRET_ACCESS_KEY:</label>
      <input type="text" id="AWS_SECRET_ACCESS_KEY" name="AWS_SECRET_ACCESS_KEY"
             class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="REGION" class="form-label">REGION:</label>
      <input type="text" id="REGION" name="REGION" class="form-control" required
             placeholder="예: ap-northeast-2">
    </div>
    <div class="mb-3">
      <label for="BUCKET_NAME" class="form-label">BUCKET_NAME:</label>
      <input type="text" id="BUCKET_NAME" name="BUCKET_NAME" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="file" class="form-label">업로드할 파일 선택:</label>
      <input type="file" id="file" name="file" class="form-control" required>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">업로드</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
