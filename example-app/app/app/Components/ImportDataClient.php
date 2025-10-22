<?php

namespace App\app\Components;

use GuzzleHttp\Client;

class ImportDataClient
{
    public $client;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

        $this->client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com/',
            'timeout'  => 3.0,
            'verify' => false,
        ]);
    }
}
