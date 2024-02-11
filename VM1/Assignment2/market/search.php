<?php
/**
 * Searching for an item through multiple sellers.
 */

// Retrieve the search query from the query string
$searchQuery = strtolower($_GET['query']);

// Define the list of seller web service APIs for searching
$sellers = [
    'https://lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/itemlist.php',
    'https://lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller2/itemlist.php',
    'https://lab-299b5d82-0c6f-40e1-a191-9f9b2e05db14.australiasoutheast.cloudapp.azure.com:7055/Assignment2/seller2/itemlist.php'
    // Add more seller URLs as needed
];

$mergedItems = [];

// Iterate through each seller URL to retrieve item listings
foreach ($sellers as $sellerUrl) {
    
    // Configure SSL context options to bypass SSL verification (for simplicity)
    $contextOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ]
    ];
    $context = stream_context_create($contextOptions);
    
    // Fetch XML data from the seller's API
    $xmlData = file_get_contents($sellerUrl, false, $context);
    $xml = simplexml_load_string($xmlData);
    
    // Merge item listings based on the search query
    foreach ($xml->item as $item) {
        if (strpos(strtolower($item->itemname), $searchQuery) !== false) {
            $mergedItems[] = [
                'sellerIP' => (string)$sellerUrl,
                'itemIP' => (string)$item->itemid,
                'itemName' => (string)$item->itemname,
                'price' => (float)$item->price
            ];
        }
    }
}

// Set the response content type to JSON
header('Content-Type: application/json');

if (empty($mergedItems)) {
    // Return a 404 Not Found response code if no items are found
    http_response_code(404);
    echo json_encode(['message' => 'No item is found']);
} elseif (count($mergedItems) == 1) {
    // Return a 200 OK response code with a message and item details if one item is found
    http_response_code(200);
    echo json_encode(['message' => '1 item found in 1 VM XML list', 'items' => $mergedItems]);
} else {
    // Return a 200 OK response code with a message and item details if multiple items are found
    http_response_code(200);
    echo json_encode(['message' => 'Multiple items found in separate lists', 'items' => $mergedItems]);
}
?>
