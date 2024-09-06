<?php

namespace App\Kernel\Http;

class Redirect implements RedirectInterface
{
    public function to(string $url)
    {
        if (strpos($url, '/') !== 0) {
            $url = '/' . ltrim($url, '/');
        }
        header('Location: ' . $url);
        exit();
    }
}