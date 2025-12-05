<?php
// ============================================
// PARTIE PHP : Traiter le formulaire
// ============================================

// Importer la classe Etudiant
require_once 'Etudiant.php';

// Variable pour stocker le message
$message = "";

// Vérifier si le formulaire a été soumis
if (isset($_POST['envoyer'])) {
    
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    
    // Créer un nouvel objet Etudiant avec les données
    $etudiant = new Etudiant($nom, $prenom, $email);
    
    // Enregistrer l'étudiant dans la base de données
    $message = $etudiant->enregistrer();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer un Étudiant</title>
    <style>
        /* Styles pour le fond */
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        /* Container du formulaire */
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 400px;
        }
        
        /* Titre */
        h2 {
            color: blue;
            text-align: center;
            margin-bottom: 30px;
        }
        
        /* Labels */
        label {
            color: blue;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }
        
        /* Inputs */
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        /* Focus sur les inputs */
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: blue;
        }
        
        /* Bouton submit */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        
        input[type="submit"]:hover {
            background-color: darkblue;
        }
        
        /* Message de confirmation */
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        
        /* Message de succès */
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        /* Message d'erreur */
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enregistrement des Étudiants</h2>
        
        <!-- Afficher le message si il existe -->
        <?php if ($message != ""): ?>
            <div class="message <?php echo (strpos($message, '✅') !== false) ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <!-- Formulaire HTML -->
        <form method="POST" action="">
            
            <label for="nom">Nom de l'étudiant :</label>
            <input type="text" id="nom" name="nom" required placeholder="Ex: Dupont">
            
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required placeholder="Ex: Jean">
            
            <label for="email">E-mail :</label>
            <input type="email" id="email" name="email" required placeholder="Ex: jean.dupont@email.com">
            
            <input type="submit" name="envoyer" value="Enregistrer">
            
        </form>
    </div>
</body>
</html>