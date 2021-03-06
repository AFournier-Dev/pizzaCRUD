<?php 
require_once 'db.php';
require_once 'header.php'; 
require_once 'functions.php'; 
?>
<?php
logged_only();

if(!empty($_POST)){
    $errors = array();
    
    if(empty($_POST['pizza_name']) || !preg_match('/^[a-zA-Z ]*$/', $_POST['pizza_name']) && empty($_POST['ingredient']) || !filter_var($_POST['pizza_name'], FILTER_SANITIZE_STRING)){
        $errors['pizza_name'] = "Vous n'avez pas proposé de pizza car le formulaire n'est pas valide";
    }
    
    else{        
        $req = $pdo->prepare(('INSERT INTO  pizza_list (pizza_name, pizza_inventor, ingredient) VALUES (?, ?, ?)'));
        $req->execute([$_POST['pizza_name'], $_SESSION['auth']->id, $_POST['ingredient']]);
    }
}


?>


<form action="" method="POST">
    <div class="form-group">
        <label for="">Nom de votre Pizza</label>
        <input type="text" name="pizza_name" class="form-control" placeholder="Uniquement des caractères alphabétiques non accentués et espaces" required>
    </div>

    <div class="form-group">
        <label for="">Ingredients généraux </label>
        <input type="text" name="ingredient" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="">Ingredients de la pâte </label>
        <input type="checkbox" name="ingredient" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="">Façonnage de la pâte </label>
        <input type="text" name="ingredient" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="">Ingredients de la garniture</label>
        <input type="checkbox" name="ingredient" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="">Réalisation de la pizza</label>
        <input type="text" name="ingredient" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Proposer votre pizza</button>
</form>

<?php require_once 'footer.php'; ?>