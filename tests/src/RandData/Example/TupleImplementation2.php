<?php

namespace RandData\Example;

class TupleImplementation2  extends \RandData\Tuple
{
    public function getDataSets() 
    {
        return [ "field1" => "boolean", "field2" => "integer:min=3;max=8", "field3" => "time" ];
    }
}
