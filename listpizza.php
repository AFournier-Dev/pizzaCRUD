<?php 
require_once 'db.php';
require_once 'header.php'; ?>

<?php

if(!empty($_POST)){
    $errors = array();
    
    if(empty($_POST['seeallpizza'])){

        // SI id de user n'a pas proposer de pizza alors alert 

        
$req = $pdo->prepare(('SELECT '))

        //$errors['pizza_name'] = "Vous n'avez pas encore proposé de pizza";
    }
    
    else{        
        $req = $pdo->prepare(('INSERT INTO  pizza_list (pizza_name, pizza_inventor, ingredient) VALUES (?, ?, ?)'));
        var_dump($req);
        $req->execute([$_POST['pizza_name'], $_SESSION['auth']->id, $_POST['ingredient']]);
    }
}

?>


<form action="" method="POST">

    <button type="submit" class="btn btn-primary" name="seeallpizza">Revoir vos Pizzas proposées</button>
</form>

<?php require_once 'footer.php'; ?>