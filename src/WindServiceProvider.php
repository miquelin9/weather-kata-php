<?php

class WindServiceProvider implements ServiceProviderInterface
{
    private $metaweatherprovider;

    function __construct(MetaWeatherProvider $metaweatherprovider)
    {
        self::$metaweatherprovider = $metaweatherprovider; 
    }

    public function doPrediction(string $city, \DateTime $datetime)
    {
        $woeid = $metaweatherprovider->getId($city);
        $results = $metaweatherprovider-getResults($woeid);

        foreach ($results as $result) {

            $isvalidresult = $result["applicable_date"] == $datetime->format('Y-m-d');
            if ($isvalidresult){
                return $result['wind_speed'];
            }
        }
    }
}