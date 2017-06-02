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
        $this->runHeaders();
        return parent::run();
    }

    protected function runHeaders()
    {
        $headers = $this->getHeaders();
        return $headers ? implode($this->columnDelim, $headers) : "";
    }

    protected function runOne()
    {
        $arr = $this->tuple->get();
        return implode($this->columnDelim, $arr);
    }
    
    abstract protected function getHeaders();
}
