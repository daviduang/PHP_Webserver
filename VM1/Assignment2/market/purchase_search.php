<?php
/**
 * Search purchase history for a user.
 */

// Database connection details for the market database
$host_market = 'localhost:3306';
$db_market = 'db_market';
$user_market = 'root';
$pass_market = 'password';
$charset_market = 'utf8mb4';

$dsn_market = "mysql:host=$host_market;dbname=$db_market;charset=$charset_market";
$options_market = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Establish a database connection to the market database
    $pdo_market = new PDO($dsn_market, $user_market, $pass_market, $options_market);
    
    $query = "SELECT * FROM PURCHASE WHERE ";
    $params = [];

    if (isset($_GET['pur_id'])) {
        $query .= "pur_id = ?";
        $params[] = $_GET['pur_id'];
    } elseif (isset($_GET['user_id'])) {
        $query .= "user_id = ?";
        $params[] = $_GET['user_id'];
    } else {
        // Return a 400 Bad Request response code for missing parameters
        http_response_code(400);
        throw new Exception("Either pur_id or user_id must be provided.");
    }

    $stmt = $pdo_market->prepare($query);
    $stmt->execute($params);

    $purchases = $stmt->fetchAll();

    // Set the Content-Type to application/json
    header('Content-Type: application/json');

    // Output the data as a JSON string
    echo json_encode($purchases);

} catch (PDOException $e) {
    // Return a 500 Internal Server Error response code for database operation failure
    http_response_code(500);
    echo json_encode(["error" => "Database operation failed: " . $e->getMessage()]);
} catch (Exception $e) {
    // Return a 400 Bad Request response code for other exceptions
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
