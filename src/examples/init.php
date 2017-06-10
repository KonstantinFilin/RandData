<?php

require '../../../vendor/autoload.php';

function printBlock($desc, RandData\Set $dataset)
{
    print str_repeat("=", 100) . PHP_EOL;
    print $desc . PHP_EOL;
    print str_repeat("=", 100) . PHP_EOL;

    for ($i = 1; $i <= 10; $i++) {
        
        printf("%02.0u:" . PHP_EOL, $i);
        echo str_repeat("-", 100) . PHP_EOL;
        printf(
            "%s" . PHP_EOL, 
            $dataset->get()
        );
        echo str_repeat("-", 100) . PHP_EOL;
    }
}

function printData($desc, RandData\Set $dataset)
{
    print str_repeat("=", 100) . PHP_EOL;
    print $desc . PHP_EOL;
    print str_repeat("=", 100) . PHP_EOL;

    for ($i = 1; $i <= 10; $i++) {
        printf(
            "%02u: %s" . PHP_EOL, 
            $i, 
            $dataset->get()
        );
    }
}

class PersonGenerator extends \RandData\Generator
{
    public function getDataSets() {
        return [
            "Name" => "ru_person",
            "Birth" => "date:min=1900-01-01;max=2005-12-31",
            "Phone" => "phone:country_list=7;region_list=495,499,915,919,905,903",
            "Sum" => "integer:min=100;max=10000",
            "Class" => "string_list:values=aaa,bbb,ccc;possibility=50,20,30"
        ];
    }
    
    protected function getNullProbability() {
        return [
            0,
            0,
            20, // null approximately 20% (every fifth) for Phone field
            50, // null approximately 50% (every second) for Sum field,
            0
        ];
    }
}
