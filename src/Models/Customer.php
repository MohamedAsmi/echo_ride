<?php
namespace Models;

class Customer
{
    public $id;
    public $nic_passport;
    public $name;
    public $phone;
    public $email;
    public $created_at;
    
    public static function all()
    {
        $db = get_db();
        return $db->fetchAll("SELECT * FROM customers ORDER BY id");
    }

    public static function create($data)
    {
        $db = get_db();
        $stmt = $db->prepare("INSERT INTO customers (nic_passport, name, phone, email, created_at) VALUES (?, ?, ?, ?, ?)");
        $nic = $data['nic_passport'];
        $name = $data['name'];
        $phone = $data['phone'];
        $email = $data['email'];
        $created = date('Y-m-d H:i:s');
        $stmt->bind_param('sssss', $nic, $name, $phone, $email, $created);
        $stmt->execute();
        $id = get_db()->insertId();
        $stmt->close();
        return $id;
    }

    public static function findById($id)
    {
        $db = get_db();
        return $db->fetchOne("SELECT * FROM customers WHERE id = " . (int)$id);
    }

    public static function findByNameOrId($term)
    {
        $db = get_db();
        $escaped = $db->escape($term);
        return $db->fetchAll("SELECT * FROM customers WHERE name LIKE '%" . $escaped . "%' OR id = '" . $escaped . "'");
    }
}
