<?php
try {
    $db = new PDO('sqlite:../data/f1.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Could not connect to the database: " . $e->getMessage()]);
    exit();
}
header('Content-Type: application/json');

// Function to get qualifying results for a specific race
function getQualifyingResults($db, $raceId) {
    $stmt = $db->prepare("
        SELECT q.position, d.driverRef, d.forename, d.surname, 
               c.name as constructorName, c.constructorRef, c.nationality, 
               q.q1, q.q2, q.q3 
        FROM qualifying q
        JOIN drivers d ON q.driverId = d.driverId
        JOIN constructors c ON q.constructorId = c.constructorId
        WHERE q.raceId = :raceId
        ORDER BY q.position
    ");
    $stmt->bindParam(':raceId', $raceId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_GET['ref'])) {
    $raceId = $_GET['ref'];
    $qualifyingResults = getQualifyingResults($db, $raceId);

    if ($qualifyingResults) {
        echo json_encode($qualifyingResults); 
    } else {
        echo json_encode(["error" => "No qualifying results found."]);
    }
} else {
    echo json_encode(["error" => "No race ID specified."]);
}
?>
