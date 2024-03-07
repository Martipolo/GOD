<?php
// Vérification si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $altitude = $_POST['altitude'];
    $trajet_id = $_POST['trajet_id'];

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
        $stmt = $conn->prepare("INSERT INTO PositionDrone (latitude, longitude, altitude, trajet_id) VALUES (:latitude, :longitude, :altitude, :trajet_id)");        // Liaison des paramètres
        $stmt->bindParam(':latitude', $latitude);
        $stmt->bindParam(':longitude', $longitude);
	$stmt->bindParam(':altitude', $altitude);
	$stmt->bindParam(':trajet_id', $trajet_id);

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
