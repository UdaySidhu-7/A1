<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project - API Tester</title>
    <link rel="stylesheet" href="styles/drivers.css">
</head>
<body>
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
    <div class="dashboard-container">
        <div class="content">
            <h2>API List</h2>
            <table class="api-table">
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="api/circuits.php" target="_blank">/Assignment 1/api/circuits.php</a></td>
                        <td>Returns all the circuits</td>
                    </tr>
                    <tr>
                        <td><a href="api/circuits.php?ref=monaco" target="_blank">/Assignment 1/api/circuits.php?ref=monaco</a></td>
                        <td>Returns the specific circuit (Monaco)</td>
                    </tr>
                    <tr>
                        <td><a href="api/constructors.php" target="_blank">/Assignment 1/api/constructors.php</a></td>
                        <td>Returns all the constructors</td>
                    </tr>
                    <tr>
                        <td><a href="api/constructors.php?ref=mclaren" target="_blank">/Assignment 1/api/constructors.php?ref=mclaren</a></td>
                        <td>Returns the specific constructor (McLaren)</td>
                    </tr>
                    <tr>
                        <td><a href="api/drivers.php" target="_blank">/Assignment 1/api/drivers.php</a></td>
                        <td>Returns all the drivers for the season</td>
                    </tr>
                    <tr>
                        <td><a href="api/drivers.php?ref=hamilton" target="_blank">/Assignment 1/api/drivers.php?ref=hamilton</a></td>
                        <td>Returns the specific driver (Hamilton)</td>
                    </tr>
                    <tr>
                        <td><a href="api/drivers.php?race=1106" target="_blank">/Assignment 1/api/drivers.php?race=1106</a></td>
                        <td>Returns the drivers within a given race</td>
                    </tr>
                    <tr>
                        <td><a href="api/races.php" target="_blank">/Assignment 1/api/races.php</a></td>
                        <td>Returns the races within the 2022 season ordered by round</td>
                    </tr>
                    <tr>
                        <td><a href="api/races.php?ref=67" target="_blank">/Assignment 1/api/races.php?ref=67</a></td>
                        <td>Returns the specified race with detailed circuit information</td>
                    </tr>
                    <tr>
                        <td><a href="api/qualifying.php?ref=1106" target="_blank">/Assignment 1/api/qualifying.php?ref=1106</a></td>
                        <td>Returns the qualifying results for the specified race</td>
                    </tr>
                    <tr>
                        <td><a href="api/results.php?ref=1106" target="_blank">/Assignment 1/api/results.php?ref=1106</a></td>
                        <td>Returns the race results for the specified race</td>
                    </tr>
                    <tr>
                        <td><a href="api/results.php?driver=max_verstappen" target="_blank">/Assignment 1/api/results.php?driver=max_verstappen</a></td>
                        <td>Returns all results for the given driver (Max Verstappen)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 F1 Dashboard Project - COMP3512</p>
    </footer>
</body>
</html>
