<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSetTime = $fabric->create("datetime");
printData("No parameters", $dataSetTime);
$dataSetTime2 = $fabric->create("datetime:date_format=d.m.Y;seconds=0");
printData("Other format", $dataSetTime2);
$dataSetTime3 = $fabric->create("datetime:date_min=2017-05-17;date_max=2017-05-21;time_min=11:00;time_max=14:30");
printData("Date range from 2017-05-17 to 2017-05-21, time range from 11:00 to 14:30", $dataSetTime3);
