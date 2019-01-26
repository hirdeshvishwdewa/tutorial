<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Requests\CouponCreateRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Http\Requests\CouponDeleteRequest;
use App\Http\Requests\CouponToggleStatusRequest;

class CouponController extends Controller {
    //
	public $coupon;
    public function __construct(){
    	$this->coupon = new Coupon();
    }

    public function index() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - Coupon Management',
                        'smallHeading' => 'Coupon List',
				];
    	$coupons = $this->coupon->list(['paginate' => 10]);
    	return view('admin.coupon.list', ['pageInfo'=>$pageInfo, 'coupons'=>$coupons]);
    }

    public function addPage() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - Coupon Management',
                        'smallHeading' => 'Add Coupon ',
				];

    	return view('admin.coupon.add', ['pageInfo'=>$pageInfo]);
    }


    public function create(CouponCreateRequest $request){
    	if(!$this->coupon->create($request->only($this->coupon->fillable)))
	    	return redirect()->route('coupon-list')->with("alert-danger", __("admin.coupon.coupon_not_created"));

    	return redirect()->route('coupon-list')->with("alert-success", __("admin.coupon.coupon_created"));
    }


    public function editPage($id) {
    	$coupon = $this->coupon->findOrFail($id);
    	if(!$coupon)
	    	return redirect()->route('coupon-list')->with("alert-danger", __("admin.coupon.coupon_not_found"));
	    $pageInfo = [
                        'topHeading' => 'Dashboard - Coupon Management',
                        'smallHeading' => 'Update Coupon ',
				];

    	return view('admin.coupon.edit', ['pageInfo'=>$pageInfo, 'coupon' => $coupon]);
    }

	public function update(CouponUpdateRequest $request){
	    $id = $request->input('id');
    	$coupon = $this->coupon->findOrFail($id);
    	if(!$coupon)
	    	return redirect()->route('coupon-list')->with("alert-danger", __("admin.coupon.coupon_not_found"));
	    $request = $request->only($this->coupon->fillable);
	    // dd($request);
	    $coupon->title 		= $request['title'];
	    $coupon->description= $request['description'];
	    $coupon->code 		= $request['code'];
	    $coupon->percentage = $request['percentage'];
	    $coupon->status 	= $request['status'];

	    if(!$coupon->save())
	    	return redirect()->route('coupon-list')->with("alert-danger", __("admin.coupon.coupon_not_updated"));
    	return redirect()->route('coupon-list')->with("alert-success", __("admin.coupon.coupon_updated"));
    	
    }

    public function status(CouponToggleStatusRequest $request) {
    	$id = $request->input('id');
    	$coupon = $this->coupon->findOrFail($id);
    	if(!$coupon)
	    	return redirect()->route('coupon-list')->with("alert-danger", __("admin.coupon.coupon_not_found"));

    	if($coupon->toggleStatus())
    		return redirect()->back()->with("alert-success", __("admin.coupon.status_changed_succssfully"));
    	return redirect()->back()->with("alert-info", __("admin.coupon.status_not_changed"));

    }

    public function delete(CouponDeleteRequest $request){
    	$id = $request->input('id');
    	$coupon = $this->coupon->findOrFail($id);
    	if(!$coupon)
	    	return redirect()->route('coupon-list')->with("alert-danger", __("admin.coupon.coupon_not_found"));
	    if(!$coupon->delete())
	    	return redirect()->route('coupon-list')->with("alert-danger", __("admin.coupon.coupon_not_deleted"));
	    return redirect()->route('coupon-list')->with("alert-success", __("admin.coupon.coupon_deleted"));
    }
}
