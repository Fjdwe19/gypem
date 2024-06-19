<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'])) {
    $email = $data['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $otp = rand(100000, 999999); // Generate OTP
        // Simpan OTP ke database atau kirim ke email pengguna
        // Contoh simpan ke database:
        $stmt = $pdo->prepare("INSERT INTO otps (email, otp) VALUES (?, ?)");
        $stmt->execute([$email, $otp]);
        
        // Kirim OTP ke email (implementasi tergantung pada sistem email Anda)
        // mail($email, "OTP Anda", "OTP: $otp");
        
        echo json_encode(['message' => 'OTP telah dikirim ke email Anda']);
    } else {
        echo json_encode(['message' => 'Email tidak ditemukan']);
    }
} else {
    echo json_encode(['message' => 'Data tidak lengkap']);
}
?>
