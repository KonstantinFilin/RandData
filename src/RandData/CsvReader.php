<?php

namespace RandData;

/**
 * Csv file reader
 */
class CsvReader
{
    /**
     * Reads csv file and returns its lines as array
     * @param string $filePath Path to the file
     * @return array file Array of file lines 
     * @throws \InvalidArgumentException When file is not readable
     */
    public function get($filePath)
    {
        $ret = [];
        
        if (!is_readable($filePath)) {
            throw new \InvalidArgumentException("File is not readable: " . $filePath);
        }
        
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
