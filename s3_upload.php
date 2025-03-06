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
            'SourceFile' => $filePath
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