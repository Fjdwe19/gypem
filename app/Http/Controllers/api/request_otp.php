<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'])) {
    $email = $data['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $otp = rand(100000, 999999); // Generate OTP
        // Save OTP to the database or send it to the user's email
        // ...
        echo json_encode(['message' => 'OTP telah dikirim ke email Anda']);
    } else {
        echo json_encode(['message' => 'Email tidak ditemukan']);
    }
} else {
    echo json_encode(['message' => 'Data tidak lengkap']);
}
?>
