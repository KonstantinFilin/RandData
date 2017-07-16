<?php

namespace RandData\Fabric\DataSet;

/**
 * Numeric datasets fabric
 */
class StringNumeric
{
    /**
     * Returns numeric datasets from set info object
     * @param \RandData\Fabric\DataSet\SetInfo $setInfo Dataset meta info
     * @return RandData\Set|null
     */
    public function create(\RandData\SetInfo $setInfo)
    {
        if (in_array($setInfo->getName(), [ "int", "integer" ])) {
            return new \RandData\Set\Integer;
        } elseif ($setInfo->getName() == "decimal") {
            return new \RandData\Set\Decimal();
        } elseif ($setInfo->getName() == "boolean") {
            return new \RandData\Set\Boolean();
        }
        
        return null;
    }
}
