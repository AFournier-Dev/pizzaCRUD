<?php
require_once 'functions.php';
reconnnect_from_cookie();
//session_start();
if(isset($_SESSION['auth'])){
    header('Location: account.php');
        exit();
}
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    require_once 'db.php';
    
    //session_start();
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if (password_verify($_POST['password'], $user->password)) {
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['succes'] = "Vous êtes maintenant connecté(e)";
        if($_POST['remember']){
            $remember_token = str_random(250); //peu sécurisé !!!
            $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
            setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'tortue'), time() + 60*60*24*7); //cookie valable 7 jours
        }
        header('Location: account.php');
        exit();
    } else {
        $_SESSION['flash']['danger'] = "Couple identifiant/mot de passe non valide";
    }
    
}
?>

<?php
require_once 'functions.php';
require_once 'header.php';
?>

<h2>Se connecter</h2>


<form action="" method="POST">
    <div class="form-group">
        <label for="">Pseudo ou email</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="">Mot de passe <a href="forget.php">(Mot de passe oublié)</a></label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember" value="1"/> Se souvenir de moi
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>


<?php require_once 'footer.php'; ?>