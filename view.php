<?php
require_once 'functions.php'; $id=(int)($_GET['id']??0);
$stmt=$pdo->prepare('SELECT questions.*,users.name,users.role FROM questions JOIN users ON users.id=questions.user_id WHERE questions.id=?'); $stmt->execute([$id]); $q=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$q) die('Pertanyaan tidak ditemukan.');
if($_SERVER['REQUEST_METHOD']==='POST'){
 requireLogin(); checkCsrf(); $body=trim($_POST['body']??'');
 if($body!==''){ $add=$pdo->prepare('INSERT INTO answers(question_id,user_id,body) VALUES(?,?,?)'); $add->execute([$id,user()['id'],$body]); go('view.php?id='.$id); }
}
$ans=$pdo->prepare('SELECT answers.*,users.name,users.role FROM answers JOIN users ON users.id=answers.user_id WHERE question_id=? ORDER BY answers.created_at ASC'); $ans->execute([$id]); $answers=$ans->fetchAll(PDO::FETCH_ASSOC);
$pageTitle=$q['title']; include 'header.php';
?>
<main class="container"><a class="muted small" href="index.php">← Kembali ke forum</a><article class="card" style="margin-top:15px"><span class="tag"><?= e($q['category']) ?></span><h1 style="margin-bottom:8px"><?= e($q['title']) ?></h1><div class="meta"><span>Oleh <?= e($q['name']) ?></span><?php if($q['role']==='developer'): ?><span class="developer">✦ Developer</span><?php endif; ?><span><?= date('d M Y, H:i',strtotime($q['created_at'])) ?></span></div><p class="question-text" style="font-size:16px;margin-top:22px"><?= e($q['body']) ?></p><?php if(user() && canManage($q)): ?><div class="actions"><a class="btn secondary" href="edit.php?id=<?= $id ?>">Ubah pertanyaan</a><form method="post" action="delete.php"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><input type="hidden" name="id" value="<?= $id ?>"><button class="btn danger" type="submit">Hapus</button></form></div><?php endif; ?></article>
<section class="card"><h2>Diskusi (<?= count($answers) ?> jawaban)</h2><?php if(!$answers): ?><p class="muted">Belum ada jawaban. Jadilah yang pertama membantu!</p><?php endif; ?><?php foreach($answers as $a): ?><div class="answer"><strong><?= e($a['name']) ?></strong> <?php if($a['role']==='developer'): ?><span class="developer">✦ Developer</span><?php endif; ?><div class="muted small"><?= date('d M Y, H:i',strtotime($a['created_at'])) ?></div><p style="white-space:pre-wrap;margin-bottom:0"><?= e($a['body']) ?></p></div><?php endforeach; ?></section>
<?php if(user()): ?><section class="card"><h3>Tulis jawaban</h3><form method="post"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><textarea name="body" required placeholder="Bagikan jawaban atau pendapatmu..."></textarea><button class="btn" type="submit">Kirim jawaban</button></form></section><?php else: ?><div class="card"><p class="muted">Ingin ikut menjawab? <a href="login.php" style="color:var(--primary)">Masuk</a> atau <a href="register.php" style="color:var(--primary)">daftar akun</a>.</p></div><?php endif; ?>
</main><?php include 'footer.php'; ?>
