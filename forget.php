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
        $_SESSION['flash']['succes'] = "Les instructions du changement du mot de passe sont dans la boîte mail que vous avez renseigné";
        mail($_POST['email'], 'Réinitialisation de votre compte', "Afin de valider votre compte pmerci de cliquer sur ce lien\n\nhttp://localhost/pizzaCRUD/reset.php?id={$user->id}&token=$reset_token");
        header('Location: login.php');
        exit();
    }
    else{
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cet email";
    }
    debug($user->password);

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
    <input type="email" name="email" class="form-control" ><!-- required> -->
</div>

<button type="submit" class="btn btn-primary">Se connecter</button>
</form>


<?php debug($_SESSION); ?>
<?php require_once 'footer.php'; ?>
