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
        $meta = [
            'description' =>   'Blogs on friday sermons of masjid al haram updated every 2 weeks or earlier.',
        ];
        return view('feedback', ['meta' => $meta]);
    }

    /**
     * Stored the feedback
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {
        try {

        	$feedback = Feedback::create([
        		'name' => $request['n3kIad3'],
        		'email' => $request['eaWDsk2'],
        		'message' => $request['mw2s8sJ'],
        	]);

        	// send mail
        	Mail::to(config('admin.email'))->send(new FeedbackArrived($feedback));

        } catch (\Exception $e) {

            report($e);
            logger()->debug('mail wasn\'t sent in feedback');
            return back()->with('message', ['fail', 'Something didn\'t go according to plan. Kindly leave your feedback at remindersforgood@gmail.com, apologies for the inconvinence.', 420000]); // 7mins

        }
        
    	// return (new FeedbackArrived($feedback))->render();
    	return back()->with('message', ['success', 'Your message has been sent. Thanks for the feedback.']);
    }

}
