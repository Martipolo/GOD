<?php
// Vérification si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $drone_id = $_POST['drone_id'];
    $nom_trajet = $_POST['nom_trajet'];

    // Connexion à la base de données
        $hostname = '10.5.40.46:3306';
        $database = 'localisationdrone';
        $username = 'polo';
        $password = 'polo';

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Définir le mode d'erreur PDO à exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL pour l'insertion des données
        $stmt = $conn->prepare("INSERT INTO Trajet (drone_id, nom_trajet) VALUES (:drone_id, :nom_trajet)");
        // Liaison des paramètres
        $stmt->bindParam(':drone_id', $drone_id);
	$stmt->bindParam(':nom_trajet', $nom_trajet);

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
