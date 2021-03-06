<?php

namespace RandData\Fabric\Tuple;

/**
 * Sql create parser fabric
 */
class SqlCreateParserFabric
{
    /**
     * Parses sql field definition and returns dataset definition
     * @param string $fieldDefinition Sql field definition (part of CREATE TABLE command)
     * @return string RandDataSet definition
     */
    public function create($fieldDefinition)
    {
        $parsers = [
            new SqlCreateParser\Counter(),
            new SqlCreateParser\IntegerUnsigned(),
            new SqlCreateParser\Integer(),
            new SqlCreateParser\Decimal(),
            new SqlCreateParser\Str(),
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
    
    /**
     * Runs parser and returns result
     * @param \RandData\Fabric\Tuple\SqlCreateParser $parser Parser
     * @param string $fieldDefinition Sql field definition
     * @return string Parser result
     */
    protected function runParser(\RandData\Fabric\Tuple\SqlCreateParser $parser, $fieldDefinition)
    {
        return $parser->parse($fieldDefinition);
    }
}
