<?php

namespace RandData\Fabric\Tuple;

abstract class SqlCreateParser {
    abstract public function parse($fieldDefinition);
}
