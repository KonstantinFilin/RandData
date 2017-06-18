<?php

namespace RandData;

/**
 * Random data represantation
 */
class Formatter 
{
    /**
     *
     * @var Generator
     */
    protected $generator;

    /**
     * Class constructor
     * @param \RandData\Generator $generator Random data generator
     */
    function __construct(Generator $generator) {
        $this->generator = $generator;
    }

    /**
     * Represents one object attrubute value
     * @param integer $counter Counter when generating many objects
     * @param array $dataRaw Object attribute random value
     * @return string Formatted data for one object
     */
    protected function buildOne($counter, $dataRaw)
    {
        return $dataRaw;
    }
    
    /**
     * Builds representation of all object random items
     * @return array Formatted data for all items
     */
    public function build()
    {
        $data = [];
        $dataRaw = $this->generator->run();
        $cnt = 0;

        foreach ($dataRaw as $dataRow) {
            $data[] = $this->buildOne(++$cnt, $dataRow);
        }
        
        return $data;
    }
    
    /**
     * How to show null values
     * @return mixed Value to show null value ("NA", "-", "NULL", "...", and so on)
     */
    protected function getNullAs() {
        return null;
    }
}
