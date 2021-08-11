<?php

namespace App\Http\Controllers\Portal\Detail;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function index(Request $request,$slug)
    {
        $title = 'Detail Blog';
        $data = Blog::firstWhere('slug',$slug);
        $blog_baru = Blog::limit(4)->orderBy('created_at','desc')->get();
        return view('portal.detail', compact('data','blog_baru','title'));
        
    }
}
