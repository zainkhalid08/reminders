<?php

namespace App\Http\Controllers;

use App\Traits\SeoHelper;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    use SeoHelper;
    
    /**
     * Shows the legal page
     * that should have
     * privacy, tos etc
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seo = [
            'title' => config('seo.legal.title'),
            'meta' => config('seo.legal.meta'), 
        ];
        $seo = $this->mergeWithTemplate($seo);

        return view('legal', ['seo' => $seo]);
    }

}
