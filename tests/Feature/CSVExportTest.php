<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CSVExportTest extends TestCase
{
    public $test_data = [
        'columns' => ['First Name', 'Last Name', 'Email Address'],
        'rows' => [
            ['John', 'Doe', 'john.doe@example.com'],
            ['John', 'Doe', 'john.doe@example.com'],
        ]
    ];

    public $test_path = '/api/csv-export';


    /** @test */
    public function valid_post_has_successful_response()
    {
        $response = $this->postJson($this->test_path, $this->test_data);
        $response->assertOK();
    }


    /** @test */
    public function response_is_csv()
    {
        $response = $this->postJson($this->test_path, $this->test_data);
        $response->assertHeader('Content-Disposition', 'attachment; filename="csv-export.csv"');
    }


    /** @test */
    public function response_has_expected_data()
    {
        $response = $this->postJson($this->test_path, $this->test_data);
        $content = $response->streamedContent();
        $this->assertStringContainsString('First Name', $content);
    }
}
