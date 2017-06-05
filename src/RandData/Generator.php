<?php

namespace RandData;

abstract class Generator 
{
    protected $amount;
    protected $tuple;
    protected $counter;
    protected $result;
    
    function __construct(Tuple $tuple = null) {
        $this->counter = 0;
        $this->amount = 10;
        $this->tuple = $tuple ? $tuple : new Tuple();
        $this->result = [];
        $this->buildTuple();
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }
    
    function getAmount() {
        return $this->amount;
    }

    function getTuple() {
        return $this->tuple;
    }
    
    function setTuple($tuple) {
        $this->tuple = $tuple;
    }

    public function run()
    {
        $this->result = [];
        $amount = $this->getAmount();
        
        for ($this->counter = 1; $this->counter <= $amount; $this->counter++) {
            $this->result[] = $this->runOne();
        }
        
        $this->counter = 0;
        
        return $this->result;
    }
    
    protected function buildTuple()
    {
        $datasets = $this->getDataSets();
        
        foreach ($datasets as $ds) {
            if ($ds instanceof Set) {
                $this->tuple->addDataset($ds);
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
