<?php

namespace Tests\Feature\Http\Requests;

trait PostTrait
{
    public function validFields($overrides = [])
    {
        return array_merge([
            'title' => 'Last Day',
            'content' => 'kiscon.io@gmail.com',
            'message' => 'hello you are doing a great job...',
            'verification' => '2',
        ], $overrides);

    }    

    public function getPostStoreUrl()
    {
        return route('admin.post.store');
    }
    
    protected function sendFeedback($attributes = [])
    {
        $this->withExceptionHandling();
        return $this->post( $this->getFeedbackUrl(), $this->validFields($attributes));

    }    
}
