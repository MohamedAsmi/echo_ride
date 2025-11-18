<?php
require_once __DIR__ . '/config.php';

use Models\K2534814_Reservation;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
$data = [
        'customer_id' => $_POST['customer_id'] ?? 0,
        'category' => $_POST['category'] ?? '',
        'start_date' => $_POST['start_date'] ?? '',
        'end_date' => $_POST['end_date'] ?? '',
        'total_km' => $_POST['total_km'] ?? 0
    ];
    try {
        $rid = K2534814_Reservation::create($data);
         echo json_encode([
            'status' => 'success',
            'message' => "Category created successfully (ID: $rid)",
            'id' => $rid        
        ]);
    } catch (\Throwable $e) {
      echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

       

}
?>
