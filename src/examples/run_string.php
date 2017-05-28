<?php

require 'init.php';

$fabric = new RandData\Fabric();
$dataSet1 = $fabric->createObjectFromString("string");
printData("Default 10 chars of [A-Za-z0-9]", $dataSet1);

$dataSet2 = $fabric->createObjectFromString("string:length=4;char_list=abc");
printData("4 chars from \"a,b,c\"", $dataSet2);

$dataSet3 = $fabric->createObjectFromString("string:length=10;char_list=ABCDEFGHIKLMNOPRSTUVWXYZabcdefghijklmnoprstuvwxyz0123456789!?();:@#$%&_");
printData("10 chars password", $dataSet3);
