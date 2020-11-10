<?php require_once 'functions.php'; 
session_start();

 if (!empty($_POST)) {
    $errors = array();
    require_once 'db.php';
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Vous n'avez pas créer de pseudo ou il n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if($user){
            $errors['username'] = 'Ce pseudo existe déjà';
        }
    }

    
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
        $errors['email'] = "Vous n'avez pas donner d'email ou il n'est pas valide";}
        else {
            $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();
            if($user){
                $errors['email'] = 'Cet email est déjà utilisé';
            }
    }
  
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Vous n'avez pas rempli votre mot de passe";
    }
    if(empty($errors)){
        $req=$pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
        $user_id = $pdo->lastInsertId();
        
        $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte";
        header('Location: login.php');

        require_once 'vendor/autoload.php';

        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
        ->setUsername('0045f52cb02d7c')
        ->setPassword('cca8612601f2df')
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Bienvenu(e) sur pizzaCRUD'))
        ->setFrom(['alexandre.fournier@yahoo.fr' => 'Alef'])
        ->setTo(["essai.creationcompte@essaicreationcompte.fr"])
        ->setBody("Afin de valider votre compte merci de copier cette adresse http et de l'ouvrir via votre navigateur : \n\n http://localhost/pizzaCRUD/confirm.php?id=$user_id&token=$token") // creer un lien
        ;

        // Send the message
        $result = $mailer->send($message);


        header('Location: bienvenue.php');
                exit();
            }
        } 
            

 ?>
<?php require_once 'header.php'; ?>

<h1>S'inscrire</h1>

<?php if(!empty($errors)): ?>
<div class="alert alert-danger">
    <p>Le formulaire d'inscription n'est pas validé</p>
    <ul>
        <?php foreach($errors as $error): ?>
        <li><?= $error; ?> </li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>

<form action="" method="POST">
<div>
    <label for="">Pseudo</label>
    <input type="text" name="username" class="form-control" placeholder="uniquement des lettres, chiffres et underscore" required>
</div>
<div>
    <label for="">Email</label>
    <input type="text" name="email" class="form-control" required>
</div>
<div>
    <label for="">Mot de passe</label>
    <input type="password" name="password" class="form-control" required>
</div>
<div>
    <label for="">Confirmer votre mot de passe</label>
    <input type="password" name="password_confirm" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary">M'inscrire</button>
</form>


<?php require_once 'footer.php'; ?>