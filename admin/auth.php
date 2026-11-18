<?php
require_once __DIR__ . '/../includes/bootstrap.php';
if (empty($_SESSION['admin_id'])) {
    flash('error', 'Silakan login untuk membuka dashboard.');
    redirect('login.php');
}
$adminId = (int)$_SESSION['admin_id'];
$adminStmt = db()->prepare('SELECT id, username, email FROM admins WHERE id = :id LIMIT 1');
$adminStmt->execute(['id' => $adminId]);
$admin = $adminStmt->fetch();
if (!$admin) {
    unset($_SESSION['admin_id'], $_SESSION['admin_username']);
    redirect('login.php');
}
