<?php

require 'init.php';

class PersonCsv extends \RandData\Generator\Csv
{
    protected function runHeaders() {
        echo $this->counter . $this->columnDelim . parent::runOne() . PHP_EOL;
    }
    
    protected function runOne() {
        echo $this->counter . $this->columnDelim . parent::runOne() . PHP_EOL;
    }

    protected function getHeaders() {
        return [
            "#",
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
}

$generator = new PersonCsv(new RandData\Tuple());
$generator->setAmount(100);
$generator->run();
