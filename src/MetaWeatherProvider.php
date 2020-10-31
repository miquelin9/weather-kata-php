<?php

namespace Codium\CleanCode;

use GuzzleHttp\Client;

class MetaWeatherProvider
{
    public const META_WEATHER_QUERY    = "https://www.metaweather.com/api/location/search/?query=";
    public const META_WEATHER_LOCATION = "https://www.metaweather.com/api/location/";

    var $client;

    function __construct() {
        $this->client = new Client();
    }

    public function getId(string $city)
    {
        return json_decode($this->client->get(self::META_WEATHER_QUERY . $city)->getBody()->getContents(),
        true)[0]['woeid'];
    }

    public function getResults(string $woeid)
    {
        return json_decode($this->client->get(self::META_WEATHER_LOCATION . $woeid)->getBody()->getContents(),
        true)['consolidated_weather'];
    }

    function __destruct() {}
}