<?php
require_once 'connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'POST only']);
    exit;
}

$label = trim($_POST['label'] ?? '');

if ($label === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'No category selected']);
    exit;
}

$stmt = $conn->prepare("UPDATE chart_data SET `value` = `value` + 1 WHERE label = ?");
$stmt->bind_param("s", $label);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Category not found']);
    exit;
}

echo json_encode(['success' => true]);