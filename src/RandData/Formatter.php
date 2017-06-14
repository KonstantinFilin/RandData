<?php

namespace RandData;

class Formatter 
{
    /**
     *
     * @var Generator
     */
    protected $generator;

    function __construct(Generator $generator) {
        $this->generator = $generator;
    }

    protected function buildOne($counter, $dataRaw)
    {
        return $dataRaw;
    }
    
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
    
    protected function getNullAs() {
        return null;
    }
}
