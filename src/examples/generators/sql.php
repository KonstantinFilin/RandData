<?php

require "../init.php";

$generator = new PersonGenerator();
$generator->setAmount(20);

$tableName = "clients";
$formatter = new \RandData\Formatter\Sql($generator, $tableName);
$formatter->setIncrementField("id");
$formatter->setIncrementStart(15);

echo $formatter->build() . PHP_EOL;
