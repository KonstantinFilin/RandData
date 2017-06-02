<?php

require 'init.php';

class PersonSql extends \RandData\Generator\Sql
{
    protected function getHeaders() {
        return [
            "Name",
            "Birth",
            "Phone",
            "Sum"
        ];
    }
    
    protected function runOne() {
        echo parent::runOne() . PHP_EOL;
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

$generator = new PersonSql(new RandData\Tuple(), "clients");
$generator->setAmount(100);
$generator->run();
