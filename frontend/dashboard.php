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
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="header">
        <a href="dashboard.php">EduManager</a>
        <span style="float:right;">
            <a href="profile.php">Perfil</a>
            <a href="logout.php">Sair</a>
        </span>
    </div>
    <div class="container">
        <h1>Bem-vindo</h1>
        <p>Seu perfil: <?= htmlspecialchars($_SESSION['user_tipo']) ?></p>
        <?php if ($_SESSION['user_tipo'] === 'aluno'): ?>
        <p><a href="boletim.php">Ver Boletim</a></p>
        <p><a href="tarefas.php">Ver Tarefas</a></p>
        <?php endif; ?>
        <p><a href="mensagens.php">Mensagens</a></p>
    </div>
</body>
</html>
