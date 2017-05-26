# RandData
Data generator with support for complex data and dependency realization

**Under development**

## Installation

## Basic usage

More examples in src/examples folder

### Raw random values example

```php
$fabric = new RandData\Fabric();
$dataSetInteger = $fabric->createObjectFromString("integer");
for ($i = 1; $i <= 5; $i++) {
    echo $dataSetInteger->get() . PHP_EOL;
}

$dataSetInteger2 = $fabric->createObjectFromString("integer:min=-5;max=7");
$dataSetInteger3 = $fabric->createObjectFromString("integer:min=111;max=222");
```

### Filling database

TBA

### Filling string by template

TBA

### Filling forms

TBA

## DataSet options

All DataSet can be created from string identificator ("boolean", "string", "integer" and so on):

There also may be an optional params:
```
ID:params
```
Params seperated by semicolon and name/value pairs separated by equal sign:

```
ID:key1=value1;key2=value2;key3=value3
```

Value may be an array item, its item seperated by comma:
```
ID:letters:a,b,c;persons:John,Mary,Jane
```

### Boolean

**ID**

> boolean

**Params**

* valTrue: String to show when true (examples: 1, Y, Yes, +, ...)
* valFalse: String to show when false (examples: 0, N, No, -, ...)

### Integer

**ID**

> integer

**Params**

* min: Minimum value (default to 0)
* max: Maximum value (default to [getrandmax](http://php.net/manual/en/function.getrandmax.php)

### Float

**ID**

> float

**Params**

* min: Minimum value (default to 0)
* max: Maximum value (default to [getrandmax](http://php.net/manual/en/function.getrandmax.php)
* minFractionDigits: Minimum digits after the point. Default to 0
* maxFractionDigits: Maximum digits after the point. Default to 8

### String List

One random string from the list

**ID**

> string_list

**Params**

* values: Comma seperated list of available values

## Main Objects 

### RandDataSet

Atomic piece of data, may be simple (boolean, number or char) or complex, for 
example *PersonName* Object (FirstName + MiddleName + LastName) or *AviaTicket Order* Object 
(departure information, route, passenger list, status information and so on)

### RandDataGenerator

Just manages generation process

### RandDataFabric

Creates RandDataSet objects 

## TODO ##

**Simple**

* (+) NULL
* (+) Integer
* (+) Float
* (+) Boolean
* (+) StringList
* (-) String

**Complex**

* (-) Date
* (-) Time
* (-) Datetime
* (-) Phone
* (-) Person
* (-) Address
* (-) Domain
* (-) Email

**And also**

* Object fabric
* Required or NULL
* Possibility of value
* Data dependency (subobjects, date difference and so on)
* Output formats (csv, sql, json)
* Generating datasets from database tables
* Graphic interface

