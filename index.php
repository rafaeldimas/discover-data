<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'bootstrap/app.php';

$cnpjs = [
    '27865757000102',
    '07282380000143',
    '25308323000178',
    '09296295000160',
    '61190658000106',
    '61532644000115',
    '04732914000106',
    '03991201000196',
    '02575829000148',
];

//
//$client = new Client([
//    'base_uri' => 'https://www.receitaws.com.br/v1/cnpj/',
//    'timeout' => 2.0,
//    'http_errors'=> true,
//]);
//
//$data = [];
//$rate = 3;
//foreach ($cnpjs as $cnpj) {
//    if ($rate <= 0) {
//        sleep(60);
//    }
//    try {
//        $response = $client->get($cnpj);
//        $rate = (int) $response->getHeader('X-RateLimit-Remaining')[0];
//        $dataJson = json_decode((string) $response->getBody());
//        $data[$cnpj] = $dataJson;
//    } catch (ClientException $e) {
//        $data[$cnpj] = \GuzzleHttp\Psr7\str($e->getResponse());
//        --$rate;
//    } catch (Exception $e) {
//        $data[$cnpj] = $e->getMessage();
//        --$rate;
//    }
//}
//echo '<pre>';
//var_dump($data);
//echo '</pre>';
