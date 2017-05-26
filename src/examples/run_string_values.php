<?php

require 'init.php';

$fabric = new RandData\Fabric();
$dataSet1 = $fabric->createObjectFromString("string_list:values=Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday");
printData("Weekdays", $dataSet1);
