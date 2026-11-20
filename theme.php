<?php
require_once 'functions.php'; checkCsrf();
$_SESSION['theme'] = (($_SESSION['theme'] ?? 'light') === 'light') ? 'dark' : 'light';
$back = $_SERVER['HTTP_REFERER'] ?? 'index.php';
if (strpos($back, $_SERVER['HTTP_HOST']) === false) $back = 'index.php';
go($back);
