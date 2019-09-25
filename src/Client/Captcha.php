<?php

namespace DiscoverData\Client;

use DiscoverData\Support\Cache;
use DiscoverData\Support\Config;
use Exception;
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
            'form_params' => $this->parserParamsRequest([
                'method' => 'base64',
                'body' => $this->imageToUrlBase64($captcha),
            ]),
        ]);
        var_dump((string) $response->getBody());
        return $this->parserResponseBody((string) $response->getBody());
    }

    public function requestCaptchaRes($id)
    {
        $result = false;
        $toOrder = true;
        $count = 0;
        while ($toOrder) {
            sleep(5);
            $response = $this->client->get(Config::get('2captcha.res'), [
                'query' => $this->parserParamsRequest([
                    'action' => 'get',
                    'id' => $id,
                ]),
            ]);
            $captchaRes = $this->parserResponseBody((string) $response->getBody());
            if ($captchaRes || $count === 3) {
                $result = $captchaRes;
                $toOrder = false;
            }
            var_dump($count);
            $count++;
        }
        var_dump($result);
        return $result;
    }

    /**
     * @param string $responseBody
     * @return bool|string
     */
    protected function parserResponseBody(string $responseBody)
    {
        if (!$responseBody) return false;
        try {
            $json = json_decode($responseBody);
            if (!$json->status) throw new Exception('not_defined_handle_error');
            return $json->request;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $img
     * @return string
     */
    protected function imageToUrlBase64($img)
    {
        return 'data:image/png;base64,'.base64_encode($img);
    }

    /**
     * @param array $params
     * @return array
     */
    protected function parserParamsRequest(array $params)
    {
        $defaultParams = [
            'json' => 1,
            'key' => Config::get('2captcha.api_key'),
        ];
        return array_merge($defaultParams, $params);
    }
}
