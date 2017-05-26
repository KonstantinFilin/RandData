<?php

require 'init.php';

$fabric = new RandData\Fabric();
$dataSetInteger = $fabric->createObjectFromString("integer");
printData("No parameters", $dataSetInteger);

$dataSetInteger2 = $fabric->createObjectFromString("integer:min=-5;max=7");
printData("-5 to 7", $dataSetInteger2);

$dataSetInteger3 = $fabric->createObjectFromString("integer:min=111;max=222");
printData("111 to 222", $dataSetInteger3);

