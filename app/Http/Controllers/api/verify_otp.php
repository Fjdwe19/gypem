<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'], $data['otp'])) {
    $email = $data['email'];
    $otp = $data['otp'];

    $stmt = $pdo->prepare("SELECT * FROM otps WHERE email = ? AND otp = ?");
    $stmt->execute([$email, $otp]);
    $otp_valid = $stmt->fetch();

    if ($otp_valid) {
        echo json_encode(['message' => 'OTP valid']);
    } else {
        echo json_encode(['message' => 'OTP tidak valid']);
    }
} else {
    echo json_encode(['message' => 'Data tidak lengkap']);
}
?>
