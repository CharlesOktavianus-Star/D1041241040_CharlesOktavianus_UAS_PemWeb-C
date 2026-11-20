<?php
require_once 'functions.php';
if(user()) go('index.php');
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 checkCsrf(); $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
 if($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<6) $error='Isi semua data dengan benar. Password minimal 6 karakter.';
 else {
  $check=$pdo->prepare('SELECT id FROM users WHERE email=?'); $check->execute([$email]);
  if($check->fetch()) $error='Email sudah terdaftar.';
  else {
   $role=($pdo->query('SELECT COUNT(*) FROM users')->fetchColumn()==0)?'developer':'member';
   $stmt=$pdo->prepare('INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)');
   $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT),$role]);
   $_SESSION['user']=['id'=>$pdo->lastInsertId(),'name'=>$name,'role'=>$role]; go('index.php');
  }
 }
}
$pageTitle='Daftar'; include 'header.php';
?>
<main class="container"><div class="card form-card"><h1>Bergabung dengan Tanyain</h1><p class="muted">Buat akun untuk mulai bertanya dan berdiskusi.</p><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><label>Nama lengkap</label><input name="name" required maxlength="80" placeholder="Nama kamu"><label>Email</label><input type="email" name="email" required placeholder="nama@email.com"><label>Password</label><input type="password" name="password" required minlength="6" placeholder="Minimal 6 karakter"><button class="btn" type="submit">Daftar sekarang</button></form><p class="muted small">Sudah punya akun? <a href="login.php" style="color:var(--primary)">Masuk</a></p><p class="muted small">Akun pertama yang mendaftar otomatis menjadi Developer.</p></div></main><?php include 'footer.php'; ?>
