<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$dsn = getenv('DB_DSN') ?: 'pgsql:host=localhost;dbname=edumanager';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_pass = getenv('DB_PASS') ?: '';
$message = '';

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dest_bi = $_POST['dest_bi'] ?? '';
        $conteudo = $_POST['conteudo'] ?? '';
        if ($dest_bi && $conteudo) {
            $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE bi = :bi');
            $stmt->execute([':bi' => $dest_bi]);
            $dest = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($dest) {
                $pdo->prepare('SELECT enviar_mensagem(:rem,:dest,:cont)')
                    ->execute([':rem' => $_SESSION['user_id'], ':dest' => $dest['id'], ':cont' => $conteudo]);
                $message = 'Mensagem enviada';
            } else {
                $message = 'Destinatário não encontrado';
            }
        }
    }
    $stmt = $pdo->prepare('SELECT * FROM listar_mensagens(:uid)');
    $stmt->execute([':uid' => $_SESSION['user_id']]);
    $msgs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Erro: ' . $e->getMessage();
    $msgs = [];
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8" />
<title>Mensagens</title>
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
        <h1>Mensagens</h1>
        <p><a href="dashboard.php">Voltar</a></p>
        <?php foreach ($msgs as $m): ?>
        <div style="border:1px solid #ccc;margin:5px;padding:5px;">
            <p><strong><?= htmlspecialchars($m['remetente_id']) ?>:</strong> <?= htmlspecialchars($m['conteudo']) ?></p>
            <p><small><?= htmlspecialchars($m['enviado_em']) ?></small></p>
        </div>
        <?php endforeach; ?>
        <h2>Nova mensagem</h2>
        <form method="post">
            <input type="text" name="dest_bi" placeholder="BI Destinatário" required>
            <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
            <button class="btn-primary" type="submit">Enviar</button>
        </form>
        <?php if ($message): ?><p class="message" style="color:green;"><?= htmlspecialchars($message) ?></p><?php endif; ?>
    </div>
</body>
</html>
