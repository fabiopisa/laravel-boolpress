<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags= Tag::all();
        $categories = Category::all();
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['slug']=Str::slug($data['title'],'-');
        $slug_exsist=Post::where('slug',$data['slug'])->first();
        $counter = 0;
        while($slug_exsist){
            $title=$data['title'] . "-" . $counter;
            $data['slug']=Str::slug($title,'-');
            $slug_exsist=Post::where('slug',$data['slug'])->first();
            $counter++;
        }
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
        //verifichimao l'esistenza della chiave dentro 
        //l'array data con questo comando nella condizione if
        if(array_key_exists('tags',$data)){
            //uso la funzione attach per dirgli che nel nuovo ost i tags sono dentro
            //$data['tags'] e quindi di prenderli e pusharli nella tabella 
            //post_tag di intermezzo
            $new_post->tags()->attach($data['tags']);
        }
        return redirect()->route('admin.posts.show',$new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        if($post){
            return view('admin.posts.show', compact('post'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories = Category::all();
        $tags= Tag::all();
        if($post){
            return view('admin.posts.edit', compact('post','categories','tags'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();
        if($post->title === $post->slug){
            $data['slug'] = $post->slug;
        }else{
            $data['slug']=Str::slug($data['title'],'-');
            $slug_exsist=Post::where('slug',$data['slug'])->first();
            $counter = 0;
            while($slug_exsist){
                $title=$data['title'] . "-" . $counter;
                $data['slug']=Str::slug($title,'-');
                $slug_exsist=Post::where('slug',$data['slug'])->first();
                $counter++;
            }
        }
        $post->update($data);
        //se la chiave tags esiste dentro l'array $data
        if(array_key_exists('tags',$data)){
            //se esiste gli faccio il sync dentro post->tags di $data['tags']
            $post->tags()->sync($data['tags']);
        }else{
            //con il detach se non c'è più il collegamento perchè cambia il tag allora si cancella in tabella post_tag il collegamento
            $post->tags()->detach();
        }
        return redirect()->route('admin.posts.show',$post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
