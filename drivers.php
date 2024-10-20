<?php
try {
    $db = new PDO('sqlite:data/f1.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Could not connect to the database: ' . $e->getMessage());
}

// Function to get all drivers with their constructors for the 2022 season in ascending order by name
function getDriversWithConstructors($db) {
    $stmt = $db->query("SELECT d.driverRef, d.forename, d.surname, d.nationality, c.name AS constructor, c.constructorRef
                        FROM drivers d
                        JOIN results r ON d.driverId = r.driverId
                        JOIN constructors c ON r.constructorId = c.constructorId
                        JOIN races ra ON r.raceId = ra.raceId
                        WHERE ra.year = 2022
                        GROUP BY d.driverRef
                        ORDER BY d.forename ASC, d.surname ASC");  //order by name
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get race results for a driver for the 2022 season
function getDriverRaceResults($db, $driverRef) {
    $stmt = $db->prepare("SELECT r.round, c.name as circuitName, rr.position, rr.points
                          FROM results rr
                          JOIN races r ON rr.raceId = r.raceId
                          JOIN circuits c ON r.circuitId = c.circuitId
                          JOIN drivers d ON rr.driverId = d.driverId
                          WHERE d.driverRef = :driverRef AND r.year = 2022  
                          ORDER BY r.round ASC");
    $stmt->bindValue(':driverRef', $driverRef, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch all drivers with constructors for 2022
$drivers = getDriversWithConstructors($db);
$selectedDriver = null;
$raceResults = null;

if (isset($_GET['driverRef'])) {
    $driverRef = $_GET['driverRef'];
    foreach ($drivers as $driver) {
        if ($driver['driverRef'] == $driverRef) {
            $selectedDriver = $driver;
            $raceResults = getDriverRaceResults($db, $driverRef);
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard - Explore Drivers</title>
    <link rel="stylesheet" href="styles/drivers.css"> 
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-left">
                <a href="index.php">
                    <img src="images/newlogo.png" alt="F1 Logo" class="logo">
                </a>
                <h1>Season 2022</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="browse.php">Browse Races</a></li>
                    <li><a href="api_tester.php">APIs</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="dashboard-container">
        <h2>Explore Drivers - 2022 Season</h2>
        <?php if ($selectedDriver): ?>
            <div class="driver-details">
                <h3><?php echo htmlspecialchars($selectedDriver['forename'] . ' ' . $selectedDriver['surname']); ?></h3>
                <p><strong>Nationality:</strong> <?php echo htmlspecialchars($selectedDriver['nationality']); ?></p>
                <p><strong>Constructor:</strong> 
                    <a href="constructors.php?constructorRef=<?php echo urlencode($selectedDriver['constructorRef']); ?>">
                        <?php echo htmlspecialchars($selectedDriver['constructor']); ?>
                    </a>
                </p>
                <h4>Race Results</h4>
                <?php if ($raceResults): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Round</th>
                                <th>Circuit</th>
                                <th>Position</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($raceResults as $result): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($result['round']); ?></td>
                                    <td><?php echo htmlspecialchars($result['circuitName']); ?></td>
                                    <td><?php echo htmlspecialchars($result['position']); ?></td>
                                    <td><?php echo htmlspecialchars($result['points']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No race results found for this driver.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="driver-grid">
                <?php foreach ($drivers as $driver): ?>
                    <div class="driver-card">
                        <img src="images/driver.jpg" alt="Driver Silhouette" class="driver-photo">
                        <h3><?php echo htmlspecialchars($driver['forename'] . ' ' . $driver['surname']); ?></h3>
                        <p><strong>Nationality:</strong> <?php echo htmlspecialchars($driver['nationality']); ?></p>
                        <p><strong>Constructor:</strong> 
                            <a href="constructors.php?constructorRef=<?php echo urlencode($driver['constructorRef']); ?>">
                                <?php echo htmlspecialchars($driver['constructor']); ?>
                            </a>
                        </p>
                        <a href="drivers.php?driverRef=<?php echo urlencode($driver['driverRef']); ?>" class="btn-small">View More</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 F1 Dashboard Project - COMP3512</p>
    </footer>
</body>
</html>
