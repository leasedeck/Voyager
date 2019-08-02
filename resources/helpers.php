<?php

if (! function_exists('avatar')) {
    function avatar($name): string {
        return Avatar::create($name)->toGravatar();
    }
}

if (! function_exists('md_to_html')) {
    function md_to_html(string $markdown): string {
        return app(App\Markdown\Converter::class)->toHtml($markdown);
    }
}
