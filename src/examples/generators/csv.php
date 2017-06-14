<?php

require "../init.php";

$generator = new PersonGenerator();
$generator->setAmount(20);

$formatter = new RandData\Formatter\Csv($generator);
$formatter->setShowHeaders(false);
$formatter->setShowCounter(false);

echo $formatter->build();
echo PHP_EOL;

