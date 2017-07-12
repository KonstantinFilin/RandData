<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\String();
$dataSet = $fabric->create("email");
printData("No parameters", $dataSet);
$dataSet2 = $fabric->create("email:domain_list=gmail.com,yahoo.com,hotmail.com,fbi.gov");
printData("Only specified domains", $dataSet2);
