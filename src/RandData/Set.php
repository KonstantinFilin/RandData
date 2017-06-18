<?php

namespace RandData;

/**
 * Random DataSet
 */
abstract class Set 
{
    /**
     * Returns random data
     */
    abstract function get();
    
    /**
     * Initializes DataSet with params
     */
    abstract function init($params = []);
}
