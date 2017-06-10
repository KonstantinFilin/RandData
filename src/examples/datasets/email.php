<?php

require '../init.php';

$fabric = new RandData\Fabric();
$dataSet = $fabric->createObjectFromString("email");
printData("No parameters", $dataSet);
$dataSet2 = $fabric->createObjectFromString("email:domain_list=gmail.com,yahoo.com,hotmail.com,fbi.gov");
printData("Only specified domains", $dataSet2);

