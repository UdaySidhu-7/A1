<?php
try {
    $db = new PDO('sqlite:../data/f1.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Could not connect to the database: " . $e->getMessage()]);
    exit();
}

// content type JSON
header('Content-Type: application/json');

// Function for all cirvuits
function getAllCircuits($db) {
    $stmt = $db->prepare("SELECT circuitId, circuitRef, name, location, country FROM circuits");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

// Function for specific circuit's details
function getCircuitDetails($db, $circuitRef) {
    $stmt = $db->prepare("SELECT circuitId, circuitRef, name, location, country FROM circuits WHERE circuitRef = :circuitRef");
    $stmt->bindParam(':circuitRef', $circuitRef, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

// to check if ref is set in url
if (isset($_GET['ref'])) {
    $circuitRef = $_GET['ref'];

    // Fetch circuit details
    $circuit = getCircuitDetails($db, $circuitRef);
    if ($circuit) {
        echo json_encode($circuit); 
    } else {
        echo json_encode(["error" => "Circuit not found."]);
    }
} else {
    // Fetch all circuits
    $circuits = getAllCircuits($db);

    if (!empty($circuits)) {
        echo json_encode($circuits); 
    } else {
        echo json_encode(["error" => "No circuits found."]);
    }
}
?>
