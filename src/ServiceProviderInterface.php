<?php

namespace Codium\CleanCode;

interface ServiceProviderInterface
{
    public function doPrediction(string $city, \DateTime $datetime);
}