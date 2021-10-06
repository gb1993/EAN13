<?php
    session_start(); 
    if(!isset($_SESSION['user_adm'])){
        $_SESSION['no_user'] = "<p style ='color: red'>Necessário Login para acessar essa página.</p>";
        header("Location: index.php");
    }
    include_once("connectdb.php");


    $user_input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(!empty($user_input['criar']) && !empty($user_input['name']) && !empty($user_input['login']) && !empty($user_input['pass'])){
        $find_user = "SELECT * FROM users WHERE login = :login";
        $result_user = $conn -> prepare($find_user);
        $result_user -> bindParam(':login', $user_input['login']);
        $result_user -> execute();

        if($user_input['status'] == 'on'){
            $adm = 'adm';
        } else {
            $adm = 'default';
        }
        
        if(($result_user) && ($result_user -> rowCount() == 1)){
            $row_user = $result_user -> fetch(PDO::FETCH_ASSOC);
            $_SESSION['valida_usuario'] = "<p style ='color: red'>Usuário '" . strtoupper($row_user['login']) . "' Já cadastrado.</p>";
            header("Location: app_adm.php");
        } else {
            $name = $user_input['name'];
            $login = $user_input['login'];
            $pass = $user_input['pass'];
            $insert_user = "INSERT INTO users (status, name, login, pass) VALUES (:status, :name, :login, :pass)";
            $result_user = $conn -> prepare($insert_user);
            $result_user -> bindParam(':status', $adm);
            $result_user -> bindParam(':name', $name);
            $result_user -> bindParam(':login', $login);
            $result_user -> bindParam(':pass', md5($pass));
            $result_user -> execute();
            

            $_SESSION['valida_usuario'] = "<p style ='color: darkgreen'>Usuário registrado com sucesso</p>";
            header("Location: app_adm.php");
        }
    }