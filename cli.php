<?php
require_once __DIR__ . '/config.php';

use Models\K2534814_Car;
use Models\K2534814_Customer;
use Models\K2534814_Reservation;
use Models\K2534814_Invoice;

$argv0 = $argv[0] ?? 'cli.php';
$cmd = $argv[1] ?? '';

function help()
{
    echo "EcoRide CLI - commands:\n";
    echo "  php cli.php list-cars\n";
    echo "  php cli.php add-car \"Model\" \"Category\" daily_price free_km extra_km_charge tax_rate status\n";
    echo "  php cli.php register-customer NIC Name Phone Email\n";
    echo "  php cli.php book customer_id Category start_date end_date total_km\n";
    echo "  php cli.php list-reservations\n";
    echo "  php cli.php generate-invoice reservation_id\n";
}

try {
    switch ($cmd) {
        case 'list-cars':
            $cars = K2534814_Car::all();
            foreach ($cars as $c) {
                echo "[{$c['id']}] {$c['model']} | {$c['category']} | LKR {$c['daily_price']} | Status: {$c['status']}\n";
            }
            break;

        case 'add-car':
            if (!isset($argv[2])) { help(); exit; }
            $data = [
                'model' => $argv[2],
                'category' => $argv[3] ?? 'Compact Petrol',
                'daily_price' => $argv[4] ?? 5000,
                'free_km' => $argv[5] ?? 100,
                'extra_km_charge' => $argv[6] ?? 50,
                'tax_rate' => $argv[7] ?? 10,
                'status' => $argv[8] ?? 'Available'
            ];
            $id = K2534814_Car::create($data);
            echo "Car created with id: $id\n";
            break;

        case 'register-customer':
            if (!isset($argv[2])) { help(); exit; }
            $data = [
                'nic_passport' => $argv[2],
                'name' => $argv[3] ?? '',
                'phone' => $argv[4] ?? '',
                'email' => $argv[5] ?? ''
            ];
            $id = K2534814_Customer::create($data);
            echo "Customer registered with id: $id\n";
            break;

        case 'book':
            if (!isset($argv[2])) { help(); exit; }
            $data = [
                'customer_id' => (int)$argv[2],
                'category' => $argv[3] ?? '',
                'start_date' => $argv[4] ?? '',
                'end_date' => $argv[5] ?? '',
                'total_km' => $argv[6] ?? 0
            ];
            $rid = K2534814_Reservation::create($data);
            echo "Reservation created with id: $rid\n";
            break;

        case 'list-reservations':
            $db = get_db();
            $rows = $db->fetchAll("SELECT r.*, c.name AS customer_name, ca.model AS car_model FROM K2534814_reservations r LEFT JOIN K2534814_customers c ON r.customer_id = c.id LEFT JOIN K2534814_cars ca ON r.car_id = ca.id ORDER BY r.id DESC");
            foreach ($rows as $r) {
                echo "[{$r['id']}] Booking: {$r['booking_id']} | Customer: {$r['customer_name']} | Car: {$r['car_model']} | {$r['start_date']} to {$r['end_date']} | Status: {$r['status']}\n";
            }
            break;

        case 'generate-invoice':
            if (!isset($argv[2])) { help(); exit; }
            $info = K2534814_Invoice::generateFromReservation((int)$argv[2]);
            echo "Invoice ID: {$info['invoice_id']}\n";
            echo "Car: {$info['car']['model']} ({$info['car']['category']})\n";
            echo "Days: {$info['reservation']['days']} | Base: LKR {$info['base']}\n";
            echo "Extra Km: {$info['extra_km']} -> LKR {$info['extra_charge']}\n";
            echo "Discount: LKR {$info['discount']}\n";
            echo "Tax: LKR {$info['tax']}\n";
            echo "Deposit: LKR {$info['deposit']}\n";
            echo "Total Payable: LKR {$info['total']}\n";
            break;

        default:
            help();
            break;
    }
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
