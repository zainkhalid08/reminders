<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WelcomeControllerView extends TestCase
{
    /**
     * The older posts text on the button.
     *
     * @var string
     */
    protected $olderPostsText = 'Older Sermons';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testButtonsAndLinksArePresent()
    {
        $this->get('/')
            ->assertSeeText('Feedback')
            ->assertSeeText('Thanks')
            ->assertSeeText(config('app.name'))
            ->assertSee('Creative Commons License');
    } 

    // VISUAL
    // buttons and links are present
    // post card
    // redirects
        // icon 
        // feedback
        // thanks
        // cc
        // post title
        // older posts
    
}
