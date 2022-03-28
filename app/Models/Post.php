<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use League\CommonMark\Extension\FrontMatter\Data\LibYamlFrontMatterParser;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
 
    public $title;

    public $excerpt;

    public $date;

    public $body;

    public function __construct($title,$excerpt,$date,$body,$slug)
    {
        $this->title = $title;
        $this->exerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {

        return cache()->rememberForever('posts.all', function() {

            return collect(File::files(resource_path("posts")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) => new Post (
                    $document->title,
                    $document->exercpt,
                    $document->date,
                    $document->body(),
                    $document->slug
            ))
            ->sortByDesc('date');   

        }); 
    }


    public static function find($slug){

        return static::all()->firstWhere('slug', $slug);

    }
}

