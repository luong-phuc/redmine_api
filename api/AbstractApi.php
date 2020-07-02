<?php

namespace Api;

abstract class AbstractApi
{
    public function __construct(\Redmine\Client $client)
    {
        $this->client = $client;
        $this->logger = new \Common\Log();
    }
}
