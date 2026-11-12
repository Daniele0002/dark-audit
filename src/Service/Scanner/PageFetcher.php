<?php

namespace App\Service\Scanner;

class PageFetcher
{
    public function fetch(string $url): string
    {
        return "<html><body>Pagina analizzata: $url</body></html>";
    }
}