<?php

require "../init.php";

$generator = new PersonGenerator();
$generator->setAmount(10);

$formatter = new \RandData\Formatter\Json($generator);

echo $formatter->build();
