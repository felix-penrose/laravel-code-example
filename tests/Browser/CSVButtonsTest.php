<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CSVButtonsTest extends DuskTestCase
{
    public $test_path = '/csv-editor';

    /** @test */
    public function add_column_btn_shows_new_column()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->on(new LoginPage)
                ->login_user()
                ->visit($this->test_path)
                ->click('.add_column_btn')
                ->assertVueContains('columns', [
                    'key' => 'new_column_0',
                ], '@csv')
                ->assertVisible('.reset_btn');
        });
    }


    /** @test */
    public function add_row_btn_shows_new_row()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->on(new LoginPage)
                ->login_user()
                ->visit($this->test_path)
                ->click('.add_row_btn')
                ->assertVueContains('rows', [
                    'first_name' => '',
                    'last_name' => '',
                    'email_address' => '',
                ], '@csv')
                ->assertVisible('.reset_btn');
        });
    }


    /** @test */
    public function reset_btn_resets_data()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->on(new LoginPage)
                ->login_user()
                ->visit($this->test_path)
                ->click('.add_row_btn')
                ->click('.reset_btn')
                ->assertDontSee('.reset_btn');
        });
    }


    // not complete - don't run right now
    public function export_btn_prompts_download()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->on(new LoginPage)
                ->login_user()
                ->visit($this->test_path)
                ->click('.export_btn');
                // ->waitForDialog(2) // doesn't work but something like this is what I'm after
        });
    }


    // not complete - don't run right now
    public function remove_row_btn_removes_row()
    {
        $this->browse(function (Browser $browser) {

            // pseudo - visit page, check current data value, click remove row
            //        - check data value against original data set and ensure it's length is one less
            $browser
                ->on(new LoginPage)
                ->login_user()
                ->visit($this->test_path)
                ->click('.remove_row_btn')
                ->assertVueContains('data', [
                ], '@csv');
        });
    }
}
