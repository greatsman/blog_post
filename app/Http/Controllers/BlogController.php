<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    //
    protected $limit = 5;//limit untuk setiap halaman
 	
 	//menampilkan semua index pada halaman index blog
	public function index(){
 
		$posts = Post::with('author')
				->latestFirst()
				->published()
				->paginate($this->limit);
				
		return view("blog.index", compact('posts'));
	}

	//menampilkan postingan blog
	public function show(Post $post){

	return view("blog.show", compact('post'));
	}
}
