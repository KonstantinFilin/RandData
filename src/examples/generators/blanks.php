<?php

require "../init.php";

class BlankTuple extends \RandData\Tuple
{
    public function getDataSets() 
    {
        return [
            "name" => "string_list:values=John,Paul,George,Ringo",
            "dt" => "date:min=1962-10-05;max=1970-05-08"
        ];
    }
}

$generator = new RandData\BlankGenerator(new BlankTuple);
$tpl = "Hello, I'm {name} and today is {dt}";
$generator->init($tpl);
echo $tpl . " => " . $generator->run() . PHP_EOL;

