<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    // User Authentication
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // File Uploading
        if( $request->hasFile('cover_image') )
        {
            // Get file name with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $fileName.'_'.time().'.'.$fileExt;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        $post =  new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;
        $post->save();
        return redirect('Home')->with('success','The post has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // Check for correct user
        if( auth()->user()->id != $post->user_id )
        {
            return redirect('/posts')->with('error','The Post you are trying to edit/delete is not your content.');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
        
        // File Uploading
        if( $request->hasFile('cover_image') )
        {
            // Get file name with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $fileName.'_'.time().'.'.$fileExt;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
        
        $post =  Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if( $request->hasFile('cover_image') )
        {
            $post->cover_image = $filenameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success','Post was edited and successfully uploaded!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post =  Post::find($id);
        if( auth()->user()->id != $post->user_id )
        {
            return redirect('/posts')->with('error','The Post you are trying to edit/delete is not your content.');
        }
        if( $post->cover_image != 'noimage.jpg' )
        {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post was successfully deleted!');
    }
}
