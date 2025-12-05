<?php
require "Database.php";
require "Etudiant.php";

$db = Database::connect();

// AJOUTER
if (isset($_POST["ajouter"])) {
    $et = new Etudiant($_POST["nom"], $_POST["prenom"], $_POST["age"]);
    $query = $db->prepare("INSERT INTO etudiants(nom, prenom, age) VALUES (?,?,?)");
    $query->execute([$et->nom, $et->prenom, $et->age]);
}

// SUPPRIMER
if (isset($_GET["delete"])) {
    $query = $db->prepare("DELETE FROM etudiants WHERE id=?");
    $query->execute([$_GET["delete"]]);
}

// LISTE
$etudiants = $db->query("SELECT * FROM etudiants")->fetchAll();
?>

<h1>Liste des étudiants</h1>

<form method="post">
    Nom : <input name="nom">
    Prénom : <input name="prenom">
    Age : <input name="age">
    <button name="ajouter">Ajouter</button>
</form>

<table border="1">
<tr>
    <th>ID</th><th>Nom</th><th>Prénom</th><th>Age</th><th>Action</th>
</tr>

<?php foreach ($etudiants as $e): ?>
<tr>
    <td><?= $e["id"] ?></td>
    <td><?= $e["nom"] ?></td>
    <td><?= $e["prenom"] ?></td>
    <td><?= $e["age"] ?></td>
    <td><a href="?delete=<?= $e["id"] ?>">Supprimer</a></td>
</tr>
<?php endforeach; ?>
</table>
