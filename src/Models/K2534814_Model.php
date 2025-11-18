<?php
namespace Models;
use Utils\MysqliDatabase;

class K2534814_Model
{
    public $id;
    public $name;

    public static function all()
    {
        $db = get_db();
        return $db->fetchAll("SELECT * FROM K2534814_models ORDER BY id");
    }

    public static function find($id)
    {
        $db = get_db();
        return $db->fetchOne("SELECT * FROM K2534814_models WHERE id = " . (int)$id);
    }

    public static function create($data)
    {
        $db = get_db();
        $stmt = $db->prepare("INSERT INTO K2534814_models (name) VALUES (?)");
        $name = $data['name'];
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $id = $db->insertId();
        $stmt->close();
        return $id;
    }   

    public static function update($id, $data)
    {
        $db = get_db();
        $stmt = $db->prepare("UPDATE K2534814_models SET name = ? WHERE id = ?");
        $name = $data['name'];
        $stmt->bind_param('si', $name, $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public static function delete($id)
    {
        $db = get_db();
        $stmt = $db->prepare("DELETE FROM K2534814_models WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}