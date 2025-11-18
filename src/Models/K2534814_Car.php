<?php
namespace Models;

use Utils\MysqliDatabase;


class K2534814_Car
{
    public $id;
    public $model;
    public $category;
    public $daily_price;
    public $free_km;
    public $extra_km_charge;
    public $tax_rate;
    public $status; // Available, Reserved, Under Maintenance

    public static function all()
    {
        $db = get_db();
        return $db->fetchAll("SELECT * FROM K2534814_cars ORDER BY id");
    }

    public static function find($id)
    {
        $db = get_db();
        return $db->fetchOne("SELECT * FROM K2534814_cars WHERE id = " . (int)$id);
    }

    public static function create($data)
    {
        $db = get_db();
        $stmt = $db->prepare("INSERT INTO K2534814_cars (model, category, daily_price, free_km, extra_km_charge, tax_rate, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $model = $data['model'];
        $category = $data['category'];
        $daily_price = (float)$data['daily_price'];
        $free_km = (int)$data['free_km'];
        $extra_km_charge = (float)$data['extra_km_charge'];
        $tax_rate = (float)$data['tax_rate'];
        $status = $data['status'];
        $stmt->bind_param('ssdidds', $model, $category, $daily_price, $free_km, $extra_km_charge, $tax_rate, $status);
        $stmt->execute();
        $id = $db->insertId();
        $stmt->close();
        return $id;
    }

    public static function updateStatus($id, $status)
    {
        $db = get_db();
        $stmt = $db->prepare("UPDATE K2534814_cars SET status = ? WHERE id = ?");
        $stmt->bind_param('si', $status, $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}
