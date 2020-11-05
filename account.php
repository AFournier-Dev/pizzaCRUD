<?php
require_once 'functions.php';
logged_only();
if(!empty($_POST)){
    if($_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mots de passes sont différents";
    }
    else{
        $user_id = $_SESSION['auth']->id;
        $password= password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once 'db.php';
        $req = $pdo->prepare('UPDATE users SET password = ? WHERE id =?')->execute([$password, $user_id]);
        $_SESSION['flash']['succes'] = "Votre mots de passe à été modifié";
    }
}
require_once 'header.php';
?>

<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
<form action="" method="POST">
    <div>
       <input class="form-control" type="password" name="password" placeholder="Changer votre mot de passe">
    </div>
    <div>
       <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation de votre nouveau mot de passe">
    </div>
    <button class="btn btn-primary">Confirmer le nouveau mot de passe</button>
</form>

<?php debug($_SESSION); ?>
<?php require_once 'footer.php'; ?>