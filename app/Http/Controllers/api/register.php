<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gypem"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["message" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['tingkat_pendidikan'], $data['provinsi'], $data['kabupaten_kota'], $data['nama_sekolah_universitas'], $data['name'], $data['tanggal_lahir'], $data['no_telpon'], $data['username'], $data['email'], $data['password'])) {
    echo json_encode(["message" => "Data tidak lengkap"]);
    exit;
}

$tingkat_pendidikan = $conn->real_escape_string($data['tingkat_pendidikan']);
$provinsi = $conn->real_escape_string($data['provinsi']);
$kabupaten_kota = $conn->real_escape_string($data['kabupaten_kota']);
$nama_sekolah_universitas = $conn->real_escape_string($data['nama_sekolah_universitas']);
$name = $conn->real_escape_string($data['name']);
$tanggal_lahir = $conn->real_escape_string($data['tanggal_lahir']);
$no_telpon = $conn->real_escape_string($data['no_telpon']);
$username = $conn->real_escape_string($data['username']);
$email = $conn->real_escape_string($data['email']);
$password = password_hash($conn->real_escape_string($data['password']), PASSWORD_BCRYPT);

$sql = "INSERT INTO users (tingkat_pendidikan, provinsi, kabupaten_kota, nama_sekolah_universitas, name, tanggal_lahir, no_telpon, username, email, password, created_at, updated_at) 
        VALUES ('$tingkat_pendidikan', '$provinsi', '$kabupaten_kota', '$nama_sekolah_universitas', '$name', '$tanggal_lahir', '$no_telpon', '$username', '$email', '$password', NOW(), NOW())";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Registrasi berhasil"]);
} else {
    echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
