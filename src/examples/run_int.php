<?php

require '../../vendor/autoload.php';

$fabric = new RandData\Fabric();
$dataSetInteger = new RandData\Set\Integer();
printData("No parameters", $dataSetInteger);

$dataSetInteger->setMin(-5);
$dataSetInteger->setMax(7);
printData("-5 to 7", $dataSetInteger);

$dataSetInteger->setMin(111);
$dataSetInteger->setMax(222);
printData("111 to 222", $dataSetInteger);

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