<?php

namespace RandData\Fabric\DataSet;

/**
 * Text datasets fabric
 */
class StringText
{
    /**
     * Returns text datasets from set info object
     * @param \RandData\Fabric\DataSet\SetInfo $setInfo Dataset meta info
     * @return RandData\Set|null
     */
    public function create(\RandData\SetInfo $setInfo)
    {
        if ($setInfo->getName() == "string_list") {
            return new \RandData\Set\StringList();
        } elseif ($setInfo->getName() == "string") {
            return new \RandData\Set\String();
        } elseif ($setInfo->getName() == "paragraph") {
            return new \RandData\Set\Paragraph();
        }
        
        return null;
    }
}
