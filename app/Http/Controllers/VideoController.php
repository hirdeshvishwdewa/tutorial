<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoCategory;
use Illuminate\Http\Request;
use App\Http\Requests\VideoCreateRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Requests\VideoDeleteRequest;
use App\Http\Requests\VideoToggleStatusRequest;

class VideoController extends Controller {
    //
	public $video;
    public function __construct(){
    	$this->video = new Video();
    	$this->videoCategory = new VideoCategory();
    }

    public function index() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - Video Management',
                        'smallHeading' => 'Video List',
				];
    	$videos = $this->video->list(['paginate' => 10]);
    	return view('admin.video.list', ['pageInfo'=>$pageInfo, 'videos'=>$videos]);
    }

    public function addPage() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - Video Management',
                        'smallHeading' => 'Add Video ',
				];
		$videoCategories =  $this->videoCategory->list();
    	return view('admin.video.add', ['pageInfo'=>$pageInfo, 'videoCategories' => $videoCategories]);
    }


    public function create(VideoCreateRequest $request){
    	if(!$this->video->create($request->only($this->video->fillable)))
	    	return redirect()->route('video-list')->with("alert-danger", __("admin.video.video_not_created"));

    	return redirect()->route('video-list')->with("alert-success", __("admin.video.video_created"));
    }


    public function editPage($id) {
    	$video = $this->video->findOrFail($id);
    	if(!$video)
	    	return redirect()->route('video-list')->with("alert-danger", __("admin.video.video_not_found"));
	    $pageInfo = [
                        'topHeading' => 'Dashboard - Video Management',
                        'smallHeading' => 'Update Video ',
				];
		$videoCategories =  $this->videoCategory->list();
    	return view('admin.video.edit', ['pageInfo'=>$pageInfo, 'videoCategories'=>$videoCategories, 'video' => $video]);
    }

	public function update(VideoUpdateRequest $request){
	    $id = $request->input('id');
    	$video = $this->video->findOrFail($id);
    	if(!$video)
	    	return redirect()->route('video-list')->with("alert-danger", __("admin.video.video_not_found"));
	    $request = $request->only($this->video->fillable);
	    // dd($request);
	    $video->title 		= $request['title'];
	    $video->description = $request['description'];
	    $video->embed_url 	= $request['embed_url'];
	    $video->category_id = $request['category_id'];
	    $video->status 		= $request['status'];

	    if(!$video->save())
	    	return redirect()->route('video-list')->with("alert-danger", __("admin.video.video_not_updated"));
    	return redirect()->route('video-list')->with("alert-success", __("admin.video.video_updated"));
    	
    }    

    public function status(VideoToggleStatusRequest $request) {
    	$id = $request->input('id');
    	$video = $this->video->findOrFail($id);
    	if(!$video)
	    	return redirect()->route('video-list')->with("alert-danger", __("admin.video.video_not_found"));

    	if($video->toggleStatus())
    		return redirect()->back()->with("alert-success", __("admin.video.status_changed_succssfully"));
    	return redirect()->back()->with("alert-info", __("admin.video.status_not_changed"));

    }

    public function delete(VideoDeleteRequest $request){
    	$id = $request->input('id');
    	$video = $this->video->findOrFail($id);
    	if(!$video)
	    	return redirect()->route('video-list')->with("alert-danger", __("admin.video.video_not_found"));
	    if(!$video->delete())
	    	return redirect()->route('video-list')->with("alert-danger", __("admin.video.video_not_deleted"));
	    return redirect()->route('video-list')->with("alert-success", __("admin.video.video_deleted"));

    }
}
