<?php
namespace Utils;

class MysqliDatabase
{
    private $mysqli;

    public function __construct($host, $user, $pass, $db)
    {
        $this->mysqli = new \mysqli($host, $user, $pass, $db);
        if ($this->mysqli->connect_errno) {
            throw new \RuntimeException('MySQL connection error: ' . $this->mysqli->connect_error);
        }
        $this->mysqli->set_charset('utf8mb4');
    }

    public function query($sql)
    {
        $res = $this->mysqli->query($sql);
        if ($res === false) {
            throw new \RuntimeException('MySQL query error: ' . $this->mysqli->error . ' -- SQL: ' . $sql);
        }
        return $res;
    }

    public function fetchAll($sql)
    {
        $res = $this->query($sql);
        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        $res->free();
        return $rows;
    }

    public function fetchOne($sql)
    {
        $res = $this->query($sql);
        $row = $res->fetch_assoc();
        $res->free();
        return $row ?: null;
    }

    public function prepare($sql)
    {
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException('MySQL prepare error: ' . $this->mysqli->error . ' -- SQL: ' . $sql);
        }
        return $stmt;
    }

    public function escape($value)
    {
        return $this->mysqli->real_escape_string($value);
    }

    public function insertId()
    {
        return $this->mysqli->insert_id;
    }

    public function beginTransaction()
    {
        $this->mysqli->begin_transaction();
    }

    public function commit()
    {
        $this->mysqli->commit();
    }

    public function rollback()
    {
        $this->mysqli->rollback();
    }
}
