<?php

namespace App\Service\Scanner;

class SitemapReader
{
    public function read(string $url): array
    {
        return [
            'https://example.com/',
            'https://example.com/about',
            'https://example.com/products'
        ];
    }
}