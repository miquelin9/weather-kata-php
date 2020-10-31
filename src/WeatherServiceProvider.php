<?php

namespace Codium\CleanCode;

class WeatherServiceProvider implements ServiceProviderInterface
{
    var $metaweatherprovider;

    function __construct(MetaWeatherProvider $metaweatherprovider)
    // function __construct()
    {
        $this->metaweatherprovider = $metaweatherprovider; 
    }

    public function doPrediction(string $city, \DateTime $datetime)
    {
        $woeid = $this->metaweatherprovider->getId($city);
        $results = $this->metaweatherprovider->getResults($woeid);

        foreach ($results as $result) {

            $isvalidresult = $result["applicable_date"] == $datetime->format('Y-m-d');
            if ($isvalidresult){
                return $result['weather_state_name'];
            }
        }
    }

    function __destruct() {}
}
