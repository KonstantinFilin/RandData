<?php

require 'init.php';

$fabric = new RandData\Fabric();
//$dataSet1 = $fabric->createObjectFromString("string_list:values=Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday");
//printData("Weekdays", $dataSet1);
$dataSet2 = $fabric->createObjectFromString("string_list:values=aaa,bbb,ccc;possibility=50,20,30");
printData("Possibility: aaa: ~50%, bbb: ~20%, ccc: ~30%", $dataSet2);
