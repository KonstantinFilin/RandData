<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSet1 = $fabric->create("en_person");
printData("Default", $dataSet1);
$dataSet2 = $fabric->create("en_person:format=%f %m1. %l");
printData("Format 2", $dataSet2);
$dataSet3 = $fabric->create("en_person:sex=m");
printData("Males", $dataSet3);
$dataSet4 = $fabric->create("en_person:sex=f");
printData("Females", $dataSet4);
