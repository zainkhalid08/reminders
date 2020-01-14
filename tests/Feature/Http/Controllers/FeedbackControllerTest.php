<?php

namespace Tests\Feature;

use App\Feedback;
use App\Mail\FeedbackArrived;
use App\Post;
use App\Traits\InteractsWithEnv;
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
        InteractsWithEnv,
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

    /** @test */
    function test_mail_is_sent()
    {   
        Mail::fake();

        $data = $this->validFields();
        $response = $this->sendFeedback($data);

        Mail::assertSent(FeedbackArrived::class);
    }

    /** @test */
    function test_is_redirected_back()
    {   
        $data = $this->validFields();
        $response = $this->sendFeedback($data);

        $response->assertStatus(302);
    }

    // success means on feedback creation and mail sent
    function test_on_success_is_redirected_back_with_proper_message()
    {   
        $data = $this->validFields();
        $response = $this->sendFeedback($data);

        $response->assertSessionHas([ 'message' => ['success', 'Your message has been sent. Thanks for the feedback.'] ]);
    }    

    // failure means if anything goes wrong out of two(feedback creation and/or mail sending)
    // function test_on_failure_is_redirected_back_with_proper_message()
    // {   
    //     // set up 
    //     // $adminEmailOrginal = config('admin.email');
    //     $adminEmailOrginal = 'remindersforgood@gmail.com'; // working with this...
    //     // $adminEmailOrginal = env('ADMIN_EMAIL');
    //     $wrongEmail = 'wrongemailformat';


    //     $this->setEnv(['ADMIN_EMAIL' => $wrongEmail]);

    //     // VERY IMP as we are sending this response as an exception being handled. Is to be placed before the request
    //     $this->withExceptionHandling();

    //     $data = $this->validFields();
    //     $response = $this->sendFeedback($data);

    //     $this->setEnv(['ADMIN_EMAIL' => $adminEmailOrginal]);

    //     $response->assertSessionHas([ 'message' => ['fail', 'Something didn\'t go according to plan. Kindly leave your feedback at remindersforgood@gmail.com, apologies for the inconvinence.', 420000] ]);

    // } 

}
