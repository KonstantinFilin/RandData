<?php

require "../init.php";

$formatter = new RandData\Formatter\Csv(new \RandData\Generator(new PersonTuple(), 20));
$formatter->setShowHeaders(false);
$formatter->setShowCounter(false);

echo $formatter->build();
echo PHP_EOL;

