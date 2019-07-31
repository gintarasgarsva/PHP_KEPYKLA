<?php

namespace App\Drinks;

class StrongDrink extends Drink {

     // su this-> naudojam arba this arba parent(geriau this)
    public function drink() {
        $this->setAmount($this->getAmount() - 50);
    }
    
    
    // su parent::
//    public function drink() {
//        parent::setAmount(parent::getAmount() - 50);
//    }

}
