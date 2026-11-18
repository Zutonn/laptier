<?php
declare(strict_types=1);

function h(mixed $value): string {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function rupiah(mixed $value): string {
    return 'Rp' . number_format((float)$value, 0, ',', '.');
}
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}
function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . h(csrf_token()) . '">';
}
function verify_csrf(): void {
    $sent = (string)($_POST['csrf_token'] ?? '');
    $known = (string)($_SESSION['csrf_token'] ?? '');
    if ($sent === '' || $known === '' || !hash_equals($known, $sent)) {
        http_response_code(419);
        exit('Sesi formulir kedaluwarsa. Muat ulang halaman, lalu coba kembali.');
    }
}
function redirect(string $to): never {
    header('Location: ' . $to);
    exit;
}
function flash(string $key, ?string $message = null): ?string {
    if ($message !== null) { $_SESSION['_flash'][$key] = $message; return null; }
    $value = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $value;
}
function setting(string $key, string $default = ''): string {
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        try {
            foreach (db()->query('SELECT setting_key, setting_value FROM settings')->fetchAll() as $row) {
                $cache[$row['setting_key']] = $row['setting_value'];
            }
        } catch (Throwable $e) { $cache = []; }
    }
    return (string)($cache[$key] ?? $default);
}
function tier_class(string $tier): string {
    return 'tier-' . strtolower(str_replace('+', 'plus', $tier));
}
function product_image(?string $path): string {
    $path = trim((string)$path);
    if ($path !== '' && preg_match('~^https?://~i', $path)) return $path;
    if ($path !== '' && !str_contains($path, '..')) return $path;
    return 'assets/images/laptop-placeholder.svg';
}
function case_labels(?string $cases): array {
    return array_values(array_filter(array_map('trim', explode(',', (string)$cases))));
}
function current_admin(): array {
    return [
        'id' => (int)($_SESSION['admin_id'] ?? 0),
        'username' => (string)($_SESSION['admin_username'] ?? 'Admin'),
    ];
}
