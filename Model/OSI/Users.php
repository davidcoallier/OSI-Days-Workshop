<?php

class Model_OSI_Users extends Model_OSI_Db
{
    private $db;
    
    public function __construct()
    {
        $this->db = Frapi_Database::getInstance();
    }
    
    public function add($name)
    {
        $sql = "INSERT INTO users VALUES (null, '$name');";
        return $this->db->exec($sql);
    }
    
    public function getAll()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function get($userId)
    {
        $sql = "SELECT * FROM users WHERE id = $userId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}