<?php
require_once 'header.php';
require_once 'db.php';
require_once 'functions.php';
logged_only();

if (!empty($_POST)) {
    $req = $pdo->prepare("UPDATE pizza_list SET pizza_name = ?, ingredient = ? WHERE id= ? ");
    $req->execute([$_POST['pizza_name'], $_POST['ingredient'], $_POST['data']]);
}

$id = intval($_GET['id']);
$req = $pdo->prepare("SELECT * FROM pizza_list WHERE id=?");
$req->execute([$id]);
$result = $req->fetch();

if ($result->pizza_inventor != $_SESSION['auth']->id) {
    echo ('Vous ne pouvez pas modifier cette pizza');
} else {
?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Nom de votre Pizza</label>
            <input type="text" name="pizza_name" class="form-control" placeholder="Uniquement des caractères alphabétiques non accentués et espaces" value="<?php echo $result->pizza_name ?>" required>
        </div>
        <div class="form-group">
            <label for="">Ingredients </label>
            <input type="text" name="ingredient" class="form-control" value="<?php echo $result->ingredient ?>" required>
        </div>
        <div><input type="hidden" name="data" value="<?php echo $result->id ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="updatepizza">Modifier votre pizza</button>
    </form>

<?php
    
}
?>

<?php require_once 'footer.php'; ?>