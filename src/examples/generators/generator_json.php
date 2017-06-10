<?php

require "../init.php";

$generator = new PersonGenerator(new \RandData\Formatter\Json());
$generator->setAmount(10);
echo $generator->run();
