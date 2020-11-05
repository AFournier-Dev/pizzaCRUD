<?php require_once 'header.php'; ?>

<?php
 if (!empty($_POST)) {
    $errors = array();
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Vous n'avez pas créer de pseudo ou il n'est pas valide";
    }
    
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
        $errors['email'] = "Vous n'avez pas donner d'email ou il n'est pas valide";
    }
    /*
A LA PLACE DE LA METHODE filter_var de PHP avec FILTER_VALIDATE_EMAIL
POSSIBILITE EN REGEX :
(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
    */
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Vous n'avez pas rempli votre mot de passe";
    }
    debug($errors);
 } 
    
 ?>


<h1>S'inscrire</h1>

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


<?php require_once 'footer.php';
