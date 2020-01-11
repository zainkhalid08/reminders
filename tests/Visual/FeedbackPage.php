<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FeedbackPage extends TestCase
{
    protected $postUrl = '/feedback';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testInputFieldsArePresent()
    {
        $this->get('/')
            ->assertSeeText('Feedback')
            ->assertSeeText('Thanks')
            ->assertSeeText(config('app.name'));
    }    

}
