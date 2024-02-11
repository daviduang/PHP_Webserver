<?php
/**
 * Cancel a purchase for a user.
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

    if (!isset($_GET['pur_id'])) {
        
        // Return a 400 Bad Request response code for missing pur_id
        http_response_code(400);
        throw new Exception("pur_id must be provided.");
    }
    
    $pur_id = $_GET['pur_id'];

    // Fetch the purchase details
    $stmt = $pdo_market->prepare("SELECT * FROM PURCHASE WHERE pur_id = ?");
    $stmt->execute([$pur_id]);

    $purchase = $stmt->fetch();

    if (!$purchase) {
        
        // Return a 404 Not Found response code for a purchase not found
        http_response_code(404);
        throw new Exception("Purchase not found.");
    }

    // Begin a database transaction
    $pdo_market->beginTransaction();

    // Refund the user's balance
    $stmt_refund = $pdo_market->prepare("UPDATE USER SET balance = balance + ? WHERE user_id = ?");
    $stmt_refund->execute([$purchase['price'], $purchase['user_id']]);

    // Delete the purchase record
    $stmt_delete = $pdo_market->prepare("DELETE FROM PURCHASE WHERE pur_id = ?");
    $stmt_delete->execute([$pur_id]);

    // Commit the transaction
    $pdo_market->commit();

    // Return a 200 OK response code with a success message and the deleted purchase record
    echo json_encode([
        'success' => 'Purchase canceled and amount refunded',
        'deleted_purchase' => $purchase
    ]);

} catch (PDOException $e) {
    // Rollback the transaction on database operation failure
    $pdo_market->rollBack();
    // Return a 500 Internal Server Error response code for database-related errors
    http_response_code(500);
    echo json_encode(["error" => "Database operation failed: " . $e->getMessage()]);
} catch (Exception $e) {
    // Return a 400 Bad Request response code for other exceptions
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
