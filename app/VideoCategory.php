<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ModelHelper;

class VideoCategory extends Model{
	use ModelHelper;

	public $fillable = ['parent_id', 'category_name', 'featured', 'status', 'image'];

	public function videos(){
		return $this->hasMany('App\Video', 'category_id', 'id');
	}

	public function parent(){
		return $this->belongsTo('App\VideoCategory', 'parent_id', 'id');
	}
	
	public function getFeaturedCategories(){
		$result = $this->list(['limit' => 5, "featured" => 1]);
		foreach ($result as $key => $category) {
			$category->videos;
		}		
		return $result->toArray();
	}

	public function getSmallThumbURL(){

		return file_exists(public_path() . '/uploads/video-category/' . '100x60_' . $this->image) ? asset('uploads/video-category/' . '100x60_' . $this->image) : asset('images/dummy-video-category.jpg');
	}

	public function getDimentions(){
		return [['width' => 100, 'height' => 60], ['width' => 200, 'height' => 100], ['width' => 50, 'height' => 50]];
	}
}
