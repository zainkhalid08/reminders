<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Mail\FeedbackArrived;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    /**
     * Shows the admin's dashboard
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedback');
    }


    /**
     * Stored the feedback
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {
    	$feedback = Feedback::create([
    		'name' => $request['name'],
    		'email' => $request['email'],
    		'message' => $request['message'],
    	]);

    	// send mail
    	Mail::to(config('admin.email'))->send(new FeedbackArrived($feedback));
    	// flash message back
    	// return (new FeedbackArrived($feedback))->render();
    	return back();
    }

}
