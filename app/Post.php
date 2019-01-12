<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    protected $dates = ['published_at'];
    //fungsi untuk mengambil gambar
    public function getImageUrlAttribute($value){

    	$imageUrl = "";
    	if(!is_null($this->image)){
    		$imageUrl = $this->image;
    	}else{
    		$imageUrl = "";
    	}

    	return $imageUrl;
    }

    //menguhubungkan dengan model user agar setiap post memiliki penulis
    public function author(){
	return $this->belongsTo(User::class);
	}

    //menghubungkan post dan category
    public function category(){
    return $this->belongsTo(Category::class);
    }

	//Ganti data statis menggunakan method diffForHumans yang disediakan oleh Carbon
	public function getDateAttribute($value){
    return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

	// untuk menampilkan post yang terakhir terlebih dahulu.
	public function scopeLatestFirst($query){
	return $query->orderBy('created_at', 'desc');
	}

    //Buat scope published
    public function scopePublished($query){
    return $query->where("published_at", "<=", Carbon::now());
    }

    public function getBodyHtmlAttribute($value){
    return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL ;
    }

    public function getExcerptHtmlAttribute($value){
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL ;
    }


}
