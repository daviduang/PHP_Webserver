<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        .service {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
        }
        .output-container {
            border: 1px dashed #ccc;
            padding: 10px;
            margin-top: 10px;
        }
        #authOutputContainer {
            word-wrap: break-word;
            max-width: 95%; /* adjust as needed */
        }

    </style>
</head>
<body>

<!-- Fetch Items Service -->
<div class="service">
    <h3>Service Name: Fetch Items</h3>
    <label for="fetchItemsAPI">Service API:</label>
    <input type="text" id="fetchItemsAPI" placeholder="Enter Fetch Items API"><br><br>
    <button id="fetchItemsButton">Fetch Items</button>
    <p>Service Status: <span id="fetchItemsStatus">0</span></p>
    <div class="output-container" id="fetchItemsOutput"></div>
</div>

<!-- Search Items Service -->
<div class="service">
    <h3>Service Name: Search Item</h3>
    <label for="searchItemsAPI">Service API:</label>
    <input type="text" id="searchItemsAPI" placeholder="Enter Search Item API"><br><br>
    <label for="searchItemInput">Search for Item:</label>
    <input type="text" id="searchItemInput" placeholder="Enter Item Name"><br><br>
    <button id="searchItemsButton">Search</button>
    <p>Service Status: <span id="searchItemsStatus">0</span></p>
    <div class="output-container" id="searchItemsOutput"></div>
</div>

<!-- Card Check Service -->
<div class="service">
    <h3>Service Name: Card Check</h3>
    <label for="cardCheckAPI">Service API:</label>
    <input type="text" id="cardCheckAPI" placeholder="Enter Card Check API"><br><br>
    <label for="card_num">Card Number:</label>
    <input type="text" id="card_num" placeholder="Enter Card Number"><br><br>
    <label for="pin">Pin:</label>
    <input type="password" id="pin" placeholder="Enter Pin"><br><br>
    <label for="userIDCard">User ID:</label>
    <input type="text" id="userIDCard" placeholder="Enter User ID"><br><br>
    <button id="cardCheckButton">Check Card</button>
    <p>Service Status: <span id="cardCheckStatus">0</span></p>
    <div class="output-container" id="cardCheckOutput"></div>
</div>

<!-- Purchase Service -->
<div class="service">
    <h3>Service Name: Purchase</h3>
    <label for="purchaseAPI">Service API:</label>
    <input type="text" id="purchaseAPI" placeholder="Enter Purchase API"><br><br>
    
    <label for="userID">User ID:</label>
    <input type="text" id="userID" placeholder="Enter User ID"><br><br>
    
    <label for="itemID">Item ID:</label>
    <input type="text" id="itemID" placeholder="Enter Item ID"><br><br>
    
    <label for="quantity">Quantity:</label>
    <input type="text" id="quantity" placeholder="Enter Quantity"><br><br>
    
    <label for="sellerIP">Seller IP:</label>
    <input type="text" id="sellerIP" placeholder="Enter Seller IP"><br><br>

    <label for="bearerToken">Bank Token:</label>
    <input type="text" id="bearerToken" placeholder="Enter Token"><br><br>
    
    <button id="purchaseButton">Make Purchase</button>
    <p>Service Status: <span id="purchaseStatus">0</span></p>
    <div class="output-container" id="purchaseOutput"></div>
</div>

<!-- Search Purchase Service -->
<div class="service">
    <h3>Service Name: Search Purchase</h3>

    <label for="searchPurchaseAPI">Service API:</label>
    <input type="text" id="searchPurchaseAPI" placeholder="Enter Search Purchase API"><br><br>

    <label for="pur_id">Purchase ID (Optional):</label>
    <input type="text" id="pur_id" placeholder="Enter Purchase ID"><br><br>

    <label for="user_id">User ID (Optional):</label>
    <input type="text" id="user_id" placeholder="Enter User ID"><br><br>

    <button type="submit" id="searchPurchaseButton">Search Purchase</button>

    <p>Service Status: <span id="searchPurchaseStatus">0</span></p>

    <div class="output_container" id="searchPurchaseOutput"></div>
</div>

<!-- Cancel Purchase Service -->
<div class="service">
    <h3>Service Name: Cancel Purchase</h3>
    <label for="cancelPurchaseAPI">Service API:</label>
    <input type="text" id="cancelPurchaseAPI" placeholder="Enter Cancel Purchase API"><br><br>
    <label for="pur_id_cancel">Purchase ID:</label>
    <input type="text" id="pur_id_cancel" placeholder="Enter Purchase ID"><br><br>
    <button id="cancelPurchaseButton">Cancel Purchase</button>
    <p>Service Status: <span id="cancelPurchaseStatus">0</span></p>
    <div class="output-container" id="cancelPurchaseOutput"></div>
</div>

<!-- Add Balance Service -->
<div class="service">
    <h3>Service Name: Add Balance</h3>
    <label for="addBalanceAPI">Service API:</label>
    <input type="text" id="addBalanceAPI" placeholder="Enter Add Balance API"><br><br>
    <label for="amount">Amount:</label>
    <input type="number" id="amount" placeholder="Enter Amount"><br><br>
    <label for="userId">User ID:</label>
    <input type="number" id="userId" placeholder="Enter User ID"><br><br>
    <label for="bankToken">Bank Token:</label>
    <input type="text" id="bankToken" placeholder="Enter Token"><br><br>
    <button id="addBalanceButton">Add Balance</button>
    <p>Service Status: <span id="addBalanceStatus">0</span></p>
    <div class="output-container" id="addBalanceOutput"></div>
</div>

<script>

