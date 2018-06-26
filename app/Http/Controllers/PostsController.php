<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if ($categories->count() == 0) {
            Session::flash('info', 'Please create category first in order to add Posts');

            return redirect()->route('category.create');
        }

        $post = new Post;

        return view('admin.posts.create')->with('categories', Category::all())->with('post', $post)->with('tags', Tag::all())->with('tag_ids', array());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = 0)
    {
        $arr = array(
                    'title' => 'required|max:255',
                    'featured' => 'required|image',
                    'category_id' => 'required',
                    'content' => 'required',
                    'tags' => 'required'
                );
        if (!empty($id)) {
            unset($arr['featured']);
        }
        $this->validate($request, $arr);

        if ($request->hasFile('featured')) {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/posts', $featured_new_name);
        }

        if (!empty($id)) {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->content = $request->content;
            if (!empty($featured_new_name)) {
                $post->featured = $featured_new_name;
            }
            $post->category_id = $request->category_id;
            $post->slug = str_slug($request->title);
            $post->save();
            $post->tags()->sync($request->tags);
        }

        if (empty($id) || empty($post)) {
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'featured' => 'uploads/posts/'.$featured_new_name,
                'category_id' => $request->category_id,
                'slug' => str_slug($request->title)
            ]);

            $post->tags()->attach($request->tags);
        }

        Session::flash('Success', 'Post has been saved');

        return redirect()->route('posts');

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
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tag_ids = array();
        foreach($post->tags as $t) {
            $tag_ids[] = $t->id;
        }

        return view('admin.posts.create')->with('categories', $categories)->with('post', $post)->with('tags', Tag::all() )->with('tag_ids', $tag_ids);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        Session::flash("Success", "Post trashed successfully");

        return redirect()->back();
    }

    public function trashed() {
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trashed')->with('posts', $posts);        
    }

    
    /**
     * Remove the specified resource from storage permenantly.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perdelete($id) {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        Session::flash("Success", "Post deleted successfully");
        return redirect()->back();
    }

    public function restore($id) {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        Session('Success', 'Post restored successfully');
        return redirect()->route('posts');
    }
}
