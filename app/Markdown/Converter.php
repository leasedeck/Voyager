<?php

namespace App\Markdown;

/**
 * Interface Converter
 *
 * @package App\Markdown
 */
interface Converter
{
    /**
     * Interface definition for the markdown rendering method.
     *
     * @param  string $markdown The markdown string that needs to be converted.
     * @return string
     */
   public function toHtml(string $markdown): string;
}
