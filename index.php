<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="styles/styles.css"> <!-- Ensure correct path to CSS -->
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
                    <li><a href="https://github.com/UdaySidhu-7/A1/tree/main"> Link to Github Repo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
    <section class="hero-section">
        <div class="hero-content">
            <h2>Welcome to the F1 Season 2022</h2>
            <p>Your ultimate resource for Formula 1 race data. Explore races, drivers, constructors, and much more from the 2022 season.</p>
            <a href="browse.php" class="btn-cta">Start Exploring</a>
        </div>
    </section>

    
    <div class="dashboard-container">
        <div class="features-grid">
            <div class="feature-card">
                <h3>Browse Races</h3>
                <p>View the race schedules, results, and circuit details for the 2022 Formula 1 season.</p>
                <a href="browse.php" class="btn-small">Browse Now</a>
            </div>
            <div class="feature-card">
                <h3>Explore Drivers</h3>
                <p>Learn more about the drivers from the 2022 season.</p>
                <a href="drivers.php" class="btn-small">See Drivers</a>
            </div>
            <div class="feature-card">
                <h3>Discover Constructors</h3>
                <p>Find out more about the teams and constructors that built the cars.</p>
                <a href="constructors.php" class="btn-small">View Constructors</a>
            </div>
            <div class="feature-card">
                <h3>Test APIs</h3>
                <p>Use the provided APIs to fetch data from the 2022 season including races, drivers, and constructors.</p>
                <a href="api_tester.php" class="btn-small">Test APIs</a>
            </div>
        </div>
    </div>

   
    <footer>
        <p>&copy; 2024 F1 Dashboard Project - COMP3512<br></p>
        <p>Gamanpreet Kaur<br> Udaypartap Singh Sidhu</p>
    </footer>
</body>
</html>
