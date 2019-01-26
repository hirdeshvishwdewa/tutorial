<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use Response;
use Validator;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;

class AuthController extends Controller
{
    public function register(Request $request) {
        $customerRequest = new CustomerCreateRequest;
        $customerRequestRules = $customerRequest->rules();
        
        $validator      = Validator::make($request->all(), $customerRequestRules);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $customer               = new Customer;
        $requestData            = $request->only($customer->getFillables());
        $requestData['password']= bcrypt($requestData['password']);
        $customer               = Customer::create($requestData);
        
        $token          = JWTAuth::fromUser($customer);
        // dd($token);
        return Response::json(compact('customer','token'), 201);
    }

    public function login(Request $request) {
        $validator      = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
            'password'  => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $credentials    = $request->only('email', 'password');
        try {

            if ( ! $token = auth()->guard('api')->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }

            if(!auth()->guard('api')->user()->status){
                return response()->json(['error' => 'user_disabled'], 400);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser() {
        try {
            if (! $user = auth()->guard('api')->user()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
            return response()->json(compact('user'));
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }
}
