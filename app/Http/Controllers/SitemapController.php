<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poster;

class SitemapController extends Controller
{
    public function index()
    {
        $all_posts = Poster::where('status','1')->get();
        return response()->view('sitemap.index',[
            'all_posts' => $all_posts,
        ])->header('Content-Type','text/xml');
    }
    
}
