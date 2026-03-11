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

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarefa = $_POST['tarefa_id'] ?? '';
    $url = $_POST['resposta_url'] ?? '';
    if ($tarefa && $url) {
        $stmt = $pdo->prepare('SELECT responder_tarefa(:tarefa, :aluno, :url)');
        $stmt->execute([
            ':tarefa' => $tarefa,
            ':aluno' => $_SESSION['user_id'],
            ':url' => $url
        ]);
        $message = 'Resposta enviada.';
    }
}

$turmaStmt = $pdo->prepare('SELECT turma_id FROM alunos WHERE usuario_id = :uid');
$turmaStmt->execute([':uid' => $_SESSION['user_id']]);
$turma_id = $turmaStmt->fetchColumn();

$tarefasStmt = $pdo->prepare('SELECT t.id, t.titulo, t.descricao, t.data_entrega, rt.resposta_url
                              FROM tarefas t
                              LEFT JOIN respostas_tarefas rt
                                ON rt.tarefa_id = t.id AND rt.aluno_id = :aluno
                              WHERE t.turma_id = :turma
                              ORDER BY t.data_entrega');
$tarefasStmt->execute([':turma' => $turma_id, ':aluno' => $_SESSION['user_id']]);
$tarefas = $tarefasStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8" />
<title>Tarefas</title>
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
        <h1>Tarefas da Turma</h1>
        <?php if ($message): ?><p class="message" style="color:green;"><?= htmlspecialchars($message) ?></p><?php endif; ?>
        <table border="1" style="width:100%; border-collapse:collapse;">
        <tr><th>Título</th><th>Descrição</th><th>Entrega</th><th>Resposta</th></tr>
        <?php foreach ($tarefas as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['titulo']) ?></td>
            <td><?= htmlspecialchars($t['descricao']) ?></td>
            <td><?= htmlspecialchars($t['data_entrega']) ?></td>
            <td>
                <?php if ($t['resposta_url']): ?>
                    <a href="<?= htmlspecialchars($t['resposta_url']) ?>" target="_blank">Ver Resposta</a>
                <?php else: ?>
                    <form method="post" style="display:inline">
                        <input type="hidden" name="tarefa_id" value="<?= htmlspecialchars($t['id']) ?>">
                        <input type="text" name="resposta_url" placeholder="URL da resposta" required>
                        <button class="btn-primary" type="submit">Enviar</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
        <p><a href="dashboard.php">Voltar ao painel</a></p>
    </div>
</body>
</html>
