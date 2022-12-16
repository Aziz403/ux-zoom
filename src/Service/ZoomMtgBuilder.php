<?php

namespace Aziz403\UX\Zoom\Service;

use Aziz403\UX\Zoom\Model\ZoomMtg;

class ZoomMtgBuilder implements ZoomMtgBuilderInterface
{
    private $sdkKey;
    private $sdkSecret;

    public function __construct(string $sdkKey,string $sdkSecret)
    {
        $this->sdkKey = $sdkKey;
        $this->sdkSecret = $sdkSecret;
    }

    public function createZoom(array $options): ZoomMtg
    {
        return new ZoomMtg($this->sdkKey,$this->sdkSecret,$options);
    }
}