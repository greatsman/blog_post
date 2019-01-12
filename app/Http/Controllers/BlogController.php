<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

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

	//menampilkan berdasarkan kategori
	public function category(Category $category){
		$categoryName = $category->title;

		$posts = $category->posts()
						->with('author')
						->latestFirst()
						->published()
						->paginate($this->limit);
				
		return view("blog.index", compact('posts','categoryName'));
	}


	//menampilkan postingan blog
	public function show(Post $post){

		return view("blog.show", compact('post'));
	}
    
    //menampilkan berdasarkan author
	public function author(User $author){
	$authorName = $author->name;

	$posts = $author->posts()
					->with('category')
					->latestFirst()
					->published()
					->paginate($this->limit);
			
	return view("blog.index", compact('posts','authorName'));
}
}
