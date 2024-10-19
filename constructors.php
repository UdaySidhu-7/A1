<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard - Explore Constructors</title>
    <link rel="stylesheet" href="styles/constructors.css">
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
        <h2>Explore Constructors - 2022 Season</h2>
        <?php if ($selectedConstructor): ?>
            <div class="constructor-details">
                <h3><?php echo htmlspecialchars($selectedConstructor['name']); ?></h3>
                <p><strong>Nationality:</strong> <?php echo htmlspecialchars($selectedConstructor['nationality']); ?></p>
                <p><strong>More Info:</strong> 
                    <a href="<?php echo htmlspecialchars($selectedConstructor['url']); ?>" target="_blank">
                        <?php echo htmlspecialchars($selectedConstructor['url']); ?>
                    </a>
                </p>
                <h4>Drivers</h4>
                <?php if ($constructorDrivers): ?>
                    <ul>
                        <?php foreach ($constructorDrivers as $driver): ?>
                            <li>
                                <a href="drivers.php?driverRef=<?php echo urlencode($driver['driverRef']); ?>">
                                    <?php echo htmlspecialchars($driver['forename'] . ' ' . $driver['surname']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No drivers found for this constructor.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="driver-grid">
                <?php foreach ($constructors as $constructor): ?>
                    <div class="driver-card">
                        <img src="images/constructor.jpg" alt="Constructor Silhouette" class="constructor-photo">
                        <h3><?php echo htmlspecialchars($constructor['name']); ?></h3>
                        <p><strong>Nationality:</strong> <?php echo htmlspecialchars($constructor['nationality']); ?></p>
                        <a href="constructors.php?constructorRef=<?php echo urlencode($constructor['constructorRef']); ?>" class="btn-small">View More</a>
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
