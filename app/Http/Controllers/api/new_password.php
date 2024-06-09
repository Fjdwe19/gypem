<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'], $data['new_password'])) {
    $email = $data['email'];
    $new_password = password_hash($data['new_password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    if ($stmt->execute([$new_password, $email])) {
        echo json_encode(['message' => 'Password berhasil diperbarui']);
    } else {
        echo json_encode(['message' => 'Gagal memperbarui password']);
    }
} else {
    echo json_encode(['message' => 'Data tidak lengkap']);
}
?>
