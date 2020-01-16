<?php

namespace Tests\Feature\Http\Requests;

trait FeedbackTrait
{
    public function validFields($overrides = [])
    {
        return array_merge([
            'n3kIad3' => 'Ali',
            'eaWDsk2' => 'kiscon.io@gmail.com',
            'mw2s8sJ' => 'hello you are doing a great job...',
            'Vw82iwl' => '2',
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
