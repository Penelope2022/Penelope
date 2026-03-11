<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$dsn = getenv('DB_DSN') ?: 'pgsql:host=localhost;dbname=edumanager';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_pass = getenv('DB_PASS') ?: '';

$pdo = new PDO($dsn, $db_user, $db_pass);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST['senha_atual'] ?? '';
    $new = $_POST['nova_senha'] ?? '';
    $biStmt = $pdo->prepare('SELECT bi FROM usuarios WHERE id = :id');
    $biStmt->execute([':id' => $_SESSION['user_id']]);
    $bi = $biStmt->fetchColumn();
    $stmt = $pdo->prepare('SELECT atualizar_senha(:bi, :old, :new)');
    $stmt->execute([':bi' => $bi, ':old' => $old, ':new' => $new]);
    if ($stmt->fetchColumn()) {
        $message = 'Senha atualizada com sucesso';
    } else {
        $message = 'Falha ao atualizar senha';
    }
}

$stmt = $pdo->prepare('SELECT nome, bi, tipo FROM usuarios WHERE id = :id');
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <title>Perfil</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="header">
        <a href="dashboard.php">EduManager</a>
        <span style="float:right;">
            <a href="logout.php">Sair</a>
        </span>
    </div>
    <div class="container">
        <h1>Perfil do Usuário</h1>
        <p>Nome: <?= htmlspecialchars($user['nome']) ?></p>
        <p>BI: <?= htmlspecialchars($user['bi']) ?></p>
        <p>Tipo: <?= htmlspecialchars($user['tipo']) ?></p>

        <h2>Atualizar Senha</h2>
        <form method="post">
            <input type="password" name="senha_atual" placeholder="Senha atual" required>
            <input type="password" name="nova_senha" placeholder="Nova senha" required>
            <button class="btn-primary" type="submit">Atualizar</button>
        </form>
        <?php if ($message): ?>
        <p class="message" style="color:green;">
            <?= htmlspecialchars($message) ?>
        </p>
        <?php endif; ?>
        <p><a href="dashboard.php">Voltar ao painel</a></p>
    </div>
</body>
</html>
