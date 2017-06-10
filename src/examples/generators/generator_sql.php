<?php

require "../init.php";

$formatter = new \RandData\Formatter\Sql("clients");
$formatter->setIncrementField("id");
$formatter->setIncrementStart(15);
$generator = new PersonGenerator($formatter);
$generator->setAmount(20);

echo $generator->run() . PHP_EOL;
