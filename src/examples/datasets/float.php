<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSetFloat1 = $fabric->create("float:min=8;max=13");
printData("8 to 13", $dataSetFloat1);

$dataSetFloat2 = $fabric->create("float:min=-8;max=6;minFractionDigits=2;maxFractionDigits=4");
printData("-8 to 6, fraction digits from 2 to 4", $dataSetFloat2);

$dataSetFloat3 = $fabric->create("float:min=100;max=300;minFractionDigits=3;maxFractionDigits=3");
printData("100 to 300, 3 fraction digits", $dataSetFloat3);
