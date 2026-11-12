<?php

namespace App\Service\Scanner;

class ScannerService
{
    public function __construct(
        private SitemapReader $sitemapReader,
        private PageFetcher $pageFetcher,
        private HTMLAnalyzer $htmlAnalyzer

    ) {
    }

    public function scan(string $url): array
    {
        $pages = $this->sitemapReader->read($url);

        $results = [];

        foreach ($pages as $pageUrl) {
            $html = $this->pageFetcher->fetch($pageUrl);
            $this->htmlAnalyzer->countWords($html);
          

            $results[] = [
                'url' => $pageUrl,
                'html' => $html
            ];
        }

        return $results;
    }
}