<?php
require_once __DIR__ . '/config.php';

use Models\K2534814_Category;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        echo json_encode(['status' => 'error', 'message' => 'Category name is required.']);
        exit;
    }

    try {
        $id = K2534814_Category::create(['name' => $name]);
        echo json_encode([
            'status' => 'success',
            'message' => "Category created successfully (ID: $id)",
            'id' => $id
        ]);
    } catch (\Throwable $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}
?>
