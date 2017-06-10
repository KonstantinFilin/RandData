<?php

require '../init.php';

$fabric = new RandData\Fabric();
$dataSet1 = $fabric->createObjectFromString("string");
printData("Default chars of [A-Za-z0-9], length from 1 to 10", $dataSet1);

$dataSet2 = $fabric->createObjectFromString("string:length_min=4;length_max=4;char_list=abc");
printData("4 chars from \"a,b,c\"", $dataSet2);

$dataSet3 = $fabric->createObjectFromString("string:length_min=3;length_max=7;char_list=abcdefghijklmnoprstuvwxyz");
printData("3-7 letter word", $dataSet3);

$dataSet4 = $fabric->createObjectFromString("string:length_min=3;length_max=5;char_list=ABCDEF0123456789");
printData("3-5 heximal digits", $dataSet4);

$dataSet5 = $fabric->createObjectFromString("string:length_min=10;length_max=15;char_list=ABCDEFGHIKLMNOPRSTUVWXYZabcdefghijklmnoprstuvwxyz0123456789!?();:@#$%&_");
printData("10-15 chars password", $dataSet5);
