<?php

namespace DiscoverData\Client;

use DiscoverData\Support\Cache;
use DiscoverData\Support\Config;
use GuzzleHttp\Client;

class Receita
{
    private $cache;
    private $client;

    private $defaultHeaders = [
        'Host' => 'www.receita.fazenda.gov.br',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; rv:53.0) Gecko/20100101 Firefox/53.0',
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language' => 'pt-BR,pt;q=0.8,en-US;q=0.5,en;q=0.3',
        'Connection' => 'keep-alive',
        'Upgrade-Insecure-Requests' => '1',
    ];

    public function __construct()
    {
        $this->cache = Cache::getInstance();
        $this->client = new Client([
            'cookies' => true,
            'headers' => $this->defaultHeaders,
        ]);
    }

    protected function requestCookie($cnpj)
    {
        if (!$this->cache->exists($this->cookiesRequestedKey($cnpj))) {
            $this->client->get(Config::get('receita.request'));
        }
    }

    public function requestCaptcha($cnpj)
    {
        $this->requestCookie($cnpj);
        $response = $this->client->get(Config::get('receita.captcha'));
        if ($response->getStatusCode() !== 200) {
            return false;
        }
        return (string) $response->getBody();
    }

    public function requestCnpjInfo()
    {
        //
    }

    public function cookiesRequestedKey($cnpj)
    {
        return "cookie_cnpj_{$cnpj}";
    }
}
