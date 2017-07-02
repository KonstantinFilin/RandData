<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSetTime = $fabric->create("value:value=asdf");
printData("No parameters", $dataSetTime);
