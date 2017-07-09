<?php

namespace RandData\Set\ru_RU;

class Address extends \RandData\Set
{
    protected $showFlat = 1;
            
    public function get() {
        $obj1 = new Street();
        $ret = [
            $obj1->get(),
            "д. " . rand(1, 100)
        ];
        
        if ($this->showFlat) {
            $ret[] = "кв. " . rand(1, 500);
        }
                
        return implode(", ", $ret);
    }

    public function init($params = array()) {
        if (!empty($params["show_flat"])) {
            $this->showFlat = $params["show_flat"];
        } else {
            $this->showFlat = 0;
        }
    }
}
