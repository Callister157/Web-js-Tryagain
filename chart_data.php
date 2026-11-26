<?php
require_once 'connection.php';

header('Content-Type: application/json');

$labels = [];
$values = [];

$result = $conn->query("SELECT label, `value` FROM chart_data ORDER BY id");

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['label'];
    $values[] = (int)$row['value'];
}

echo json_encode(['labels' => $labels, 'values' => $values]);