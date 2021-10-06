<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="shortcut icon" href="pics/favicon.ico" />
    <title>Gerador de Código de Barras</title>
</head>
<body>
    <div class="form">
        <form action="signin.php" method="post">
            <h1>Acesso ao Sistema</h1>
            <p>Usuário <input type="text" name="login" required/></p>
            <p>Senha <input type="password" name="pass" required/></p>
            <p><input value="Acessar" type="submit" name="signin"/></p>
            <?php if(isset($_SESSION['no_user'])){
                      echo $_SESSION['no_user'];
                      unset($_SESSION['no_user']);
                  }
            ?>
        </form>
	</div>
</body>
</html>