<?php

namespace RandData\Set;

class StringList extends \RandData\Set
{
    protected $values;
    protected $possibility;
    
    function __construct($values = [ "abc", "def", "ghi", "klm", "nop" ]) {
        $this->values = $values;
    }
    
    public function getPossibility() {
        $flipped = array_flip($this->possibility);
        ksort($flipped);
        $randVal = rand(1, 100);
        $sumAcc = 0;
        
        foreach ($flipped as $probability => $key) {
            if ($randVal <= $probability + $sumAcc) {
                return $this->values[$key];
            } else {
                $sumAcc += $probability;
            }
        }

        return $this->values[0];
    }

    public function get() {
        if ($this->possibility 
            && array_keys($this->possibility) == array_keys($this->values)
            && array_sum($this->possibility) == 100
        ) {
            return $this->getPossibility();
        }
        
        $key = array_rand($this->values);
        return $this->values[$key];
    }
    
    function getValues() {
        return $this->values;
    }

    function setValues($values) {
        $this->values = $values;
    }

    function setPossibility($possibility) {
        $this->possibility = $possibility;
    }
        
    public function init($params = []) {
        if (!empty($params["values"])) {
            $this->setValues($params["values"]);
        }

        if (!empty($params["possibility"])) {
            $this->setPossibility($params["possibility"]);
        }
    }
}
