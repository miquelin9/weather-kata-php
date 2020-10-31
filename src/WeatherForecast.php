<?php

namespace Codium\CleanCode;

class WeatherForecast
{
    private $metaweather;
    private $windServiceProvider;
    private $weatherServiceProvider;
    private $currentServiceProvider;

    function __const()
    {
        $metaweather = new MetaWeatherProvider();
        $windServiceProvider = new WindServiceProvider($metaweather);
        $weatherServiceProvider = new WeatherServiceProvider($metaweather);
    }

    public function predict(string &$city, \DateTime $datetime = null, bool $wind = false)
    {
        //Step to validate wether the datetime is correct and should proceed, or should return empty
        //as the datetime is not valid
        if (!validateDatetime($datetime)) {
            return "";
        }

        //This should be called in a higher layer of abstraction
        //I'm using this method here just to implement the expected behaviour
        setPredictionType($wind);
        
        return $currentServiceProvider->doPrediction($city, $datetime);
    }

    private function validateDatetime(\Datetime $datetime) 
    {
        if (!$datetime) {
            $datetime = new \DateTime();
        }
        
        return $datetime < new \DateTime("+6 days 00:00:00");
    }

    public function setPredictionType(bool $wind = false)
    {
        $currentServiceProvider = $wind ? $windServiceProvider : $weatherServiceProvider;
    }
}