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

    /**
     * LeagueConverter constructor.
     *
     * @param  CommonMarkConverter $converter
     * @return void
     */
    public function __construct(CommonMarkConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Method to convert the markdown string to html.
     *
     * @param  string $markdown
     * @return string
     */
    public function toHtml(string $markdown): string
    {
        return $this->converter->convertToHtml($markdown);
    }
}
