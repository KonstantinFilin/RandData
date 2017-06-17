<?php

require "../init.php";

$tableName = "clients";
$generator = new \RandData\Generator(new PersonTuple(), 20);
$formatter = new \RandData\Formatter\Sql($generator, $tableName);

echo $formatter->build() . PHP_EOL;
