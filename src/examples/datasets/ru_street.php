<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSet1 = $fabric->create("ru_street");
printData("Default", $dataSet1);
