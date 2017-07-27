<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSet1 = $fabric->create("en_city");
printData("Default", $dataSet1);
$dataSet2 = $fabric->create("en_city:postcode=IP29 8FX");
printData("In the IP postcode area", $dataSet2);
