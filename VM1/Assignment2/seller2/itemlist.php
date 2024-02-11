<?php
header('Content-Type: text/xml');

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

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->query('SELECT item_id, item_name, price_of_unit FROM ITEM');

    echo "<root>";
    while ($row = $stmt->fetch()) {
        echo "<item>";
        echo "<itemid>{$row['item_id']}</itemid>";
        echo "<itemname>{$row['item_name']}</itemname>";
        echo "<price>{$row['price_of_unit']}</price>";
        echo "</item>";
    }
    echo "</root>";
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
