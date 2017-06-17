<?php

require "../init.php";

$generator = new \RandData\Generator(new PersonTuple(), 20);
$formatter = new \RandData\Formatter\Json($generator);

echo $formatter->build();
