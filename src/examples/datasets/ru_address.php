<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSet1 = $fabric->create("ru_address");
printData("Default", $dataSet1);
$dataSet2 = $fabric->create("ru_address:show_flat=0");
printData("No flat", $dataSet2);
