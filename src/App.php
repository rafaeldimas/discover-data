<?php

namespace DiscoverData;

use DiscoverData\Client\Captcha;
use DiscoverData\Client\Receita;

class App
{
    public static function init()
    {
        var_dump('teste');
        $cnpj = '27865757000102';
        var_dump($cnpj);
        $receitaService = new Receita();
        $captchaService = new Captcha();
        $captcha = $receitaService->requestCaptcha($cnpj);
        var_dump($captcha);
        $captchaId = $captchaService->requestCaptcha($captcha);
        var_dump($captchaId);
        $captchaSolved = $captchaService->requestCaptchaRes($captchaId);
        var_dump($captchaSolved);
        var_dump($receitaService->requestCnpjHtml($cnpj, $captchaSolved));
    }
}
