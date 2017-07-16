<?php

namespace RandData\Fabric\DataSet;

/**
 * Secondary datasets fabric
 */
class StringOthers
{
    /**
     * Returns secondary datasets from set info object
     * @param \RandData\Fabric\DataSet\SetInfo $setInfo Dataset meta info
     * @return RandData\Set|null
     */
    public function create(\RandData\SetInfo $setInfo)
    {
        if ($setInfo->getName() == "phone") {
            return new \RandData\Set\Phone();
        } elseif ($setInfo->getName() == "domain") {
            return new \RandData\Set\Domain();
        } elseif ($setInfo->getName() == "email") {
            return new \RandData\Set\Email();
        } 
        
        return null;
    }
}
