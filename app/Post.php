<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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


}
