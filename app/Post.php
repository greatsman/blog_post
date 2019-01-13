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
    
    //mengurutkan post dari yang terbanyak
    public function scopePopular($query){
    return $query->orderBy('view_count', 'desc');
    }

    public function getImageThumbUrlAttribute($value){

        $imageUrl = "";
        if(!is_null($this->image)){
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() . "/img/" . $thumbnail;
            if(file_exists($imagePath)) $imageUrl = asset("img/" . $thumbnail);
            $imageUrl = $this->image;
        }else{
            $imageUrl = "";
        }

        return $imageUrl;
    }

    public function formattedDate($showTimes = false){
    $format = "d/M/Y";
    if($showTimes) $format=$format." H:i:s";
    return $this->created_at->format($format);
    }

    public function publicationLabel(){
        if(!$this->published_at){
            return '<span class="badge badge-warning">Draft</span>';
        }elseif($this->published_at && $this->published_at->isFuture()){
            return '<span class="badge badge-info">Scheduled</span>';
        }else{
            return '<span class="badge badge-success">Published</span>';
        }
    }



}
