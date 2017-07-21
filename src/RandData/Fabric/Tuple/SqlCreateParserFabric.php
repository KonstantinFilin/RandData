<?php

namespace RandData\Fabric\Tuple;

class SqlCreateParserFabric 
{
    public function create($fieldDefinition)
    {
        $parsers = [
            new SqlCreateParser\Counter(),
            new SqlCreateParser\IntUnsigned(),
            new SqlCreateParser\Int(),
            new SqlCreateParser\Decimal(),
            new SqlCreateParser\String(),
            new SqlCreateParser\Text(),
            new SqlCreateParser\Dt
        ];
        
        foreach ($parsers as $parser) {
            $res = $this->runParser($parser, $fieldDefinition);
            
            if ($res) {
                return $res;
            }
        }
        
        return null;
    }
    
    protected function runParser($parser, $fieldDefinition)
    {
        if ($parser instanceof SqlCreateParser) {
            return $parser->parse($fieldDefinition);
        }
        
        return null;
    }
}
