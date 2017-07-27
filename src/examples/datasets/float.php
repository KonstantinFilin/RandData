<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSetDecimal1 = $fabric->create("decimal:min=8;max=13");
printData("8 to 13", $dataSetDecimal1);

$dataSetDecimal2 = $fabric->create("decimal:min=-8;max=6;minFractionDigits=2;maxFractionDigits=4");
printData("-8 to 6, fraction digits from 2 to 4", $dataSetDecimal2);

$dataSetDecimal3 = $fabric->create("decimal:min=100;max=300;minFractionDigits=3;maxFractionDigits=3");
printData("100 to 300, 3 fraction digits", $dataSetDecimal3);
