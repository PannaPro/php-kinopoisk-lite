<?php

namespace App\Kernel\Config;

class Config implements ConfigInterface
{
    private array $cachedConfig = [];

    /**
     * @param string $keys
     * @param null $default
     * @return mixed
     */
    public function get(string $keys, $default = null): mixed
    {
        [$file, $key] = explode('.', $keys);

        if (!isset($this->cachedConfig[$file])) {
            $configPath = APP_PATH . "/config/$file.php";
            if (!file_exists($configPath)) {
                return $default;
            }
            $this->cachedConfig[$file] = require $configPath;
        }

        $config = $this->cachedConfig[$file];

        return $config[$key] ?? $default;
    }
}