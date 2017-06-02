<?php

namespace RandData;

class Tuple 
{
    protected $dataSets;
    
    public function addDatasetFromStr($str) {
        $fabric = new Fabric();
        $this->addDataset($fabric->createObjectFromString($str));
    }
    
    public function addDataset(Set $set) {
        $this->dataSets[] = $set;
    }
    
    public function get()
    {
        $ret = [];
        
        foreach ($this->dataSets as $set) {
            if ($set instanceof Set) {
                $ret[] = $set->get();
            }
        }
        
        return $ret;
    }
}
