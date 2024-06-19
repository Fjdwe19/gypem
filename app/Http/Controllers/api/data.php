<?php
require 'config.php';

try {
    // Prepare and execute the SQL statement to fetch all records
    $stmt = $pdo->query("SELECT id, tingkat_pendidikan, provinsi, kabupaten_kota, nama_sekolah_universitas, name, tanggal_lahir, no_telpon, username, email, email_verified_at, created_at, updated_at FROM users"); // Make sure 'users' is the correct table name

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the records as JSON
    header('Content-Type: application/json');
    echo json_encode($users);
} catch (PDOException $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
