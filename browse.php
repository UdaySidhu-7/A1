<?php
try {
    $db = new PDO('sqlite:data/f1.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Could not connect to the database: ' . $e->getMessage());
}

// Function to get all races for the 2022 season
function getRaces($db) {
    $stmt = $db->query("SELECT r.raceId, r.name AS raceName, r.date, r.round, c.name AS circuitName, c.location, c.country, c.url
                        FROM races r
                        JOIN circuits c ON r.circuitId = c.circuitId
                        WHERE r.year = 2022
                        ORDER BY r.date, raceName, r.name ASC ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get qualifying and final results for the top 3 drivers of a race
function getRaceResults($db, $raceId) {
    $stmt = $db->prepare("SELECT rr.position, d.driverRef, d.forename, d.surname, q.q1, q.q2, q.q3, rr.points
                          FROM results rr
                          JOIN drivers d ON rr.driverId = d.driverId
                          LEFT JOIN qualifying q ON q.driverId = d.driverId AND q.raceId = rr.raceId
                          WHERE rr.raceId = :raceId
                          ORDER BY rr.position ASC
                          LIMIT 3");
    $stmt->bindValue(':raceId', $raceId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$races = getRaces($db);
$raceDetails = null;
if (isset($_GET['raceId'])) {
    $raceId = $_GET['raceId'];
    foreach ($races as $race) {
        if ($race['raceId'] == $raceId) {
            $raceDetails = $race;
            $raceResults = getRaceResults($db, $raceId);
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
    <title>F1 Dashboard - Browse Races</title>
    <link rel="stylesheet" href="styles/browse.css"> 
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
        <?php if ($raceDetails): ?>
            <h2><?php echo htmlspecialchars($raceDetails['raceName']); ?> - Round <?php echo htmlspecialchars($raceDetails['round']); ?></h2>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($raceDetails['date']); ?></p>
            <p><strong>Circuit:</strong> <?php echo htmlspecialchars($raceDetails['circuitName']); ?>, <?php echo htmlspecialchars($raceDetails['location']); ?>, <?php echo htmlspecialchars($raceDetails['country']); ?></p>
            <p><strong>Race Info:</strong> <a href="<?php echo htmlspecialchars($raceDetails['url']); ?>" target="_blank">Official Race Page</a></p>
            <h3>Top 3 Drivers</h3>
            <table>
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Driver</th>
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>Q3</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($raceResults as $result): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['position']); ?></td>
                            <td>
                                <a href="drivers.php?driverRef=<?php echo urlencode($result['driverRef']); ?>">
                                    <?php echo htmlspecialchars($result['forename'] . ' ' . $result['surname']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($result['q1']); ?></td>
                            <td><?php echo htmlspecialchars($result['q2']); ?></td>
                            <td><?php echo htmlspecialchars($result['q3']); ?></td>
                            <td><?php echo htmlspecialchars($result['points']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <h2>Browse Races - 2022 Season</h2>
            <div class="race-grid">
                <?php foreach ($races as $race): ?>
                    <div class="race-card">
                        <h3><?php echo htmlspecialchars($race['raceName']); ?></h3>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($race['date']); ?></p>
                        <p><strong>Circuit:</strong> <?php echo htmlspecialchars($race['circuitName']); ?>, <?php echo htmlspecialchars($race['location']); ?></p>
                        <img src="images/browse.jpg" alt="Race Photo" class="race-photo"> 
                        <a href="browse.php?raceId=<?php echo urlencode($race['raceId']); ?>" class="btn-small">View More</a>
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
