<?php

namespace App\Http\Controllers\Portal\Home;

use App\Models\Blog;
use App\Models\Konfigurasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home';
        $blog = Blog::limit(3)->orderBy('created_at','desc')->get();
        $konfigurasi = Konfigurasi::first();
        return view('portal.home', compact('title','blog','konfigurasi'));
    }
}
