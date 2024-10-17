<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard - Home</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Header Bar -->
    <header>
        <div class="header-content">
            <h1>F1 Dashboard Project</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="browse.php">Browse</a></li>
                    <li><a href="api_tester.php">APIs</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-content">
                <h2>About this Project</h2>
                <p>#1 for COMP3512 at Mount Royal University, showcase data from Formula 1 races using SQLite and PHP.</p>
                <p><strong>Technologies Used:</strong> SQLite, PHP, CSS</p>
                
                <a href="browse.php" class="btn">Browse Races</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <h2>Welcome to the F1 Dashboard Project</h2>
            <p>This site allows you to explore Formula 1 race data, including circuits, drivers, constructors, races, qualifying results, and final results. You can use the navigation bar to explore various sections of the dashboard.</p>
        </main>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 F1 Dashboard Project - COMP3512</p>
    </footer>
</body>
</html>
