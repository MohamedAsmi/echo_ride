<?php
require_once __DIR__ . '/config.php';

use Models\Model;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        echo json_encode(['status' => 'error', 'message' => 'Model name is required.']);
        exit;
    }

    try {
        $id = Model::create(['name' => $name]);
        echo json_encode([
            'status' => 'success',
            'message' => "Model created successfully (ID: $id)",
            'id' => $id
        ]);
    } catch (\Throwable $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}
?>
