<?php

$user_id = $_GET['id'];
$token = $_GET['token'];
require 'db.php';
$req = $pdo->prepare('SELECT confirmation_token FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();

if($user && $user->confirmation_token == $token){
    session_start();
    $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
    $_SESSION['auth'] = $user;
    header('Location: account.php');
    die('ok');
}else{
    die('pas ok');
}