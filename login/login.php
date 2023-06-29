<?php
session_start();

// Configurações do banco de dados
$host = 'localhost';
$usuario = 'usr_lg';
$senha = 'lg2023';
$banco = 'tela_login';

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die('Erro na conexão: ' . $conexao->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Tela de Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($erroLogin)) { ?>
        <p><?php echo $erroLogin; ?></p>
    <?php } ?>

    <?php if (isset($erroCadastro)) { ?>
        <p><?php echo $erroCadastro; ?></p>
    <?php } ?>


    <div class="container">
        
    <img src="juntojunto.png" alt="Logo Audio Vortex">
        <form method="post" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="login">Entrar</button>
        </form>

        <form method="post" action="">
            <a href="cadastro.php"><button type="button">Cadastrar Usuário</button></a>
        </form>
    </div> -->

    
</body>
</html>