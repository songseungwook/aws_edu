<!DOCTYPE html>
<html>
<head>
  <title>MariaDB 연결 테스트</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="bg-primary text-white text-center py-3">
  <div class="container">
    <a href="/">
<!--      <img src="https://static.toastoven.net/toast/resources/img/logo_nhn_cloud_color.svg" class="img-fluid" alt="Logo" />-->
    </a>
  </div>
</header>

<div class="container mt-5">
  <h1 class="display-4 text-center">MariaDB 연결 테스트</h1>
  <h6 class="text-center text-muted">MariaDB 접속 정보를 입력하고 연결을 확인하세요</h6>

  <form action="" method="post" class="mt-4">
    <div class="mb-3">
      <label for="DB_HOST" class="form-label">DB IP:</label>
      <input type="text" id="DB_HOST" name="DB_HOST" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="DB_PORT" class="form-label">DB Port:</label>
      <input type="text" id="DB_PORT" name="DB_PORT" class="form-control" required placeholder="3306">
    </div>
    <div class="mb-3">
      <label for="DB_USER" class="form-label">DB User:</label>
      <input type="text" id="DB_USER" name="DB_USER" class="form-control" required placeholder="root">
    </div>
    <div class="mb-3">
      <label for="DB_PASS" class="form-label">DB Password:</label>
      <input type="password" id="DB_PASS" name="DB_PASS" class="form-control" required placeholder="root">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">연결 테스트</button>
    </div>
  </form>

  <div class="mt-4 text-center">
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $host = $_POST['DB_HOST'];
          $port = $_POST['DB_PORT'];
          $user = $_POST['DB_USER'];
          $pass = $_POST['DB_PASS'];

          $dsn = "mysql:host=$host;port=$port";
          try {
              $pdo = new PDO($dsn, $user, $pass);
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              echo '<div class="alert alert-success">MariaDB 연결 성공!</div>';
          } catch (PDOException $e) {
              echo '<div class="alert alert-danger">연결 실패: ' . htmlspecialchars($e->getMessage()) . '</div>';
          }
      }
      ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
