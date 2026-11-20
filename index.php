<?php
require_once 'functions.php';
$pageTitle = 'Forum Diskusi Akademik';
$search = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');
$sql = "SELECT questions.*, users.name, users.role FROM questions JOIN users ON users.id=questions.user_id WHERE 1=1";
$params = [];
if ($search !== '') { $sql .= " AND (questions.title LIKE ? OR questions.body LIKE ?)"; $params[]="%$search%"; $params[]="%$search%"; }
if ($category !== '') { $sql .= " AND questions.category=?"; $params[]=$category; }
$sql .= " ORDER BY questions.created_at DESC";
$stmt=$pdo->prepare($sql); $stmt->execute($params); $questions=$stmt->fetchAll(PDO::FETCH_ASSOC);
$countUsers=$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$countQuestions=$pdo->query("SELECT COUNT(*) FROM questions")->fetchColumn();
include 'header.php';
?>
<main class="container">
<section class="hero"><h1>Punya pertanyaan?<br>Yuk, tanyain di sini.</h1><p>Temukan jawaban, berbagi pengetahuan, dan berdiskusi bersama komunitas akademik. Tidak ada pertanyaan yang terlalu sederhana untuk dipelajari.</p></section>
<div class="grid"><section>
<div class="card"><div class="layout-title"><h2>Diskusi terbaru</h2><?php if(user()): ?><a class="btn" href="ask.php">+ Buat Pertanyaan</a><?php endif; ?></div>
<form class="searchrow" method="get"><input type="text" name="q" placeholder="Cari topik atau pertanyaan..." value="<?= e($search) ?>"><button class="btn" type="submit">Cari</button></form>
<form method="get" style="margin-top:10px"><select name="category" onchange="this.form.submit()"><option value="">Semua kategori</option><?php foreach(categoryList() as $c): ?><option value="<?= e($c) ?>" <?= $category===$c?'selected':'' ?>><?= e($c) ?></option><?php endforeach; ?></select></form>
</div>
<?php if(!$questions): ?><div class="card empty">Belum ada pertanyaan yang cocok. Jadilah orang pertama yang memulai diskusi!</div><?php endif; ?>
<?php foreach($questions as $q): ?>
<article class="card"><span class="tag"><?= e($q['category']) ?></span><div class="question-title"><a href="view.php?id=<?= $q['id'] ?>"><?= e($q['title']) ?></a></div><div class="meta"><span>Oleh <?= e($q['name']) ?></span><?php if($q['role']==='developer'): ?><span class="developer">✦ Developer</span><?php endif; ?><span><?= date('d M Y, H:i',strtotime($q['created_at'])) ?></span></div><p class="question-text"><?= e(mb_strimwidth($q['body'],0,190,'...')) ?></p><a class="muted small" href="view.php?id=<?= $q['id'] ?>">Baca diskusi →</a></article>
<?php endforeach; ?>
</section><aside class="sidebar"><div class="card"><h3>Tentang Tanyain</h3><p class="muted small">Forum tanya jawab untuk membantu mahasiswa saling berbagi ilmu dan pengalaman akademik.</p><div class="stat"><?= $countQuestions ?></div><div class="muted small">Pertanyaan terpublikasi</div><div class="stat" style="margin-top:12px"><?= $countUsers ?></div><div class="muted small">Pengguna terdaftar</div></div><div class="card"><h3>Kategori diskusi</h3><?php foreach(categoryList() as $c): ?><p style="margin:9px 0"><a class="muted small" href="index.php?category=<?= urlencode($c) ?>">› <?= e($c) ?></a></p><?php endforeach; ?></div><div class="card"><h3>Mulai berdiskusi</h3><p class="muted small">Daftar akun untuk membuat pertanyaan dan ikut berdiskusi.</p><?php if(!user()): ?><a class="btn" href="register.php">Buat akun gratis</a><?php else: ?><a class="btn" href="ask.php">Tulis pertanyaan</a><?php endif; ?></div></aside></div>
</main><?php include 'footer.php'; ?>
