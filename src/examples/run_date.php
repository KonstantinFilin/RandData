<?php

require 'init.php';

$fabric = new RandData\Fabric();
$dataSetTime = $fabric->createObjectFromString("date");
printData("No parameters", $dataSetTime);
$dataSetTime2 = $fabric->createObjectFromString("date:format=d.m.Y");
printData("Other format", $dataSetTime2);
$dataSetTime3 = $fabric->createObjectFromString("date:min=2017-12-25;max=2017-12-28");
printData("From 2017-12-25 to 2017-12-28", $dataSetTime3);
