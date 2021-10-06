<?php 
    session_start(); 
    if(!isset($_SESSION['user_adm'])){
        $_SESSION['no_user'] = "<p style ='color: red'>Necessário Login para acessar essa página.</p>";
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="shortcut icon" href="pics/favicon.ico" />
    <title>Área do Administrador</title>
</head>
<body>
    <div class="form">
        <form method="post" action="cria_usuario.php">
            <h2>Criar novo usuário</h2>
            <p>Será Administrador?</p>
            <input type="checkbox" name="status"/>
            <label for="status">Sim</label>
            <p>Nome<input type="text" name="name" required/></p>
            <p>Login<input type="text" name="login" required/></p>
            <p>Senha<input type="password" name="pass" required/></p>
            <input type="submit" name="criar" value="Criar"/>
            <p><a href="signout.php">Sair do Sistema</a></p>
            <?php if(isset($_SESSION['valida_usuario'])){
                      echo $_SESSION['valida_usuario'];
                      unset($_SESSION['valida_usuario']);
                  }
            ?>
        </form>
    </div>
</body>
</html>