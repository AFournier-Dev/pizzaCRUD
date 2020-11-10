<?php
require_once 'db.php';
require_once 'header.php'; 
require_once 'functions.php'; 

?>

<?php

logged_only();

$user_id = intval($_SESSION['auth']->id);


$req = $pdo->prepare("SELECT pizza_name, ingredient, id FROM pizza_list WHERE pizza_inventor = :user_id");
$req->execute([':user_id' => $user_id]);
$result = $req->fetchAll();


foreach ($result as $value) {?>
    <h4> Nom de votre pizza : <?php echo $value->pizza_name ?></h4>
    <p>Liste de vos ingrédient : <?php echo $value->ingredient ?></p>
    
    <a href="adjustpizza.php?id=<?=$value->id?>"><button type="submit" class="btn btn-primary pull-right">Modifier cette recette </button></a><br><br>
<?php
}

?>

<?php require_once 'footer.php'; ?>