<?php

namespace RandData;

abstract class Tuple 
{
    protected $result;
    
    function __construct() 
    {
        $this->result = [];
    }

    public function get($cnt = 0)
    {
        $dataSets = $this->getDataSets();
                
        foreach ($dataSets as $fldName => $set) {
            if (is_string($set)) {
                $fabric = new Fabric();
                $set = $fabric->createObjectFromString($set);
            }
            
            if ($set instanceof Set\Counter) {
                $this->result[] = $set->get($cnt);
            } elseif ($set instanceof Set) {
                $this->result[] = $this->getValue($set, $fldName);
            }
        }
        
        return $this->result;
    }
    
    protected function getValue(Set $set, $fldName)
    {
        $value = mt_rand(1, 100);
        $fldProbability = $this->getValueNullProbability($fldName);

        if ($fldProbability > 0 && $value <= $fldProbability) {
            return null;
        }

        return $set->get();
    }
    
    protected function getValueNullProbability($fldName)
    {
        $nullProbabilityList = $this->getNullProbability();

        return !empty($nullProbabilityList[$fldName])
            ? $nullProbabilityList[$fldName]
            : 0;
    }

    protected function getNullProbability()
    {
        return [];
    }

    abstract function getDataSets();
    
    public function getHeaders()
    {
        $headers = array_keys($this->getDataSets());
        
        if ($headers == range(0, count($headers) - 1)) {
            return range(1, count($headers));
        }
        
        return $headers;
    }
}
