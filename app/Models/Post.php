<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Post extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "publish_date",
        "image",
        "subject",
        "text",
        "slug"
    ];

    protected $dates = [
        "publish_date"
    ];


    public function setSubjectAttribute($subject){
        $this->attributes["subject"] = $subject;
        if ($this->slug != "")
            return;#evitar que seja alterado
        $post = Post::withTrashed()
                        ->orderByDesc("id")
                        ->first();
        $id = "";
        if ($post){
            $id = "_".($post->id + 1);
        }
    
        $this->attributes["slug"] = Str::slug($subject).$id;
    }
    
    

}
