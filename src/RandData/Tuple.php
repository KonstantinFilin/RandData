<?php

namespace RandData;

class Tuple 
{
    protected $dataSets;
    
    function __construct() 
    {
        $this->dataSets = [];
    }
    
    public function addDatasetFromStr($str) {
        $fabric = new Fabric();
        $this->addDataset($fabric->createObjectFromString($str));
    }
    
    public function addDataset(Set $set) {
        $this->dataSets[] = $set;
    }
    
    function getDataSets() {
        return $this->dataSets;
    }

    public function get($cnt = 0)
    {
        $ret = [];
        
        foreach ($this->dataSets as $set) {
            if ($set instanceof Set\Counter) {
                $ret[] = $set->get($cnt);
            } elseif ($set instanceof Set) {
                $ret[] = $set->get();
            }
        }
        
        return $ret;
    }
}
