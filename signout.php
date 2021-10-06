<?php
session_start();
ob_start();
unset($_SESSION['user_adm']);
unset($_SESSION['user']);
header('Location: index.php');