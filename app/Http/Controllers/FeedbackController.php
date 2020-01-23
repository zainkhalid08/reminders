<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Mail\FeedbackArrived;
use App\Traits\SeoHelper;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    use SeoHelper;

    /**
     * Shows the feedback page
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seo = [
            'title' => config('seo.feedback.title'),
            'meta' => config('seo.feedback.meta'), 
        ];
        $seo = $this->mergeWithTemplate($seo);

        return view('feedback', ['seo' => $seo]);
    }

    /**
     * Stores the feedback
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {
        try {

        	// $feedback = Feedback::create([
        	// 	'name' => $request['n3kIad3'],
        	// 	'email' => $request['eaWDsk2'],
        	// 	'message' => $request['mw2s8sJ'],
        	// ]);

        	// Mail::to(config('admin.email'))->send(new FeedbackArrived($feedback));

        } catch (\Exception $exception) {

            // logger()->debug('mail wasn\'t sent to admin on feedback arrival.');
            // report($exception);
            return back()->with('message', ['fail', 'Something didn\'t go according to plan. Kindly leave your feedback at remindersforgood@gmail.com, apologies for the inconvinence.', 420000]); // 7mins

        }
            return back()->with('message', ['fail', 'Something didn\'t go according to plan. Kindly leave your feedback at remindersforgood@gmail.com, apologies for the inconvinence.', 420000]); // 7mins
        
    	// return back()->with('message', ['success', 'Thanks for the feedback.', 420000]);
    }

}
