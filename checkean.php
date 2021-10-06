<?php
    session_start(); 
    if(!isset($_SESSION['user'])){
        $_SESSION['no_user'] = "<p style ='color: red'>Necessário Login para acessar essa página.</p>";
        header("Location: index.php");
    }
    include_once("connectdb.php");
    include_once("ean13.php");

    $user_input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(!empty($user_input['gerar']) && !empty($user_input['idproduto']) && !empty($user_input['descricao'])){
        $find_produtc = "SELECT * FROM produtos WHERE idproduto = :idproduto";
        $result_product = $conn -> prepare($find_produtc);
        $result_product -> bindParam(':idproduto', $user_input['idproduto']);
        $result_product -> execute();
        
        if(($result_product) && ($result_product -> rowCount() == 1)){
            $row_product = $result_product -> fetch(PDO::FETCH_ASSOC);
?>

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
        <form action="app.php" method="post">
            <h2>Código já Cadastrado</h2>
            <p>Código de Barras: <?php echo $row_product['ean13']; ?></p>
            <p>Código do produto: <?php echo $row_product['idproduto']; ?></p>
            <p>Nome do produto: <?php echo $row_product['descricao'];  ?></p>
            <p><input type="submit" value="Gerar outro código de barras"></p>
            <p><a href="signout.php">Sair do Sistema</a></p>
        </form>
    </div>
</body>
</html>

<?php        
        } else {
            $idproduto = $user_input['idproduto'];
            $descricao =  $user_input['descricao'];
            $ean13 = IncluiDigito(7895389 . $user_input['idproduto']);
            $insert_produto = "INSERT INTO produtos (idproduto, descricao, ean13) VALUES (:idproduto, :descricao, :ean13)";
            $result_product = $conn -> prepare($insert_produto);
            $result_product -> bindParam(':idproduto', $idproduto);
            $result_product -> bindParam(':descricao', $descricao);
            $result_product -> bindParam(':ean13', $ean13);
            $result_product -> execute();
?>        

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
        <form action="app.php" method="post">
            <h2>Código de Barras Gerado com Sucesso!</h2>
            <p>Código de Barras: <?php echo $ean13 ?></p>
            <p>Código do produto: <?php echo $user_input['idproduto']; ?></p>
            <p>Nome do produto: <?php echo $user_input['descricao'];  ?></p>
            <p><input type="submit" value="Gerar outro código de barras"></p>
            <p><a href="signout.php">Sair do Sistema</a></p>
        </form>
    </div>
</body>
</html>

<?php   }
    }
?>