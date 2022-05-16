<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $request) {

        $validation = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'required|image'
        ]);

        if($validation->fails()) {
            //$validation=$validation->errors();
            // $validation = json_decode($validation,true);
            // $tt = $validation['title'][0]; 
            // $ds = $validation['description'][0];        
            // $tn = $validation['thumbnail'][0];
            // $validations=$tt.$ds.$tn;
            // print_r($validations);
            // die();
            return back()->with('error', 'Something went wrong!');
        } else {
            $imageName = date("Y-m-d") .  time() . "." . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('thumbnails'), $imageName);
            
            // $date=date_create($request->date);
            // echo date_format($date,"m-d-Y H:i:s");
            // die();

            // die($request->date);

            Post::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail' => $imageName
            ]);
        }

       return redirect(route('posts.all'))->with('status', 'Post created successfully!');

    }

    public function show($postId) {

        $post = Post::findOrFail($postId);

        return view('posts.show', compact('post'));
    }

    public function edit($postId) {
        $post = Post::findOrFail($postId);
        return view('posts.edit', compact('post'));
    }

    public function update($postId, Request $request) {
        $imageName = date("Y-m-d") .  time() . "." . $request->thumbnail->extension();

        $request->thumbnail->move(public_path('thumbnails'), $imageName);

        Post::where('id',$postId)->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $imageName
        ]);

        return redirect(route('posts.all'))->with('status', 'Post updated!');
    }

    public function delete($postId) {
        Post::findOrFail($postId)->delete();
        return redirect(route('posts.all'));

    }

    public function search(Request $request) {
        
        // $post = Post::find('1')->get();
        // die($post);
        
        $posts = Post::select('*')
                ->where('title', '=', $request->title)
                ->paginate();
        //  die($posts);
        return view('posts.all-posts', compact('posts'));
      

    }
}
