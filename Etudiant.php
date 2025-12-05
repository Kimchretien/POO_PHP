<?php
/**
 * Classe Etudiant - Gestion complète des étudiants
 */
class Etudiant {
    // Propriétés (caractéristiques)
    public $id;
    public $nom;
    public $prenom;
    public $email;
    private $cnx;
    
    // Constructeur : appelé quand on fait "new Etudiant(...)"
    public function __construct($nom = "", $prenom = "", $email = "") {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        
        // Connexion à la base de données
        $this->cnx = mysqli_connect("localhost", "root", "", "gestion_etudiant");
        
        if (!$this->cnx) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }
    }
    
    /**
     * Enregistrer un nouvel étudiant
     */
    public function enregistrer() {
        $stmt = $this->cnx->prepare("INSERT INTO etudiant(nom, prenom, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->nom, $this->prenom, $this->email);
        
        if ($stmt->execute()) {
            $this->id = $this->cnx->insert_id; // Récupérer l'ID auto-généré
            return true;
        }
        return false;
    }
    
    /**
     * Récupérer un étudiant par son ID
     */
    public function chargerParId($id) {
        $stmt = $this->cnx->prepare("SELECT id, nom, prenom, email FROM etudiant WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }
    
    /**
     * Modifier un étudiant
     */
    public function modifier() {
        $stmt = $this->cnx->prepare("UPDATE etudiant SET nom = ?, prenom = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $this->nom, $this->prenom, $this->email, $this->id);
        return $stmt->execute();
    }
    
    /**
     * Supprimer un étudiant
     */
    public function supprimer() {
        $stmt = $this->cnx->prepare("DELETE FROM etudiant WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
    
    /**
     * Récupérer tous les étudiants
     */
    public function getTous($search = "") {
        $param = "%{$search}%";
        $stmt = $this->cnx->prepare("SELECT id, nom, prenom, email FROM etudiant WHERE nom LIKE ? OR email LIKE ? ORDER BY id ASC");
        $stmt->bind_param("ss", $param, $param);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $etudiants = [];
        while ($row = $result->fetch_assoc()) {
            $etudiants[] = $row;
        }
        return $etudiants;
    }
    
    /**
     * Afficher les informations de l'étudiant
     */
    public function afficher() {
        return "ID: {$this->id}, Nom: {$this->nom}, Prénom: {$this->prenom}, Email: {$this->email}";
    }
}
?>