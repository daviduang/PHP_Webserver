<?php
/**
 * Forming a purchase for a user.
 */

// Set the Content-Type to application/json
header('Content-Type: application/json');

// Include the middleware for token authentication
require_once('validate_card.php');

// Authenticate the user's token and retrieve the user's ID
$token_user_id = authenticate_token();

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

// Retrieve input data from the POST request
$user_id = $_POST['user_id'];
$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
$seller_ip = $_POST['seller_ip'];

// Check if the user ID from the token matches the user ID from the request
if ($token_user_id != $user_id) {
    
    // Return a 403 Forbidden response code for invalid credentials
    http_response_code(403);
    echo json_encode(["error" => "Invalid Credential."]);
    exit;
}

// Fetch item details from the seller's item.php
$item_url = "https://$seller_ip/item.php?item_id=$item_id";

// Get the response through SSL with peer verification disabled
$contextOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]
];
$context = stream_context_create($contextOptions);
$item_response = file_get_contents($item_url, false, $context);
$item_data = json_decode($item_response, true);

if (isset($item_data['error'])) {
    
    // Return a 400 Bad Request response code for unable to fetch item details
    http_response_code(400);
    echo json_encode(["error" => "Unable to fetch item details."]);
    exit;
}

$price = $item_data['price_of_unit'];
$stock = $item_data['stock_qty'];

// Check if the item is out of stock
if ($quantity > $stock) {
    
    // Return a 400 Bad Request response code for insufficient stock
    http_response_code(400);
    echo json_encode(["error" => "Insufficient stock."]);
    exit;
}

$total_price = $price * $quantity;

try {
    // Establish a database connection to the market database
    $pdo_market = new PDO($dsn_market, $user_market, $pass_market, $options_market);

    // Begin a database transaction
    $pdo_market->beginTransaction();

    // Check user balance
    $stmt_balance = $pdo_market->prepare("SELECT balance FROM USER WHERE user_id = ?");
    $stmt_balance->execute([$user_id]);
    $user_balance = $stmt_balance->fetchColumn();

    // If the user's balance is not enough, return an error
    if ($user_balance < $total_price) {
        
        // Return a 400 Bad Request response code for insufficient balance
        http_response_code(400);
        echo json_encode(["error" => "Insufficient balance."]);
        $pdo_market->rollBack();
        exit;
    }

    // Deduct user balance
    $stmt_deduct = $pdo_market->prepare("UPDATE USER SET balance = balance - ? WHERE user_id = ?");
    $stmt_deduct->execute([$total_price, $user_id]);

    // Add a record to the PURCHASE table
    $stmt_purchase = $pdo_market->prepare("INSERT INTO PURCHASE (user_id, item_id, quantity, price, seller_ip, date) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt_purchase->execute([$user_id, $item_id, $quantity, $total_price, $seller_ip]);

    // Fetch the inserted purchase entry
    $purchase_id = $pdo_market->lastInsertId(); // Get the last inserted ID (Purchase ID)
    $stmt_fetch_purchase = $pdo_market->prepare("SELECT * FROM PURCHASE WHERE pur_id = ?");
    $stmt_fetch_purchase->execute([$purchase_id]);
    $purchase_data = $stmt_fetch_purchase->fetch();

    // Commit the transaction
    $pdo_market->commit();

    // Return a 200 OK response code with a success message and the purchase data
    echo json_encode(["success" => "Purchase successful.", "purchase" => $purchase_data]);

} catch (PDOException $e) {
    
    // Rollback the transaction on database operation failure
    $pdo_market->rollBack();
    
    // Return a 500 Internal Server Error response code for database-related errors
    http_response_code(500);
    echo json_encode(["error" => "Database operation failed: " . $e->getMessage()]);
}
?>
