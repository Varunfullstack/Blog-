<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Validator,Redirect,Response;
 
use App\Models\Post;
 
class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::paginate(8);
        $data = '';
        if ($request->ajax()) {
            foreach ($posts as $post) {
                

                $data .='<div class="result"><h2>'.$post->title.'</h2><span>'.$post->description.'</span></div>';
            }
            return $data;
        }else{
           return view('posts');

        }
    }
}