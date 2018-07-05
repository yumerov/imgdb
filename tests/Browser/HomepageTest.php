<?php

namespace Tests\Browser;

use Tests\Browser\Pages\HomePage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

/**
 * Class HomepageTest
 *
 * @package Tests\Browser
 */
class HomepageTest extends DuskTestCase
{

    /**
     * @throws \Throwable
     */
    public function test_visit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new HomePage)
                ->screenshot("k");
        });
    }
}
