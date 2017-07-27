<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSetTime = $fabric->create("value:value=asdf");
printData("No parameters", $dataSetTime);
