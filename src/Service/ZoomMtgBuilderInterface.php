<?php

namespace Aziz403\UX\Zoom\Service;

use Aziz403\UX\Zoom\Model\ZoomMtg;

interface ZoomMtgBuilderInterface
{
    public function createZoom(
        string $meetingNumber,
        string $userName,
        string $passWord,
        string $leaveUrl,
        int $role,
        string $userEmail,
        string $lang
    ): ZoomMtg;
}