<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\SeoHelper;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    use SeoHelper;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
        $seo = [
            'title' => 'Blog On Friday Sermons Of Masjid Al Haram | Reminders For Good',
            'meta' => [
                'description' => 'Blogs on friday sermons of masjid al haram updated every 2 weeks or earlier.'
            ],
        ];
        $seo = $this->mergeWithTemplate($seo);

        // dd($this->template());
        $posts = Post::latestPublishedFirst()->limit(config('post.welcome'))->get();
    	$total = $posts->count();
	    return view('welcome', compact('posts', 'total', 'seo'));
    }
}
