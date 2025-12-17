<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrService
{
    /**
     * Generate SVG QR code (works without imagick)
     * Returns raw SVG string suitable for embedding in HTML/emails
     */
    public static function forEmail(string $data, int $size = 250): string
    {
        $svg = QrCode::size($size)->generate($data); // SVG format (default, no imagick needed)
        // Add viewBox and styling to SVG for better compatibility
        $svg = str_replace('<svg', '<svg viewBox="0 0 200 200" width="200" height="200"', $svg);
        return $svg;
    }

    /**
     * Generate SVG QR code for web display
     * Returns SVG string as HTML
     */
    public static function forWeb(string $data, int $size = 250): string
    {
        $svg = QrCode::size($size)->generate($data); // SVG
        // Add viewBox and styling to SVG for better compatibility
        $svg = str_replace('<svg', '<svg viewBox="0 0 200 200" width="250" height="250" style="border: 2px solid #007bff; border-radius: 8px;"', $svg);
        return $svg;
    }
}
