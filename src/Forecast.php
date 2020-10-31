<?php

namespace Codium\CleanCode;

class Forecast
{
    var $metaweather;
    var $windServiceProvider;
    var $weatherServiceProvider;
    var $currentServiceProvider;

    public function __construct()
    {
        $this->metaweather = new MetaWeatherProvider();
        $this->windServiceProvider = new WindServiceProvider($this->metaweather);
        $this->weatherServiceProvider = new WeatherServiceProvider($this->metaweather);
    }

    public function predict(string &$city, \DateTime $datetime = null, bool $wind = false)
    {
        //Step to validate wether the datetime is correct and should proceed, or should return empty
        //as the datetime is not valid
        if (!$datetime) {
            $datetime = new \DateTime();
        }

        $isDateTimeValid = $datetime < new \DateTime("+6 days 00:00:00");
        if (!$isDateTimeValid) {
            return "";
        }

        //This should be called in a higher layer of abstraction
        //I'm using this method here just to implement the expected behaviour
        $this->setPredictionType($wind);
        
        return $this->currentServiceProvider->doPrediction($city, $datetime);
    }

    public function setPredictionType(bool $wind = false)
    {
        $this->currentServiceProvider = $wind ? $this->weatherServiceProvider : $this->weatherServiceProvider;
    }

    function __destruct() {}
}