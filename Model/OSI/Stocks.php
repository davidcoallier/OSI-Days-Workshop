<?php

class Model_OSI_Stocks extends Model_OSI_Db
{
    private $db;
    
    public function __construct()
    {
        $this->db = Frapi_Database::getInstance();
    }
    
    public function add($portfolioId, $name)
    {
        $sql = "INSERT INTO stocks VALUES (null, $portfolioId, '$name');";
        return $this->db->exec($sql);
    }
    
    public function getAll()
    {
        $sql = "SELECT * FROM stocks";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function get($portfolioId)
    {
        $sql = "
            SELECT * 
             FROM stocks 
              WHERE portfolio_id = $portfolioId";
              
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getStockPrices($portfolioId)
    {
        $stocks = $this->get($portfolioId);
        $return = array();
        foreach ($stocks as $key => $stock) {
            $return[$key] = $stock;
            
            $return[$key]['meta'] = $this->getStockPrice(
                $stock['name']
            );
        }
        
        return $return;
        
    }
    
    public function getStockPrice($name)
    {        
        $url = http_build_query(array(
            's' => $name,
            'f' => 'price',
        ));
        
        $url = 'http://finance.yahoo.com/d/quotes.csv?' . $url;

        $content = file_get_contents($url);
        $csv = str_getcsv($content, ',');
        
        if (isset($csv[0])) {
            $return['price'] = $csv[0];
        }
        
        if (isset($csv[3])) {
            $return['fluctuation'] = $csv[3];
        }
        
        return $return;
    }
}