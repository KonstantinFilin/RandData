<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSet1 = $fabric->create("ru_city");
printData("Default", $dataSet1);
