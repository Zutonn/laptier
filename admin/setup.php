<?php
require_once __DIR__ . '/../includes/bootstrap.php';
$count = (int)db()->query('SELECT COUNT(*) FROM admins')->fetchColumn();
$error = '';
if ($count > 0) { $locked = true; } else {
  $locked = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim((string)($_POST['username'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $confirm = (string)($_POST['confirm_password'] ?? '');
    if (strlen($username) < 4 || !preg_match('/^[a-zA-Z0-9_.-]+$/', $username)) $error = 'Username minimal 4 karakter dan hanya boleh berisi huruf, angka, titik, garis bawah, atau tanda hubung.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = 'Format email tidak valid.';
    elseif (strlen($password) < 12) $error = 'Gunakan password minimal 12 karakter.';
    elseif ($password !== $confirm) $error = 'Konfirmasi password tidak cocok.';
    else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = db()->prepare('INSERT INTO admins (username,email,password_hash) VALUES (:u,:e,:p)');
      try { $stmt->execute(['u'=>$username,'e'=>$email,'p'=>$hash]); flash('success','Akun admin berhasil dibuat. Login dan hapus file admin/setup.php dari hosting setelahnya.'); redirect('login.php'); }
      catch (PDOException $e) { $error = 'Akun tidak dapat dibuat. Username atau email mungkin sudah digunakan.'; }
    }
  }
}
?><!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Setup Admin — LapTier</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="admin-body"><div class="admin-login-wrap"><section class="admin-login-art"><a class="brand" href="../index.php"><span class="brand-mark" style="background:var(--lime);color:var(--ink)">L<span>/</span>T</span><span class="brand-word" style="color:white">LapTier<small style="color:#a7afaa">FIRST-TIME SETUP</small></span></a><div><div class="eyebrow">Setup / Secure your workspace</div><h1>Satu admin.<br><em>Kontrol penuh.</em></h1><p>Buat akun pengelola pertama untuk mengisi katalog dan mengubah isi website.</p></div><div class="mono-label">LapTier control room / <?= date('Y') ?></div></section><section class="admin-login-panel"><span class="mono-label">01 / Account initialization</span><?php if($locked): ?><h2>Setup terkunci.</h2><p>Akun admin sudah tersedia. Untuk keamanan, halaman setup tidak dapat membuat akun kedua.</p><a class="button button-dark" href="login.php">Ke halaman login ↗</a><?php else: ?><h2>Buat admin.</h2><p>Gunakan email aktif dan password kuat. Tidak ada password default yang bisa ditebak.</p><?php if($error!==''): ?><div class="alert error"><?= h($error) ?></div><?php endif; ?><form method="post" autocomplete="off"><?= csrf_field() ?><div class="form-row"><label for="username">Username</label><input class="field" id="username" name="username" value="<?= h($_POST['username']??'') ?>" minlength="4" required></div><div class="form-row"><label for="email">Email</label><input class="field" id="email" type="email" name="email" value="<?= h($_POST['email']??'') ?>" required></div><div class="form-row"><label for="password">Password</label><input class="field" id="password" type="password" name="password" minlength="12" required autocomplete="new-password"></div><div class="form-row"><label for="confirm_password">Ulangi password</label><input class="field" id="confirm_password" type="password" name="confirm_password" minlength="12" required autocomplete="new-password"></div><button class="button button-dark" type="submit">Buat akun admin <span>↗</span></button></form><?php endif; ?><a class="back-link" href="../index.php">← Kembali ke website</a></section></div></body></html>
