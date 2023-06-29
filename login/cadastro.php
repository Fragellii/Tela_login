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



// Função para cadastrar um novo usuário
function cadastrarUsuario($nome, $email, $senha)
{
    global $conexao;

    $nome = $conexao->real_escape_string($nome);
    $email = $conexao->real_escape_string($email);
    $senha = $conexao->real_escape_string($senha);

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_usuario (id_usuario, ds_email, ds_nome, id_status, ds_senha) VALUES (NULL, '$email', '$nome', 0, '$senhaHash')";

    if ($conexao->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Verifica se o formulário de cadastro foi enviado
if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (cadastrarUsuario($nome, $email, $senha)) {
        $_SESSION['email'] = $email;
        header('Location: dashboard.php'); // Redireciona para a página do painel de controle
        exit();
    } else {
        $erroCadastro = 'Erro ao cadastrar usuário.';
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Usuário</title>
</head>
<body>
    
    

    <?php if (isset($erroCadastro)) { ?>
        <p><?php echo $erroCadastro; ?></p>
    <?php } ?>

    <?php if (isset($_SESSION['email'])) { ?>
        <p>Cadastro feito com sucesso!</p>
        <?php unset($_SESSION['email']); ?>
    <?php } ?>

    <h1>Cadastro de Usuário</h1>

    <div class="container">
    <img src="juntojunto.png" alt="Logo Audio Vortex">
        

        <?php if (isset($_SESSION['mensagem'])) { ?>
            <p><?php echo $_SESSION['mensagem']; ?></p>
            <?php unset($_SESSION['mensagem']); ?>
        <?php } ?>

        <form method="post" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>

            <button type="submit" name="cadastro">Cadastrar</button>
        </form>
    </div>

    <!-- <form method="post" action="">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form> -->
</body>
</html>
