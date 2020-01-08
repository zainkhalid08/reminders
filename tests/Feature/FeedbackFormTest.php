<?php

namespace Tests\Feature;

use App\Mail\FeedbackArrived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FeedbackFormTest extends TestCase
{
    protected $postUrl = '/feedback';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testMessageIsRequired()
    {
        $field = 'message';
        $this->sendFeedback( $this->validFields([$field => '']) )->assertSessionHasErrors($field);
    }    

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVerificationIsRequired()
    {
        $field = 'verification';
        $this->sendFeedback( $this->validFields([$field => '']) )->assertSessionHasErrors($field);
    }    

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVerificationRequiredCorrectAnswer5Minus3()
    {
        // nothing else
        $field = 'verification';
        $this->sendFeedback( $this->validFields([$field => '3']) )->assertSessionHasErrors($field);

        Mail::fake();

        // only 2 or two
        $this->sendFeedback( $this->validFields([$field => '2']) );
        $this->sendFeedback( $this->validFields([$field => 'two']) );

        Mail::assertSent(FeedbackArrived::class, 2);
    }      

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFeedbackMailIsSent()
    {
        $response = $this->get('/');
        Mail::fake();

        $this->post( $this->postUrl, $this->validFields());

        Mail::assertSent(FeedbackArrived::class);
        // Mail::assertQueued(FeedbackArrived::class);
    }



    protected function sendFeedback($attributes = [])
    {
        $this->withExceptionHandling();
        return $this->post( $this->postUrl, $this->validFields($attributes));

    }

    protected function validFields($overrides = [])
    {
        return array_merge([
            'name' => 'Ali',
            'email' => 'kiscon.io@gmail.com',
            'message' => 'hello you are doing a great job...',
            'verification' => '2',
        ], $overrides);

    }
}
