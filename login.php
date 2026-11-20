<?php
require_once 'functions.php'; if(user()) go('index.php'); $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 checkCsrf(); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
 $stmt=$pdo->prepare('SELECT * FROM users WHERE email=?'); $stmt->execute([$email]); $account=$stmt->fetch(PDO::FETCH_ASSOC);
 if($account && password_verify($password,$account['password'])){
  session_regenerate_id(true); $_SESSION['user']=['id'=>$account['id'],'name'=>$account['name'],'role'=>$account['role']]; go('index.php');
 } else $error='Email atau password salah.';
}
$pageTitle='Masuk'; include 'header.php';
?>
<main class="container"><div class="card form-card"><h1>Selamat datang kembali!</h1><p class="muted">Masuk untuk melanjutkan diskusi.</p><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><label>Email</label><input type="email" name="email" required placeholder="nama@email.com"><label>Password</label><input type="password" name="password" required placeholder="Password"><button class="btn" type="submit">Masuk</button></form><p class="muted small">Belum punya akun? <a href="register.php" style="color:var(--primary)">Daftar</a></p></div></main><?php include 'footer.php'; ?>
