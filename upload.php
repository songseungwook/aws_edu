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
