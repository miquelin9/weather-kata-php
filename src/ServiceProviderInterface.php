<?php
interface ServiceProviderInterface
{
    public function doPrediction(string $city, \DateTime $datetime);
}