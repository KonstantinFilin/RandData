<?php

require "../init.php";

class BlankGeneratorImplementation extends \RandData\BlankGenerator
{
    public function getDataSets() 
    {
        return [
            "name" => "string_list:values=John,Paul,George,Ringo",
            "age" => "integer:min=19;max=30",
            "dt" => "date:min=1962-10-05;max=1970-05-08"
        ];
    }
}

$generator = new BlankGeneratorImplementation();
$tpl = "Hello, I'm {name}, my age {age} and today is {dt}. Created at {dt} by {name}";
$generator->init($tpl);
echo $generator->run() . PHP_EOL;

