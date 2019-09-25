<?php

namespace DiscoverData\Client;

use DiscoverData\Support\Cache;
use DiscoverData\Support\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SessionCookieJar;

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
            $this->cache->set($this->cookiesRequestedKey($cnpj), true);
        }
    }

    public function requestCaptcha($cnpj)
    {
        $this->requestCookie($cnpj);
        $response = $this->client->get(Config::get('receita.captcha'), [
            'headers' => [ 'referer' => Config::get('receita.request') ],
        ]);
        var_dump($response);
        if ($response->getStatusCode() !== 200) {
            return false;
        }
        return (string) $response->getBody();
    }

    public function requestCnpjHtml($cnpj, $captchaSolved)
    {
        if (!$cnpj || !$captchaSolved) return false;
        $response = $this->client->post(Config::get('receita.validation'), [
            'form_params' => [
                'submit1' => 'Consultar',
                'origem' => 'comprovante',
                'cnpj' => $cnpj,
                'txtTexto_captcha_serpro_gov_br' => $captchaSolved,
                'search_type' => 'cnpj',
            ],
            'headers' => [
                'referer' => Config::get('receita.referer'),
            ],
            'cookies' => new CookieJar(false, [
                [
                    'Name' => 'flag',
                    'Value' => 1,
                    'Domain' => 'www.receita.fazenda.gov.br',
                    'Path' => '/pessoajuridica/cnpj/cnpjreva/',
                ],
            ]),
        ]);
        return (string) $response->getBody();
    }

    public function cookiesRequestedKey($cnpj)
    {
        return "cookie_cnpj_{$cnpj}";
    }
}
