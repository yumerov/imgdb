<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

/**
 * Class HomePage
 *
 * @package Tests\Browser\Pages
 */
class HomePage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $browser->assertSee("Recent images");
        $browser->assertSee("Recent tags");
    }
}
