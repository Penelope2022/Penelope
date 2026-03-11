<?php
// Simple login form placeholder for XAMPP testing
// Uses PDO for database connection; adjust .env values accordingly.

session_start();

$dsn = getenv('DB_DSN') ?: 'pgsql:host=localhost;dbname=edumanager';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_pass = getenv('DB_PASS') ?: '';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bi = $_POST['bi'] ?? '';
    $senha = $_POST['senha'] ?? '';
    if ($bi && $senha) {
        try {
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $stmt = $pdo->prepare('SELECT id, senha, nome, tipo FROM usuarios WHERE bi = :bi AND ativo = true');
            $stmt->execute([':bi' => $bi]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_tipo'] = $user['tipo'];
                $pdo->prepare('SELECT registrar_login(:uid, true, :ip, :nav, :so, :disp, :ua)')
                    ->execute([
                        ':uid' => $user['id'],
                        ':ip' => $ip,
                        ':nav' => null,
                        ':so' => null,
                        ':disp' => null,
                        ':ua' => $ua
                    ]);
                header('Location: dashboard.php');
                exit;
            } else {
                if ($user) {
                    $pdo->prepare('SELECT registrar_login(:uid, false, :ip, :nav, :so, :disp, :ua)')
                        ->execute([
                            ':uid' => $user['id'],
                            ':ip' => $ip,
                            ':nav' => null,
                            ':so' => null,
                            ':disp' => null,
                            ':ua' => $ua
                        ]);
                }
                $message = 'Credenciais inválidas';
            }
        } catch (PDOException $e) {
            $message = 'Erro de conexão: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <title>EduManager Login</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="login-wrapper">
        <div class="login-box">
            <h1>EduManager</h1>
            <form method="post">
                <input type="text" name="bi" placeholder="Bilhete de Identidade" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button class="btn-primary" type="submit">Entrar</button>
            </form>
            <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
