<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class HomePage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url(): string
    {
        return '/';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assert(Browser $browser): void
    {
        //
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string>
     */
    public function elements(): array
    {
        return [
            '@element' => '#selector',
        ];
    }
}
