<?php
// Path: api/send_message.php
// https://claveille.web-edu.fr/api/send_message.php?message=Hello&vote_id=1
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['message']) && isset($_GET['vote_id'])) {
        $message = $_GET['message'];
        $vote_id = $_GET['vote_id'];
    } else {
        http_response_code(403);
        exit();
    }
}
// verifie si l'utilisateur a accès au vote
$stmt = $conn->prepare("SELECT * FROM vote WHERE id = ? AND ag_id IN (SELECT ag_id FROM user_ag WHERE user_id = ?)");
$stmt->bind_param("ii", $vote_id, $user_id);
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


$stmt = $conn->prepare("NSERT INTO `message` (`id`, `user_id`, `ag_id`, `message`) VALUES (NULL, ?, ?, ?)");
$stmt->bind_param("iis", $user_id, $vote_id, $message);
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