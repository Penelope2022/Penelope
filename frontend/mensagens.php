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
</head>
<body>
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
<label>BI Destinatário: <input type="text" name="dest_bi" required></label><br>
<label>Conteúdo:<br><textarea name="conteudo" required></textarea></label><br>
<button type="submit">Enviar</button>
</form>
<p style="color:green;"><?= htmlspecialchars($message) ?></p>
</body>
</html>
