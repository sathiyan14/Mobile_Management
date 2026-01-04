<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrService
{

    // public static function forEmail(string $data, int $size = 250): string
    // {
    //     $svg = QrCode::size($size)->generate($data); 
    //     $svg = str_replace('<svg', '<svg viewBox="0 0 200 200" width="200" height="200"', $svg);
    //     return $svg;
    // }

    public static function forEmail(string $data, int $size = 250): string
    {
        return base64_encode(
            QrCode::format('png')->size($size)->margin(2)->generate($data)        
        );
    }

    public static function forWeb(string $data, int $size = 250): string
    {
        $svg = QrCode::size($size)->generate($data);
        $svg = str_replace('<svg', '<svg viewBox="0 0 200 200" width="250" height="250" style="border: 2px solid #007bff; border-radius: 8px;"', $svg);
        return $svg;
    }
}
