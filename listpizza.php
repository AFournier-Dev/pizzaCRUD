<?php
require_once 'db.php';
require_once 'header.php'; ?>

<?php

$user_id = intval($_SESSION['auth']->id);
$req = $pdo->prepare("SELECT pizza_name, ingredient, id FROM pizza_list WHERE pizza_inventor = :user_id");
$req->execute([':user_id' => $user_id]);
$result = $req->fetchAll();

var_dump($result);

foreach ($result as $value) {?>
    <h3> Nom de votre pizza : <?php echo $value->pizza_name ?></h3>
    <p>Liste de vos ingrédient : <?php echo $value->ingredient ?></p>
    <a href="adjustpizza.php?id=<?=$value->id?>">Modifier cette recette</a>
<?php
}

?>




<form action="" method="POST">

    <button type="submit" class="btn btn-primary" name="seeallpizza">Revoir vos Pizzas proposées</button>
</form>

<?php require_once 'footer.php'; ?>