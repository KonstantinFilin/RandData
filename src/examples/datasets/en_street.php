<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSet1 = $fabric->create("en_street");
printData("Default", $dataSet1);
