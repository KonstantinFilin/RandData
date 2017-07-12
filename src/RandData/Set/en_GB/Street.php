<?php

namespace RandData\Set\en_GB;

/**
 * UK street dataset
 */
class Street extends \RandData\Set
{
    const VALIDATE_PATTERN = "[\w\s'’\.]+";
    
    /**
     * @inherit
     */
    public function get()
    {
        $streetList = $this->getStreetList();
        return $streetList[array_rand($streetList)];
    }

    /**
     * @inherit
     */
    public function init($params = [])
    {
    }
    
    /**
     * Returns street list
     * @return array
     */
    protected function getStreetList()
    {
        return [
            'High Street', 'Station Road', 'Main Street', 'Park Road', 'Church Road',
            'Church Street', 'London Road', 'Victoria Road', 'Green Lane', 'Manor Road',
            'Church Lane', 'Park Avenue', 'The Avenue', 'The Crescent', 'Queens Road',
            'New Road', 'Grange Road', 'Kings Road', 'Kingsway', 'Windsor Road',
            'Highfield Road', 'Mill Lane', 'Alexander Road', 'York Road', 'St. John’s Road',
            'Main Road', 'Broadway', 'King Street', 'The Green', 'Springfield Road',
            'George Street', 'Park Lane', 'Victoria Street', 'Albert Road', 'Queensway',
            'New Street', 'Queen Street', 'West Street', 'North Street', 'Manchester Road',
            'The Grove', 'Richmond Road', 'Grove Road', 'South Street', 'School Lane',
            'The Drive', 'North Road', 'Stanley Road', 'Chester Road', 'Mill Road'
        ];
    }
}
