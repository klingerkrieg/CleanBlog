<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller {
    public function list(Request $request){
        $pagination = User::orderBy("name");
        #$pagination->dd();
        #$pagination->dump();
        return view("admin.users.index", ["list"=>$pagination->paginate(3)]);

    }
    
    public function create(){
        return view("admin.users.form", ["data"=>new User()]);
    }

    public function store(Request $request){
        $validated = $this->validator($request)->validate();
        $obj = User::create($validated);
        return redirect(route('user.edit', $obj))->with("success","Data saved!");
    }

    public function destroy(User $user){
        $user->delete();
        return redirect(route("user.list"))->with("success","Data deleted!");
    }

    #abre o formulario de edição
    public function edit(User $user){
        $posts = Post::where("user_id",$user->id)->paginate(2);
        return view("admin.users.form",["data"=>$user,"posts"=>$posts]);
    }

    #salva as edições
    public function update(User $user, Request $request) {
        $validated = $this->validator($request)->validate();
        $user->update($validated);
        return redirect()->back()->with("success","Data updated!");
    }


    private function validator(Request $request){
        $rules = [
            'name' => 'required|max:250',
            'email' => 'required|email'
        ];
        return Validator::make($request->all(), $rules);
    }
    

    
    
}
