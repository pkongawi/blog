<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

//We created a class called post with a static function called find. 
//We pass the slug as a function variable, which is also a wild card
//We stored the parth directtory in the $path variable
//If the path does not exist then through an exception 
//We also cache the url and return it

//make sure to include facades\File in the top of this file 
//Add a static method called all()
//Get all the posts based on their resource path and return them

class Post 
{
    use HasFactory;
 
    public static function all(){
        $files = File::files(resource_path("posts/"));

        return array_map(fn($file)=> $file->getContents(),$files);
    }


    public static function find($slug){

        if (! file_exists($path = resource_path("posts/{$slug}.html"))){
        throw new ModelNotFoundException();
        }
    
        return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));

    }
}

