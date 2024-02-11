<?php
/**
 *  Provide the full attributes in JSON of an item by item id
 */

header('Content-Type: application/json');

$host = 'localhost:3306';
$db   = 'db_seller2';
$user = 'root';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$item_id = $_GET['item_id'];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->prepare('SELECT * FROM ITEM WHERE item_id = ?');
    $stmt->execute([$item_id]);

    $item_details = $stmt->fetch();

    if($item_details) {
        echo json_encode($item_details);
    } else {
        echo json_encode(["error" => "Item not found."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database Connection Failed: " . $e->getMessage()]);
}
?>

