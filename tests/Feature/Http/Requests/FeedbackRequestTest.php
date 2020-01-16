<?php

namespace Tests\Feature\Http\Requests;

use App\Mail\FeedbackArrived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FeedbackRequestTest extends TestCase
{
    use FeedbackTrait;

    protected $verification = 'Vw82iwl';

    protected $email = 'eaWDsk2';

    public function test_message_is_required()
    {
        $field = 'mw2s8sJ';
        $this->sendFeedback( $this->validFields([$field => '']) )->assertSessionHasErrors($field);
    }    

    public function test_verification_is_required()
    {
        $field = $this->verification;
        $this->sendFeedback( $this->validFields([$field => '']) )->assertSessionHasErrors($field);
    }    

    public function test_verification_fails_on_wrong_answer_5_minus_3()
    {
        $field = $this->verification;

        $wrongAnswers = [
            '3', 'three', '2a'
        ];

        foreach ($wrongAnswers as $wrong) {
            $this->sendFeedback( $this->validFields([$field => $wrong]) )->assertSessionHasErrors([$field => 'The answer is invalid, please try again.']);
        }
    }      

    public function test_verification_passes_on_correct_answers_5_minus_3()
    {
        $field = $this->verification;

        $wrongAnswers = [
            '2', 'two', 'TWO', 
            'TWo', ' Two ', '   2    ',
        ];

        foreach ($wrongAnswers as $wrong) {
            $this->sendFeedback( $this->validFields([$field => $wrong]) )->assertSessionDoesntHaveErrors($field);
        }
    }   

    public function test_if_present_then_email_must_be_valid()
    {
        $field = $this->email;

        $wrongAnswers = [
            'fake', 'fake@',  
        ];

        foreach ($wrongAnswers as $wrong) {
            $this->sendFeedback( $this->validFields([$field => $wrong]) )->assertSessionHasErrors($field);
        }
    }    


}
