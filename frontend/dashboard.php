<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <title>Painel</title>
</head>
<body>
<h1>Bem-vindo ao EduManager</h1>
<p>Seu perfil: <?= htmlspecialchars($_SESSION['user_tipo']) ?></p>
<p>
    <a href="profile.php">Perfil</a> |
    <a href="logout.php">Sair</a>
</p>
<?php if ($_SESSION['user_tipo'] === 'aluno'): ?>
<p><a href="boletim.php">Ver Boletim</a></p>
<p><a href="tarefas.php">Ver Tarefas</a></p>
<?php endif; ?>
<p><a href="mensagens.php">Mensagens</a></p>
</body>
</html>