// Fetch Items Service
document.getElementById('fetchItemsButton').addEventListener('click', function() {
    const apiEndpoint = document.getElementById('fetchItemsAPI').value;

    fetch(apiEndpoint, { method: 'GET' })
    .then(response => {
        document.getElementById('fetchItemsStatus').innerText = response.status;
        return response.text();
    })
    .then(data => {
        document.getElementById('fetchItemsOutput').innerText = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Search Item Service
document.querySelector('#searchItemsButton').addEventListener('click', function() {
    const searchAPI = document.querySelector('#searchItemsAPI').value;
    const searchQuery = document.querySelector('#searchItemInput').value;
    searchItems(searchAPI, searchQuery);
});

function searchItems(apiUrl, query) {
    fetch(`${apiUrl}?query=${encodeURIComponent(query)}`, {
        method: 'GET'
    })
    .then(response => {
        // Update service status with the HTTP status code
        document.querySelector('#searchItemsStatus').textContent = response.status;

        // Check if the response is successful
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        return response.json();
    })
    .then(data => {
        document.getElementById('searchItemsOutput').innerText = JSON.stringify(data, null, 2);
    })
    .catch(error => {
        console.error('Error:', error);
        document.querySelector('#searchItemsOutput').textContent = 'Failed to fetch search results. Please try again.';
    });
}

// Card check service
document.getElementById('cardCheckButton').addEventListener('click', function() {
    const apiEndpoint = document.getElementById('cardCheckAPI').value;
                                                            
    // Retrieve card details from the input fields
    const cardNum = document.getElementById('card_num').value;
    const pin = document.getElementById('pin').value;
    const userID = document.getElementById('userIDCard').value;

    // Structure the card data into an object
    const cardData = {
        card_num: cardNum,
        pin: pin,
        user_id: userID
    };
    
    // Make a POST request to the API with the card details
    fetch(apiEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams(cardData).toString()
    })
    .then(response => {
        
        document.getElementById('cardCheckStatus').innerText = response.status;
        return response.json();
    })
    .then(data => {
          
        document.getElementById('cardCheckOutput').innerText = JSON.stringify(data, null, 2);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('cardCheckStatus').innerText = 'Error';
        document.getElementById('cardCheckOutput').innerText = 'Failed to check the card.';
    });
});


// Purchase item service
document.getElementById('purchaseButton').addEventListener('click', function() {
    const apiEndpoint = document.getElementById('purchaseAPI').value;
    const userID = document.getElementById('userID').value;
    const itemID = document.getElementById('itemID').value;
    const quantity = document.getElementById('quantity').value;
    const sellerIP = document.getElementById('sellerIP').value;
    const bearerToken = document.getElementById('bearerToken').value;
    
    const purchaseData = {
        user_id: userID,
        item_id: itemID,
        quantity: quantity,
        seller_ip: sellerIP
    };

    fetch(apiEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': `Bearer ${bearerToken}` // Add Bearer Token to the request headers
        },
        body: new URLSearchParams(purchaseData).toString()
    })
    .then(response => {
       // Update service status with the HTTP status code
       document.querySelector('#purchaseStatus').textContent = response.status;
       
       return response.json();
    })
    .then(data => {
        document.getElementById('purchaseOutput').innerText = JSON.stringify(data, null, 2);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('purchaseStatus').innerText = 'Error';
        document.getElementById('purchaseOutput').innerText = 'Failed to make the purchase.';
    });
});


// Search purchased item service
document.getElementById('searchPurchaseButton').addEventListener('click', function() {
    const apiEndpoint = document.getElementById('searchPurchaseAPI').value;
    let pur_id = document.getElementById('pur_id').value;
    let user_id = document.getElementById('user_id').value;

    // Construct the URL with query parameters
    let url = new URL(apiEndpoint);

    if(pur_id) {
        url.searchParams.append('pur_id', pur_id);
    }
    if(user_id) {
        url.searchParams.append('user_id', user_id);
    }

    // Make a GET request to the API
    fetch(url)
    .then(response => {
        document.getElementById('searchPurchaseStatus').innerText = response.status;
        return response.json();
    })
    .then(data => {
        document.getElementById('searchPurchaseOutput').innerText = JSON.stringify(data, null, 2);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Cancel purchased item service
document.getElementById('cancelPurchaseButton').addEventListener('click', function() {
    const apiEndpoint = document.getElementById('cancelPurchaseAPI').value;
    let pur_id = document.getElementById('pur_id_cancel').value;

    // Construct the URL with query parameters
    let url = new URL(apiEndpoint);

    if(pur_id) {
        url.searchParams.append('pur_id', pur_id);
    }

    // Make a DELETE request to the API
    fetch(url, { method: 'DELETE' })
    .then(response => {
        document.getElementById('cancelPurchaseStatus').innerText = response.status;
        return response.json();
    })
    .then(data => {
        document.getElementById('cancelPurchaseOutput').innerText = JSON.stringify(data, null, 2);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Add balance service
document.getElementById('addBalanceButton').addEventListener('click', function() {
    const apiEndpoint = document.getElementById('addBalanceAPI').value;
    const amount = document.getElementById('amount').value;
    const user_id = document.getElementById('userId').value;
    const bearerToken = document.getElementById('bankToken').value;
    
    // Structure the user and amount data into an object
    const data = {
        amount: amount,
        user_id: user_id
    };

    // Set the bank token into header and request data into body
    fetch(apiEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': 'Bearer ' + bearerToken
        },
        body: new URLSearchParams(data)
    })
    .then(response => {
          
        // Fetch the response status code
        document.getElementById('addBalanceStatus').innerText = response.status;
        return response.json();
    })
    .then(data => {
          
        // Read the replied data
        document.getElementById('addBalanceOutput').innerText = JSON.stringify(data, null, 2);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});


</script>

</body>
</html>
