<?php

require '../../vendor/autoload.php';

$fabric = new RandData\Fabric();
$dataSetInteger = $fabric->createObjectFromString("integer");
printData("No parameters", $dataSetInteger);

$dataSetInteger2 = $fabric->createObjectFromString("integer:min=-5;max=7");
printData("-5 to 7", $dataSetInteger2);

$dataSetInteger3 = $fabric->createObjectFromString("integer:min=111;max=222");
printData("111 to 222", $dataSetInteger3);

function printData($desc, RandData\Set $dataset)
{
    print str_repeat("=", 100) . PHP_EOL;
    print $desc . PHP_EOL;
    print str_repeat("=", 100) . PHP_EOL;

    for ($i = 1; $i <= 10; $i++) {
        printf(
            "%u: %s" . PHP_EOL, 
            $i, 
            $dataset->get()
        );
    }
}