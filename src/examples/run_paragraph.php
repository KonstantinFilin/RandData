<?php

require 'init.php';

$fabric = new RandData\Fabric();
$dataSet1 = $fabric->createObjectFromString("paragraph");
printBlock("Paragraph default", $dataSet1);

$dataSet2 = $fabric->createObjectFromString("paragraph:words_min=15;words_max=30");
printBlock("Paragraph from 15 to 30 words", $dataSet2);

$dataSet3 = $fabric->createObjectFromString("paragraph:words_min=15;words_max=30;length_min=4;length_max=6;char_list=ABCDEF0123456789");
printBlock("Paragraph from 15 to 30 hexadecimal words with 4-6 chars", $dataSet3);
