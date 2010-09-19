<?php

class Model_OSI_Portfolios extends Model_OSI_Db
{
    private $db;
    
    public function __construct()
    {
        $this->db = Frapi_Database::getInstance();
    }
    
    public function add($user_id, $name)
    {
        $sql = "
           INSERT INTO portfolios 
           VALUES (null, $user_id, '$name');
        ";
        
        return $this->db->exec($sql);
    }
    
    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM portfolios WHERE user_id = $userId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMetaByUserId($userId)
    {
        $model = new Model_OSI_Stocks();
        $stocks = array();
        
        $info = $this->getByUserId($userId);

        foreach ($info as $key => $portfolio) {
            $stocks[$key] = $portfolio;
            $stocks[$key]['meta'] = $model->getStockPrices(
                $portfolio['id']
            );
        }
        
        return $stocks;
    }
}