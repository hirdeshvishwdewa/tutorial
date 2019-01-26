<?php

namespace App\Http\Controllers\API;

use Response;
use App\VideoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIHomeController extends Controller{
    
    protected $videoCategory;
    public function __construct(){
    	$this->videoCategory = new VideoCategory;
    }
    public function index() {
    	// 1. Find all the featured categories
    	$featuredCategories = $this->videoCategory->getFeaturedCategories();
    	// 2. If featured categories not found, find last few categories
    	return Response::json(compact('featuredCategories'), 200);
    }
}
