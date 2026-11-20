<?php
require_once 'functions.php'; requireLogin();
$id=(int)($_GET['id']??0); $stmt=$pdo->prepare('SELECT * FROM questions WHERE id=?'); $stmt->execute([$id]); $q=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$q) die('Pertanyaan tidak ditemukan.'); if(!canManage($q)) die('Kamu tidak memiliki akses untuk mengubah pertanyaan ini.'); $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 checkCsrf(); $title=trim($_POST['title']??''); $body=trim($_POST['body']??''); $category=$_POST['category']??'';
 if($title===''||$body===''||!in_array($category,categoryList(),true)) $error='Semua kolom wajib diisi.';
 else { $up=$pdo->prepare('UPDATE questions SET title=?,body=?,category=?,updated_at=NOW() WHERE id=?'); $up->execute([$title,$body,$category,$id]); go('view.php?id='.$id); }
}
$pageTitle='Edit Pertanyaan'; include 'header.php';
?>
<main class="container"><div class="card form-card"><h1>Ubah pertanyaan</h1><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><label>Judul</label><input name="title" required maxlength="180" value="<?= e($q['title']) ?>"><label>Kategori</label><select name="category"><?php foreach(categoryList() as $c): ?><option <?= $q['category']===$c?'selected':'' ?>><?= e($c) ?></option><?php endforeach; ?></select><label>Isi pertanyaan</label><textarea name="body" required><?= e($q['body']) ?></textarea><button class="btn" type="submit">Simpan perubahan</button> <a class="btn secondary" href="view.php?id=<?= $id ?>">Batal</a></form></div></main><?php include 'footer.php'; ?>
