<?php

namespace RandData;

abstract class Generator 
{
    protected $amount;
    protected $tuple;
    protected $counter;
    protected $result;
    
    function __construct(Tuple $tuple) {
        $this->counter = 0;
        $this->amount = 10;
        $this->tuple = $tuple;
        $this->result = [];
        $this->buildTuple();
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }
    
    public function run()
    {
        for ($this->counter = 1; $this->counter <= $this->amount; $this->counter++) {
             $this->result[] = $this->runOne();
        }
        
        return $this->result;
    }
    
    protected function buildTuple()
    {
        $datasets = $this->getDataSets();
        
        foreach ($datasets as $ds) {
            if ($ds instanceof Set) {
                $this->tuple->addDataset($set);
            } elseif (is_string($ds)) {
                $this->tuple->addDatasetFromStr($ds);
            }
        }
    }
    
    protected function runOne()
    {
        return $this->tuple->get();
    }
    
    abstract function getDataSets();
}
