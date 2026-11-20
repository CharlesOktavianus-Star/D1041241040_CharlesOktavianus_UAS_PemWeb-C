<?php
require_once 'functions.php'; requireLogin(); $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 checkCsrf(); $title=trim($_POST['title']??''); $body=trim($_POST['body']??''); $category=$_POST['category']??'';
 if($title==='' || $body==='' || !in_array($category,categoryList(),true)) $error='Judul, isi, dan kategori wajib diisi.';
 else { $stmt=$pdo->prepare('INSERT INTO questions(user_id,title,body,category) VALUES(?,?,?,?)'); $stmt->execute([user()['id'],$title,$body,$category]); go('view.php?id='.$pdo->lastInsertId()); }
}
$pageTitle='Buat Pertanyaan'; include 'header.php';
?>
<main class="container"><div class="card form-card"><h1>Buat pertanyaan baru</h1><p class="muted">Jelaskan pertanyaanmu dengan jelas agar mudah dipahami.</p><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><label>Judul pertanyaan</label><input name="title" maxlength="180" required placeholder="Contoh: Apa perbedaan HTML dan PHP?"><label>Kategori</label><select name="category" required><option value="">Pilih kategori</option><?php foreach(categoryList() as $c): ?><option><?= e($c) ?></option><?php endforeach; ?></select><label>Detail pertanyaan</label><textarea name="body" required placeholder="Tuliskan konteks dan detail pertanyaanmu..."></textarea><button class="btn" type="submit">Publikasikan pertanyaan</button> <a class="btn secondary" href="index.php">Batal</a></form></div></main><?php include 'footer.php'; ?>
