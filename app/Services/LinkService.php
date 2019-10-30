<?php

namespace App\Services;

class LinkService
{
    public function generateUrl(string $deviceId, string $token): string
    {
        return 'http://api.looko2.com/?method=GetLOOKO&id=' . $deviceId . '&token=' . $token;
    }
}
