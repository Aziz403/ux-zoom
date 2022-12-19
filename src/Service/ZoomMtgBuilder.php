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

    public function createZoom(
        string $meetingNumber,
        string $userName,
        string $passWord,
        string $leaveUrl = 'window.location',
        int $role = 1,
        string $userEmail = '',
        string $lang = 'en-US'
    ): ZoomMtg
    {
        return new ZoomMtg(
            $this->sdkKey,
            $this->sdkSecret,
            [
                'meetingNumber' => $meetingNumber,
                'userName' => $userName,
                'passWord' => $passWord,
                'leaveUrl' => $leaveUrl,
                'role' => $role,
                'userEmail' => $userEmail,
                'lang' => $lang
            ]
        );
    }
}