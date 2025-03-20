<?php
require_once __DIR__ . '/../../php/src/helpers.php';
require_once __DIR__ . '/../../php/src/config.php';

$eventId = $_GET['id'] ?? null;

$sql = "SELECT * FROM events WHERE event_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $event = $result->fetch_assoc();
    echo json_encode($event);
} else {
    echo json_encode(['error' => 'true']);
}

$stmt->close();
$conn->close();
?>