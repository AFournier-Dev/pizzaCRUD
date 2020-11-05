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
    /*
A LA PLACE DE LA METHODE filter_var de PHP avec FILTER_VALIDATE_EMAIL
POSSIBILITE EN REGEX :
(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
    */
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Vous n'avez pas rempli votre mot de passe";
    }
    if(empty($errors)){
        $req=$pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'], $password /* $_POST['password'] MAUVAISE PRATIQUE DE CYBER SECURITE */ , $_POST['email'], $token]);
        $user_id = $pdo->lastInsertId();
        mail($_POST['email'], 'Valider votre compte', "Afin de valider votre compte pmerci de cliquer sur ce lien\n\nhttp://localhost/pizzaCRUD/confirm.php?id=$user_id&token=$token");
        $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte";
        header('Location: login.php');
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
    <input type="text" name="username" class="form-control" ><!-- required> -->
</div>
<div>
    <label for="">Email</label>
    <input type="text" name="email" class="form-control" ><!-- required> ++++ type="email" -->
</div>
<div>
    <label for="">Mot de passe</label>
    <input type="text" name="password" class="form-control" ><!-- required> ++++ type="password" -->
</div>
<div>
    <label for="">Confirmer votre mot de passe</label>
    <input type="text" name="password_confirm" class="form-control" ><!-- required ++++ type="password" -->
</div>

<button type="submit" class="btn btn-primary">M'inscrire</button>
</form>


<?php require_once 'footer.php'; ?>