<?php
function debug($variable){
    echo '<pre>' . print_r($variable, true) . '</pre>';
}

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function logged_only(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
      }
    if(!isset($_SESSION['auth'])){
      //  $_SESSION['flash']['danger'] = "Vous ne pouvez pas acceder à cette page";
        header('Location: login.php');
        exit();
    
    }
}

function reconnnect_from_cookie(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if (isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ) {
        require_once 'db.php';
        if(!isset($pdo)){
            global $pdo;
        }
        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if ($user) {
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'tortue');
            if($expected == $remember_token){
                session_start();
                $_SESSION['auth'] = $user;
                setcookie('remember', $remember_token, time() + 60*60*24*7);
                $_SESSION['flash']['succes'] = "Merci cookie";
            } 
            else{
                setcookie('remember', null, -1);
            }
        }
        else{
            setcookie('remember', null, -1);
        }
    }
}

/*
function sendAMail(){


require_once 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
  ->setUsername('0045f52cb02d7c')
  ->setPassword('cca8612601f2df')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Vous vous êtes bien déconnecté(e)'))
  ->setFrom(['alexandre.fournier@yahoo.fr' => 'Alef'])
  ->setTo(['essai.bla@bla.fr'])
  ->setBody('Vous êtes déconnecté(e)')
  ;

// Send the message
$result = $mailer->send($message);


header('Location: login.php');
}

*/