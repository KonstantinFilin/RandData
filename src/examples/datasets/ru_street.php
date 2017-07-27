<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSet1 = $fabric->create("ru_street");
printData("Default", $dataSet1);
