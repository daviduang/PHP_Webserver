<?php
/**
 * Verify banking details and generate a token for the corresponding user (token expires in 5 minutes).
 */

// Include the JWT library
require_once('../vendor/autoload.php');
use \Firebase\JWT\JWT;

// Database connection details for the banking database
$host_bank = 'localhost:3306';
$db_bank = 'db_bank';
$user_bank = 'root';
$pass_bank = 'password';
$charset_bank = 'utf8mb4';

// Create a DSN (Data Source Name) for the database connection
$dsn_bank = "mysql:host=$host_bank;dbname=$db_bank;charset=$charset_bank";

// PDO (PHP Data Objects) options for the database connection
$options_bank = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Secret key for JWT (JSON Web Token) generation
$secret_key = 'my_secret_key';

// Get user input (user_id, card_num, and pin) from POST request
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
$card_num = isset($_POST['card_num']) ? $_POST['card_num'] : null;
$pin = isset($_POST['pin']) ? $_POST['pin'] : null;

// Check if card_num and pin were provided
if (is_null($card_num) || is_null($pin)) {
    
    // Return a 400 Bad Request response if card_num or pin is missing
    http_response_code(400);
    echo json_encode(['error' => 'Both card_num and pin must be provided']);
    exit;
}

try {
    // Establish a database connection to the banking database
    $pdo_bank = new PDO($dsn_bank, $user_bank, $pass_bank, $options_bank);

    // Prepare and execute a query to verify the card_num and pin
    $stmt = $pdo_bank->prepare("SELECT 1 FROM CARD WHERE card_num = ? AND pin = ?");
    $stmt->execute([$card_num, $pin]);

    // If a row was fetched (card_num and pin are valid), generate a JWT
    if ($stmt->fetch()) {
        $issuedAt = time();
        $expirationTime = $issuedAt + 300;  // JWT valid for 300 seconds (5 minutes)
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'user_id' => $user_id  // Store user id in JWT
        ];

        // Generate the JWT using the payload and secret key
        $jwt = JWT::encode($payload, $secret_key, 'HS512');

        // Return a 200 OK response with the JWT as a JSON response
        http_response_code(200);
        echo json_encode(['success' => true, 'token' => $jwt]);
    } else {
        
        // If card_num and pin are not valid, return a 403 Forbidden response with a JSON response indicating failure
        http_response_code(403);
        echo json_encode(['success' => false]);
    }

} catch (PDOException $e) {
    
    // Handle any database-related errors and return a 500 Internal Server Error response with an error JSON response
    http_response_code(500);
    echo json_encode(["error" => "Database operation failed: " . $e->getMessage()]);
}
?>
