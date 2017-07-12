<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSetInteger = $fabric->create("boolean");
printData("No parameters", $dataSetInteger);

$dataSetInteger2 = $fabric->create("boolean:valTrue=Male;valFalse=Female");
printData("Other names", $dataSetInteger2);

$dataSetInteger3 = $fabric->create("boolean:valTrue=true;valFalse=false");
printData("Other names 2", $dataSetInteger3);
