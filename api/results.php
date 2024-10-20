<?php
// Connect to the database using PDO
try {
    $db = new PDO('sqlite:../data/f1.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Could not connect to the database: " . $e->getMessage()]);
    exit();
}
header('Content-Type: application/json');

// Check if 'ref' parameter is set in the URL
if (isset($_GET['ref'])) {
    $raceId = $_GET['ref'];

    // Function to get results for a specific race
    function getRaceResults($db, $raceId) {
        $stmt = $db->prepare("
            SELECT d.driverRef, d.code, d.forename, d.surname,
                   r.position, r.points, 
                   r.grid, r.laps, r.fastestLapTime,
                   r.time, s.status, 
                   c.name as constructorName, c.constructorRef, c.nationality
            FROM results r
            JOIN drivers d ON r.driverId = d.driverId
            JOIN status s ON r.statusId = s.statusId
            JOIN constructors c ON r.constructorId = c.constructorId
            WHERE r.raceId = :raceId
            ORDER BY r.grid ASC
        ");
        $stmt->bindParam(':raceId', $raceId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Fetch and return race results
    $raceResults = getRaceResults($db, $raceId);
    echo json_encode($raceResults);
} elseif (isset($_GET['driver'])) {
    $driverRef = $_GET['driver'];

    // Function to get all results for a given driver
    function getDriverResults($db, $driverRef) {
        $stmt = $db->prepare("
            SELECT r.round, r.name as raceName, r.year, r.date, 
                   rr.position, rr.points, 
                   c.name as constructorName, c.constructorRef, c.nationality
            FROM results rr
            JOIN races r ON rr.raceId = r.raceId
            JOIN drivers d ON rr.driverId = d.driverId
            JOIN constructors c ON rr.constructorId = c.constructorId
            WHERE d.driverRef = :driverRef
            ORDER BY r.round ASC
        ");
        $stmt->bindParam(':driverRef', $driverRef, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Fetch and return driver's results
    $driverResults = getDriverResults($db, $driverRef);
    echo json_encode($driverResults); // Return driver's results as JSON
} else {
    echo json_encode(["error" => "No valid parameters provided."]);
}
?>
