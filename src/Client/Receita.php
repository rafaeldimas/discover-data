<?php

namespace DiscoverData\Client;

use DiscoverData\Support\Path;

class Receita
{
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
