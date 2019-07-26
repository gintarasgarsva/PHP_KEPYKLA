<?php

namespace App\Drinks;

class Model {
    
    private $db;
    private $table_name = 'drinks';

    public function __construct($dataBase) {
                
        \App\App::$db = $dataBase;        
        \App\App::$db->load();
        \App\App::$db->createTable($this->table_name);
    }
    
    public function insert(Drink $drink){
       return \App\App::$db->insertRow($this->table_name, $drink->getData());
    }
    
    public function get($conditions = []){
        $drinks = [];
        $rows = \App\App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row_data){
            $row_data['id'] = $row_id;
            $drinks[] = new Drink($row_data);
        }
        return $drinks;       
    }
    
    public function update(Drink $drink){
       return \App\App::$db->updateRow($this->table_name, $drink->getId(), $drink->getData());
    }
    
    public function delete(Drink $drink){
        return \App\App::$db->deleteRow($this->table_name, $drink->getId());
    }


    public function __destruct() {
        \App\App::$db->save();
    }

}
