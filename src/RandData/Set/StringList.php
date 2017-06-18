<?php

namespace RandData\Set;

/**
 * Random string from list
 */
class StringList extends \RandData\Set
{
    /**
     * Available values
     * @var array
     */
    protected $values;
    
    /**
     * Values possibility
     * @var array
     */
    protected $possibility;
    
    /**
     * Class constructor
     * @param array $values Available values
     */
    function __construct($values = [ "abc", "def", "ghi", "klm", "nop" ]) {
        $this->values = $values;
    }
    
    /**
     * Returns value by its possibility
     * @return string Value from the list
     */
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

    /**
     * @inherit
     */
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
    
    /**
     * Returns available values
     * @return array Available values
     */
    function getValues() {
        return $this->values;
    }

    /**
     * Sets available values
     * @param array $values Available values
     */
    function setValues($values) {
        $this->values = $values;
    }

    /**
     * Sets available values possibility
     * @param array $possibility Values possibility in format Field => possibility. 
     * Sum of all possibility must be 100 equal
     */
    function setPossibility($possibility) {
        $this->possibility = $possibility;
    }
        
    /**
     * @inherit
     */
    public function init($params = []) {
        if (!empty($params["values"])) {
            $this->setValues($params["values"]);
        }

        if (!empty($params["possibility"])) {
            $this->setPossibility($params["possibility"]);
        }
    }
}
