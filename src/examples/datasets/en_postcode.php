<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSet1 = $fabric->create("en_postcode");
printData("Default", $dataSet1);
