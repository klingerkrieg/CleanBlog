<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function list(Request $request){
        return view("admin.posts.index", 
        ["list"=>Post::paginate(3)]);
    }
    
    public function create(){
        return view("admin.posts.form", ["data"=>new Post()]);
    }

    public function store(Request $request){
        Post::create($request->all());
        return redirect()->back()->with("success","Data saved!");
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route("post.list"))->with("success","Data deleted!");
    }

    #abre o formulario de edição
    public function edit(Post $post){
        return view("admin.posts.form",["data"=>$post]);
    }

    #salva as edições
    public function update(Post $post, Request $request) {
        $post->update($request->all());
        return redirect()->back()->with("success","Data updated!");
    }

    
    
}
