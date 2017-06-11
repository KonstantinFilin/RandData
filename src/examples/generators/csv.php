<?php

require "../init.php";

$formatter = new RandData\Formatter\Csv();
$formatter->setShowHeaders(true);
$formatter->setShowCounter(false);
$generator = new PersonGenerator($formatter);
$generator->setAmount(20);

echo $generator->run();
echo PHP_EOL;

