<?php

namespace DiscoverData\Client;

use DiscoverData\Support\Path;
use DiscoverData\Traits\Cache;

class Receita
{
    use Cache;

    public function __construct()
    {
        $this->initCache();
    }

    public function requestCaptcha()
    {
        //
    }

    public function requestCnpjInfo()
    {
        //
    }

    public function getCookieName($cnpj)
    {
        return "cookie_cnpj_{$cnpj}";
    }
}
