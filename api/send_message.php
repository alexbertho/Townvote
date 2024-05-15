<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message']) && isset($_POST['vote_id'])) {
        $message = $_POST['message'];
        $vote_id = $_POST['vote_id'];
    } else {
        http_response_code(403);
        exit();
    }
}
// verifie si l'utilisateur a accès au vote
$stmt = $conn->prepare("SELECT * FROM ag WHERE id = ? AND id IN (SELECT ag_id FROM user_ag WHERE user_id = ?)");
$stmt->bind_param("ii", $ag_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $data = [
        'success' => false,
        'message' => 'Vous n\'avez pas accès à ce vote'
    ];
    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();
    exit();
}


$stmt = $conn->prepare("INSERT INTO message (message, vote_id) VALUES (?, ?)");
$stmt->bind_param("si", $message, $vote_id);
$stmt->execute();
$stmt->close();

$data = [
    'success' => true,
    'message' => 'Message envoyé'
];

header('Content-Type: application/json');
echo json_encode($data);
$conn->close();
?>