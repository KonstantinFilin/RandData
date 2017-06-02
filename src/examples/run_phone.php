<?php

require 'init.php';

$fabric = new RandData\Fabric();
$dataSetPhone = $fabric->createObjectFromString("phone");
printData("No parameters", $dataSetPhone);
$dataSetPhone2 = $fabric->createObjectFromString("phone:country_list=3,7;region_list=123,456,7890");
printData("Country list and formats", $dataSetPhone2);
$dataSetPhone3 = $fabric->createObjectFromString("phone:country_list=8;region_list=800");
printData("Free for caller", $dataSetPhone3);
$dataSetPhone4 = $fabric->createObjectFromString("phone:format=0");
printData("Unformatted", $dataSetPhone4);
