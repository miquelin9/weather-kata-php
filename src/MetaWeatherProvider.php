<?php

use GuzzleHttp\Client;

abstract class MetaWeatherProvider
{
    public const META_WEATHER_QUERY    = "https://www.metaweather.com/api/location/search/?query=";
    public const META_WEATHER_LOCATION = "https://www.metaweather.com/api/location/";

    protected $client;

    function __construct() {
        $client = new Client();
    }

    protected function getId(string $city)
    {
        return json_decode($client->get(self::META_WEATHER_QUERY . $city)->getBody()->getContents(),
        true)[0]['woeid'];
    }

    protected function getResults(string $woeid)
    {
        return json_decode($client->get(self::META_WEATHER_LOCATION . $woeid)->getBody()->getContents(),
        true)['consolidated_weather'];
    }

    public abstract function doPrediction ($results);
}