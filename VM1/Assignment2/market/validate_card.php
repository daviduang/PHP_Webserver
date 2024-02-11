<?php
/**
 * Bank token validation
 */

// Include the JWT library
require_once('../vendor/autoload.php');
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

// Secret key to verify JWT's signature
$key = "my_secret_key";

// Function to authenticate and validate the JWT token
function authenticate_token() {
    
    global $key;
    
    // Extract JWT from the Authorization header
    if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
        // Return a 400 Bad Request response if the Authorization header is missing or malformed
        http_response_code(400);
        echo 'Token not found in request';
        exit;
    }

    // Check if JWT exists
    $jwt = $matches[1];
    if (! $jwt) {
        // Return a 400 Bad Request response if the JWT is missing
        http_response_code(400);
        exit;
    }
    
    try {
        // Decode the token
        $token = JWT::decode($jwt, new Key($key, 'HS512'));
        
        // Validate the token
        $now = new DateTimeImmutable();
        
        if ($token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp()) {
            // Return a 401 Unauthorized response if the token is invalid or expired
            http_response_code(401);
            echo 'Invalid Token';
            exit;
        }
    } catch (Exception $e) {
        // Return a 401 Unauthorized response if token validation fails
        http_response_code(401);
        echo 'Token validation failed: ' . $e->getMessage();
        exit;
    }

    // Return the user id for validation
    return $token->user_id;
}
?>
