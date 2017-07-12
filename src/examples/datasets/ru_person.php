<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSet1 = $fabric->create("ru_person");
printData("Default", $dataSet1);
$dataSet2 = $fabric->create("ru_person:format=%f %m %l");
printData("Format 2", $dataSet2);
$dataSet3 = $fabric->create("ru_person:format=%l %f1. %m1.");
printData("Format 3", $dataSet3);
$dataSet4 = $fabric->create("ru_person:sex=m");
printData("Males", $dataSet4);
$dataSet5 = $fabric->create("ru_person:sex=f");
printData("Females", $dataSet5);
