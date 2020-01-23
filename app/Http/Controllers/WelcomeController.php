<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\SeoHelper;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    use SeoHelper;

    /**
     * Welcome page is the root page a visitor sees
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
        $seo = [
            'title' => config('seo.welcome.title'),
            'meta' => config('seo.welcome.meta'),
        ];
        $seo = $this->mergeWithTemplate($seo);

        $posts = Post::latestPublishedFirst()->limit(config('post.welcome'))->get();

    	$total = Post::published()->count(); // for showing older sermons button
        
	    return view('welcome', compact('posts', 'total', 'seo'));
    }
}
