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
    abstract public function get();
    
    /**
     * Initializes DataSet with params
     */
    abstract public function init($params = []);
}
