<?php
try {
    $db = new PDO('sqlite:../data/f1.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Could not connect to the database: " . $e->getMessage()]);
    exit();
}

header('Content-Type: application/json');

// Function to get all drivers
function getAllDrivers($db) {
    $stmt = $db->prepare("SELECT driverId, driverRef, code, forename, surname, nationality, dob FROM drivers");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get a specific driver by driverRef
function getDriverDetails($db, $driverRef) {
    $stmt = $db->prepare("SELECT driverId, driverRef, code, forename, surname, nationality, dob FROM drivers WHERE driverRef = :driverRef");
    $stmt->bindParam(':driverRef', $driverRef, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to get drivers within a specific race
function getDriversByRace($db, $raceId) {
    $stmt = $db->prepare("SELECT d.driverId, d.driverRef, d.code, d.forename, d.surname, d.nationality, d.dob
                          FROM drivers d
                          JOIN results r ON d.driverId = r.driverId
                          WHERE r.raceId = :raceId");
    $stmt->bindParam(':raceId', $raceId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

// Check if 'ref' or 'race' parameter is set in the URL
if (isset($_GET['ref'])) {

    $driverRef = $_GET['ref'];
    $driver = getDriverDetails($db, $driverRef);

    if ($driver) {
        echo json_encode($driver); 
    } else {
        echo json_encode(["error" => "Driver not found."]);
    }
} elseif (isset($_GET['race'])) {
   
    // Fetch drivers for a specific race
    $raceId = $_GET['race'];
    $drivers = getDriversByRace($db, $raceId);

    if ($drivers) {
        echo json_encode($drivers); 
    } else {
        echo json_encode(["error" => "No drivers found for this race."]);
    }
} else {
    // Fetch all drivers
    $drivers = getAllDrivers($db);

    if ($drivers) {
        echo json_encode($drivers);
    } else {
        echo json_encode(["error" => "No drivers found."]);
    }
}
?>
