<?php
// Ubah pengaturan ini sesuai database di komputer/server kamu.
$host = 'localhost';
$dbname = 'tanyain';
$dbuser = 'root';
$dbpass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Koneksi database gagal. Periksa pengaturan di config.php.');
}

if (session_status() === PHP_SESSION_NONE) session_start();
