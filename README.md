# RandData
Data generator with support for complex data and dependency realization

## Installation

## Basic usage

More examples in src/examples folder

### Raw random values

```php
$dataSetInteger = $fabric->createObjectFromString("integer");
for ($i = 1; $i <= 10; $i++) {
    echo $dataSetInteger->get() . PHP_EOL;
}

/*
Output: 

1240165304
410574832
152505278
1758321788
1400455855
517434730
903432992
1511282239
786915254
632789484
*/

$dataSetInteger2 = $fabric->createObjectFromString("integer:min=-5;max=7");
// ...

/*
Output: 

5
7
3
2
-1
-5
-3
3
4
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
180
178
194
142
178
*/
```

### Filling database

TBD

### Filling string by template

TBD

### Filling forms

TBD

## Main Objects 

### RandDataSet

Atomic piece of data, may be simple (boolean, number or char) or complex, for 
example *PersonName* Object (FirstName + MiddleName + LastName) or *AviaTicket Order* Object 
(departure information, route, passenger list, status information and so on)

### RandDataGenerator

Just manages generation process

### RandDataFabric

Creates RandDataSet objects 


