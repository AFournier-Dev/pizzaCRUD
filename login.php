<?php
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    require_once 'db.php';
    require_once 'functions.php';
    session_start();
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if(password_verify($_POST['password'], $user->password)){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['succes'] = "Vous êtes maintenant connecté(e)";
        header('Location: account.php');
        exit();
    }
    else{
        $_SESSION['flash']['danger'] = "Couple identifiant/mot de passe non valide";
    }
    debug($user->password);

}
?>

<?php
require_once 'functions.php';
require_once 'header.php';
?>

<h1>Se connecter</h1>


<form action="" method="POST">
<div>
    <label for="">Pseudo ou email</label>
    <input type="text" name="username" class="form-control" ><!-- required> -->
</div>

<div>
    <label for="">Mot de passe</label>
    <input type="text" name="password" class="form-control" ><!-- required> ++++ type="password" -->
</div>

<button type="submit" class="btn btn-primary">Se connecter</button>
</form>


<?php debug($_SESSION); ?>
<?php require_once 'footer.php'; ?>
