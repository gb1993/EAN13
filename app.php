<?php 
    session_start(); 
    if(!isset($_SESSION['user'])){
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
    <title>Gerador de Código de Barras</title>
</head>
<body>
    <div>
        <div class="form">
            <form method="post" action="checkean.php">
                <h2>Gerador de código de barras</h2>
                <p>Código do Produto<input type="text" name="idproduto" maxlength ="5" required/></p>
                <p>Nome do Produto<input type="text" name="descricao" required/></p>
                <input type="submit" name="gerar" value="Gerar"/>
                <p><a href="signout.php">Sair do Sistema</a></p>
            </form>
                
        </div>      
    </div>
</body>
</html>