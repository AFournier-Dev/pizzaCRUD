<?php
require_once 'functions.php';
if(isset($_GET['id']) && isset($_GET['token'])){
    require'db.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND  reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();
    if($user){
        if (!empty($_POST)) {
           if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
               $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
               $pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
               session_start();
               $_SESSION['flash']['succes'] = "Votre mot de passe est réinitialisé";
               $_SESSION['auth']= $user;
               header('Location: account.php');
                exit();
           }
        }
    }
    else{
        session_start();
        $_SESSION['flash']['danger'] = "Token invalide";
        header(('Location: login.php'));
        exit();
    }
}
else{
    header(('Location: login.php'));
    exit();

}

?>
<?php
require_once 'functions.php';
require_once 'header.php';
?>

<h1>Réinitialisation de votre mot de passe</h1>


<form action="" method="POST">
<div class="form-group">
    <label for="">Mot de passe </label>
    <input type="text" name="password" class="form-control" ><!-- required> ++++ type="password" -->
</div>

<div class="form-group">
    <label for="">Confirmation du mot de passe </label>
    <input type="text" name="password_confirm" class="form-control" ><!-- required> ++++ type="password" -->
</div>

<button type="submit" class="btn btn-primary">Réinitialisation de votre mot de passe</button>
</form>


<?php debug($_SESSION); ?>
<?php require_once 'footer.php'; ?>
