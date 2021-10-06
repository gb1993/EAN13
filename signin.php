<?php
session_start();
include_once("connectdb.php");

$user_input = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($user_input['signin'])){
    $find_user = "SELECT * FROM users WHERE login = :login AND pass = :pass";
    $result_user = $conn -> prepare($find_user);
    $result_user -> bindParam(':login', $user_input['login']);
    $result_user -> bindParam(':pass', md5($user_input['pass']));
    $result_user -> execute();
    
    if(($result_user) && ($result_user -> rowCount() == 1)){
        $row_user = $result_user -> fetch(PDO::FETCH_ASSOC);
        if($row_user['status'] == "adm"){
            $_SESSION['user_adm'] = $row_user['name'];
            header('Location: app_adm.php');
        } else {
            $_SESSION['user'] = $row_user['name'];
            header('Location: app.php');
        }
    } else {
        $_SESSION['no_user'] = "<p style ='color: red'>Usuário ou Senha inválido.</p>";
        header("location: index.php");
    }
}