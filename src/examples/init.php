<?php

require '../../../vendor/autoload.php';

function printBlock($desc, RandData\Set $dataset)
{
    print str_repeat("=", 100) . PHP_EOL;
    print $desc . PHP_EOL;
    print str_repeat("=", 100) . PHP_EOL;

    for ($i = 1; $i <= 10; $i++) {
        
        printf("%02.0u:" . PHP_EOL, $i);
        echo str_repeat("-", 100) . PHP_EOL;
        printf(
            "%s" . PHP_EOL, 
            $dataset->get()
        );
        echo str_repeat("-", 100) . PHP_EOL;
    }
}

function printData($desc, RandData\Set $dataset)
{
    print str_repeat("=", 100) . PHP_EOL;
    print $desc . PHP_EOL;
    print str_repeat("=", 100) . PHP_EOL;

    for ($i = 1; $i <= 10; $i++) {
        printf(
            "%02u: %s" . PHP_EOL, 
            $i, 
            $dataset->get()
        );
    }
}
