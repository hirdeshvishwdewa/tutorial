<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerDeleteRequest;
use App\Http\Requests\CustomerToggleStatusRequest;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Requests\CustomerSearchRequest;
class CustomerController extends Controller{
    //
	public $customer;
    public function __construct(){
    	$this->customer = new Customer();
    }

    public function index(CustomerSearchRequest $request) {
    	$pageInfo 	= [
                        'topHeading' => 'Dashboard - Customer Management',
                        'smallHeading' => 'Customers List',
                    ];
        $classList 	= $this->customer->getClassList();
        $search 	= $request->input('search');
        $gender 	= $request->input('gender');
    	$customers 	= $this->customer->list([
    										'paginate' 	=> 10, 
    										'gender' 	=> $gender, 
    										'like'		=> !empty($search) ? [
	    													'name' 		=> $search
	    													, 'email' 	=> $search
	    													, 'phone' 	=> $search
	    													, 'school' 	=> $search
	    												] : null
    									]);
    	return view('admin.customer.list', ['pageInfo'=>$pageInfo, 'customers'=>$customers, 'classList'=>$classList, 'search' => $search, 'gender' => $gender]);
    }

    public function addPage() {
    	$pageInfo = [
                        'topHeading' => 'Dashboard - Customer Management',
                        'smallHeading' => 'Add Customer ',
				];
		$classList = $this->customer->getClassList();
    	return view('admin.customer.add', ['pageInfo'=>$pageInfo, 'classList'=>$classList]);
    }


    public function create(CustomerCreateRequest $request){
    	$requestData            = $request->only($this->customer->getFillables());
        $requestData['password']= bcrypt($requestData['password']);

    	if(!$this->customer->create($requestData))
	    	return redirect()->route('customer-list')->with("alert-danger", __("admin.customer.customer_not_created"));

    	return redirect()->route('customer-list')->with("alert-success", __("admin.customer.customer_created"));
    }


    public function editPage($id) {
    	$customer = $this->customer->findOrFail($id);
    	if(!$customer)
	    	return redirect()->route('customer-list')->with("alert-danger", __("admin.customer.customer_not_found"));
	    $pageInfo = [
                        'topHeading' => 'Dashboard - Customer Management',
                        'smallHeading' => 'Update Customer ',
				];
		$classList = $this->customer->getClassList();
		return view('admin.customer.edit', ['pageInfo'=>$pageInfo, 'customer' => $customer, 'classList'=>$classList]);
    }

	public function update(CustomerUpdateRequest $request){
	    $id = $request->input('id');
    	$customer = $this->customer->findOrFail($id);
    	if(!$customer)
	    	return redirect()->route('customer-list')->with("alert-danger", __("admin.customer.customer_not_found"));
	    $request = $request->only($this->customer->fillable);
	    // dd($request);
	    $customer->name 	= $request['name'];
	    $customer->email 	= $request['email'];
	    $customer->password = bcrypt($request['password']);
	    $customer->gender 	= $request['gender'];
	    $customer->phone 	= $request['phone'];
	    $customer->class 	= $request['class'];
	    $customer->school 	= $request['school'];
	    $customer->status 	= $request['status'];

	    if(!$customer->save())
	    	return redirect()->route('customer-list')->with("alert-danger", __("admin.customer.customer_not_updated"));
    	return redirect()->route('customer-list')->with("alert-success", __("admin.customer.customer_updated"));
    	
    }

    public function status(CustomerToggleStatusRequest $request) {
    	$id = $request->input('id');
    	$customer = $this->customer->findOrFail($id);
    	if($customer->toggleStatus())
    		return redirect()->back()->with("alert-success", __("admin.customer.status_changed"));
    	return redirect()->back()->with("alert-info", __("admin.customer.status_not_changed"));

    }

    public function delete(CustomerDeleteRequest $request){
    	$id = $request->input('id');
    	$customer = $this->customer->findOrFail($id);
    	if(!$customer)
	    	return redirect()->route('customer-list')->with("alert-danger", __("admin.customer.customer_not_found"));
	    if(!$customer->delete())
	    	return redirect()->route('customer-list')->with("alert-danger", __("admin.customer.customer_not_deleted"));
	    return redirect()->route('customer-list')->with("alert-success", __("admin.customer.customer_deleted"));

    }
}
