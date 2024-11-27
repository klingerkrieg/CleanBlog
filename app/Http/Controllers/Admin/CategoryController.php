<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller {
    public function list(Request $request){
        $pagination = Category::orderBy("name");
        #$pagination->dd();
        #$pagination->dump();
        return view("admin.categories.index", ["list"=>$pagination->paginate(3)]);

    }
    
    public function create(){
        $postsList = Post::all();
        return view("admin.categories.form", ["data"=>new Category(),
                                                         "postsList"=>$postsList]);
    }

    public function store(Request $request){
        $validated = $this->validator($request)->validate();
        $obj = Category::create($validated);
        return redirect(route('category.edit', $obj))->with("success","Data saved!");
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect(route("category.list"))->with("success","Data deleted!");
    }

    #abre o formulario de edição
    public function edit(Category $category){
        $postsList = Post::all();

        
        $posts = Post::select("posts.*","category_posts.id as category_post_id")
                        ->join("category_posts","category_posts.post_id","=","posts.id")
                        ->where("category_id",$category->id)->paginate(2);

        return view("admin.categories.form",["data"=>$category,
                                                        "posts"=>$posts,
                                                        "postsList"=>$postsList]);
    }

    public function desvincular(CategoryPost $category_post){
        $category_post->delete();
        return redirect()->back()->with("success",__("Data deleted!"));
    }
    

    #salva as edições
    public function update(Category $category, Request $request) {
        $validated = $this->validator($request)->validate();
        $category->update($validated);

        #$post = Post::find($request["post_id"]);
        #if ($post != null){
        if ($request["post_id"]) {
            #na documentação consta esse método
            #funciona, mas não insere os timestamps
            #$category->posts()->attach($post);
            CategoryPost::updateOrCreate(["post_id"=>$request["post_id"],"category_id"=>$category->id]);
        }
        
        return redirect()->back()->with("success","Data updated!");
    }


    private function validator(Request $request){
        $rules = [
            'name' => 'required|max:250',
            'post_id' => 'nullable|exists:posts,id',
        ];
        return Validator::make($request->all(), $rules);
    }
    

    
    
}
