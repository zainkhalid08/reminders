<?php

namespace Tests\Feature\Http\Requests;

trait FeedbackTrait
{
    public function validFields($overrides = [])
    {
        return array_merge([
            'name' => 'Ali',
            'email' => 'kiscon.io@gmail.com',
            'message' => 'hello you are doing a great job...',
            'verification' => '2',
        ], $overrides);

    }    

    public function getFeedbackUrl()
    {
    	return route('feedback');
    }

    public function getFeedbackStoreUrl()
    {
        return route('feedback.store');
    }
    
    protected function sendFeedback($attributes = [])
    {
        $this->withExceptionHandling();
        return $this->post( $this->getFeedbackUrl(), $this->validFields($attributes));

    }    
}
