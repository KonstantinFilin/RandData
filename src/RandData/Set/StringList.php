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
    public function __construct($values = [ "abc", "def", "ghi", "klm", "nop" ])
    {
        $this->setValues($values);
    }
    
    /**
     * Returns value by its possibility
     * @return string Value from the list
     */
    public function getPossibility()
    {
        $flipped = array_flip($this->possibility);
        ksort($flipped);
        $randVal = rand(1, 100);
        $sumAcc = 0;
        $ret = $this->values[0];
        
        foreach ($flipped as $probability => $key) {
            if ($randVal <= $probability + $sumAcc) {
                $ret = $this->values[$key];
            } else {
                $sumAcc += $probability;
            }
        }

        return $ret;
    }

    /**
     * Returns if random value should be by given possibility
     */
    public function getByPossibility()
    {
        return $this->possibility
            && array_keys($this->possibility) == array_keys($this->getValues())
            && array_sum($this->possibility) == 100;
    }
    
    /**
     * @inherit
     */
    public function get()
    {
        $values = $this->getValues();

        if (!$values) {
            throw new \InvalidArgumentException("Empty string list");
        }
        
        if ($this->getByPossibility()) {
            return $this->getPossibility();
        }
        
        $key = array_rand($values);
        return $values[$key];
    }
    
    /**
     * Returns available values
     * @return array Available values
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Sets available values
     * @param array $values Available values
     */
    public function setValues($values)
    {
        $this->values = is_array($values) ? $values : explode(",", (string) $values) ;
    }

    /**
     * Sets available values possibility
     * @param array $possibility Values possibility in format Field => possibility.
     * Sum of all possibility must be 100 equal
     */
    public function setPossibility($possibility)
    {
        $this->possibility = $possibility;
    }
        
    /**
     * @inherit
     */
    public function init($params = [])
    {
        if (!empty($params["values"])) {
            $this->setValues($params["values"]);
        }

        if (!empty($params["possibility"])) {
            $this->setPossibility($params["possibility"]);
        }
    }
}
