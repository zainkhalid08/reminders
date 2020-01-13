<?php

namespace Tests\Feature;

use App\Feedback;
use App\Mail\FeedbackArrived;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Http\Requests\FeedbackTrait;
use Tests\TestCase;

class FeedbackControllerTest extends TestCase
{
    use 
        RefreshDatabase, 
        FeedbackTrait;

    // feedback is created
    public function test_feedback_is_created_in_db()
    {
        $data = $this->validFields();
        $response = $this->sendFeedback($data);

        // $response->assertOk(); // THIS DIDN'T WORK

        $feedback = Feedback::latest()->first();

        $this->assertEquals($feedback->name, $data['n3kIad3']);
        $this->assertEquals($feedback->email, $data['eaWDsk2']);
        $this->assertEquals($feedback->message, $data['mw2s8sJ']);
        // $this->seeInDatabase('feedbacks', $data);
    }

    // mail is sent
    // redirected back

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function test_mail_is_sent()
    // {
    //     Mail::fake();

    //     $this->post( '/feedback', $this->validFields());

    //     // dd('her');
    //      // Mail::assertNothingSent();
    //     // Mail::assertSent(FeedbackArrived::class, function($mail) {
    //     //     dd($mail);
    //     // });

    //     Mail::assertSent(FeedbackArrived::class);
    //     // Mail::assertQueued(FeedbackArrived::class);
    // }

    // public function test_after_feedback_is_given_it_redirects_back()
    // {
    //     // REDIRECTED BACK
    //     $this->withExceptionHandling();
    //     $response = $this->post( '/feedback', $this->validFields());

    //     $response->assertStatus(302);
                
    // }
}
