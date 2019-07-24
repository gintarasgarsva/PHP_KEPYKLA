<?php

namespace App\Drinks;

class Model {
    private $fileDB;
    
    public function __construct() {
        
    $db = new \Core\FileDB();
    $data = getData();
    $table = createTable('drinks');
    
    
    }

}

