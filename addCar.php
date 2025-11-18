<?php
require_once __DIR__ . '/config.php';

use Models\K2534814_Car;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = trim($_POST['model'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $daily_price = trim($_POST['daily_price'] ?? '');
    $status = trim($_POST['status'] ?? '');
    $free_km = trim($_POST['free_km'] ?? '');
    $extra_km_charge = trim($_POST['extra_km_charge'] ?? '');
    $tax_rate = trim($_POST['tax_rate'] ?? '');


    if ($model === '') {
        echo json_encode(['status' => 'error', 'message' => 'Model is required.']);
        exit;
    }
    if ($category === '') {
        echo json_encode(['status' => 'error', 'message' => 'Category is required.']);
        exit;
    }
    if ($daily_price === '') {
        echo json_encode(['status' => 'error', 'message' => 'Daily Price is required.']);
        exit;
    }
    if ($status === '') {
        echo json_encode(['status' => 'error', 'message' => 'Status is required.']);
        exit;
    }
    if ($free_km === '') {      
        echo json_encode(['status' => 'error', 'message' => 'Free Km is required.']);
        exit;
    }
    if ($extra_km_charge === '') {
        echo json_encode(['status' => 'error', 'message' => 'Extra Km Charge is required.']);
        exit;
    }
    if ($tax_rate === '') {
        echo json_encode(['status' => 'error', 'message' => 'Tax Rate is required.']);
        exit;
    }

    

    try {
        $id = K2534814_Car::create([
            'model' => $model,
            'category' => $category,    
            'daily_price' => $daily_price,
            'free_km' => $free_km,
            'extra_km_charge' => $extra_km_charge,
            'tax_rate' => $tax_rate,
            'status' => $status
        ]);
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
