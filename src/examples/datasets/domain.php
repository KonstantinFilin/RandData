<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSet = $fabric->create("domain");
printData("No parameters", $dataSet);
$dataSet2 = $fabric->create("domain:skip_www=1");
printData("Skip www part", $dataSet2);
$dataSet3 = $fabric->create("domain:tld_list=org,net;char_list_edge=01;char_list=abcdef0123456789");
printData("Hacker domain", $dataSet3);
