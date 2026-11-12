<?php

namespace App\Service\Scanner;

class HTMLAnalyzer
{
    public function countWords(string $text): int
    {
        return str_word_count($text);
    }
}