<?php

namespace RandData\Formatter;

/**
 * Sql data representation
 */
class Sql extends \RandData\Formatter
{
    /**
     * Database table name
     * @var string
     */
    protected $tableName;
    
    /**
     * Class constructor
     * @param \RandData\Generator $generator Random data generator
     * @param string $tableName Database table name
     */
    public function __construct(\RandData\Generator $generator, $tableName)
    {
        parent::__construct($generator);
        
        $this->tableName = (string) $tableName;
    }

    /**
     * @inherited
     */
    public function build()
    {
        $data = parent::build();
        return implode(";". PHP_EOL, $data);
    }
    
    /**
     * @inherited
     */
    protected function buildOne($counter, $data)
    {
        foreach ($data as $fldName => $fldValue) {
            $data[$fldName] = is_null($fldValue) ? "NULL" : "'" . $fldValue . "'";
        }

        return sprintf(
            $this->getPattern(),
            $this->tableName,
            implode("`,`", array_keys($data)),
            implode(",", $data)
        );
    }

    /**
     * Sql command pattern for one object
     * @return string Sql command pattern for one object
     */
    protected function getPattern()
    {
        return "INSERT INTO `%s` (`%s`) VALUES (%s)";
    }
}
