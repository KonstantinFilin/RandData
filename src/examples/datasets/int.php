<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSetInteger = $fabric->create("integer");
printData("No parameters", $dataSetInteger);

$dataSetInteger2 = $fabric->create("integer:min=-5;max=7");
printData("-5 to 7", $dataSetInteger2);

$dataSetInteger3 = $fabric->create("integer:min=111;max=222");
printData("111 to 222", $dataSetInteger3);
