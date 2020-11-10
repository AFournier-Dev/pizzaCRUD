<?php
require_once 'header.php';
require_once 'db.php';
require_once 'functions.php';
logged_only();

$id = intval($_GET['id']);



if (!empty($_POST)) { // && $_POST['password'] == mdp[de l'user]
    $req = $pdo->prepare("DELETE FROM pizza_list WHERE id = ?");
    $req->execute([$id]);
    header('Location: deletepizza.php');
    exit;
}


$req = $pdo->prepare("SELECT * FROM pizza_list WHERE id=?");
$req->execute([$id]);
$result = $req->fetch();

if ($result->pizza_inventor != $_SESSION['auth']->id) {
    echo ('Vous ne pouvez pas SUP cette pizza');
    // require location
} // else {}
?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Nom de votre Pizza</label>
            <input type="text" name="pizza_name" class="form-control"  value="<?php echo $result->pizza_name ?>" required>
        </div>
        
        <div><input type="hidden" name="data" value="<?php echo $result->id ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="updatepizza">Supprimer votre pizza</button>
    </form>

<?php
    


?>

<?php require_once 'footer.php'; ?>