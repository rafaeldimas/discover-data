<?php

namespace DiscoverData\Client;

use DiscoverData\Support\Cache;
use DiscoverData\Support\Config;
use GuzzleHttp\Client;

class Captcha
{
    private $cache;
    private $client;

    public function __construct()
    {
        $this->cache = Cache::getInstance();
        $this->client = new Client();
    }

    public function requestCaptcha($captcha)
    {
        $response = $this->client->post(Config::get('2captcha.in'), [
            'form_params' => [
                'method' => 'base64',
                'json' => 1,
                'key' => Config::get('2captcha.api_key'),
                'body' => $this->imageToUrlBase64($captcha),
            ],
        ]);
    }

    protected function imageToUrlBase64($img)
    {
        return 'data:image/png;base64'.base64_encode($img);
    }
}
