<?php
if(!empty($_POST) && !empty($_POST['email'])){
    require_once 'db.php';
    require_once 'functions.php';
    session_start();
    $req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        $reset_token = str_random(60);
        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id =?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour modifier votre mot de passe";
    //    mail($_POST['email'], 'Réinitialisation de votre compte', "Afin de valider votre compte pmerci de cliquer sur ce lien\n\nhttp://localhost/pizzaCRUD/reset.php?id={$user->id}&token=$reset_token");


        /*
        $mail = mail('alexandre.fournier@yahoo.fr', 'Instruction de changement de mot de passe', 'Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/pizzaCRUD/reset.php?id={$user->id}&token=$reset_token', 'alexandre.fournier@yahoo.fr');
        */


  
        

        require_once 'vendor/autoload.php';

        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
        ->setUsername('0045f52cb02d7c')
        ->setPassword('cca8612601f2df')
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Revenir sur pizzaCRUD'))
        ->setFrom(['alexandre.fournier@yahoo.fr' => 'Alef'])
        ->setTo(["essai.creationcompte@essaicreationcompte.fr"])
        ->setBody("Afin de valider votre compte merci de copier cette adresse http et de l'ouvrir via votre navigateur : \n\n http://localhost/pizzaCRUD/confirm.php?id=$user_id&token=$token") // creer un lien
        ;

        // Send the message
        $result = $mailer->send($message);

/*
        header('Location: bienvenue.php');
                exit();



*/

     
        header('Location: login.php');
        exit();
    }
    else{
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cet email";
    }
    

}
?>

<?php
require_once 'functions.php';
require_once 'header.php';
?>

<h1>Mot de passe oublié</h1>


<form action="" method="POST">
<div class="form-group">
    <label for="">Email</label>
    <input type="email" name="email" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary">Se connecter</button>
</form>



<?php require_once 'footer.php'; ?>
