<?php

namespace RandData\Fabric\DataSet;

/**
 * Datetime datasets fabric
 */
class StringDatetime
{
    /**
     * Returns datetime datasets from set info object
     * @param \RandData\Fabric\DataSet\SetInfo $setInfo Dataset meta info
     * @return RandData\Set|null
     */
    public function create(\RandData\SetInfo $setInfo)
    {
        if ($setInfo->getName() == "time") {
            return new \RandData\Set\Time();
        } elseif ($setInfo->getName() == "date") {
            return new \RandData\Set\Date();
        } elseif ($setInfo->getName() == "datetime") {
            return new \RandData\Set\Datetime();
        }
        
        return null;
    }
}
