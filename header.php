<?php
$pageTitle = $pageTitle ?? 'Tanyain';
$theme = $_SESSION['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?> | Tanyain</title>
<style>
:root{--bg:#f5f7fb;--surface:#fff;--text:#20283a;--muted:#718096;--line:#e6eaf1;--primary:#6558e8;--soft:#eeecff;--shadow:0 12px 35px rgba(30,41,59,.07)}
body.dark{--bg:#111522;--surface:#1b2233;--text:#edf1fa;--muted:#a4aec2;--line:#30394d;--primary:#a59cff;--soft:#302d52;--shadow:0 12px 35px rgba(0,0,0,.2)}
*{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--text);font-family:Arial,Helvetica,sans-serif;line-height:1.6;transition:.2s}a{color:inherit;text-decoration:none}.topbar{background:var(--surface);border-bottom:1px solid var(--line);position:sticky;top:0;z-index:5}.nav{max-width:1120px;margin:auto;padding:15px 22px;display:flex;align-items:center;justify-content:space-between;gap:15px}.brand{font-size:25px;font-weight:800;letter-spacing:-1px;color:var(--primary)}.brand span{color:var(--text)}.navlinks{display:flex;align-items:center;gap:18px;flex-wrap:wrap}.navlinks a{font-size:14px;color:var(--muted);font-weight:600}.navlinks a:hover{color:var(--primary)}.themeform{display:inline}.themebtn,.btn{border:0;border-radius:11px;padding:10px 15px;background:var(--primary);color:white;font-weight:700;cursor:pointer;font-size:14px}.themebtn{background:var(--soft);color:var(--primary);padding:8px 11px}.btn:hover,.themebtn:hover{filter:brightness(.95)}.btn.secondary{background:var(--soft);color:var(--primary)}.btn.danger{background:#e34d65}.container{max-width:1120px;margin:34px auto;padding:0 22px}.hero{padding:34px;border-radius:22px;background:linear-gradient(120deg,#6558e8,#8d78f4);color:#fff;box-shadow:var(--shadow);margin-bottom:26px}.hero h1{font-size:34px;line-height:1.2;margin:0 0 10px}.hero p{margin:0;opacity:.9;max-width:650px}.grid{display:grid;grid-template-columns:minmax(0,1fr) 285px;gap:22px}.card{background:var(--surface);border:1px solid var(--line);border-radius:17px;padding:22px;box-shadow:var(--shadow);margin-bottom:17px}.card h2,.card h3{margin-top:0}.muted{color:var(--muted)}.small{font-size:13px}.tag{display:inline-block;background:var(--soft);color:var(--primary);padding:4px 10px;border-radius:30px;font-size:12px;font-weight:700}.question-title{font-size:20px;font-weight:750;margin:9px 0}.question-title a:hover{color:var(--primary)}.meta{font-size:13px;color:var(--muted);display:flex;gap:12px;flex-wrap:wrap}.question-text{color:var(--muted);margin:8px 0 13px;white-space:pre-wrap}.layout-title{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:15px}.layout-title h2{margin:0}.sidebar .card{padding:19px}.stat{font-size:25px;font-weight:800;color:var(--primary)}input,textarea,select{width:100%;padding:12px 13px;border:1px solid var(--line);border-radius:10px;background:var(--bg);color:var(--text);font:inherit;margin:6px 0 15px}textarea{min-height:145px;resize:vertical}label{font-size:14px;font-weight:700}form .btn{margin-top:4px}.form-card{max-width:650px;margin:0 auto}.form-card h1{margin-top:0}.notice{padding:12px 15px;border-radius:10px;background:var(--soft);color:var(--primary);margin-bottom:16px}.error{background:#ffe8ec;color:#b4233c}.success{background:#e5f8ed;color:#18794e}.actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px}.actions form{margin:0}.answer{border-top:1px solid var(--line);padding:17px 0}.answer:first-child{border-top:0}.footer{text-align:center;color:var(--muted);padding:25px;font-size:13px}.developer{font-weight:800;background:linear-gradient(90deg,#ff4242,#ffb52e,#44d17b,#36a7ff,#b45cff);background-size:300% 300%;color:transparent;background-clip:text;-webkit-background-clip:text;animation:rgb 3s linear infinite}@keyframes rgb{0%{background-position:0% 50%}100%{background-position:100% 50%}}.empty{text-align:center;padding:35px;color:var(--muted)}.searchrow{display:flex;gap:8px}.searchrow input{margin:0}.searchrow button{white-space:nowrap}@media(max-width:800px){.grid{grid-template-columns:1fr}.hero h1{font-size:28px}.nav{align-items:flex-start}.navlinks{justify-content:flex-end;gap:11px}.navlinks a{font-size:13px}}@media(max-width:520px){.nav{flex-direction:column}.navlinks{justify-content:flex-start}.hero{padding:25px}.container{margin-top:22px;padding:0 14px}.card{padding:17px}}
</style>
</head>
<body class="<?= e($theme) ?>">
<header class="topbar"><nav class="nav">
<a class="brand" href="index.php">Tanya<span>in.</span></a>
<div class="navlinks">
<a href="index.php">Beranda</a>
<?php if (user()): ?>
<a href="ask.php">+ Tanya</a>
<a href="logout.php">Keluar (<?= e(user()['name']) ?>)</a>
<?php else: ?>
<a href="login.php">Masuk</a><a href="register.php">Daftar</a>
<?php endif; ?>
<form class="themeform" action="theme.php" method="post"><input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>"><button class="themebtn" type="submit"><?= $theme === 'dark' ? '☀ Light' : '☾ Dark' ?></button></form>
</div></nav></header>
