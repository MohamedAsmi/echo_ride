<?php
namespace Models;

class Invoice
{
    public static function generateFromReservation($reservation_id)
    {
        $db = get_db();
        $res = $db->fetchOne("SELECT * FROM reservations WHERE id = " . (int)$reservation_id);
        if (!$res) {
            throw new \RuntimeException('Reservation not found');
        }

        $car = $db->fetchOne("SELECT * FROM cars WHERE id = " . (int)$res['car_id']);
        if (!$car) {
            throw new \RuntimeException('Car not found');
        }

        $days = (int)$res['days'];
        $daily = (float)$car['daily_price'];
        $base = $daily * $days;

        // discount 10% on base if days >= 7
        $discount = 0.0;
        if ($days >= 7) {
            $discount = 0.10 * $base;
        }

        // extra km calculation
        $free_total = (int)$car['free_km'] * $days;
        $extra_km = max(0, (int)$res['total_km'] - $free_total);
        $extra_charge = $extra_km * (float)$car['extra_km_charge'];

        // taxable amount
        $taxable = ($base - $discount) + $extra_charge;
        $tax = $taxable * ((float)$car['tax_rate'] / 100.0);

        $deposit = (int)$res['deposit'];
        $total_payable = $taxable + $tax - $deposit;
        if ($total_payable < 0) $total_payable = 0;

        // Insert invoice record
        $sql = sprintf(
            "INSERT INTO invoices (reservation_id, base_price, extra_km_charge, discount, tax, deposit, total, created_at) VALUES (%d, %.2f, %.2f, %.2f, %.2f, %d, %.2f, '%s')",
            (int)$res['id'],
            $base,
            $extra_charge,
            $discount,
            $tax,
            $deposit,
            $total_payable,
            date('Y-m-d H:i:s')
        );
        $db->query($sql);
        $invoiceId = $db->insertId();

        return [
            'invoice_id' => $invoiceId,
            'reservation' => $res,
            'car' => $car,
            'base' => $base,
            'discount' => $discount,
            'extra_km' => $extra_km,
            'extra_charge' => $extra_charge,
            'tax' => $tax,
            'deposit' => $deposit,
            'total' => $total_payable,
        ];
    }
}
