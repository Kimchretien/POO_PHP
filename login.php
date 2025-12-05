<?php
require "Database.php";

if (!empty($_POST)) {
    $db = Database::connect();

    $query = $db->prepare("SELECT * FROM users WHERE email=? AND password=MD5(?)");
    $query->execute([$_POST["email"], $_POST["password"]]);
    $user = $query->fetch();

    if ($user) {
        header("Location: home.php");
    } else {
        $msg = "Identifiants incorrects";
    }
}
?>

<form method="post">
    Email : <input name="email"><br>
    Mot de passe : <input type="password" name="password"><br>
    <button>Se connecter</button>
</form>

<?php if(isset($msg)) echo $msg; ?>
