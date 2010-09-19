<?php

class Model_OSI_Db 
{
    private $db;
    
    public function __construct()
    {
        $this->db = Frapi_Database::getInstance();
    }
}