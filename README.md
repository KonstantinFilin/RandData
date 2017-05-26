# RandData
Data generator with support for complex data and dependency realization

**Under development**

## Installation

## Basic usage

More examples in src/examples folder

### Raw random values example

```php
$dataSetInteger = $fabric->createObjectFromString("integer");
for ($i = 1; $i <= 5; $i++) {
    echo $dataSetInteger->get() . PHP_EOL;
}

/*
Output: 

1240165304
410574832
152505278
1758321788
1400455855
*/

$dataSetInteger2 = $fabric->createObjectFromString("integer:min=-5;max=7");
// ...

/*
Output: 

5
7
-5
-3
4

*/
$dataSetInteger3 = $fabric->createObjectFromString("integer:min=111;max=222");
// ...

/*
168
170
208
159
153
*/
```

### Filling database

TBA

### Filling string by template

TBA

### Filling forms

TBA

## DataSet options

### Boolean

**ID**

> boolean

**Params**

* valTrue: String to show when true (examples: 1, Y, Yes, +, ...)
* valFalse: String to show when false (examples: 0, N, No, -, ...)

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

