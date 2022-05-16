<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $titles = Post::select('title')->get();
        return view('home',  compact('titles'));
    }

    public function allPosts(){
        //$posts = DB::table('posts')->paginate(2);

        $posts = Post::where('user_id', Auth::user()->id)->paginate(3);
        return view('posts.all-posts', compact('posts'));
    }

    public function getchart(){
        $data = DB::table('my_chart_data')->get();
        return view('posts.chart', compact('data'));
    }
}
