<?php

require '../init.php';

$fabric = new \RandData\Fabric\DataSet\Str();
$dataSet1 = $fabric->create("paragraph");
printBlock("Paragraph default", $dataSet1);

$dataSet2 = $fabric->create("paragraph:words_min=15;words_max=30");
printBlock("Paragraph from 15 to 30 words", $dataSet2);

$dataSet3 = $fabric->create("paragraph:words_min=15;words_max=30;length_min=4;length_max=6;char_list=ABCDEF0123456789");
printBlock("Paragraph from 15 to 30 hexadecimal words with 4-6 chars", $dataSet3);
