<?php
namespace Models;

class Reservation
{
    const DEPOSIT = 5000;

    public static function create($data)
    {
        $db = get_db();

        $start = new \DateTime($data['start_date']);
        $now = new \DateTime();
        $interval = $now->diff($start);
        $category = $db->escape($data['category']);
        $car = $db->fetchOne("SELECT * FROM cars WHERE category = '" . $category . "' AND status = 'Available' LIMIT 1");
        if (!$car) {
            throw new \RuntimeException('No available car found for category ' . $data['category']);
        }

        $end = new \DateTime($data['end_date']);
        $days = $start->diff($end)->days + 1;
        if ($days <= 0) {
            throw new \InvalidArgumentException('Invalid rental period.');
        }

        

        $booking_id = 'B' . time() . rand(100, 999);
        $created = date('Y-m-d H:i:s');
        $total_km = (int)$data['total_km'];
        $status = 'Confirmed';
        $sql = sprintf(
            "INSERT INTO reservations (booking_id, customer_id, car_id, category, start_date, end_date, days, total_km, deposit, status, created_at) VALUES ('%s', %d, %d, '%s', '%s', '%s', %d, %d, %d, '%s', '%s')",
            $db->escape($booking_id),
            (int)$data['customer_id'],
            (int)$car['id'],
            $db->escape($data['category']),
            $db->escape($data['start_date']),
            $db->escape($data['end_date']),
            $days,
            $total_km,
            self::DEPOSIT,
            $db->escape($status),
            $db->escape($created)
        );
        $db->query($sql);
        $resId = $db->insertId();

        \Models\Car::updateStatus($car['id'], 'Reserved');

        return $resId;
    }

    public static function find($id)
    {
        $db = get_db();
        return $db->fetchOne("SELECT * FROM reservations WHERE id = " . (int)$id);
    }

    public static function findByBookingId($booking_id)
    {
        $db = get_db();
        $escaped = $db->escape($booking_id);
        return $db->fetchOne("SELECT * FROM reservations WHERE booking_id = '" . $escaped . "'");
    }

    public static function listByDate($date)
    {
        $db = get_db();
        $escaped = $db->escape($date);
        return $db->fetchAll("SELECT * FROM reservations WHERE start_date = '" . $escaped . "'");
    }
}
