<?php

namespace RandData;

class CsvReader
{
    public function get($filePath)
    {
        $ret = [];
        $fileContent = file($filePath);
        
        foreach ($fileContent as $line) {
            $lineTrimmed = trim($line);
            
            if (!$lineTrimmed) {
                continue;
            }
            
            $ret[] = $lineTrimmed;
        }

        return $ret;
    }
}
