<?php

require 'init.php';

$fabric = new RandData\Fabric();
$dataSetInteger = $fabric->createObjectFromString("boolean");
printData("No parameters", $dataSetInteger);

$dataSetInteger2 = $fabric->createObjectFromString("boolean:valTrue=Male;valFalse=Female");
printData("Other names", $dataSetInteger2);

$dataSetInteger3 = $fabric->createObjectFromString("boolean:valTrue=true;valFalse=false");
printData("Other names 2", $dataSetInteger3);


