<?php

namespace App\Users;

use App\App;

class Model {
    
    private $db;
    private $table_name = 'user';

    public function __construct() {                                     
        App::$db->createTable($this->table_name);
    }
    
    public function insert(User $user){
       return App::$db->insertRow($this->table_name, $user->getData());
    }
    
    public function get($conditions = []){
        $users = [];
        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row_data){
            $row_data['id'] = $row_id;
            $users[] = new Drink($row_data);
        }
        return $users;       
    }
    
    public function update(User $user){
       return App::$db->updateRow($this->table_name, $user->getId(), $user->getData());
    }
    
    public function delete(User $user){
        return App::$db->deleteRow($this->table_name, $user->getId());
    }
    
    public function deleteAll(User $user){
       return App::$db->truncateTable($this->table_name, $user->getData());
    }


    public function __destruct() {
        App::$db->save();
    }

}