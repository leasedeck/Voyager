<?php

namespace App\Providers;

use App\Markdown\Converter;
use App\Markdown\LeagueConverter;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;

class MarkdownServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Converter::class, static function (): LeagueConverter {
            return new LeagueConverter(new CommonMarkConverter(['html_input' => 'escape']));
        });
    }
}
