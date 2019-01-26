<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller{
    //
	public $user;
    public function __construct(){
    	$this->user = new User();
    }

    public function index() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - User Management',
                        'smallHeading' => 'Users List',
                    ];
    	$users = $this->user->list();
    	return view('admin.user.list', ['pageInfo'=>$pageInfo, 'users'=>$users]);
    }

    public function status($id, Request $request) {
    	$user = $this->user->findOrFail($id);
    	if($user->toggleStatus())
    		return redirect()->back()->with("alert-success", __("admin.user.status_changed"));
    	return redirect()->back()->with("alert-info", __("admin.user.status_not_changed"));

    }
}
