
<?php

    session_start();

if ($_SESSION['login']=="Peter"){

// Informations de connexion à la base de données distante
$hostname = '10.5.40.46:3306';
$database = 'localisationdrone';
$username = 'polo';
$password = 'polo';

try {
    // Connexion à la base de données distante
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    
    // Définir le mode d'erreur PDO à exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Requête pour sélectionner toutes les données de la table (remplacez 'nom_de_la_table' par le nom de votre table)
    $query3 = "SELECT * FROM Trajet";
    $query2 = "SELECT * FROM Drone";
    $query = "SELECT p.latitude, p.longitude, p.altitude, t.nom_trajet AS nom_trajet, d.nom AS nom FROM PositionDrone p JOIN Trajet t ON p.trajet_id = t.id JOIN Drone d ON t.drone_id = d.id";

    // Exécuter la requête
    $stmt = $pdo->query($query);
    $stmt2 = $pdo->query($query2);
    $stmt3 = $pdo->query($query3);
    // Afficher les résultats

?>
<form action="logout.php" method="post">
    <button type="submit">Se déconnecter</button>
</form>
<?php

$asciiArt = "  ________                                _____  ________                                     
 /  _____/_____    _____   ____     _____/ ____\ \______ \_______  ____   ____   ____   ______
/   \  ___\__  \  /     \_/ __ \   /  _ \   __\   |    |  \_  __ \/  _ \ /    \_/ __ \ /  ___/
\    \_\  \/ __ \|  Y Y  \  ___/  (  <_> )  |     |    `   \  | \(  <_> )   |  \  ___/ \___ \ 
 \______  (____  /__|_|  /\___  >  \____/|__|    /_______  /__|   \____/|___|  /\___  >____  >
        \/     \/      \/     \/                         \/                  \/     \/     \/ ";
		
echo "<pre>$asciiArt</pre>";


    echo "<h1>Position des Drones et trajectoires</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Drone</th><th>Nom Trajet</th><th>Latitude</th><th>Longitude</th><th>Altitude</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['nom']}</td>";
        echo "<td>{$row['nom_trajet']}</td>";
        echo "<td>{$row['latitude']}</td>";
        echo "<td>{$row['longitude']}</td>";
        echo "<td>{$row['altitude']}</td>";
	echo "</tr>";
    }
    echo "</table>";

    echo "<h1>Listing des Drones</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom du Drone</th>";
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nom']}</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<h1>Liste des Trajets</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Drone ID</th><th>Nom du Trajet</th>";
    while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['drone_id']}</td>";
	echo "<td>{$row['nom_trajet']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    


} catch (PDOException $e) {
    // En cas d'erreur de connexion ou d'exécution de la requête
    echo "Erreur : " . $e->getMessage();


}
}else{

    echo "Accès non autorisé";

    ?>
    <br><br><a href="login.html">Veuillez vous logger ici!</a>
    <?php
}


?>




