<?php

require '../init.php';

$fabric = new RandData\Fabric();
$dataSetFloat1 = $fabric->createObjectFromString("float:min=8;max=13");
printData("8 to 13", $dataSetFloat1);

$dataSetFloat2 = $fabric->createObjectFromString("float:min=4;max=6;minFractionDigits=2;maxFractionDigits=4");
printData("4 to 6, fraction digits from 2 to 4", $dataSetFloat2);

$dataSetFloat3 = $fabric->createObjectFromString("float:min=100;max=300;minFractionDigits=3;maxFractionDigits=3");
printData("100 to 300, 3 fraction digits", $dataSetFloat3);
