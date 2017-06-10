<?php

require '../init.php';

$fabric = new RandData\Fabric();
$dataSet1 = $fabric->createObjectFromString("ru_person");
printData("Default", $dataSet1);
$dataSet2 = $fabric->createObjectFromString("ru_person:format=f m l");
printData("Format 2", $dataSet2);
$dataSet3 = $fabric->createObjectFromString("ru_person:format=l f1. m1.");
printData("Format 3", $dataSet3);
$dataSet4 = $fabric->createObjectFromString("ru_person:sex=m");
printData("Males", $dataSet4);
$dataSet5 = $fabric->createObjectFromString("ru_person:sex=f");
printData("Females", $dataSet5);

