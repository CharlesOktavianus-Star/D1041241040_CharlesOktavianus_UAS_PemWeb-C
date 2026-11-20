<?php
require_once 'config.php';

function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function user() { return $_SESSION['user'] ?? null; }
function isDeveloper() { return user() && user()['role'] === 'developer'; }
function requireLogin() {
    if (!user()) { header('Location: login.php'); exit; }
}
function canManage($question) {
    return user() && (isDeveloper() || user()['id'] == $question['user_id']);
}
function go($url) { header("Location: $url"); exit; }
function csrfToken() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function checkCsrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
        (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf']))) {
        die('Permintaan tidak valid. Silakan kembali dan coba lagi.');
    }
}
function categoryList() {
    return ['Pemrograman', 'Matematika', 'Jaringan', 'Basis Data', 'Kecerdasan Buatan', 'Skripsi & Penelitian', 'Umum'];
}
