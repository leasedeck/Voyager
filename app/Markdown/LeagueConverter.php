<?php

namespace App\Markdown;

use League\CommonMark\CommonMarkConverter;

/**
 * Class LeagueConverter
 *
 * @package App\Markdown
 */
final class LeagueConverter implements Converter
{
    /**
     * @var \League\CommonMark\CommonMarkConverter
     */
    private $converter;

    public function __construct(CommonMarkConverter $converter)
    {
        $this->converter = $converter;
    }
    public function toHtml(string $markdown): string
    {
        return $this->converter->convertToHtml($markdown);
    }
}
