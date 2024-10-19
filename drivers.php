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
