<?php

class WeatherServiceProvider implements ServiceProviderInterface
{
    private $metaweatherprovider;

    function __construct(MetaWeatherProvider $metaweatherprovider)
    {
        self::$metaweatherprovider = $metaweatherprovider; 
    }

    public function doPrediction(string $city, \DateTime $datetime)
    {
        $woeid = $metaweatherprovider->getId();
        $results = $metaweatherprovider-getResults();

        foreach ($results as $result) {

            $isvalidresult = $result["applicable_date"] == $datetime->format('Y-m-d');
            if ($isvalidresult){
                return $result['weather_state_name'];
            }
        }
    }
}
