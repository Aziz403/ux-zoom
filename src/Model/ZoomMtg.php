<?php

namespace Aziz403\UX\Zoom\Model;

class ZoomMtg
{
    private $controller;
    private $sdkKey;
    private $sdkSecret;
    private $config;

    public function __construct(string $sdkKey,string $sdkSecret,array $config)
    {
        $this->controller = "@aziz403/ux-zoom/controller";
        $this->sdkKey = $sdkKey;
        $this->sdkSecret = $sdkSecret;
        $this->config = $config;
    }

    public function createView(): array
    {
        return [
            'sdkKey' => $this->sdkKey,
            'sdkSecret' => $this->sdkSecret,
            'config' => $this->config
        ];
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController(string $controller)
    {
        $this->controller = $controller;
    }
}