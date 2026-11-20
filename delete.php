<?php
require_once 'functions.php'; requireLogin();
if($_SERVER['REQUEST_METHOD']!=='POST') go('index.php'); checkCsrf();
$id=(int)($_POST['id']??0); $stmt=$pdo->prepare('SELECT * FROM questions WHERE id=?'); $stmt->execute([$id]); $q=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$q) die('Pertanyaan tidak ditemukan.'); if(!canManage($q)) die('Kamu tidak memiliki akses untuk menghapus pertanyaan ini.');
$del=$pdo->prepare('DELETE FROM questions WHERE id=?'); $del->execute([$id]); go('index.php');
