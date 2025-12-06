<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// connect to database
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

if ($lookup === "cities") {
    // CITY LOOKUP QUERY
    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");
    $stmt->bindValue(':country', "%$country%");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // OUTPUT CITIES TABLE
    echo "<table border='1'>
            <tr>
                <th>City</th>
                <th>District</th>
                <th>Population</th>
            </tr>";

    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['district']}</td>
                <td>{$row['population']}</td>
            </tr>";
    }

    echo "</table>";
} else {
    // COUNTRY LOOKUP QUERY
    $stmt = $conn->prepare("
        SELECT name, continent, independence_year, head_of_state
        FROM countries
        WHERE name LIKE :country
    ");
    $stmt->bindValue(':country', "%$country%");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // OUTPUT COUNTRIES TABLE
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>";

    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['continent']}</td>
                <td>{$row['independence_year']}</td>
                <td>{$row['head_of_state']}</td>
            </tr>";
    }

    echo "</table>";
}
?>
