<?php
require_once 'functions.php';
logged_only();
require_once 'header.php';
?>

<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
<form action="" method="POST">

</form>

<?php debug($_SESSION); ?>
<?php require_once 'footer.php'; ?>