<?php
// Pour test mes requetes AJAX

$test_username = "test";
$test_password = "test";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $name = $_POST['username'];
        $password = $_POST['password'];
    } else {
        http_response_code(403);
        exit(); // Terminer le script pour éviter toute exécution supplémentaire
    }

    if ($name == $test_username && $password == $test_password) {
        $data = [
            'success' => true,
            'message' => 'Login successful'
        ];
    } else {
        $data = [
            'success' => false,
        ];
        if ($name != $test_username) {
            $data['message'] = 'Username not found';
        } else {
            $data['message'] = 'Incorrect password';
        }
    }

    $jsonData = json_encode($data);

    // Set the content type header
    header('Content-Type: application/json');

    // Output the JSON data
    echo $jsonData;
}
?>