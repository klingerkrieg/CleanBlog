<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PostController extends Controller {
    public function list(Request $request){
        $pagination = Post::orderBy("subject");

        if (isset($request->subject) && $request->subject != "")
            $pagination->where("subject","like","%$request->subject%");
        if (isset($request->text))
            $pagination->where("text","like","%$request->text%");
        if (isset($request->publish_date))
            $pagination->whereDate("publish_date", $request->publish_date);

        #$pagination->dd();
        #$pagination->dump();
        return view("admin.posts.index", ["list"=>$pagination->paginate(3)]);

    }
    
    public function create(){
        $users = User::all();
        return view("admin.posts.form", data: ["data"=>new Post(), "users"=>$users]);
    }

    public function store(Request $request){
        $validated = $this->validator($request)->validate();

        #Salva a imagem na pasta
        $data = $this->armazenaImagem($request);
        $validated['image'] = $data['image'];

        
        #Pega a id do usuario que está logado
        #se eu quisesse que o dono sempre fosse o usuario que está
        #logado cadastrando a postagem
        #mas no caso, eu deixei funcionando o exemplo de forma que
        #o usuário pode ser escolhido por quem está cadastrando
        //$validated["user_id"] = Auth::user()->id;

        $obj = Post::create($validated);
        return redirect(route('post.edit', $obj))->with("success","Data saved!");
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route("post.list"))->with("success","Data deleted!");
    }

    #abre o formulario de edição
    public function edit(Post $post){
        $users = User::all();
        return view("admin.posts.form",["data"=>$post, "users"=>$users]);
    }

    #salva as edições
    public function update(Post $post, Request $request) {
        $validated = $this->validator($request)->validate();
        
        #Salva a imagem na pasta
        $data = $this->armazenaImagem($request);
        if (isset($data['image']))
            $validated['image'] = $data['image'];
        
        $post->update($validated);
        return redirect()->back()->with("success","Data updated!");
    }

    private function armazenaImagem(Request $request){
        #SALVA A IMAGEM NA PASTA
        $data = $request->all();
        if ($request->file('image') != null){
            $path = $request->file('image')->store("posts","public");
            #nao pode setar o photo do $request, pois nao irá funcionar
            $data["image"] = $path;
        }
        return $data;
    }


    private function validator(Request $request){
        $rules = [
            'subject' => 'required|max:250',
            'publish_date' => 'nullable|date',
            'text' => 'max:8000',
            'user_id' => 'exists:users,id'
        ];
    
        #somente obrigatório quando for um novo
        if ($request->method() == "POST"){
            $rules['image'] = 'required|image|max:1024';
        } else
        if ($request->method() == "PUT"){
            $rules['image'] = 'image|max:1024';
        }
    
        return Validator::make($request->all(), $rules);
    }
    

    
    
}
