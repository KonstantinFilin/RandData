<?php

require "../init.php";

$tpl = "Hello, I'm {string_list:values=Peter,James,John}, my age is {integer:min=5;max=30}, I live @ {en_address} and today is {date}";
$generator = new \RandData\Set\Complex($tpl);
echo $generator->run() . PHP_EOL;

