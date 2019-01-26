<?php

namespace App\Http\Controllers;

use Image;
use App\Video;
use App\VideoCategory;
use Illuminate\Http\Request;
use App\Http\Requests\VideoCategoryCreateRequest;
use App\Http\Requests\VideoCategoryUpdateRequest;
use App\Http\Requests\VideoCategoryDeleteRequest;
use App\Http\Requests\VideoCategoryToggleStatusRequest;
use App\Http\Requests\VideoCategoryToggleFeaturedRequest;

class VideoCategoryController extends Controller {
    //
	public $videoCategory;
    public function __construct(){
        $this->video         = new Video();
    	$this->videoCategory = new VideoCategory();
    }

    public function index() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - Video Category Management',
                        'smallHeading' => 'Video Categories List',
				];
    	$videoCategories = $this->videoCategory->list(['paginate' => 10]);
    	return view('admin.video-category.list', ['pageInfo'=>$pageInfo, 'videoCategories'=>$videoCategories]);
    }

    public function addPage() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - Video Category Management',
                        'smallHeading' => 'Add Video Category',
				];
        $videoCategories =  $this->videoCategory->list();
    	return view('admin.video-category.add', ['pageInfo'=>$pageInfo, 'videoCategories' => $videoCategories]);
    }


    public function create(VideoCategoryCreateRequest $request){
        
        if(!$category = $this->videoCategory->create($request->only($this->videoCategory->fillable)))
            return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_created"));
        
        $img = $request->file('image');
        if($img){
            try{
                $originalImage= $request->file('image');
                $thumbnailImage = Image::make($originalImage);
                $originalPath = 'uploads/video-category/';
                $imgName = time().$originalImage->getClientOriginalName();
                // dd($originalPath);
                $thumbnailImage->save($originalPath.$imgName);
                
                $dimentions = $this->videoCategory->getDimentions();
                foreach ($dimentions as $dimention) {
                    $thumbnailImage->resize($dimention['width'], $dimention['height']);
                    $img = $originalPath. $dimention['width'] .'x'. $dimention['height'] . '_' . $imgName;
                    $thumbnailImage->save($img);
                }

                $category = $this->videoCategory->find($category->id);
                $category->image = $imgName;

                if(!$category->save()){
                    return redirect()->route('video-category-list')->with("alert-warning", $e->getMessage() ?? 'Image Upload Issue Occured!');
                }

            } catch(\Intervention\Image\Exception\NotReadableException $e) {
                return redirect()->route('video-category-list')->with("alert-warning", $e->getMessage() ?? 'Image Upload Issue Occured!');

            } catch(Exception $e) {
                return redirect()->route('video-category-list')->with("alert-warning", $e->getMessage() ?? 'Image Upload Issue Occured!');
            }
        }

    	return redirect()->route('video-category-list')->with("alert-success", __("admin.video_category.category_created"));
    }


    public function editPage($id) {
    	$videoCategory = $this->videoCategory->findOrFail($id);
    	if(!$videoCategory)
	    	return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_found"));
	    $pageInfo = [
                        'topHeading' => 'Dashboard - Video Category Management',
                        'smallHeading' => 'Update Video Category',
				];
        $videoCategories =  $this->videoCategory->list();
        return view('admin.video-category.edit', ['pageInfo'=>$pageInfo, 'videoCategory' => $videoCategory, 'videoCategories' => $videoCategories]);
    }

	public function update(VideoCategoryUpdateRequest $request){
	    $id = $request->input('id');
    	$videoCategory = $this->videoCategory->findOrFail($id);
    	if(!$videoCategory)
	    	return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_found"));
	    $req = $request->only($this->videoCategory->fillable);
	    // dd($request);
	    $videoCategory->category_name 	= $req['category_name'];
        $videoCategory->parent_id       = $req['parent_id'];
	    $videoCategory->status 			= $req['status'];

	    if(!$videoCategory->save())
	    	return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_updated"));

        $img = $request->file('image');
        if($img){
            try{
                $originalImage= $request->file('image');
                $thumbnailImage = Image::make($originalImage);
                $originalPath = 'uploads/video-category/';
                $imgName = time().$originalImage->getClientOriginalName();
                // dd($originalPath);
                $thumbnailImage->save($originalPath.$imgName);
                
                $dimentions = $this->videoCategory->getDimentions();
                foreach ($dimentions as $dimention) {
                    $thumbnailImage->resize($dimention['width'], $dimention['height']);
                    $img = $originalPath. $dimention['width'] .'x'. $dimention['height'] . '_' . $imgName;
                    $thumbnailImage->save($img);
                }
                
                $videoCategory->image = $imgName;

                if(!$videoCategory->save()){
                    return redirect()->route('video-category-list')->with("alert-warning", $e->getMessage() ?? __('admin.video-category.image_upload_issue'));
                }
                
            } catch(\Intervention\Image\Exception\NotReadableException $e) {
                return redirect()->route('video-category-list')->with("alert-warning", $e->getMessage() ?? __('admin.video-category.image_upload_issue'));

            } catch(Exception $e) {
                return redirect()->route('video-category-list')->with("alert-warning", $e->getMessage() ?? 'Image Upload Issue Occured!');
            }
        }

    	return redirect()->route('video-category-list')->with("alert-success", __("admin.video_category.category_updated"));
    	
    }

    public function status(VideoCategoryToggleStatusRequest $request) {
        $id = $request->input('id');
        $videoCategory = $this->videoCategory->findOrFail($id);
        if(!$videoCategory)
            return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_found"));

        if($videoCategory->toggleStatus())
            return redirect()->back()->with("alert-success", __("admin.video_category.status_changed_succssfully"));
        return redirect()->back()->with("alert-info", __("admin.video_category.status_not_changed"));
    }

    public function featured(VideoCategoryToggleFeaturedRequest $request) {
        $id = $request->input('id');
        $videoCategory = $this->videoCategory->findOrFail($id);
        if(!$videoCategory)
            return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_found"));

        if($videoCategory->toggleStatus("featured"))
            return redirect()->back()->with("alert-success", __("admin.video_category.featured_status_changed_succssfully"));
        return redirect()->back()->with("alert-info", __("admin.video_category.featured_status_not_changed"));
    }


    public function delete(VideoCategoryDeleteRequest $request){
    	$id = $request->input('id');
    	$videoCategory = $this->videoCategory->findOrFail($id);
    	if(!$videoCategory)
	    	return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_found"));
	    if(!$videoCategory->delete())
	    	return redirect()->route('video-category-list')->with("alert-danger", __("admin.video_category.category_not_deleted"));
	    return redirect()->route('video-category-list')->with("alert-success", __("admin.video_category.category_deleted"));

    }
}
