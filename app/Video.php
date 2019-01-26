<?php

namespace App;

use App\Helpers\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    use ModelHelper;
    public $fillable = ['title', 'description', 'category_id', 'embed_url', 'status'];

    public function category() {
    	return $this->belongsTo('App\VideoCategory');
    }
}
