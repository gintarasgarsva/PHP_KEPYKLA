<?php

namespace App\Drinks;

class Model {
    
    private $db;
    private $table_name = 'drinks';

    public function __construct() {
        $this->db = new \Core\FileDB(DB_FILE);
        $this->db->load();
        $this->db->createTable($this->table_name);
    }
    
    public function insert(Drink $drink){
        if (isset($drink)){
            return true;
        } else{
            return false;
        }
    }

}
