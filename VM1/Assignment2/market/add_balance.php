<?php
/**
 * Perform a balance update operation for a user in the market database.
 */

// Include the validate_card.php file for token authentication
require_once('validate_card.php');

// Authenticate the user's token and retrieve the user's ID
$token_user_id = authenticate_token();

// Database connection details for the market database
$host_market = 'localhost:3306';
$db_market = 'db_market';
$user_market = 'root';
$pass_market = 'password';
$charset_market = 'utf8mb4';

// Create a DSN (Data Source Name) for the database connection
$dsn_market = "mysql:host=$host_market;dbname=$db_market;charset=$charset_market";

// PDO (PHP Data Objects) options for the database connection
$options_market = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Establish a database connection to the market database
    $pdo_market = new PDO($dsn_market, $user_market, $pass_market, $options_market);

    // Check if 'amount' and 'user_id' are provided in the POST request
    if (!isset($_POST['amount']) || !isset($_POST['user_id'])) {
        
        // Return a 400 Bad Request response code if required parameters are missing
        http_response_code(400);
        echo json_encode(["error" => "Both amount and user_id must be provided."]);
        exit;
    }

    // Retrieve 'amount' and 'user_id' from the POST request
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];

    // Check if the user ID from the token matches the user ID from the request
    if ($token_user_id != $user_id) {
        
        // Return a 403 Forbidden response code for invalid credentials
        http_response_code(403);
        echo json_encode(["error" => "Invalid Credential."]);
        exit;
    }

    // If the 'amount' is negative, return a 400 Bad Request response code
    if ($amount < 0) {
        
        http_response_code(400);
        echo json_encode(["error" => "Invalid amount. Amount should be a non-negative value."]);
        exit;
    }

    // If the 'amount' is zero, fetch and return the current balance
    if ($amount == 0) {
        $stmt = $pdo_market->prepare("SELECT balance FROM USER WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $balance = $stmt->fetchColumn();

        if ($balance === false) {
            
            // Return a 404 Not Found response code if the user is not found
            http_response_code(404);
            echo json_encode(["error" => "User not found."]);
            exit;
        }

        // Return a 200 OK response code with the user's balance
        echo json_encode(["user_id" => $user_id, "balance" => $balance]);
        exit;
    }

    // Update the user's balance
    $stmt = $pdo_market->prepare("UPDATE USER SET balance = balance + ? WHERE user_id = ?");
    $stmt->execute([$amount, $user_id]);

    // Fetch and return the new balance after the update
    $stmt = $pdo_market->prepare("SELECT balance FROM USER WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $new_balance = $stmt->fetchColumn();

    // Return a 200 OK response code with a success message and the new balance
    echo json_encode(["success" => "Balance updated successfully", "user_id" => $user_id, "balance" => $new_balance]);

} catch (PDOException $e) {
    
    // Return a 500 Internal Server Error response code for database-related errors
    http_response_code(500);
    echo json_encode(["error" => "Database operation failed: " . $e->getMessage()]);
} catch (Exception $e) {
    
    // Return a 500 Internal Server Error response code for other exceptions
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
