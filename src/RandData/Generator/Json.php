<?php

namespace RandData\Generator;

abstract class Json extends \RandData\Generator
{
    public function run()
    {
        return json_encode(parent::run(), JSON_PRETTY_PRINT);
    }
    
    protected function runOne()
    {
        $headersArr = $this->getHeaders();
        $valuesArr = $this->tuple->get();

        return array_combine($headersArr, $valuesArr);
    }
    
    abstract protected function getHeaders();
}
