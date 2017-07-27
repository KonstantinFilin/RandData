<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSetTime = $fabric->create("date");
printData("No parameters", $dataSetTime);
$dataSetTime2 = $fabric->create("date:format=d.m.Y");
printData("Other format", $dataSetTime2);
$dataSetTime3 = $fabric->create("date:min=2017-12-25;max=2017-12-28");
printData("From 2017-12-25 to 2017-12-28", $dataSetTime3);
