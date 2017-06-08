<?php

namespace RandData\Generator;

abstract class Csv extends \RandData\Generator
{
    protected $columnDelim = ";";
    
    function setColumnDelim($columnDelim) {
        $this->columnDelim = $columnDelim;
    }
        
    public function run()
    {
        $headers = $this->getHeaders();
        return $headers 
            ? array_merge([ $this->runHeaders() ], parent::run()) 
            : parent::run();
    }

    protected function runHeaders()
    {
        $headers = $this->getHeaders();
        return $headers 
            ? "#" . $this->columnDelim . implode($this->columnDelim, $headers) 
            : "";
    }

    protected function runOne()
    {
        $arr = parent::runOne();
        return $this->counter . $this->columnDelim . implode($this->columnDelim, $arr);
    }
    
    public function getHeaders()
    {
        return [];
    }
}
