<?php

namespace Tests\Feature\Http\Requests;

use App\Mail\FeedbackArrived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

class PostRequestTest extends TestCase
{
    use PostTrait;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function test_title_is_required()
    {
        $field = 'title';

        $this->withExceptionHandling();
        $response = $this->post('maker/post', ['title' => '']);
        // dd($response->message);

        $response->assertSessionHasErrors($field);
        // $this->sendFeedback( $this->validFields([$field => '']) )->assertSessionHasErrors($field);
    }    

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_verification_is_required()
    {
        $field = 'verification';
        $this->sendFeedback( $this->validFields([$field => '']) )->assertSessionHasErrors($field);
    }    

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_verification_fails_on_wrong_answer_5_minus_3()
    {
        // nothing else
        $field = 'verification';

        $wrongAnswers = [
            '3', 'three', '2a'
        ];

        foreach ($wrongAnswers as $wrong) {
            $this->sendFeedback( $this->validFields([$field => $wrong]) )->assertSessionHasErrors($field);
        }

        // Mail::fake();

        // // only 2 or two
        // $this->sendFeedback( $this->validFields([$field => '2']) );
        // $this->sendFeedback( $this->validFields([$field => 'two']) );

        // Mail::assertSent(FeedbackArrived::class, 2);
    }      

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_verification_passes_on_correct_answers_5_minus_3()
    {
        $field = 'verification';

        $wrongAnswers = [
            '2', 'two', 'TWO', 
            'TWo', ' Two ', '   2    ',
        ];

        foreach ($wrongAnswers as $wrong) {
            $this->sendFeedback( $this->validFields([$field => $wrong]) )->assertSessionDoesntHaveErrors($field);
        }
    }    

}
