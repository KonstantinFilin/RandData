<?php

require '../../vendor/autoload.php';

$fabric = new RandData\Fabric();
$dataSetFloat1 = $fabric->createObjectFromString("float:min=8;max=13");
printData("8 to 13", $dataSetFloat1);

$dataSetFloat2 = $fabric->createObjectFromString("float:min=4;max=6;minFractionDigits=2;maxFractionDigits=4");
printData("4 to 6, fraction digits from 2 to 4", $dataSetFloat2);

$dataSetFloat3 = $fabric->createObjectFromString("float:min=100;max=300;minFractionDigits=3;maxFractionDigits=3");
printData("100 to 300, 3 fraction digits", $dataSetFloat3);

function printData($desc, RandData\Set $dataset)
{
    print str_repeat("=", 100) . PHP_EOL;
    print $desc . PHP_EOL;
    print str_repeat("=", 100) . PHP_EOL;

    for ($i = 1; $i <= 25; $i++) {
        printf(
            "%u: %s" . PHP_EOL, 
            $i, 
            $dataset->get()
        );
    }
}
