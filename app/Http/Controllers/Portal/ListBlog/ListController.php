<?php

namespace App\Http\Controllers\Portal\ListBlog;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Blog';
        $data = Blog::orderBy('created_at','desc')->paginate(10);
        $blog_baru = Blog::limit(4)->orderBy('created_at','desc')->get();
        return view('portal.list', compact('data','blog_baru','title'));
    }
}
