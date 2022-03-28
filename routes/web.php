<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\FrontMatter\Data\LibYamlFrontMatterParser;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('posts',[
    'posts' => Post::all()
  ]);
});

Route::get('posts/{post}', function($slug){

    //find a post by its slug and pass it to a view called "post"
    //Created a model with a class of post and imported it to the top of this file
    //The Post class imported the slug and returned url
    $post = Post::find($slug);
    
    return view('post', [
        'post' => $post
    ]);
})->where('post', '[A-z_\-]+');