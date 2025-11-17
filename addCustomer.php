<?php
require_once __DIR__ . '/config.php';

use Models\Customer;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nic_passport = trim($_POST['nic_passport'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');


    if ($nic_passport === '') {
        echo json_encode(['status' => 'error', 'message' => 'NIC/Passport is required.']);
        exit;
    }
    if ($name === '') {
        echo json_encode(['status' => 'error', 'message' => 'Name is required.']);
        exit;
    }
    if ($phone === '') {
        echo json_encode(['status' => 'error', 'message' => 'Phone is required.']);
        exit;
    }
    if ($email === '') {
        echo json_encode(['status' => 'error', 'message' => 'Email is required.']);
        exit;
    }
    if ($address === '') {
        echo json_encode(['status' => 'error', 'message' => 'Address is required.']);
        exit;
    }

    try {
        $id = Customer::create([
            'nic_passport' => $nic_passport,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address
        ]);
        echo json_encode([
            'status' => 'success',
            'message' => "Customer created successfully (ID: $id)",
            'id' => $id
        ]);
    } catch (\Throwable $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}
?>
