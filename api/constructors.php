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

// Function to get a specific constructor's details
function getConstructorDetails($db, $constructorRef) {
    $stmt = $db->prepare("SELECT constructorId, constructorRef, name, nationality, url FROM constructors WHERE constructorRef = :constructorRef");
    $stmt->bindParam(':constructorRef', $constructorRef, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

// Function to get all constructors
function getAllConstructors($db) {
    $stmt = $db->prepare("SELECT constructorId, constructorRef, name, nationality, url FROM constructors");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Check if 'ref' parameter is set in the URL
if (isset($_GET['ref'])) {
    $constructorRef = $_GET['ref'];

    // Fetch constructor details
    $constructor = getConstructorDetails($db, $constructorRef);
    if ($constructor) {
        echo json_encode($constructor); 
    } else {
        echo json_encode(["error" => "Constructor not found."]);
    }
} else {
    // Fetch all constructors
    $constructors = getAllConstructors($db);

    if ($constructors) {
        echo json_encode($constructors); 
    } else {
        echo json_encode(["error" => "No constructors found."]);
    }
}
?>
