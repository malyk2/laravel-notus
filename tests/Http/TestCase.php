<?php

namespace Tests\Http;

use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $method = 'GET';

    protected $uri = 'api';

    protected function send(array $data = [])
    {
        return $this->json('POST', $this->uri, $data);
    }
}
