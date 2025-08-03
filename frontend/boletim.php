<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'aluno') {
    header('Location: index.php');
    exit;
}

$dsn = getenv('DB_DSN') ?: 'pgsql:host=localhost;dbname=edumanager';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_pass = getenv('DB_PASS') ?: '';

$pdo = new PDO($dsn, $db_user, $db_pass);
$stmt = $pdo->prepare('SELECT * FROM gerar_boletim(:aluno)');
$stmt->execute([':aluno' => $_SESSION['user_id']]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8" />
<title>Boletim</title>
</head>
<body>
<h1>Boletim do Aluno</h1>
<table border="1">
<tr><th>Disciplina</th><th>Nota</th></tr>
<?php foreach ($rows as $r): ?>
<tr>
    <td><?= htmlspecialchars($r['disciplina']) ?></td>
    <td><?= htmlspecialchars($r['nota']) ?></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="dashboard.php">Voltar ao painel</a></p>
</body>
</html>
