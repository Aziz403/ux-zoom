<?php

namespace Aziz403\UX\Zoom\Service;

use Aziz403\UX\Zoom\Model\ZoomMtg;

interface ZoomMtgBuilderInterface
{
    public function createZoom(array $options): ZoomMtg;
}