<?php

namespace App\Http\Controllers;
use App\Post;
use App\Categories;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatepostRequest;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('VerifyCategory')->only(['create','store']); //using middleware
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Categories::all())->with('tags',Tag::all())->with('user',User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //upload image 
      $image=$request->img->store('posts');
      $post=Post::create([
          'title'=>$request->title,
          'description'=>$request->des,
          'content'=>$request->content,
          'img'=>$image,
          'published_at'=>$request->pub_at,
          'categories_id'=>$request->category,
          'user_id'=>auth()->user()->id
      ]);
      if($request->tags){
          $post->tags()->attach($request->tags);
      }
      session()->flash('success','Post has been created');
      return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Categories::all())->with('tags',Tag::all());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepostRequest $request,Post $post)
    {
       
        //check if new image
        if($request->hasFile('img')){
             //upload it
            $image=$request->img->store('posts');
             //delete old
           $post->deleteImage();
            $post->update([
                'img'=>$image
            ]);
        }
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
         //update
        $post->update([
            'title'=>$request->title,
            'description'=>$request->des,
            'content'=>$request->content,
            'published_at'=>$request->pub_at,       
            'categories_id'=>$request->category
        ]);
        //message
        session()->flash('success','Post updated successfully');
        //redirect
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first(); //query
      
        if($post->trashed()){
         $post->deleteImage();
            $post->forceDelete();
        }
        else{
            $post->delete();
        }
        session()->flash('success','Deleted  Successfully');
        return redirect(route('posts.index'));
    }
    /**
     * Display all trahsed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
        $trashed=Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }
     /**
     * Display all trahsed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id){ //here we dont use use route binding because post is trashed
        $post=Post::withTrashed()->where('id',$id)->first(); 
        $post->restore();
        session()->flash('success','Restored Successfully');
        return redirect()->back();
        

    }
}
