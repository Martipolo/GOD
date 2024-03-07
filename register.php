<?php
// Vérification si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nomdrone = $_POST['nom'];
    
    // Connexion à la base de données
	$hostname = '10.170.10.66:3306';
	$database = 'localisationdrone';
	$username = 'polo';
	$password = 'polo';

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Définir le mode d'erreur PDO à exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Préparer la requête SQL pour l'insertion des données
        $stmt = $conn->prepare("INSERT INTO Drone (nom) VALUES (:nom)");
        // Liaison des paramètres
        $stmt->bindParam(':nom', $nomdrone);
        
        // Exécution de la requête
        $stmt->execute();

        echo "Enregistrement réussi !";
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Seules les requêtes POST sont autorisées.";
}
?>

