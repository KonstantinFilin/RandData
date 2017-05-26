<?php

require '../../vendor/autoload.php';

function printData($desc, RandData\Set $dataset)
{
    print str_repeat("=", 100) . PHP_EOL;
    print $desc . PHP_EOL;
    print str_repeat("=", 100) . PHP_EOL;

    for ($i = 1; $i <= 10; $i++) {
        printf(
            "%u: %s" . PHP_EOL, 
            $i, 
            $dataset->get()
        );
    }
}
