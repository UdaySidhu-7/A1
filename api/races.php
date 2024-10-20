<?php
try {
    $db = new PDO('sqlite:../data/f1.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Could not connect to the database: " . $e->getMessage()]);
    exit();
}

header('Content-Type: application/json');

function getRaceDetails($db, $raceId) {
    $stmt = $db->prepare("
        SELECT r.raceId, r.name, r.round, r.year, r.date, 
               c.name as circuitName, c.location, c.country 
        FROM races r
        JOIN circuits c ON r.circuitId = c.circuitId
        WHERE r.raceId = :raceId
    ");
    $stmt->bindParam(':raceId', $raceId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

// Function to get all races for the 2022 season ordered by round
function getAllRaces($db) {
    $stmt = $db->prepare("
        SELECT raceId, name, round, year, date 
        FROM races 
        WHERE year = 2022 
        ORDER BY round
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Check if 'ref' parameter is set in the URL
if (isset($_GET['ref'])) {
    $raceId = $_GET['ref'];

    // Fetch and return race details
    $race = getRaceDetails($db, $raceId);
    if ($race) {
        echo json_encode($race);
    } else {
        echo json_encode(["error" => "Race not found."]);
    }

} else {
    // Fetch and return all races for the 2022 season
    $races = getAllRaces($db);
    if ($races) {
        echo json_encode($races);
    } else {
        echo json_encode(["error" => "No races found for 2022."]);
    }
}
?>
