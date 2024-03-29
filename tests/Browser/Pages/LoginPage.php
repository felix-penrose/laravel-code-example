<?php

namespace Tests\Browser\Pages;

use App\User;
use Laravel\Dusk\Browser;

class LoginPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
    }



    /**
     * Abstract the Login functionality
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @param  string  $name
     * @return void
     */
    public function login_user(Browser $browser)
    {
        $browser->loginAs(User::where('email', 'test@test.com')->firstOrFail());
    }
}
