<?php

namespace RandData\Example;

class TupleImplementation1 extends \RandData\Tuple
{
    public function getDataSets() 
    {
        return [ "boolean", "integer:min=3;max=8", "time" ];
    }
}
