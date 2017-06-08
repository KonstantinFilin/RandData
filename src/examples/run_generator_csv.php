<?php

require 'init.php';

class PersonCsv extends \RandData\Generator\Csv
{
    public function getHeaders() {
        return [
            "Name",
            "Birth",
            "Phone",
            "Sum"
        ];
    }
    
    public function getDataSets() 
    {
        return [
            "ru_person",
            "date:min=1900-01-01;max=2005-12-31",
            "phone:country_list=7;region_list=495,499,915,919,905,903",
            "integer:min=100;max=10000"
        ];
    }
    
    protected function getNullAs()
    {
        return "NA";
    }
    
    protected function getNullProbability() {
        return [
            0,
            0,
            20, // null approximately 20% (every fifth) for Phone field
            50 // null approximately 50% (every second) for Sum field
        ];
    }
}

$generator = new PersonCsv(new RandData\Tuple());
$generator->setAmount(100);
$result = $generator->run();

echo implode(PHP_EOL, $result);
echo PHP_EOL;

